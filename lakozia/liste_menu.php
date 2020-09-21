<?php

/*
	1- Afficher dans une table HTML la liste des biens avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

*/

// TRAITEMENT PHP // 

// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=manga', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}



// Requête
$resultat = $pdo->query("SELECT id_manga, choix, photo, prix, description FROM menu"); // on sélectione tous les contenus du table "menu"

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>liste menu</title>
  </head>
  <body>
  <div class="container">
    <h1 style="text-align:center; color: blue">Liste des menu Hotely MANGA</h1>

       <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="formulaire_remplissage.php">RETOUR AU FORMULAIRE</a>
    </nav> <br>


<table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Choix</th>
            <th scope="col">Photo</th>
            <th scope="col">Prix</th>
            <th scope="col">Description</th>
            <th scope="col">Voir</th>
            </tr>
        </thead>
<?php
        while ($contact = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // debug($contact);
            echo '<tr>';
                foreach ($contact as $indice => $valeur) {

                    if ($indice == 'photo') {
                        echo '<td><img src=" ' . $valeur . '" style="width:90px"></td>';
                    } else {
                        echo '<td>' . $valeur . '</td>';
                    }
                }
                echo '<td><a href="detail_menu.php?id_manga='. $contact['id_manga'] .'">détail</a></td>'; // on envoie à la page detail_bien.php l'identifiant du contact "id_logement". Sa valeur se trouve dans le tableau $contact qui contient un indice "id_contact" d'après le debug fait ligne 63.
            echo '</tr>';

        }
    
?>

</table>





</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>