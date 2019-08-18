<?php
/**
 * This file is part of the ladushky/Calculator library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Larissa <larissa.bobkova@gmail.com>
 * @license   http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace App;

use App\Exceptions\CalculatorException;

/**
 * Calculator
 */
class Calculator
{

    /**
     * Operation.
     *
     * @var OperationInterface $operation
     */
    protected $operation;

    /**
     * Multiple operations.
     *
     * @var array
     */
    protected $operations = [];

    /**
     * Result
     *
     * @var array $result .
     */
    protected $result;


    /**Set operation.
     *
     * @param OperationInterface $operation
     */
    public function setOperation(OperationInterface $operation): void
    {
        $this->operations[] = $operation;
    }

    public function setOperations(array $operations): Calculator
    {
        $filtered = array_filter($operations, static function ($item) {
            return $item instanceof OperationInterface;
        });

        $this->operations = array_merge($this->operations, $filtered);

        return $this;
    }


    /**
     * @return Calculator
     * @throws CalculatorException
     */
    public function calculate(): Calculator
    {
        if (empty($this->operations)) {
            throw new CalculatorException('Please provide at least one of the operations: +, -,/,*');
        }
        if (is_array($this->operations) && count($this->operations) > 1) {
            $this->result = array_map(static function (OperationInterface $item) {
                return $item->execute();
            }, $this->operations);
        } else {
            $this->result[] = $this->operations[0]->execute();
        }

        return $this;
    }


    /**
     * Returns result for the operation by order number.
     *
     * @param int $index
     *
     * @return float
     * @throws CalculatorException
     */
    public function getResult(int $index = 1): float
    {
        $cnt = count($this->result);

        $i = $index < 1 ? 1 : $index - 1;

        if ($cnt === 1) {
            $i = 0;
        }
        if (!isset($this->result[$i])) {

            throw new CalculatorException('There is no result for the operation (' . $cnt . ')');
        }

        return $this->result[$i];
    }


    /**
     * Returns results.
     *
     * @return array
     */
    public function getResults(): array
    {
        return $this->result;
    }


    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}
