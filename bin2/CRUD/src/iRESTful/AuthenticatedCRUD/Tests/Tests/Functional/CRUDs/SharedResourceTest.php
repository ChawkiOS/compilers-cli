<?php
namespace iRESTful\AuthenticatedCRUD\Tests\Tests\Functional\CRUDs;
use iRESTful\AuthenticatedCRUD\Infrastructure\Configurations\AuthenticatedCRUDObjectConfiguration;
use iRESTful\CrudAPIs\Tests\Helpers\CRUDHelper;
use iRESTful\HttpEntities\Infrastructure\Objects\ConcreteEntityHttpConfiguration;

final class SharedResourceTest extends \PHPUnit_Framework_TestCase {
    private $crudHelpers;
    public function setUp() {

        $allData = [
                            json_decode('{
    "container": "shared_resource",
    "data": {
        "uuid": "489498f5-f8b8-428b-837d-02c1789fba9f",
        "created_on": 1488815423,
        "owners": null,
        "permissions": null
    }
}', true),
                            json_decode('{
    "container": "shared_resource",
    "data": {
        "uuid": "77f5303a-83f8-4da2-a2eb-c30db7590036",
        "created_on": 1488815423,
        "owners": [
            {
                "uuid": "1bfb5024-0dd2-489a-aab7-f0c45f52f0a9",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": null
            },
            {
                "uuid": "db0c87b2-61e1-49e4-a934-4c2e154d50f9",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "86482d0e-46aa-495f-9b49-0ced309d6f3d",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "ef6c2511-fd1c-427c-897c-6ffc8c03acb0",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "9b47c35c-fad2-4132-b4a6-3a68daab6aaa",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "59097eb4-6090-483a-b7b3-744df6590d98",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
            },
            {
                "uuid": "7eab26f2-f28e-4745-a352-65d910c3fff1",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "880721ff-38b7-4497-a60a-fc532a3d7687",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "623105f1-20c1-4d3f-a098-f584ceb83e7d",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "568e378e-cbf6-472d-a263-fb78c6573b82",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "c8614a67-c495-43de-804f-26e14a88e129",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": null
            },
            {
                "uuid": "a5d63b4c-fe06-48aa-bfb7-4737db3f47c8",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "147b6b50-d7c5-4092-b9bc-c1c35be4178b",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "7f2a2d9a-0690-469d-8026-57d59dfda5f9",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "c4547e0b-c147-4810-b3e5-a443d1dc44f1",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "ad3c2e4d-54bc-4764-859f-af4b031bd46f",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": null
            },
            {
                "uuid": "261d9eb3-4d9b-48e0-8e15-07871ac8ce25",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "d4063d7f-e38e-44b8-9c8b-6c9266b6721e",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "267df24f-5250-4f3a-a93a-dba6b64c36d4",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "d1312031-3484-4004-a4c4-bf2d77d4b15f",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
        ],
        "permissions": null
    }
}', true),
                            json_decode('{
    "container": "shared_resource",
    "data": {
        "uuid": "c95f7836-23de-47a5-abb7-0339e50ab55f",
        "created_on": 1488815423,
        "owners": null,
        "permissions": [
            {
                "uuid": "749b9057-e8c6-48b1-9a66-27a8875eebe5",
                "created_on": 1488815423,
                "title": "This is just a title",
                "description": "This is just a description",
                "can_read": "1",
                "can_write": "0",
                "can_delete": "0"
            },
            {
                "uuid": "e7bc651b-f547-4e63-873e-6baf58f870e9",
                "created_on": 1488815423,
                "title": "This is just an updated title",
                "description": "This is just an updated description",
                "can_read": "0",
                "can_write": "1",
                "can_delete": "1"
            }
        ]
    }
}', true),
                            json_decode('{
    "container": "shared_resource",
    "data": {
        "uuid": "bfa64e27-8236-4ed0-8d3b-da7adb995616",
        "created_on": 1488815423,
        "owners": [
            {
                "uuid": "1bfb5024-0dd2-489a-aab7-f0c45f52f0a9",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": null
            },
            {
                "uuid": "db0c87b2-61e1-49e4-a934-4c2e154d50f9",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "86482d0e-46aa-495f-9b49-0ced309d6f3d",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "ef6c2511-fd1c-427c-897c-6ffc8c03acb0",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "9b47c35c-fad2-4132-b4a6-3a68daab6aaa",
                "created_on": 1488815423,
                "software": {
                    "uuid": "93a54cbc-3700-4d4c-83d9-889f762d33b5",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "59097eb4-6090-483a-b7b3-744df6590d98",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
            },
            {
                "uuid": "7eab26f2-f28e-4745-a352-65d910c3fff1",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "880721ff-38b7-4497-a60a-fc532a3d7687",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "623105f1-20c1-4d3f-a098-f584ceb83e7d",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "568e378e-cbf6-472d-a263-fb78c6573b82",
                "created_on": 1488815423,
                "software": {
                    "uuid": "cf34ab53-9c28-43af-afb0-a8e2672662f6",
                    "created_on": 1488815423,
                    "name": "my_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "765a6a0f-4c61-4bae-a693-c800a4a6fd95",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "e3ffeb2b-9462-458d-b068-3f21e6173bf0",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "0bc3a48e-8b7b-4dfe-a388-d34ec9463560",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "4b156665-5468-4be8-8f3c-20a3a2e4cde5",
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
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "c8614a67-c495-43de-804f-26e14a88e129",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": null
            },
            {
                "uuid": "a5d63b4c-fe06-48aa-bfb7-4737db3f47c8",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "147b6b50-d7c5-4092-b9bc-c1c35be4178b",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "7f2a2d9a-0690-469d-8026-57d59dfda5f9",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "c4547e0b-c147-4810-b3e5-a443d1dc44f1",
                "created_on": 1488815423,
                "software": {
                    "uuid": "2b2cb90a-f652-497b-962a-1061c4de5857",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "ad3c2e4d-54bc-4764-859f-af4b031bd46f",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": null
            },
            {
                "uuid": "261d9eb3-4d9b-48e0-8e15-07871ac8ce25",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "3d01fc14-fe86-457e-b0d7-241c6c03f964",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                }
            },
            {
                "uuid": "d4063d7f-e38e-44b8-9c8b-6c9266b6721e",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "18951601-a7a5-4830-be5b-3407c91e15cc",
                    "created_on": 1488815423,
                    "name": "my_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "267df24f-5250-4f3a-a93a-dba6b64c36d4",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "59de7de2-8cd1-4fcb-83c4-ecaf10e5d12c",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
            },
            {
                "uuid": "d1312031-3484-4004-a4c4-bf2d77d4b15f",
                "created_on": 1488815423,
                "software": {
                    "uuid": "6fc9f2b4-28be-41b8-89b5-eb54acd33a73",
                    "created_on": 1488815423,
                    "name": "another_software_name",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": null
                },
                "user": {
                    "uuid": "a96b71e4-614d-4cc8-a79f-cfd244160ac3",
                    "created_on": 1488815423,
                    "name": "another_username",
                    "credentials___username": "my_user_username",
                    "credentials___hashed_password": "$2y$10$x\/U44x\/ABmhuUJHgJqcXCOtzfCs6VRbuCHmVA56EfD\/AAIyig9CmK",
                    "roles": [
                        {
                            "uuid": "3ca4c6a5-1b7c-4593-a0e8-d05841b15ab0",
                            "created_on": 1488815423,
                            "title": "This is a role",
                            "description": "This is a role description.",
                            "permissions": null
                        },
                        {
                            "uuid": "f21155d2-1053-4e21-b31f-9d6d307cfc32",
                            "created_on": 1488815423,
                            "title": "This is an updated role",
                            "description": "This is an updated role description.",
                            "permissions": [
                                {
                                    "uuid": "ac7560bb-a015-48c0-bf9c-894b2ddf12f1",
                                    "created_on": 1488815423,
                                    "title": "This is just a title",
                                    "description": "This is just a description",
                                    "can_read": "1",
                                    "can_write": "0",
                                    "can_delete": "0"
                                },
                                {
                                    "uuid": "6136a79e-71a1-4871-b905-0f1edbaf90bc",
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
        ],
        "permissions": [
            {
                "uuid": "749b9057-e8c6-48b1-9a66-27a8875eebe5",
                "created_on": 1488815423,
                "title": "This is just a title",
                "description": "This is just a description",
                "can_read": "1",
                "can_write": "0",
                "can_delete": "0"
            },
            {
                "uuid": "e7bc651b-f547-4e63-873e-6baf58f870e9",
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
