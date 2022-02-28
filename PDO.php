<?php
	try
	{
		$bdd=new PDO('mysql:local=localhost; dbname=ecole; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION))
	}

	catch (Exception $e)
	{
		die('Erreur :'.$e -> getMEssage());
	}

?>