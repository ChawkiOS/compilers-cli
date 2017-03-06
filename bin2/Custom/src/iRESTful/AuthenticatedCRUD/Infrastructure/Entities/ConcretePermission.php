<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Permission;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                                                                            

/**
*   @container -> permission
*/

final class ConcretePermission extends AbstractEntity implements Permission {
    private $title;
        private $canRead;
        private $canWrite;
        private $canDelete;
        private $description;
        

    /**
    *   @title -> getTitle() -> title ## @string max -> 255  
    *   @canRead -> getCanRead() -> can_read ## @boolean  
    *   @canWrite -> getCanWrite() -> can_write ## @boolean  
    *   @canDelete -> getCanDelete() -> can_delete ## @boolean  
    *   @description -> getDescription() -> description ## @string max -> 255  
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, string $title, bool $canRead, bool $canWrite, bool $canDelete, string $description = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->title = $title;
        $this->canRead = $canRead;
        $this->canWrite = $canWrite;
        $this->canDelete = $canDelete;
        $this->description = $description;
        
    }

                public function getTitle() {
                return $this->title;
            }
                    public function getCanRead() {
                return $this->canRead;
            }
                    public function getCanWrite() {
                return $this->canWrite;
            }
                    public function getCanDelete() {
                return $this->canDelete;
            }
                    public function getDescription() {
                return $this->description;
            }
        

}
