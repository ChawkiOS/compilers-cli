<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Entities;

interface User {
                        public function getName();
        
                        public function getCredentials();
        
                        public function getRoles();
        
    }
