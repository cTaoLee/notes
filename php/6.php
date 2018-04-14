<?php

// 单例模式
// 确保一个类只有一个实例，并提供了一个全局访问点。


class Singleton {

    private static $uniqueInstance;

    private Singleton() {
    }

    static function getUniqueInstance() {
        if ($this->uniqueInstance == null) {
            $this->uniqueInstance = new Singleton();
        }
        return $this->uniqueInstance;
    }
}


