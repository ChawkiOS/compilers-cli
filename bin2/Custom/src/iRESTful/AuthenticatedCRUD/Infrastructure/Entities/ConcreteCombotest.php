<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Entities;
use iRESTful\AuthenticatedCRUD\Domain\Entities\Combotest;
use iRESTful\Entities\Infrastructure\Objects\AbstractEntity;
use iRESTful\Libraries\Ids\Domain\Uuids\Uuid;
                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Endpoint;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Api;
                                                                                                        use iRESTful\AuthenticatedCRUD\Domain\Entities\Registration;
                                                        

/**
*   @container -> combotest
*/

final class ConcreteCombotest extends AbstractEntity implements Combotest {
    private $endpoint;
        private $api;
        private $registration;
        

    /**
    *   @endpoint -> getEndpoint() -> endpoint ## @binary specific -> 128  
    *   @api -> getApi() -> api ## @binary specific -> 128  
    *   @registration -> getRegistration() -> registration ## @binary specific -> 128  
    */

    public function __construct(Uuid $uuid, \DateTime $createdOn, Endpoint $endpoint = null, Api $api = null, Registration $registration = null) {
        $validate = function() use(&$endpoint, &$api, &$registration) {
            $amount = (empty($endpoint) ? 0 : 1) + (empty($api) ? 0 : 1) + (empty($registration) ? 0 : 1);
            if ($amount != 1) {
                throw new \Exception('There must be either an endpoint, an api or a registration.  '.$amount.' given.');
            }
            
            };

        $validate();

        parent::__construct($uuid, $createdOn);
        $this->endpoint = $endpoint;
        $this->api = $api;
        $this->registration = $registration;
        
    }

                public function getEndpoint() {
                return $this->endpoint;
            }
                    public function getApi() {
                return $this->api;
            }
                    public function getRegistration() {
                return $this->registration;
            }
        

}
