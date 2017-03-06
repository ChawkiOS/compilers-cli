<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class RoleTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
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
