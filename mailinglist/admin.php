<?php
error_reporting(E_ALL & ~E_NOTICE);

include_once('include/initialization.php');

if($admin = getConnectedAdmin($connexion)){
	redirectTo('list.php');
}

$errors = array();
$login = trim(strip_tags($_POST['login']));
$password = trim(strip_tags($_POST['password']));


if(!empty($_POST)){
	if(empty($login)){
		$errors['login'] = 'Le login est obligatoire';
	}
	if(empty($password)){
		$errors['password'] = 'Le password est obligatoire';
	}


	if(empty($errors)){
		$sql = 'SELECT * FROM admin WHERE login = :login';
		$preparedStatement = $connexion->prepare($sql);
		$preparedStatement->bindValue(':login', $_POST['login']);
		$preparedStatement->execute();
		$admin = $preparedStatement->fetch();
		if(!empty($admin)
		&& ($_POST['password'] == $admin['password'])){
			$_SESSION['admin_secret'] = $admin['secret'];
			redirectTo('list.php');
		}
	}
}
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
 
		<meta charset="UTF-8">
		<title>Login</title>
</head>
<body>
	<section>
    <header>
  	   <h1>Connexion Admin</h1>
  	</header>

  	<div>

			<?php foreach($errors as $error): ?>
				<div><?php echo $error; ?></div>
			<?php endforeach; ?>

		  <form method="post">
		   	<fieldset>
		      <label>Utilisateur</label>
		      <input type="text" name="login" />
		    </fieldset>

		    <fieldset>
		      <label>Mot de passe</label>
		      <input type="text" name="password" />
		    </fieldset>
		      <input type="submit" class="button" name="envoyer" />

		  </form>
		</div>
	</section>
</body>
</html>
