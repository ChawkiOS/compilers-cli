<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Objects;

interface Credentials {
                        public function getUsername();
        
                        public function getHashedPassword();
        
                        public function getPassword();
        
    }
