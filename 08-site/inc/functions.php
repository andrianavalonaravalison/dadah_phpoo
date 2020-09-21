<?php
// Fonction du site

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//----------
// Fonction qui indique si l'internaute est connecté

function estConnecte() {
    if(isset($_SESSION['membre'])) { // si "membre" existe dans la session, c'est que l'internaute est passé par la page de connexion avec les bons pseudo / mdp
        return true; // il est connecté
    } else {
        return false; // il n'est pas connecté
    }
}

// fonction qui indique si le membre connecté est administrateur
function estAdmin() {
    if(estConnecte() && $_SESSION['membre']['statut'] == 1) { // si le membre est connecté alors on regadre son status dans la session. S'il vaut 1 alors il est bien admin.
        return true; // le membre est admin connecté
    } else {
        return false; // il ne l'est pas
    }
}

//---------
// fonction qui exécute les requetes


function executeRequete($requete, $param = array()) { // le paramètre de la requête reçoit une requêtre SQL. Le parametre $param reçoit un tableau avec les marqueur associés à leur valeur. Dans le cas ou ce tableau n'est pas fourni, $param prend un array() vide par défaut.

    // Echappement des données avec htmlspecialchars() :
    foreach ($param as $indice => $valeur) {
        $param[$indice] = htmlspecialchars($valeur); // on prend la valeur de $param que l'on passe dans htmlspecialchars() pour transformer les chevrons en entités HTML qui neutralisent les balises <style> et <script> éventuellement injectées dans le formulaire. Evite les risques XSS et CSS. Puis on range cette valeur échapée dans son emplacement d'origine qui ets $param[$indice].

    }

    global $pdo; // permet d'accéder à la variable $pdo qui est déclarée dans init.php autrement dit dans l'espace global (nous sommes ici dans un espace local).

    $resultat = $pdo->prepare($requete); // on prépare la requête reçu par $requete
    $succes = $resultat->execute($param); // puis on exécute en lui donnant le tableau qui associe les marqueurs à leur valeur

   // var_dump($succes); // execute() renvoie toujour un booléen : true quand la requete a marché, sinon false.


   if ($succes) { // si $succes contient true (la requete a marché), je retourne alors $resultat qui contient le jeu de résultat du SELECT (objet PDOStatement).
        return $resultat;
   } else {
       return false; // sinon, si erreur sur la requete, on retourne false.
   }

}

// -----------
// fonction qui calcule le TOTAL du panier

function montantTotal() {
    $total = 0;

    for($i=0; $i < count($_SESSION['panier']['id_produit']); $i++) {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // on multilie la quantité par le prix à chaque tour de boucle que l'on ajoute dans $total avec l'opérateur += pour ne pas écraser la dernière valeur.
    }

    return $total; // pour sortir la valeur de $total de la fonction et la retourner à l'endroit ou on appelle cette fonction (dans le panier).

}




