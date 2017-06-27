<?php
require("inc/init.inc.php");








// Les affichages commencent ici, on termine toujours le php par les affichages
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>
    
    <div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <?php // echo $message; // messages destinés à l'utilisateur ?>
        <!-- Le = est un raccourci de echo, les balises ci dessus et ci dessous sont les mêmes, cela ne fonctionne que pour les echo -->
        <?= $message; ?>
      </div>

    </div><!-- /.container -->
<?php
require("inc/footer.inc.php");












