<?php

class Factory
{
	private static $_db;

	public static function getDbo () {

		if (!self::$_db) {

			self::_createDbo ();

		}

		return self::$_db;

	}

	private static function _createDbo () {

		try
		{
		  // On se connecte à MySQL
		  self::$_db = new PDO('mysql:host=localhost;dbname=sta15;charset=utf8', 'sta15', 'YnFuJv2AA6ai58hd');
		  //echo "<br />Création de l'objet bdd<br />";
		}
		catch(Exception $e)
		{
		  // En cas d'erreur, on affiche un message et on arrête tout
		    die('Erreur : '.$e->getMessage());
		}

	}
}

//$bdd = Factory::getDbo ();
?>