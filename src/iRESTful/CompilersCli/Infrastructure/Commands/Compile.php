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

final class Compile extends Command {

    private $outputAdapter;
    public function __construct() {
        parent::__construct();
        $this->outputAdapter = new ConcreteOutputAdapter();
    }

    protected function configure() {
        $this
        // the name of the command (the part after "bin/console")
        ->setName('compile')

        // the short description shown while running "php bin/console list"
        ->setDescription('Compile the application')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows someone to compile an application')
        ->addArgument('url', InputArgument::REQUIRED, 'The url of the compiler API.')
        ->addArgument('source', InputArgument::REQUIRED, 'The path of the json source file.')
        ->addArgument('output', InputArgument::REQUIRED, 'The path of the output folder.  The compiled code will be saved in this folder.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $jsonFile = $input->getArgument('source');
        $outputPath = $input->getArgument('output');
        if (!file_exists($outputPath)) {
            if (!mkdir($outputPath, 0777, true)) {
                throw new \LogicException('Could not create the output path ('.$outputPath.').');
            }
        }

        $parseUrl = parse_url($input->getArgument('url'));
        $port = (isset($parseUrl['port'])) ? $parseUrl['port'] : 80;
        $baseUrl = $parseUrl['scheme'].'://'.$parseUrl['host'];
        if (isset($parseUrl['path'])) {
            $baseUrl = $baseUrl.$parseUrl['path'];
        }

        try {

            $outputPath = realpath($outputPath);
            $jsonFile = realpath($jsonFile);

            $applicationFactory = new ConcreteCompilersCliApplicationFactory($baseUrl, $port, $outputPath);
            $applicationFactory->create()->execute($jsonFile);

            $message = $this->outputAdapter->fromStringToOutput('Done!  The code was generated in this directory: '.$outputPath);

            $output->writeln($message->get());

        } catch (CompilersCliException $exception) {
            $message = $this->outputAdapter->fromExceptionToOutput($exception);
            $output->write($message->get());
        }

    }

}
