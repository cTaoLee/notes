<?php

// 

interface Pizza {
    function make();
}
interface PizzaStore {
    function orderPizza($item);
}

class NYStyleCheesePizza implements Pizza {
    function make() {
        echo "纽约口味的芝士披萨", PHP_EOL;
    }
}

class NYStyleVeggiePizza implements Pizza {
    function make() {
        echo "纽约口味的素食披萨", PHP_EOL;
    }
}

class ChicagoStyleCheesePizza implements Pizza {
    function make() {
        echo "芝加哥口味的芝士披萨", PHP_EOL;
    }
}

class ChicagoStyleVeggiePizza implements Pizza {
    function make() {
        echo "芝加哥口味的素食披萨", PHP_EOL;
    }
}

class NYPizzaStore implements PizzaStore {
	private $pizza = null;

    function orderPizza($item) {
        if($item == "cheese"){
            $this->pizza = new NYStyleCheesePizza();
        }
        elseif($item == "veggie") {
            $this->pizza = new NYStyleVeggiePizza();
        } 
        else{
            throw new \Exception();
        }
        $this->pizza->make();
        return $this->pizza;
    }
}


class ChicagoPizzaStore implements PizzaStore {
	private $pizza;

    function orderPizza($item){
        if($item == "cheese"){
            $this->pizza = new ChicagoStyleCheesePizza();
        }
        elseif($item == "veggie"){
            $this->pizza = new ChicagoStyleVeggiePizza();
        }
        else {
            throw new \Exception();
        }
        $this->pizza->make();
        return $this->pizza;
    }
}

$nyStore = new NYPizzaStore();
$nyStore->orderPizza("cheese");
$chicagoStore = new ChicagoPizzaStore();
$chicagoStore->orderPizza("cheese");