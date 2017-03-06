<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Types\Adapters;
use iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Adapters\KeynameAdapter;

final class ConcreteKeynameAdapter implements KeynameAdapter {
    

    public function __construct() {
        
    }

            public function fromStringToKeyname(string $value) {
            return new \iRESTful\AuthenticatedCRUD\Infrastructure\Types\ConcreteKeyname($value);
        }
    
}
