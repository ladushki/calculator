<?php
declare(strict_types=1);

namespace App;

/**
 * Interface OperationInterface
 *
 * @package App
 */
interface OperationInterface
{

    public function execute(): float;
}
