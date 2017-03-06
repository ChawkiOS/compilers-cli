<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class ApiTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
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
    }
