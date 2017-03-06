<?php
namespace iRESTful\CompilersCli\Tests\Tests\Functional\Commands;

final class CompileTest extends \PHPUnit_Framework_TestCase {
    private $output;
    private $crud;
    private $custom;
    public function setUp() {
        $this->output = '/tmp/build/'.uniqid('compilerscli');
        $this->crud = realpath(__DIR__.'/../../recipes/CRUD/authenticated.json');
        $this->custom = realpath(__DIR__.'/../../recipes/Custom/authenticated.json');
    }

    public function tearDown() {

    }

    public function testCompile_CRUD_Success() {

        $command = 'php bin/irestful compile http://127.0.0.1:8080 '.$this->crud.' '.$this->output;
        $output = shell_exec($command);

        //make sure everything is valid:
        $this->assertTrue((strpos($output, $this->output) !== false));
        $this->assertTrue(count(scandir($this->output)) > 2);

    }

    public function testCompile_Custom_Success() {

        $command = 'php bin/irestful compile http://127.0.0.1:8080 '.$this->custom.' '.$this->output;
        shell_exec($command);

        //make sure everything is valid:
        $this->assertTrue(count(scandir($this->output)) > 2);

    }

}
