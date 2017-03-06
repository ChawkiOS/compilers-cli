<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\Adapters;

interface BaseUrlAdapter {
                        public function fromStringToBaseUrl(string $string);
        
    }
