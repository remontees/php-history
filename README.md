php-history
===========

Système de gestion d'historiques d'actions

Utilisation
-----------

Il suffit d'inclure tous les fichiers de /src dans votre projet et de charger ces fichiers via un autoload comme celui-ci :

	<?php
	function autoload($classname)
	{
	  if (file_exists($file = dirname (__FILE__) . '/' . $classname . '.class.php'))
	  {
		require $file;
	  }
	}
	 
	spl_autoload_register('autoload');

Enfin, utilisez les fonctions qui sont déjà bien documentées et tout ira bien !