<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Entities;

interface Role {
                        public function getTitle();
        
                        public function getDescription();
        
                        public function getPermissions();
        
    }
