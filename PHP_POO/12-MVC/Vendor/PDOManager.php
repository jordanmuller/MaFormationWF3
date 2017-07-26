<?php

class PDOManager
{
	private static $instance = NULL; // Contiendra mon instance
	private $pdo; // Contiendra mon objet PDO
	
	private function __construct(){}
	private function __clone(){}
	
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function getPdo(){
		require __DIR__ . '/parameters.php'; 
		
		$this -> pdo = new PDO('mysql:host=' . $parameters['host'] . ';dbname=' . $parameters['dbname'], $parameters['login'], $parameters['password']);
		
		return $this -> pdo;
	}
}


