<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Applications;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDConfiguration;
use iRESTful\Routers\Infrastructure\Factories\ConcreteApplicationFactory;

final class AuthenticatedCRUDApplication {
    public function __construct(array $server, array $queryParameters, array $requestParameters) {
        $configs = new AuthenticatedCRUDConfiguration($server);
        $factory = new ConcreteApplicationFactory($configs->get());
        $factory->create()->execute([
            'server' => $server,
            'query_parameters' => $queryParameters,
            'request_parameters' => $requestParameters
        ]);
    }
}
