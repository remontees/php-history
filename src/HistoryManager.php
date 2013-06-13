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
}