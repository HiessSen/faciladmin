<?php
// Point d'entrée de l'application

// Démarrer la session
session_start();

// Appel des fichiers nécéssaire au bon fonctionnement du site
require_once 'config/lang_helper.php';
require_once 'config/autoload.php';
require_once 'core/Router.php';

if (isset($_GET['lang'])) { // Si l'utilisateur change de langue
  setLanguage($_GET['lang']);
}
$lang = getLanguage();
// Créer une instance du routeur
$router = new Router();

// Définir les routes

// Les routes des pages principales
$router->addRoute('', 'HomeController', 'index');
$router->addRoute('home', 'HomeController', 'index');
$router->addRoute('today', 'TodayController', 'index');

// Les routes liées a USER
$router->addRoute('login', 'UserController', 'login');
$router->addRoute('logout', 'UserController', 'logout');
$router->addRoute('profile', 'UserController', 'profile');
$router->addRoute('register', 'UserController', 'register');

$router->addRoute('activities', 'ActivityController', 'index');

$router->addRoute('calendar', 'CalendarController', 'getCalendar');
$router->addRoute('addToCalendar', 'CalendarController', 'addToCalendar');

// Traiter la requête
$router->handleRequest();
?>