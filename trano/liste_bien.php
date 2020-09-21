<?php

/*
	1- Afficher dans une table HTML la liste des biens avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

*/

// TRAITEMENT PHP // 

// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=trano', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}



// Requête
$resultat = $pdo->query("SELECT id_logement, titre, type_bien, adresse, surface, photo, prix FROM logements"); // on sélectione tous les contenus du table "logements"

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
                echo '<td><a href="detail_bien.php?id_logement='. $contact['id_logement'] .'">détail</a></td>'; // on envoie à la page detail_bien.php l'identifiant du contact "id_logement". Sa valeur se trouve dans le tableau $contact qui contient un indice "id_contact" d'après le debug fait ligne 63.
            echo '</tr>';

        }



?>
    </table>
</body>
</html>


