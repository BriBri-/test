<?php
//including the database connection file
include("include/initialization.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$query = $connexion->prepare("DELETE FROM user WHERE id=$id");
$query->execute();
$users = $query->fetchAll();

//redirecting to the display page (index.php in our case)
header("Location:list.php");
?>

