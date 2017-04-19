<?php

header("Access-Control-Allow-Origin: *");

// CONNEXION BDD
$pdo = new PDO('mysql:host=localhost;dbname=mike', 'root', '', array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

	$resultat = $pdo -> prepare("SELECT * FROM utilisateurs");
	$resultat -> execute();

	$utilisateur = $resultat -> fetch(PDO::FETCH_ASSOC);

	$tableau .= "<table><tr>";

	foreach ($utilisateurs[0] as $key => $value) {
		$tableau .= '<th>' .$key. "</th>";
	}

	$tableau .="</tr>";

	foreach ($utilisateurs as $key => $value){
		$tableau .= "<tr>";
		foreach ($utilisateurs[$key] as $key => $value) {
			$tableau .= "<td>". $value. "</td>";
			
		}

		$tableau .= "</tr>";
	}

		echo $tableau;
	
	//$tableau = 
	/*"<table>
		<tr>
			<th><Id></th>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Poste</th>
			<th>Date create</th>
		</tr>";*/

	/*for ($i = 0; $i < count($utilisateurs); $i++) {
		echo '<th>' . key($utilisateur[0][$i]) . "</th>";
	}

	$tableau .="</tr>"
	

	while ($utilisateur = $utilisateurs) {
		$tableau .= "<tr>";
		$tableau .= "<td>".$utilisateur["id"]. "</td>";
		$tableau .= "<td>".$utilisateur["nom"]. "</td>";
		$tableau .= "<td>".$utilisateur["prenom"]. "</td>";
		$tableau .= "<td>".$utilisateur["poste"]. "</td>";
		$tableau .= "<td>".$utilisateur["date_create"]. "</td>";
		$tableau .= "</tr>";
	}
*/
	
	"</table>";
	
	
	// je veux récupérer les données sous forme de tableau avec un echo de $tableau
	/*$resultat -> execute();
	$utilisateurs = $resultat -> fetchAll();*/
	//sleep(20);
	//var_dump($utilisateur);

?>