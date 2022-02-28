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
                document.getElementById('block_fratrie').style.display="block";
            }
            else
            {
                document.getElementById('block_bourse').style.display="none"; //Si non, on le cache
                document.getElementById('block_fratrie').style.display="none";
            }
        return true;
        }
</script>

</head>
<body onload="aff_cach_input('non');">

	<strong> Bienvenue ! Plus que quelques informations à remplir pour intégrer notre prestigieuse école. </strong>

	<h1>
		Formulaire d'inscription
	</h1>

	<form method="POST" action="validation_inscription.php" enctype="multipart/form-data">
	<p> <h2> 
				Informations personnelles
		</h2>
		Vous êtes <br><label for="genre_male">Un homme</label><input type="radio" name="genre" id="genre_male" value="male" required> <label>Une femme</label> <input type="radio" name="genre" id="genre_fem" value="male" required> <br>
		<label for="nom"> Nom </label><input type="text" name="nom" id="nom" required="nom" placeholder="Votre nom" required> <br>
		<label for="prenom"> Prénom</label><input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required> <br>
		Situation <label for="situation_celibataire">Célibataire</label><input type="radio" name="situation" id="situation_celibataire" value="celibataire" required> <label for="situation_marie">Marié</label> <input type="radio" name="situation" id="situation_marie" value="marie" required> <br>
		<label for="telephone">N° de téléphone</label> <input type="tel" name="telephone" id="telephone" required> <br>
		<label for="mail"> Adresse mail </label> <input type="email" name="mail" id="mail" placeholder="Votre adresse mail" required> <br>
		<label for="mdp">Mot de passe</label> <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" required> <br>
		<label for="mdp_confirmation">Confirmez votre mot de passe</label><input type="password" name="mdp_confirmation" id="mdp" required> <br>
		<label for="date_de_naissance">Date de naissance</label> <input type="date" value="2008-01-01" name="date_de_naissance" id="date_de_naissance" min="1991-01-01" max="2011-01-01" required> <br>
		<label for="adresse">Adresse</label><textarea name="adresse" id="adresse" placeholder="Votre adresse" rows="5" required></textarea> <br>
		<label for="code_postal">Code postal</label> <input type="text" name="code_postal" id="adresse" required> <br>
	</p>
		

		<p> <h2>
			Situation familiale
			</h2>
		<label for="pays">Pays</label><input type="text" name="pays" id="pays" placeholder="France" required><br>
		Avez-vous des frères et soeurs ? <br>
		<label for="fratrie_oui">Oui</label> <input type="radio" name="fratrie" value="oui" id="fratrie_oui" onchange="aff_cach_input('oui')" required> 
		<label for="fratrie_non">Non</label> <input type="radio" name="fratrie" id="fratrie_non" value="non"onchange=" aff_cach_input('non')" required><br>
		<span id="block_fratrie">
		Font-ils leur scolarité dans l'établissement ? <br>
		<label for="presence_fratrie_oui">Oui</label> <input type="radio" name="presence_fratrie" id="presence_fratrie_oui" value="oui" required>
		<label for="presence_fratrie_non">Non</label> <input type="radio" name="presence_fratrie" id="presence_fratrie_non" value="non" required>
		</span>
		<label for="quotient_familial"> Quotient familial</label> <input type="text" name="quotient_familial" id="quotient_familial" required> <br>
		<label for="dernier_lycée"> Dernier lycée fréquenté </label> <input type="text" name="dernier_lycee" id="dernier_lycee" required> <br>
		<label for="nom père">Nom de votre père</label> <input type="text" name="nom_pere" id="nom_pere" required><br>
		<label for="prenom_pere">Prénom de votre père</label> <input type="text" name="prenom_pere" id="prenom_pere" required> <br>
		<label for="adresse_pere">Adresse de votre père</label> <input type="text" name="adresse_pere" id="adresse_pere" required> <br>
		<label for="code_postal_pere">Code postal</label> <input type="text" name="code_postal_pere" id="code_postal_pere" required> <br>
		<label for="telephone_pere">Télephone de votre père</label><input type="tel" name="telephone_pere" id="telephone_pere" required><br>
		<label for="nom_mere">Nom de votre mère</label> <input type="text" name="nom_mere" id="nom_mere" required><br>
		<label for="prenom_mere">Prénom de votre mère</label> <input type="text" name="prenom_mere" id="prenom_mere" required> <br>
		<label for="adresse_mere">Adresse de votre mère</label> <input type="text" name="adresse_mere" id="adresse_mere" required> <br>
		<label for="code_postal_mere">Code postal</label> <input type="text" name="code_postal_mere" id="code_postal_mere" required> <br>
		<label for="telephone_mere">Télephone de votre mère</label><input type="tel" name="telephone_mere" id="telephone_mere" required><br>
		</p>

		

		<p> <h2>
				Scolarité
			</h2>
		<label for="dernier_lycee">Dernier lycée</label><input type="text" name="dernier_lycee" id="dernier_lycee" required><br>
		<label for="regime">Choisissez votre régime</label>
		<select name="regime" id="regime" required>
			<option value="demi-pensionnaire" selected>Demi-pensionnaire</option>
			<option value="externe">Externe</option>
			<option value="interne">Interne</option>
		</select> <br>

		Pouvez vous bénéficier de la bourse ?<br> 
		<label for="bourse_oui">Oui</label> <input type="radio" name="choix_bourse" id="bourse_oui" value="oui" onchange="aff_cach_input('oui')" required> 
		<label for="bourse_non">Non</label><input type="radio" name="choix_bourse" id="bourse_non" value="non" onchange="aff_cach_input('non')" required> <br>
		
		<span id="block_bourse"><label for="niveau_bourse" >Quel niveau de bourse avez-vous ?</label> 
		<select name="niveau_bourse" id="niveau_bourse" required>
			<option value="0_bis">0 bis</option>
			<option value="1">1</option>
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
			<option value="francais">Français</option>
			<option value="anglais">Anglais</option>
			<option value="allemand">Allemand</option>
			<option value="espagnol">Espagnol</option>
			<option value="italien">Italien</option>
			<option value="chinois">Chinois</option>
			<option value="russe">Russe</option>
		</select><br>
		<label for="photo">Insérez une photo de vous au format .jpeg ou .jpg <br>
		</label><input type="file" name="photo" id="photo" required> <br>

		<input type="submit" name="valider" id="valider">
		</p>
	</form>


</body>
</html>