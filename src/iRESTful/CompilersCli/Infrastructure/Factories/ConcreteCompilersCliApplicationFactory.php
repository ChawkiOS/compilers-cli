<?php
namespace iRESTful\CompilersCli\Infrastructure\Factories;
use iRESTful\CompilersCli\Domain\Applications\Factories\CompilersCliApplicationFactory;
use iRESTful\Https\Infrastructure\Factories\CurlHttpApplicationFactory;
use iRESTful\CompilersCli\Infrastructure\Applications\ConcreteCompilersCliApplication;

final class ConcreteCompilersCliApplicationFactory implements CompilersCliApplicationFactory {
    private $baseUrl;
    private $port;
    private $outputPath;
    public function __construct(string $baseUrl, int $port, string $outputPath) {
        $this->baseUrl = $baseUrl;
        $this->port = $port;
        $this->outputPath = $outputPath;
    }

    public function create() {
        $applicationFactory = new CurlHttpApplicationFactory($this->baseUrl);
        $application = $applicationFactory->create();
        return new ConcreteCompilersCliApplication($application, $this->port, $this->outputPath);
    }

}
