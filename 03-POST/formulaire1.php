<?php


// ----------------------------------------------
echo '<h2> La superglobal $_POST </h2>';
// ----------------------------------------------

// $_POST est une superglbale qui permet de récupérer les données saisies dans un formulaire.

// $_POST étant une superglobale, est donc un array et est disponible dans tous les contextes du script y compris au sein des fonctions sans y faire "global $_POST". 

// Les données saisies dans le formulaire sont réceptionnées dans $_POST de la manière suivante :
// $_POST = array('name1 => 'valeur input1', 'nameN' => 'valeur inputN');


echo '<pre>';
print_r($_POST); // pour vérifier que le formulaire envoie bien des données
echo '</pre>';

if(!empty($_POST)) { // si n'est pas vide $_POST c'est que l'on a reçu des données du formulaire. On a donc en afficher le contenu : 
    echo '<p>Prénom : ' . $_POST['prenom'] . '</p>';
    echo '<p>Description : ' . $_POST['description'] . '</p>';
}

// Remarque :
// - Cliquer dans l'url et faire entrer permet de réinitialiser le formulaire comme si nous venions pour la première fois.
// - faire F5 ou CTRL+r permet de rafraichir la page et de renvoyer les dernières saisies dans le formulaire.

?>


<h1>Formulaire</h1>

<form method="post" action=""> <!-- un formulaire doit toujour etre dans une balise <form> pour fonctionner. L'attribut method définit comment les données vont circuler entre le navigateur et le serveur. L'attribut action définit l'URL de destination des données saisies. -->

    <div><label for="prenom">Prénom</div>
    <div ><input type="text" name="prenom" id="prenom"></div> <!-- il ne faut pas oublier les "name" dans les formulaires : il constituent les indices du tableau $_POST qui réceptionne les données -->

    <div><label for="description">Description</div> <!-- L'attribut for n'est pas indispensable, mais il permet de relier le label à l'input qui porte un id de meme valeur. Ainsi quand on click sur l'étiquete, le curseur se positionne dans l'input. -->
    <div><textarea name="description" id="description"></textarea></div>

    <div><input type="submit" value="envoyer"></div>

</form>
















