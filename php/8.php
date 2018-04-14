<?php

// 适配器模式
// 将一个类的接口，转换为客户期望的另一个接口。适配器让原本不兼容的类可以合作无间。

interface Duck {
    function quack();
}

interface Turkey {
    function gobble();
}

// 火鸡的类
class WildTurkey implements Turkey {
    function gobble() {
    	echo "咕咕叫", PHP_EOL;
    }
}

// 适配器
class TurkeyAdapter implements Duck {
    public $turkey;

    function __construct(Turkey $turkey) {
        $this->turkey = $turkey;
    }

    function quack() {
        $this->turkey->gobble();
    }
}


$turkey = new WildTurkey();
$duck = new TurkeyAdapter($turkey);
$duck->quack();