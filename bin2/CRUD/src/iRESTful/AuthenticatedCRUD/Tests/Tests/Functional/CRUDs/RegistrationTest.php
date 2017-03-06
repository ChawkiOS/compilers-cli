<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class RegistrationTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "registration",
    "data": {
        "uuid": "907ccf79-e5cb-4e6f-a345-c9db517eefb6",
        "created_on": 1488815423,
        "keyname": "another_registration",
        "title": "This is a another registration",
        "description": "This is the description of the another registration",
        "roles": null
    }
}', true),
                            json_decode('{
    "container": "registration",
    "data": {
        "uuid": "299cf694-952c-4082-8ebe-ab53e333c423",
        "created_on": 1488815423,
        "keyname": "another_keyname",
        "title": "This is a another keyname",
        "description": "This is the description of the another keyname",
        "roles": [
            {
                "uuid": "21cd2ac8-91eb-4cc6-bb3e-d90695f02d43",
                "created_on": 1488815423,
                "title": "This is a role",
                "description": "This is a role description.",
                "permissions": null
            },
            {
                "uuid": "f631df71-2242-4c55-8f2a-7e9885600925",
                "created_on": 1488815423,
                "title": "This is an updated role",
                "description": "This is an updated role description.",
                "permissions": [
                    {
                        "uuid": "73ce3eed-c81d-44ee-be1d-d1fcb25e41c1",
                        "created_on": 1488815423,
                        "title": "This is just a title",
                        "description": "This is just a description",
                        "can_read": "1",
                        "can_write": "0",
                        "can_delete": "0"
                    },
                    {
                        "uuid": "9b991264-f843-4eb0-8ce9-60dd5c7482a3",
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
