<?php
  require_once("./db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>MFC - Formations</title>
	<?php
		include('./head.php');
	?>
</head>
<body>
	<?php

		include('./header.php');

		if ($session_bool) {

			if ($_SESSION['status'] === 'admin') {
				include('./index/admin.php');

		} else if ($_SESSION['status'] === 'student') {
				include('./index/student.php');
			
		} else if ($_SESSION['status'] === 'former') {
				include('./index/former.php');
			
		}
	}
	?>
</body>
</html>