<?php

namespace CodeceptFinder\Tests\functional;

use FunctionalTester;

class TestFunctionalTest extends \Codeception\Test\Unit
{
    protected FunctionalTester $tester;

    /**
     * Tests something.
     */
    public function testSomething()
    {
        $this->addToAssertionCount(1);
    }
}