<?php


echo '<pre>';
print_r($_POST);
echo '</pre>';

if(!empty($_POST)) { 
    echo '<p>Ville : ' . $_POST['ville'] . '</p>';
    echo '<p>Code postal : ' . $_POST['cp'] . '</p>';
    echo '<p>Adresse : ' . $_POST['adresse'] . '</p>';

//-----------------------------
// ECRIRE DANS UN FICHIER TXT
// ----------------------------

// on va écrire les adresses des internautes dans un fichier texte créer dynamiquement sur le serveur (en l'absence de BDD).

$file = fopen('adresses.txt', 'a'); // fopen() en mode "a" créer le fichier s'il n'existe pas sinon l'ouvre.

$adresse = $_POST['adresse'] . ' - ' . $_POST['cp'] . ' - ' . $_POST['ville'] . "\n"; // on cocatène l'adresse de l'internaute avec un saut de ligne à la fin ("\n").

fwrite($file, $adresse); // frwite( ) écrit le contenu de la variable $adresse dans le fichier représenté par $file.

fclose($file); // puis on ferme le fichier pour libérer la ressource.


} // fin de notre condition


