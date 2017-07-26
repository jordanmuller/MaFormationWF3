<?php

require __DIR__ . '/../Model/EmployesModel.php';

class EmployesController
{
	private $model;
	
	public function __construct(){
		$this -> model = new EmployesModel;
	}
	
	public function afficheEmployes(){
		$employes = $this -> model -> getAllEmployes(); 
		
		require __DIR__ . '/../View/Employes.php';
		
	}
}
//-----------------

$ec = new EmployesController;
$ec -> afficheEmployes();




