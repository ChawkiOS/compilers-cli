<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Entities;

interface Endpoint {
                        public function getPattern();
        
                        public function getIsUserMandatory();
        
                        public function getParams();
        
    }
