<?php
namespace iRESTful\CompilersCli\Domain\Output\Exceptions;

final class OutputException extends \Exception {
    const CODE = 1;
    public function __construct($message, \Exception $parentException = null) {
        parent::__construct($message, self::CODE, $parentException);
    }
}
