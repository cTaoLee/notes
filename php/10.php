<?php

// 模板方法模式
// 在一个方法中定义一个算法的骨架，而将一些步骤延迟到子类中。


abstract class CaffeineBeverage {

    final function prepareRecipe(){
        $this->boilWater();
        $this->brew();
        $this->pourInCup();
        $this->addCondiments();
    }

    abstract function brew();

    abstract function addCondiments();

    function boilWater(){
        echo "boilWater", PHP_EOL;
    }

    function pourInCup(){
        echo "pourInCup", PHP_EOL;
    }
}

class Coffee extends CaffeineBeverage {
    function brew() {
        echo "Coffee.brew", PHP_EOL;
    }

    function addCondiments() {
        echo "Coffee.addCondiments", PHP_EOL;
    }
}

class Tea extends CaffeineBeverage {
    function brew() {
        echo "Tea.brew", PHP_EOL;
    }

    function addCondiments() {
        echo "Tea.addCondiments", PHP_EOL;
    }
}


$caffeineBeverage = new Coffee();
$caffeineBeverage->prepareRecipe();
echo "-----------", PHP_EOL;
$caffeineBeverage = new Tea();
$caffeineBeverage->prepareRecipe();