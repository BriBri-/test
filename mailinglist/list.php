<?php
include_once('include/initialization.php');
		$query = $connexion->prepare('SELECT * FROM user' );
		$query->execute();
		$users = $query->fetchAll();
		
?>


<!doctype html>
<htmllang="fr">
<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<meta charset="UTF-8">
		<title>Index</title>
</head>
<body>
	<section>
  	   <h1>Gestion des abonnés de la newsletter</h1>

  	   <a href="add.html">Ajouter des nouvelles données</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Email</td>
		<td>Modifier</td>
	</tr>
  	   <?php
  	   	foreach ($users as $user ) {

			echo "<tr>";
			echo "<td>".($user["mail"])."</td>";	
			echo "<td><a href=\"edit.php?id=$user[id]\">Modifier</a> | <a href=\"delete.php?id=$user[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Supprimer</a></td>";
		  }
  	   ?>
  	</table>
		

       <a href="logout.php" class="">Se déconnecter</a>
  	</section>
</body>
</html>