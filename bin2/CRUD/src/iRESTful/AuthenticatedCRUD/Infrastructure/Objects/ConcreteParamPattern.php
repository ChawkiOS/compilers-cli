<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Objects;
use iRESTful\AuthenticatedCRUD\Domain\Objects\ParamPattern;
                                                

final class ConcreteParamPattern implements ParamPattern {
    private $regexPattern;
        private $specificValue;
        

    /**
    *   @regexPattern -> getRegexPattern() -> regex_pattern ## @string max -> 255  
    *   @specificValue -> getSpecificValue() -> specific_value ## @string max -> 255  
    */

    public function __construct(string $regexPattern = null, string $specificValue = null) {
        $validate = function() use(&$regexPattern, &$specificValue) {
            if ((!empty($regexPattern) && !empty($specificValue)) || (empty($regexPattern) && empty($specificValue))) {
                $regexPattern = '';
                $specificValue = null;
            }
            
            };

        $validate();
        $this->regexPattern = $regexPattern;
        $this->specificValue = $specificValue;
        
    }

                public function getRegexPattern() {
                return $this->regexPattern;
            }
                    public function getSpecificValue() {
                return $this->specificValue;
            }
        

}
