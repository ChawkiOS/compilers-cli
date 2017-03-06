<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Entities;

interface Resource {
                        public function getEndpoint();
        
                        public function getOwner();
        
                        public function getSharedResources();
        
    }
