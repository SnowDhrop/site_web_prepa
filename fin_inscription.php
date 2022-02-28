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
			die('Erreur : ' . $e->getMessage());
		}


		
		if (isset($_POST['dernier_lycee'], $_POST['regime'], $_POST['choix_bourse'], $_POST['option_lycee'], $_POST['mention'], $_POST['langue_lv1'], $_POST['langue_lv2'], $_POST['niveau_bourse']))
		{

			if (preg_match('#^[A-Za-z\d \'éèäëïöüÿâêîôû-]+$#', $_POST['dernier_lycee']))
			{
				if (preg_match('#demi_pensionnaire|externe|interne#', $_POST['regime']))
				{
					if (preg_match('#oui|non#', $_POST['choix_bourse']))
					{
						if (preg_match('#mathematiques|svt|pc|informatique|sciences_ingenieur#', $_POST['option_lycee']))
						{
							if (preg_match('#no_mention|bien|assez_bien|tres_bien|felicitations_jury#', $_POST['mention']))
							{
								if (preg_match('#francais|anglais|italien|allemand|espagnol|russe|chinois#', $_POST['langue_lv1']))
								{
									if (preg_match('#anglais|italien|allemand|espagnol|russe|chinois#', $_POST['langue_lv2']))
									{
										if (preg_match('#pas_de_bourse|0_bis|[1-7]#', $_POST['niveau_bourse']))
										{






$dernier_lycee=htmlspecialchars($_POST['dernier_lycee']);
$regime=htmlspecialchars($_POST['regime']);
$choix_bourse=htmlspecialchars($_POST['choix_bourse']);
$option_lycee=htmlspecialchars($_POST['option_lycee']);
$mention=htmlspecialchars($_POST['mention']);
$langue_lv1=htmlspecialchars($_POST['langue_lv1']);
$langue_lv2=htmlspecialchars($_POST['langue_lv2']);
$niveau_bourse=htmlspecialchars($_POST['niveau_bourse']);


setcookie('dernier_lycee', $dernier_lycee, time()+365*24*3600, null, null, false, true);
setcookie('regime', $regime, time() +365*24*3600, null, null, false, true);
setcookie('option_lycee', $option_lycee, time()+365*24*3600, null, null, false, true);
setcookie('mention', $mention, time()+365*24*3600, null, null, false, true);
setcookie('langue_lv1', $langue_lv1, time()+365*24*3600, null, null, false, true);
setcookie('langue_lv2', $langue_lv2, time()+365*24*3600, null, null, false, true);

$req = $bdd -> prepare('
	UPDATE scolarite
	SET dernier_lycee = :dernier_lycee, regime = :regime, bourse = :choix_bourse, option_lycee = :option_lycee, mention = :mention, langue_lv1 = :langue_lv1, langue_lv2 = :langue_lv2, niveau_bourse = :niveau_bourse
	WHERE users_id = :id ');
$req -> execute(array(
'dernier_lycee' => $dernier_lycee,
'regime' => $regime,
'choix_bourse'=> $choix_bourse,
'option_lycee'=>$option_lycee,
'mention'=>$mention,
'langue_lv1'=>$langue_lv1,
'langue_lv2'=>$langue_lv2,
'niveau_bourse'=>$niveau_bourse,
'id'=>$_SESSION['id']
));

$req -> closeCursor();

?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Bienvenue !</title>
	</head>

<header>
	<?php include '/wamp64/www/portfolio/index/menu/menu.php' ; ?>
</header>


	<body>
		<h1>Félicitations !</h1>

		<p> Vous êtes maintenant inscrits à l'école. <br>
			Si vous êtes candidat pour l'internat, vous pouvez consulter votre classement mis à jour automatiquement dans le tableau ci-dessous.
		</p>
	</body>
	</html>

<?php
										}
										else
										{
											header('location: inscription_scolarite.php?erreur='."erreur_niveau_bourse");
										}
									}
									else
									{
										header('location: inscription_scolarite.php?erreur='."erreur_lv2");
										die();
									}
								}
								else
								{
									header('location: inscription_scolarite.ph?erreur='."erreur_lv1");
									die();
								}
							}
							else
							{
								header('location: inscription_scolarite.php?erreur='."erreur_mention");
								die();
							}
						}
						else
						{
							header('location: inscription_scolarite.php?erreur='."erreur_option");
							die();
						}
					}
					else
					{
						$erreur_bourse = 'Veuillez choisir une réponse';
						header('location: inscription_scolarite.php?erreur='."erreur_bourse");
						die();
					}
				}
				else
				{
					$erreur_regime = "Veuillez choisir un régime";
					header('location: inscription_scolarite.php?erreur='."erreur_regime");
					die();
				}
			}				
			else
			{
				$erreur_lycee = "Mettez le dernier lycée dans lequel vous étiez";
				header('location: inscription_scolarite.php?erreur='."erreur_lycee");
				die();
			}
		}
		else
		{
			header('location: inscription_scolarite.php?erreur='."erreur_champs");
			die();
		}

}
else
{
	echo "Veuillez vous connecter en cliquant sur le lien suivant";
		?> <a href="connexion.php">Connexion</a><?php
}
?>


