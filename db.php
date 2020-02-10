<?php
	$GLOBALS['conn'] = mysqli_connect("localhost","root","","mfc");
	// var_dump(mysqli_get_charset($conn));
	mysqli_set_charset($GLOBALS['conn'],"utf8");
?>