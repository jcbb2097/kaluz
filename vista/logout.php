<?php
	session_start();
	unset($_SESSION['user_session']);
	
	if(session_destroy())
	{
		header("Location: login.php");
	}
	
	$url = "login.php";
	if(isset($_GET["session_expired"])) 
	{
		$url .= "?session_expired=" . $_GET["session_expired"];
	}
	header("Location:$url");
?>

