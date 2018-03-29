<?php

interface Dough {
    function doughType();
}

class ThickCrustDough implements Dough {
    function doughType() {
        echo "ThickCrustDough", PHP_EOL;
    }
}

class ThinCrustDough implements Dough {
    function doughType() {
        echo "ThinCrustDough", PHP_EOL;
    }
}

interface Sauce {
    function sauceType();
}

class MarinaraSauce implements Sauce {
    function sauceType() {
        echo "MarinaraSauce", PHP_EOL;
    }
}

class PlumTomatoSauce implements Sauce {
    function sauceType() {
        echo "PlumTomatoSauce", PHP_EOL;
    }
}

interface PizzaIngredientFactory {
    function createDough();
    function createSauce();
}


class NYPizzaIngredientFactory implements PizzaIngredientFactory{
    function createDough() {
        return new ThickCrustDough();
    }

    function createSauce() {
        return new MarinaraSauce();
    }
}

class ChicagoPizzaIngredientFactory implements PizzaIngredientFactory{
    function createDough() {
        return new ThinCrustDough();
    }

    function createSauce() {
        return new PlumTomatoSauce();
    }
}

class NYPizzaStore {
    private $ingredientFactory;

    function NYPizzaStore() {
        $this->ingredientFactory = new NYPizzaIngredientFactory();
    }

    function makePizza() {
        $dough = $this->ingredientFactory->createDough();
        $sauce = $this->ingredientFactory->createSauce();
        $dough->doughType();
        $sauce->sauceType();
    }
}


$nyPizzaStore = new NYPizzaStore();
$nyPizzaStore->makePizza();
