<form method="POST" action="index.php?uc=connexion&action=valideConnexion">
	<fieldset>
		<legend><h2>Veuillez vous connectez</h2></legend>
		
		<label>Login</label>
		<input type="text" name="login" placeholder=""/>
		</br>
		<label>Mot de passe</label>
		<input type="password" name="mdp" placeholder=""/>
		
		<input type="submit" name="connexion" value="Se connecter">
		</br>
		<label><a href="index.php?uc=connexion&action=mdpOublie">Mot de passe oublié ?</a></label>
	</fieldset>
</form>