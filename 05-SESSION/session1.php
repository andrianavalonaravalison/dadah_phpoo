<?php

// ----------------------------------------------
echo '<h2> La superglobal $_SESSION </h2>';
// ----------------------------------------------

// Principe des sessions : un fichier temporaire appelé "session" est créers sur le serveur avec un identifiant unique. Cette session est liée à un internaute car dans le meme temps, un cookie est déposé dans son navigateur avec l'identifiant (au nom de PHPSESSID) . Ce cookie se détruit lrsqu'on quitte le navigateur.

// La session peut contenir toutes sortes d'informations, y compris sensible, car elle n'est pas accessible par l'internaute, donc pas modifiable par celui-ci. On y stocke les données de login, les panier d'achat ... 

// Tous les sites qui fonctionnent sur le principe de connexion (site bancaire ....) ou qui ont de suivre un internaute de page en page (avec son panier par ex) utilisent les sessons.

// Les données du fichier de session sont accessible et manipulables à partir de la superglobale $_SESSION.

// Création d'une session :
session_start(); // permet de créer un fichier de session OU de l'ouvrir s'il existe déjà

// Remplissage du fichier de session : 

$_SESSION['pseudo'] = 'tintin';
$_SESSION['mdp'] = 'milou'; // $_SESSION étant une superglobal, c'est un array. On accède dons à ses valeurs en passant par les indices écrits entre [ ] . 

echo '1- La session après remplissage : ';
print_r($_SESSION);
// Les sessions se trouvent dans le dossier xampp/tmp/


// Vider une partie de la session :
unset($_SESSION['mdp']); // nous supprimons le mot de passe avec unset().

echo '<br> 2- La session après suppression du mdp : ';
print_r($_SESSION);

// Suppression de toutes la session :
// session_destroy(); // suppression de la session MAIS il faut savoir que  le session_destroy() est d'abord vu par l'interpréteur qui ne l'execute qu'à la fin du script.

echo '<br> 3- La session après suppression : ';
print_r($_SESSION); // nous avons fait un session_destroy() mais il ne sera exécuté qu'à la fin de ce script, c'est la raison pour laquelle nous avons encore accès aux information ici.


// Les sessions ont l'avantage d'etre disponible partout sur le site : voir session2.php. 

echo '<p><a href="session2.php">Aller page 2 </a></p>';






