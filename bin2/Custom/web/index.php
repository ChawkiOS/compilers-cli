<?php
include_once(__DIR__ . '/../vendor/autoload.php');
use iRESTful\Authenticated\Infrastructure\Applications\AuthenticatedApplication;

$postedData = $_POST;

if (
    isset($_SERVER['REQUEST_METHOD']) &&
    (strtolower($_SERVER['REQUEST_METHOD']) !== 'get') &&
    (strtolower($_SERVER['REQUEST_METHOD']) !== 'post')
) {
    $content = file_get_contents('php://input');
    if (!empty($content)) {
        $data = [];
        parse_str($content, $data);
        $postedData = array_merge($postedData, $data);
    }

}

new AuthenticatedApplication($_SERVER, $_GET, $_POST);
