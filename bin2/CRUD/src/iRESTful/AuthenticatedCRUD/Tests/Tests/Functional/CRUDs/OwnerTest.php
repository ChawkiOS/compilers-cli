<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class OwnerTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "53f14055-5568-4f69-87a6-844cfd898927",
        "created_on": 1488815423,
        "software": {
            "uuid": "ab0e8402-bb37-4bc1-9b73-3b79a56cf7d5",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": null
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "e58e87ea-99f8-44d2-95c8-f5d9ceb35035",
        "created_on": 1488815423,
        "software": {
            "uuid": "ab0e8402-bb37-4bc1-9b73-3b79a56cf7d5",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "f927f64c-701b-4469-a033-b24a10571ec2",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        }
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "4b2c2510-6683-4a9e-af89-0d41e5770f7c",
        "created_on": 1488815423,
        "software": {
            "uuid": "ab0e8402-bb37-4bc1-9b73-3b79a56cf7d5",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "36451ad0-cd3b-4c6a-9242-71afaeb05d88",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "002e8163-dfe4-488f-b86f-c5547b3f4157",
        "created_on": 1488815423,
        "software": {
            "uuid": "ab0e8402-bb37-4bc1-9b73-3b79a56cf7d5",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "2b3e76d4-2ae1-4316-83cf-6a2b61a75363",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "25a017c6-9c44-4978-8a7e-954fcb937108",
        "created_on": 1488815423,
        "software": {
            "uuid": "ab0e8402-bb37-4bc1-9b73-3b79a56cf7d5",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "ef8ea56e-333e-49e7-9b51-849c721fe391",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "af81f075-cfff-4640-9441-da2ed6850c23",
        "created_on": 1488815423,
        "software": {
            "uuid": "0854e4c8-8af9-4f62-bb75-217d3276524c",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": null
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "f4c97d94-c72d-447e-a5fb-90ea8896480a",
        "created_on": 1488815423,
        "software": {
            "uuid": "0854e4c8-8af9-4f62-bb75-217d3276524c",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "f927f64c-701b-4469-a033-b24a10571ec2",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        }
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "f4297cbe-6399-4a51-8d5c-9334319f1a17",
        "created_on": 1488815423,
        "software": {
            "uuid": "0854e4c8-8af9-4f62-bb75-217d3276524c",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "36451ad0-cd3b-4c6a-9242-71afaeb05d88",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "335f3efc-19ea-4b9d-9ed2-80067dbfcca7",
        "created_on": 1488815423,
        "software": {
            "uuid": "0854e4c8-8af9-4f62-bb75-217d3276524c",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "2b3e76d4-2ae1-4316-83cf-6a2b61a75363",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "04e4cd87-8440-42b8-b685-1a6a82fd5e08",
        "created_on": 1488815423,
        "software": {
            "uuid": "0854e4c8-8af9-4f62-bb75-217d3276524c",
            "created_on": 1488815423,
            "name": "my_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "ef8ea56e-333e-49e7-9b51-849c721fe391",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "ef90d40d-1704-429b-babe-29e72a36761c",
        "created_on": 1488815423,
        "software": {
            "uuid": "6df62026-46de-47b1-861a-640d91cae27d",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": null
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "871f9d91-d7a1-475d-b857-042cff9093fb",
        "created_on": 1488815423,
        "software": {
            "uuid": "6df62026-46de-47b1-861a-640d91cae27d",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "f927f64c-701b-4469-a033-b24a10571ec2",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        }
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "af61a8b6-ce41-43ff-ab29-9ca739f92856",
        "created_on": 1488815423,
        "software": {
            "uuid": "6df62026-46de-47b1-861a-640d91cae27d",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "36451ad0-cd3b-4c6a-9242-71afaeb05d88",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "6683bd5d-0a97-421f-b7e2-0f512dee6c38",
        "created_on": 1488815423,
        "software": {
            "uuid": "6df62026-46de-47b1-861a-640d91cae27d",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "2b3e76d4-2ae1-4316-83cf-6a2b61a75363",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "dcfea990-937d-43f7-b128-9cb8e906757c",
        "created_on": 1488815423,
        "software": {
            "uuid": "6df62026-46de-47b1-861a-640d91cae27d",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        },
        "user": {
            "uuid": "ef8ea56e-333e-49e7-9b51-849c721fe391",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "03ee5a78-c36f-44c6-a65a-767ecd1547d0",
        "created_on": 1488815423,
        "software": {
            "uuid": "6be94813-8651-41b9-a033-b09bda3992e6",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": null
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "24654b3e-ef48-420d-93e1-d55e4c085a30",
        "created_on": 1488815423,
        "software": {
            "uuid": "6be94813-8651-41b9-a033-b09bda3992e6",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "f927f64c-701b-4469-a033-b24a10571ec2",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": null
        }
    }
}', true),
                            json_decode('{
    "container": "owner",
    "data": {
        "uuid": "69bc551d-9b3f-4801-b736-3de54c668ddc",
        "created_on": 1488815423,
        "software": {
            "uuid": "6be94813-8651-41b9-a033-b09bda3992e6",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "36451ad0-cd3b-4c6a-9242-71afaeb05d88",
            "created_on": 1488815423,
            "name": "my_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "32e60d3b-4f2e-44c8-bc12-2fe8232eee7b",
        "created_on": 1488815423,
        "software": {
            "uuid": "6be94813-8651-41b9-a033-b09bda3992e6",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "2b3e76d4-2ae1-4316-83cf-6a2b61a75363",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
    "container": "owner",
    "data": {
        "uuid": "06abe4cc-59c1-42d5-b588-ba8c2cddc6ec",
        "created_on": 1488815423,
        "software": {
            "uuid": "6be94813-8651-41b9-a033-b09bda3992e6",
            "created_on": 1488815423,
            "name": "another_software_name",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "4b1786e6-c8be-479b-bf01-740783a5746a",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "13c2e0a1-1f5a-406d-9bd7-eb61367b0af7",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "a30e399a-c1f9-449c-9ef2-c6925d157581",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "434ba247-e177-49c7-bc5a-94d718b9173b",
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
        },
        "user": {
            "uuid": "ef8ea56e-333e-49e7-9b51-849c721fe391",
            "created_on": 1488815423,
            "name": "another_username",
            "credentials___username": "my_user_username",
            "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
            "roles": [
                {
                    "uuid": "c823bb09-356c-4b52-ab73-15166355e31c",
                    "created_on": 1488815423,
                    "title": "This is a role",
                    "description": "This is a role description.",
                    "permissions": null
                },
                {
                    "uuid": "1a88bb08-d8af-4f24-81d0-cbfd5c73663f",
                    "created_on": 1488815423,
                    "title": "This is an updated role",
                    "description": "This is an updated role description.",
                    "permissions": [
                        {
                            "uuid": "fe432bf2-7058-4241-bb15-4cf7391e8950",
                            "created_on": 1488815423,
                            "title": "This is just a title",
                            "description": "This is just a description",
                            "can_read": "1",
                            "can_write": "0",
                            "can_delete": "0"
                        },
                        {
                            "uuid": "56e3bd74-2322-4bca-becd-310302bfcecf",
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
