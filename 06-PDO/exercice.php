<h1>Les commerciaux et leur salaire</h1>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) à changer
                'root', // pseudo de la BDD
                '', // mdp de la BDD
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // option 1 : on affiche les erreurs SQL
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : on définit le jeu de caractères des échanges avec la BDD
                )

);

// Exercice
// 1- affichez dans une liste <ul><li> le prénom, le nom et le salaire des commerciaux (1 commerciale par <li>). Pour cela, vous faites une requete préparée.
// 2- Affichez le nombre de commerciaux.

// Correction :
echo '<p> <b> avec foreach </b> </p>';

// préparation de requete :
$service = 'Commercial';
$resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service");

//print_r($resultat); // vérification
//echo '<br>';

// liaison :
$resultat->bindParam(':service', $service);

// ecécution :
$resultat->execute();
//print_r($resultat);

$service = $resultat->fetchAll(PDO::FETCH_ASSOC);

echo '<ul>';

foreach ($service as $indice => $employe) {
    echo '<li>' . $employe['prenom'] . ' ' . $employe['nom'] . ' ' . $employe['salaire'] . '€</li>';
}
echo '</ul>';


echo '<hr>';

// avec while :
    echo '<p> <b> avec while </b> </p>';

    $service = 'Commercial';
    $resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service");
    
    //print_r($resultat); // vérification
    //echo '<br>';
    
    // liaison :
    $resultat->bindParam(':service', $service);
    
    // ecécution :
    $resultat->execute();
    //print_r($resultat);

    while($employe = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>' . $employe['prenom'] . ' ' . $employe['nom'] . ' ' . $employe['salaire'] . '€</li>';
    }

echo '<hr>';

// nombre de commerciaux :

echo "Nombre de commerciaux : " . $resultat->rowCount() . '<br>';








