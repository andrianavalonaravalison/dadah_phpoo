<?php
// Exercice :

/*
    1- vous affichez dans ce script : 1 titre "Mon profil", un nom et un prénom
    2- Vous y ajoutez un lien en GET "Modifier mon profil" . Ce lien passe dans l'URL à la page exercice.php que l'ACTION demandée est modification.
    3- Si vous recevez cette information depuis l'URL vous affichez "Vous avez demandé la modification de cotre profil". 
*/

print_r($_GET); // pour vérifier que je reçoit de l'info par l'URL

?>

<h1> Mon profil </h1>

    <?php
        if (isset($_GET['action']) && $_GET['action'] == 'modification') { // si existe action dans $_GET, donc dans l'URL , c'est qu'on a cliqué sur le lien "modifier mon profil". Puis on vérifie que la valeur de $_GET['action'] est "modification", auquel cas on a cliqué sur le lien "modifier". 
            echo '<p> Vous avez demander la modification de votre profil </p>';
        }
    ?>

<p>Nom DOE </p>
<p> Prénom : JOHN </p>

<a href="?action=modification"> Modifier mon profil </a></p>



















