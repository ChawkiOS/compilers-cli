<?php
namespace iRESTful\Authenticated\Infrastructure\Applications;
use iRESTful\Authenticated\Infrastructure\Configurations\AuthenticatedConfiguration;
use iRESTful\Routers\Infrastructure\Factories\ConcreteApplicationFactory;

final class AuthenticatedApplication {
    public function __construct(array $server, array $queryParameters, array $requestParameters) {
        $configs = new AuthenticatedConfiguration($server);
        $factory = new ConcreteApplicationFactory($configs->get());
        $factory->create()->execute([
            'server' => $server,
            'query_parameters' => $queryParameters,
            'request_parameters' => $requestParameters
        ]);
    }
}
