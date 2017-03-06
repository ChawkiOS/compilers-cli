<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Entities;

interface SharedResource {
                        public function getPermissions();
        
                        public function getOwners();
        
    }
