<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application Album Photo
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoAlbum qui contiendra l'unique instance de la classe
 
 * @auteur Aichah KARI
**/

class PdoAlbum{   		
      	private static $serveur='localhost';
      	private static $bdd='album';   		
      	private static $user='root' ;    		
      	private static $mdp='root' ;	
		private static $monPdo;
		private static $monPdoAlbum=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoAlbum::$monPdo = new PDO(PdoAlbum::$serveur.';'.PdoAlbum::$bdd, PdoAlbum::$user, PdoAlbum::$mdp); 
		PdoAlbum::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoAlbum::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoAlbum = PdoAlbum::getPdoAlbum();
 
 * @return l'unique objet de la classe PdoAlbum
 */
	public  static function getPdoAlbum(){
		if(PdoAlbum::$monPdoAlbum==null){
			PdoAlbum::$monPdoAlbum = new PdoAlbum();
		}
		return PdoAlbum::$monPdoAlbum;  
	}
	

/**
 * CONNEXION 
 **/
		public function getInfosUtilisateur($login, $mdp)
	{
		$req = "SELECT *
				FROM utilisateur
				WHERE utilisateur.login='$login' and utilisateur.mdp='$mdp'"; 
		$res = PdoAlbum::$monPdo->query($req);
		$ligne = array();
		$ligne = $res->fetch();
		return $ligne;
	}
/**
 *	RECUPERE L'ID DE L'UTILISATEUR CONNECTE
 **/
 public function getIdUtilisateur($login)
{
	$req = "SELECT id
			FROM utilisateur
			WHERE login='$login'"; 
	$res = PdoAlbum::$monPdo->query($req) or die(PdoAlbum::$monPdo->errorInfo());
	$ligne = $res->fetch();
	return $ligne;
}

/**
 * INSCRIPTION
 **/
	public function inscriptionUtilisateur($nom, $prenom, $email, $identifiant, $mdp)
	{
		$req = "INSERT INTO utilisateur (id, email, nom, prenom, login, mdp) VALUES (NULL, '$email', '$nom', '$prenom', '$identifiant', '$mdp')";
		$nbLigne = PdoAlbum::$monPdo->exec($req);
		return $nbLigne;
	}
/**
 * AFFICHE ALBUM EN FONCTION DE L'UTILSATEUR
**/
	public function getAlbum($idUtilisateur)
	{
		$req = "SELECT *
				FROM album a
				INNER JOIN utilisateur u
				ON u.id = a.utilisateur_id
				WHERE utilisateur_id='$idUtilisateur'";
		$res = PdoAlbum::$monPdo->query($req);
		$lesLignes = array();
		$lesLignes = $res->fetchAll();
		return $lesLignes ;
	}
/**
 * AJOUT ALBUMS EN FONCTION DE L'IDENTIFIANT UTILISATEUR
 **/ 
public function ajouterAlbum($nomAlbum, $imagePre, $description, $idUser)
{
	$nomAlbum =  htmlentities($nomAlbum);
	$imagePre =  htmlentities($imagePre);
	$description= addslashes($description);
	$req = "INSERT INTO album(nom_image,imageP,description,utilisateur_id) VALUES ('$nomAlbum', '$imagePre', '$description','$idUser')";
	$nbLigne = PdoAlbum::$monPdo->exec($req);
	return $nbLigne;  
}
	
	
}
	
	
	
	
	
	
	
	
	
?>