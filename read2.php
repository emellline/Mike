<?php
	header('Access-Control-Allow-Origin: *'); 

	if(isset($_POST["requet"]) && isset($_POST["Mike"])){

		if(!empty($_POST["requet"]) && !empty($_POST["Mike"])) {

			// CONNEXION BDD
			$pdo = new PDO('mysql:host=localhost;dbname='.$_POST["Mike"], 'root', '', array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			));

			// Requete SQL
			$resultat = $pdo->prepare($_POST["requet"]);
			$resultat->execute();

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
			foreach ($resultat->fetch(PDO::FETCH_ASSOC) as $key => $value){
				$tableau .= '<th>'.$key.'</th>';
			}


			// Trie de la requete
			$utilisateurs = $resultat->fetchall(PDO::FETCH_ASSOC);

			$tableau .= "</tr>";

			// Boucle pour parcourir chaque ligne de notre bdd
			foreach ($utilisateurs as $key => $value){
				$tableau .= "<tr>";
				// Boucle chaque colone de nos lignes
				foreach ($utilisateurs[$key] as $key => $value){
					$tableau .= "<td>".$value."</td>";
				}
				$tableau .= "</tr>";
			}

			$tableau .= "</div></div>";

			echo $tableau;
		}
	}