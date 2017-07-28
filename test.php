<?php
class Main {
    public $i = 0;
    static $instance;
    private function __construct() {
        $this->i = rand(1, 10);
        printf("Main init: %s\n", $this->i);
    }
    public static function init() {
        if(self::$instance == null) self::$instance = new self();
        printf("Main: %s && App: %s && ClassA: %s\n", Main::$instance->i, App::App()->i, App::ClassA()->i);
    }
}
class App {
    public $i = 0;
    static $instance;
    static $list = [];
    private function __construct()
    {
        $this->i = rand(1, 10);
        printf("App init: %s\n", $this->i);
    }
    public static function __callStatic(string $name, $arguments)
    {
        if(!isset(self::$list[$name]) || !(self::$list[$name] instanceof $name))
            self::$list[$name] = new $name();
        return self::$list[$name];
    }
}
class ClassA {
    public $i = 0;
    function __construct() {
        $this->i = rand(1, 10);
        printf("ClassA init: %s\n", $this->i);
    }
}
Main::init();
