<?php
  require_once("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>MFC - Formations</title>
	<?php
		include('../sub_head.php');
	?>
</head>
<body>
	<?php

		include('../sub_header.php');
		if ($session_bool) {

			if ($_SESSION['status'] === 'admin') {
				echo "TODO: admin page";

		} else if ($_SESSION['status'] === 'student') {
	?>
		Inscription validée !
		<a href="../">Retour à l'accueil</a>
	<?php
			
		} else if ($_SESSION['status'] === 'former') {
				echo "TODO: former page";
			
		}
	} else {
		header("Location: ../index.php");
	}
	?>
</body>
</html>