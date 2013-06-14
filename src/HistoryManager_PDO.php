<?php

/**
 * Classe de manager avec PDO. Réalise toutes les requêtes avec la BDD
 * @author remontees
 * @version 0.1
 */
 
class HistoryManager_PDO extends HistoryManager
{
	/**
	 * Attribut contenant l'instance représentant la BDD.
	 * @type PDO
	 */
	protected $db;
	
	/**
	 * Constructeur chargé d'instancier PDO dans $db.
	 * @param $db PDO Le DAO
	 * @return void
	 */
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}
	
	/**
	 * @see HistoryManager:add()
	 * @return bool
	 */
	protected function add(History $history)
	{
		$requete = $this->db->prepare('INSERT INTO history SET log = :log, date = NOW(), user_id = :user_id');
		$requete->bindValue(':log', $history->getLog());
		$requete->bindValue(':user_id', $history->getUser_id());
		
		return $requete->execute();
	}
}