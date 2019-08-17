<?php

namespace App\Test;

use App\Exception\NoOperandsException;
use App\Operations\Add;
use App\Operations\Divide;
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

    public function testOperationMultiplies(): void
    {
        $this->operation->setOperands([12,6]);
        $this->assertEquals(72, $this->operation->execute());

        $this->operation->setOperands([2, 6, 3]);
        $this->assertEquals(0, $this->operation->execute());
    }

    public function testThrowExceptionNoOperands(): void
    {
        $this->expectException(\App\Exceptions\NoOperandsException::class);
        $this->operation->execute();
    }

    public function testNumberOfOperands(): void
    {
        $this->operation->setOperands([100, 0, 2]);

        $this->assertEquals(0, $this->operation->execute());
        $this->assertCount(3, $this->operation->getOperands());
    }
}
