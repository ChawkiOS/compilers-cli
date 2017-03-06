<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class SoftwareTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
                            json_decode('{
    "container": "software",
    "data": {
        "uuid": "674cde72-4218-4397-80bf-0f9e05db547b",
        "created_on": 1488815423,
        "name": "my_software_name",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": null
    }
}', true),
                            json_decode('{
    "container": "software",
    "data": {
        "uuid": "15de4cd4-a3c9-4399-a218-17aba4207913",
        "created_on": 1488815423,
        "name": "my_software_name",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": [
            {
                "uuid": "100a020f-b9ac-45a1-859c-8297d88e7d5e",
                "created_on": 1488815423,
                "title": "This is a role",
                "description": "This is a role description.",
                "permissions": null
            },
            {
                "uuid": "fe43408c-816a-4cb5-9924-ad1d4012bb3b",
                "created_on": 1488815423,
                "title": "This is an updated role",
                "description": "This is an updated role description.",
                "permissions": [
                    {
                        "uuid": "fa4b1e04-fe70-4e55-9204-b568256b9cab",
                        "created_on": 1488815423,
                        "title": "This is just a title",
                        "description": "This is just a description",
                        "can_read": "1",
                        "can_write": "0",
                        "can_delete": "0"
                    },
                    {
                        "uuid": "4e55cc01-b631-4dac-b981-f1bf93c69eba",
                        "created_on": 1488815423,
                        "title": "This is just an updated title",
                        "description": "This is just an updated description",
                        "can_read": "0",
                        "can_write": "1",
                        "can_delete": "1"
                    }
                ]
            }
        ]
    }
}', true),
                            json_decode('{
    "container": "software",
    "data": {
        "uuid": "4dda46b9-c61d-4122-aef3-7f781b06864c",
        "created_on": 1488815423,
        "name": "another_software_name",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": null
    }
}', true),
                            json_decode('{
    "container": "software",
    "data": {
        "uuid": "ee5797c7-afcf-4b8b-99d7-f033c50402ee",
        "created_on": 1488815423,
        "name": "another_software_name",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": null
    }
}', true)
                    ];

        $objectAdapterFactory = new ReflectionObjectAdapterFactory(
            $configs->getTransformerObjects(),
            $configs->getContainerClassMapper(),
            $configs->getInterfaceClassMapper(),
            $configs->getDelimiter()
        );

        $this->objectAdapter = $objectAdapterFactory->create();
    }

    public function tearDown() {
        $this->helpers = null;
    }

    public function testConvert_Samples_Success() {
        $firstObjects = $this->objectAdapter->fromDataToObjects($this->data);
        $objectsData = $this->objectAdapter->fromObjectsToData($firstObjects, true);

        $secondData = [];
        foreach($objectsData as $index => $oneData) {
            $secondData[$index] = [
                'container' => $this->data[$index]['container'],
                'data' => $oneData
            ];
        }

        $secondObjects = $this->objectAdapter->fromDataToObjects($secondData);

        $this->assertEquals($firstObjects, $secondObjects);
    }

            public function testConvert_Sample0_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[0]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[0]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
            public function testConvert_Sample1_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[1]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[1]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
            public function testConvert_Sample2_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[2]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[2]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
            public function testConvert_Sample3_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[3]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[3]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
    }
