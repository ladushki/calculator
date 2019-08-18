<?php

namespace App\Test;

use App\Exception\NoOperandsException;
use App\Exceptions\WrongTypeException;
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
        $this->operation->setOperands([12, 6]);
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

    public function testWrongOperandThrowException(): void
    {
        $this->expectException(WrongTypeException::class);

        $this->operation->setOperands(['test', 1, 2]);
    }

    public function testSetOperands(): void
    {
        $this->operation->setOperands([-1, 1, 0, 4]);
        $operands = $this->operation->getOperands();
        $this->assertCount(3, $this->operation->getOperands());
        $this->assertEquals(-1, $operands[0]);
        $this->assertEquals(1, $operands[1]);
        $this->assertEquals(4, $operands[3]);
        $this->assertArrayNotHasKey(2, $operands);
    }
}
