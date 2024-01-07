<?php
	session_start();
	include_once __DIR__."/../../../../source/controller/IndicadorController.php";
	include_once('../../../../WEB-INF/Classes/Catalogo.class.php');
	$catalogo = new Catalogo();

	$anio = 2020;
	$idConversacion = $_GET["idConversacion"];
	$idDestino = $_GET["idDestino"];
	$idOrigen = $_GET["idOrigen"];

	$act = new IndicadorController();
	$conversaciones = $act->mostrarConversacion($idConversacion);

	$cadenaConversacion = "";

	$colores_verdes = array(1=>"background-color: #d0ecac;",2=>"background-color: #b1eb66;");//receptores
	$colores_blancos = array(1=>"background-color: #ffffff;",2=>"background-color: #f0f0f0;");//emisores
	$array_emisores = array();
	$array_receptores = array();

	$color_usuario = array();

	$contador_destino = 0;
	$contador_origen = 0;

	foreach($conversaciones as $conv){
		$style = "style='border-bottom: 1px solid #464456;";

		$resultado= $catalogo->obtenerLista("SELECT con.idOrigen, con.idDestino,
							if(con.idOrigen = ".$conv->getIdArea()." and concat(cp.Nombre,' ',cp.Apellido_Paterno,' ',cp.Apellido_Materno ) = '".$conv->getNombreUsuario()."',1,0) AS emisor
																					FROM k_conversacion con
																					 JOIN c_usuario cu ON con.idUsuarioOrigen = cu.IdUsuario
																					 JOIN c_personas cp ON cp.id_Personas = cu.IdPersona
																					 WHERE con.idConversacion = $idConversacion");
		while ($row = mysqli_fetch_array($resultado)){
			$es_emisor = $row["emisor"];
		}

			$resultado= $catalogo->obtenerLista("SELECT con.idOrigen, con.idDestino,if(con.idDestino = ".$conv->getIdArea()." and concat(cp.Nombre,' ',cp.Apellido_Paterno,' ',cp.Apellido_Materno ) = '".$conv->getNombreUsuario()."',1,0) AS receptor
																						FROM k_conversacion con
																						 left JOIN c_personas cp ON cp.id_Personas = con.idUsuarioDestino
																						 WHERE con.idConversacion = $idConversacion");
			while ($row = mysqli_fetch_array($resultado)){
				$es_receptor = $row["receptor"];
			}


		if(($conv->getIdArea() == $idOrigen && $es_emisor == 1) || ($conv->getIdArea() == $idOrigen && $es_receptor == 0)){//emisores
			$class = "msj";
			if($es_emisor == 1){
				$style .= $colores_blancos[1]."'";
			}else{
				$style .= $colores_blancos[2]."'";
			}


		}else if ($conv->getIdArea() == $idDestino){//receptores
			$class = "msj";

			if($es_receptor == 1){
				$style .= $colores_verdes[1]."'";
			}else{
				$style .= $colores_verdes[2]."'";
			}

 }else{ //invitados
	 $class = "msj_inv";
	 $style = "style='background-color: #eadfba;border-bottom: 1px solid #464456;'";
 }
$cadenaConversacion .="<tr><td ".$style." class='".$class."'>".$conv->getNombreUsuario()." (".$conv->getNombreArea().")<br> ".$conv->getRespuesta()."<br><p style='text-align: right;'>".$conv->getFecha()."</p></td></tr>";
	}



?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../../resources/font/index.css"/>
	<!--<link rel="stylesheet" type="text/css" href="../resources/css/inicio.css"/>-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>

body{

overflow-y:hidden;
overflow-x:hidden;

background-color:#ffffff;
}

.font{
	font-family: 'Muli-Regular';
    font-size: 11px;
}
.msj_emi{
	font-family: 'Muli-Regular';
}
.msj{
	font-family: 'Muli-Regular';
}
.msj_inv{
	font-family: 'Muli-Regular';
}

	</style>
</head>
<body>
<table class="table table-condensed font">

    <tbody>

		<?php echo $cadenaConversacion; ?>
    </tbody>
  </table>
</body>
<script>
$('document').ready(function()
{

});
</script>
</html>
