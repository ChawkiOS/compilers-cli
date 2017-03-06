<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Resource;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Endpoint;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Owner;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\SharedResource;
                                                        

/**
*   @container -> resource
*/

final class ConcreteResource extends AbstractEntity implements Resource {
    private $endpoint;
        private $owner;
        private $sharedResources;
        

    /**
    *   @endpoint -> getEndpoint() -> endpoint ## @binary specific -> 128  
    *   @owner -> getOwner() -> owner ## @binary specific -> 128  
    *   @sharedResources -> getSharedResources() -> shared_resources ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\SharedResource 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, Endpoint $endpoint, Owner $owner, array $sharedResources = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->endpoint = $endpoint;
        $this->owner = $owner;
        $this->sharedResources = $sharedResources;
        
    }

                public function getEndpoint() {
                return $this->endpoint;
            }
                    public function getOwner() {
                return $this->owner;
            }
                    public function getSharedResources() {
                return $this->sharedResources;
            }
        

}
