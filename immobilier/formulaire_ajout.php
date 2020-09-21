<?php

// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//debug($_POST); 

if (!empty($_POST)) { // si le formulaire a été envoyé 

	    // titre : 
	if(!isset($_POST['titre']) || strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 255) {
		$contenu .= '<div class="table-danger" scope="row"> Le titre doit contenir entre 2 et 255 caracteres </div>';
    }
    
    	// adresse : 
	if(!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2 || strlen($_POST['adresse']) > 255) {
		$contenu .= '<div class="table-danger" scope="row"> L\'adresse doit contenir entre 2 et 255 caracteres </div>';
    }
    
    	// ville : 
	if(!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 55) {
		$contenu .= '<div class="table-danger" scope="row"> Le nom de la ville doit contenir entre 2 et 55 caracteres </div>';
    }

    	// code postal
	if (!isset($_POST['cp']) || !preg_match('#^[0-9]{5}$#', $_POST['cp'])) {
		$contenu .= '<div class="table-danger" scope="row">Code postal est invalide.</div>';
	}
    
		// surface
    if(!isset($_POST['surface']) || strlen($_POST['surface']) > 10  ) { // j'ai mis une condition de Surface > 10m² (car la loi nous indique qu'il faut au moins 9m²/personne)
        $contenu .= '<div class="table-danger" scope="row"> La surface doit être supérieur à 10m² </div>';
    }

    // J'ai ajouté une description (je vais limiter quand même à 255 caractères)
    if(!isset($_POST['description']) || strlen($_POST['description']) > 255  ) {
        $contenu .= '<div class="table-danger" scope="row"> La longueur du texte doit être inférieure à 255 caractères </div>';
    }

	// s'il n'y a plus de message d'erreur on insère le contact en BDD (si le formulaire a été envoyé)

	if (empty($contenu)) {

        if((isset($_FILES['photo'])) && ($_FILES['photo']['name']!="")) {
            //echo 'isset'.$_FILES['photo']['name'];
            $photo_bdd = 'photos/';
            $photo = basename($_FILES['photo']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['photo']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['photo']['name'], '.');

            //Début des vérifications des photos
            //Si l'extension n'est pas dans le tableau
            if(!in_array($extension, $extensions)){
            $contenu = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg';
                    }
  //debug($taille);                      
            if($taille>$taille_maxi){
                $contenu = '<div class="table-danger" scope="row">Le fichier est trop gros donc pas de photos dans la BDD, par contre votre informations sont inscrit dans la BDD </div><br>' . '<div class="table-danger" scope="row">Veuillez fournir une photo ayant la taille moins de 2Mo !!! </div>';
            } else {

            //S'il n'y a pas d'erreur, on upload
            if (!empty($_FILES['photo']['name'])) { // s'il y a un fichier en cours d'upload
            $photo_bdd = 'photos/' . $_FILES['photo']['name']; // chemin + nom de fichier de la photo que l'on met en BDD . + création du dossier "photos".
                                
            copy($_FILES['photo']['tmp_name'], $photo_bdd); // copie la photo qui est temporairement dans $_FILES['photo']['tmp_name'] vers l'emplacement défini par $photo_bdd.
            }
            }
        }

        // echappement des données du formulaire
        $_POST['titre'] = htmlspecialchars($_POST['titre'], ENT_QUOTES); // transforme les chevrons en entités HTML pour éviter les risques XSS et CSS. ENT_QUOTES pour ajouter les guillemets à transformer en entité HTML.

        $_POST['adresse'] = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
        $_POST['ville'] = htmlspecialchars($_POST['ville'], ENT_QUOTES);
        $_POST['cp'] = htmlspecialchars($_POST['cp'], ENT_QUOTES);
        $_POST['surface'] = htmlspecialchars($_POST['surface'], ENT_QUOTES);
        $_POST['prix'] = htmlspecialchars($_POST['prix'], ENT_QUOTES);
        $_POST['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES);

        // on prépare la rêquete :

		$resultat = $pdo->prepare("INSERT INTO logement(titre, adresse, ville, cp, surface, prix, photo, type_bien, description) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type_bien, :description)");

		$succes = $resultat->execute(array(
			':titre' 			=> $_POST['titre'],
			':adresse' 		    => $_POST['adresse'],
			':ville' 	        => $_POST['ville'],
			':cp' 		        => $_POST['cp'],
			':surface'          => $_POST['surface'],
			':prix'             => $_POST['prix'],
            ':photo' 		    => $photo_bdd,
            ':type_bien'        => $_POST['type_bien'],
            ':description'      => $_POST['description']
            
		));

// debug($succes);

		if ($succes) { // si la variable contient true (retourné par la méthode execute()) c'est que la requete a marché
			$contenu .= '<div class="table-primary" scope="row" >Eregistrement réussi.</div>';
		}else {
			$contenu .= '<div>Erreur lors de l\'enregistrement.</div>';
		}
    } // if (empty($contenu))

} // fin // fin if (!empty($_POST))


?>

<!-- Création du formulaire HTML afin d'ajouter un bien dans la bdd. Le champ type_bien doit être géré via un "select option". On doit pouvoir uploader une photo par le formulaire. -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immobilier</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    
    <h2>Formulaire ajout</h2>

    <?php echo $contenu; ?>

	<form method="post" action="" enctype="multipart/form-data"> <!-- enctype pour que le formulaire puisse envoyer les données du fichier uploadé -->

		<div><label for="titre">Titre :</label></div>
		<div><input type="text" name="titre" id="titre"></div>

		<div><label for="adresse">Adresse :</label></div>
		<div><input type="text" name="adresse" id="adresse"></div>

		<div><label for="ville">Ville :</label></div>
		<div><input type="text" name="ville" id="ville"></div>

		<div><label for="cp">Code postal :</label></div>
		<div><input type="text" name="cp" id="cp"></div>

        <div><label for="surface">Surface :</label></div>
		<div><input type="text" name="surface" id="surface"> <b>(m²)</b> </div>

        <div><label for="prix">Prix :</label></div>
		<div><input type="text" name="prix" id="prix"> <b>(€)</b> </div>

		<div><label for="photo">Photo :</label></div>
		<div><input type="file" name="photo" id="photo"></div>

        <!-- ici j'ai choisi "select-option -->
		<div><label for="type_bien">Type du bien :</label></div>
		<div>
			<select name="type_bien" id="type_bien">
				<option value="vente">Vente</option>
				<option value="location">Location</option>
			</select>
		</div>

        <div><label for="description">Description :</label></div>
        <div><textarea name="description" id="description" cols="30" rows="10"></textarea></div>
<br>
		<div><input type="submit" value="enregister" class="btn btn-secondary"></div>

	</form>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>

