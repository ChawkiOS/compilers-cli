<?php
namespace iRESTful\CompilersCli\Domain\Output\Adapters;

interface OutputAdapter {
    public function fromStringToOutput(string $message);
    public function fromCommandToOutput(array $command);
    public function fromCommandsToOutput(array $commands);
    public function fromExceptionToOutput(\Exception $exception);
}
