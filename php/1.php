<?php

// 策略模式
// 对一系列的算法定义，并将每一个算法封装起来，而且使它们还可以相互替换。


interface FlyBehavior {
	function fly();
}

class FlyNoWay implements FlyBehavior {
	function fly(){
		echo "不会飞", PHP_EOL;
	}
}
class FlyWithWings implements FlyBehavior {
	function fly(){
		echo "飞得起来", PHP_EOL;
	}
}


interface QuackBehavior {
    function quack();
}

class Quack implements QuackBehavior {
    function __construct(){
        // 这里防止php将 quack() 当成了构造函数
    }


    function quack(){
        echo "呱呱叫", PHP_EOL;
    }
}
class Squeak implements QuackBehavior {
    function quack(){
        echo "吱吱叫", PHP_EOL;
    }
}
class MuteQuack implements QuackBehavior {
    function quack(){
        echo "叫不出声", PHP_EOL;
    }
}


/**
 * @var FlyBehavior $flyBehavior
 * @var QuackBehavior $quackBehavior
 */
abstract class Duck  {
    protected $flyBehavior;
    protected $quackBehavior;

    function setFlyBehavior(FlyBehavior $fb){
        $this->flyBehavior = $fb;
    }

    function setQuackBehavior(QuackBehavior $qb){
        $this->QuackBehavior = $qb;
    }

    function performFly(){
        $this->flyBehavior->fly();
    }

    function performQuack(){
        $this->quackBehavior->quack();
    }
    
}


class MallardDuck extends Duck {
    function __construct(){
        $this->flyBehavior = new FlyWithWings();
        $this->quackBehavior = new Quack();
    }
}

$mallardDuck = new MallardDuck();
$mallardDuck->performQuack();
$mallardDuck->performFly();
$mallardDuck->setFlyBehavior(new FlyNoWay());
$mallardDuck->performFly();


