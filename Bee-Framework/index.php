<?php
error_reporting(E_ALL); //Error/Exception engine, always use E_ALL
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log', 'C:/xampp/htdocs/creacionframework/php_error.log');
//Bee Framework version 1.0.0
//Desarrollado por Joystick para todos
//Julio 2019

//Requerir el archivo de la clase Bee.php

require_once 'app/classes/Bee.php';
Bee::fly(); //Metodo estatico

