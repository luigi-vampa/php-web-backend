<?php

// Class for the ones that can extend
abstract class Singleton
{
    private static $instances = [];

    protected function __construct()
    { }

    abstract protected function clean_up();

    final public static function getInstance()
    {
        $class_to_create = get_called_class();

        if (!isset(self::$instances[$class_to_create])) {
            self::$instances[$class_to_create] = new $class_to_create();
        }

        return self::$instances[$class_to_create];
    }

    final public static function destroyInstance()
    {
        $class_to_destroy = get_called_class();

        if(isset(self::$instances[$class_to_destroy])) {
            self::$instances[$class_to_destroy].clean_up();
            self::$instances[$class_to_destroy] = null;
            unset(self::$instances[$class_to_destroy]);
        }

    }

    final private function __clone()
    { }
}
