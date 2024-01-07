<?php
/*created by Leasim*/

//session_start();
//include_once __DIR__."/../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../source/controller/NoticiaController.php";
$message="";
/*if(isset($_SESSION['user_session'])!="")
{
	header("Location: index.php");
}

if(isset($_SESSION["user_session"]))
{
	if(!isLoginSessionExpired())
	{
		header("Location:index.php");
	} else
	{
		header("Location:logout.php?session_expired=1");
	}
}

if(isset($_GET["session_expired"]))
{
	$message = "La sesión ha expirado. Por favor ingresa nuevamente";
}*/

/*noticias internas*/
$noticiaControllerAct =  new NoticiaController();
$noticiasI = $noticiaControllerAct -> mostrarNoticiasInternas();
$cadenaNoticiasInternas = "";
foreach($noticiasI as $noticia)
{
	$cadenaNoticiasInternas .= "".$noticia->getDescripcion()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
/******************/
/*noticias externas*/
$noticiaControllerAct =  new NoticiaController();
$noticiasE = $noticiaControllerAct -> mostrarNoticiasExternas();
$cadenaNoticiasExternas = "";
foreach($noticiasE as $noticia)
{
	$cadenaNoticiasExternas .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$noticia->getDescripcion()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
/******************/

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.KALUZ.::</title>
	<link rel="stylesheet" type="text/css" href="../resources/font/index.css"/>
	<link rel="stylesheet" type="text/css" href="../resources/css/login.css"/>
	<link rel="stylesheet" type="text/css" href="../resources/css/scroll.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../resources/js/validation.min.js"></script>
	<script type="text/javascript" src="../resources/js/login.js"> </script>
	<style > .form-group { margin-bottom: 0px;} </style>
</head>
<body>
<marquee style="background-color:#e4c29b; color:#4d4d57 ; height:30px;font-size: 15px;" scrolldelay="120" direction="left" speed="slow" behavior="loop" >
    <?php echo $cadenaNoticiasExternas;?>
</marquee>
<div class="container-fluid" style="margin-top: -5px;">
<form method="post" id="login-form">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="background-color: #ffffff;text-align:center">
			<img class="img-responsive center-block img1" src="../resources/img/sie.gif" ><!--br>
			<img class="img-responsive center-block img2" src="../resources/img/mpbaa.png" -->
			<div class="tamanioPantalla2"></div>
		</div>
		<div  class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="background-color: #cccccc;">
				<div class="tamanioPantalla0"></div>
				<div class="form-group" style="margin-left: 20px;margin-right: 20px;">
					<input style="background-color: #e0e0e0;    border-radius: 0px;" type="text" class="form-control" id="user" placeholder="Usuario" name="user" required>
				</div><br>
				<div class="form-group" style="margin-left: 20px;margin-right: 20px;">
					<input style="background-color: #e0e0e0;    border-radius: 0px;" type="password" id="pass" class="form-control" placeholder="Contraseña" name="pass" required>
				</div><br>
				<div class="form-group" id="gif" style="margin-left: 20px;margin-right: 20px;text-align:center;">
					<button style="background-color: #e0e0e0;font-family:'Muli-Bold';border-radius: 0px;width: 100px;" type="submit" name="btn-login" id="btn-login" class='btn btn-default'>
						Entrar
					</button>
				</div><br>
				<center>
						<!--<a href="#" onclick="recuperar()" style="    font-size: .7em;">¿Olvidaste tu contraseña?</a>-->
				</center>
				<span id="result">
					<?php if($message!="") { ?>
						<div style="margin-bottom: -21px;" class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span><?php echo $message; ?> </div>
					<?php } ?>
				</span>
				<br><br><br>
				<input type="hidden" name="login-origen"  id="login-origen" value="0">
				<center>
				<button style="background-color: #cccccc;;font-family:'Muli-Bold';border-radius: 0px;width: 174px;font-size: .9em;" type="button" name="btn-login_asuntos" id="btn-login_asuntos" class='btn btn-default' onclick="asuntos_l()">
					Acceso directo asuntos
				</button>
				</center>
				<div class="tamanioPantalla"></div>
		</div>
	</div>
</form>
</div>
<div class="footer">
	<marquee style="background-color:#aeb599;color:#4d4d57; height:28px;font-size: 15px;" direction="right" scrolldelay="120" direction="left" speed="slow" behavior="loop" >
		<?php echo $cadenaNoticiasInternas;?>
	</marquee>
</div>
<!-- Modal -->

<center>
<div style="top: -5px;" class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" style="width: 300px;">
			<div class="modal-header h" style="padding: 7px 5px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<span style="font-size: 1.3em;" id="titulo_modal"></span>
			</div>
			<div class="modal-body detalle" style="padding: 10px;"></div>
		</div>
	</div>
</div>
</center>
</body>
</html>
