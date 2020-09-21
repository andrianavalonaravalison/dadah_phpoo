<?php

// connexion au BDD : 

$pdo = new PDO('mysql:host=localhost;dbname=manga', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = ''; // initialisation
$photo_bdd = '';

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//debug($_POST); 

if (!empty($_POST)) { // si le formulaire a été envoyé 

     	// choix : 
	if(!isset($_POST['choix']) || strlen($_POST['resistance']) < 1) {
		$contenu .= '<div class="table-danger" scope="row"> Vous devez choisir le menu </div>';
    }

    	// resistance : 
	if(!isset($_POST['resistance']) || strlen($_POST['resistance']) < 2 || strlen($_POST['resistance']) > 100) {
		$contenu .= '<div class="table-danger" scope="row"> Text resistance doit contenir entre 2 et 255 caracteres </div>';
    }
    
       	// dessert : 
	if(!isset($_POST['dessert']) || strlen($_POST['dessert']) < 2 || strlen($_POST['dessert']) > 100) {
		$contenu .= '<div class="table-danger" scope="row"> Text dessert doit contenir entre 2 et 255 caracteres </div>';
    }

       	// boisson : 
	if(!isset($_POST['boisson']) || strlen($_POST['boisson']) < 2 || strlen($_POST['boisson']) > 100) {
		$contenu .= '<div class="table-danger" scope="row"> Text boisson doit contenir entre 2 et 255 caracteres </div>';
    }

       	// entree : 
	if(!isset($_POST['entree']) || strlen($_POST['entree']) < 2 || strlen($_POST['entree']) > 100) {
		$contenu .= '<div class="table-danger" scope="row"> Text entree doit contenir entre 2 et 255 caracteres </div>';
    }

       	// description : 
	if(!isset($_POST['description']) || strlen($_POST['description']) < 2 || strlen($_POST['description']) > 100) {
		$contenu .= '<div class="table-danger" scope="row"> Text description doit contenir entre 2 et 255 caracteres </div>';
    }

    // s'il n'y a plus de message d'erreur on insère le contact en BDD (si le formulaire a été envoyé)

        if (empty($contenu)) { 
            // Je traite la photo uniquement s'il n'y a pas d'erreur sur le formulaire : 
		    //debug($_FILES); // vérifie si je reçoit bien la photo
			if (!empty($_FILES['photo']['name'])) { // s'il y a un fichier en cours d'upload
				$photo_bdd = 'photos/' . $_FILES['photo']['name']; // chemin + nom de fichier de la photo que l'on met en BDD . Ne pas oublier de créer le dossier "photos".
				
				copy($_FILES['photo']['tmp_name'], $photo_bdd); // copie la photo qui est temporairement dans $_FILES['photo']['tmp_name'] vers l'emplacement défini par $photo_bdd.
			}
        
            // echappement des données du formulaire
            $_POST['resistance'] = htmlspecialchars($_POST['resistance'], ENT_QUOTES); // transforme les chevrons en entités HTML pour éviter les risques XSS et CSS. ENT_QUOTES pour ajouter les guillemets à transformer en entité HTML.

            $_POST['dessert'] = htmlspecialchars($_POST['dessert'], ENT_QUOTES);
            $_POST['boisson'] = htmlspecialchars($_POST['boisson'], ENT_QUOTES);
            $_POST['entree'] = htmlspecialchars($_POST['entree'], ENT_QUOTES);
            $_POST['prix'] = htmlspecialchars($_POST['prix'], ENT_QUOTES);
            $_POST['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES);


        // on prépare la rêquete :

        $resultat = $pdo->prepare("INSERT INTO menu(choix, resistance, dessert, boisson, entree, photo, prix, description) VALUES (:choix, :resistance, :dessert, :boisson, :entree, :photo, :prix, :description)");

        $succes = $resultat->execute(array(
            ':choix'   => $_POST['choix'],
            ':resistance'   => $_POST['resistance'],
            ':dessert' 		=> $_POST['dessert'],
            ':boisson' 	    => $_POST['boisson'],
            ':entree' 		=> $_POST['entree'],
            ':photo'        => $photo_bdd, // attention la photo ne provient pas de $_POST mais de $_FILES que l'on traite à part de $_POST ci-dessus
            ':prix'         => $_POST['prix'],
            ':description'  => $_POST['description']
        ));

       //debug($succes);

		if ($succes) { // si la variable contient true (retourné par la méthode execute()) c'est que la requete a marché
			$contenu .= '<div class="table-primary" scope="row" >Eregistrement réussi.</div>';
		}else {
			$contenu .= '<div>Erreur lors de l\'enregistrement.</div>';
		}

        } // fin if (empty($contenu)) 




} // fin if (!empty($_POST))


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Hotely MANGA</title>
  </head>
  <body>
  <div class="container">
    <h1 style="text-align:center; color: blue">Hotely MANGA MANDRAY ANAO</h1>

    <?php echo $contenu; ?>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="http://www.google.fr">DECONNXION ET SORTIR VERS GOOGLE</a>
    </nav>

    <form method="post" action="" enctype="multipart/form-data">
        <div class="col-md-3 mb-3">
        <label for="choix">choix</label>
            <select name="choix"class="custom-select" id="choix">
                <option value="votre_choix">Votre choix :</option>
                <option value="surplace">Sur place</option>
                <option value="emporte">Emporté</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="resistance">Plat de resistance</label>
            <input type="text" name="resistance" id="resistance" class="form-control is-valid" >
        </div>

        <div class="col-md-6 mb-3">
            <label for="dessert">Dessert</label>
            <input type="text" name="dessert"  id="dessert" class="form-control is-valid">
        </div>

        <div class="col-md-6 mb-3">
            <label for="boisson">Boisson</label>
            <input type="text" name="boisson"  id="boisson" class="form-control is-valid">
        </div>

        <div class="col-md-6 mb-3">
            <label for="entree">Entree</label>
            <input type="text" name="entree"  id="entree" class="form-control is-valid">
        </div>

        <div class="col-md-6 mb-3">
            <label for="photo">Photo</label>
            <input type="file" name="photo"  id="photo">
        </div>

        <div class="col-md-6 mb-3">
            <label for="prix">Prix</label>
            <input type="text" name="prix"  id="prix" class="form-control is-valid">
        </div>

        <div class="col-md-6 mb-3">
            <label for="description">Description</label>
            <input type="text" name="description"  id="description" class="form-control is-valid">
        </div>
  
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>











</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>