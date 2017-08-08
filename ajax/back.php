<?php
$errors = [];

if(empty($_POST['nom']))
{
    $errors[] = 'Le nom est obligatoire';
}

if(empty($_POST['prenom']))
{
    $errors[] = 'Le prénom est obligatoire';
}

$response = [];

$response['status'] = (empty($errors)) ? 'ok' : 'ko';
$response['errors'] = $errors;

echo json_encode($response);

?>