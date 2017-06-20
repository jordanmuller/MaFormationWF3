<?php
// Récupérer 5 images et les renommer
// image1.jpg

// Afficher une image avec une balise img
?>
<h1>Afficher une image avec une balise</h1>
<img src="image1.jpg" alt="Coucher de soleil" width="300">
<br><br>
<?php

echo '<h1>Afficher une image 5 fois en écrivant une balise img</h1>';
for ($i = 1; $i <= 5; $i++)
{
    echo '<img src="image2.jpg" alt="Coucher de soleil" width="300">';
}

echo '<br><br>';
echo '<h1>Afficher cinq images différentes avec une balise img</h1>';
for ($j = 1; $j <= 5; $j++)
{
    echo '<img src="image' . $j . '.jpg" alt="Coucher de soleil" width="300" height="200">';   
}

