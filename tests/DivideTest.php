<?php

namespace App\Test;

use App\Exception\NoOperandsException;
use App\Operations\Add;
use App\Operations\Divide;
use PHPUnit\Framework\TestCase;

class DivideTest extends TestCase
{

    private $operation;

    public function setUp(): void
    {
        parent::setUp();
        $this->operation = new Divide();
    }

    public function testOperationDivides(): void
    {
        $this->operation->setOperands([12,6]);
        $this->assertEquals(2, $this->operation->execute());
    }

    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->setOperands([]);
        $this->operation->execute();
    }

    public function testNoZeros(): void
    {
        $this->operation->setOperands([100, 0, 2]);

        $this->assertEquals(50, $this->operation->execute());
        $this->assertCount(2, $this->operation->getOperands());
    }
}
