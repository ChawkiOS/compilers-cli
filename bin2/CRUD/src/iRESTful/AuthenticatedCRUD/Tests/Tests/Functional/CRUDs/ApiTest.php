<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class ApiTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "api",
    "data": {
        "uuid": "d11a5b9c-9295-4256-a3e0-2261da78c16c",
        "created_on": 1488815423,
        "base_url": "http:\/\/apis.irestful.com",
        "endpoints": null
    }
}', true),
                            json_decode('{
    "container": "api",
    "data": {
        "uuid": "8be49417-3d44-4d1c-b5f9-f76d77625831",
        "created_on": 1488815423,
        "base_url": "http:\/\/test.irestful.com",
        "endpoints": [
            {
                "uuid": "b3517c26-821c-4e75-b4d2-32bd453271b1",
                "created_on": 1488815423,
                "is_user_mandatory": "0",
                "pattern___specific_uri": "\/my\/value",
                "params": null
            },
            {
                "uuid": "ef2a181a-a58b-4bbf-ab19-f54798a3a22b",
                "created_on": 1488815423,
                "is_user_mandatory": "0",
                "pattern___regex_pattern": "[.]+",
                "params": [
                    {
                        "uuid": "3212384b-d751-456c-a514-522d2c328583",
                        "created_on": 1488815423,
                        "name": "my_second_param",
                        "is_mandatory": "1",
                        "pattern___regex_pattern": "[a-z0-9]+"
                    },
                    {
                        "uuid": "22991ffb-ca5c-4455-8007-e3cdeb437ee7",
                        "created_on": 1488815423,
                        "name": "my_second_param",
                        "is_mandatory": "1",
                        "pattern___specific_value": "my value"
                    },
                    {
                        "uuid": "abb23c05-97e6-4b51-992d-5ec5b92b3f4c",
                        "created_on": 1488815423,
                        "name": "my_param",
                        "is_mandatory": "0",
                        "pattern___regex_pattern": "[a-z0-9]+"
                    },
                    {
                        "uuid": "2f127c63-ddb3-4e17-9de8-bfb1f5f5a4f5",
                        "created_on": 1488815423,
                        "name": "my_param",
                        "is_mandatory": "0",
                        "pattern___specific_value": "my value"
                    }
                ]
            },
            {
                "uuid": "d78de3b9-772f-4165-9733-6e55c4cb6ca4",
                "created_on": 1488815423,
                "is_user_mandatory": "1",
                "pattern___specific_uri": "\/my\/value",
                "params": null
            },
            {
                "uuid": "e5e1b3dd-4eb0-4d27-a64a-ea8d097ed5ea",
                "created_on": 1488815423,
                "is_user_mandatory": "1",
                "pattern___regex_pattern": "[.]+",
                "params": null
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
