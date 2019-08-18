<?php
declare(strict_types=1);

namespace App\Operations;


use App\OperationAbstract;
use App\OperationInterface;

class Add extends OperationAbstract implements OperationInterface
{

    public function execute(): float
    {
        $this->checkOperands();
        return array_sum($this->operands);
    }
}
