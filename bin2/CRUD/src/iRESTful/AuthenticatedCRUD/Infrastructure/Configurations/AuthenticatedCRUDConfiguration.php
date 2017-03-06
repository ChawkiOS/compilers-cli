<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Configurations;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;
use iRESTful\CrudAPIs\Infrastructure\Configurations\ConcreteEntityApplicationConfiguration;
use iRESTful\Routers\Infrastructure\Adapters\ConcreteJsonControllerResponseAdapter;
use iRESTful\EntityDatabases\Infrastructure\Factories\ComplexStrategyServiceFactory;


final class AuthenticatedCRUDConfiguration {
    private $objectConfiguration;
    private $entityApplicationConfiguration;
    public function __construct(array $server) {
        $this->objectConfiguration = new AuthenticatedCRUDObjectConfiguration($server);
        $this->entityApplicationConfiguration = new ConcreteEntityApplicationConfiguration($server, $this->objectConfiguration);
    }

    public function get() {
        $baseConfigs = $this->entityApplicationConfiguration->get();
        return array_merge_recursive([
            'rules' => $this->getControllerRules()
        ], $baseConfigs);
    }

    private function getControllerRules() {

                    return [];
            }

}
