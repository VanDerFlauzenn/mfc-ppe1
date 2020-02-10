<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="bs-4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="jquery-1.11.1/jquery.js"></script>
<script type="text/javascript" src="bs-4.4.1/js/bootstrap.min.js"></script>
<?php
	session_start();
	
	$current_file_name = basename($_SERVER['PHP_SELF']);
	
	$session_bool = (isset($_SESSION['id'])) ? true : false;
?>