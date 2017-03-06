<?php

$namespace = 'irestful_authenticated';
$dockerContainers = [
    $namespace.'_php'
];

$dockerContainers[] = $namespace.'_authenticatedcrud_php';

$commands = [];
foreach($dockerContainers as $oneContainer) {
    $commands = array_merge($commands, [
        'docker-compose exec '.$oneContainer.' php -r "include(\'install_in_container.php\');"',
        'docker-compose exec '.$oneContainer.' php vendor/bin/phpunit --testsuite=unit'
    ]);
}

passthru('docker-compose up -d');
sleep(30);

foreach($commands as $oneCommand) {
    passthru($oneCommand);
}

echo PHP_EOL."DONE!".PHP_EOL;
