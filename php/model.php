
<?php

function getMovies($pdo): array {

  $statement = $pdo->getInstance()->prepare("SELECT * FROM movies");
  $statement->execute();

  $data = $statement->fetchAll();

  // echo '<pre>';
  // var_dump($data);
  // echo '</pre>';

  return $data;

}

function getDetails($pdo, $id) {

  $data = [];

  // movie
  $request = "SELECT *
  FROM movies
  WHERE id = ?";

  $statement = $pdo->getInstance()->prepare($request);
  $statement->execute([$id]);
  $step = $statement->fetch();

  if(is_array($step)) {

    array_push($data, ['movie' => $step]);

    // directors
    $request = "SELECT firstname, lastname, d.id
    FROM directors d
    INNER JOIN movies_directors m_d   ON d.id = m_d.directors_id
    INNER JOIN movies m               ON m_d.movies_id = m.id
    WHERE m.id = ?";

    $statement = $pdo->getInstance()->prepare($request);
    $statement->execute([$id]);
    $step = $statement->fetchAll();
    array_push($data, ['directors' => $step]);

    // actors
    $request = "SELECT firstname, lastname, a.id
    FROM actors a
    INNER JOIN actors_movies a_m   ON a.id = a_m.actors_id
    INNER JOIN movies m            ON a_m.movies_id = m.id
    WHERE m.id = ?";

    $statement = $pdo->getInstance()->prepare($request);
    $statement->execute([$id]);
    $step = $statement->fetchAll();
    array_push($data, ['actors' => $step]);

    // genres
    $request = "SELECT name, g.id
    FROM genres g
    INNER JOIN movies_genres m_g   ON g.id = m_g.genres_id
    INNER JOIN movies m            ON m_g.movies_id = m.id
    WHERE m.id = ?";

    $statement = $pdo->getInstance()->prepare($request);
    $statement->execute([$id]);
    $step = $statement->fetchAll();
    array_push($data, ['genres' => $step]);

    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';

    return $data;

  } else {

    return false;

  }

}

function getYear($pdo, $year) {

  $data = [];

  $statement = $pdo->getInstance()->prepare("SELECT * FROM movies WHERE year = ?");
  $statement->execute([$year]);
  $data = $statement->fetchAll();

  // echo '<pre>';
  // var_dump($data);
  // echo '</pre>';

  if(count($data) > 0)
    return $data;

  return false;

}

function getGenre($pdo, $genre) {

  $data = [];

  $request = "SELECT *
  FROM genres g
  INNER JOIN movies_genres m_g   ON g.id = m_g.genres_id
  INNER JOIN movies m            ON m_g.movies_id = m.id
  WHERE g.id = ?";

  $statement = $pdo->getInstance()->prepare($request);
  $statement->execute([$genre]);
  $data = $statement->fetchAll();

  // echo '<pre>';
  // var_dump($data);
  // echo '</pre>';

  if(count($data) > 0)
    return $data;

  return false;

}

function getDirector($pdo, $director) {

  $data = [];

  $request = "SELECT *
  FROM directors d
  INNER JOIN movies_directors m_d   ON d.id = m_d.directors_id
  INNER JOIN movies m               ON m_d.movies_id = m.id
  WHERE d.id = ?";

  $statement = $pdo->getInstance()->prepare($request);
  $statement->execute([$director]);
  $data = $statement->fetchAll();

  // echo '<pre>';
  // var_dump($data);
  // echo '</pre>';

  if(count($data) > 0)
    return $data;

  return false;

}


function getActor($pdo, $actor) {

  $data = [];

  $request = "SELECT *
  FROM actors a
  INNER JOIN actors_movies a_m   ON a.id = a_m.actors_id
  INNER JOIN movies m            ON a_m.movies_id = m.id
  WHERE a.id = ?";

  $statement = $pdo->getInstance()->prepare($request);
  $statement->execute([$actor]);
  $data = $statement->fetchAll();

  // echo '<pre>';
  // var_dump($data);
  // echo '</pre>';

  if(count($data) > 0)
    return $data;

  return false;

}
function addMovie($pdo, $posted){

  if (isset($posted['submit'])) {
    if (!empty($posted['title']) && !empty($posted['description']) && !empty($posted['year']) && $_FILES['poster']['size'] != 0  && !empty($posted['actor_firstname']) && !empty($posted['actor_lastname']) && !empty($posted['actor2_firstname']) && !empty($posted['actor2_lastname']) && !empty($posted['actor3_firstname']) && !empty($posted['actor3_lastname']) && !empty($posted['director_firstname']) && !empty($posted['director_lastname']) && !empty($posted['genre'])){

///////   MOVIE ////// 

      $title = $posted['title'];
      $description = $posted['description'];
      $year = $posted['year'];
      $poster_img = $_FILES['poster'];
      $poster_path = $poster_img['name'];
      $uploads_dir = 'assets/posters';
      move_uploaded_file($poster_img['tmp_name'], $uploads_dir.'/'.$poster_path);


      $req = 'INSERT INTO movies (title, description, year, poster) 
      VALUES (:title, :description, :year, :poster)';

      $statement = $pdo->getInstance()->prepare($req);
      $statement->execute(array(
        'title' => $title,
        'description' => $description,
        'year' => $year,
        'poster' => $poster_path
      ));

    //on recupere l'id du dernier film
      $req ='SELECT MAX(id) FROM movies';
      $statement = $pdo->getInstance()->prepare($req);
      $statement->execute();
      $max_id = $statement->fetch();
      $max_id = $max_id["MAX(id)"];



//////   ACTORS  /////

    /// n°1  ///
      $actor_firstname = $posted['actor_firstname'];
      $actor_lastname = $posted['actor_lastname'];

      $req = $pdo->getInstance()->prepare('SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname');
      $req->execute(array(
        'firstname' => $actor_firstname,
        'lastname' => $actor_lastname
      ));
      $donnees = $req->fetch();

      if (!$donnees) {

        $req = 'INSERT INTO actors (firstname, lastname) 
        VALUES (:firstname, :lastname)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $actor_firstname,
          'lastname' => $actor_lastname
        ));

        $req ='SELECT MAX(id) FROM actors';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute();
        $max_id_actors = $statement->fetch();
        $max_id_actors = $max_id_actors["MAX(id)"];


        $req = 'INSERT INTO actors_movies (movies_id, actors_id) 
        VALUES (:m_id, :a_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'a_id' => $max_id_actors
        ));


      }else{  

        $req ='SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $actor_firstname,
          'lastname' => $actor_lastname
        ));
        $d_id = $statement->fetch(PDO::FETCH_ASSOC);
        $a_id = $a_id['id'];

        $req = 'INSERT INTO actors_movies (movies_id, actors_id) 
        VALUES (:m_id, :a_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'a_id' => $a_id
        ));

      }


    /// n°2  ///
      $actor2_firstname = $posted['actor2_firstname'];
      $actor2_lastname = $posted['actor2_lastname'];

      $req = $pdo->getInstance()->prepare('SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname');
      $req->execute(array(
        'firstname' => $actor2_firstname,
        'lastname' => $actor2_lastname
      ));
      $donnees = $req->fetch();

      if (!$donnees) {

        $req = 'INSERT INTO actors (firstname, lastname) 
        VALUES (:firstname, :lastname)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $actor2_firstname,
          'lastname' => $actor2_lastname
        ));

        $req ='SELECT MAX(id) FROM actors';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute();
        $max_id_actors = $statement->fetch();
        $max_id_actors = $max_id_actors["MAX(id)"];


        $req = 'INSERT INTO actors_movies (movies_id, actors_id) 
        VALUES (:m_id, :a_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'a_id' => $max_id_actors
        ));


      }else{  

        $req ='SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $actor2_firstname,
          'lastname' => $actor2_lastname
        ));
        $d_id = $statement->fetch(PDO::FETCH_ASSOC);
        $a_id = $a_id['id'];

        $req = 'INSERT INTO actors_movies (movies_id, actors_id) 
        VALUES (:m_id, :a_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'a_id' => $a_id
        ));

      }

    /// n°3  ///
      $actor3_firstname = $posted['actor3_firstname'];
      $actor3_lastname = $posted['actor3_lastname'];

      $req = $pdo->getInstance()->prepare('SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname');
      $req->execute(array(
        'firstname' => $actor3_firstname,
        'lastname' => $actor3_lastname
      ));
      $donnees = $req->fetch();

      if (!$donnees) {

        $req = 'INSERT INTO actors (firstname, lastname) 
        VALUES (:firstname, :lastname)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $actor3_firstname,
          'lastname' => $actor3_lastname
        ));

        $req ='SELECT MAX(id) FROM actors';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute();
        $max_id_actors = $statement->fetch();
        $max_id_actors = $max_id_actors["MAX(id)"];


        $req = 'INSERT INTO actors_movies (movies_id, actors_id) 
        VALUES (:m_id, :a_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'a_id' => $max_id_actors
        ));


      }else{  

        $req ='SELECT * FROM actors WHERE firstname = :firstname AND lastname = :lastname';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $actor3_firstname,
          'lastname' => $actor3_lastname
        ));
        $d_id = $statement->fetch(PDO::FETCH_ASSOC);
        $a_id = $a_id['id'];

        $req = 'INSERT INTO actors_movies (movies_id, actors_id) 
        VALUES (:m_id, :a_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'a_id' => $a_id
        ));

      }

/////////   DIRECTORS   ///////////

      $director_firstname = $posted['director_firstname'];
      $director_lastname = $posted['director_lastname'];


      $req = $pdo->getInstance()->prepare('SELECT * FROM directors WHERE firstname = :firstname AND lastname = :lastname');
      $req->execute(array(
        'firstname' => $director_firstname,
        'lastname' => $director_lastname
      ));
      $donnees = $req->fetch();

      if (!$donnees) {

        $req = 'INSERT INTO directors (firstname, lastname) 
        VALUES (:firstname, :lastname)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $director_firstname,
          'lastname' => $director_lastname
        ));

        $req ='SELECT MAX(id) FROM directors';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute();
        $max_id_directors = $statement->fetch();
        $max_id_directors = $max_id_directors["MAX(id)"];


        $req = 'INSERT INTO movies_directors (movies_id, directors_id) 
        VALUES (:m_id, :d_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'd_id' => $max_id_directors
        ));

      }else{

        $req ='SELECT * FROM directors WHERE firstname = :firstname AND lastname = :lastname';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'firstname' => $director_firstname,
          'lastname' => $director_lastname
        ));
        $d_id = $statement->fetch(PDO::FETCH_ASSOC);
        $d_id = $d_id['id'];

        $req = 'INSERT INTO movies_directors (movies_id, directors_id) 
        VALUES (:m_id, :d_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'd_id' => $d_id
        ));
      }


      if (!empty($posted['director2_firstname']) && !empty($posted['director2_lastname'])) {
        $director2_firstname = $posted['director2_firstname'];
        $director2_lastname = $posted['director2_lastname'];


        $req = $pdo->getInstance()->prepare('SELECT * FROM directors WHERE firstname = :firstname AND lastname = :lastname');
        $req->execute(array(
          'firstname' => $director2_firstname,
          'lastname' => $director2_lastname
        ));
        $donnees = $req->fetch();

        if (!$donnees) {

          $req = 'INSERT INTO directors (firstname, lastname) 
          VALUES (:firstname, :lastname)';

          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'firstname' => $director2_firstname,
            'lastname' => $director2_lastname
          ));

          $req ='SELECT MAX(id) FROM directors';
          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute();
          $max_id_directors = $statement->fetch();
          $max_id_directors = $max_id_directors["MAX(id)"];


          $req = 'INSERT INTO movies_directors (movies_id, directors_id) 
          VALUES (:m_id, :d_id)';

          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'm_id' => $max_id,
            'd_id' => $max_id_directors
          ));

        }else{

          $req ='SELECT * FROM directors WHERE firstname = :firstname AND lastname = :lastname';
          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'firstname' => $director2_firstname,
            'lastname' => $director2_lastname
          ));
          $d_id = $statement->fetch(PDO::FETCH_ASSOC);
          $d_id = $d_id['id'];

          $req = 'INSERT INTO movies_directors (movies_id, directors_id) 
          VALUES (:m_id, :d_id)';

          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'm_id' => $max_id,
            'd_id' => $d_id
          ));
        }
      }

////////   GENRE   /////////

      $genre = $posted['genre'];

      $req = $pdo->getInstance()->prepare('SELECT name FROM genres WHERE name = ?');
      $req->execute(array($genre));
      $donnees = $req->fetch();

      if (!$donnees) {

        $req = 'INSERT INTO genres (name) 
        VALUES (:name)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'name' => $genre
        ));
        $req ='SELECT MAX(id) FROM genres';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute();
        $max_id_genre = $statement->fetch();
        $max_id_genre = $max_id_genre["MAX(id)"];

        $req = 'INSERT INTO movies_genres (movies_id, genres_id) 
        VALUES (:m_id, :g_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'g_id' => $max_id_genre
        ));
      }else{

        $req ='SELECT * FROM genres WHERE name = ?';
        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array($genre));
        $g_id = $statement->fetch(PDO::FETCH_ASSOC);
        $g_id = $g_id['id'];

        $req = 'INSERT INTO movies_genres (movies_id, genres_id) 
        VALUES (:m_id, :g_id)';

        $statement = $pdo->getInstance()->prepare($req);
        $statement->execute(array(
          'm_id' => $max_id,
          'g_id' => $g_id
        ));

      }

      if (!empty($posted['genre2'])) {

        $genre2 = $posted['genre2'];

        $req = $pdo->getInstance()->prepare('SELECT name FROM genres WHERE name = ?');
        $req->execute(array($genre2));
        $donnees = $req->fetch();

        if (!$donnees) {

          $req = 'INSERT INTO genres (name) 
          VALUES (:name)';

          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'name' => $genre2
          ));
          $req ='SELECT MAX(id) FROM genres';
          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute();
          $max_id_genre = $statement->fetch();
          $max_id_genre = $max_id_genre["MAX(id)"];

          $req = 'INSERT INTO movies_genres (movies_id, genres_id) 
          VALUES (:m_id, :g_id)';

          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'm_id' => $max_id,
            'g_id' => $max_id_genre
          ));
        }else{

          $req ='SELECT * FROM genres WHERE name = ?';
          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array($genre2));
          $g_id = $statement->fetch(PDO::FETCH_ASSOC);
          $g_id = $g_id['id'];

          $req = 'INSERT INTO movies_genres (movies_id, genres_id) 
          VALUES (:m_id, :g_id)';

          $statement = $pdo->getInstance()->prepare($req);
          $statement->execute(array(
            'm_id' => $max_id,
            'g_id' => $g_id
          ));

        }

      }

    }else{
      echo 'Merci de remplir tous les champs';
    }
  }else{
    die();
  }
}


?>
