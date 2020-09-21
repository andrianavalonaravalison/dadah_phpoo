<?php
// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=manga', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//debug($_GET);

if (isset($_GET['id_manga'])) { // si "id_contact" est dans l'url c'est que l'on a demandé détail du contact


    // Echappement des données :
    $_GET['id_manga']  = htmlspecialchars($_GET['id_manga'], ENT_QUOTES ); // pour éviter les risques XSS et CSS (les chevrons sont transformés en entité HTML).

    // requête préparée car le $_GET vient de l'internaute :
    $resultat = $pdo->prepare("SELECT * FROM menu WHERE id_manga = :id_manga "); // marqueur "vide"

    $resultat->execute(array(':id_manga' => $_GET['id_manga'])); // on associe le marqueur à la valeur qui passe par l'url donc dans $_GET

    // je vais donc le chercher !!! (fetch)
    $contact = $resultat->fetch(PDO::FETCH_ASSOC); // on "fetch" $resultat pour aller chercher les données du contact qui s'y trouvent.
    //debug($contact); // cliquéna alou de hita eo

}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Détails du menu</title>
  </head>
  <body>
<div class="container">
<h1 style="text-align:center; color: blue">Détails du menu Hotely MANGA</h1>

<nav class="navbar navbar-dark bg-primary">
 <a class="navbar-brand" href="liste_menu.php">RETOUR LISTE</a>
</nav> <br>
        <?php  

        if (empty($contact)) {

            echo  '<p> Menu inexistant...</p>';

        } else {

            echo '<div><img src="'. $contact['photo'] . '"></div>';
            echo '<h1>' . $contact['choix'] . '</h1>';
            echo '<h2> Description : ' . $contact['description'] . '</h2>';
 
            echo '<div> Prix : ' . $contact['prix'] . ' €</div>';
        }

            echo '<a href="liste_menu.php" class="btn btn-primary">Retour</a>';

        ?>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>