<?php	

	try                              // Connexion bdd
	{
		$bdd = new PDO('mysql:host=localhost; dbname=ecole; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));
	}	
	catch (Exception $e)
	{
		die ("ERREUR :".$e->getMessage());
	}



if (isset($_POST['nom'], $_POST['prenom'], $_POST['mdp_confirmation'], $_POST['mdp']))
{
	if (preg_match('#^[a-zA-Z \'éèäëïöüÿâêîôû-]{1,47}$#', $_POST['nom'])) //Test présence variables
{
	if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{1,50}$#', $_POST['prenom']))//Test format du prénom                       
	
	{
		if (preg_match('#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+.!*?$@%_])[-+.!*?$@%\w\déèäëïöüÿâêîôû]{8,16}$#', $_POST['mdp']))             //Test format mdp
		{

			$nom = htmlspecialchars($_POST['nom']);                                            //Evite faille XSS
			$prenom = htmlspecialchars($_POST['prenom']);
			$mdp = htmlspecialchars($_POST['mdp']);
			
          
			$pseudo = strtolower($_POST['nom'].'.'.$_POST['prenom']);             // Création pseudo



			setcookie('nom', $nom, time() + 365*24*3600, null, null, false, true);               //Création de cookies
			setcookie('prenom', $prenom, time() + 365*24*3600, null, null, false, true);
			setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);

			$req = $bdd->prepare('SELECT * FROM users WHERE pseudo=?'); // Appelle bdd, pour vérif si pseudo existe dans bdd
			$req -> execute (array($pseudo));
			$pseudo_existe = $req -> fetch();

			if ($pseudo_existe)                           // Test si pseudo existe déjà dans la bdd
			{
				$erreur_pseudo = 'Il y a déjà un profil avec ce nom et prénom. Votre pseudo est sous la forme nom.prenom';
				header('location: inscription.php?erreur_pseudo='.$erreur_pseudo);
			}	

			else
			{
				$req -> closeCursor();

				if ($_POST['mdp']==$_POST['mdp_confirmation'])                 // Test si mdp = mdp_confirmation

				{
				$hash_pass=password_hash($_POST['mdp'], PASSWORD_DEFAULT);

				$req2 = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp) VALUES(:pseudo, :nom, :prenom, :mdp)');   // Si oui, insertion des données inscrites dans la bdd
				$req2->execute(array(
				'pseudo' => $pseudo,
				'nom'=> $nom,
				'prenom' => $prenom,
				'mdp' => $hash_pass
				));
				$req2 -> closeCursor();

				$id = $bdd->lastInsertId();

				$req3 = $bdd-> query ('INSERT INTO situation_familiale(users_id) VALUES (LAST_INSERT_ID())');
				$req3 -> closeCursor();	
				$req4 = $bdd->query('INSERT INTO scolarite(users_id) VALUES ("'.$id.'")');
				$req4 -> closeCursor();

	?>

				<!DOCTYPE html>
				<html>
				<head>
				<meta charset="utf-8">
				<title>Confirmation d'inscription</title>
				</head>
				<body>



				<p> Vous pouvez maintenant vous connecter  <br>                                  <!-- Lien vers la suite de l'inscription -->
				<a href="connexion.php" title="Connectez-vous">Connexion</a> </p>

<?php
				}
				else                                                     // Erreur confirmation mdp
				{
					$erreur_confirmation_mdp = 'La confirmation de votre mot de passe est différente de votre mot de passe.';

					header('location: inscription.php?erreur_confirmation_mdp='.$erreur_confirmation_mdp);
		
				}			

			}
		}
		else                 // Erreur format mdp
		{
			$erreur_mdp = "Votre mot de passe doit comporter entre 8 et 16 caractères, au moins une lettre majuscule, minuscule, au moins un caractère numérique et au moins un caractère spécial (-?!._)";
			header("location: inscription.php?erreur_mdp=".$erreur_mdp);
		}
	}
	else                   // Erreur format prénom
	{
		$erreur_prenom = "Votre prénom ne peut contenir que des caractères alphabétiques, des caractères spéciaux ('-espace et accents sur les voyelles).";
		header("location: inscription.php?erreur_prenom=".$erreur_prenom);
	}

}	
else                         //Erreur format nom
{
	$erreur_nom = "Votre nom ne peux comporter que des lettres et des caractères spéciaux ('-espace et accents sur les voyelles).";
	header("location: inscription.php?erreur_nom=".$erreur_nom);
}

}
else
{
	$erreur_champs = "Veuillez remplir tous les champs";
	header('location: inscription.php?erreur='.$erreur_champs);
}

?>
</body>
</html>



