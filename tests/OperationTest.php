<?php

namespace App\Test;

use App\Exceptions\NoOperandsException;
use App\Exceptions\WrongTypeException;
use App\Operations\Add;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{

    private $operation;

    public function setUp(): void
    {
        $this->operation = new Add();
    }


    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(NoOperandsException::class);
        $this->operation->execute();
    }

    public function testWrongOperandTypeThrowException(): void
    {
        $this->expectException(WrongTypeException::class);

        $this->operation->setOperands(['test', 1, 2]);
    }

    public function testNullOperandThrowException(): void
    {
        $this->expectException(NoOperandsException::class);

        $this->operation->setOperands([1, null]);
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
}
