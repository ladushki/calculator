<?php

namespace App\Test;

use App\Exception\NoOperandsException;
use App\Exceptions\WrongTypeException;
use App\Operations\Multiply;
use PHPUnit\Framework\TestCase;

class MultipleTest extends TestCase
{

    private $operation;

    public function setUp(): void
    {
        parent::setUp();
        $this->operation = new Multiply();
    }

    public function testWrongOperandThrowException(): void
    {
        $this->expectException(WrongTypeException::class);

        $this->operation->setOperands(['test', 1]);
    }

    public function testSetOperands(): void
    {
        $this->operation->setOperands([-1, 1, 0, 4]);
        $operands = $this->operation->getOperands();
        $this->assertCount(4, $this->operation->getOperands());
        $this->assertEquals(-1, $operands[0]);
        $this->assertEquals(1, $operands[1]);
        $this->assertEquals(0, $operands[2]);
        $this->assertEquals(4, $operands[3]);
    }

    public function testOperationMultiplies(): void
    {
        $this->operation->setOperands([12,6]);
        $this->assertEquals(72, $this->operation->execute());

        $this->operation->setOperands([2, 6, 3]);
        $this->assertEquals(36, $this->operation->execute());
    }

    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->execute();
    }

    public function testNumberOfOperands(): void
    {
        $this->operation->setOperands([100, 0, 2]);

        $this->assertCount(3, $this->operation->getOperands());
    }
}
