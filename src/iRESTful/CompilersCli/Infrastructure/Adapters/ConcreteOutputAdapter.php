<?php
namespace iRESTful\CompilersCli\Infrastructure\Adapters;
use iRESTful\CompilersCli\Domain\Output\Adapters\OutputAdapter;
use iRESTful\CompilersCli\Infrastructure\Objects\ConcreteOutput;
use iRESTful\CompilersCli\Domain\Output\Exceptions\OutputException;

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

    public function fromCommandToOutput(array $command) {

        if (!isset($command['action'])) {
            throw new OutputException('The action keyname is mandatory in order to convert data to an Output object.');
        }

        if (!isset($command['command'])) {
            throw new OutputException('The command keyname is mandatory in order to convert data to an Output object.');
        }

        if (!isset($command['command_output'])) {
            throw new OutputException('The command_output keyname is mandatory in order to convert data to an Output object.');
        }

        $message = \PHP_EOL."****************************************************".\PHP_EOL;
        $message .= "<fg=white;bg=blue;options=bold>".$command['action']."</> *** Executed: <fg=black;bg=yellow;>".$command['command']."</>".\PHP_EOL;
        $message .= "****************************************************".\PHP_EOL;
        foreach($command['command_output'] as $oneCommandOutputLine) {
            $message .= "    ".$oneCommandOutputLine.\PHP_EOL;
        }

        $message .= "****************************************************".\PHP_EOL;
        return new ConcreteOutput($message);

    }

}
