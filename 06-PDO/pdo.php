<!--
<style>
body {

}

</style>
-->
<?php

// ----------------------------------------------
echo '<h2> PDO </h2>';
// ----------------------------------------------

// L'extension PDO , pour PHP Data Object, définit une interface pour accéder à une BDD depuis PHP, et permet d'y exécuter des requetes SQL.

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// ----------------------------------------------
echo '<h2> Connexion à la BDD </h2>';
// ----------------------------------------------

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) à changer
                'root', // pseudo de la BDD
                '', // mdp de la BDD
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // option 1 : on affiche les erreurs SQL
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : on définit le jeu de caractères des échanges avec la BDD
                )

);

// $pdo est un objet qui provient de la classe prédéfinie PDO et qui représente la connexion à la base de données.


// ----------------------------------------------
echo '<h2> Requete avec exec() </h2>';
// ----------------------------------------------

// Nous insérons un employé :

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2020-08-26', 1500)");

/*
    exec() est utilisé pour la formulation de requetes ne retournant pas de résultat : INSERT, UPDATE, DELETE.

    Valeur de retour :
        Succès : renvoie le nombre de ligne affectées
        Echec : false
*/

echo "nombre d'enregistrement affectés par l'INSERT : $resultat <br>";

echo "Dernier ID généré en BDD : " . $pdo->lastInsertId() . '<br>';

//---------

// effacer dans la table employes tous les prénoms 'test'. 
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test'");

echo "Nombre d'enregistrement affectés par le DELETE :  $resultat <br>";

echo '<hr>';

// ----------------------------------------------
echo '<h2> Requete avec query() et fetch() pour un seul résultat </h2>';
// ----------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");

/*
    Au contraire de exec(), query() est utilisé pour la formulation de requete qui retourne un ou plusieurs résultats : SELECT.

    Valeur de retour : 
        Succès : query() retourne un OBJET qui provient de la classe PDOStatement
        Echec : false
*/
debug($resultat); // $resultat est le résultat de la requete de sélection sous forme inexploitable directement. En effet nous ne voyons pas les information de Daniel. Pour accéder à ces information il nous faut utiliser la méthode fetch() :

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // La méthode fetch() avec le parametre PDO::FETCH_ASSOC retourne un tableau associatif exploitable dont les indices correspondent aux noms des champs de la requete. Ce tableau contient les données de Daniel. 

// on regarde le résultat de fetch() pour Daniel:
debug($employe);
echo 'Je suis ' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';

// On peut aussi utiliser les méthodes suivantes : 

// 1

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");

$employe = $resultat->fetch(PDO::FETCH_NUM); // pour obtenir un tableau indexé numériquement
debug($employe);
echo 'Je suis ' . $employe[1] . ' ' . $employe[2] . ' du service ' . $employe[4] . '<br>';

// 2

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(); // pour obtenir un mélange de tableau associatif et numérique

debug($employe); 
echo 'Je suis ' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>'; // resultat : les memes

echo 'Je suis ' . $employe[1] . ' ' . $employe[2] . ' du service ' . $employe[4] . '<br>';  // resultat : les memes

// 3

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(PDO::FETCH_OBJ); // retourne un objet avec le nom des champs comme propriété publiques

debug($employe); 

echo 'Je suis ' . $employe->prenom . ' ' . $employe->nom . ' du service ' . $employe->service . '<br>';

// Note : vous ne pouvez pas faire plusieurs fetch() sur le meme résultat, ce pourquoi nous répétons ici la requete.

// -----------
// Exercice :
// Afficher le service de l'employé dont l'id_employes est 417.

$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 417");
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
debug($employe); 

echo ' Service est ' . $employe['service'] . '<br>';

echo '<hr>';

// ----------------------------------------------
echo '<h2> Requete avec query() et fetch() pour plusieurs résultats </h2>';
// ----------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

echo "Nombre d'employes : " . $resultat->rowCount() . '<br>'; // compte le nombre de ligne (d'employés) dans l'objet $resultat (exemple : nombre de produits dans une boutique).

debug($resultat);

//Comme nous avons plusieurs ligne dans $resultat, nous devons faire une boucle pour les parcourir : 

while($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { // fetch() va chercher la ligne "suivante" du jeu de résultat qu'il retourne en tableau associatif. La boucle while permet de faire avancer le curseur dans la table et s'arrète quand le curseur est à la fin des résultats (quand fetch retourne false)
    
    debug($employe); // $employe est tableau associatif qui contient les données de 1 employé par tour de boucle.

    echo '<div>';
        echo '<div>' . $employe['prenom'] . '</div>';
        echo '<div>' . $employe['nom'] . '</div>';
        echo '<div>' . $employe['service'] . '</div>';
        echo '<div>' . $employe['salaire'] . ' €</div>';
    echo '</div><hr>';

}

echo '<hr>';

// ----------------------------------------------
echo '<h2> La méthode fetchAll() </h2>';
// ----------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC); // fetchAll() retourne toutes les lignes de $resultat dans un tableau multidimensionnel : on a 1 tableau associatif par employé rangé à chaque indice numérique. Pour info, on peut aussi faire FETCH_NUM pour un sous tableau numérique, ou un fetchAll sans paramètre pour un sous tableau numérique et associatif.

debug($donnees); // il s'agit d'un tableau multidimensionnel

echo '<hr>';

// parcourt le tableau $donnees avec une boucle foreach pour en afficher le contenu

foreach($donnees as $employe) { // $employe est lui meme un tableau . on accède donc à ses indices entre [ ]. 
    // debug($employe);
    echo '<div>';
        echo '<div>' . $employe['prenom'] . '</div>';
        echo '<div>' . $employe['nom'] . '</div>';
        echo '<div>' . $employe['service'] . '</div>';
        echo '<div>' . $employe['salaire'] . ' €</div>';
    echo '</div><hr>';

}

echo '<hr>';

// ----------------------------------------------
echo '<h2> Exercice </h2>';
// ----------------------------------------------

// Afficher la liste des DIFFERENTS service dans une seule liste <ul> et avec un service par <li>. 


// version fetchAll :
$resultat = $pdo->query("SELECT DISTINCT service FROM employes"); // encore :
// $resultat = $pdo->query("SELECT service FROM employes GROUP BY service");

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);

//debug($donnees);

echo '<ul>';

    foreach($donnees as $employe) { 
            echo '<li>' . $employe['service'] . '</li>';
    }

echo '</ul><hr>';

// version while :

$resultat = $pdo->query("SELECT DISTINCT service FROM employes"); // ne pas oublier de refaire la requete avant un nouveau fetch, sinon on est déjà hors du jeu de résultat et donc il n'y a plus rien à récupérer.

echo '<ul>';

    while($employe =  $resultat->fetch(PDO::FETCH_ASSOC)) { 
            echo '<li>' . $employe['service'] . '</li>';
    }

echo '</ul><hr>';

echo '<hr>';


// ----------------------------------------------
echo '<h2> Table HTML </h2>';
// ----------------------------------------------

// On veut afficher dynamiquement le jeux de résultat sous forme de table HTML.

$resultat = $pdo->query("SELECT * FROM employes"); // $resultat est un objet PDOStatement qui est retourné par la méthode query. Il contient le jeu de résultat qui représente tous les employés. 

debug($resultat);

?>

    <style>
        th, tr, td {
            border: 1px solid;
            background-color: #f2f2f2;
        }
        table {
            border-collapse: collapse;
        }
    </style>

<?php

echo'<table>';
    // Affichage de la ligne d'entete :
    echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Prénom</th>';
        echo '<th>Nom</th>';
        echo '<th>Sexe</th>';
        echo '<th>Service</th>';
        echo '<th>Date embauche</th>';
        echo '<th>Salaire</th>';
    echo '</tr>';

    // affichage des lignes :

    while($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { // à chaque tour de boucle de while, fetch() va chercher la ligne suivante qui correspond à 1 employé et retourne ses informations sous forme de tableau associatif. Comme il s'agit de tableau, nous faisons ensuite une boucle foreach pour le parcourir :
       echo '<tr>';
            foreach($employe as $donnee) { // foreach parcourt les données de l'employé, et les affiche en colonne (dans les <td>).
                echo '<td>' . $donnee . '</td>';
            }
       echo '</tr>';
    }
echo'</table>';

echo '<hr>';

// ----------------------------------------------
echo '<h2> Requete préparées </h2>';
// ----------------------------------------------

//Les requetes préparées sont préconisées si vous exécutez plusieurs fois la meme requete et ainsi éviter le cycle complet analyse / interprétation / exécution réaliser par le SGDB (gain de performance).

// Les requete préparées sont aussi utilisées pour assainir les données (se prémunir des injections SQL) => chapitre ultérieur.

$nom = 'Sennard';

// Une requete préparée se réalise en trois étapes :

// 1- On prépare la requete :

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom "); // prepare() permet de préparer la requete mais ne l'exécute pas. :nom est un marqueur nominatif qui est vide et attend une valeur.


// 2- On lie le marqueur à sa valeur :

$resultat->bindParam(':nom', $nom); // bindParam() lie le marqueur :nom à la variable $nom. Remarque : cette méthode reçoit exclusivement une variable en second argument. On ne peut pas y mettre une valeur directement.

// ou alors :
$resultat->bindValue(':nom', 'Sennard'); // bindValue() lie le marqueur :nom à la valeur 'Sennard'. Contrairement à bindParam(), bindValue() reçoit au choix une valeur ou une variable. 

// 3- On exécute la requete : 

$resultat->execute(); // permet d'exécuter une requete préparée avec prepare()

debug($resultat);

$employe =  $resultat->fetch(PDO::FETCH_ASSOC);

echo $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';

/*
    Valeur de retour :
        prepare() retourne toujours un objet PDOStatement.
        execute() : en cas de 
            succès : true
            echec : false
*/

// ----------------------------------------------
echo '<h2> Requete préparées point complémentaire </h2>';
// ----------------------------------------------

echo '<h3> Le  marqueur sous forme de "?" </h3>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?"); // On prépare la requete avec les parties variables représentées avec des marqueurs sous forme de "?". 

$resultat->bindValue(1, 'Durand'); // (1) représente le premier "?"
$resultat->bindValue(2, 'Damien'); // (2) représente le second "?"

$resultat->execute();

// OU encore directement dans le execute() :

$resultat->execute(array('Durand', 'Damien')); // dans l'ordre, "Durand" remplace le premier "?" et 'Damien' le second.

/*
    la flèche -> caractérise les objets : $objet->methode();
    les crocherts [] caractérisent les tableaux : $tableau['indice'];
*/
debug($resultat);

$employe = $resultat->fetch(PDO::FETCH_ASSOC);
debug($employe);
echo 'Le service est ' . $employe['service'] . '<br>';

echo '<hr>';

echo '<h3> lier les marqueurs nominatifs à leur valeur directement dans execute() </h3>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");

$resultat->execute(array(':nom' => 'Chevel', ':prenom' => 'Daniel')); // on assicie chaque marqueur à sa valeur directement dans un tableau. Note : nous ne somme pas obligés de remettre les ":" devant ce tableau.

$employe = $resultat->fetch(PDO::FETCH_ASSOC);

echo 'Le service est ' . $employe['service'] . '<br>';

echo '<hr>';

// ************************************** FIN ***************************************
































