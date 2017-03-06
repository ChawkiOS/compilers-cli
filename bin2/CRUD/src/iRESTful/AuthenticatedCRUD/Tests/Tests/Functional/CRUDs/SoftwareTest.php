<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class SoftwareTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
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
