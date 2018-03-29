<?php

// 观察者模式
// 在此种模式中，一个目标物件管理所有相依于它的观察者物件，并且在它本身的状态改变时主动发出通知。

interface Subject {
    function resisterObserver(Observer $o);
    function removeObserver(Observer $o);
    function notifyObserver();
}

class WeatherData implements Subject {
    public $observers = [];
    private $temperature;
    private $humidity;
    private $pressure;

    function resisterObserver(Observer $o){
        $this->observers[] = $o;
    }

    function removeObserver(Observer $o){
        $i = array_search($o, $this->observers);
        unset($this->observers[$i]);
    }

    function notifyObserver(){
        foreach ($this->observers as $o){
            $o->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    function setMeasurements($temperature, $humidity, $pressure){
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->notifyObserver();
    }
}

interface Observer {
    function update($temp, $humidity, $pressure);
}


class CurrentConditionsDisplay implements Observer {
    private $weatherData;

    function __construct(Subject $weatherData){
        $this->weatherData = $weatherData;
        $weatherData->observers[] = $this;
    }
    function update($temp, $humidity, $pressure){
        echo "目前布告板更新: 温度{$temp},湿度{$humidity},气压{$pressure}", PHP_EOL;
    }
}

class StatisticsDisplay implements Observer {
    private $weatherData;

    function __construct(Subject $weatherData){
        $this->weatherData = $weatherData;
        $weatherData->observers[] = $this;
    }
    function update($temp, $humidity, $pressure){
        echo "统计布告板更新: 温度{$temp},湿度{$humidity},气压{$pressure}", PHP_EOL;
    }
}

$weatherData = new WeatherData();
$currentConditionsDisplay = new CurrentConditionsDisplay($weatherData);
$statisticsDisplay = new StatisticsDisplay($weatherData);

$weatherData->setMeasurements(0, 0, 0);
$weatherData->setMeasurements(1, 1, 1);
