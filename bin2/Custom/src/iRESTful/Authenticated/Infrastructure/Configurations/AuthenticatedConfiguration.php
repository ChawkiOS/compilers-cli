<?php
namespace iRESTful\Authenticated\Infrastructure\Configurations;
use iRESTful\Authenticated\Infrastructure\Configurations\AuthenticatedObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;
use iRESTful\CrudAPIs\Infrastructure\Configurations\ConcreteEntityApplicationConfiguration;
use iRESTful\Routers\Infrastructure\Adapters\ConcreteJsonControllerResponseAdapter;
use iRESTful\EntityDatabases\Infrastructure\Factories\ComplexStrategyServiceFactory;

    use iRESTful\Authenticated\Infrastructure\Controllers\ConcreteAuthenticate;
    use iRESTful\Routers\Domain\Controllers\Responses\Adapters\ControllerResponseAdapter;
    use iRESTful\Services\Domain\Service;
    use iRESTful\Authenticated\Infrastructure\Controllers\ConcreteAuthenticateJson;

final class AuthenticatedConfiguration {
    private $objectConfiguration;
    private $entityApplicationConfiguration;
    public function __construct(array $server) {
        $this->objectConfiguration = new AuthenticatedObjectConfiguration($server);
        $this->entityApplicationConfiguration = new ConcreteEntityApplicationConfiguration($server, $this->objectConfiguration);
    }

    public function get() {
        $baseConfigs = $this->entityApplicationConfiguration->get();
        return array_merge_recursive([
            'rules' => $this->getControllerRules()
        ], $baseConfigs);
    }

    private function getControllerRules() {

        
            $responseAdapter = new ConcreteJsonControllerResponseAdapter();

            $serviceFactory = new ComplexStrategyServiceFactory($this->objectConfiguration, $_SERVER);
            $service = $serviceFactory->create();

            return [[
                        'controller' => new ConcreteAuthenticate($responseAdapter, $service),
                        'criteria' => [
                            'uri' => '/authenticate',
                            'method' => 'get'
                        ]
                    ], [
                        'controller' => new ConcreteAuthenticateJson($responseAdapter, $service),
                        'criteria' => [
                            'uri' => '/authenticate.json',
                            'method' => 'get'
                        ]
                    ]];
            }

}
