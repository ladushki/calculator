<?php
declare(strict_types=1);

namespace App\Test;

use App\Calculator;
use App\Exceptions\CalculatorException;
use App\Operations\Add;

class CalculatorTest extends TestCase
{

    private $calculator;

    public function setUp(): void
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }

    public function testExceptionIfNoOperationIsSet(): void
    {
        $this->expectException(CalculatorException::class);

        $addOperator = new Add();
        $addOperator->setOperands([1, 2]);

        $this->calculator->calculate()->getResult();
    }

    public function testExceptionGetResultForWrongOperationNumber(): void
    {
        $this->expectException(CalculatorException::class);
        $addOperator = new Add();
        $addOperator->setOperands([1, 2]);

        $addOperator1 = new Add();
        $addOperator1->setOperands([1, 2, 3]);

        $this->calculator->setOperations([$addOperator, $addOperator1]);

        $this->calculator->calculate()->getResult(3);
    }

    public function testCanSetOperation(): void
    {
        $addOperator = new Add();
        $addOperator->setOperands([1, 2]);

        $this->calculator->setOperation($addOperator);
        $this->assertCount(1, $this->calculator->getOperations());

        $this->assertEquals(3, $addOperator->execute());
    }

    public function testCanSetOperations(): void
    {
        $addOperator = new Add();
        $addOperator->setOperands([1, 2]);

        $addOperator1 = new Add();
        $addOperator1->setOperands([1, 2, 3]);

        $this->calculator->setOperations([$addOperator, $addOperator1]);
        $this->assertCount(2, $this->calculator->getOperations());

        $this->assertEquals(3, $this->calculator->calculate()->getResult(1));
        $this->assertEquals(6, $this->calculator->calculate()->getResult(2));
    }

    public function testAllOperationsAreOperationInterface(): void
    {
        $operation1 = new Add();
        $this->calculator->setOperations([$operation1, 'add']);

        $this->assertCount(1, $this->calculator->getOperations());
    }

    public function testCalculate(): void
    {
        $addOperator = new Add();
        $addOperator->setOperands([1, 2]);

        $this->calculator->setOperations([$addOperator]);

        $this->assertCount(1, $this->calculator->calculate()->getResults());
        $this->assertEquals(3, $this->calculator->getResult());
    }

    public function testMakeMoreCalculations(): void
    {
        $addOperator1 = new Add();
        $addOperator1->setOperands([1, 2]);

        $addOperator2 = new Add();
        $addOperator2->setOperands([1, 2, 3]);

        $this->calculator->setOperations([$addOperator1, $addOperator2]);

        $this->assertIsArray($this->calculator->calculate()->getResults());
        $this->assertCount(2, $this->calculator->calculate()->getResults());

        $this->assertEquals(3, $this->calculator->getResult(1));
        $this->assertEquals(6, $this->calculator->getResult(2));
    }

    public function testGetResults()
    {
        $addOperator = new Add();
        $addOperator->setOperands([1, 2]);

        $this->calculator->setOperations([$addOperator])->calculate();
        $this->assertNotEmpty($this->calculator->getResults());
    }
}
