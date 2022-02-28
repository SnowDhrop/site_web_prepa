<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
</head>
<body>
	<form action="confirmation_inscription.php" method="POST" enctype="multipart/form-data"> <!-- Formulaire inscription -->

<?php                                        // Erreur pseudo existant
			if (isset($_GET['erreur_pseudo']))
			{
				echo $_GET['erreur_pseudo']; 
?> 
			<br> Vous pouvez vous connecter en suivant ce lien : <a href="connexion.php" title="Connectez-vous">Connexion</a> <br> <br> 
<?php 
			}
?>
		<label for="nom"> Nom </label><input type="text" name="nom" id="nom" required="nom" placeholder="Votre nom" value="<?php if (isset($_COOKIE['nom'])){ echo $_COOKIE['nom'];} ?>" required>
<?php                                       // Erreur format nom
			if (isset($_GET['erreur_nom']))
			{
				echo $_GET['erreur_nom'] ; 
			}
?>
		 <br>


		<label for="prenom"> Prénom</label><input type="text" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php if (isset($_COOKIE['prenom'])){ echo $_COOKIE['prenom'];} ?>" required> 
<?php			
			if (isset($_GET['erreur_prenom']))         // Erreur format prénom
			{
				echo $_GET['erreur_prenom'] ; 
			}
		
?>
		<br />
		<label for="mdp">Mot de passe</label> <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" required> <br>
<?php
		if (isset($_GET['erreur_mdp']))               // Erreur format mdp
		{
			echo $_GET['erreur_mdp'] ; 	?> <br /> <br /> <?php 	 
		}
?>

		
		<label for="mdp_confirmation">Confirmez votre mot de passe</label><input type="password" name="mdp_confirmation" id="mdp" required> 

<?php                                             //Erreur confirmation du mdp
		if (isset($_GET['erreur_confirmation_mdp']))
		{
		echo $_GET['erreur_confirmation_mdp']; 
	
		} 
?>

		<br> <br /> <input type="submit" name="valider" id="valider">

<?php 
	if (isset($_GET['erreur_champs']))
	{
		echo $_GET['erreur_champs']; ?> <br /> <?php
	}
?>

	</form>

</body>
</html>