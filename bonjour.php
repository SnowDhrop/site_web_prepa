<!DOCTYPE>

<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>bonjour</title>
</head>
<body>
	<?php

	for ($i=0; $i < $_POST['repetition']; $i++) { 
	 	echo "Bonjour" . " " . $_POST['nom'] . " " . $_POST['prenom'] . '<br/>' ;
	 } 

?>
</body>
</html>

