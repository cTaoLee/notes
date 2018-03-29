<?php

// 

interface Pizza {
    function make();
}

class CheesePizza implements Pizza {
    function make() {
        echo "芝士披萨", PHP_EOL;
    }
}

class GreekPizza implements Pizza{
    function make() {
        echo "蛤蜊披萨", PHP_EOL;
    }
}


class SimplePizzaFactory {
    function createPizza($type){
        if($type == "cheese"){
            return new CheesePizza();
        }
        elseif($type == "greek"){
            return new GreekPizza();
        }
        else{
            throw new \Exception();
        }
    }
}



$simplePizzaFactory = new SimplePizzaFactory();
$pizza = $simplePizzaFactory->createPizza("cheese");
$pizza->make();
