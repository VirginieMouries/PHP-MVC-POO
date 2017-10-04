<?php

abstract class Model {

	protected $db;// Instance de PDO

	public function __construct()
	{
		require_once 'libraries/factory.php';

		$this->db = Factory::getDbo ();

	}

}
