<?php
namespace iRESTful\Authenticated\Infrastructure\Controllers;
use iRESTful\Routers\Domain\Controllers\Controller;
use iRESTful\Https\Domain\Requests\HttpRequest;

            use iRESTful\Routers\Domain\Controllers\Responses\Adapters\ControllerResponseAdapter;
                use iRESTful\Services\Domain\Service;
    
        
final class ConcreteAuthenticateJson implements Controller {
    private $responseAdapter;
        private $service;
        

    public function __construct(ControllerResponseAdapter $responseAdapter, Service $service) {
        $this->responseAdapter = $responseAdapter;
        $this->service = $service;
        
    }

    public function execute(HttpRequest $httpRequest) {

        $execute = function() use(&$httpRequest) {
        $service = $this->service;
        return [
            'some' => 'json'
        ];
        
        };

        $output = $execute();
        return $this->responseAdapter->fromDataToControllerResponse($output);
    }


}
