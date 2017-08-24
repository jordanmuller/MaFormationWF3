<?php

// Le fichier passé en argument doit être correctement orthographié
// Appel de la connexion à la base de données
require_once 'connect.php';

// Déclaration d'une variable $order vide, qui définira la métode de tri du résultat de la requête SQL
$order = '';

// Déclaration d'un tableau $errors vide, auquel on affectera des messages d'erreur en indice selon les actions de l'utilisateur 
$errors = [];

// Une parenthèse manquante, toujours vérifier la correspondance entre les différentes paires de parenthèses
if(isset($_GET['order']) && isset($_GET['column']))
{
	// Attention à bien écrire le nom des indices, ici il manque un 'n' à column
	if($_GET['column'] == 'lastname')
	{
		$order = ' ORDER BY lastname';
	}
	// Attention à bien utiliser "=="
	elseif($_GET['column'] == 'firstname')
	{
		$order = ' ORDER BY firstname';
	}
	elseif($_GET['column'] == 'birthdate')
	{
		$order = ' ORDER BY birthdate';
	}
	// Même chose pour l'indice 'order' et non 'ordre'
	if($_GET['order'] == 'asc')
	{
		$order .= ' ASC';
	}
	elseif($_GET['order'] == 'desc')
	{
		$order .= ' DESC';
	}
}

// Si $_POST n'est pas vide (Si l'utilisateur a cliqué sur le bouton submit)
if(!empty($_POST))
{
	foreach($_POST as $key => $value)
	{
		// Une parenthèse en trop qui stoppe l'exécution du script
		// strip_tags(), quand il n'y a qu'un argument, supprime les balises HTML et PHP d'une chaîne de caractères, ici saisie par l'utilisateur
		// trim() supprime les espaces situés au début et à la fin de la chaîne de caractère
		$post[$key] = strip_tags(trim($value));
	}

	/************** VERIFICATION DES CHAMPS DU FORMULAIRE ****************/
	// La parenthèse fermant la fonction strlen se place après l'indice de la variable $post['firstname'] et non après 3
	//  On préfèrera la fonction iconv_strlen() qui compte le nombre de caractères d'une chaîne plutôt que strlen() qui compte le nombre d'octets (à cause des caractères spéciaux)
	if(iconv_strlen($post['firstname']) < 3)
	{
		$errors[] = 'Le prénom doit comporter au moins 3 caractères';		
	}
	// Même chose qu'au dessus
	if(iconv_strlen($post['lastname']) < 3)
	{
		$errors[] = 'Le nom doit comporter au moins 3 caractères';
	}
	// Si diiférent de filter_var() et non filter_variable()
	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
	{
		$errors[] = 'L\'adresse email est invalide';
	}
	if(empty($post['birthdate']))
	{
		$errors[] = 'La date de naissance doit être complétée';
	}
	if(empty($post['city']))
	{
		$errors[] = 'La ville ne peut être vide';
	}

	// count() compte tous les élements d'un tableau
	// Si le tableau $errors (et non $error) est vide (== 0), alors il n'y a pas d'erreur et l'on procède à l'insertion de l'utilisateur dans la BDD
	if(count($errors) == 0)
	{ 
		// error = 0 = insertion user
		$insertUser = $db->prepare('INSERT INTO users (gender, firstname, lastname, email, birthdate, city) VALUES(:gender, :firstname, :lastname, :email, :birthdate, :city)');
		$insertUser->bindValue(':gender', $post['gender']);
		// Il manque un ";"
		// ['firstname'] et non ['fistname']
		// Par défaut, le troisième argument de Bindvalue() est PDO::PARAM_STR lorsqu'il n'est pas précisé
		$insertUser->bindValue(':firstname', $post['firstname']);
		$insertUser->bindValue(':lastname', $post['lastname']);
		$insertUser->bindValue(':email', $post['email']);
		$insertUser->bindValue(':birthdate', date('Y-m-d', strtotime($post['birthdate'])));
		$insertUser->bindValue(':city', $post['city']);
		if($insertUser->execute())
		{
			$createUser = true;
		} else { 
			$errors[] = 'Erreur SQL';
		}
	// Toujours fermer une condition if
	}
}

// On sort la requête d'affichage de la vérification du if() qui déclenche la vérification du formulaire, de type query plutôt que prepare
// On utilise les double-quotes "" pour que la variable $order soit interprétée
$queryUsers = $db->query("SELECT * FROM users" . "$order");
// En orienté objet, l'appel à une méthode s'écrit "->" et non "-->"
$users = $queryUsers->fetchAll();
?>

<!DOCTYPE html>
<html>

	<head>
		<title>Exercice 2</title>
		<meta charset="utf-8">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>

		<div class="container">

			<h1>Liste des utilisateurs</h1>
			
			<p>Trier par : 
				<a href="index.php?column=firstname&order=asc">Prénom (croissant)</a> |
				<a href="index.php?column=firstname&order=desc">Prénom (décroissant)</a> |
				<a href="index.php?column=lastname&order=asc">Nom (croissant)</a> |
				<a href="index.php?column=lastname&order=desc">Nom (décroissant)</a> |
				<a href="index.php?column=birthdate&order=desc">Âge (croissant)</a> |
				<a href="index.php?column=birthdate&order=asc">Âge (décroissant)</a>
			</p>
			<br>

			<div class="row">
			<?php
			if(isset($createUser) && $createUser == true)
			{
				echo '<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-success">Le nouvel utilisateur a été ajouté avec succès.</div>
					</div>
					<br>';
					// Mieux de ne mettre qu'un seul echo avec un ";" pour intender le code des messages de réponses 
			}
			// Si $errors N'EST PAS vide
			if(!empty($errors))
			{
				echo '<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-danger">'.implode('<br>', $errors).'</div>
					</div>
					<br>';
			}
			?>

				<div class="col-md-7">
					<table class="table">
						<thead>
							<tr>
								<th>Civilité</th>
								<th>Prénom</th>
								<th>Nom</th>
								<th>Email</th>
								<th>Age</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user):?>
							<tr>
								<td><?php echo $user['gender'];?></td>
								<td><?php echo $user['firstname'];?></td>
								<td><?php echo $user['lastname'];?></td>
								<td><?php echo $user['email'];?></td>
								<td><?php echo DateTime::createFromFormat('Y-m-d', $user['birthdate'])->diff(new DateTime('now'))->y;?> ans</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<div class="col-md-5">

					<form method="post" class="form-horizontal well well-sm">
						<fieldset>
							<legend>Ajouter un utilisateur</legend>
							<!-- Il faut supprimer les attributs required dans les input pour afficher les messages d'erreur personnalisés -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="gender">Civilité</label>
								<div class="col-md-8">
									<select id="gender" name="gender" class="form-control input-md">
										<option value="Mlle">Mademoiselle</option>
										<option value="Mme">Madame</option>
										<option value="M">Monsieur</option>
									</select>
								</div> <!-- /.col-md-8 -->
							</div> <!-- /.form-group -->

							<div class="form-group">
								<label class="col-md-4 control-label" for="firstname">Prénom</label>
								<div class="col-md-8">
									<input id="firstname" name="firstname" type="text" class="form-control input-md">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="lastname">Nom</label>  
								<div class="col-md-8">
									<input id="lastname" name="lastname" type="text" class="form-control input-md">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="email">Email</label>  
								<div class="col-md-8">
									<input id="email" name="email" type="email" class="form-control input-md">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="city">Ville</label>  
								<div class="col-md-8">
									<input id="city" name="city" type="text" class="form-control input-md">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="birthdate">Date de naissance</label>  
								<div class="col-md-8">
									<input id="birthdate" name="birthdate" type="text" placeholder="JJ-MM-AAAA" class="form-control input-md">
									<span class="help-block">au format JJ-MM-AAAA</span>  
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-4"><button type="submit" class="btn btn-primary">Envoyer</button></div>
							</div>
							
						</fieldset>
					</form>
				</div> <!-- /.col-md-5 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</body>
</html>