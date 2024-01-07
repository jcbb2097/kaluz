<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	include_once __DIR__."/../../../source/controller/LogroController.php";
	
	$anio = 2020;
	$tipo = $_POST["tipo"];
	$idEje = $_POST["idEje"];
	
	$act = new LogroController();
	
	$entregables = $act -> mostrarDetalleEntregables($idEje,$tipo);
	
	$titulo = "";
	if($tipo == 1){$titulo="Actividad";}else{$titulo="Meta";}
	$cadena = "";
	$orden ="";
	$color="";
	foreach($entregables as $ent)
	{
		
		$entColor = $act -> mostrarColorEntregables($ent->getIdEntregableEspecifico());
		$final = $entColor ->getDescripcionUno();
		$pro = $entColor ->getDescripcionDos();
		$pre = $entColor ->getDescripcionTres(); 
		
		if($final > 0){$color = '#299620;color:white;';}else if($pro > 0 ){ $color ="yellow;color:black;";} else{ $color ="orange;color:white;";}
		
		
		$orden = "".$ent->getIdEje().".".$ent->getOrden()."";
		$cadena.= "<tr><td>".$ent->getIdEje().".".$ent->getOrden()." ".$ent->getNombreActividad()."</td><td>".$ent->getNombreArea()."</td><td style='background-color:".$color."'>".$ent->getDescripcionUno()."</td><td onclick='abreModalEnt2(".$ent->getIdEntregableEspecifico().",\"".$ent->getNombreActividad()."\",\"".$orden."\",\"".$ent->getDescripcionUno()."\",\" \")'><i style='cursor:pointer;' class='fas fa-folder-open'></i></td></tr>";
	}
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	
	
	
	
	<style>
	.cuerpo {
    width: 100%;
    height: 380px;
    border: none;
}

	</style>
	
</head>
<body>
<table class="table table-bordered table-condensed" style="font-family: 'Muli-Regular'; font-size: 11px;">
    <thead>
      <tr>
        <th><?php echo $titulo; ?></th>
        <th>Área</th>
        <th>Entregable</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
    <?php echo $cadena; ?>
    </tbody>
  </table>


<div class="modal fade" id="myModal7" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-number="2">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body detalle299">
			<iframe  id="frmFrame" class="cuerpo" src=""></iframe>
        </div>
        
      </div>
    </div>
 </div>

</body>
<script>
$('document').ready(function()
{ 

	
	
	
});

function abreModalEnt2(idEntregable,actividad,ordenA,nombreEntregable,exp)
{
	var idEntregable = idEntregable;
	var actividad = actividad;
	var ordenA = ordenA;
	var nombreEntregable = nombreEntregable;
	var exp = exp;
	
	$("#myModal7").modal("show");
	$('#frmFrame').attr("src","../../apps/Asuntos/indexAct.php?action=archivos&idEntregable="+idEntregable+"&actividad="+actividad+"&orden="+ordenA+"&desc="+nombreEntregable+"&exp="+exp);
 
}

/*
 function abrirV(idEntregable,actividad,ordenA,nombreEntregable,exp) {
    //$('#nuevoModal').modal('toggle');
    $("#nuevoModal").modal({backdrop: false});
    $('#frmFrame').attr("src","../../apps/Asuntos/indexAct.php?action=archivos&idEntregable="+idEntregable+"&actividad="+actividad+"&orden="+ordenA+"&desc="+nombreEntregable+"&exp="+exp);
  }
 
*/

$("button[data-number=2]").click(function(){
	$("#myModal7").modal("hide");
});

</script>
</html>
