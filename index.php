<?php
require_once("inc/fonctions.inc.php");
require_once("inc/class.pdoAlbum.php");
session_start();
include("vues/v_head.html");


$pdo = PdoAlbum::getPdoAlbum(); //fonctions inc
$estConnecte = estConnecte();

if(!isset($_REQUEST['uc']))
{
	$_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
echo $uc;
switch($uc)
{
	case 'connexion' : 
	{
		include("controleurs/c_connexion.php");
		break;
	}
	case 'gererAlbum' :
	{
		include("controleurs/c_gererAlbums.php");
        break;
	}
	case 'gererPhoto' :
	{
		include("controleurs/c_gererPhoto.php");
        break;
	}
}

include("vues/v_footer.html");
?>