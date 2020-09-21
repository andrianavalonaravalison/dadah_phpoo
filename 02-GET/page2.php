<?php

// ----------------------------------------------
echo '<h2> La superglobal $_GET </h2>';
// ----------------------------------------------

// $_GET représente l'information qui transite dans l'URL. il s'agit d'une superglobal, et donc, comme toutes les superglobals, d'un array. Par ailleurs, superglobale signifie que cette variable est disponible dans tous les contexte du script, y compris dans l'espace local ds fnctions sans avoir besoin de faire "global $_GET". 

// Les informations transite dans l'URL sélon la syntaxe suivante :
// page.php?indice1=valeur1&indiceN=valeurN

// La superglobal $_GET receptionne les informations dans un tableau :
// $_GET = array("indice1" => "valeur1", "indiceN" => "valeurN");

//  Vérifier que l'on reçoit de l'information depuis l'URL:

//echo'<pre>';
  //  print_r($_GET);
//echo'</pre>';

if(isset($_GET['article']) && ($_GET['couleur']) && ($_GET['prix'])) {

    echo '<h1>' . $_GET['article'] . '</h1>';
    echo '<p> Couleur : ' . $_GET['couleur'] . '</p>';
    echo '<p> Prix : ' . $_GET['prix'] . ' euros ' . '</p>';

} else {
    echo '<p> Veuillez choisir un produite <a href="page1.php"> ici </a></p>';
}

// En réalité nous passons l'identifiant du produit dans l'URL afin d'en sélectionner les informations dans le BDD




