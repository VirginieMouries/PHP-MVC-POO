<?php

//include_once('controleur/helpers_controllers.php');

class blogController {

	protected $tmpl;
	protected $task;
	protected $model;

	public function __construct () {

		//vue par défaut
		$default_tmpl = "posts.php";

		$this->tmpl = (isset($_GET['view'])) ? htmlspecialchars($_GET['view']) . ".php" : $default_tmpl;

		//on vérifie si les fichiers existent
		$this->test_existence_fichiers ();

		//$function ($view);

	}

	protected function test_existence_fichiers () {

		try
		{

			//contrôle existence fichier "view/blog/" . $this->tmpl
			if (!file_exists("vue/blog/" . $this->tmpl)) {

				throw new RuntimeException("Ce fichier de vue n'existe pas!!!!!");	

			}

		}
		catch (Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
		    die('Erreur : '.$e->getMessage());	
		}

	}

	public function execute ($task) {
		
		$this->task = strtolower($task);

		try
		{

			if (!method_exists($this, $this->task)) {

				throw new RuntimeException("Cette méthode n'existe pas!!!!!");

			}

		}
		catch (Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
		    die('Erreur : '.$e->getMessage());	
		}

		$this->getModel();

		$method = $this->task;
		$this->$method ();

	}
	
	protected function getModel () {

		try
		{

			//contrôle existence fichier "modele/blog/" . $view
			if (!file_exists("modele/blog/" . $this->task . ".php")) {

				throw new RuntimeException("Ce fichier modèle n'existe pas!!!!!");	

			}
			
			require ('modele/blog/' . $this->task . '.php');
		
			$classModelName = $this->task . "Model";

			if (!class_exists($classModelName)) {

				throw new RuntimeException("Cette classe n'existe pas!!!!!");

			}

			$this->model = new $classModelName ();

		}
		catch (Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
		    die('Erreur : '.$e->getMessage());	
		}
		
	}

	protected function posts () {

		$model = $this->model;

		// On demande les 5 derniers billets (modèle)
		$billets = $model->get_billets(0, 5);

		// On effectue du traitement sur les données (contrôleur)
		// Ici, on doit surtout sécuriser l'affichage
		foreach($billets as $cle => $billet)
		{
		    $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
		    $billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
		}

		$title = "Liste des posts";

		$this->show_view ($billets, $title);

	}

	protected function commentaires () {

		try
		{

			if (!isset($_GET['billet'])){

				throw new RuntimeException("Aucun post sélectionné!!!!!");

			}

			if (!$billet = (int)$_GET['billet']) {

				throw new RuntimeException("Ce post n'existe pas!!!!!");

			}

			$model = $this->model;

			//on affiche les commentaires d'un billet
			$datas_billet = $model->get_billet($billet);

			if (empty($datas_billet['billet'])) {

				throw new RuntimeException("Ce post n'existe pas!!!!!");
				
			}

			$title = "Commentaires du post donr l'id est : " . $billet;

			$this->show_view ($datas_billet, $title);

		}
		catch (Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
		    die('Erreur : '.$e->getMessage());	
		}

	}

	public function show_view (&$datas, $title) {
		
		// On affiche la page (vue)
		include_once('vue/blog/view.html.php');

		$view = new viewBlog ($title, $datas, "blog");

		$view->display($this->tmpl);

	}
}







