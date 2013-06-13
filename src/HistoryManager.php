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
}