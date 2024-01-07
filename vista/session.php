<?php
require_once __DIR__.'/../source/controller/SecuredController.php';

$secured = new SecuredController();
$secured -> initSession();
$isSessionValid =  $secured -> validateSession();




$rutaServer = $_SERVER [ 'SERVER_NAME' ];
$rLogin = $rutaServer."/sie/vista/login.php";
$rLogout = $rutaServer."/sie/vista/logout.php?session_expired=1";

if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
	$rLogin = "http://".$rutaServer."/sie/vista/login.php";
	$rLogout = "http://".$rutaServer."/sie/vista/logout.php?session_expired=1";
}else{
	$rLogin = "https://".$rutaServer."/sie/vista/login.php";
	$rLogout = "https://".$rutaServer."/sie/vista/logout.php?session_expired=1";
}

if(!$isSessionValid){
	$secured -> logoutSession();
	
?>	

<script>
	top.location.href="<?php echo $rLogin; ?>";
	window.reload();
</script>
<?php	

}

/*
if(isset($_SESSION["user_session"])) 
{
	if(isLoginSessionExpired()) 
	{
? >
< script>
	top.location.href="<?php echo $rLogout; ?>";
< /script>
< ?php
	}
}
*/
?>