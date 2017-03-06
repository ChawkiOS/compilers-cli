<?php
$execute = function($command) {
    ob_start();
    passthru($command);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
};

$namespace = 'irestful_authenticatedcrud';


$devDockerContainer = $namespace.'_php';
$commands = [
    'docker-compose exec '.$devDockerContainer.' rm composer.lock',
    'docker-compose exec '.$devDockerContainer.' rm -R -f vendor',
    'docker-compose exec '.$devDockerContainer.' curl -sS https://getcomposer.org/installer | php',
    'docker-compose exec '.$devDockerContainer.' php composer.phar install --prefer-source',
    'docker-compose exec '.$devDockerContainer.' php -r "include(\'install_in_container.php\');"',
    'docker-compose exec '.$devDockerContainer.' php vendor/bin/phpunit --testsuite=unit'
];

$execute('docker-compose up -d');
sleep(30);


//run the dev commands:
foreach($commands as $oneCommand) {
    passthru($oneCommand);
}

echo PHP_EOL."DONE!".PHP_EOL;
