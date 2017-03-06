<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Types;
use iRESTful\AuthenticatedCRUD\Domain\Types\Uris\Uri;

final class ConcreteUri implements Uri {
    private $uri;
        
    public function __construct(string $uri) {
        $validate = function(string $uri) {
            if (strpos($uri, '/') !== 0) {
                throw new \Exception('The first character of the URI ('.$uri.') must be a forward slash (/).');
            }
            if (strpos(strrev($uri), '/') === 0) {
                throw new \Exception('The last character of the URI ('.$uri.') cannot be a forward slash (/).');
            }
            
            };

        $validate($uri);
        $this->uri = $uri;
        
    }

                public function get() {
                return $this->uri;
            }
        

}
