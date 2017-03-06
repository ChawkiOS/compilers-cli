<?php
namespace iRESTful\CompilersCli\Infrastructure\Adapters;
use iRESTful\CompilersCli\Domain\Output\Adapters\OutputAdapter;
use iRESTful\CompilersCli\Infrastructure\Objects\ConcreteOutput;

final class ConcreteOutputAdapter implements OutputAdapter {

    public function __construct() {

    }

    public function fromStringToOutput(string $message) {
        $prefix = PHP_EOL.'*************'.PHP_EOL.'** <fg=black;bg=green;options=bold>SUCCESS</> **'.PHP_EOL.'*************'.PHP_EOL;
        $message = $prefix.$message.\PHP_EOL.\PHP_EOL;
        return new ConcreteOutput($message);
    }

    public function fromExceptionToOutput(\Exception $exception) {
        $generate = function(\Exception $exception, string $prefix = '') use(&$generate) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $line = $exception->getLine();
            $file = $exception->getFile();

            $subErrors = '';
            $parentException = $exception->getPrevious();
            if (!empty($parentException)) {
                $subErrors = $generate($parentException, $prefix.'    ');
            }

            $line = $prefix.'->'.$code.':'.$message.' -- Line: '.$line.' -- File: '.$file.PHP_EOL;
            return $line.$subErrors;
        };

        $prefix = PHP_EOL.'***********'.PHP_EOL.'** <fg=white;bg=red;options=bold>ERROR</> **'.PHP_EOL.'***********'.PHP_EOL;
        $message = $prefix.$generate($exception).PHP_EOL;
        return new ConcreteOutput($message);
    }

}
