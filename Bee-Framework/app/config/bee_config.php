<?php
// Saber si trabajamos de forma local o remota
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));
// Definir el Usos horarios del sistema
date_default_timezone_set('America/Mexico_City');
// Lenguaje 
define('LANG', 'es');
// Ruta base de nuestro proyecto
define('BASEPATH', IS_LOCAL ? '/creacionframework/' : '___EL BASEPATH EN PRODUCCION___');
//Sal del sistema SIRVE PARA SUMAR SEGURIDAD A LAS CONSTRASENIAS
define('AUTH_SALT', 'BeeFramework<3');
//Puerto y URL del sitio.
define('PORT', '8848');
define('URL', IS_LOCAL ? 'http://127.0.0.1:' . PORT . '/creacionframework/' : '____URL EN PRODUCCION___');
// http://127.0.0.1:8848/creacionframework/

//Las rutas de directorios y archivos.
define('DS', DIRECTORY_SEPARATOR); // diagonal invertida \
define('ROOT', getcwd() . DS);

define('APP', ROOT . 'app' . DS);
define('CLASSES', APP . 'classes' . DS);
define('CONFIG', APP . 'config' . DS);
define('CONTROLLERS', APP . 'controllers' . DS);
define('MODELS', APP . 'models' . DS);
define('FUNCTIONS', APP . 'functions' . DS);


define('TEMPLATES', ROOT . 'templates' . DS);
define('INCLUDES', TEMPLATES . 'includes' . DS);
define('MODULES', TEMPLATES . 'modules' . DS);
define('VIEWS', TEMPLATES . 'views' . DS);

//Rutas de archivos ASSETS con base URL 
define('ASSETS', URL . 'assets/');
define('CSS', ASSETS . 'css/');
define('FAVICON', ASSETS . 'favicon/');
define('FONTS', ASSETS . 'fonts/');
define('IMAGES', ASSETS . 'images/');
define('JS', ASSETS . 'js/');
define('PLUGINS', ASSETS . 'plugins/');
define('UPLOADS', ASSETS . 'uploads/');

//Credenciales para la base de datos
// Set para conexion local o de desarrollo. 
define('LDB_ENGINE', 'mysql');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'u4_p1_db');
define('LDB_USER', 'root');
define('LDB_PASS', '');
define('LDB_CHARSET', 'utf8');
define('LDB_PORT', '3308');

//Set para conexion en produccion o servidor real.
define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '__REMOTE DB__');
define('DB_USER', '__REMOTE DB__');
define('DB_PASS', '__REMOTE DB__');
define('DB_CHARSET', '__REMOTE DB__');
define('DB_PORT', '__REMOTE DB__');

//El controlador por defecto / el medotodo por efect . y el controlador de errores por defecto. 
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ERROR_CONTROLLER', 'error');
define('DEFAULT_METHOD', 'index');
