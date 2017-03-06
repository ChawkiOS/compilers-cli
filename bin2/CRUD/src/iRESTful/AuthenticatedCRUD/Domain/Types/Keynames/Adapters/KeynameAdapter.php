<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Adapters;

interface KeynameAdapter {
                        public function fromStringToKeyname(string $string);
        
    }
