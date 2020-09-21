<?php

/* 1- Créer une base de données "repertoire" avec une table "contact" :
	  id_contact PK AI INT
	  nom VARCHAR(50)
	  prenom VARCHAR(50)
	  telephone VARCHAR(10)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')
	  photo VARCHAR(255)

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. 
	   Le champ type_contact doit être géré via un "select option".
	   On doit pouvoir uploader une photo par le formulaire. 
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.
	5- Si une photo est uploadée, ajouter la photo du contact en BDD et uploader le fichier sur le serveur de votre site.

*/

$contenu = ''; // initialisation
$photo_bdd = '';

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//debug($_POST);

if (!empty($_POST)) { // si le formulaire a été envoyé

	// nom 
	if(!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) {
		$contenu .= '<div> Le nom doit contenir entre 2 et 50 caracteres </div>';
	}

	// prénom
	if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 50) {
		$contenu .= '<div> Le prénom doit contenir entre 2 et 50 caracteres </div>';
	}

	// téléphone
	if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
		$contenu .= '<div>Le téléphone est invalide.</div>';
	}

	// type contact
	if (!isset($_POST['type_contact']) ||  ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre')) {
		$contenu .= '<div>Le type de contact est invalide.</div>';
	}

	// email

	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || strlen($_POST['email'])  > 255 ) {
		$contenu .= '<div> L\'email est invalide.</div>';
	}

	// s'il n'y a plus de message d'erreur on insère le contact en BDD (si le formulaire a été envoyé)

	if (empty($contenu)) {

		// Je traite la photo uniquement s'il n'y a pas d'erreur sur le formulaire : 
		debug($_FILES); // vérifie si je reçoit bien la photo
			if (!empty($_FILES['photo']['name'])) { // s'il y a un fichier en cours d'upload
				$photo_bdd = 'photos/' . $_FILES['photo']['name']; // chemin + nom de fichier de la photo que l'on met en BDD . Ne pas oublier de créer le dossier "photos". 

			}

		// echappement des données du formulaire
		$_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_QUOTES); // transforme les chevrons en entités HTML pour éviter les risques XSS et CSS. ENT_QUOTES pour ajouter les guillemets à transformer en entité HTML.

		$_POST['prenom'] = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
		$_POST['telephone'] = htmlspecialchars($_POST['telephone'], ENT_QUOTES);
		$_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
		$_POST['type_contact'] = htmlspecialchars($_POST['type_contact'], ENT_QUOTES);

		// ou alors avec un foreach :
		/*
			foreach ($_POST as $indice => $valeur) {
				$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
			}
		*/

		// on prépare la rêquete :

		$resultat = $pdo->prepare("INSERT INTO contact(nom, prenom, telephone, email, type_contact, photo) VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo)");

		$succes = $resultat->execute(array(
			':nom' 			=> $_POST['nom'],
			':prenom' 		=> $_POST['prenom'],
			':telephone' 	=> $_POST['telephone'],
			':email' 		=> $_POST['email'],
			':type_contact' => $_POST['type_contact'],
			':photo' 		=> $photo_bdd // attention la photo ne provient pas de $_POST mais de $_FILES que l'on traite à part de $_POST ci-dessus
		));

		if ($succes) { // si la variable contient true (retourné par la méthode execute()) c'est que la requete a marché
			$contenu .= '<div>Le contact a été enregistré.</div>';
		}else {
			$contenu .= '<div>Erreur lors de l\'enregostrement.</div>';
		}

	} // fin if (empty($contenu))

	

} // fin de if (!empty($post))

?>

<!-- 2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. Le champ type_contact doit être géré via un "select option". On doit pouvoir uploader une photo par le formulaire. -->

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajouter un contact</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>

<h2>Ajouter un contact</h2>

<?php echo $contenu; ?>

	<form method="post" action="" enctype="multipart/form-data"> <!-- enctype pour que le formulaire puisse envoyer les données du fichier uploadé -->

		<div><label for="nom">Nom</label></div>
		<div><input type="text" name="nom" id="nom"></div>

		<div><label for="prenom">Prenom</label></div>
		<div><input type="text" name="prenom" id="prenom"></div>

		<div><label for="telephone">Téléphone</label></div>
		<div><input type="text" name="telephone" id="telephone"></div>

		<div><label for="email">Email</label></div>
		<div><input type="text" name="email" id="email"></div>

		<div><label for="type_contact">Type de contact</label></div>
		<div>
			<select name="type_contact" id="type_contact">
				<option value="ami">Ami</option>
				<option value="famille">Famille</option>
				<option value="professionnel">Professionnel</option>
				<option value="autre">Autre</option>
			</select>
		</div>

		<div><label for="photo">Photo</label></div>
		<div><input type="file" name="photo" id="photo"></div>

		<div><input type="submit" value="enregister"></div>










	</form>

</body>
</html>