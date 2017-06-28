<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>boutique.php">Ma Boutique</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
     
                <li class="active"><a href="<?php echo URL; ?>boutique.php">Accueil</a></li>
                <li><a href="<?php echo URL; ?>panier.php">Panier</a></li>

                <?php  
                    if(!utilisateur_est_connecte())
                    {
                ?>
                    <li><a href="<?php echo URL; ?>inscription.php">Inscription</a></li>
                    <li><a href="<?php echo URL; ?>connexion.php">Connexion</a></li>
                <?php
                    } else {
                ?>      
                    <li><a href="<?php echo URL; ?>profil.php">Profil</a></li>
                    <li><a href="<?php echo URL; ?>connexion.php?action=deconnexion">Déonnexion</a></li>      
                <?php
                    }
                    // Rajout des liens si l'utilisateur est admin
                    if(utilisateur_connecte_admin())
                    {
                ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
                    
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo URL; ?>admin/gestion_boutique.php">Gestion boutique</a></li>
                            <li><a href="<?php echo URL; ?>admin/gestion_commande.php">Gestion commande</a></li>
                            <li><a href="<?php echo URL; ?>admin/gestion_utilisateur.php">Gestion utilisateur</a></li>
                        </ul>
                    </li>
                <?php
                    }
                ?>
            </ul>
        </div><!-- /.nav-collapse -->
    </div> <!-- /.container -->
</nav>