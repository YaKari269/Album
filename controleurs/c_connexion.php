<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.html");
		break;
	}
	case 'valideConnexion':{

		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		
		valideInfosConnexion($login, $mdp);
		$nbErreurs = nbErreurs();
		
		//echo $nbErreurs;
		if ($nbErreurs == 0)
		{
			$utilisateur=$pdo->getInfosUtilisateur($login,$mdp);
			if(!is_array($utilisateur))
			{
				ajouterErreur("Login ou mot de passe incorrect");
				include ("vues/v_connexion.html");
				include ("vues/v_erreurs.php");
			}
			else
			{
				$idUser = $utilisateur['id'];
				$nom = $utilisateur['nom'];
				$email = $utilisateur['email'];
				connecter($login,$nom,$email);
				
				$lesAlbums = $pdo->getAlbum($idUser);
				if(empty($lesAlbums)){
					include("vues/v_sommaire.html");
					echo "<font color='green'>*** Vous n'avez pas d'albums ***</font>";
					include("vues/v_listeAlbum.php");
					
				}
				else{
					include("vues/v_sommaire.html");
					include("vues/v_listeAlbum.php");
				}
				
			}
		}
		else{
			include("vues/v_erreurs.php");
			include("vues/v_connexion.html");
		}
		
        break;
	}
	case 'inscription':
	{
		include("vues/v_inscription.html");
		break;
	}
	case 'confirmationInscription':
	{
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$identifiant = $_POST['identifiant'];
		$mdp = $_POST['mdp'];
		
		valideInfosUtilisateur($nom, $prenom, $email, $identifiant, $mdp);
		$nbErreurs = nbErreurs();
		
		//echo $nbErreurs;
		if ($nbErreurs==0)
		{
			$nbLigne = $pdo->inscriptionUtilisateur($nom, $prenom, $email, $identifiant, $mdp);
			if($nbLigne != 0){
				echo "<font color='green'>*** Votre inscription a bien été effectué ***</font>";
				include("vues/v_connexion.html");
			}
			else
			{
				ajouterErreur ("Echec de votre inscription");
				include("vues/v_inscription.html");
				include("vues/v_erreurs.php");
			}
		}
		else{
			include("vues/v_inscription.html");
			include("vues/v_erreurs.php");
		}
		
		break;
	}
	case 'deconnexion':
	{
		include("vues/v_connexion.html");
		echo "<font color='green'>Vous êtes déconnecté</font>";
		break;
	}
	default :
	{
		include("vues/v_connexion.html");
		break;
	}
        
}
?>