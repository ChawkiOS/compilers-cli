<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class EndpointTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "endpoint",
    "data": {
        "uuid": "6e7668dd-534a-4fc6-bf89-86049cb5cad6",
        "created_on": 1488815423,
        "is_user_mandatory": "0",
        "pattern___specific_uri": "\/my\/value",
        "params": null
    }
}', true),
                            json_decode('{
    "container": "endpoint",
    "data": {
        "uuid": "7fe0e127-a958-48b9-a089-0dbb051a5cf2",
        "created_on": 1488815423,
        "is_user_mandatory": "0",
        "pattern___regex_pattern": "[.]+",
        "params": [
            {
                "uuid": "84ebce5e-d84c-4a77-b04d-128e22750f03",
                "created_on": 1488815423,
                "name": "my_second_param",
                "is_mandatory": "1",
                "pattern___regex_pattern": "[a-z0-9]+"
            },
            {
                "uuid": "0c661df1-b68c-4be6-b3f4-4b16b82703e9",
                "created_on": 1488815423,
                "name": "my_second_param",
                "is_mandatory": "1",
                "pattern___specific_value": "my value"
            },
            {
                "uuid": "59677997-c7be-4b5e-a4b1-78faa7e790f0",
                "created_on": 1488815423,
                "name": "my_param",
                "is_mandatory": "0",
                "pattern___regex_pattern": "[a-z0-9]+"
            },
            {
                "uuid": "016087e3-193e-49fd-8454-6e5b14a777d2",
                "created_on": 1488815423,
                "name": "my_param",
                "is_mandatory": "0",
                "pattern___specific_value": "my value"
            }
        ]
    }
}', true),
                            json_decode('{
    "container": "endpoint",
    "data": {
        "uuid": "3f903b34-7656-49c0-9e21-dc017e8a0034",
        "created_on": 1488815423,
        "is_user_mandatory": "1",
        "pattern___specific_uri": "\/my\/value",
        "params": null
    }
}', true),
                            json_decode('{
    "container": "endpoint",
    "data": {
        "uuid": "d6177b80-2681-4844-a09f-1184609197b5",
        "created_on": 1488815423,
        "is_user_mandatory": "1",
        "pattern___regex_pattern": "[.]+",
        "params": [
            {
                "uuid": "84ebce5e-d84c-4a77-b04d-128e22750f03",
                "created_on": 1488815423,
                "name": "my_second_param",
                "is_mandatory": "1",
                "pattern___regex_pattern": "[a-z0-9]+"
            },
            {
                "uuid": "0c661df1-b68c-4be6-b3f4-4b16b82703e9",
                "created_on": 1488815423,
                "name": "my_second_param",
                "is_mandatory": "1",
                "pattern___specific_value": "my value"
            },
            {
                "uuid": "59677997-c7be-4b5e-a4b1-78faa7e790f0",
                "created_on": 1488815423,
                "name": "my_param",
                "is_mandatory": "0",
                "pattern___regex_pattern": "[a-z0-9]+"
            },
            {
                "uuid": "016087e3-193e-49fd-8454-6e5b14a777d2",
                "created_on": 1488815423,
                "name": "my_param",
                "is_mandatory": "0",
                "pattern___specific_value": "my value"
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
