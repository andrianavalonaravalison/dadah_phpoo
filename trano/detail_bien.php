<?php
// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=trano', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// debug($_GET);

if (isset($_GET['id_logement'])) { // si "id_contact" est dans l'url c'est que l'on a demandé détail du contact


    // Echappement des données :
    $_GET['id_logement']  = htmlspecialchars($_GET['id_logement'], ENT_QUOTES ); // pour éviter les risques XSS et CSS (les chevrons sont transformés en entité HTML).

    // requête préparée car le $_GET vient de l'internaute :
    $resultat = $pdo->prepare("SELECT * FROM logements WHERE id_logement = :id_logement "); // marqueur "vide"

    $resultat->execute(array(':id_logement' => $_GET['id_logement'])); // on associe le marqueur à la valeur qui passe par l'url donc dans $_GET

    // je vais donc le chercher !!! (fetch)
    $contact = $resultat->fetch(PDO::FETCH_ASSOC); // on "fetch" $resultat pour aller chercher les données du contact qui s'y trouvent.
    //debug($contact); // cliquéna alou de hita eo

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Détail de bien</title>
</head>
<body>

   <?php  

   if (empty($contact)) {

      echo  '<p> Bien inexistant...</p>';

   } else {

     echo '<div><img src="'. $contact['photo'] .'"></div>';
     echo '<h1>' . $contact['type_bien'] . '</h1>';
     echo '<h2> Type de bien : ' . $contact['type_bien'] . '</h2>';
     echo '<h2> Surface : ' . $contact['surface'] . '</h2>';
     echo '<div> Adresse : ' . $contact['adresse'] . '</div>';
   }

   echo '<a href="liste_bien.php" class="btn btn-primary">Retour</a>';
   
   ?>

</body>
</html>