<?php
require("inc/init.inc.php");

// Vérification si l'utilisateur est connecté sinon on le redirige sur connexion
if(!utilisateur_est_connecte())
{
    header("location:connexion.php");
}






// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>
    
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: DarkRed;"></span>Profil (<?php if($_SESSION['utilisateur']['statut'] == 1) echo 'Administrateur'; else { echo 'Membre'; } ?>)</h1>
      </div>  
      <div class="row">
        <div class="col-sm-4" style="padding-top: 20px;">
            <img src="img/mario.jpg" alt="Photo de profil">
        </div>
        <div class="col-sm-8">
            <h1 style="margin: 0; background: #B60D12; color:white; padding: 10px">Informations générales</h1>
            <ul class="list-group">
                <li class ="list-group-item">Pseudo: <?php echo $_SESSION['utilisateur']['pseudo']; ?></li>
                <li class ="list-group-item">Nom: <?php echo $_SESSION['utilisateur']['nom']; ?></li>
                <li class ="list-group-item">Prénom: <?php echo $_SESSION['utilisateur']['prenom']; ?></li>
                <li class ="list-group-item">Sexe: <?php echo $_SESSION['utilisateur']['sexe']; ?></li>
                <li class ="list-group-item">Statut: <?php if($_SESSION['utilisateur']['statut'] == 1) echo 'Administrateur'; else { echo 'Membre'; } ?></li>

            </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1" style="margin-top: 30px">
            <h2 style="margin: 0; background: #B60D12; color:white; padding: 10px">Coordonnées</h2>
            <ul class="list-group">
                <li class ="list-group-item">Email: <?php echo $_SESSION['utilisateur']['email']; ?></li>
                <li class ="list-group-item">Ville: <?php echo $_SESSION['utilisateur']['ville']; ?></li>
                <li class ="list-group-item">Code Postal: <?php echo $_SESSION['utilisateur']['cp']; ?></li>
                <li class ="list-group-item">Adresse: <?php echo $_SESSION['utilisateur']['adresse']; ?></li>
            </ul>    
        </div>
      </div>
      
      
      <?php 


       ?>

        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>
      

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");