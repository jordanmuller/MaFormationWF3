<?php

class EmployesModel
{
	// les models ont vocation à effectuer des requêtes auprès de la BDD. 
	
	private $db; // contiendra ma connexion à la BDD (via PDOManager)
	
	public function getDb(){
		require __DIR__ . '/../Vendor/PDOManager.php'; 
		$this -> db = PDOManager::getInstance() -> getPdo();
		return $this -> db; 
	}
	
	// Fonction pour récupérer toutes les infos de la table employes
	public function getAllEmployes(){
		$requete = "SELECT * FROM employes";
		$resultat = $this -> getDb() -> query($requete);
		$employes = $resultat -> fetchAll(PDO::FETCH_ASSOC);
		
		if(!$employes){
			return FALSE;
		}
		else{
			return $employes; 
		}
	}	
}




