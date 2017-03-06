<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class UserTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
                            json_decode('{
    "container": "user",
    "data": {
        "uuid": "c1b001eb-c043-4f2d-8a96-c1668e323335",
        "created_on": 1488815423,
        "name": "my_username",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": null
    }
}', true),
                            json_decode('{
    "container": "user",
    "data": {
        "uuid": "38a8758a-9fae-479b-b0d6-478e82fd101a",
        "created_on": 1488815423,
        "name": "my_username",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": [
            {
                "uuid": "197e2bbf-7e22-436e-b4fb-b93ea5f2b910",
                "created_on": 1488815423,
                "title": "This is a role",
                "description": "This is a role description.",
                "permissions": null
            },
            {
                "uuid": "ca369bb9-5ebe-4c48-8a52-e9144f6adbdd",
                "created_on": 1488815423,
                "title": "This is an updated role",
                "description": "This is an updated role description.",
                "permissions": [
                    {
                        "uuid": "123c5c67-389f-456e-b5d0-dcb389557cb0",
                        "created_on": 1488815423,
                        "title": "This is just a title",
                        "description": "This is just a description",
                        "can_read": "1",
                        "can_write": "0",
                        "can_delete": "0"
                    },
                    {
                        "uuid": "2f7f4e3a-3051-4221-8b6b-2f7f5d38d2f6",
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
    "container": "user",
    "data": {
        "uuid": "f61c7287-a904-4c96-8354-00310688a9ff",
        "created_on": 1488815423,
        "name": "another_username",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": null
    }
}', true),
                            json_decode('{
    "container": "user",
    "data": {
        "uuid": "0adfa28e-cdd8-4909-8fdd-f4a7c42e0001",
        "created_on": 1488815423,
        "name": "another_username",
        "credentials___username": "my_user_username",
        "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
        "roles": [
            {
                "uuid": "197e2bbf-7e22-436e-b4fb-b93ea5f2b910",
                "created_on": 1488815423,
                "title": "This is a role",
                "description": "This is a role description.",
                "permissions": null
            },
            {
                "uuid": "ca369bb9-5ebe-4c48-8a52-e9144f6adbdd",
                "created_on": 1488815423,
                "title": "This is an updated role",
                "description": "This is an updated role description.",
                "permissions": [
                    {
                        "uuid": "123c5c67-389f-456e-b5d0-dcb389557cb0",
                        "created_on": 1488815423,
                        "title": "This is just a title",
                        "description": "This is just a description",
                        "can_read": "1",
                        "can_write": "0",
                        "can_delete": "0"
                    },
                    {
                        "uuid": "2f7f4e3a-3051-4221-8b6b-2f7f5d38d2f6",
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
