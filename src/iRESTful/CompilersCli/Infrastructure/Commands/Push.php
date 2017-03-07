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

final class Push extends Command {

    private $outputAdapter;
    public function __construct() {
        parent::__construct();
        $this->outputAdapter = new ConcreteOutputAdapter();
    }

    protected function configure() {
        $this
        // the name of the command (the part after "bin/console")
        ->setName('push')

        // the short description shown while running "php bin/console list"
        ->setDescription('Push the applications')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows someone to push applications to the docker registry.')
        ->addArgument('source', InputArgument::REQUIRED, 'The path of the directory that contain json source application files.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $getJsonFiles = function(string $source) {

            $getFiles = function(string $basePath) use(&$getFiles) {

                if (!file_exists($basePath) || !is_dir($basePath)) {
                    return [];
                }

                $output = [];
                $resource = opendir($basePath);
                while (($file = readdir($resource)) !== false) {
                    if (($file == '.') || ($file == '..')) {
                        continue;
                    }

                    $path = realpath($basePath.'/'.$file);
                    if (is_dir($path)) {
                        $output = array_merge($output, $getFiles($path));
                        continue;
                    }

                    $output[] = $path;

                }

                return $output;
            };

            $output = [];
            $files = $getFiles($source);
            foreach($files as $oneFile) {
                $data = @json_decode(file_get_contents($oneFile), true);
                if (empty($data)) {
                    continue;
                }

                if (!isset($data['type'])) {
                    continue;
                }

                if (($data['type'] != 'crud-rest-api') && ($data['type'] != 'custom-rest-api') && ($data['type'] != 'hateaos-rest-api')) {
                    continue;
                }

                $output[] = $oneFile;
            }

            return $output;

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

        $getImages = function(array $jsonFilePaths) use(&$replaceUppercase) {

            $output = [];
            foreach($jsonFilePaths as $oneJsonFilePath) {
                $recipeData = json_decode(file_get_contents($oneJsonFilePath), true);
                $exploded = explode('/', $recipeData['name']);
                $imageName = $replaceUppercase($exploded[1], '-');
                $organizationName = strtolower($exploded[0]);

                $output[] = [
                    'name' => $organizationName.'/'.$imageName,
                    'version' => $recipeData['version']
                ];
            }

            return $output;

        };

        $source = $input->getArgument('source');
        $jsonFiles = $getJsonFiles($source);
        $images = $getImages($jsonFiles);

        $commands = [];
        foreach($images as $oneImage) {
            $commands[] = 'docker push '.$oneImage['name'].':'.$oneImage['version'].';';
        }

        $message = $this->outputAdapter->fromCommandsToOutput([
            'action' => 'Docker Push',
            'commands' => $commands
        ]);

        $output->write($message->get());

    }

}
