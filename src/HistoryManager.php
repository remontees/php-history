<?php

/**
 * Classe représentant les classes de base à implémenter pour gérer les historiques
 * @author remontees
 * @version 0.1
 */

abstract class HistoryManager
{
	/**
	 * Méthode permettant d'ajouter une entrée d'historique.
	 * @param $history History L'historique à ajouter
	 * @return bool
	 */
	abstract protected function add(History $history);
	
	/**
	 * Méthode renvoyant le nombre d'entrées d'historique total.
	 * @return int
	 */
	abstract public function countAll();
	
	/**
	 * Méthode renvoyant le nombre d'entrées d'historique total par membre.
	 * @param $user_id int L'identifiant de l'utilisateur
	 * @return int
	 */
	abstract public function countUser($user_id);
	
	/**
	 * Méthode permettant de supprimer une entrée d'historique.
	 * @param $id_history int L'identifiant de l'historique à supprimer
	 * @return bool
	 */
	abstract public function delete($id);
	
	/**
	 * Méthode retournant une liste d'historique précise.
	 * @param $debut int La première entrée à sélectionner
	 * @param $fin int La dernière entrée à sélectionner
	 * @param $user_id int L'identifiant de l'utilisateur concerné par la requête
	 * @return array La liste des entrées d'historiques. Chaque entrée du tableau est un objet History.
	 */
	abstract public function getList($debut = -1, $fin = -1, $user_id);
	
	/**
	 * Méthode retournant une liste contenant les dernières entrées d'historiques que l'on veut.
	 * @param $user_id int L'identifiant de l'utilisateur concerné
	 * @param $nb_history int Le nombre d'entrées d'historiques que l'on veut
	 * @return array La liste des dernières entrées d'historique du membre. Chaque entrée du tableau est un objet History.
	 */
	abstract public function getListLast($user_id, $nb_history);
	
	/**
	 * Méthode permettant de retourner une entrée d'historique précise.
	 * @param $id int L'identifiant de l'entrée d'historique à retourner.
	 * @return History L'historique demandé
	 */
	abstract public function getUnique($id);
	
	/**
	 * Méthode permettant d'enregistrer une entrée d'historique.
	 * @param $history History L'historique à enregistrer
	 * @see self::add()
	 * @see self::modify()
	 * @return bool
	 */
	public function save(History $history)
	{
		if ($history->isValid())
		{
			$news->isNew() ? $this->add($history) : $this->update($news);
			return true;
		}
		else
		{
			throw new RuntimeException('L\'entrée d\'historique doit être valide pour être sauvegardée.');
			return false;
		}
	}
	
	/**
	 * Méthode permettant de modifier une entrée d'historique.
	 * @param $history History L'historique à modifier.
	 * @return bool
	 */
	abstract protected function update(History $history);
}