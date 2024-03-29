<?php

namespace App\Test;

use App\Exception\NoOperandsException;
use App\Exceptions\WrongTypeException;
use App\Operations\Add;
use PHPUnit\Framework\TestCase;

class AddTest extends TestCase
{

    private $operation;

    public function setUp(): void
    {
        $this->operation = new Add();
    }

    public function testAddsUp(): void
    {
        $this->operation->setOperands([5,6]);
        $this->assertEquals(11, $this->operation->execute());
    }

    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->execute();
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
        $this->assertCount(4, $this->operation->getOperands());
        $this->assertEquals(-1, $operands[0]);
        $this->assertEquals(1, $operands[1]);
        $this->assertEquals(0, $operands[2]);
        $this->assertEquals(4, $operands[3]);
    }
}
