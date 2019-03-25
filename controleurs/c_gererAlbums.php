<?php
if(!isset($_REQUEST['action']))
{
    $_REQUEST['action'] = 'voirTousAlbums';
}

$action = $_REQUEST['action'];
switch ($action)
{
    case 'voirTousAlbums':
    {
		$loginUser = $_SESSION["login"];
		//id utilisateur
		$utilisateur = $pdo -> getIdUtilisateur($loginUser);
		$idUser = $utilisateur["id"];
		
        $lesAlbums = $pdo->getAlbum($idUser);
		include("vues/v_sommaire.html");
        include("vues/v_listeAlbum.php");
        break;
    }
	case 'ajouterAlbum':  //affiche le formulaire d'ajout de Album
    {
		include("vues/v_sommaire.html");
        include("vues/v_ajoutAlbum.html");
        break;
    }
    
    case 'confirmerAjouterAlbum': //ajoute le Album dans la bdd
    {
		$loginUser = $_SESSION["login"];
        $nomAlbum = $_POST["nomAlbum"];
		$imagePre = $_POST["imgPresentation"];
		$description = $_POST["description"];
		
		//id utilisateur
		$utilisateur = $pdo -> getIdUtilisateur($loginUser);
		$idUser = $utilisateur["id"];
		
		valideInfosAlbum($nomAlbum, $imagePre, $description);
		$nbErreurs = nbErreurs();
		
		if ($nbErreurs==0)
        {
			$nbLigne = $pdo-> ajouterAlbum($nomAlbum, $imagePre, $description, $idUser);
				
				if ($nbLigne != 0 )
				{   
					$loginUser = $_SESSION["login"];
					//id utilisateur
					$utilisateur = $pdo -> getIdUtilisateur($loginUser);
					$idUser = $utilisateur["id"];
					
					$lesAlbums = $pdo->getAlbum($idUser);
					echo "<font color='purple'>*** Ajout de l'Album effectué ***</font>";
					include("vues/v_sommaire.html");
					include("vues/v_listeAlbum.php");
					
				}
				else
				{
					ajouterErreur ("Echec de l'ajout de l'album ");
					include("vues/v_erreurs.php");
					include("vues/v_sommaire.html");					
					include("vues/v_ajoutAlbum.html");
				}    
		}	
		else  
			include("vues/v_erreurs.php");
		break;
        
    }
	
   /* case 'supprimerAlbum':        //affiche le formulaire de suppression
    {
        break;
    }
    
    case 'confirmerSupprimerAlbum':       //effectue la suppression dans la bdd
    {
        break;
    }*/
    
    case 'modifierAlbum':     //affiche le formulaire de modification du Album
    {
		include('vues/v_modifAlbum.html');
        break;
    }
    
    case 'confirmerModifierAlbum':    //modifie le Album dans la bdd
    {
        echo "La modification est cours de construction";
        break;
    }
	default :
	{
		include("vues/v_connexion.html");	
	}
 }
?>