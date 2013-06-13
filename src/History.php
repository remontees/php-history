<?php

/**
 * Classe représentant une entrée d'historique, un log
 * @author remontees
 * @version 0.1
 */

class History
{
	protected $id;
	protected $log;
	protected $date;
	protected $user_id;
	
	public function __construct($user_id, $log = null)
	{
		$this->date = new \DateTime();
		$this->user_id = int($user_id);
		$this->log = $log;
	}
	
	/**
	 * Méthode assignant les valeurs spécifiées aux attributs
	 * @param $donnees array Les données à assigner
	 * @return void
	 */
	public function hydrate(array $donnees)
	{
		foreach ($donnees as $attribut => $valeur)
		{
			$methode = 'set'.ucfirst($attribut);
			
			if (is_callable(array($this, $methode)))
			{
				$this->$methode($valeur);
			}
		}
	}
	
	/**
	 * Méthode permettant de savoir si l'entrée d'historique est nouvelle.
	 * @return bool
	 */
	public function isNew()
	{
		return empty($this->id);
	}
	
	/**
	 * Méthode permettant de savoir si l'entrée d'historique est valide.
	 * @return bool
	 */
	public function isValid()
	{
		return !(empty($this->log) || empty($this->date) || empty($this->user_id));
	}
	
	// SETTERS //
	public function setId($id)
	{
		if (isset($id) && is_int($id))
		{
			$this->id = (int) $id;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function setLog($log)
	{
		if (is_string($log) && isset($log))
		{
			$this->log = $log;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function setDate($date)
	{
		$this->date = $date;
		return true;
	}
	
	public function setUser_id($user_id)
	{
		if (is_int($user_id) && isset($user_id))
		{
			$this->user_id = $user_id;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// GETTERS //
	public function getId()
	{
		return $this->id;
	}
	
	public function getLog()
	{
		return $this->log;
	}
	
	public function getDate()
	{
		return $this->date;
	}
	
	public function getUser_id()
	{
		return $this->user_id;
	}
}