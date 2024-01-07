<?php
require_once __DIR__.'/../source/controller/SecuredController.php';

$secured = new SecuredController();
$secured -> initSession();
$isSessionValid =  $secured -> validateSession();

if(!$isSessionValid){
	$secured -> logoutSession();
	header("Location:login.php?message=ingrese nuevamente");
}

//print_r($_COOKIE);


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.KALUZ.::</title>
	<link rel="stylesheet" type="text/css" href="../resources/font/index.css"/>
	<link rel="stylesheet" href="../resources/css/bootstrap.min.css">
	<script src="../resources/js/jquery.min.js"></script>
	<script src="../resources/js/bootstrap.min.js"></script>
<style>
body 
{
  background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#cbccc8)) fixed;      
}
</style> 
<body>
	<div class="container">
		<iframe id="framePrincipal" src="principal.php?idUsuario=0&idProyarea=0"  style="width:100%;height:922px; border:0;"></iframe>
	</div>

</body>
</html>
