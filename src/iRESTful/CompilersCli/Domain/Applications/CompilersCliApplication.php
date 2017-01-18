<?php
namespace iRESTful\CompilersCli\Domain\Applications;

interface CompilersCliApplication {
    public function execute(string $jsonFile);
}
