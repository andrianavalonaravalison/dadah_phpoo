<?php

// ----------------------------------------------
echo '<h2> La superglobal $_COOKIE </h2>';
// ----------------------------------------------

// Un cookie est un petit fichier (4ko max) déposé par le serveur du site dans le navigateur de l'internaute et qui peut contenir des informations. Les cookies sont automatiquement renvoyés au serveur web par le navigateur quand l'internaute navigue dans les pages concernées par le cookie. PHP permet de récupérer très facilement les données contenues dans un cookie : ses informations sont stockées dans la superglobale $_COOKIE.

// Précaution à prendre avec les cookies : étant sauvgardé dans le post de l'internaute, le cookie peut etre volé ou modifié. On n'y met donc pas d'information sensibles (prix de panier, CB, mot de passe ...) mais des préférence ou des traces de visites par exemple.

// Application : nous allons stocker la langue sélectionnée par l'internaute dans un cookie.

// 2- On détarmine la langue d'affichage pour l'internaute :

    if(isset($_GET['langue'])) { // si on a cliqué sur une langue, l'indice langue est passé dans l'url donc se trouve dans $_GET.
        $langue = $_GET['langue']; // on affecte alors la valeur de la langue à la variable $langue ("fr" ou "en" ...) . 
    }elseif (isset($_COOKIE['langue'])) { // sinon si on a reçu un cookie appelé "langue"
        $langue = $_COOKIE['langue']; // affecte la valeur stocké dans le cookie. L'indice "langue" correspond au NOM du cookie
    }else {
        $langue = 'fr'; // par défaut, si on n'a pas cliqué et qu'aucun cookie n'existe, la langue sera "fr". 
    }

// 3- On envoie le cookie :
$un_an = time() + 365*24*60*60; // time() retourne timstamp de l'instant présent auquel on ajoute 1 an exprimé en secondes. Pour mémoire timestamp = nombre de seconde écoulées dépuis le 01/01/1970.



setcookie('langue', $langue, $un_an); // on envoie un cookie appelé "langue" avec la valeur celle qui est dans $langue, avec pour date d'expiration $un_an. 

// 4- On affiche la langue :
echo"<h2>La langue du site : $langue </h2>";


// setcookie() permet de créer un cookie. Cependant il n'y a pas de fonction prédéfinie permettant de le supprimer. Pour cela, on le met à jour avec une date périmée, ou à zéro, ou encore en mettent juste le nom du cookie sans les autres arguments.


// 1- Le HTML

?>

<h1>langue</h1>

<ul>
    <li><a href="?langue=fr">Français</a></li>
    <li><a href="?langue=es">Espagnol</a></li>
    <li><a href="?langue=en">Anglais</a></li>
    <li><a href="?langue=it">Italien</a></li>
</ul>









