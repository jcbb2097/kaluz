<?php
	include_once __DIR__."/../../../../source/controller/IndicadorController.php";
	
	$anio = 2020;
	$idConversacion = $_GET["idConversacion"];
	$idDestino = $_GET["idDestino"];
	$idOrigen = $_GET["idOrigen"];
	
	$act = new IndicadorController();
	$conversaciones = $act->mostrarConversacion($idConversacion);
	
	$cadenaConversacion = "";
	$style = "";
	foreach($conversaciones as $conv)
	{
		if($conv->getIdArea() == $idDestino){ $style = "style='background-color: #d0ecac;border-bottom: 1px solid #464456;'";}
		else if ($conv->getIdArea() == $idOrigen){ $style = "style='background-color: #ffffff;border-bottom: 1px solid #464456;'";}
		else{ $style = "style='background-color: #eadfba;border-bottom: 1px solid #464456;'";}
		$cadenaConversacion .="<tr><td ".$style." >".$conv->getNombreUsuario()." (".$conv->getNombreArea().")<br> ".$conv->getRespuesta()."<br><p style='text-align: right;'>".$conv->getFecha()."</p></td></tr>";
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
