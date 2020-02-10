<?php
  require_once("./db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>MFC - Formations</title>
	<?php
		include('./head.php');

		function selectName($name) {
			$sql_name = "SELECT * FROM users WHERE ".$name." = '".$_POST[$name]."'";
			$result_name = mysqli_query($GLOBALS['conn'], $sql_name);
			$array_name = mysqli_fetch_array($result_name);

			if (!empty($array_name)) {
				if ($name === "email") {
					return "true";

				} else if ($name === "username") {
					return "true";
					
				}
			}
			return "false";
		}

		if (isset($_POST['sendInscription'])) {
			$emailAlreadyUsed = selectName("email");
			$usernameAlreadyUsed = selectName("username");

			if (isset($_POST['username']) AND !empty($_POST['username'])) {
				if (strlen($_POST['username']) >= 4 AND  strlen($_POST['username']) <= 16) {
					$usernameNotValid = "false";

				} else {
					$usernameNotValid = "true";

				}
			} else {
				$usernameRequired = "true";

			}
			if (isset($_POST['password']) AND !empty($_POST['password'])) {
				if (strlen($_POST['password']) >= 4 AND strlen($_POST['password']) <= 16) {
					$passwordNotValid = "false";

				} else {
					$passwordNotValid = "true";

				}
			} else {
				$passwordRequired = "true";

			}

			if (isset($_POST['status']) AND !empty($_POST['status']) AND
					isset($_POST['email']) AND !empty($_POST['email']) AND 
					isset($usernameNotValid) AND $usernameNotValid === "false" AND 
					isset($passwordNotValid) AND $passwordNotValid === "false" AND 
					isset($_POST['passwordConfirm']) AND !empty($_POST['passwordConfirm']) AND
					$_POST['passwordConfirm'] === $_POST['password']) {

				if ((isset($emailAlreadyUsed) AND $emailAlreadyUsed === "false") AND (isset($usernameAlreadyUsed)) AND $usernameAlreadyUsed === "false") {
					$status = ($_POST['status'] === "student") ? "1" : "2";

					$column_names = "id, username, password, email, status";
					$column_values = "NULL, '".$_POST['username']."', '".$_POST['password']."', '".$_POST['email']."', '".$status."'";

					if (isset($_POST['address']) AND !empty($_POST['address'])) {
						$column_names .= ", address";
						$column_values .= ", '".$_POST['address']."'";

					}
					if (isset($_POST['city']) AND !empty($_POST['city'])) {
						$column_names .= ", city";
						$column_values .= ", '".$_POST['city']."'";

					}
					if (isset($_POST['zip']) AND !empty($_POST['zip'])) {
						$column_names .= ", zip";
						$column_values .= ", '".$_POST['zip']."'";

					}

					$sql_inscription = "INSERT INTO users (".$column_names.") VALUES (".$column_values.")";
					mysqli_query($GLOBALS['conn'], $sql_inscription);

					header("Location: connection");
				}
			} else {
			 	if (!isset($_POST['status']) OR empty($_POST['status'])) {
					$statusRequired = "true";

				}
				if (!isset($_POST['email']) OR empty($_POST['email'])) {
					$emailRequired = "true";

				}
				if (!isset($_POST['passwordConfirm']) OR empty($_POST['passwordConfirm'])) {
					$passwordConfirmRequired = "true";

				}
				if ($_POST['passwordConfirm'] !== $_POST['password']){
					$passwordMatchRequired = "true";

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
	<div class="content-block inscription">
		<div class="content-header">
			<img src="./img/logo.svg" alt="" width="72" height="72">
			<span class="content-title">Inscription</span>
		</div>
		<div class="content-body">
			<form class="form-signin" method="POST" action="inscription">
				<div class="form-errors">
				<?php
						if (isset($passwordMatchRequired) AND $passwordMatchRequired === "true") {
							echo "<div class='mt-1'><span class='text-danger'>Les deux mots de passe doivent être identiques.</span></div>";

						}
				?>
				</div>
		  	<div class="buttons-student-former <?php if (isset($_POST['sendInscription'])) { $valid = (isset($statusRequired) AND $statusRequired === 'true') ? 'is-invalid' : 'is-valid'; echo $valid; } ?>">
			  	<div>
				  	<label class="required">Sélectionnez votre statut</label>
				  </div>
			  	<div class="row">
				    <div class="col-md-8 offset-md-2 btn-group btn-group-toggle row" data-toggle="buttons">
					    <label class="btn btn-purple col-md-6">
					      <input type="radio" class="form-control" name="status" value="student" id="student" <?php $status = (isset($_POST['status']) AND ($_POST['status'] === 'student')) ? 'checked' : ''; echo $status ?>> Étudiant
					    </label>
					    <label class="btn btn-purple col-md-6">
					      <input type="radio" name="status" value="former" id="former" <?php $status = (isset($_POST['status']) AND ($_POST['status'] === 'former')) ? 'checked' : ''; echo $status ?>> Formateur
					    </label>
				    </div>
				    <div class="col-md-2 status-valid">
				    </div>
			  	</div>
				    <?php
				    	if (isset($statusRequired) AND $statusRequired === "true") {
				    		echo "<span class='error'>Le statut est obligatoire.</span>";

				    	}
				    ?>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-7">
			      <label for="email" class="required">Renseignez votre email</label>
			      <input type="email" class="form-control <?php if (isset($_POST['sendInscription'])) { $valid = ((isset($emailRequired) AND $emailRequired === 'true') OR (isset($emailAlreadyUsed) AND $emailAlreadyUsed === 'true')) ? 'is-invalid' : 'is-valid'; echo $valid; } ?>" id="email" name="email" placeholder="Email" value="<?php $email = (isset($_POST['email'])) ? $_POST['email'] : ''; echo $email ?>">
				    <?php
				    	if (isset($emailRequired) AND $emailRequired === "true") {
				    		echo "<span class='error'>L'adresse email est obligatoire.</span>";

				    	} else if (isset($emailAlreadyUsed) AND $emailAlreadyUsed === "true") {
								echo "<span class='error'>Cette adresse email est déjà utilisée.</span>";

				    	}
				    ?>
			    </div>
			    <div class="form-group col-md-5">
			      <label for="username" class="required">Choisissez un nom d'utilisateur</label>
			      <input type="text" class="form-control <?php if (isset($_POST['sendInscription'])) { $valid = ((isset($usernameRequired) AND $usernameRequired === 'true') OR (isset($usernameNotValid) AND $usernameNotValid === 'true') OR (isset($usernameAlreadyUsed) AND $usernameAlreadyUsed === 'true')) ? 'is-invalid' : 'is-valid'; echo $valid; } ?>" id="username" name="username" placeholder="Nom d'utilisateur" value="<?php $username = (isset($_POST['username'])) ? $_POST['username'] : ''; echo $username ?>">
				    <?php
				    	if (isset($usernameRequired) AND $usernameRequired === "true") {
				    		echo "<span class='error'>Le nom d'utilisateur est obligatoire.</span>";

				    	} else if (isset($usernameNotValid) AND $usernameNotValid === "true") {
								echo "<span class='error'>Le nom d'utilisateur doit être compris entre 4 et 16 caractères.</span>";

				    	} else if (isset($usernameAlreadyUsed) AND $usernameAlreadyUsed === "true") {
								echo "<span class='error'>Ce nom d'utilisateur est déjà utilisé.</span>";

				    	}
				    ?>
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="password" class="required">Créez votre mot de passe</label>
			      <input type="password" class="form-control <?php if (isset($_POST['sendInscription'])) { $valid = ((isset($passwordRequired) AND $passwordRequired === 'true') OR (isset($passwordNotValid) AND $passwordNotValid === 'true')) ? 'is-invalid' : 'is-valid'; echo $valid; } ?>" id="password" name="password" placeholder="Mot de passe" value="<?php $password = (isset($_POST['password'])) ? $_POST['password'] : ''; echo $password ?>">
				    <?php
				    	if (isset($passwordRequired) AND $passwordRequired === "true") {
				    		echo "<span class='error'>Le mot de passe est obligatoire.</span>";

				    	} else if (isset($passwordNotValid) AND $passwordNotValid === "true") {
								echo "<span class='error'>Le mot de passe doit être compris entre 4 et 16 caractères.</span>";

				    	}
				    ?>
			    </div>
			    <div class="form-group col-md-6">
			      <label for="passwordConfirm" class="required">Confirmez votre mot de passe</label>
			      <input type="password" class="form-control <?php if (isset($_POST['sendInscription'])) { $valid = ((isset($passwordConfirmRequired) AND $passwordConfirmRequired === 'true') OR (isset($passwordMatchRequired) AND $passwordMatchRequired === 'true')) ? 'is-invalid' : 'is-valid'; echo $valid; } ?>" id="passwordConfirm" name="passwordConfirm" placeholder="Mot de passe" value="<?php $passwordConfirm = (isset($_POST['passwordConfirm'])) ? $_POST['passwordConfirm'] : ''; echo $passwordConfirm ?>">
				    <?php
				    	if (isset($passwordConfirmRequired) AND $passwordConfirmRequired === "true") {
				    		echo "<span class='error'>La confirmation du mot de passe est obligatoire.</span>";

				    	} else if (isset($passwordMatchRequired) AND $passwordMatchRequired === "true") {
								echo "<span class='error'>Le mot de passe doit être identique.</span>";

				    	}
				    ?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="fullAddress">Indiquez votre adresse</label>
			    <div class="form-row" id="fullAddress">
				    <div class="form-group col-md-6">
				    	<input type="text" class="form-control" id="address" name="address" placeholder="Numéro et nom de rue" value="<?php $address = (isset($_POST['address'])) ? $_POST['address'] : ''; echo $address ?>">
				    </div>
				    <div class="form-group col-md-4">
				      <input type="text" class="form-control" id="city" name="city" placeholder="Ville" value="<?php $city = (isset($_POST['city'])) ? $_POST['city'] : ''; echo $city ?>">
				    </div>
				    <div class="form-group col-md-2">
				      <input type="text" class="form-control" id="zip" name="zip" placeholder="Code Postal" value="<?php $zip = (isset($_POST['zip'])) ? $_POST['zip'] : ''; echo $zip ?>">
				    </div>
				  </div>
			  </div>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="sendInscription">S'inscrire</button>
				<div class="mt-2 mb-3">
			    <label>
			      Vous avez déjà un compte ? <a href="./connection">Connectez-vous !</a>
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