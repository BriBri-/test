<?php
error_reporting(E_ALL & ~E_NOTICE);

include_once('include/initialization.php');


function is_valid_email($mail){
	return filter_var($mail, FILTER_VALIDATE_EMAIL);
};


$mail = trim(strip_tags($_POST['mail']));
$errors = array();
if(!empty($_POST)){
	if(empty($_POST['mail'])){
		$errors['mail'] = "Une adresse mail est obligatoire pour s'abonner. ";
	}

	else if( is_valid_email($mail) == false){
		echo('Votre email n\'est pas valide');
	}

	else if(mailExists($connexion, $_POST['mail'])){
		$errors['mail'] = 'Cette adresse mail est déjà abonnée à la newsletter';
	}

	else if(empty($errors)){
		$sql = 'INSERT INTO user(mail)
		VALUES(:mail)';
		$preparedStatement = $connexion->prepare($sql);
		$preparedStatement->bindValue('mail', htmlentities($_POST['mail']));

		if($preparedStatement->execute()){
			$_SESSION['user_secret'] = $secret;
			echo('Vous avez bien été ajouté à la liste.');
		}
	}
}
?>


<!doctype html>
<html lang="fr">
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

		<title>Inscription à la newsletter</title>
</head>
<body>
    <header>
  	   <h1>Inscription à la newsletter</h1>
  	</header>

  	<section>

			<?php foreach($errors as $error): ?>
				<div class="alert error"><?php echo $error; ?></div>
			<?php endforeach; ?>

		  <form method="post">
		    <fieldset>
		      <label>Votre mail:</label>
		      <input type="text" name="mail" />
		    </fieldset>
		     <input type="submit" class="button" name="envoyer" />
		  </form>
	</section>
</body>
</html>
