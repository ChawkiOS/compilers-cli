<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class EndpointTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
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
