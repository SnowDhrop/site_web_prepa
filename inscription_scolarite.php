<?php

	session_start();
	if (isset($_SESSION['id']))
	{
		try
		{
			$bdd = new PDO('mysql:host=localhost; dbname=ecole; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch (Exception $e)
		{
			die ('ERREUR : '.$e->getMEssage());
		}

$req = $bdd -> prepare ('SELECT dernier_lycee FROM scolarite WHERE users_id=?');
$req -> execute (array($_SESSION['id']));
$donnees = $req -> fetch();


if (isset($_GET['erreur']))
{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>

	 <script>
        function aff_cach_input(action){ //la fonction JS
            if (action == "oui") //on regarde si tu veux afficher ou cacher le input
            {
                document.getElementById('block_bourse').style.display="block"; //Si oui, on l'affiche
            }
            else
            {
                document.getElementById('block_bourse').style.display="none"; //Si non, on le cache
            }
        return true;
        }
</script>
</head>

<header>
	<?php include '/wamp64/www/portfolio/index/menu/menu.php' ; ?>
</header>


<body onload="aff_cach_input('non');">

	<strong> Bienvenue ! Plus que quelques informations à remplir pour intégrer notre prestigieuse école. </strong>
		
		<h2>Scolarité</h2>

<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_champs")
	{
		echo "Veuillez remplir tous les champs";
	}
?>

	<form method="POST" action="fin_inscription.php" enctype="multipart/form-data">
		<label for="dernier_lycee">Dernier lycée fréquenté </label><input type="text" name="dernier_lycee" id="dernier_lycee" value= "
<?php 
	if (isset($_COOKIE['dernier_lycee']))
	{
		echo $_COOKIE['dernier_lycee'];
	}
	elseif (isset($donnees['dernier_lycee']))
	{
		echo $donnees['dernier_lycee'];
	}
?>"required>
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_lycee")
	{
		echo "Veuillez un nom de lycée correct";
	}
?>

		<br>
		<label for="regime">Choisissez votre régime</label>
		<select name="regime" id="regime" required>
			<option value="demi_pensionnaire" selected>Demi-pensionnaire</option>
			<option value="externe">Externe</option>
			<option value="interne">Interne</option>
		</select>
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_regime")
	{
		echo "Veuillez sélectionner un régime";
	}
?><br>

		Pouvez vous bénéficier de la bourse ?<br> 
		<label for="bourse_oui">Oui</label> <input type="radio" name="choix_bourse" id="bourse_oui" value="oui" onchange="aff_cach_input('oui')" required> 
		<label for="bourse_non">Non</label><input type="radio" name="choix_bourse" id="bourse_non" value="non" onchange="aff_cach_input('non')" checked required> 
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_bourse")
	{
		echo "Veuillez cocher une des propositions";
	}
?><br>
		
		<span id="block_bourse"><label for="niveau_bourse" >Quel niveau de bourse avez-vous ?</label> 
		<select name="niveau_bourse" id="niveau_bourse" required>
			<option value="pas_de_bourse" selected></option>
			<option value="0_bis">0 bis</option>
			<option value="1" >1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select>
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_niveau_bourse")
	{
		echo "Veuillez sélectionner le niveau de votre bourse";
	}
?><br></span> 

		<label for="option_lycee">Quelle option avez-vous pris(e) au lycée ?</label>
		<select name="option_lycee" id="option_lycee" required>
			<option value="mathematiques">Mathématiques</option>
			<option value="svt">SVT</option>
			<option value="pc">Physique-Chimie</option>
			<option value="informatique">Informatique</option>
			<option value="sciences_ingenieur">Sciences de l'ingénieur</option>
		</select> 
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_option")
	{
		echo "Veuillez choisir une option";
	}
?><br>
		<label for="mention">Avez-vous eu(e) une mention au BAC ?</label>
		<select name="mention" id="mention" required>
			<option value="no_mention">Pas de mention</option>
			<option value="assez_bien">Assez Bien</option>
			<option value="bien">Bien</option>
			<option value="tres_bien">Très Bien</option>
			<option value="felicitations_jury">Félicitations du Jury</option>
		</select> 
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_mention")
	{
		echo "Veuillez choisir une mention";
	}
?><br>
		<label for="langue_lv1">Quelle langue voulez-vous étudier en LV1 ?</label> 
		<select name="langue_lv1" id="langue_lv1" required>
			<option value="francais">Français</option>
			<option value="anglais">Anglais</option>
			<option value="allemand">Allemand</option>
			<option value="espagnol">Espagnol</option>
			<option value="italien">Italien</option>
			<option value="chinois">Chinois</option>
			<option value="russe">Russe</option>
		</select>
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_lv1")
	{
		echo "Veuillez sélectionner une lv1";
	}
?><br>
		<label for="langue_lv1">Quelle langue voulez-vous étudier en LV2 ?</label> 
		<select name="langue_lv2" id="langue_lv2" required>
			<option value="anglais">Anglais</option>
			<option value="allemand">Allemand</option>
			<option value="espagnol">Espagnol</option>
			<option value="italien">Italien</option>
			<option value="chinois">Chinois</option>
			<option value="russe">Russe</option>
		</select>
<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_lv2")
	{
		echo "Veuillez sélectionner une lv2";
	}
?><br>
		<input type="submit" name="valider" id="valider">
		</p>


	</form>

</body>
</html>

<?php
die();
}

elseif (isset($_POST['nom_pere'], $_POST['prenom_pere'], $_POST['adresse_pere'], $_POST['code_postal_pere'], $_POST['ville_pere'], $_POST['telephone_pere'], $_POST['nom_mere'], $_POST['prenom_mere'], $_POST['adresse_mere'], $_POST['code_postal_mere'], $_POST['ville_mere'], $_POST['telephone_mere'], $_POST['fratrie'], $_POST['quotient_familial']))
		{
			if (preg_match('#^[a-zA-Z \'éèäëïöüÿâêîôû-]{1,47}$#', $_POST['nom_pere']))
			{
				if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{1,50}$#', $_POST['prenom_pere']))
				{
					if (preg_match('#^[A-Za-z\d \'éèäëïöüÿâêîôû-]+$#', $_POST['adresse_pere']))
					{
						if (preg_match('#^[0-9]{5}$#', $_POST['code_postal_pere']))
						{
							if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{0,58}$#', $_POST['ville_pere']))
							{
								if (preg_match('#^0[679]([. -]?\d{2}){4}$#', $_POST['telephone_pere']))
								{
									if (preg_match('#^[a-zA-Z \'éèäëïöüÿâêîôû-]{1,47}$#', $_POST['nom_mere']))
									{
										if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{1,50}$#', $_POST['prenom_mere']))
										{
											if (preg_match('#^[A-Za-z\d \'éèäëïöüÿâêîôû-]+$#', $_POST['adresse_mere']))
											{
												if (preg_match('#^[0-9]{5}$#', $_POST['code_postal_mere']))
												{
													if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{0,58}$#', $_POST['ville_mere']))	
													{
														if (preg_match('#^0[679]([. -]?\d{2}){4}$#', $_POST['telephone_mere']))
														{
															if (preg_match('#oui|non#', $_POST['fratrie']))
															{
																if (preg_match('#^[0-9]$#', $_POST['quotient_familial']))
																{
																		if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{0,42}$#', $_POST['pays_mere']))
																		{
																			if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{0,42}$#', $_POST['pays_pere']))
																			{
																				




$nom_pere = htmlspecialchars($_POST['nom_pere']);
$prenom_pere = htmlspecialchars($_POST['prenom_pere']);
$adresse_pere = htmlspecialchars($_POST['adresse_pere']);
$code_postal_pere = htmlspecialchars($_POST['code_postal_pere']);
$ville_pere = htmlspecialchars($_POST['ville_pere']);
$telephone_pere = htmlspecialchars($_POST['telephone_pere']);
$nom_mere = htmlspecialchars($_POST['nom_mere']);
$prenom_mere = htmlspecialchars($_POST['prenom_mere']);
$adresse_mere = htmlspecialchars($_POST['adresse_mere']);
$code_postal_mere = htmlspecialchars($_POST['code_postal_mere']);
$ville_mere = htmlspecialchars($_POST['ville_mere']);
$telephone_mere = htmlspecialchars($_POST['telephone_mere']);
$fratrie = htmlspecialchars($_POST['fratrie']);
$quotient_familial = htmlspecialchars($_POST['quotient_familial']);
$pays_pere = htmlspecialchars($_POST['pays_pere']);
$pays_mere = htmlspecialchars ($_POST['pays_mere']);

if (isset($_POST['presence_fratrie']))
{
	if (preg_match('#oui|non#', $_POST['presence_fratrie']))
	{
		$presence_fratrie = htmlspecialchars($_POST['presence_fratrie']);
		$req2 = $bdd-> prepare(' UPDATE situation_familiale SET presence_fratrie = :presence_fratrie WHERE id = :id');
		$req2 -> execute(array('presence_fratrie' => $presence_fratrie, 'id' => $_SESSION['id']));
		$req2 -> closeCursor();
	}
	else
	{
		header ('location: inscription_situation_familiale.php?erreur='."erreur_presence_fratrie");
	}
}

setcookie('nom_pere', $nom_pere, time()+365*24*3600, null, null, false, true);
setcookie('prenom_pere', $prenom_pere, time()+365*24*3600, null, null, false, true);
setcookie('adresse_pere', $adresse_pere, time()+365*24*3600, null, null, false, true);
setcookie('code_postal_pere', $code_postal_pere, time()+365*24*3600, null, null, false, true);
setcookie('ville_pere', $ville_pere, time()+365*24*3600, null, null, false, true);
setcookie('pays_pere', $pays_pere, time()+365*24*3600, null, null, false, true);
setcookie('telephone_pere', $telephone_pere, time()+365*24*3600,null, null, false, true);
setcookie('nom_mere', $nom_mere, time()+365*24*3600, null, null, false, true);
setcookie('prenom_mere', $prenom_mere, time()+365*24*3600, null, null, false, true);
setcookie('adresse_mere', $adresse_mere, time()+365*24*3600, null, null, false, true);
setcookie('code_postal_mere', $code_postal_mere, time()+365*24*3600, null, null, false, true);
setcookie('ville_mere', $ville_mere, time()+365*24*3600, null, null, false, true);
setcookie('pays_mere', $pays_mere, time()+365*24*3600, null, null, false, true);
setcookie('telephone_mere', $telephone_mere, time()+365*24*3600, null, null, false, true);
setcookie('fratrie', $fratrie, time()+365*24*3600, null, null, false, true);
setcookie('quotient_familial', $quotient_familial, time()+365*24*3600, null, null, false, true);

$req2 = $bdd->prepare('
	UPDATE situation_familiale
	SET nom_pere = :nom_pere, prenom_pere= :prenom_pere, adresse_pere = :adresse_pere, telephone_pere = :telephone_pere, nom_mere = :nom_mere, prenom_mere = :prenom_mere, adresse_mere = :adresse_mere, telephone_mere = :telephone_mere, fratrie = :fratrie, quotient_familial = :quotient_familial
	WHERE users_id = :id');
	$req2->execute(array(
			'nom_pere' => $nom_pere,
			'prenom_pere' => $prenom_pere,
			'adresse_pere' => $adresse_pere.", ".$code_postal_pere.' '.$ville_pere.", ".$pays_pere,
			'telephone_pere' => $telephone_pere,
			'nom_mere' => $nom_mere, 
			'prenom_mere' => $prenom_mere, 
			'adresse_mere' => $adresse_mere.', '.$code_postal_mere.' '.$ville_mere.', '.$pays_mere, 
			'telephone_mere' => $telephone_mere, 
			'fratrie' => $fratrie, 
			'quotient_familial' => $quotient_familial,
			'id' => $_SESSION['id']
			));

	$req2 -> closeCursor();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>

	 <script>
        function aff_cach_input(action){ //la fonction JS
            if (action == "oui") //on regarde si tu veux afficher ou cacher le input
            {
                document.getElementById('block_bourse').style.display="block"; //Si oui, on l'affiche
            }
            else
            {
                document.getElementById('block_bourse').style.display="none"; //Si non, on le cache
            }
        return true;
        }
</script>
</head>


<header>
	<?php include '/wamp64/www/portfolio/index/menu/menu.php' ; ?>
</header>


<body onload="aff_cach_input('non');">

	<strong> Bienvenue ! Plus que quelques informations à remplir pour intégrer notre prestigieuse école. </strong>
		
		<h2>Scolarité</h2>

	<form method="POST" action="fin_inscription.php" enctype="multipart/form-data">
		<label for="dernier_lycee">Dernier lycée fréquenté </label><input type="text" name="dernier_lycee" id="dernier_lycee" value="
<?php 
	if (isset($_COOKIE['dernier_lycee']))
	{
		echo $_COOKIE['dernier_lycee'];
	}

	elseif (isset($donnees['dernier_lycee']))
	{
		echo $donnees['dernier_lycee'];
	}
?>" required><br>

		<label for="regime">Choisissez votre régime</label>
		<select name="regime" id="regime" required>
			<option value="demi_pensionnaire" selected>Demi-pensionnaire</option>
			<option value="externe">Externe</option>
			<option value="interne">Interne</option>
		</select><br>

		Pouvez vous bénéficier de la bourse ?<br> 
		<label for="bourse_oui">Oui</label> <input type="radio" name="choix_bourse" id="bourse_oui" value="oui" onchange="aff_cach_input('oui')" required> 
		<label for="bourse_non">Non</label><input type="radio" name="choix_bourse" id="bourse_non" value="non" onchange="aff_cach_input('non')" checked required> <br>
		
		<span id="block_bourse"><label for="niveau_bourse" >Quel niveau de bourse avez-vous ?</label> 
		<select name="niveau_bourse" id="niveau_bourse" required>
			<option value="pas_de_bourse" selected ></option>
			<option value="0_bis">0 bis</option>
			<option value="1" >1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select><br></span> 

		<label for="option_lycee">Quelle option avez-vous pris(e) au lycée ?</label>
		<select name="option_lycee" id="option_lycee" required>
			<option value="mathematiques">Mathématiques</option>
			<option value="svt">SVT</option>
			<option value="pc">Physique-Chimie</option>
			<option value="informatique">Informatique</option>
			<option value="sciences_ingenieur">Sciences de l'ingénieur</option>
		</select> <br>
		<label for="mention">Avez-vous eu(e) une mention au BAC ?</label>
		<select name="mention" id="mention" required>
			<option value="no_mention">Pas de mention</option>
			<option value="assez_bien">Assez Bien</option>
			<option value="bien">Bien</option>
			<option value="tres_bien">Très Bien</option>
			<option value="felicitations_jury">Félicitations du Jury</option>
		</select> <br>
		<label for="langue_lv1">Quelle langue voulez-vous étudier en LV1 ?</label> 
		<select name="langue_lv1" id="langue_lv1" required>
			<option value="francais">Français</option>
			<option value="anglais">Anglais</option>
			<option value="allemand">Allemand</option>
			<option value="espagnol">Espagnol</option>
			<option value="italien">Italien</option>
			<option value="chinois">Chinois</option>
			<option value="russe">Russe</option>
		</select><br>
		<label for="langue_lv1">Quelle langue voulez-vous étudier en LV2 ?</label> 
		<select name="langue_lv2" id="langue_lv2" required>
			<option value="anglais">Anglais</option>
			<option value="allemand">Allemand</option>
			<option value="espagnol">Espagnol</option>
			<option value="italien">Italien</option>
			<option value="chinois">Chinois</option>
			<option value="russe">Russe</option>
		</select><br>
		<input type="submit" name="valider" id="valider">
		</p>


	</form>



</body>
</html>
<?php	
die();																		
																			}
																			else
																			{
																				header('location: inscription_situation_familiale.php?erreur='."erreur_pays_pere");

																				die();
																			}
																		}
																		else
																		{
																			header('location: inscription_situation_familiale.php?erreur='."erreur_pays_mere");
																			die();
																		}
																}
																else
																{
																	header('location: inscription_situation_familiale.php?erreur='."erreur_quotient_familial");
																	die();
																}
															}
															else
															{
																header('location: inscription_situation_familiale.php?erreur='."erreur_fratrie");
																die();
															}
														}
														else
														{
															header('location: inscription_situation_familiale.php?erreur='."erreur_telephone_mere");
															die();
														}
													}
													else
													{
														header('location: inscription_situation_familiale.php?erreur='."erreur_ville_mere");
														die();
													}			
												}
												else
												{
													header('location: inscription_situation_familiale.php?erreur='."erreur_code_postal_mere");
													die();
												}
											}
											else
											{
												header('location: inscription_situation_familiale.php?erreur='."erreur_adresse_mere");
												die();
											}
										}
										else
										{
											header('location: inscription_situation_familiale.php?erreur='."erreur_prenom_mere");
											die();
										}
									}
									else
									{
										header('location: inscription_situation_familiale.php?erreur='."erreur_nom_mere");
										die();
									}
								}
								else
								{
									header('location: inscription_situation_familiale.php?erreur='."erreur_telephone_pere");
									die();
								}
							}
							else
							{
								header('location: inscription_situation_familiale.php?erreur='."erreur_ville_pere");
								die();
							}
						}
						else
						{
							header('location: inscription_situation_familiale.php?erreur='."erreur_code_postal_pere");
							die();
						}
					}
					else
					{
						header('location: inscription_situation_familiale.php?erreur='."erreur_adresse_pere");
						die();
					}
				}
				else
				{
					header('location: inscription_situation_familiale.php?erreur='."erreur_prenom_pere");
					die();
				}
			}
			else
			{
				header('location: inscription_situation_familiale.php?erreur='."erreur_nom_pere");
				die();
			}
		}
		else
		{
			header('location: inscription_situation_familiale.php?erreur='."erreur_champs");
			die();
		}

	}
	else
	{
		?> <p>Veuillez vous connecter en suivant le lien ci-dessous <br>
		<a href="connexion.php">Connexion</a></p> <?php  // Variable session n'existe pas
	}

?>