<?php
namespace iRESTful\CompilersCli\Infrastructure\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use iRESTful\CompilersCLI\Infrastructure\Applications\ConcreteCompilerCLIApplication;
use iRESTful\CompilersCli\Infrastructure\Factories\ConcreteCompilersCliApplicationFactory;
use iRESTful\CompilersCli\Domain\Exceptions\CompilersCliException;
use iRESTful\CompilersCli\Infrastructure\Adapters\ConcreteOutputAdapter;

final class Build extends Command {
    private $compiler;
    private $outputAdapter;
    public function __construct(string $appPath) {
        parent::__construct();
        $this->compiler = 'php '.$appPath;
        $this->outputAdapter = new ConcreteOutputAdapter();
    }

    protected function configure() {
        $this
        // the name of the command (the part after "bin/console")
        ->setName('build')

        // the short description shown while running "php bin/console list"
        ->setDescription('Build the docker images of the application')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows someone to compile an application')
        ->addArgument('url', InputArgument::REQUIRED, 'The url of the compiler API.')
        ->addArgument('sources', InputArgument::REQUIRED, 'The comma separated paths of the json source files.')
        ->addArgument('output', InputArgument::REQUIRED, 'The path of the output folder.  The compiled code will be saved in this folder, using the same folder hierarchy as the sources.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $cleanBin = function($dir) use(&$cleanBin) {

            if (!file_exists($dir) || !is_dir($dir)) {
                return;
            }

            $objects = scandir($dir);
            foreach ($objects as $oneObject) {

                if ($oneObject == "." || $oneObject == "..") {
                    continue;
                }

                $path = $dir.'/'.$oneObject;
                if (is_dir($path)) {
                    $cleanBin($path);
                    continue;
                }

                unlink($path);
            }

            rmdir($dir);
        };

        $replaceUppercase = function($name, $prefix) {
            $matches = [];
            preg_match_all('/[A-Z]+/s', $name, $matches);
            foreach($matches[0] as $oneLetter) {
                $name = str_replace($oneLetter, $prefix.strtolower($oneLetter), $name);
            }

            if (strpos($name, $prefix) === 0) {
                $name = substr($name, 1);
            }

            return $name;
        };

        $getCommonBasePath = function(array $jsonFiles) {

            $getParts = function(array $jsonFiles) {
                $output = [];
                foreach($jsonFiles as $oneJsonFile) {
                    $output[] = explode('/', $oneJsonFile);
                }

                return $output;
            };

            $containsAtIndex = function(int $index, string $str, array $data) {

                foreach($data as $oneData) {

                    if (!isset($oneData[$index])) {
                        return false;
                    }

                    if ($oneData[$index] != $str) {
                        return false;
                    }

                }

                return true;

            };

            $common = [];
            $folders = $getParts($jsonFiles);
            $lastFolder = array_pop($folders);
            foreach($lastFolder as $index => $oneFolder) {

                if ($containsAtIndex($index, $oneFolder, $folders)) {
                    $common[] = $oneFolder;
                    continue;
                }

                break;

            }

            return implode('/', $common);

        };

        $getCommonPath = function(array $sources, string $basePath = '/') use(&$getCommonBasePath) {
            if (count($sources) == 1) {
                $filePath = array_pop($sources);
                $exploded = explode('/', $filePath);
                array_pop($exploded);
                return implode('/', $exploded);
            }

            return $getCommonBasePath($sources);
        };

        $getRecipeFileName = function(string $jsonFilePath) {
            $exploded = explode('/', $jsonFilePath);
            return array_pop($exploded);
        };

        $execute = function($action, $command) use(&$output) {
            $commandOutput = [];
            exec($command, $commandOutput);
            $message = $this->outputAdapter->fromCommandToOutput([
                'action' => $action,
                'command' => $command,
                'command_output' => $commandOutput
            ]);

            $output->write($message->get());
            return $commandOutput;
        };

        $executeBuilds = function($action, $command) use(&$execute) {
            $output = $execute($action, $command);
            foreach($output as $oneLine) {
                $oneLine = trim($oneLine);
                if ($oneLine == 'Successfully built') {
                    return true;
                }
            }

            return false;
        };

        $compileOne = function($path, $compiler, $compilerServer, $scriptBasePath, $compileTo, $recipeFileName) use( &$execute) {
            $compileToPath = (empty($path)) ? $compileTo : $compileTo.'/'.$path;
            $command = $compiler.' compile '.$compilerServer.' '.$scriptBasePath.'/'.$path.'/'.$recipeFileName.' '.$compileToPath.';';
            $output = $execute('Compiling', $command);

            foreach($output as $oneLine) {
                $oneLine = trim($oneLine);
                if (strpos(strtolower($oneLine), 'success')) {
                    return true;
                }
            }

            return false;
        };

        $compileMultiple = function(array $filePaths, $compiler, $compilerServer, $scriptBasePath, $compileTo) use(&$compileOne, &$getRecipeFileName) {
            foreach($filePaths as $filePath) {

                $recipeFileName = $getRecipeFileName($filePath);
                $directoryPath = str_replace('/'.$recipeFileName, '', $filePath);
                $onePath = ($directoryPath == $scriptBasePath) ? '' : str_replace($scriptBasePath.'/', '', $directoryPath);

                if (!$compileOne($onePath, $compiler, $compilerServer, $scriptBasePath, $compileTo, $recipeFileName)) {
                    throw new \LogicException('The compiler did not succeed.');
                }


            }
        };

        $jsonFiles = explode(',', $input->getArgument('sources'));
        $url = $input->getArgument('url');
        $outputDirectory = $input->getArgument('output');
        $commonBasePath = $getCommonPath($jsonFiles);

        //delete the bin directory:
        $cleanBin($outputDirectory);

        //compile:
        $compileMultiple($jsonFiles, $this->compiler, $url, $commonBasePath, $outputDirectory);

        //start/stop the images to make sure the test works, then compile the docker image:
        foreach($jsonFiles as $filePath) {

            $recipeFileName = $getRecipeFileName($filePath);
            $directoryPath = str_replace('/'.$recipeFileName, '', $filePath);
            $onePath = ($directoryPath == $commonBasePath) ? '' : str_replace($commonBasePath.'/', '', $directoryPath);

            $binPath = $outputDirectory.'/'.$onePath;
            $srcPath = $commonBasePath.'/'.$onePath;

            //build the docker image:
            $recipeData = json_decode(file_get_contents($srcPath.'/'.$recipeFileName), true);
            $exploded = explode('/', $recipeData['name']);
            $imageName = $replaceUppercase($exploded[1], '-');
            $organizationName = strtolower($exploded[0]);

            //build:
            $command = 'cd '.$binPath.'; docker build -t '.$organizationName.'/'.$imageName.':'.$recipeData['version'].' .';
            $executeBuilds('Build Docker Image', $command);

        }


    }

}
