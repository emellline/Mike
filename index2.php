<?php
	header('Access-Control-Allow-Origin: *'); 
	/****START recuperation de la liste des bdd******/

			// CONNEXION BDD
			$pdo = new PDO('mysql:host=localhost;dbname=Mike', 'root', '', array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			));

			// Requete SQL
			$resultat = $pdo->prepare("SHOW DATABASES");
			$resultat->execute();

				// Tri de la requete
			$dataBase = $resultat-> fetchall(PDO::FETCH_ASSOC);

			?>
<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
	<div id="mike">
	</div>
	<div>
		<p id="message"></p>
	</div>
	<form>
	<select id="databaseSelect">
		<?php
			foreach($dataBase as $value)
				echo "<option value='" . $value['Database'] . "'>" . $value['Database'] . "</option>";
		?>
	</select>
		<fieldset>
			<legend>Requete</legend>
			<textarea name="sql" id="sql" rows="4" colls="50">SELECT * FROM utilisateurs</textarea>
			</br>
			<input type="submit" value="Envoyer"/>
		</fieldset>
	</form>
	<script>

	$(function() { // document ready en Jquery
				$( "input" ).click(function(e) { // evt Jquery qui se declenche au clic d'une balise"input"
					// la variable e stocke l'evenement

					// Annulation de l'actualisation de la page'
					e.preventDefault();


					// Console du meillieur Prenom au monde. PS: Mike > Vincent
					console.log("Mike");
					
					// Récuperation de la valeur de notre textarea.
					var myRequest = $("#sql").val(); 

					var dataBase = $("#databaseSelect").val();

					// Requete Ajax - Envoi des informations du formulaire vers une autre page de traitement.
					var request = $.ajax({// json se reconnait avec l'accolade et les deux points
						url: "read2.php", // Page de la requete
						method: "POST", // Methode de la requete
						data: {requet : myRequest, Mike: dataBase} // Data envoyer à la page
					});
					
					request.done(function( msg ) { // Success


						console.log(msg);
						// Affichage ds la console avt la conversion en un object - msg est une cdc
						msg = JSON.parse(msg); 
						// Conversion Json en object js
						console.info(msg);// Affichage ds la console avt la conversion en un object js

						if(msg.erreur == false) {

							$( "#mike" ).html( msg.message ); // mise à jour du contenu de la div qui a pour id "Mike"
							$( "#requet" ).html( myRequest ); // mise à jour  du contenu de la span qui a pour id requet généré dans le tableau envoyé par le php

							$("#message").text("Voici les résultats de votre requete");
							$("#message").css("background-color", "green");
						} 

						else {
							$("#message").text(msg.message);
							$("#message").css("background-color", "red");

						}
					});
					
					request.fail(function( jqXHR, textStatus ) {
						alert( "Request failed: " + textStatus );
					});
				});
			});
	// 	var request = $.ajax({
	//   url: "read.php",
	//   method: "POST"
	// });
	 
	// request.done(function( msg ) {
	//   $( "#mike" ).html( msg );
	// });
	 
	// request.fail(function( jqXHR, textStatus ) {
	//   alert( "Request failed: " + textStatus );
	// });

	</script>
	</div>
	</body>
</html>
