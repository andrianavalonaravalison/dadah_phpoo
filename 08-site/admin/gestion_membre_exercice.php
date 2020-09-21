<?php
// exercice

// Exercice
/*
   1- Seul l'administrateur doit avoir accès à cette page. Les autres sont redirigés vers la page de connexion.
   2- Afficher tous les membres inscrits dans une table HTML, avec toutes les infos du membre SAUF son mot de passe. Vous ajoutez une colonne "action".
   3- Afficher le nombre de membres inscrits.
   4- Dans la colonne "action", ajoutez un lien "supprimer" pour supprimer un membre inscrit, SAUF vous même qui êtes connecté.
   5- Bonus : dans la colonne "action", ajoutez un lien pour pouvoir modifier le statut des membres pour en faire un admin ou un membre, sauf vous même qui êtes connecté.
*/

require_once '../inc/init.php';
//debug($_SESSION);

if (!estAdmin()) { 
    header('location:../connexion.php'); 
    exit();
}

$resultat = executeRequete("SELECT id_membre, nom, prenom, pseudo, email, civilite, ville, code_postal, adresse FROM membre");
//debug($resultat);


require_once '../inc/header.php';
?>
<h1>Info membres</h1>
<hr>
                        <style>
                        th, table {
                            border: 1px solid;
                           
                        }

                        </style>

<table class="table">
    <tr>
        <th>id_membre</th>
        <th>nom</th>
        <th>prenom</th>
        <th>pseudo</th>
        <th>email</th>
        <th>civilite</th>
        <th>ville</th>
        <th>code postal</th>
        <th>adresse</th>
    </tr>
</table>

<?php
while ($manga = $resultat->fetch(PDO::FETCH_ASSOC)) {

echo '<tr>';

    foreach ($manga as $indice => $info) { 

            echo '<th> '. $info .'</th>';

    }

echo '</tr><br>';

}





require_once '../inc/footer.php';

