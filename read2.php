<?php
// les requetes http de type cross site st des requetes pour des ressources localisées
// sur un domaine different de celui à l'origine de la requete (cf https://developer.mozilla.org/fr/docs/HTTP/Access_control_CORS').

	header('Access-Control-Allow-Origin: *'); 

	$retour = array("erreur => true");// initialisation de la varialbe de retour

	//verification de l'existence de nos POST
	if(isset($_POST["requet"]) && isset($_POST["Mike"])){

		//verification du contenu de nos POST
		if(!empty($_POST["requet"]) && !empty($_POST["Mike"])) {

			// CONNEXION BDD
			$pdo = new PDO('mysql:host=localhost;dbname='.$_POST["Mike"], 'root', '', array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			));

			// Requete SQL nvoyé oar notre user :
			$resultat = $pdo->prepare($_POST["requet"]);
			

			if ($resultat->execute()){


			// Trie de la requete
			$utilisateurs = $resultat->fetchall(PDO::FETCH_ASSOC);
				// Creation de la variable tableau
	$tableau = 

	"<div>
		<div>
			<p>Requet : <span id='requet'></span></p>
			<p>Nombre de lignes <span id='lignes'>" .$resultat->RowCount() ."</span></p)>
		</div>
	</div>
		<table>
			<tr>";

			// Meme syntaxe. Tri du PREMIER ET SEUL element.
			foreach ($utilisateurs[0] as $key => $value){
				$tableau .= '<th>'.$key.'</th>';
			}



			$tableau .= "</tr>";

			// Boucle pour parcourir chaque ligne de notre bdd
			foreach ($utilisateurs as $key => $value){
				$tableau .= "<tr>";
				// Boucle chaque colonne de nos lignes
				foreach ($utilisateurs[$key] as $key => $value){
					$tableau .= "<td>".$value."</td>";
				}
				$tableau .= "</tr>";
			}

			$tableau .= "</div></div>";

			$retour["erreur"] = false;
			$retour["message"] = $tableau;

	}

	else {
		$retour["message"] = $pdo -> errorInfo()[2];
	}
		} 

		else {

			$retour["message"] = "Parametre vide!"; // gestion erreur if !empty variable POST

		}
	}

	else {

		$retour["message"] = "Parametre manquant !"; // gestion erreur if isset variable POST
	}

	echo json_encode($retour);