<?php
namespace iRESTful\Authenticated\Installations;
use iRESTful\Authenticated\Infrastructure\Configurations\AuthenticatedObjectConfiguration;
use iRESTful\PDOEntities\Infrastructure\Installations\Database as EngineDatabase;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionClassSchemaAdapterFactory;
use iRESTful\PDO\PDODatabases\Infrastructure\Factories\PDOSchemaAdapterFactory;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;
use iRESTful\EntityDatabases\Infrastructure\Factories\ComplexStrategyServiceFactory;

final class AuthenticatedInstallation {

    public static function install() {

        $objectConfiguration = new AuthenticatedObjectConfiguration();
        $containerClassMapper = $objectConfiguration->getContainerClassMapper();
        $interfaceClassMapper = $objectConfiguration->getInterfaceClassMapper();
        $transformerObjects = $objectConfiguration->getTransformerObjects();
        $fieldDelimiter = $objectConfiguration->getDelimiter();

        
        $data = self::getData();
        if (!empty($data)) {

            $serviceFactory = new ComplexStrategyServiceFactory($objectConfiguration, $_SERVER);
            $entitySetService = $serviceFactory->create()->getService()->getEntitySet();
            $objectAdapterFactory = new ReflectionObjectAdapterFactory(
                $transformerObjects,
                $containerClassMapper,
                $interfaceClassMapper,
                $fieldDelimiter
            );

            $objects = $objectAdapterFactory->create()->fromDataToObjects($data);
            $entitySetService->insert($objects);
        }

    }

    private static function getData() {
                    return null;
            }

}
