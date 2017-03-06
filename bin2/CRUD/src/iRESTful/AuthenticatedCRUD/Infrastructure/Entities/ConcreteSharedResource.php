<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\SharedResource;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Permission;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Owner;
                                                        

/**
*   @container -> shared_resource
*/

final class ConcreteSharedResource extends AbstractEntity implements SharedResource {
    private $permissions;
        private $owners;
        

    /**
    *   @permissions -> getPermissions() -> permissions ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Permission 
    *   @owners -> getOwners() -> owners ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Owner 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, array $permissions = null, array $owners = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->permissions = $permissions;
        $this->owners = $owners;
        
    }

                public function getPermissions() {
                return $this->permissions;
            }
                    public function getOwners() {
                return $this->owners;
            }
        

}
