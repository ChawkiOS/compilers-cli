<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Types\Adapters;
use iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\Adapters\BaseUrlAdapter;

final class ConcreteBaseUrlAdapter implements BaseUrlAdapter {
    

    public function __construct() {
        
    }

            public function fromStringToBaseUrl(string $value) {
            return new \iRESTful\AuthenticatedCRUD\Infrastructure\Types\ConcreteBaseUrl($value);
        }
    
}
