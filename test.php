<?php
	/**
	 *
	 * Vérifie si l'email est correcte
	 *
	**/
	
	/*$email = "test@mail";
	if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) 
		echo 'Cet email a un format non adapté.';*/
	
	
	/**
	 *
	 * Vérifie si l'extension de l'image est correcte
	 *
	**/
	$image = "image.jpg";
	$img = "image.pdf";
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

echo estImageValide($image);

	
	
?>