<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
</head>
<body>

	<form action='accueil_connexion.php' method="POST" enctype="multipart/form-data" autocomplete="on">

		<label for=pseudo> Pseudo </label> <input type="text" name="pseudo" id="pseudo" value="<?php if (isset($_COOKIE['pseudo'])){echo $_COOKIE['pseudo'];}?>" required> 
		<?php
		if (isset($_GET['erreur_pseudo']))
		{
		echo $_GET['erreur_pseudo']; 
		} 
	?>	
		<br>

		<label for="mdp">Mot de passe</label> <input type="password" name="mdp" id="mdp" required>

	<?php
		if (isset($_GET['erreur_mdp']))
		{
			echo $_GET['erreur_mdp'];
		} 
	?>

		<br /> <input type="submit" name="valider" id="valider">


</body>
</html>