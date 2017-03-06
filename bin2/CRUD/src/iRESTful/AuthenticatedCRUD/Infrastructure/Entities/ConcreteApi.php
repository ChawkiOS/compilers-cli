<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Api;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\BaseUrl;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Endpoint;
                                                        

/**
*   @container -> api
*/

final class ConcreteApi extends AbstractEntity implements Api {
    private $baseUrl;
        private $endpoints;
        

    /**
    *   @baseUrl -> getBaseUrl()->get() -> base_url ## @string max -> 255 ** iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\Adapters\BaseUrlAdapter::fromStringToBaseUrl  
    *   @endpoints -> getEndpoints() -> endpoints ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Endpoint 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, BaseUrl $baseUrl, array $endpoints = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->baseUrl = $baseUrl;
        $this->endpoints = $endpoints;
        
    }

                public function getBaseUrl() {
                return $this->baseUrl;
            }
                    public function getEndpoints() {
                return $this->endpoints;
            }
        

}
