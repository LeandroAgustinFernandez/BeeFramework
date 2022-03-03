<?php

class Bee
{
    //Propiedades del framework
    private $framework = 'Bee Framework';
    private $version = '1.0.0';
    private $uri = [];

    function __construct()
    {
        $this->init();
    }

    /**
     * Metodo para ejecutar cada metodo de forma subsecuente
     * 
     * @return void
     */
    private function init()
    {
        $this->init_session();
        $this->init_load_config();
        $this->init_load_function();
        $this->init_autoload();
        $this->init_csrf();
        $this->dispatch();  
    }

    /**
     * Metodo para iniciar la sesion en el sistema
     * 
     * @return void
     */
    private function init_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return;
    }
    /**
     * Metodo para cargar la configuracion del sistema
     * 
     * @return void
     */
    private function init_load_config()
    {
        $file = 'bee_config.php';
        //is_file() funciona mejor que file_exists
        if (!is_file('app/config/' . $file)) {
            die(sprintf('El archivo $s no se encuentra, es requerido para que $s funcione', $file, $this->framework));
        }
        require_once 'app/config/' . $file;
        return;
    }
    /**
     * Metodo para cargar todas las funciones core del sistema y el usuario
     * 
     * @return void
     */
    private function init_load_function()
    {
        $file = 'bee_core_functions.php';
        if (!is_file(constant('FUNCTIONS') . $file)) {
            die(sprintf('El archivo $s no se encuentra, es requerido para que $s funcione', $file, $this->framework));
        }
        require_once constant('FUNCTIONS') . $file;

        $file = 'bee_custom_functions.php';
        if (!is_file(constant('FUNCTIONS') . $file)) {
            die(sprintf('El archivo $s no se encuentra, es requerido para que $s funcione', $file, $this->framework));
        }
        require_once constant('FUNCTIONS') . $file;
        return;
    }
    /**
     * Metodo para cargar todos los archivos de forma automatica
     * 
     * @return void
     */
    private function init_autoload()
    {
        require_once constant('CLASSES') . 'Autoloader.php';
        Autoloader::init();
        // require_once constant('CLASSES') . 'Db.php';
        // require_once constant('CLASSES') . 'Model.php';
        // require_once constant('CLASSES') . 'View.php';
        // require_once constant('CLASSES') . 'Controller.php';
        // require_once CONTROLLERS . DEFAULT_CONTROLLER . 'Controller.php';
        // require_once CONTROLLERS . DEFAULT_ERROR_CONTROLLER . 'Controller.php';
        return;
    }
    /**
     * Metodo para crear un token.
     * 
     * @return void
     */
    private function init_csrf()
    {
        $csrf = new Csrf();
    }

    /**
     * Filtrar y descomponer los elementos de nuestra URL y URI
     * 
     * @return void
     */
    private function filter_url()
    {
        if (isset($_GET['uri'])) {
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri, '/');
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/', strtolower($this->uri));
        }
        return $this->uri;
    }
    /**
     * Metodo para ejecutar y cargar de forma automatica el controlador solicitado por el usuario su metodo y pasar parametros a el.
     * 
     * 
     * @return void
     */
    private function dispatch() //despachar
    {
        //filtrar URL y separar la URI
        $this->filter_url();
        //Necesitamos saber si esta pasando el nombre de un controlador en nuestro URI
        //$this->uri[0] es el controlador en cuestion.
        if (isset($this->uri[0])) {
            $currentController = $this->uri[0];
            unset($this->uri[0]);
        } else {
            $currentController = DEFAULT_CONTROLLER;
        }
        $controller = $currentController . 'Controller';
        if (!class_exists($controller)) {
            $controller = DEFAULT_ERROR_CONTROLLER . 'Controller';
            $currentController = DEFAULT_ERROR_CONTROLLER;
        }
        //Ejecucion del metodo solicitado
        if (isset($this->uri[1])) {
            $method = str_replace('-', '_', $this->uri[1]);
            if (!method_exists($controller, $method)) {
                $controller = DEFAULT_ERROR_CONTROLLER . 'Controller';
                $currentController = DEFAULT_ERROR_CONTROLLER;
                $currentMethod = DEFAULT_METHOD;
            } else {
                $currentMethod =  $method;
            }
            unset($this->uri[1]);
        } else {
            $currentMethod = DEFAULT_METHOD;
        }

        define('CONTROLLER', $currentController);
        define('METHOD', $currentMethod);

        //Ejecutando Controlador y methodo
        $controller = new $controller;
        //Obteniendo los parametros
        $params = array_values(empty($this->uri) ? [] : $this->uri);
        //Llamada al metodo solicitado por el usuario
        if (empty($params)) {
            call_user_func([$controller, $currentMethod]);
        } else {
            call_user_func_array([$controller, $currentMethod], $params);
        }
        return;
    }

    /**
     *  Ejecuta el framework
     * 
     * 
     * @return void
     */
    public static function fly()
    {
        $bee = new self();
        return;
    }
}
