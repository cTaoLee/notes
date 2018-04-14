<?php

// 迭代器模式
// 提供顺序访问一个聚合对象中的各个元素的方法，而又不暴露聚合对象内部的表示。


class Aggregate implements Iterator {
    private $items = [];
    private $position = 0;

    function __construct(){
        for ($i=0; $i < 10; $i++){ 
            $this->items[] = $i;
        }
    }

    function current(){
        return $this->items[$this->position];
    }

    function key(){
        return $this->position;
    }

    function next(){
        return $this->position++;
    }

    function rewind(){
        return $this->position = 0;
    }

    function valid(){
        return $this->position < count($this->items);
    }
}

$aggregate = new Aggregate();
foreach ($aggregate as $item) {
    echo $item, PHP_EOL;
}

