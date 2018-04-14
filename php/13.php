<?php

// 状态模式
// 允许对象在内部状态改变时改变它的行为，对象看起来好像修改了它所属的类。

interface State {
    /**
     * 投入 25 分钱
     */
    function insertQuarter();

    /**
     * 退回 25 分钱
     */
    function ejectQuarter();

    /**
     * 转动曲柄
     */
    function turnCrank();

    /**
     * 发放糖果
     */
    function dispense();
}

class HasQuarterState implements State {

    private $gumballMachine;

    function HasQuarterState(GumballMachine $gumballMachine){
        $this->gumballMachine = $gumballMachine;
    }

    function insertQuarter() {
        echo "You can't insert another quarter", PHP_EOL;
    }

    function ejectQuarter() {
        echo "Quarter returned", PHP_EOL;
        $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
    }

    function turnCrank() {
        echo "You turned...", PHP_EOL;
        $this->gumballMachine->setState($this->gumballMachine->getSoldState());
    }

    function dispense() {
        echo "No gumball dispensed", PHP_EOL;
    }
}

class NoQuarterState implements State {

    public $gumballMachine;

    function NoQuarterState(GumballMachine $gumballMachine) {
        $this->gumballMachine = $gumballMachine;
    }

    function insertQuarter() {
        echo "You insert a quarter", PHP_EOL;
        $this->gumballMachine->setState($this->gumballMachine->getHasQuarterState());
    }

    function ejectQuarter() {
        echo "You haven't insert a quarter", PHP_EOL;
    }

   	function turnCrank() {
        echo "You turned, but there's no quarter", PHP_EOL;
    }

    function dispense() {
        echo "You need to pay first", PHP_EOL;
    }
}

class SoldOutState implements State {

    public $gumballMachine;

    function SoldOutState(GumballMachine $gumballMachine) {
        $this->gumballMachine = $gumballMachine;
    }

    function insertQuarter() {
        echo "You can't insert a quarter, the machine is sold out", PHP_EOL;
    }

    function ejectQuarter() {
        echo "You can't eject, you haven't inserted a quarter yet", PHP_EOL;
    }

    function turnCrank() {
        echo "You turned, but there are no gumballs", PHP_EOL;
    }

    function dispense() {
        echo "No gumball dispensed", PHP_EOL;
    }
}

class SoldState implements State {

    public $gumballMachine;

    function SoldState(GumballMachine $gumballMachine) {
        $this->gumballMachine = $gumballMachine;
    }

    function insertQuarter() {
        echo "Please wait, we're already giving you a gumball", PHP_EOL;
    }

    function ejectQuarter() {
        echo "Sorry, you already turned the crank", PHP_EOL;
    }

    function turnCrank() {
        echo "Turning twice doesn't get you another gumball!", PHP_EOL;
    }

    function dispense() {
        $this->gumballMachine->releaseBall();
        if($this->gumballMachine->getCount()>0){
            $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
        } else{
            echo "Oops, out of gumballs", PHP_EOL;
            $this->gumballMachine->setState($this->gumballMachine->getSoldOutState());
        }
    }
}

class GumballMachine {

    private $soldOutState;
    private $noQuarterState;
    private $hasQuarterState;
    private $soldState;

    private $state;
    private $count = 0;

    function GumballMachine($numberGumballs) {
        $this->count = $numberGumballs;
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);
        $this->soldState = new SoldState($this);

        if ($numberGumballs > 0) {
            $this->state = $this->noQuarterState;
        } else {
            $this->state = $this->soldOutState;
        }
    }

    function insertQuarter() {
        $this->state->insertQuarter();
    }

    function ejectQuarter() {
        $this->state->ejectQuarter();
    }

    function turnCrank() {
        $this->state->turnCrank();
        $this->state->dispense();
    }

    function setState(State $state) {
        $this->state = $state;
    }

    function releaseBall() {
        echo "A gumball comes rolling out the slot...", PHP_EOL;
        if ($this->count != 0) {
            $this->count -= 1;
        }
    }

    function getSoldOutState() {
        return $this->soldOutState;
    }

    function getNoQuarterState() {
        return $this->noQuarterState;
    }

    function getHasQuarterState() {
        return $this->hasQuarterState;
    }

    function getSoldState() {
        return $this->soldState;
    }

    function getCount() {
        return $this->count;
    }
}




$gumballMachine = new GumballMachine(5);

$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();

$gumballMachine->insertQuarter();
$gumballMachine->ejectQuarter();
$gumballMachine->turnCrank();

$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();
$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();
$gumballMachine->ejectQuarter();

$gumballMachine->insertQuarter();
$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();
$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();
$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();