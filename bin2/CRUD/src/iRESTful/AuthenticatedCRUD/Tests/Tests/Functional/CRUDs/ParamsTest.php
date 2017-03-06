<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class ParamsTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "params",
    "data": {
        "uuid": "bf6f8513-7e5b-4a85-a571-d67c87a11325",
        "created_on": 1488815423,
        "name": "my_second_param",
        "is_mandatory": "1",
        "pattern___regex_pattern": "[a-z0-9]+"
    }
}', true),
                            json_decode('{
    "container": "params",
    "data": {
        "uuid": "8190bb00-66f9-4e42-bfc6-632b6d9c6cd0",
        "created_on": 1488815423,
        "name": "my_second_param",
        "is_mandatory": "1",
        "pattern___specific_value": "my value"
    }
}', true),
                            json_decode('{
    "container": "params",
    "data": {
        "uuid": "fb71a6f8-35ec-460f-9003-28dcc6dd736f",
        "created_on": 1488815423,
        "name": "my_param",
        "is_mandatory": "0",
        "pattern___regex_pattern": "[a-z0-9]+"
    }
}', true),
                            json_decode('{
    "container": "params",
    "data": {
        "uuid": "d1dfff24-39e8-46b5-ac27-0ad841829e67",
        "created_on": 1488815423,
        "name": "my_param",
        "is_mandatory": "0",
        "pattern___specific_value": "my value"
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
