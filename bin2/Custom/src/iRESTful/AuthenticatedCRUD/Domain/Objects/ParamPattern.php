<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Objects;

interface ParamPattern {
                        public function getRegexPattern();
        
                        public function getSpecificValue();
        
    }
