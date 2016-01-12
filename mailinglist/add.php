<html>
<head>
	<title>Ajouter des données</title>
</head>

<body>
<?php
//including the database connection file
include_once("include/initialization.php");

function is_valid_email($mail){
	return filter_var($mail, FILTER_VALIDATE_EMAIL);
};


if(isset($_POST['Submit'])) {	
	
	$mail = $_POST['mail'];
		
	// checking empty fields
	if(empty($mail)) {
				
			echo "<font color='red'>Le champ mail est vide</font><br/>";
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Retour</a>";

	}else if( is_valid_email($mail) == false){
		
		echo"<font color='red'>Votre mail n'est pas valide</font><br/>";
		echo "<br/><a href='javascript:self.history.back();'>Retour</a>";
	
	}else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$query = $connexion->prepare("INSERT INTO user(mail) VALUES('$mail')");
		$query->execute();
		$users = $query->fetchAll();
		
		//display success message
		echo "<font color='green'>Mail ajouté à la base de données";
		echo "<br/><a href='list.php'>Voir les résultats</a>";
	}
}
?>
</body>
</html>
