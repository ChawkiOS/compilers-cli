<?php

function authenticate($service, $httpRequest) {

    print_r($service->getRepository()->getEntityPartialSet()->retrieve([
        'container' => 'role',
        'index' => 0,
        'amount' => 22
    ]));
    die();

};

function authenticate_json($service, $httpRequest) {

    return [
        'some' => 'json'
    ];

};
