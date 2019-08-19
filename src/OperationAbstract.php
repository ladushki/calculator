<?php
declare(strict_types=1);

namespace App;


use App\Exceptions\NoOperandsException;
use App\Exceptions\WrongTypeException;

class OperationAbstract
{

    /**
     * Array of operands
     *
     * @var array
     */
    protected $operands = [];


    /**
     * @param array $operands
     *
     * @throws NoOperandsException
     */
    public function setOperands(array $operands): void
    {
        if (!is_array($operands) || count($operands) <= 1) {
            throw new NoOperandsException('Please set at least two numbers');
        }
        $this->operands = array_map(static function ($value) {
            if ($value === null) {
                throw new NoOperandsException('Please set a number');
            }
            if (!is_numeric($value)) {
                throw new WrongTypeException('The value has to be numeric');
            }

            return (float)$value;
        }, $operands);
    }

    /**
     * Get operands.
     *
     * @return array
     */
    public function getOperands(): array
    {
        return $this->operands;
    }


    /**
     * Checks & validates operands.
     * @return bool
     * @throws NoOperandsException
     */
    protected function checkOperands(): bool
    {
        if (!is_array($this->operands) || count($this->operands) === 0) {
            throw new NoOperandsException('No numbers defined');
        }

        return true;
    }
}