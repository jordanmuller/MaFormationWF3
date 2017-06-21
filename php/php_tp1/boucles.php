<?php
for($i = 1; $i <= 100; $i++)
{
     
    if($i == 50) {
        echo '<span style="color: red;">' . $i . '</span><br />'; 
    } 
    elseif($i != 50) {
        echo $i . '<br />';
    }
}

echo '<hr><hr>';

for ($i = 2000; $i >= 1930; $i--)
{
    echo $i . '<br />';
}

for($j = 1; $j <= 100; $j++)
{
    echo '<h1>Titre à afficher 100 fois.</h1>';
}

echo '<hr><hr>';

for($k = 1; $k <= 100; $k++)
{
    echo '<h1>Je m\'affiche pour la ' . $k . 'ème fois.</h1>';
}

?>