<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Objects;
use iRESTful\AuthenticatedCRUD\Domain\Objects\Credentials;
                                                                    

final class ConcreteCredentials implements Credentials {
    private $username;
        private $hashedPassword;
        private $password;
        

    /**
    *   @username -> getUsername() -> username ## @string max -> 255  
    *   @hashedPassword -> getHashedPassword() -> hashed_password ## @string max -> 255  
    *   @password -> getPassword() -> password ## @string max -> 255  
    */

    public function __construct(string $username, string $hashedPassword, string $password = null) {
        
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->password = $password;
        
    }

                public function getUsername() {
                return $this->username;
            }
                    public function getHashedPassword() {
                return $this->hashedPassword;
            }
                    public function getPassword() {
                return $this->password;
            }
        

}
