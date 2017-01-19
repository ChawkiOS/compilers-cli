<?php
namespace iRESTful\CompilersCli\Tests\Tests\Functional;

final class CompilersCliTest extends \PHPUnit_Framework_TestCase {
    private $output;
    private $crud;
    private $custom;
    public function setUp() {
        $this->output = '/tmp/build/'.uniqid('compilerscli');
        $this->crud = realpath(__DIR__.'/../recipes/CRUD/authenticated.json');
        $this->custom = realpath(__DIR__.'/../recipes/Custom/authenticated.json');
    }

    public function tearDown() {

    }

    public function testCompile_CRUD_Success() {

        $command = 'php /vagrant/bin/irestful-api-compiler http://127.0.0.1 '.$this->crud.' '.$this->output;
        $output = shell_exec($command);

        //make sure everything is valid:
        $this->assertTrue((strpos($output, $this->output) !== false));
        $this->assertTrue(count(scandir($this->output)) > 2);

    }

    public function testCompile_Custom_Success() {

        $command = 'php /vagrant/bin/irestful-api-compiler http://127.0.0.1 '.$this->custom.' '.$this->output;
        shell_exec($command);

        //make sure everything is valid:
        $this->assertTrue(count(scandir($this->output)) > 2);

    }

}
