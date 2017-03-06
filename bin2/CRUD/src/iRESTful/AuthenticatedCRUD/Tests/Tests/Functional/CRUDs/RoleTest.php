<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class RoleTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "role",
    "data": {
        "uuid": "4a51f318-e09e-4d3d-87a0-328bffc90a5f",
        "created_on": 1488815423,
        "title": "This is a role",
        "description": "This is a role description.",
        "permissions": null
    }
}', true),
                            json_decode('{
    "container": "role",
    "data": {
        "uuid": "d7eaeb5b-7224-4e34-ad2d-31135d57ad9a",
        "created_on": 1488815423,
        "title": "This is an updated role",
        "description": "This is an updated role description.",
        "permissions": [
            {
                "uuid": "6231f5af-49a4-46e4-83d8-349983a62356",
                "created_on": 1488815423,
                "title": "This is just a title",
                "description": "This is just a description",
                "can_read": "1",
                "can_write": "0",
                "can_delete": "0"
            },
            {
                "uuid": "e81f32a1-1f6c-4fb3-820f-8ed0031925fa",
                "created_on": 1488815423,
                "title": "This is just an updated title",
                "description": "This is just an updated description",
                "can_read": "0",
                "can_write": "1",
                "can_delete": "1"
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
