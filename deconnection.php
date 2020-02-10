<?php 

session_start();
$_SESSION = array();

session_destroy();

setcookie('id', '');
setcookie('username', '');

header("Location: index");

?>