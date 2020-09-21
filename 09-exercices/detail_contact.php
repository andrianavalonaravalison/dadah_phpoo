<?php
/*
   1- Vous affichez le détail complet du contact demandé, y compris la photo. Si le contact n'existe pas, vous laissez un message. 

*/

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// debug($_GET);

if (isset($_GET['id_contact'])) { // si "id_contact" est dans l'url c'est que l'on a demandé détail du contact


      // Echappement des données :
      $_GET['id_contat']  = htmlspecialchars($_GET['id_contact'], ENT_QUOTES ); // pour éviter les risques XSS et CSS (les chevrons sont transformés en entité HTML).

      // requête préparée car le $_GET vient de l'internaute :
      $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact "); // marqueur "vide"

      $resultat->execute(array(':id_contact' => $_GET['id_contact'])); // on associe le marqueur à la valeur qui passe par l'url donc dans $_GET

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
   <title>Détail contact</title>
</head>
<body>

   <?php  

   if (empty($contact)) {

      echo  '<p> Contact inexistant...</p>';

   } else {

      echo '<div><img src="'. $contact['photo'] .'"></div>';
      echo '<h1>' . $contact['prenom'] . ' ' . $contact['nom'] . '</h1>';
      echo '<h2> Téléphone : ' . $contact['telephone'] . '</h2>';
      echo '<h2> Email : ' . $contact['email'] . '</h2>';
      echo '<div> Type : ' . $contact['type_contact'] . '</div>';
   }
   
   ?>

</body>
</html>




