<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données envoyées par le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pays = $_POST['pays'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date-naissance'];

    // Récupération de l'image envoyée par le formulaire
    $image = $_FILES['image']['tmp_name'];

    // Vérification que le dossier "uploads" existe et est accessible en écriture
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    if (!is_writable('uploads')) {
        die("Erreur : le dossier 'uploads' n'est pas accessible en écriture");
    }

    // Déplacement du fichier image vers le dossier "uploads"
    $filename = basename($_FILES['image']['name']);
    $destination = 'uploads/' . $filename;
    if (!move_uploaded_file($image, $destination)) {
        die("Erreur lors de l'envoi du fichier");
    }

    // Stockage du chemin d'accès à l'image
    $image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $destination;

    // Connexion à la base de données
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $dbname = 'carnet_contacts';
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Échappement des données pour les insérer dans la requête SQL
    $escaped_nom = $conn->real_escape_string($nom);
    $escaped_prenom = $conn->real_escape_string($prenom);
    $escaped_pays = $conn->real_escape_string($pays);
    $escaped_genre = $conn->real_escape_string($genre);
    $escaped_email = $conn->real_escape_string($email);
    $escaped_telephone = $conn->real_escape_string($telephone);
    $escaped_date_naissance = $conn->real_escape_string($date_naissance);
    $escaped_filename = $conn->real_escape_string($filename);

    // Requête SQL pour insérer les données dans la table "contacts"
    // $sql = "INSERT INTO contacts (nom, prenom, pays, genre, email, telephone, date_naissance, image) VALUES ('$escaped_nom', '$escaped_prenom', '$escaped_pays', '$escaped_genre', '$escaped_email', '$escaped_telephone', '$escaped_date_naissance', '$escaped_filename')";
	$sql= "INSERT INTO `contacts`(`nom`, `prenom`, `pays`, `genre`, `email`, `telephone`, `date_naissance`, `image`) VALUES ('[$escaped_nom]','[$escaped_prenom]','[$escaped_pays]','[$escaped_genre]','[$escaped_email]','[$escaped_telephone]','[$escaped_date_naissance]','[$escaped_filename]')";
    if ($conn->query($sql) === TRUE) {
        echo "Contact ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du contact : " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Contact List App</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="container">
		<div class="left">
			<div class="header-left">
			<div>
				<h2>Mes contacts</h2>
			</div>
			<div class="btn-left">
				<button class="add-contact-btn">Ajouter</button>
			</div>
		</div>
		<p id="empty">La liste est vide</p>
			<ul class="contacts-list">
			</ul>
		</div>
	    <div class="right">
			<div class="form-container">
				<h3>Ajouter un contact</h3>
				<form class="form" enctype="multipart/form-data" method="POST">
					<div class="elt">
						<div>
							<label for="nom">Nom:</label>
						</div>
						<div>
							<input type="text" id="nom" name="nom" required>
						</div>
					</div>
					<div class="elt">
						<div>
							<label for="Prénom">Prénom :</label>
						</div>
						<div>
							<input type="text" id="prenom" name="prenom" required>
						</div>
					</div>
					<div class="elt">
						<div>
							<label for="pays">Pays:</label>
						</div>
						<div>
							<input type="text" id="pays" name="pays" required>
						</div>
					</div>
					<div class="elt">
						<div>
							<label for="genre">Genre:</label>
						</div>
						<div>
							<select id="genre" name="genre" required>
								<option value="">--Choisir le genre--</option>
								<option value="homme">Homme</option>
								<option value="femme">Femme</option>
							</select>
						</div>
					</div>
					<div class="elt">
						<div>
							<label for="email">E-mail:</label>
						</div>
						<div>
							<input type="email" id="email" name="email" required>
						</div>
					</div>
					<div class="elt">
						<div>
							<label for="telephone">Téléphone:</label>
						</div>
						<div>
							<input type="tel" id="telephone" name="telephone"required>
						</div>
					</div>
					<div class="elt dtn">
						<div>
							<label for="date-naissance">Date de naissance:</label>
						</div>
						<div>
							<input type="date" id="date-naissance" name="date-naissance" required>
						</div>
					</div>
					<div class="elt dtn">
						<div>
							<label for="image">Ajouter une Photo :</label>
						</div>
						<div>
							<input type="file" id="image" name="image">
						</div>
					</div>
					<div>
						<button type="submit" class="add-btn">Ajouter ce contact</button>
						<button type="button" class="cancel-btn">Annuler</button>
					</div>		
			</div>
		        </form>
	</div>
</div>
	<script src="js/scripts.js"></script>
</body>
</html>