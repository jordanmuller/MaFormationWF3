<?php
// La superglobale $_SESSION est disponble partout sur le serveur
session_start();

echo '<pre>'; print_r($_SESSION); echo '</pre>';