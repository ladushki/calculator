<?php
declare(strict_types=1);

namespace App\Operations;


use App\Exceptions\NoOperandsException;
use App\OperationAbstract;
use App\OperationInterface;

class Add extends OperationAbstract implements OperationInterface
{

    public function execute(): float
    {
        $this->validateOperands();
        return array_sum($this->operands);
    }
}
