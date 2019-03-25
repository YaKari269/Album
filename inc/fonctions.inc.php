<?php
// /** 
 // * Fonctions pour l'album photo
 
 // * @author Aichah KARI

/**
 * Ajoute le libellé d'une erreur au tableau des erreurs 
 * @param $msg : le libellé de l'erreur 
 */
function ajouterErreur($msg){
    if (! isset($_REQUEST['erreurs'])){
      $_REQUEST['erreurs']=array();
    } 
    $_REQUEST['erreurs'][]=$msg;
}

/**
 * Retoune le nombre de lignes du tableau des erreurs 
 * @return le nombre d'erreurs
 */
function nbErreurs(){
    if (!isset($_REQUEST['erreurs'])){
        return 0;
    }
    else{
        return count($_REQUEST['erreurs']);
    }
}
/**
 * Vérifie la validité des 2 arguments : l'idetifiant et le mot de passe, 
 * des message d'erreurs sont ajoutés au tableau des erreurs
 * @param $login 
 * @param $mdp
 */
function valideInfosConnexion($login, $mdp){
	if($login == ""){
        ajouterErreur("Le champ identifiant ne peut pas être vide");
	}

    if($mdp == ""){
            ajouterErreur("Le champ mot de passe ne peut pas être vide");
	} 
}
/**
 * Teste si un quelconque utilisateur est connecté
 * @return vrai ou faux 
**/
function estConnecte()
{
	return isset($_SESSION['login']);
}

/**
 * Enregistre dans une variable session les infos d'un utilisateur
 * @param $login
 * @param $nom 
 * @param $email
**/
function connecter($login,$nom,$email)
{
    $_SESSION['login']=$login;
    $_SESSION['nom']=$nom;
    $_SESSION['email']=$email;
}
/**
 * Vérifie la validité des 5 arguments : le nom, prenom, l'email, l'identifiant 
 * et le mot de passe, des message d'erreurs sont ajoutés au tableau des erreurs
 * @param $nom 
 * @param $prenom 
 * @param $email
 * @param $identifiant
 * @param $mdp
 */
function valideInfosUtilisateur($nom, $prenom, $email, $identifiant, $mdp){
	if($nom == ""){
        ajouterErreur("Le champ nom ne peut pas être vide");
	}

    if($prenom == ""){
        ajouterErreur("Le champ prenom ne peut pas être vide");
	}

    if ($email == "") {
        ajouterErreur("Le champ email ne peut pas être vide");
    }
	else{
		if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
			ajouterErreur("Cet email a un format non adapté.");
		}
	}
	
    if($identifiant == ""){
            ajouterErreur("Il vous faut un identifiant pour vous inscrire");
	}      
            
	if($mdp == ""){
            ajouterErreur("Il vous faut un mot de passe pour vous inscrire");
	}
}

function estExtensionValide($extension)
{		
	if ($extension=="jpg" || $extension=="png" || $extension=="gif" || $extension=="jpeg"){
		return true;
	}
	else{ 
		return false;
	}
}

/**
 *Vérifie que l'image a un bon argument
 * @param  $image
 * @return true si les extensions sont bonnes, false sinon 
 */
function estImageValide($image)
{
    $info = new SplFileInfo($image);
	$extension = $info -> getExtension();
	
	return estExtensionValide($extension);
}

/**
 * Vérifie la validité des 3 arguments : le nom, prenom, l'email, l'identifiant 
 * et le mot de passe, des message d'erreurs sont ajoutés au tableau des erreurs
 * @param $nom 
 * @param $image
 * @param $description
 */
function valideInfosAlbum($nom, $image, $description){
	if($nom == ""){
        ajouterErreur("Le champ nom ne peut pas être vide");
	}

    if ($image == "") {
        ajouterErreur("Le champ image ne peut pas être vide");
    }
	else{
		if (!estImageValide($image)) {
			ajouterErreur("Cet image a un format non adapté.");
		}
	}
	
    if($description == ""){
            ajouterErreur("Le champ email ne peut pas être vide");
	} 
}
/**
 * Détruit la session active
**/
	function deconnecter()
	{
		session_destroy();
	}
	