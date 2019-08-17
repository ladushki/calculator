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
        $this->operation->setOperands([5, 6]);
        $this->assertEquals(-1, $this->operation->execute());
    }

    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->execute();
    }
}
