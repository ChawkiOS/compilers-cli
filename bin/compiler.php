<?php
include_once(__DIR__.'/../vendor/autoload.php');
use iRESTful\CompilersCLI\Infrastructure\Applications\ConcreteCompilerCLIApplication;
use iRESTful\CompilersCli\Infrastructure\Factories\ConcreteCompilersCliApplicationFactory;
use iRESTful\CompilersCli\Domain\Exceptions\CompilersCliException;

$amount = count($argv);
if (($amount != 3) && ($amount != 4)) {
    die(\PHP_EOL.'Invalid parameters.  Please refer to the documentation: https://github.com/irestful-labs/compilers-cli'.\PHP_EOL);
}

$apiUrl = 'http://api.compiler.irestful.org';
if ($amount == 4) {
    $apiUrl = $argv[1];
}

$jsonFile = ($amount == 4) ? $argv[2] : $argv[1];
$outputPath = ($amount == 4) ? $argv[3] : $argv[2];
if (!file_exists($outputPath)) {
    if (!mkdir($outputPath, 0777, true)) {
        die(\PHP_EOL.'Could not create the output path ('.$outputPath.').'.\PHP_EOL);
    }
}

$parseUrl = parse_url($apiUrl);
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
    die(\PHP_EOL.'Done!  The code was generated in this directory: '.$outputPath.\PHP_EOL);

} catch (CompilersCliException $exception) {
    die(\PHP_EOL.$exception->getMessage().\PHP_EOL);
}
