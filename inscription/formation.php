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
		if ($session_bool AND $_POST['formation']) {

			if ($_SESSION['status'] === 'admin') {
				echo "TODO: admin page";

		} else if ($_SESSION['status'] === 'student') {
			$sql_inscription = "INSERT INTO student_interested_in_formation (id, student_id, formation_id, registered) VALUES (NULL, '".$_SESSION['id']."', '".$_POST['formation']."', '0')";
			$result_inscription = mysqli_query($GLOBALS['conn'], $sql_inscription);
			$row_inscription = mysqli_fetch_array($result_inscription);
			
			header("Location: ./successful.php");
			
		} else if ($_SESSION['status'] === 'former') {
				echo "TODO: former page";
			
		}
	} else {
		header("Location: ../index.php");
	}
	?>
</body>
</html>