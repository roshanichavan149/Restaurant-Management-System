<?php
ob_start();
session_start();
if(isset($_SESSION['username']))
{
	session_destroy();
	unset($_SESSION['$username']);
	header("Location: main.php");
}

?>

