<?php

/*
	1- Création d'une page permettant l'affichage.
	2- Le dimension de la photo est  90px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque bien qui amène au détail du bien (detail_immo.php).

*/

// TRAITEMENT PHP // 

// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}



// Requête
$resultat = $pdo->query("SELECT id_logement, titre, type_bien, adresse, surface, photo, prix FROM logement"); // on sélectione tous les contenus du table "logement"

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des biens</title>
    
      <style>
    table, th, tr, td {
        border: 1px solid;
        text-align: center;
    }
    table {
        border-collapse: collapse;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    </style>

</head>
<body>
    
    <table>
        <tr class="list-group list-group-horizontal" style="background:green">
            <th class="list-group-item">Identification</th>
            <th class="list-group-item">Titre</th>
            <th class="list-group-item">Type</th>
            <th class="list-group-item">Adresse</th>
            <th class="list-group-item">Surface</th>
            <th class="list-group-item">Photo</th>
            <th class="list-group-item">Prix</th>
            <th class="list-group-item">Voir</th>
        </tr>
   
<?php

        while ($immo = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // debug($immo);
            echo '<tr>';
                foreach ($immo as $indice => $valeur) {

                    if ($indice == 'photo') {
                        echo '<td><img src=" ' . $valeur . '" style="width:90px"></td>';
                    } else {
                        echo '<td>' . $valeur . '</td>';
                    }
                }
                echo '<td><a href="detail_immo.php?id_logement='. $immo['id_logement'] .'">détail</a></td>'; // on envoie à la page detail_immo.php l'identifiant du  "id_immo". Sa valeur se trouve dans le tableau $immo qui contient un indice "id_logement".
            echo '</tr>';

        }

?>
    </table>
</body>
</html>


