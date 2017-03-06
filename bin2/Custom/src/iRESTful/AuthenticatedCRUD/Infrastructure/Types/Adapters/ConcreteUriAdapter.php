<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Types\Adapters;
use iRESTful\AuthenticatedCRUD\Domain\Types\Uris\Adapters\UriAdapter;

final class ConcreteUriAdapter implements UriAdapter {
    

    public function __construct() {
        
    }

            public function fromStringToUri(string $value) {
            return new \iRESTful\AuthenticatedCRUD\Infrastructure\Types\ConcreteUri($value);
        }
    
}
