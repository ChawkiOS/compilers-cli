<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class ParamsTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
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
