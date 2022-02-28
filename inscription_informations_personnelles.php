<?php
session_start();

if (isset($_SESSION['id']))  // Test si variable session existe
{

	$bdd = new PDO('mysql:host=localhost; dbname=ecole; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	$req = $bdd -> prepare ('SELECT nom, prenom, genre, date_de_naissance, situation, mail, telephone FROM users WHERE id = ?');  // Récup nom, prénom dans bdd
	$req -> execute (array($_SESSION['id']));
	$donnees= $req -> fetch();

	setcookie('nom', $donnees['nom'], time() + 365 * 24 * 3600, null, null, false, true); // Crée cookies nom, prénom
	setcookie('prenom', $donnees['prenom'], time() + 365*24*3600, null, null, false, true);

	?> 

	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">   
	<title>Inscription</title>


</head>


<header>
	<?php include '/wamp64/www/portfolio/index/menu/menu.php' ; ?>
</header>


<body>

	<strong> Bienvenue ! Plus que quelques informations à remplir pour intégrer notre prestigieuse école. </strong>

	<h1>
		Formulaire d'inscription
	</h1>

	<form method="POST" action="inscription_situation_familiale.php" enctype="multipart/form-data">
	<p> <h2> 
				Informations personnelles
		</h2>
<?php 
if (isset($_GET['erreur_champs']))
{
	echo $_GET['erreur_champs'];?><br /> <br /> <?php
}
?>
		Vous êtes <br>
		<label for="genre_male">Un homme</label><input type="radio" name="genre" id="genre_male" value="homme" 
			<?php 
				if(isset($donnees['genre']))
				{
					if($donnees['genre']=='homme')
					{
						echo "checked";
					}
				}
				elseif(isset($_COOKIE['genre']))
				{
					if($_COOKIE['genre'] == 'homme')
					{
						 echo "checked" ;
					}
				}

			?> 

			required>

		<label>Une femme</label> <input type="radio" name="genre" id="genre_fem" value="femme"
		<?php 
			if (isset($donnees['genre']))
			{
				if ($donnees['genre']=='femme')
				{
					echo "checked";
				}
			}
			elseif (isset($_COOKIE['genre']))
			{
				if($_COOKIE['genre'] == 'femme')
				{ 
					echo "checked" ;
				}
			}
		?> required> 
<?php
		if (isset($_GET['erreur_genre']))
		{
			echo $_GET['erreur_genre']; 
		} 
?>
		<br>



		<label for="date_de_naissance">Date de naissance</label> <input type="date" value=
		<?php 
			if (isset($donnees['date_de_naissance']))
			{
				echo $donnees['date_de_naissance'];
			}
			elseif (isset($_COOKIE['date_de_naissance']))
			{
				echo $_COOKIE['date_de_naissance'];
			}
			else
			{
				echo "2008-01-01" ;
			}
		?>

		 name="date_de_naissance" id="date_de_naissance" min="1991-01-01" max="2011-01-01" required> 
<?php
			if (isset($_GET['erreur_date_de_naissance']))
			{
				echo $_GET['erreur_date_de_naissance'];
			}

?>
		 <br>


		Situation <br>
		<label for="situation_celibataire">Célibataire</label><input type="radio" name="situation" id="situation_celibataire" value="celibataire" 
		<?php
			if (isset($donnees['situation']))
			{
				if ($donnees['situation'] == "celibataire")
				{
					echo "checked" ;
				}
			}
			elseif(isset($_COOKIE['situation']))
			{
				if($_COOKIE['situation'] == 'celibataire')
				{ 
					echo "checked" ;
				}
			}
		?> required> 

		<label for="situation_marie">Marié</label> <input type="radio" name="situation" id="situation_marie" value="marie" 
<?php 
			if (isset($donnees['situation']))
			{
				if ($donnees['situation'] == 'marie')
				{
					echo "checked" ;
				}
			}
			elseif(isset($_COOKIE['situation']))
			{
				if($_COOKIE['situation'] == 'marie')
				{ 
					echo "checked" ;
				}
			}
?> 
		required>
<?php
		if (isset($_GET['erreur_situation']))
		{
			echo $_GET['erreur_situation'];
		} 
?>
		 <br>


		<label for="telephone">N° de téléphone</label> <input type="tel" name="telephone" id="telephone" value="
<?php 
			if (isset($donnees['telephone']))
			{
				echo $donnees['telephone'];
			}
			elseif (isset($_COOKIE['telephone']))
			{ 
				echo $_COOKIE['telephone'];
			} 
		?>"required>
<?php
		if (isset($_GET['erreur_telephone']))
		{
			echo $_GET['erreur_telephone'];
		} 
?>
		 <br>


		<label for="mail"> Adresse mail </label> <input type="email" name="mail" id="mail" placeholder="Votre adresse mail" value="
<?php 
			if (isset($donnees['mail']))
			{
				echo $donnees['mail'];
			}
			elseif (isset($_COOKIE['mail']))
			{ 
				echo $_COOKIE['mail'];
			} 
?>
"required> 
<?php
		if (isset($_GET['erreur_mail']))
		{
			echo $_GET['erreur_mail'];
		}
?>
		<br>



		<label for="pays">Pays</label><input type="text" name="pays" id="pays" placeholder="France" value="
<?php 
			if (isset($_COOKIE['pays']))
			{ 
				echo $_COOKIE['pays'];
			} 
		?>" required>
<?php
			if (isset($_GET['erreur_pays']))
			{
				echo $_GET['erreur_pays'];
			} 
?>
		<br>


		<label for="adresse">Adresse</label><input type="text" name="adresse" id="adresse" placeholder="Votre adresse" value="
<?php 
			if (isset($_COOKIE['adresse']))
			{ 
				echo $_COOKIE['adresse'];
			} 
?>
" required>

<?php
			if (isset($_GET['erreur_adresse']))
			{
				echo $_GET['erreur_adresse'];  
			}
?>
		<br>


		<label for="code_postal">Code postal</label> <input type="text" name="code_postal" id="adresse" placeholder="Votre code postal" value="
<?php 
			if (isset($_COOKIE['code_postal']))
			{ 
				echo $_COOKIE['code_postal'];
			} 
		?>" required>
<?php
		if (isset($_GET['erreur_code_postal']))
		{
			echo $_GET['erreur_code_postal'];
		} 
?>
		 <br>


		<label for="ville">Ville</label> <input type="text" name="ville" id="ville" placeholder="Votre ville" value="
<?php 
			if (isset($_COOKIE['ville']))
			{ 
				echo $_COOKIE['ville'];
			} 
?>
" required>
<?php
		if (isset($_GET['erreur_ville']))
		{
			echo $_GET['erreur_ville'];
		}
?>
		 <br>


		<label for="photo">Insérez une photo de vous au format .jpeg ou .jpg de maximum 1Mo</label><br>
		<input type="file" name="photo" id="photo" required> <br>
		<?php
		if (isset($_GET['erreur_photo_poids']))
		{
			echo $_GET['erreur_photo_poids']; ?> <br> <?php
		} 
		if (isset($_GET['erreur_photo_extension']))
		{
			echo $_GET['erreur_photo_extension']; ?> <br> <?php
		}
		?>

		<input type="submit" name="valider" id="valider">
	</p>	
	



	</form>


</body>
</html>

<?php 

	$req->closeCursor();

}
else
{
?> <p>Veuillez vous authentifier en suivant ce lien : <br>
<a href="connexion.php">Connexion</a></p> <?php  // Variable session n'existe pas
}
?>