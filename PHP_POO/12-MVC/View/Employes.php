<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../view/css/bootstrap.css" />
	</head>
	<body>
		<div id="container" style="width: 90%; margin: 5vh auto">
			<div class="row">

				<?php foreach($employes as $employe) : ?>
				<div class="col-sm-6 col-lg-3 col-md-4">
					<div class="thumbnail">
						<img src="../view/image1.jpg" alt="">
						<div class="caption">
							<h4 class="pull-right">Employe numéro : <?= $employe['id_employes'] ?></h4>
							<h4><a href="">Voir la fiche de l'employe</a></h4>
							<ul>
								<li>Prénom : <?= $employe['prenom'] ?></li>
								<li>Nom : <?= $employe['nom'] ?></li>
								<li>Service :<?= $employe['service'] ?></li>
								<li>Sexe :<?= $employe['sexe'] ?></li>
								<li>Date d'embauche<?= $employe['date_embauche'] ?></li>
								<li>Salaire<?= $employe['salaire'] ?>€</li>
							</ul>
						</div>
						<div class="ratings">
							<p class="pull-right">15 reviews</p>
							<p>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
							</p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				
				
			</div>
		</div>
	</body>
</html>