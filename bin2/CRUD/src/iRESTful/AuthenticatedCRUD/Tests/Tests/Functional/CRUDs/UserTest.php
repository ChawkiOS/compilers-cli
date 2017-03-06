<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class UserTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
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

        if (count($allData) < 2) {
            throw new \Exception('The CRUD tests must have at least 2 samples of data.');
        }

        $objectConfigurations = new AuthenticatedCRUDObjectConfiguration();
        $entityHttpConfiguration = new ConcreteEntityHttpConfiguration('http', '127.0.0.1', 80, $objectConfigurations);

        $this->crudHelpers = [];
        foreach($allData as $index => $oneSample) {
            $nextIndex = $index + 1;
            $nextIndex = isset($allData[$nextIndex]) ? $nextIndex : 0;
            $allData[$nextIndex]['data']['uuid'] = $allData[$index]['data']['uuid']; //Quick hack: The updates will work only if both data have the same uuid.  Fix this in the CRUDHelper later.
            $this->crudHelpers[] = new CRUDHelper($this, $entityHttpConfiguration, $allData[$index], $allData[$nextIndex]);
        }



    }

    public function tearDown() {

    }

    public function testRun_Success() {
        foreach($this->crudHelpers as $oneCrudHelper) {
            $oneCrudHelper->execute();
            $this->tearDown();
        }
    }

    public function testRunSet_Success() {
        foreach($this->crudHelpers as $oneCrudHelper) {
            $oneCrudHelper->executeSet();
            $this->tearDown();
        }
    }

}
