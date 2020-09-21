<?php
require_once 'inc/init.php';
// -------------------------------TRAITEMENT PHP--------------------------
$panier = ''; // pour afficher le formulaire d'ajout au panier

$suggestion = ''; // pour la suggestion des produits


// 1- Controle de l'existence du produit demandé (un produit en favori a pu etre supprimé de la BDD...) :

//debug($_GET);

if (isset($_GET['id_produit'])) { // si "id_produit" est dans l'URL, c'est que l'on a demandé le détail d'un produit

    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    if($resultat->rowCount() == 0 ){ // s'il y a pas de produit en BDD avec cet identifiant, nous redirigeons vers la boutique
        header('location:index.php');
        exit();
    }

    // 2- Affichage et mise en forme des informations du produit :

    $produit = $resultat->fetch(PDO::FETCH_ASSOC); // on fetche les données du produit sans faire de boucle car il y en a qu'un par identifiant.
    //debug($produit);

    extract($produit); // crée des variables nommées comme les indices du tableau associatif, et qui prennent les valeurs.

    // 3- formulaire d'ajout au panier si le stock est supérieur à 0 :
        if ($stock > 0) { // s'il y a du stock sur le produit, on affiche le bouton

            // Pour panier.php il nous faut l'identifiant du produit et la quantité ajoutée au panier

            $panier .= '<form method="post" action="panier.php">';
            $panier .= '<input type="hidden" name="id_produit" value="'. $id_produit .'">'; // pour renseigner $_POST avec l'id_produit de l'article ajouté

            // Sélecteur de quantité :

            $panier .= '<select name="quantite" class="custom-select col-3">';
                for($i = 1; $i <= $stock && $i <= 10; $i++) { // on fait 10 tours de boucle max à concurrence du stock disponible (exemple : si le stock est 3, on ne fait que 3 tours)

                    $panier .= "<option>$i</option>";

                }
            $panier .= '</select>';
            
            // Bouton d'ajout au panier :

            $panier .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn btn-info col-8 offset-1">'; // offste-1 décalage d'1 colonne

            $panier .= '</form>';

        } else {
            // si le stock est null
            $panier .= '<p>produit indisponible</p>';
        }




} else { // si l'id_produit n'est pas dans l'URL, on redirige vers la boutique
    header('location:index.php');
    exit();
}

// Exercice : afficher 2 produits (photo et titre) aléatoirement appartenant à la catégorie du produits affiché au-dessus. Ces 2 produits doivent être différents du produit consulté. La photo est cliquable, et mène à la fiche détaillée du produit. Vous utilisez la variable $suggestion pour afficher le contenu.

$resultat = executeRequete("SELECT * FROM produit WHERE  categorie = :categorie AND id_produit != :id_produit ORDER BY RAND() LIMIT 2", array(':categorie' => $categorie, ':id_produit' => $id_produit));  // natao debug() ny $produit dia hita tao reefa nocliquéna ilay pull, napliqué-na ny extract() avy eo dia lasa nanjary variable ny $id_produit.

while ($produit_suggere = $resultat->fetch(PDO::FETCH_ASSOC)) {
    //debug($produit_suggere); // d hite eo ny array roa samihafa nofidiana teo aloha sy ny mombamomba azy

    $suggestion .= '<div class="col-sm-3">'; // le .= permet de concatener les valeurs à chaque tour de boucle à l'intérieur de $suggestion SANS remplacer la valeur précédente.
        $suggestion .= '<h4>' . $produit_suggere['titre'] . '</h4>';
        $suggestion .= '<a href="fiche_produit.php?id_produit=' . $produit_suggere['id_produit'] . '">
                             <img src="' . $produit_suggere['photo'] . '" alt="' . $produit_suggere['titre'] . '" class="img-fluid">
                        </a>'; // pour afficher le détail du produit, on ajoute un lien en GET (href) qui envoie l'id_produit à la page fiche_produit.php . 


    $suggestion .= '</div>'; // fin class="col-sm-3
}


// ---------------------------------EXERCICE DEBUT ----------------------------















/*
$resultat = executeRequete("SELECT id_produit, titre, photo, description FROM produit WHERE id_produit != :id_produit AND categorie = :categorie ORDER BY RAND() LIMIT 2", array(':id_produit' => $produit['id_produit'], ':categorie' => $produit['categorie']));


while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)) {
    //debug($produit);
    
    $suggestion .= '<div class="col-sm-2 mb-4">';
        $suggestion .= '<div class="card">';

            // Image cliquable :
            $suggestion .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'">
                            <img class="card-img-top" src="' . $produit['photo'] . '" alt="' . $produit['titre'] . '">
                            </a>';

            // Infos du produit
            $suggestion .= '<div class="card-body">';
                    $suggestion .= '<h5>' . $produit['titre'] . '</h5>';
                    $suggestion .= '<p>' . $produit['description'] . '</p>';
            $suggestion .= '</div>';

        $suggestion .= '</div>';
    $suggestion .= '</div>';


}
*/
// ---------------------------------EXERCICE FIN ----------------------------










// ------------------------------- AFFICHAGE --------------------------
require_once 'inc/header.php';

?>

<div class="row">

    <div class="col-12">
        <h1><?php echo $titre;  // on accède à cette variable grace à extract() fait sur tableau $produit ?></h1> 
    </div>

    <div class="col-md-8">
        <img src="<?php echo $photo; ?>" alt="<?php  echo $titre ?>" class="img-fluid">
    </div>

    <div class="col-md-4">
        <h2>Description</h2>
        <p><?php echo $description; ?></p>

        <h2>Détails</h2>
        <ul>
            <li>Catégorie : <?php echo $categorie; ?></li>
            <li>Couleur : <?php echo $couleur; ?></li>
            <li>Taille : <?php echo $taille; ?></li>
        </ul>
        <h3>Prix : <?php  echo number_format($prix, 2, ',', ''); ?> €TTC</h3>

        <?php echo $panier; // formulaire d'ajout au panier?>

    </div><!-- .col-md-4 -->

 

</div> <!-- .row -->

<hr>

<div class="row">
    <div class="col-12">
        <h2>Suggestion de produits</h2>
    </div>
    <?php echo $suggestion; ?>

</div>



<?php
require_once 'inc/footer.php';