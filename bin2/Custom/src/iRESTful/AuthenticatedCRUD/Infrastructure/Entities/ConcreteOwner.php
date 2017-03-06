<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Owner;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Software;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\User;
                                                        

/**
*   @container -> owner
*/

final class ConcreteOwner extends AbstractEntity implements Owner {
    private $software;
        private $user;
        

    /**
    *   @software -> getSoftware() -> software ## @binary specific -> 128  
    *   @user -> getUser() -> user ## @binary specific -> 128  
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, Software $software, User $user = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->software = $software;
        $this->user = $user;
        
    }

                public function getSoftware() {
                return $this->software;
            }
                    public function getUser() {
                return $this->user;
            }
        

}
