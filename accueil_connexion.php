<?php

session_start();

	try
	{
		$bdd = new PDO('mysql:host=localhost; dbname=ecole; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)                               // connexion bdd
	{
		die('Erreur : ' .$e->getMessage());
	}

setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true); // set cookie

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Espace membre</title>                          <!-- HTML -->
</head>
<body>

<?php

if (isset($_POST['pseudo'], $_POST['mdp']))          // Test si variable présente
{
	$_POST['pseudo']= htmlspecialchars($_POST['pseudo']);    // Empêche faille XSS
	$_POST['mdp'] = htmlspecialchars($_POST['mdp']);


	$req = $bdd -> prepare('SELECT id, nom, prenom, mdp FROM users WHERE pseudo=?'); // récup id, pseudo, mdp hash de la bdd

	$req -> execute(array($_POST['pseudo']));

	$donnees = $req -> fetch();
	
	
		if (!$donnees)             // Test si pseudo existe dans bdd
		{
			$mauvais_pseudo = 'Votre pseudo est incorrect' ;
			header('location: connexion.php?erreur_pseudo='.$mauvais_pseudo);
		}
		else
		{
			if (password_verify($_POST['mdp'], $donnees['mdp']))   // test si mdp existe dans bdd
			
			{ 
				$mdp_hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

				      // Création variable sessions et cookies 
				$_SESSION['pseudo'] = $_POST['pseudo'];
				$_SESSION['id'] = $donnees['id'];
				
				setcookie('nom', $donnees['nom'], time() + 365 * 24 * 3600, null, null, false, true);
				setcookie('prenom', $donnees['prenom'], time() + 365*24*3600, null, null, false, true);


				?>								
										<!-- HTML -->
				 <h1> Bienvenue dans votre espace membre :)  </h1> <br>  

					<p> Vous pouvez maintenant vous inscrire en suivant ce lien <br>
						<a href="inscription_informations_personnelles.php" title="Plus que quelques informations !"> Inscription </a> </p>

				<?php
			}
			else
			{
				$mauvais_mdp = "Votre mot de passe est incorrect";  // Message erreur mdp
				header('location: connexion.php?erreur_mdp='.$mauvais_mdp);
			}

		}
		
	
		
}	

else
{
	echo "Veuillez rentrer un pseudo et un mdp";  // Message champs vides
}


?>

</body>
</html>
