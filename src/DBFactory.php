<?php

/**
 * Classe permettant d'instancier la connexion de PDO à l'aide du design pattern Factory.
 * @author remontees
 * @version 0.1
 */
 
class DBFactory
{
	public static function getMysqlConnexionWithPDO()
	{
		// Définition des paramètres de votre BDD, à vous de les modifier !
		define('DB_NAME', 'DB_NAME');
		define('DB_PASSWORD', 'password');
		
		$db = new PDO('mysql:host=localhost;dbname=' . DB_NAME, 'root', DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}