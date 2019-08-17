<?php

namespace App\Test;

use App\Exception\NoOperandsException;
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
}
