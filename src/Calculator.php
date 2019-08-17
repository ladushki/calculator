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
     */
    public function calculate(): Calculator
    {
        if (is_array($this->operations) && count($this->operations) > 0) {
            $this->result = array_map(static function (OperationInterface $item) {
                return $item->execute();
            }, $this->operations);
        } else {
            $this->result[] = $this->operations[0]->execute();
        }

        return $this;
    }

    /**
     * @param int $index
     *
     * @return float
     */
    public function getResult(int $index = 1): float
    {
        return $this->result[$index - 1];
    }


    /**
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
