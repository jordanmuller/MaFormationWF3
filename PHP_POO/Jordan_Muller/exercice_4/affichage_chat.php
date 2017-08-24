<?php

require_once('exercice_4.php');

$chat1 = new Chat('Isis', 10, 'gris', 'femelle', 'siamois');
$chat2 = new Chat('Caramel', 4, 'marron', 'male', 'tigré');
$chat3 = new Chat('Tigrou', 2, 'roux', 'male', 'persan');
?>
<table border="1" style="width: 50%; margin: 0 auto; border-collapse: collapse; text-align: center;">
    <tr>
        <th style="padding: 10px;">Prénom</th>
        <th style="padding: 10px;">Âge</th>
        <th style="padding: 10px;">Couleur</th>
        <th style="padding: 10px;">Sexe</th>
        <th style="padding: 10px;">Race</th>
    </tr>
    <tr>
        <?php $chat1->getInfos(); ?>
    </tr>
    <tr>
        <?php $chat2->getInfos(); ?>
    </tr>
    <tr>
        <?php $chat3->getInfos(); ?>
    </tr>
</table>