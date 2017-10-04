<?php

require_once 'modele/model.php';

class commentairesModel extends Model {

	function get_billet($id_billet)
	{

	    $datas = array ();

		$req = $this->db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
		$req->execute(array($id_billet));
		$datas['billet'] = $req->fetch();
		
		$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

		// Récupération des commentaires
		$req = $this->db->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
		$req->execute(array($id_billet));
	    $datas['commentaires'] = $req->fetchAll();    
	    
	    return $datas;
	}

}
