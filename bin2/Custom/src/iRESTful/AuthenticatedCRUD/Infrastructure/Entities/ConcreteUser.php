<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\User;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                                            use iRESTful\AuthenticatedCRUD\Domain\Objects\Credentials;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Role;
                                                        

/**
*   @container -> user
*/

final class ConcreteUser extends AbstractEntity implements User {
    private $name;
        private $credentials;
        private $roles;
        

    /**
    *   @name -> getName() -> name ## @string max -> 255  
    *   @credentials -> getCredentials() -> credentials  
    *   @roles -> getRoles() -> roles ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Role 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, string $name, Credentials $credentials, array $roles = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->name = $name;
        $this->credentials = $credentials;
        $this->roles = $roles;
        
    }

                public function getName() {
                return $this->name;
            }
                    public function getCredentials() {
                return $this->credentials;
            }
                    public function getRoles() {
                return $this->roles;
            }
        

}
