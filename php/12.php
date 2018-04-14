<?php

// 组合模式
// 一个类应该只有一个引起它改变的原因。

abstract class Component {
    protected $name;

    function __construct($name) {
        $this->name = $name;
    }


    function execute(){
    	$this->printf(0);
    }

    abstract function addChild(Component $component);
    abstract protected function printf($level);

}

class Leaf extends Component {

    function addChild(Component $component) {
        throw new \Exception(); // 牺牲透明性换取单一职责原则，这样就不用考虑是子节点还是组合节点
    }

    
    protected function printf($level) {
        for ($i = 0; $i < $level; $i++) {
            echo "--";
        }
        echo "这里由叶子类:" , $this->name, PHP_EOL;
    }
}

class Composite extends Component {

    private $childs = [];

    function addChild(Component $component) {
        $this->childs[] = $component;
    }

    
    protected function printf($level) {
        for ($i = 0; $i < $level; $i++) {
            echo "--";
        }
        echo "这里是组合类:", $this->name, PHP_EOL;
        foreach ($this->childs as $component) {
            $component->printf($level + 1);
        }
    }
}



$root = new Composite("root");
$node1 = new Leaf("1");
$node2 = new Composite("2");
$node3 = new Leaf("3");
$root->addChild($node1);
$root->addChild($node2);
$root->addChild($node3);
$node21 = new Leaf("21");
$node22 = new Composite("22");
$node2->addChild($node21);
$node2->addChild($node22);
$node221 = new Leaf("221");
$node22->addChild($node221);
$root->execute();