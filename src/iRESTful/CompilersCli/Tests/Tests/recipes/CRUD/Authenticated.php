<?php

function constructor_comboTest_validateParameters($endpoint = null, $api = null, $registration = null) {

    $amount = (empty($endpoint) ? 0 : 1) + (empty($api) ? 0 : 1) + (empty($registration) ? 0 : 1);
    if ($amount != 1) {
        throw new \Exception('There must be either an endpoint, an api or a registration.  '.$amount.' given.');
    }

};

function constructor_pattern_validateParameters($regexPattern = null, $specificUri = null) {

    if ((!empty($regexPattern) && !empty($specificUri)) || (empty($regexPattern) && empty($specificUri))) {
        $regexPattern = '';
        $specificUri = null;
    }

};

function constructor_paramPattern_validateParameters($regexPattern = null, $specificValue = null) {

    if ((!empty($regexPattern) && !empty($specificValue)) || (empty($regexPattern) && empty($specificValue))) {
        $regexPattern = '';
        $specificValue = null;
    }

};

function validateBaseUrl(string $test) {
    if (filter_var($test, FILTER_VALIDATE_URL) === false) {
        throw new \Exception('The baseUrl ('.$test.') is invalid.');
    }
};

function validateUri(string $uri) {

    if (strpos($uri, '/') !== 0) {
        throw new \Exception('The first character of the URI ('.$uri.') must be a forward slash (/).');
    }

    if (strpos(strrev($uri), '/') === 0) {
        throw new \Exception('The last character of the URI ('.$uri.') cannot be a forward slash (/).');
    }

};

function validateHashedPassword(string $hashedPassword) {

    $info = password_get_info($hashedPassword);
    if (!isset($info['algo']) || ($info['algo'] != \PASSWORD_DEFAULT)) {
        throw new \Exception('The given hashedPassword ('.$hashedPassword.') is not a properly hashed password.');
    }

};

function validateKeyname(string $keyname) {

    if (empty($keyname)) {
        throw new \Exception('The keyname ('.$keyname.') must be a non-empty string.');
    }

};
