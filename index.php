<?php

require_once './vendor/autoload.php';
require './php/controller.php';
require './php/pdo.php';

$loader = new Twig_Loader_Filesystem('./views');

$twig = new Twig_Environment($loader, [
  'cache' => false
]);

$twig->addFunction(new \Twig_SimpleFunction('baseUrl', function ($url) {

  $rootUrl = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

  return $rootUrl.$url;

}));

$pdo = new Database();

switch (true) {

  case !empty($_GET['add']):
    return ctrlAdd($twig, $pdo);
    break;

  case !empty($_GET['id']):
    return ctrlDetails($twig, $pdo, $_GET['id']);
    break;

  case !empty($_GET['year']):
    return ctrlYear($twig, $pdo, $_GET['year']);
    break;

  case !empty($_GET['genre']):
    return ctrlGenre($twig, $pdo, $_GET['genre']);
    break;

  case !empty($_GET['director']):
    return ctrlDirector($twig, $pdo, $_GET['director']);
    break;

  case !empty($_GET['actor']):
    return ctrlActor($twig, $pdo, $_GET['actor']);
    break;

  default:
    return ctrlMovies($twig, $pdo);
    break;

}

?>
