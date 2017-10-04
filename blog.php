<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

//on récipère la valeur du paramètre "act" dans l'url qui détermine le module dans lequel on se trouve (blog, chat...)
$act = (isset($_GET['act'])) ? htmlspecialchars($_GET['act']) : "blog";

//la valeur de la variable $act détermine le nom du contrôleur auquel on veut accéder
$controllerName = strtolower($act);

$className = strtolower($act) . 'Controller';

require("controleur/" . $controllerName . "/controller.php");

//instanciation de la class controller ainsi déterminée
$controller	= new $className();

//on récupère la valeur du paramètre "task" dans l'url qui détermine le nom de la méthode qu'on veut utiliser
$task = (isset($_GET['task'])) ? htmlspecialchars($_GET['task']) : "posts";

// Perform the Request task
$controller->execute( $task );

