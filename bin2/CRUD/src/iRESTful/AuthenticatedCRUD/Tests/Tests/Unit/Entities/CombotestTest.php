<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Unit\Entities;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\Libraries\MetaDatas\Infrastructure\Factories\ReflectionObjectAdapterFactory;

final class CombotestTest extends \PHPUnit_Framework_TestCase {
    private $objectAdapter;
    private $data;
    public function setUp() {
        $configs = new AuthenticatedCRUDObjectConfiguration();

        $this->data = [
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "68356a51-6dc2-48b5-9b24-2c976e528865",
        "created_on": 1488815423,
        "api": null,
        "endpoint": null,
        "registration": {
            "uuid": "eb0ac51e-8253-430c-b97c-4a96678971cd",
            "created_on": 1488815423,
            "keyname": "another_registration",
            "title": "This is a another registration",
            "description": "This is the description of the another registration",
            "roles": null
        }
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "97f3134e-0f7c-440d-85c5-091adc2220af",
        "created_on": 1488815423,
        "api": null,
        "endpoint": null,
        "registration": {
            "uuid": "220e6f6c-70c3-44aa-b70e-3eb5267533d2",
            "created_on": 1488815423,
            "keyname": "another_keyname",
            "title": "This is a another keyname",
            "description": "This is the description of the another keyname",
            "roles": [
                {
                    "uuid": "ee8be88e-1fa0-40f2-8f9a-17b367d7148f",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "de376989-cc5e-4628-8d3d-bef773b5755a",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a6c5ff4d-6ac4-4338-9f78-2aa936b77886",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "78c56bf0-d75e-4dc9-b7cf-7a03a61b8fe6",
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
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "97bbcffc-a55f-48a7-97eb-c164eb61ed09",
        "created_on": 1488815423,
        "api": {
            "uuid": "15737f5e-a9a3-46f1-ad73-c6c98588decd",
            "created_on": 1488815423,
            "base_url": "http:\/\/apis.irestful.com",
            "endpoints": null
        },
        "endpoint": null,
        "registration": null
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "36ddaf09-201b-4bb9-8312-acdc52a8b84d",
        "created_on": 1488815423,
        "api": {
            "uuid": "b5d2510a-f3d4-420d-86ca-3860b1260801",
            "created_on": 1488815423,
            "base_url": "http:\/\/test.irestful.com",
            "endpoints": [
                {
                    "uuid": "9e6d8524-2213-485a-b1ea-3ea39efff595",
                    "created_on": 1488815423,
                    "is_user_mandatory": "0",
                    "pattern___specific_uri": "\/my\/value",
                    "params": null
                },
                {
                    "uuid": "6ca91114-e336-492c-a192-9f821c19f41e",
                    "created_on": 1488815423,
                    "is_user_mandatory": "0",
                    "pattern___regex_pattern": "[.]+",
                    "params": [
                        {
                            "uuid": "5a6c196b-a671-44a5-8452-04eea0692abc",
                            "created_on": 1488815423,
                            "name": "my_second_param",
                            "is_mandatory": "1",
                            "pattern___regex_pattern": "[a-z0-9]+"
                        },
                        {
                            "uuid": "71e145d0-ceca-4132-a072-1dfe35d97724",
                            "created_on": 1488815423,
                            "name": "my_second_param",
                            "is_mandatory": "1",
                            "pattern___specific_value": "my value"
                        },
                        {
                            "uuid": "09c8cda9-e5b6-47f9-8fbf-2c0e502b1645",
                            "created_on": 1488815423,
                            "name": "my_param",
                            "is_mandatory": "0",
                            "pattern___regex_pattern": "[a-z0-9]+"
                        },
                        {
                            "uuid": "40eb7859-b9e1-48a6-b680-23a90f61d3b1",
                            "created_on": 1488815423,
                            "name": "my_param",
                            "is_mandatory": "0",
                            "pattern___specific_value": "my value"
                        }
                    ]
                },
                {
                    "uuid": "57d554da-d382-4674-8608-7107c053e236",
                    "created_on": 1488815423,
                    "is_user_mandatory": "1",
                    "pattern___specific_uri": "\/my\/value",
                    "params": [
                        {
                            "uuid": "5a6c196b-a671-44a5-8452-04eea0692abc",
                            "created_on": 1488815423,
                            "name": "my_second_param",
                            "is_mandatory": "1",
                            "pattern___regex_pattern": "[a-z0-9]+"
                        },
                        {
                            "uuid": "71e145d0-ceca-4132-a072-1dfe35d97724",
                            "created_on": 1488815423,
                            "name": "my_second_param",
                            "is_mandatory": "1",
                            "pattern___specific_value": "my value"
                        },
                        {
                            "uuid": "09c8cda9-e5b6-47f9-8fbf-2c0e502b1645",
                            "created_on": 1488815423,
                            "name": "my_param",
                            "is_mandatory": "0",
                            "pattern___regex_pattern": "[a-z0-9]+"
                        },
                        {
                            "uuid": "40eb7859-b9e1-48a6-b680-23a90f61d3b1",
                            "created_on": 1488815423,
                            "name": "my_param",
                            "is_mandatory": "0",
                            "pattern___specific_value": "my value"
                        }
                    ]
                },
                {
                    "uuid": "bc514c3d-7f28-4a51-a8cd-78ec16db4463",
                    "created_on": 1488815423,
                    "is_user_mandatory": "1",
                    "pattern___regex_pattern": "[.]+",
                    "params": null
                }
            ]
        },
        "endpoint": null,
        "registration": null
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "e9142d2d-5753-4a5b-b50c-d035f302185f",
        "created_on": 1488815423,
        "api": null,
        "endpoint": {
            "uuid": "c7d640a8-5cb4-47d0-9971-5f5940bd0ec6",
            "created_on": 1488815423,
            "is_user_mandatory": "0",
            "pattern___specific_uri": "\/my\/value",
            "params": null
        },
        "registration": null
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "f7838308-03f3-4130-9799-120f568f022f",
        "created_on": 1488815423,
        "api": null,
        "endpoint": {
            "uuid": "bab6109f-7864-46ed-9028-e0f85f3bfa1d",
            "created_on": 1488815423,
            "is_user_mandatory": "0",
            "pattern___regex_pattern": "[.]+",
            "params": [
                {
                    "uuid": "3a223776-d49e-4ac6-87a4-23105dc36101",
                    "created_on": 1488815423,
                    "name": "my_second_param",
                    "is_mandatory": "1",
                    "pattern___regex_pattern": "[a-z0-9]+"
                },
                {
                    "uuid": "400af0b1-4eb5-4648-a7b6-884ebb1ac1bd",
                    "created_on": 1488815423,
                    "name": "my_second_param",
                    "is_mandatory": "1",
                    "pattern___specific_value": "my value"
                },
                {
                    "uuid": "00b012f2-965c-4dce-8b0e-12eaf156fefe",
                    "created_on": 1488815423,
                    "name": "my_param",
                    "is_mandatory": "0",
                    "pattern___regex_pattern": "[a-z0-9]+"
                },
                {
                    "uuid": "644d5b0b-248e-4502-95d6-2a1429c1af28",
                    "created_on": 1488815423,
                    "name": "my_param",
                    "is_mandatory": "0",
                    "pattern___specific_value": "my value"
                }
            ]
        },
        "registration": null
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "46774b83-ed35-4b77-8ae9-79fd8a485237",
        "created_on": 1488815423,
        "api": null,
        "endpoint": {
            "uuid": "cf31c141-ce1f-4222-9c64-06b98cb32222",
            "created_on": 1488815423,
            "is_user_mandatory": "1",
            "pattern___specific_uri": "\/my\/value",
            "params": [
                {
                    "uuid": "3a223776-d49e-4ac6-87a4-23105dc36101",
                    "created_on": 1488815423,
                    "name": "my_second_param",
                    "is_mandatory": "1",
                    "pattern___regex_pattern": "[a-z0-9]+"
                },
                {
                    "uuid": "400af0b1-4eb5-4648-a7b6-884ebb1ac1bd",
                    "created_on": 1488815423,
                    "name": "my_second_param",
                    "is_mandatory": "1",
                    "pattern___specific_value": "my value"
                },
                {
                    "uuid": "00b012f2-965c-4dce-8b0e-12eaf156fefe",
                    "created_on": 1488815423,
                    "name": "my_param",
                    "is_mandatory": "0",
                    "pattern___regex_pattern": "[a-z0-9]+"
                },
                {
                    "uuid": "644d5b0b-248e-4502-95d6-2a1429c1af28",
                    "created_on": 1488815423,
                    "name": "my_param",
                    "is_mandatory": "0",
                    "pattern___specific_value": "my value"
                }
            ]
        },
        "registration": null
    }
}', true),
                            json_decode('{
    "container": "combotest",
    "data": {
        "uuid": "d06673e4-d2d3-45b1-ada2-47732facba9e",
        "created_on": 1488815423,
        "api": null,
        "endpoint": {
            "uuid": "d75ad331-7af4-4a82-9136-a085ebb9eadd",
            "created_on": 1488815423,
            "is_user_mandatory": "1",
            "pattern___regex_pattern": "[.]+",
            "params": [
                {
                    "uuid": "3a223776-d49e-4ac6-87a4-23105dc36101",
                    "created_on": 1488815423,
                    "name": "my_second_param",
                    "is_mandatory": "1",
                    "pattern___regex_pattern": "[a-z0-9]+"
                },
                {
                    "uuid": "400af0b1-4eb5-4648-a7b6-884ebb1ac1bd",
                    "created_on": 1488815423,
                    "name": "my_second_param",
                    "is_mandatory": "1",
                    "pattern___specific_value": "my value"
                },
                {
                    "uuid": "00b012f2-965c-4dce-8b0e-12eaf156fefe",
                    "created_on": 1488815423,
                    "name": "my_param",
                    "is_mandatory": "0",
                    "pattern___regex_pattern": "[a-z0-9]+"
                },
                {
                    "uuid": "644d5b0b-248e-4502-95d6-2a1429c1af28",
                    "created_on": 1488815423,
                    "name": "my_param",
                    "is_mandatory": "0",
                    "pattern___specific_value": "my value"
                }
            ]
        },
        "registration": null
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
            public function testConvert_Sample4_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[4]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[4]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
            public function testConvert_Sample5_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[5]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[5]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
            public function testConvert_Sample6_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[6]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[6]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
            public function testConvert_Sample7_Success() {
            $firstObject = $this->objectAdapter->fromDataToObject($this->data[7]);
            $objectData = $this->objectAdapter->fromObjectToData($firstObject, true);
            $secondObject = $this->objectAdapter->fromDataToObject([
                'container' => $this->data[7]['container'],
                'data' => $objectData
            ]);

            $this->assertEquals($firstObject, $secondObject);
        }
    }
