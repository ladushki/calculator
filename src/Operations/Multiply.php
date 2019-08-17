<?php
declare(strict_types=1);

namespace App\Operations;


use App\OperationAbstract;
use App\OperationInterface;

class Multiply extends OperationAbstract implements OperationInterface
{
    public function execute(): float
    {
        $this->validateOperands();

        $result = array_reduce($this->getOperands(), static function ($left, $right) {
            if ($left !== null && $right !== null) {
                return $left * $right;
            }

            return $right;
        }, null);

        return $result;
    }
}
