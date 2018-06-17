
<?php

require 'model.php';

function ctrlAdd($twig, $pdo) {

  $method = $_SERVER['REQUEST_METHOD'];


  switch ($method) {
    case 'GET':
    echo $twig->render('admin/add.html');
    break;

    case 'POST':
    echo $twig->render('admin/add.html', ['notif' => addMovie($pdo, $_POST)]);
    break;
    
    default:
      echo 'default';
    break;
  }

}

function ctrlMovies($twig, $pdo) {

  echo $twig->render('index.html', ['data' => getMovies($pdo)]);

}

function ctrlDetails($twig, $pdo, $id) {

  $back = getDetails($pdo, $id);

  if (is_array($back)) {

    echo $twig->render('details.html', ['data' => $back]);

  } else {

    echo $twig->render('empty.html');

  }

}

function ctrlYear($twig, $pdo, $year) {

  $back = getYear($pdo, $year);

  if (is_array($back)) {

    echo $twig->render('results.html', ['data' => $back, 'title' => 'Films années '.$year]);

  } else {

    echo $twig->render('empty.html');

  }

}

function ctrlGenre($twig, $pdo, $genre) {

  $back = getGenre($pdo, $genre);

  if (is_array($back)) {

    echo $twig->render('results.html', ['data' => $back, 'title' => 'Films genre '.$back[0]['name']]);

  } else {

    echo $twig->render('empty.html');

  }

}

function ctrlDirector($twig, $pdo, $director) {

  $back = getDirector($pdo, $director);

  if (is_array($back)) {

    $fullname = $back[0]['firstname'].' '.$back[0]['lastname'];

    echo $twig->render('results.html', ['data' => $back, 'title' => 'Films de '.$fullname]);

  } else {

    echo $twig->render('empty.html');

  }

}

function ctrlActor($twig, $pdo, $actor) {

  $back = getActor($pdo, $actor);

  if (is_array($back)) {

    $fullname = $back[0]['firstname'].' '.$back[0]['lastname'];

    echo $twig->render('results.html', ['data' => $back, 'title' => 'Films avec '.$fullname]);

  } else {

    echo $twig->render('empty.html');

  }

}

?>
