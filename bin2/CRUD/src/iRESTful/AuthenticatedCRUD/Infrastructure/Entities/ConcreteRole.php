<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Role;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                                                                use iRESTful\AuthenticatedCRUD\Domain\Entities\Permission;
                                                        

/**
*   @container -> role
*/

final class ConcreteRole extends AbstractEntity implements Role {
    private $title;
        private $description;
        private $permissions;
        

    /**
    *   @title -> getTitle() -> title ## @string max -> 255  
    *   @description -> getDescription() -> description ## @string max -> 255  
    *   @permissions -> getPermissions() -> permissions ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Permission 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, string $title, string $description = null, array $permissions = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->title = $title;
        $this->description = $description;
        $this->permissions = $permissions;
        
    }

                public function getTitle() {
                return $this->title;
            }
                    public function getDescription() {
                return $this->description;
            }
                    public function getPermissions() {
                return $this->permissions;
            }
        

}
