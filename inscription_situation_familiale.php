<?php

session_start();
                             
if (isset($_SESSION['id']))
{
	                                				 // Connexion bdd
	try 
		{
			$bdd = new PDO('mysql:host=localhost; dbname=ecole; charset=utf8','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

			$req = $bdd -> prepare('SELECT nom_pere, prenom_pere, telephone_pere, nom_mere, prenom_mere, telephone_mere, fratrie, presence_fratrie, quotient_familial FROM situation_familiale WHERE users_id = ?');
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
                document.getElementById('block_fratrie').style.display="block";
            }
            else
            {
                document.getElementById('block_fratrie').style.display="none";
            }
        return true;
        }
</script>
</head>

<header>
	<?php include '/wamp64/www/portfolio/index/menu/menu.php' ; ?>
</header>


<body onload="aff_cach_input('non');">


	<h1>
		Formulaire d'inscription
	</h1>

	<form method="POST" action="inscription_scolarite.php" enctype="multipart/form-data">

		<p> <h2>
			Situation familiale
			</h2>

<?php
	if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_champs")
	{
		echo "Veuillez remplir tous les champs"; ?> <br /> <br /> <?php
	}
?>
		<label for="nom père">Nom de votre père</label> <input type="text" name="nom_pere" id="nom_pere" value="<?php
		if (isset($donnees['nom_pere']))
		{
			echo $donnees['nom_pere'];
		}
		elseif (isset($_COOKIE['nom_pere']))
		{
			echo $_COOKIE['nom_pere'];
		}
?>
" required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_nom_pere")
		{
			echo "Veuillez renseigner un nom correct";
		}

?>
		<br>


		<label for="prenom_pere">Prénom de votre père</label> <input type="text" name="prenom_pere" id="prenom_pere" value="
<?php
		if (isset($donnees['prenom_pere']))
		{
			echo $donnees['prenom_pere'];
		}
		elseif (isset($_COOKIE['prenom_pere']))
		{
			echo $_COOKIE['prenom_pere'];
		}
?>
" required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_prenom_pere")
		{
			echo "Veuillez renseigner un prénom correct";
		}

?>
		 <br>


		<label for="adresse_pere">Adresse de votre père</label> <input type="text" name="adresse_pere" id="adresse_pere" value="
<?php
		if (isset($_COOKIE['adresse_pere']))
		{
			echo $_COOKIE['adresse_pere'];
		}
?>
" required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_adresse_pere")
		{
			echo "Veuillez renseigner une adresse correcte";
		}

?>
		 <br>


		<label for="code_postal_pere">Code postal</label> <input type="text" name="code_postal_pere" id="code_postal_pere" value="
<?php
		if (isset($_COOKIE['code_postal_pere']))
		{
			echo $_COOKIE['code_postal_pere'];
		}
?>
"required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_code_postal_pere")
		{
			echo "Veuillez renseigner un code postal correct";
		}

?>
		<br>


		<label for="ville_pere"> Ville</label><input type="text" name="ville_pere" id="ville_pere" value="
<?php
		if (isset($_COOKIE['ville_pere']))
		{
			echo $_COOKIE['ville_pere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_ville_pere")
		{
			echo "Veuillez renseigner une ville correcte";
		}

?>
		<br/>


		<label for='pays_pere'> Pays </label><input type="text" name='pays_pere' id='pays_pere' value="
<?php
		if (isset($_COOKIE['pays_pere']))
		{
			echo $_COOKIE['pays_pere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_pays_pere")
		{
			echo "Veuillez renseigner un pays correct";
		}

?>
		<br />


		<label for="telephone_pere">Télephone de votre père</label><input type="tel" name="telephone_pere" id="telephone_pere" value="
<?php
		if (isset($donnees['telephone_pere']))
		{
			echo $donnees['telephone_pere'];
		}
		elseif (isset($_COOKIE['telephone_pere']))
		{
			echo $_COOKIE['telephone_pere'];
		}
?>
" required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur']== "erreur_telephone_pere")
		{
			echo "Veuillez renseigner un numéro de téléphone correct";
		}
?>
		<br>


		<label for="nom_mere">Nom de votre mère</label> <input type="text" name="nom_mere" id="nom_mere" value="
<?php
		if (isset($donnees['nom_mere']))
		{
			echo $donnees['nom_mere'];
		}
		elseif (isset($_COOKIE['nom_mere']))
		{
			echo $_COOKIE['nom_mere'];
		}
?>
" required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_nom_mere")
		{
			echo "Veuillez renseigner un nom correct";
		}

?>
		<br>


		<label for="prenom_mere">Prénom de votre mère</label> <input type="text" name="prenom_mere" id="prenom_mere" value="
<?php
		if (isset($donnees['prenom_mere']))
		{
			echo $donnees['prenom_mere'];
		}
		elseif (isset($_COOKIE['prenom_mere']))
		{
			echo $_COOKIE['prenom_mere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_prenom_mere")
		{
			echo "Veuillez renseigner un prénom correct";
		}

?>
		<br>


		<label for="adresse_mere">Adresse de votre mère</label> <input type="text" name="adresse_mere" id="adresse_mere" value="
<?php
		if (isset($_COOKIE['adresse_mere']))
		{
			echo $_COOKIE['adresse_mere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_adresse_mere")
		{
			echo "Veuillez renseigner une adresse correcte";
		}

?>
		 <br>


		<label for="code_postal_mere">Code postal</label> <input type="text" name="code_postal_mere" id="code_postal_mere" value="
<?php

		if (isset($_COOKIE['code_postal_mere']))
		{
			echo $_COOKIE['code_postal_mere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_code_postal_mere")
		{
			echo "Veuillez renseigner un code postal correct";
		}

?>
		<br>


		<label for="ville_mere">Ville </label><input type="text" name="ville_mere" id="ville_mere" value="
<?php

		if (isset($_COOKIE['ville_mere']))
		{
			echo $_COOKIE['ville_mere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_ville_mere")
		{
			echo "Veuillez renseigner une ville correct";
		}

?>
		<br/>


		<label for='pays_mere'>Pays </label><input type='text' name='pays_mere' id='pays_mere' value="
<?php

		if (isset($_COOKIE['pays_mere']))
		{
			echo $_COOKIE['pays_mere'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_pays_mere")
		{
			echo "Veuillez renseigner un pays correct";
		}

?>
		<br />


		<label for="telephone_mere">Télephone de votre mère</label><input type="tel" name="telephone_mere" id="telephone_mere" value="
<?php
		if (isset($donnees['telephone_mere']))
		{
			echo $donnees['telephone_mere'];
		}
		elseif (isset($_COOKIE['telephone_mere']))
		{
			echo $_COOKIE['telephone_mere'];
		}
?>
" required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_telephone_mere")
		{
			echo "Veuillez renseigner un téléphone correct";
		}

?>
		<br>


		Avez-vous des frères et soeurs ? <br>
		<label for="fratrie_oui">Oui</label> <input type="radio" name="fratrie" value="oui" id="fratrie_oui" onchange="aff_cach_input('oui')" required> 

		<label for="fratrie_non">Non</label> <input type="radio" name="fratrie" id="fratrie_non" value="non"onchange=" aff_cach_input('non')" checked required>
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_fratrie")
		{
			echo "Veuillez cocher la bonne case";
		}
?>
		<br>


		<span id="block_fratrie">
		Font-ils leur scolarité dans l'établissement ? <br>
		<label for="presence_fratrie_oui">Oui</label> <input type="radio" name="presence_fratrie" id="presence_fratrie_oui" value="oui">

		<label for="presence_fratrie_non">Non</label> <input type="radio" name="presence_fratrie" id="presence_fratrie_non" value="non" checked > 
		
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_presence_fratrie")
		{
			echo "Veuillez indiquer si vous avez un frère ou une soeur présent dans l'établissement";
		}
?><br>

		</span>
		<label for="quotient_familial"> Quotient familial</label> <input type="text" name="quotient_familial" id="quotient_familial" value="
<?php
		if (isset($donnees['quotient_familial']))
		{
			echo $donnees['quotient_familial'];
		}
		elseif (isset($_COOKIE['quotient_familial']))
		{
			echo $_COOKIE['quotient_familial'];
		}
?>
" required> 
<?php
		if (isset($_GET['erreur']) AND $_GET['erreur'] == "erreur_quotient_familial")
		{
			echo "Veuillez renseigner un nombre";
		}

?>
		<br>

		<input type="submit" name="valider" id="valider">
		</p>
	</form>

</body>
</html>
<?php

die();
}

			
                            // Test format des données
elseif (isset($_POST['genre'], $_POST['date_de_naissance'], $_POST['situation'], $_POST['mail'], $_POST['telephone'], $_POST['adresse'], $_POST['pays'], $_POST['code_postal'], $_POST['ville'], $_FILES['photo']) AND $_FILES['photo']['error'] == 0) // test si champs remplis
{
	                                           // Test format des champs
	if (preg_match('#homme|femme#', $_POST['genre'])) 
	{
		if (preg_match('#^\d{4}-\d{2}-\d{2}$#', $_POST['date_de_naissance'])) 
		{
			if (preg_match('#celibataire|marie#', $_POST['situation']))
			{
				if (preg_match('#^0[679]([. -]?\d{2}){4}$#', $_POST['telephone']))
				{
					if (preg_match("#^([a-z0-9]+[-._]?[a-z0-9]+)+@([a-z0-9]+[_-]?){2,}\.[a-z]{2,4}$#", $_POST['mail']))
						{
							if (preg_match('#^[A-Za-z \'éèäëïöüÿâêîôû-]{0,42}$#', $_POST['pays']))
								{
									if (preg_match('#^[A-Za-z\d \'éèäëïöüÿâêîôû-]+$#', $_POST['adresse']))
									{
										if (preg_match('#^[0-9]{5}$#', $_POST['code_postal']))
										{
											if (preg_match('#[A-Za-z \'éèäëïöüÿâêîôû-]{0,58}#', $_POST['ville']))
											{
																	// Ajout de la photo à la bdd
												if (isset($_FILES['photo']) AND $_FILES['photo']['size'] <=1000000)
												{													
													$info_fichier = pathinfo($_FILES['photo']['name']);
													$extension_photo = $info_fichier['extension'];
													$extensions_autorisees = array('jpg', 'jpeg');
													if (in_array($extension_photo, $extensions_autorisees))
													{
														move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/'.basename($_SESSION['id'].".".$extension_photo));
																																																																							
													                  // Empeche failles XSS
	$genre = htmlspecialchars($_POST['genre']);
	$date_de_naissance = htmlspecialchars($_POST['date_de_naissance']);  
	$situation = htmlspecialchars($_POST['situation']);
	$mail = htmlspecialchars($_POST['mail']);
	$telephone = htmlspecialchars($_POST['telephone']);
	$adresse = htmlspecialchars($_POST['adresse']); 
	$pays = htmlspecialchars($_POST['pays']);
	$code_postal = htmlspecialchars($_POST['code_postal']);
	$ville = htmlspecialchars($_POST['ville']);

                           // Création de cookies
	setcookie('genre', $genre, time() + 365*24*3600, null, null, false, true);
	setcookie('date_de_naissance', $date_de_naissance, time() + 365*24*3600, null, null, false, true);
	setcookie('situation', $situation, time() + 365*24*3600, null, null, false, true);
	setcookie('mail', $mail, time() + 365*24*3600, null, null, false, true);    // Création cookies
	setcookie('telephone', $telephone, time() + 365*24*3600, null, null, false, true);
	setcookie('adresse', $adresse, time() + 365*24*3600, null, null, false, true);
	setcookie('pays', $pays, time() + 365*24*3600, null, null, false, true);
	setcookie('code_postal', $code_postal, time() + 365*24*3600, null, null, false, true);
	setcookie('ville', $ville, time() + 365*24*3600, null, null, false, true);


                           // Insertion dans la base de données
		$req2 = $bdd->prepare('
			UPDATE users 
			SET genre = :genre, date_de_naissance = :date_de_naissance, situation= :situation, mail = :mail, telephone = :telephone, adresse = :adresse 
			WHERE id = :id ');

	$req2->execute(array(                         
		'genre' => $genre,
		'date_de_naissance' => $date_de_naissance,
		'situation' => $situation,
		'telephone' => $telephone,
		'mail' => $mail,
		'adresse' => $adresse.", ".$code_postal." ".$ville.", ".$pays,
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
                document.getElementById('block_fratrie').style.display="block";
            }
            else
            {
                document.getElementById('block_fratrie').style.display="none";
            }
        return true;
        }
</script>
</head>


<header>
	<?php include '/wamp64/www/portfolio/index/menu/menu.php' ; ?>
</header>


<body onload="aff_cach_input('non');">


	<h1>
		Formulaire d'inscription
	</h1>

	<form method="POST" action="inscription_scolarite.php" enctype="multipart/form-data">

		<p> <h2>
			Situation familiale
			</h2>
		<label for="nom père">Nom de votre père</label> <input type="text" name="nom_pere" id="nom_pere" value="<?php
		if (isset($donnees['nom_pere']))
		{
			echo $donnees['nom_pere'];
		}
		elseif (isset($_COOKIE['nom_pere']))
		{
			echo $_COOKIE['nom_pere'];
		}
?>
" required> <br>


		<label for="prenom_pere">Prénom de votre père</label> <input type="text" name="prenom_pere" id="prenom_pere" value="
<?php
		if (isset($donnees['prenom_pere']))
		{
			echo $donnees['prenom_pere'];
		}
		elseif (isset($_COOKIE['prenom_pere']))
		{
			echo $_COOKIE['prenom_pere'];
		}
?>
" required>		 <br>


		<label for="adresse_pere">Adresse de votre père</label> <input type="text" name="adresse_pere" id="adresse_pere" value="
<?php
		if (isset($_COOKIE['adresse_pere']))
		{
			echo $_COOKIE['adresse_pere'];
		}
?>
" required>	 <br>


		<label for="code_postal_pere">Code postal</label> <input type="text" name="code_postal_pere" id="code_postal_pere" value="
<?php
		if (isset($_COOKIE['code_postal_pere']))
		{
			echo $_COOKIE['code_postal_pere'];
		}
?>
"required> 		<br>


		<label for="ville_pere"> Ville</label><input type="text" name="ville_pere" id="ville_pere" value="
<?php
		if (isset($_COOKIE['ville_pere']))
		{
			echo $_COOKIE['ville_pere'];
		}
?>
" required> 	<br/>


		<label for='pays_pere'> Pays </label><input type="text" name='pays_pere' id='pays_pere' value="
<?php
		if (isset($_COOKIE['pays_pere']))
		{
			echo $_COOKIE['pays_pere'];
		}
?>
" required> 		<br />


		<label for="telephone_pere">Télephone de votre père</label><input type="tel" name="telephone_pere" id="telephone_pere" value="
<?php
		if (isset($donnees['telephone_pere']))
		{
			echo $donnees['telephone_pere'];
		}
		elseif (isset($_COOKIE['telephone_pere']))
		{
			echo $_COOKIE['telephone_pere'];
		}
?>
" required>		<br>


		<label for="nom_mere">Nom de votre mère</label> <input type="text" name="nom_mere" id="nom_mere" value="
<?php
		if (isset($donnees['nom_mere']))
		{
			echo $donnees['nom_mere'];
		}
		elseif (isset($_COOKIE['nom_mere']))
		{
			echo $_COOKIE['nom_mere'];
		}
?>
" required>		<br>


		<label for="prenom_mere">Prénom de votre mère</label> <input type="text" name="prenom_mere" id="prenom_mere" value="
<?php
		if (isset($donnees['prenom_mere']))
		{
			echo $donnees['prenom_mere'];
		}
		elseif (isset($_COOKIE['prenom_mere']))
		{
			echo $_COOKIE['prenom_mere'];
		}
?>
" required> 		<br>


		<label for="adresse_mere">Adresse de votre mère</label> <input type="text" name="adresse_mere" id="adresse_mere" value="
<?php
		if (isset($_COOKIE['adresse_mere']))
		{
			echo $_COOKIE['adresse_mere'];
		}
?>
" required> 		 <br>


		<label for="code_postal_mere">Code postal</label> <input type="text" name="code_postal_mere" id="code_postal_mere" value="
<?php

		if (isset($_COOKIE['code_postal_mere']))
		{
			echo $_COOKIE['code_postal_mere'];
		}
?>
" required> 		<br>


		<label for="ville_mere">Ville </label><input type="text" name="ville_mere" id="ville_mere" value="
<?php

		if (isset($_COOKIE['ville_mere']))
		{
			echo $_COOKIE['ville_mere'];
		}
?>
" required> 		<br/>


		<label for='pays_mere'>Pays </label><input type='text' name='pays_mere' id='pays_mere' value="
<?php

		if (isset($_COOKIE['pays_mere']))
		{
			echo $_COOKIE['pays_mere'];
		}
?>
" required> 		<br />


		<label for="telephone_mere">Télephone de votre mère</label><input type="tel" name="telephone_mere" id="telephone_mere" value="
<?php
		if (isset($donnees['telephone_mere']))
		{
			echo $donnees['telephone_mere'];
		}
		elseif (isset($_COOKIE['telephone_mere']))
		{
			echo $_COOKIE['telephone_mere'];
		}
?>
" required>		<br>


		Avez-vous des frères et soeurs ? <br>
		<label for="fratrie_oui">Oui</label> <input type="radio" name="fratrie" value="oui" id="fratrie_oui" onchange="aff_cach_input('oui')" required> 

		<label for="fratrie_non">Non</label> <input type="radio" name="fratrie" id="fratrie_non" value="non"onchange=" aff_cach_input('non')" checked required>
		<br>


		<span id="block_fratrie">
		Font-ils leur scolarité dans l'établissement ? <br>
		<label for="presence_fratrie_oui">Oui</label> <input type="radio" name="presence_fratrie" id="presence_fratrie_oui" value="oui">

		<label for="presence_fratrie_non">Non</label> <input type="radio" name="presence_fratrie" id="presence_fratrie_non" value="non" checked > 
		<br>

		</span>
		<label for="quotient_familial"> Quotient familial</label> <input type="text" name="quotient_familial" id="quotient_familial" value="
<?php
		if (isset($donnees['quotient_familial']))
		{
			echo $donnees['quotient_familial'];
		}
		elseif (isset($_COOKIE['quotient_familial']))
		{
			echo $_COOKIE['quotient_familial'];
		}
?>
" required> 		<br>

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
															$erreur_photo_extension = "Seules les photos en .jpg ou .jpeg sont acceptées";
															header('location: inscription_informations_personnelles.php?erreur_photo_extension='.$erreur_photo_extension);
															die();
														}
													}
													else
													{
														$erreur_photo_poids = "Votre photo dépasse 1 Mo";
														header('location: inscription_informations_personnelles.php?erreur_photo_poids='.$erreur_photo_poids);
														die();
													}													
												}
												else
												{
													$erreur_ville = "Veuillez rentrer un nom de ville correct";
													header('location: inscription_informations_personnelles.php?erreur_ville='.$erreur_ville);
													die();
												}
											}
											else
											{
												$erreur_code_postal = "Veuillez rentrer un code postal à 5 chiffres";
												header('location: inscription_informations_personnelles.php?erreur_code_postal='.$erreur_code_postal);
												die();
											}
										}
										else
										{
											$erreur_adresse = "Veuillez rentrer une adresse correct";
											header('location: inscription_informations_personnelles.php?erreur_adresse='.$erreur_adresse);
											die();
										}
									}
									else
									{
										$erreur_pays = "Veuillez rentrer un nom de pays correct";
										header('location: inscription_informations_personnelles.php?erreur_pays='.$erreur_pays);
										die();
									}
								}
								else
								{
									$erreur_mail = "Veuillez rentrer un mail correct";
									header('location: inscription_informations_personnelles.php?erreur_mail='.$erreur_mail);
									die();
								}
							}
							else
							{
								$erreur_telephone = "Veuillez rentrer un numéro de téléphone portable correct";
								header('location: inscription_informations_personnelles.php?erreur_telephone='.$erreur_telephone);
								die();
							}
						}
						else
						{
							$erreur_situation = "Veuillez cocher une des situation proposées";
							header('location: inscription_informations_personnelles.php?erreur_situation='.$erreur_situation);
							die();
						}		
					}
					else
					{
						$erreur_date_de_naissance = "Veuillez sélectionner une date dans le calendrier";
						header('location: inscription_informations_personnelles.php?erreur_date_de_naissance='.$erreur_date_de_naissance);	
						die();					
					}
				}
				else
				{
					$erreur_genre = "Veuillez cocher un des genre proposés";
					header('location: inscription_informations_personnelles.php?erreur_genre='.$erreur_genre);
					die();
				}	

			}
			else
			{
				$erreur_champs = "Veuillez remplir tous les champs";
				header('location: inscription_informations_personnelles.php?erreur='.$erreur_champs);
			}
		


		} 
		catch (Exception $e) 
		{
			die('Erreur : '.$e->getMEssage());		
		}


?>



<?php

	$req -> closeCursor();
	}
	else
	{
?> 
	<p>Veuillez vous authentifier en suivant ce lien : <br>
	<a href="connexion.php">Connexion</a></p> 
<?php  // Variable session n'existe pas
	}
?>