<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Objects;
use iRESTful\AuthenticatedCRUD\Domain\Objects\Pattern;
                                                                            use iRESTful\AuthenticatedCRUD\Domain\Types\Uris\Uri;
                                                        

final class ConcretePattern implements Pattern {
    private $regexPattern;
        private $specificUri;
        

    /**
    *   @regexPattern -> getRegexPattern() -> regex_pattern ## @string max -> 255  
    *   @specificUri -> getSpecificUri()->get() -> specific_uri ## @string max -> 255 ** iRESTful\AuthenticatedCRUD\Domain\Types\Uris\Adapters\UriAdapter::fromStringToUri  
    */

    public function __construct(string $regexPattern = null, Uri $specificUri = null) {
        $validate = function() use(&$regexPattern, &$specificUri) {
            if ((!empty($regexPattern) && !empty($specificUri)) || (empty($regexPattern) && empty($specificUri))) {
                $regexPattern = '';
                $specificUri = null;
            }
            
            };

        $validate();
        $this->regexPattern = $regexPattern;
        $this->specificUri = $specificUri;
        
    }

                public function getRegexPattern() {
                return $this->regexPattern;
            }
                    public function getSpecificUri() {
                return $this->specificUri;
            }
        

}
