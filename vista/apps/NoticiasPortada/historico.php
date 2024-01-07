<?php
include_once __DIR__."/../../../source/controller/NoticiaController.php";	

	$tipoPerfil = $_GET["tipoPerfil"];
	$idUsuario = $_GET["idUsuario"];
	$nombreUsuario = $_GET["nombreUsuario"];
	
	$noticiaAct = new NoticiaController();
	$noticias = $noticiaAct -> mostrarNoticiasHistorico();
	
	$cadenaNoticias ="";
	$style = "";
	foreach($noticias as $noticia)
	{
		if($noticia ->getTipo() == 'Interna'){ $style="style='background-color: #aeb599;border: 1px solid #ddd;'";}else{ $style="style='background-color: #e4c29b;border: 1px solid #ddd;'";}
		$cadenaNoticias .= "<tr><td>&nbsp;&nbsp;</td><td>inactiva</td><td ".$style." >".$noticia ->getTipo()."</td><td>".$noticia ->getDescripcion()."</td><td>".$noticia ->getFecha()."</td></tr>";
	}
	
	//<a style='color:black;cursor:pointer' onclick='eliminarNoticia7(".$noticia ->getIdNoticia().")'><span class='glyphicon glyphicon-trash'></span></a>   <a style='color:black;cursor:pointer' onclick='modificarNoticia(".$noticia ->getIdNoticia().",".$tipoPerfil.",".$idUsuario.",\"".$nombreUsuario."\")'><span class='glyphicon glyphicon-pencil'></span></a>
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.NOTICIAS PORTADA.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/noticiasPortada.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="../../../resources/js/aplicaciones/noticiasPortada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<style>
.dataTables_scrollBody::-webkit-scrollbar {
    -webkit-appearance: none;
}

.dataTables_scrollBody::-webkit-scrollbar:vertical {
    width:5px;
}

.dataTables_scrollBody::-webkit-scrollbar-button:increment,.dataTables_scrollBody::-webkit-scrollbar-button {
    display: none;
} 

.dataTables_scrollBody::-webkit-scrollbar:horizontal {
    height: 10px;
}

.dataTables_scrollBody::-webkit-scrollbar-thumb {
   /* background-color: #797979;
    border-radius: 20px;
    border: 2px solid #f1f2f3;
	border-radius: 0px;
    border: 2px solid #464456;*/
	
	    background-color: #cbcbca;
    border-radius: 4px;
    border: 1px solid #5a274f;
}

.dataTables_scrollBody::-webkit-scrollbar-track {
    border-radius: 10px;  
}
</style>
</head>
<body >
<div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="noticiasPortada.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">Noticias portada</a> / Histórico</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<a href="frmNoticia.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">agregar +</a> /
			
		</div>
		<div  class="col-md-4 col-sm-4 col-xs-12">
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
		</div>
	</div><br>
	<div style="text-align: center;font-family: 'Muli-Bold';font-size: 13px;">Histórico: noticias Portada inactivas</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<table id="noticiasPortada" class="table table-striped table-bordered" style="width:100%">
				<thead style="font-size: 11px;">
					<tr>
						<th></th>
						<th>Estatus</th>
						<th>Tipo</th>
						<th>Descripción</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $cadenaNoticias; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>