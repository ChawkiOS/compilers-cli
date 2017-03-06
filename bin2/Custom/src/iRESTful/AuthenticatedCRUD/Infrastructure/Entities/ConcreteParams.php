<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Params;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                                            use iRESTful\AuthenticatedCRUD\Domain\Objects\ParamPattern;
                                                                            

/**
*   @container -> params
*/

final class ConcreteParams extends AbstractEntity implements Params {
    private $name;
        private $pattern;
        private $isMandatory;
        

    /**
    *   @name -> getName() -> name ## @string max -> 255  
    *   @pattern -> getPattern() -> pattern  
    *   @isMandatory -> getIsMandatory() -> is_mandatory ## @boolean  
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, string $name, ParamPattern $pattern, bool $isMandatory) {
        

        parent::__construct($uuid, $createdOn);
        $this->name = $name;
        $this->pattern = $pattern;
        $this->isMandatory = $isMandatory;
        
    }

                public function getName() {
                return $this->name;
            }
                    public function getPattern() {
                return $this->pattern;
            }
                    public function getIsMandatory() {
                return $this->isMandatory;
            }
        

}
