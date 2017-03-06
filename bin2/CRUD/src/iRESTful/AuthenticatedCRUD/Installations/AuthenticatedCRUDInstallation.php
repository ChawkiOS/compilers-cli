<?php
namespace iRESTful\AuthenticatedCRUD\Installations;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\PDOEntities\Infrastructure\Installations\Database as EngineDatabase;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionClassSchemaAdapterFactory;
use iRESTful\PDO\PDODatabases\Infrastructure\Factories\PDOSchemaAdapterFactory;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;
use iRESTful\EntityDatabases\Infrastructure\Factories\ComplexStrategyServiceFactory;

final class AuthenticatedCRUDInstallation {

    public static function install() {

        $objectConfiguration = new AuthenticatedCRUDObjectConfiguration();
        $containerClassMapper = $objectConfiguration->getContainerClassMapper();
        $interfaceClassMapper = $objectConfiguration->getInterfaceClassMapper();
        $transformerObjects = $objectConfiguration->getTransformerObjects();
        $fieldDelimiter = $objectConfiguration->getDelimiter();

                    $nativePDOs = EngineDatabase::reset($objectConfiguration);

            $engine = 'InnoDB';
            $schemaAdapterFactory = new ReflectionClassSchemaAdapterFactory($containerClassMapper, $interfaceClassMapper, $engine, $fieldDelimiter);
            $pdoSchemaAdapterFactory = new PDOSchemaAdapterFactory($fieldDelimiter);

            foreach($nativePDOs as $oneNativePDO) {

                $connector = $oneNativePDO->getConnector();
                $databaseName = $connector->getDatabaseName();

                $schema = $schemaAdapterFactory->create()->fromDataToSchema([
                    'name' => $databaseName,
                    'container_names' => array_keys($containerClassMapper)
                ]);

                $queries = $pdoSchemaAdapterFactory->create()->fromSchemaToSQLQueries($schema);
                foreach($queries as $oneQuery) {
                    EngineDatabase::execute($oneQuery);
                }
            }
        
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
                    return json_decode('[
    {
        "container": "software",
        "data": {
            "name": "admin",
            "credentials": {
                "username": "admin",
                "hashed_password": "$2y$10$UqvqAbFlpVoAMpiVx4h7aedYBRRYJQLn4LAllgOIH2b8.6blkgvzC"
            },
            "roles": [
                {
                    "title": "Root",
                    "description": "The root role can access everything.",
                    "permissions": [
                        {
                            "title": "Read, Write and Delete objects.",
                            "description": "This permission enables a user to read, write and delete objects.",
                            "can_read": "1",
                            "can_write": "1",
                            "can_delete": "1",
                            "uuid": "9c313265-9970-4f5d-86ec-59ae4a68088b",
                            "created_on": 1488815423
                        }
                    ],
                    "uuid": "c94d4882-eb88-450f-a9a9-6a69fa209a78",
                    "created_on": 1488815423
                }
            ],
            "uuid": "ec99c436-c8e0-498f-bbb0-3b5ff38690c9",
            "created_on": 1488815423
        }
    },
    {
        "container": "user",
        "data": {
            "name": "root",
            "credentials": {
                "username": "root",
                "hashed_password": "$2y$10$UqvqAbFlpVoAMpiVx4h7aedYBRRYJQLn4LAllgOIH2b8.6blkgvzC"
            },
            "roles": [
                {
                    "title": "Root",
                    "description": "The root role can access everything.",
                    "permissions": [
                        {
                            "title": "Read, Write and Delete objects.",
                            "description": "This permission enables a user to read, write and delete objects.",
                            "can_read": "1",
                            "can_write": "1",
                            "can_delete": "1",
                            "uuid": "9c313265-9970-4f5d-86ec-59ae4a68088b",
                            "created_on": 1488815423
                        }
                    ],
                    "uuid": "c94d4882-eb88-450f-a9a9-6a69fa209a78",
                    "created_on": 1488815423
                }
            ],
            "uuid": "4f6527b5-5872-49c5-9cae-4f819073ccd0",
            "created_on": 1488815423
        }
    }
]', true);
            }

}
