<?php
/* 
 * CONTROLADOR FRONTAL 
 * 
 * Todas las peticiones pasaran por esta página
 * 
 * Enfoque orientado a objetos usando objetos para Controlador, ControladorFrontal
 * Modelo
 * 
 */
//Iniciamos la sesión para el control de usuarios.
session_start();

// definimos constantes que facilitan el trabajo
define('APP_PATH', __DIR__.'/');
define('CTRL_PATH', __DIR__.'/controllers/');
define('MODEL_PATH', __DIR__.'/models/');
define('VIEW_PATH', __DIR__.'/views/');
define('TEMPLATE_PATH', __DIR__.'/plantilla/');
define('LIB_PATH', __DIR__.'/lib/');
define('HELPERS_PATH', __DIR__.'/helpers/');
define("PAGEELEMENTS", 2);

include (HELPERS_PATH.'vistas.php');
include (CTRL_PATH .'Front_Controller.php');

$FC=Front_Controller::getInstance('Tareas');
$FC->Run();
