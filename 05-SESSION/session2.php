<?php
// Ouverture de la session :
session_start(); // lorsque je fais un session_start() ici, la session n'est pas recréer car elle existe déjà grace au session_start() situé dans le fichier session1.php. 

echo 'Le fichier de session reste accessible dans tous les script du site comme ici : ';
print_r($_SESSION);

// ce fichier session2.php n'a pas de lien avec le précédent, il n'y a pas d'inclusion, il pourrait etre dans n'importe quel dossier, s'appeler n'importe comment, les données contenues restent accessibles grace à la session.

echo '<p><a href="session1.php">Aller page 1 </a></p>';




