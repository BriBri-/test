<?php
// including the database connection file
include_once("include/initialization.php");

function is_valid_email($mail){
	return filter_var($mail, FILTER_VALIDATE_EMAIL);
};

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$mail=$_POST['mail'];	
	
	// checking empty fields
	if(empty($mail)) {	
			
		
			echo "<font color='red'>Le champ mail est vide.</font><br/>";
				
	}else if( is_valid_email($mail) == false){
		
		echo"<font color='red'>Votre mail n'est pas valide</font><br/>";
		
	
	}else {	
		//updating the table
		$query = $connexion->prepare("UPDATE user SET mail='$mail' WHERE id=$id");
		$query->execute();
		$users = $query->fetchAll();
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: list.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$query = $connexion->prepare("SELECT * FROM user WHERE id=$id");
$query->execute();
$users = $query->fetchAll();

foreach ($users as $user ) 
{
	$mail = $user['mail'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="list.php">Retour</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			
			<tr> 
				<td>Mail</td>
				<td><input type="text" name="mail" value=<?php echo $mail;?>></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Modifier"></td>
			</tr>
		</table>
	</form>
</body>
</html>
