<?php 

class view {

	protected $title;
	protected $datas;
	protected $directory;

	public function __construct ($title, &$datas, $directory)
	{
		$this->title     = $title;
		$this->datas     = $datas;
		$this->directory = $directory;

	}

	public function display ($tmpl) {
		//http://php.net/manual/fr/function.ob-start.php
		//ob_start() démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon. 
		ob_start();
		// include the requested template filename in the local scope
		// (this will execute the view logic).
		
		include_once ("vue/" . $this->directory . "/header.php");

		include_once("vue/" . $this->directory . "/" . $tmpl);

		include_once ("vue/" . $this->directory . "/footer.php");

		// done with the requested template; get the buffer and
		// clear it.
		// http://php.net/manual/fr/function.ob-get-contents.php
		// Retourne le contenu du tampon de sortie
		$output = ob_get_contents();

		//http://php.net/manual/fr/function.ob-end-clean.php
		//Détruit les données du tampon de sortie et éteint la temporisation de sortie
		ob_end_clean();

		echo $output;

	}
}