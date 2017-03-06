<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Registration;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Keyname;
                                                                                                                                                use iRESTful\AuthenticatedCRUD\Domain\Entities\Role;
                                                        

/**
*   @container -> registration
*/

final class ConcreteRegistration extends AbstractEntity implements Registration {
    private $keyname;
        private $title;
        private $description;
        private $roles;
        

    /**
    *   @keyname -> getKeyname()->get() -> keyname ## @string max -> 255 ** iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Adapters\KeynameAdapter::fromStringToKeyname  
    *   @title -> getTitle() -> title ## @string max -> 255  
    *   @description -> getDescription() -> description ## @string max -> 255  
    *   @roles -> getRoles() -> roles ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Role 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, Keyname $keyname, string $title, string $description = null, array $roles = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->keyname = $keyname;
        $this->title = $title;
        $this->description = $description;
        $this->roles = $roles;
        
    }

                public function getKeyname() {
                return $this->keyname;
            }
                    public function getTitle() {
                return $this->title;
            }
                    public function getDescription() {
                return $this->description;
            }
                    public function getRoles() {
                return $this->roles;
            }
        

}
