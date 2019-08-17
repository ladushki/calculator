<?php
declare(strict_types=1);

namespace App;


use App\Exceptions\NoOperandsException;

class OperationAbstract
{

    protected $operands;


    /**
     * Set numbers to calculate.
     * @param array $operands
     */
    public function setOperands(array $operands): void
    {
        $this->operands = $operands;
    }

    /**
     * Get operands.
     * @return array
     */
    public function getOperands(): array
    {
        return $this->operands;
    }


    /**
     * @return bool
     * @throws NoOperandsException
     */
    protected function validateOperands(): bool
    {
        if (!is_array($this->operands) || count($this->operands) === 0) {
            throw new NoOperandsException('No numbers defined');
        }
        return true;
    }
}