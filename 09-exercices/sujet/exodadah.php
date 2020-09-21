
<?php
$contenu = '';
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// print_r($_POST);
/*3- Effectuer les vérifications nécessaires :
	Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	Le type de contact doit être conforme à la liste des types de contacts
	L'email doit être valide
	En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire */

// 1- Traitement du formulaire

if (!empty($_POST)) { // si le données $_POST n'est pas vide


    // controle du formulaire

	if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) {
		$contenu .= '<div class="alert alert-danger"> Le nom doit contenir au moins 2 caractères.</div>';
	}

	if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 50) {
		$contenu .= '<div class="alert alert-danger"> Le prénom doit contenir au moins 2 caractères.</div>';
	}

	if (!isset($_POST['telephone']) || strlen($_POST['telephone']) < 10 || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) { 
		$contenu .= '<div class="alert alert-danger"> Le numéro de téléphone n\'est pas valide.</div>';
	}

	if (!isset($_POST['type_contact'])  || ($_POST['type_contact'] !== 'ami' && $_POST['type_contact'] !== 'famille' && $_POST['type_contact'] !== 'professionnel' && $_POST['type_contact'] !== 'autre')) { 
		$contenu .= '<div class="alert alert-danger"> Le numéro de téléphone n\'est pas valide.</div>';
	}

	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 255) {
		$contenu .= '<div class="alert alert-danger"> Email non valide.</div>';
	}


// fin du if (!empty($_POST))

// telechargement photo :


if (!empty($_FILES['photo']['name'])) { // photo en cours de telechargement
	$fichier_photo = $_FILES['photo']['name'];
	$photo_bdd = 'upload/' . $fichier_photo;
	copy($_FILES['photo']['tmp_name'], $photo_bdd); // recupération du photos dans le rep tmp
}


// requete d'Inscription au BDD

if (empty($contenu)) {

	$resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, email, type_contact, photo) VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo)");


	$succes = $resultat->execute(array(
		':nom' 			=> $_POST['nom'],
		':prenom' 		=> $_POST['prenom'],
		':email' 		=> $_POST['email'],
		':telephone' 	=> $_POST['telephone'],
		':type_contact' => $_POST['type_contact'],
		':photo' 		=> $photo_bdd
	));

}

if ($succes){
	$contenu .= '<div class="alert alert-succès"> Contact ajouté.</div>';
}else{
	$contenu .= '<div class="alert alert-succès"> votre requete n\'a pas aboutit .</div>';
}

} 


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajouter un contact</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
 <?php echo $contenu; ?>

<div class="row">
	<div class="col-md-4">
		<form method="post" enctype="multipart/form-data" class="">
			<h5><b>Ajout de contact</b></h5>

			<div class="form-group">
				<label class="col-md-4" for="nom">Nom</label>
				<div class="col-md-8">
					<input id="nom" name="nom" type="text" value="">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4" for="prenom">Prénom</label>
				<div class="col-md-8">
						<input id="prenom" name="prenom" type="text" value="">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4" for="telephone">Téléphone</label>  
				<div class="col-md-8">
					<input id="telephone" name="telephone" type="text" value="">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4" for="email">Email</label>  
				<div class="col-md-8">
					<input id="email" name="email" type="email" value="">
				</div>
			</div>
	
			<div class="col-md-4">
				<label for="type_contact">Type contact</label>
				<select  name="type_contact" id="">
					<option value="ami"  >Amis</option>
					<option value="famille" >Famille</option>
					<option value="professionnel" >Professionnel</option>
					<option value="autre" >Autre</option>
				</select>
			</div>

			<div class="form-group">
				<label class="col-md-4" for="photo">Photo</label>  
				<div class="col-md-8">
					<input id="photo" name="photo" type="file" class="">
					<!-- modification de photo -->
				</div>
			</div>
<br>
			<div class="form-group">
				<div class="col-md-4 col-md-offset-4">
				<button type="submit" class="btn btn-secondary">Ajouter</button>
				</div>
			</div>
		</form>
	</div>
</div>


<?php



// vérification du formulaire :




// requête SQL :





