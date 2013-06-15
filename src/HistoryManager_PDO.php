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
	 * @see HistoryManager::add()
	 */
	protected function add(History $history)
	{
		$requete = $this->db->prepare('INSERT INTO history SET log = :log, date = NOW(), user_id = :user_id');
		$requete->bindValue(':log', $history->getLog());
		$requete->bindValue(':user_id', $history->getUser_id());
		
		return $requete->execute();
	}
	
	/**
	 * @see HistoryManager::countAll()
	 */
	public function countAll()
	{
		return $this->db->query('SELECT COUNT(*) FROM history')->fetchColumn();
	}
	
	/**
	 * @see HistoryManager::countUser()
	 */
	public function countUser($user_id)
	{
		$requete = $this->db->query('SELECT COUNT(*) FROM history WHERE user_id = :user_id');
		$requete->bindValue(':user_id', $user_id);
		
		return $requete->fetchColumn();
	}
	
	/**
	 * @see HistoryManager::delete()
	 */
	public function delete($id)
	{
		return $this->db->exec('DELETE FROM history WHERE id = '. (int) $id);
	}
	
	/**
	 * @see HistoryManager::getList()
	 */
	public function getList($debut = -1, $fin = -1, $user_id)
	{
		$user_id = (int) $user_id;
		$listeHistory = array();
		
		$sql = 'SELECT id, log, DATE_FORMAT (date, \'le %d/%m/%Y à %Hh%i\') AS date, user_id FROM history ORDER BY id DESC');
		
		// On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '. (int) $limite .' OFFSET ' . (int) $debut;
		}
		
		$requete = $this->db->query($sql);
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'History');
		
		$listeHistory = $requete->fetchAll();
		
		$requete->closeCursor();
		
		return $listeHistory;
	}
	
	/**
	 * @see HistoryManager::getListLast()
	 */	
	public function getListLast($user_id, $nb_history)
	{
		$user_id = (int) $user_id;
		$nb_history = (int) $nb_history;
		$listeHistory = array();
		
		$requete = $this->db->query('SELECT id, log, DATE_FORMAT (date, \'le %d/%m/%Y à %Hh%i\') AS date, user_id FROM history ORDER BY id DESC LIMIT '. $nb_history);
		
		$requete = $this->db->query($sql);
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'History');
		
		$listeHistory = $requete->fetchAll();
		
		$requete->closeCursor();
		
		return $listeHistory;
	}
	
	/**
	 * @see HistoryManager::getUnique()
	 */
	public function getUnique($id)
	{
		$id = (int) $id;
		
		$requete = $this->db->prepare('SELECT id, log, DATE_FORMAT (date, \'le %d/%m/%Y à %Hh%i\') AS date, user_id FROM history WHERE id = ?');
		$requete->bind_param('i', $id, PDO::PARAM_INT);
		$requete->execute();
		
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'History');
		
		return $requete->fetch();
	}
	
	/**
	 * @see HistoryManager::update()
	 */
	protected function update(History $history)
	{
		$requete = $this->db->prepare('UPDATE history SET log = :log, date = :date, user_id = :user_id WHERE id = :id');
		
		$requete->bindValue(':log', $history->getLog());
		$requete->bindValue(':date', $history->getDate());
		$requete->bindValue(':user_id', $history->getUser_id());
		$requete->bindValue(':id', $history->getId());
		
		return $requete->execute();
	}
}