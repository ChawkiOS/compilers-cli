<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Types;
use iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\BaseUrl;

final class ConcreteBaseUrl implements BaseUrl {
    private $baseUrl;
        
    public function __construct(string $baseUrl) {
        $validate = function(string $test) {
            if (filter_var($test, FILTER_VALIDATE_URL) === false) {
                throw new \Exception('The baseUrl ('.$test.') is invalid.');
            }
            
            };

        $validate($baseUrl);
        $this->baseUrl = $baseUrl;
        
    }

                public function get() {
                return $this->baseUrl;
            }
        

}
