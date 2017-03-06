<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Endpoint;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Objects\Pattern;
                                                                                                                            use iRESTful\AuthenticatedCRUD\Domain\Entities\Params;
                                                        

/**
*   @container -> endpoint
*/

final class ConcreteEndpoint extends AbstractEntity implements Endpoint {
    private $pattern;
        private $isUserMandatory;
        private $params;
        

    /**
    *   @pattern -> getPattern() -> pattern  
    *   @isUserMandatory -> getIsUserMandatory() -> is_user_mandatory ## @boolean  
    *   @params -> getParams() -> params ## @binary specific -> 128 ** @elements-type -> iRESTful\AuthenticatedCRUD\Domain\Entities\Params 
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, Pattern $pattern, bool $isUserMandatory, array $params = null) {
        

        parent::__construct($uuid, $createdOn);
        $this->pattern = $pattern;
        $this->isUserMandatory = $isUserMandatory;
        $this->params = $params;
        
    }

                public function getPattern() {
                return $this->pattern;
            }
                    public function getIsUserMandatory() {
                return $this->isUserMandatory;
            }
                    public function getParams() {
                return $this->params;
            }
        

}
