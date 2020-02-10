<?php
  require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>MFC - Authentification</title>
	<?php
		include('./head.php');

		if (isset($_POST['sendConnection'])) {
			if (isset($_POST['emailOrUsername']) AND !empty($_POST['emailOrUsername']) AND 
					isset($_POST['password']) AND !empty($_POST['password'])) {

				$sql_user = "SELECT * FROM users WHERE (email = '".$_POST['emailOrUsername']."' OR username = '".$_POST['emailOrUsername']."') AND password = '".$_POST['password']."'";
				$result_user = mysqli_query($GLOBALS['conn'], $sql_user);

				if ($row_user = mysqli_fetch_array($result_user)) {
					$_SESSION['id'] = $row_user['id'];
					$_SESSION['email'] = $row_user['email'];
					$_SESSION['username'] = $row_user['username'];

					if ($row_user['status'] === '0') {
						$_SESSION['status'] = 'admin';
					} else if ($row_user['status'] === '1') {
						$_SESSION['status'] = 'student';
					} else if ($row_user['status'] === '2') {
						$_SESSION['status'] = 'former';
					}

					header("Location: ./");

				} else {
					$emailAndUsernameMatchRequired = "true";

				}

			} else {
				if (!isset($_POST['emailOrUsername']) OR empty($_POST['emailOrUsername'])) {
					$emailOrUsernameRequired = "true";

				}
				if (!isset($_POST['password']) Or empty($_POST['password'])) {
					$passwordRequired = "true";

				}
			}
		}
	?> 
</head>
<body class="text-center">
	<?php
		include('./header.php');
		if (!$session_bool) {
	?>
	<div class="content-block connection">
		<div class="content-header">
				<img src="./img/logo.svg" alt="" width="72" height="72">
				<span class="content-title">Connexion</span>
		</div>
		<div class="content-body">
			<form class="form-signin connection" method="POST" action="connection">
				<div class="form-group">
					<label for="emailOrUsername" class="required">Adresse e-mail ou Nom d'utilisateur</label>
					<input type="text" id="emailOrUsername" class="form-control <?php if (isset($_POST['sendConnection'])) { $valid = ((isset($emailOrUsernameRequired) AND $emailOrUsernameRequired === 'true') OR (isset($emailAndUsernameMatchRequired) AND $emailAndUsernameMatchRequired === 'true')) ? 'is-invalid' : 'is-valid'; echo $valid; } ?>" placeholder="nom.prenom@domaine.com" name="emailOrUsername" value="<?php if (isset($_POST['emailOrUsername']) AND !empty($_POST['emailOrUsername'])) { echo $_POST['emailOrUsername']; } ?>">
					<?php
							if (isset($emailOrUsernameRequired) AND $emailOrUsernameRequired === "true") {
								echo "<span class='error'>L'adresse email ou le nom d'utilisateur est obligatoire.</span>";

							} else if (isset($emailAndUsernameMatchRequired) AND $emailAndUsernameMatchRequired === "true") {
								echo "<span class='error'>Adresse email incorrecte pour ce mot de passe.</span>";

							}
					?>
				</div>
				<div class="form-group">
					<label for="password" class="required">Mot de passe</label>
					<input type="password" id="password" class="form-control <?php if (isset($_POST['sendConnection'])) { $valid = ((isset($passwordRequired) AND $passwordRequired === 'true') OR (isset($emailAndUsernameMatchRequired) AND $emailAndUsernameMatchRequired === 'true')) ? 'is-invalid' : 'is-valid'; echo $valid; } ?>" placeholder="Mot De Passe" name="password" value="<?php $password = (isset($_POST['password'])) ? $_POST['password'] : ''; echo $password ?>">
					<?php
							if (isset($passwordRequired) AND $passwordRequired === "true") {
								echo "<span class='error'>Le mot de passe est obligatoire.</span>";

							} else if (isset($emailAndUsernameMatchRequired) AND $emailAndUsernameMatchRequired === "true") {
								echo "<span class='error'>Mot de passe incorrect pour cette adresse email.</span>";

							}
					?>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="sendConnection">Se connecter</button>
				<div class="mt-2 mb-3">
			    <label>
			      Vous n'avez pas de compte ? <a href="./inscription">Inscrivez-vous !</a>
			    </label>
				</div>
			</form>
		</div>
	</div>
	<?php
		} else {
			header("Location: ./");

		}
	?>
</body>
</html>