<?php
require_once ('vendor/autoload.php');
$cal = new \App\Calculator(1, 10);


echo $cal->setOperation(new \App\Operations\Divide())->calculate()->getResult();
