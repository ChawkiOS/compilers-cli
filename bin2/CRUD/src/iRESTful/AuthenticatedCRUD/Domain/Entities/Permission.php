<?php
namespace iRESTful\AuthenticatedCRUD\Domain\Entities;

interface Permission {
                        public function getTitle();
        
                        public function getCanRead();
        
                        public function getCanWrite();
        
                        public function getCanDelete();
        
                        public function getDescription();
        
    }
