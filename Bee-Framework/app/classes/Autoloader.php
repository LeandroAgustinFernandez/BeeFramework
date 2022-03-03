<?php

class Autoloader
{
    /**
     * Metodo encargado de ejecutar el autocargador de forma estatica
     * 
     * @return void
     */
    public static function init()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($className)
    {
        if (is_file(CLASSES . $className . '.php')) {
            require_once CLASSES . $className . '.php';
        }
        if (is_file(CONTROLLERS . $className . '.php')) {
            require_once CONTROLLERS . $className . '.php';
        }
        if (is_file(MODELS . $className . '.php')) {
            require_once MODELS . $className . '.php';
        }
        return;
    }
}
