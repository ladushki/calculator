<?php

namespace App\Test;

use App\Exception\NoOperandsException;
use App\Operations\Subtract;
use PHPUnit\Framework\TestCase;

class SubtractTest extends TestCase
{

    private $operation;

    public function setUp(): void
    {
        $this->operation = new Subtract();
    }

    public function testSubtracts(): void
    {
        $this->operation->setOperands([5, 6, 1]);
        $this->assertEquals(-2, $this->operation->execute());
    }

    public function testThrowExceptionNoOperandsOnNull(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->setOperands([5]);
    }

    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->execute();
    }
}
