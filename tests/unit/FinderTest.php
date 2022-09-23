<?php

use CodeceptFinder\FinderCommand;
use Symfony\Component\Console\Tester\CommandTester;

class FinderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testDiscovery()
    {
        $command = new CommandTester(new FinderCommand());
        $command->execute(['test-suite' => ['unit', 'functional']]);
        $output = $command->getDisplay();
        var_dump('This is the output' . $output);
        $this->assertNotNull($output);
        if (method_exists($this, 'assertStringContainsString')) {
            $this->assertStringContainsString('FinderTest.php', $output);
            $this->assertStringContainsString('TestUnitTest.php', $output);
            $this->assertStringContainsString('TestFunctionalTest.php', $output);
            return;
        }
        $this->assertContains('FinderTest.php', $output);
        $this->assertContains('TestUnitTest.php', $output);
        $this->assertContains('TestFunctionalTest.php', $output);
        $this->assertTrue(true);
    }
}