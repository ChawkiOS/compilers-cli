<?php
$execute = function($command) {
    ob_start();
    passthru($command);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
};

$execute('docker-compose down');
