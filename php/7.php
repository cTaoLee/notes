<?php

// 命令模式



interface Command {
    function execute();
}

class Light {
    function on() {
        echo "电灯打开", PHP_EOL;
    }

    function off() {
        echo "电灯关闭", PHP_EOL;
    }
}

class LightOnCommand implements Command {
    public $light;

    function __construct(Light $light) {
        $this->light = $light;
    }

    function execute() {
        $this->light->on();
    }
}



class SimpleRemoteControl {
    public $slot;

    function setCommand(Command $command) {
        $this->slot = $command;
    }

    function buttonWasPressed() {
        $this->slot->execute();
    }

}


$remote = new SimpleRemoteControl();
$light = new Light();
$lightOnCommand = new LightOnCommand($light);
$remote->setCommand($lightOnCommand);
$remote->buttonWasPressed();

