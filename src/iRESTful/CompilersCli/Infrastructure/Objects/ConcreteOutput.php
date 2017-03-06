<?php
namespace iRESTful\CompilersCli\Infrastructure\Objects;
use iRESTful\CompilersCli\Domain\Output\Output;

final class ConcreteOutput implements Output {
    private $message;
    public function __construct(string $message) {
        $this->message = $message;
    }

    public function get() {
        return $this->message;
    }

}
