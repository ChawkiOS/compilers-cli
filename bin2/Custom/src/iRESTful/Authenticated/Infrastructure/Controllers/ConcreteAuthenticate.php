<?php
namespace iRESTful\Authenticated\Infrastructure\Controllers;
use iRESTful\Routers\Domain\Controllers\Controller;
use iRESTful\Https\Domain\Requests\HttpRequest;

            use iRESTful\Routers\Domain\Controllers\Responses\Adapters\ControllerResponseAdapter;
                use iRESTful\Services\Domain\Service;
    
        
final class ConcreteAuthenticate implements Controller {
    private $responseAdapter;
        private $service;
        

    public function __construct(ControllerResponseAdapter $responseAdapter, Service $service) {
        $this->responseAdapter = $responseAdapter;
        $this->service = $service;
        
    }

    public function execute(HttpRequest $httpRequest) {

        $execute = function() use(&$httpRequest) {
        $service = $this->service;
        print_r($service->getRepository()->getEntityPartialSet()->retrieve([
            'container' => 'role',
            'index' => 0,
            'amount' => 22
        ]));
        die();    
        
        };

        $output = $execute();
        return $this->responseAdapter->fromDataToControllerResponse($output);
    }


}
