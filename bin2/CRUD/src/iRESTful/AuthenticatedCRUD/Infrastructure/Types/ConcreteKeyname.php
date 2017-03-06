<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Types;
use iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Keyname;

final class ConcreteKeyname implements Keyname {
    private $keyname;
        
    public function __construct(string $keyname) {
        $validate = function(string $keyname) {
            if (empty($keyname)) {
                throw new \Exception('The keyname ('.$keyname.') must be a non-empty string.');
            }
            
            };

        $validate($keyname);
        $this->keyname = $keyname;
        
    }

                public function get() {
                return $this->keyname;
            }
        

}
