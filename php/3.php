<?php

// 装饰模式
// 装饰模式指的是在不必改变原类文件和使用继承的情况下，动态地扩展一个对象的功能。

interface Beverage {
    function cost();
}

class HouseBlend implements Beverage {
    function cost() {
    	echo "混合做法 \t 10.0￥", PHP_EOL;
        return 10;
    }
}

class DarkRoast implements Beverage {
    function cost() {
    	echo "烘焙做法 \t 10.5￥", PHP_EOL;
        return 10.5;
    }
}

abstract class CondimentDecorator implements Beverage {
    protected $beverage;
}


class Mocha extends CondimentDecorator {
    function Mocha(Beverage $beverage) {
        $this->beverage = $beverage;
    }

    function cost() {
    	echo "摩卡 \t 5.5￥", PHP_EOL;
        return 5.5 + $this->beverage->cost();
    }
}


class Milk extends CondimentDecorator {
    function Milk(Beverage $beverage) {
        $this->beverage = $beverage;
    }

    function cost() {
    	echo "牛奶 \t 4.0￥", PHP_EOL;
        return 4 + $this->beverage->cost();
    }
}


$beverage = new HouseBlend();
$beverage = new Mocha($beverage);
$beverage = new Milk($beverage);
$price = $beverage->cost();
echo "共计: \t {$price}￥", PHP_EOL;
