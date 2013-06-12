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
}