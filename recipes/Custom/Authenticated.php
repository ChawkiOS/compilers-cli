<?php

function authenticated_front_authenticate($service, $httpRequest) {

    print_r($service->getRepository()->getEntityPartialSet()->retrieve([
        'container' => 'role',
        'index' => 0,
        'amount' => 22
    ]));
    die();

};

function authenticated_front_authenticate_test($service, $phpunit) {



};
