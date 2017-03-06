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

final class Watch extends Command {
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
        ->setName('watch')

        // the short description shown while running "php bin/console list"
        ->setDescription('Watch if 1+ source application or their code changed.  If yes, it automatically recompiles them.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows someone to watch an application')
        ->addArgument('url', InputArgument::REQUIRED, 'The url of the compiler API.')
        ->addArgument('sources', InputArgument::REQUIRED, 'The comma separated paths of the json source files.')
        ->addArgument('output', InputArgument::REQUIRED, 'The path of the output folder.  The compiled code will be saved in this folder, using the same folder hierarchy as the sources.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

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

        $hashDirectory = function($directory) use(&$hashDirectory) {

            if (!is_dir($directory)) {
                return null;
            }

            $files = [];
            $dir = dir($directory);
            while (false !== ($file = $dir->read())) {

                if (($file == '.') || ($file == '..')) {
                    continue;
                }

                $path = $directory.'/'.$file;
                if (is_dir($path)) {
                    $files[] = $hashDirectory($path);
                    continue;
                }

                $files[] = md5_file($path);
            }

            $dir->close();
            return md5(implode('', $files));
        };

        $execute = function($action, $command) use(&$output) {
            $output->writeLn(\PHP_EOL."+++++++++++++++++++++++++++++++++++++++++++++++++++++".\PHP_EOL);
            $output->writeLn("-> ".$action." +++ Executing: ".$command.\PHP_EOL);
            $output->writeLn("+++++++++++++++++++++++++++++++++++++++++++++++++++++".PHP_EOL);
            system($command);
            $output->writeLn("+++++++++++++++++++++++++++++++++++++++++++++++++++++".PHP_EOL);
        };

        $compileOne = function($path, $compiler, $compilerServer, $scriptBasePath, $compileTo, $recipeFileName) use( &$execute) {
            $command = $compiler.' compile '.$compilerServer.' '.$scriptBasePath.'/'.$path.'/'.$recipeFileName.' '.$compileTo.'/'.$path.';';
            $execute('Compiling', $command);
        };

        $jsonFiles = explode(',', $input->getArgument('sources'));
        $url = $input->getArgument('url');
        $outputDirectory = $input->getArgument('output');
        $commonBasePath = $getCommonPath($jsonFiles);

        $hashes = [];
        while(true) {

            foreach($jsonFiles as $filePath) {

                $recipeFileName = $getRecipeFileName($filePath);
                $directoryPath = str_replace('/'.$recipeFileName, '', $filePath);
                $onePath = ($directoryPath == $commonBasePath) ? '/' : str_replace($commonBasePath.'/', '', $directoryPath);

                if (!isset($hashes[$onePath])) {
                    $hashes[$onePath] = $hashDirectory($directoryPath);
                    if (empty($hashes[$onePath])) {
                        throw new \LogicException('The given filePath ('.$filePath.') is invalid.');
                    }

                    continue;
                }

                $previousHash = $hashes[$onePath];
                $newHash =  $hashDirectory($directoryPath);
                if (empty($newHash)) {
                    throw new \LogicException('The given filePath ('.$filePath.') is invalid.');
                }

                //if the hashes are not the same, recompile:
                if ($previousHash != $newHash) {
                    $compileOne($onePath, $this->compiler, $url, $commonBasePath, $outputDirectory, $recipeFileName);
                    $hashes[$onePath] = $newHash;
                    continue;
                }
            }

            //sleep for 1 second:
            sleep(1);

        }

    }

}
