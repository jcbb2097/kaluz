<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	include_once __DIR__."/../../../source/controller/LogroController.php";
	
	$anio = 2020;
	
	$actLogro = new LogroController();
	$logro = $actLogro -> mostrarTotalLogros();
	$totalLogros = $logro ->getTotal();
	
	$logroAct = $actLogro -> mostrarTotalLogrosActividades();
	$totalLogrosAct = $logroAct ->getTotal();
	
	$logroMet = $actLogro -> mostrarTotalLogrosMetas();
	$totalLogrosMet = $logroMet ->getTotal();
	
	$actEje = new EjeController();
	$ejes = $actEje -> mostrarEjes();
	
	$cadenaTabla = "";
	$tot = 0;
	$totA = 0;
	$totSinLlenarA = 0;
	$totTerA = 0;
	$totEA = 0;
	$totEntA = 0;
	
	$totM = 0;
	$totSinLlenarM = 0;
	$totTerM = 0;
	$totEM = 0;
	$totEntM = 0;
	
	$percentA = 0.0;
	$percentAGral = 0.0;
	
	$percentM = 0.0;
	$percentMGral = 0.0;
	
	$cadenaExposiciones ="";
	$cadenaExposicionesMetas ="";
	$cursor = "";
	
	foreach($ejes as $eje)
	{
		$logroActEje = $actLogro -> mostrarTotalLogrosActividadesEje($eje->getIdEje());
		$totalLogrosActEje = $logroActEje ->getTotal();
		
		$logroActEjeTer = $actLogro -> mostrarTotalLogrosActividadesEjeTerminados($eje->getIdEje());
		$totalLogrosActEjeTer = $logroActEjeTer ->getTotal();
		
		$logroActEjeNE = $actLogro -> mostrarTotalLogrosActividadesEjeNoEditados($eje->getIdEje());
		$totalLogrosActEjeNE = $logroActEjeNE ->getTotal();
		
		$logroActEjeE = $actLogro -> mostrarTotalLogrosActividadesEjeEditados($eje->getIdEje());
		$totalLogrosActEjeE = $logroActEjeE ->getTotal();
		
		$logroActEjeEnt = $actLogro -> mostrarTotalLogrosActividadesEjeEntregable($eje->getIdEje());
		$totalLogrosActEjeEnt = $logroActEjeEnt ->getTotal();
		
		
		
		
		$logroMetEje = $actLogro -> mostrarTotalLogrosMetasEje($eje->getIdEje());
		$totalLogrosMetEje = $logroMetEje ->getTotal();
		
		$logroMetEjeTer = $actLogro -> mostrarTotalLogrosMetasEjeTerminados($eje->getIdEje());
		$totalLogrosMetEjeTer = $logroMetEjeTer ->getTotal();
		
		$logroMetEjeNE = $actLogro -> mostrarTotalLogrosMetasEjeNoEditados($eje->getIdEje());
		$totalLogrosMetEjeNE = $logroMetEjeNE ->getTotal();
		
		$logroMetEjeE = $actLogro -> mostrarTotalLogrosMetasEjeEditados($eje->getIdEje());
		$totalLogrosMetEjeE = $logroMetEjeE ->getTotal();
		
		$logroMetEjeEnt = $actLogro -> mostrarTotalLogrosMetasEjeEntregable($eje->getIdEje());
		$totalLogrosMetEjeEnt = $logroMetEjeEnt ->getTotal();
		
		
		
		
		
		$tot = $totalLogrosActEje + $totalLogrosMetEje;
		$totA += $totalLogrosActEje;
		$totSinLlenarA += $totalLogrosActEjeNE;
		$totTerA += $totalLogrosActEjeTer;
		$totEA += $totalLogrosActEjeE;
		$totEntA += $totalLogrosActEjeEnt;
		
		$totM += $totalLogrosMetEje;
		$totSinLlenarM += $totalLogrosMetEjeNE;
		$totTerM += $totalLogrosMetEjeTer;
		$totEM += $totalLogrosMetEjeE;
		$totEntM += $totalLogrosMetEjeEnt;
		
		$percentA = (($totalLogrosActEjeTer + $totalLogrosActEjeE)*100)/$totalLogrosActEje;
		$percentM = (($totalLogrosMetEjeTer + $totalLogrosMetEjeE)*100)/$totalLogrosMetEje;
		
		if($eje->getIdEje() == 7){
			$cadenaExposiciones = " onclick='muestraExposiciones()' ";
			$cadenaExposicionesMetas = " onclick='muestraExposicionesMetas()' ";
			$cursor ="cursor:pointer;font-weight: bold;";
		}else{
			$cadenaExposiciones ="";
			$cadenaExposicionesMetas="";
			$cursor ="";
		}
		
		$cadenaTabla .= " <tr style='height:53px'> <td ".$cadenaExposiciones." style='".$cursor."background-color: #efeffb;'>".$totalLogrosActEje."<p class='avance'>".number_format($percentA, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentA, 0, '.', '')."'></meter></p></td><td onclick='abreModal(".$eje->getIdEje().",\"".$eje->getNombre()."\",\" de actividades sin llenar\",".$totalLogrosActEjeNE.",1);' style='cursor:pointer;background-color: #efeffb;color: red;'>".$totalLogrosActEjeNE."</td><td onclick='abreModalTerminados(".$eje->getIdEje().",\"".$eje->getNombre()."\",\" de actividades terminados\",".$totalLogrosActEjeTer.",1);' style='cursor:pointer;background-color: #efeffb;color: #107c10;'>".$totalLogrosActEjeTer."</td><td onclick='abreModalProceso(".$eje->getIdEje().",\"".$eje->getNombre()."\",\" de actividades en proceso \",".$totalLogrosActEjeE.",1);' style='cursor:pointer;background-color: #efeffb;color: #ffb900;'>".$totalLogrosActEjeE."</td><td onclick='abreModalEntregable(".$eje->getIdEje().",1)' style='cursor:pointer;background-color: #efeffb;color: #2196F3;'>".$totalLogrosActEjeEnt."</td><td ".$cadenaExposicionesMetas." style='".$cursor."background-color: #f7f6f1;'>".$totalLogrosMetEje."<p class='avance'>".number_format($percentM, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentM, 0, '.', '')."'></meter></p></td><td onclick='abreModal(".$eje->getIdEje().",\"".$eje->getNombre()."\",\" de metas sin llenar\",".$totalLogrosMetEjeNE.",2);' style='cursor:pointer;background-color: #f7f6f1;color:red;'>".$totalLogrosMetEjeNE."</td><td onclick='abreModalTerminados(".$eje->getIdEje().",\"".$eje->getNombre()."\",\" de metas terminados\",".$totalLogrosMetEjeTer.",2);' style='cursor:pointer;background-color: #f7f6f1;color: #107c10;'>".$totalLogrosMetEjeTer."</td><td onclick='abreModalProceso(".$eje->getIdEje().",\"".$eje->getNombre()."\",\" de metas en proceso \",".$totalLogrosMetEjeE.",2);' style='cursor:pointer;background-color: #f7f6f1;color: #ffb900;'>".$totalLogrosMetEjeE."</td><td onclick='abreModalEntregable(".$eje->getIdEje().",2)' style='cursor:pointer;background-color: #f7f6f1;color: #2196F3;'>".$totalLogrosMetEjeEnt."</td><td class='clTotales'>".$tot."</td> </tr>";
		
		/*low='1000' high='4100' optimum='3500'*/
	
	}
	
	$percentAGral = (($totTerA + $totEA)*100)/$totA;
	$percentMGral = (($totTerM + $totEM)*100)/$totM;
	
	$cadenaTabla .= "<tr><td class='clTotales'>".$totA."<p class='avance'>".number_format($percentAGral, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentAGral, 0, '.', '')."'></meter></p></td><td onclick='abreModalGlobal(\"sin llenar\",".$totSinLlenarA.");' class='clTotales' style='cursor:pointer;color:red;'>".$totSinLlenarA."</td><td style='color: #107c10;' class='clTotales'>".$totTerA."</td><td style='color: #ffb900;' class='clTotales'>".$totEA."</td><td style='color: #2196F3;' class='clTotales'>".$totEntA."</td><td class='clTotales'>".$totM."<p class='avance'>".number_format($percentMGral, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentMGral, 0, '.', '')."'></meter></p></td><td class='clTotales' style='color:red'>".$totSinLlenarM."</td><td style='color: #107c10;' class='clTotales'>".$totTerM."</td><td style='color: #ffb900;' class='clTotales'>".$totEM."</td><td style='color: #2196F3;' class='clTotales'>".$totEntM."</td><td class='clTotales'></td></tr>";
	
	/*
	$incremento = 10;
	$cadenaIcon = "";
	
	for($r = 0 ; $r < 28; $r++)
	{
		$cadenaIcon .= "<i style='left: ".$incremento."px;' class='fas fa-angle-down flecha'></i>";
		$incremento += 30;
	}*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<!--<link rel="stylesheet" type="text/css" href="../resources/css/inicio.css"/>-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	
	
	
	<style>
	
body{

overflow-y:hidden;
overflow-x:hidden;

background-color:#ffffff;
}

.well2{
	min-height: 20px;
	font-family: 'Muli-SemiBold';
	font-size: 11px;
	padding: 8px;
	margin-bottom: 20px;
	background-color: #5a274f;
	border: 1px solid #5a274f;
	border-radius: 0px;
	color: #fefefe;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
}
	
.wr{
	background-color: #4d4d57;
    border: 1px solid #4d4d57;
    margin-top: -20px;
    height: 31px;
}


/**/
.pAct{
	position: absolute;
    border: 1px solid white;
    width: 116px;
    left: 1px;
    top: 53px;
    text-align: center;
}

.pMet{
	position: absolute;
    border: 1px solid white;
    left: 86px;
    width: 152px;
    top: 53px;
    text-align: center;
}

.eje{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 177px;
    left: -1px;
}

.ejeGlobal{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 208px;
}

.ejeGeneral{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 329px;
}

.ejeParticular{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 450px;
}

.ejeSub{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 571px;
}


.tAct{
	border: 1px solid #a9a9ae;
    height: 27px;
    width: 116px;
    position: absolute;
    text-align: center;
    border-top: none;
    font-family: 'Muli-SemiBold';
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
	background-color: #eae8e8;
	cursor: pointer;
    
}

.tMet{
	border: 1px solid #a9a9ae;
    height: 27px;
    width: 152px;
    position: absolute;
    text-align: center;
    border-top: none;
    font-family: 'Muli-SemiBold';
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
	cursor: pointer;
}

.tActT{
	border: 1px solid #a9a9ae;
    height: 27px;
    width: 61px;
    position: absolute;
    text-align: center;
    border-top: none;
    font-family: 'Muli-SemiBold';
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
	    background-color: #eae8e8;
		cursor: pointer;
    
}

.tMetT{
	border: 1px solid #a9a9ae;
    height: 27px;
    width: 62px;
    position: absolute;
    text-align: center;
    border-top: none;
    font-family: 'Muli-SemiBold';
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
	cursor: pointer;
}
.totales{
	border: 1px solid #a9a9ae;
    position: absolute;
    height: 54px;
    width: 177px;
    left: -1px;
}

.totalesGlo{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 208px;
}

.totalesGen{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 329px;
}

.totalesPar{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 450px;
}

.totalesSub{
	border: 1px solid #a9a9ae;
    position: absolute;
    
    height: 54px;
    width: 122px;
    left: 571px;
}

.clTotales{
	font-weight: bold;
    font-size: 12px;
    text-align: center;
}

.avance{
	font-size: 9px;
    height: 10px;
}
.flecha{
position: absolute;
    top: 0px;
    cursor: pointer;
}
.c{
color: #03A9F4;
}
	</style>
	
</head>
<body>
<div  class="well2 ">
	<b onclick="window.location.reload();" style="top: 6px;position: relative;">Indicador de logros de actividades y metas <?php echo $anio;?> </b>
	<i onclick ='muestraParticular("1,28")' style="left: 10px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(2)" style="left: 40px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(3)" style="left: 70px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(4)" style="left: 100px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(5)" style="left: 130px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(6)" style="left: 160px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(7)" style="left: 190px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(8)" style="left: 220px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ='muestraParticular("9,29,30")' style="left: 250px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(10)" style="left: 280px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ='muestraParticular("11,31,32")' style="left: 310px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ='muestraParticular("12,33,34,35,36")' style="left: 340px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(13)" style="left: 370px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(14)" style="left: 400px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(15)" style="left: 430px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(16)" style="left: 460px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(17)" style="left: 490px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ='muestraParticular("18,37,38,39")' style="left: 524px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(19)" style="left: 554px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(20)" style="left: 584px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(21)" style="left: 615px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(22)" style="left: 646px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(23)" style="left: 676px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(24)" style="left: 706px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ="muestraParticular(25)" style="left: 736px;" class="fas fa-angle-down flecha s"></i>
	<i onclick ='muestraParticular("26,40,41")' style="left: 766px;" class="fas fa-angle-down flecha s"></i>
	<!--<i onclick ="muestraParticular(27)" style="left: 796px;" class="fas fa-angle-down flecha s"></i>-->
	
	<i data-toggle="tooltip" data-placement="bottom" title="regresar a indicador general" style="position: absolute;top: 10px;right: 10px;cursor: pointer;" onclick="window.location.reload();" class="fas fa-globe s c"></i>
</div>
<div class="resumen">
<div class="well2 wr">
	<div style="position: absolute;top: -38px;left: 302px;">
		<p class="pAct">Total Logros <b><?php echo $totalLogros; ?></b></p>
		<p style="left: 148px;" class="pMet">Logros de actividades <b><?php echo $totalLogrosAct; ?></b></p>
		<p style="left: 330px;"class="pMet">Logros de metas <b><?php echo $totalLogrosMet; ?></b></p>
	</div>
	
	<!--<div>
		<p class="pAct" style="left: 208px;width: 122px;">Globales</p>
		<p class="pMet" style="left: 329px;width: 122px;">Generales</p>
		<p class="pMet" style="left: 450px;width: 122px;">Particulares</p>
		<p class="pMet" style="left: 571px;width: 122px;">Sub</p>
	</div>-->
</div>

<table style="font-family: 'Muli-Regular';font-size: 11px;margin-top: -54px;" class="table table-bordered">
    <thead>
	
      <tr>
        <!--<th style="color:white">Eje</th>-->
        <th style="background-color: #efeffb;width: 76px;font-size: 9px;height: 33px;padding-top: 0px;padding-bottom: 7px;">Logros actividades</th>
		<th style="background-color: #efeffb;">Sin llenar  <i onclick="muestraGrafica(1)" style="cursor:pointer;color:red;" class="fas fa-chart-bar"></i></th>
		<th style="background-color: #efeffb;">Terminados</th>
		<th style="background-color: #efeffb;">En proceso</th>
		<th style="background-color: #efeffb;">Con entregable</th>
		
        <th style="background-color: #f7f6f1;width: 88px;">Logros metas</th>
		<th style="background-color: #f7f6f1;">Sin llenar  <i onclick="muestraGrafica(2)" style="cursor:pointer;color:red;" class="fas fa-chart-bar"></i></th>
		<th style="background-color: #f7f6f1;">Terminados</th>
		<th style="background-color: #f7f6f1;">En proceso</th>
		<th style="background-color: #f7f6f1;">Con entregable</th>
		
		<th style="color:white">Total</th>
		
      </tr>
    </thead>
    <tbody>
		<?php echo $cadenaTabla; ?>
      
    </tbody>
  </table>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body detalle">
          
        </div>
        
      </div>
    </div>
 </div>
 
 
<div style="overflow-y: scroll;" class="modal fade" id="myModalE" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style='    width: 815px;left: -86px;'>
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		   <h4 class="modal-title rt" style="font-family: 'Muli-Bold';font-size: 13px;  text-align: center;"></h4>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body detalle2">
          
        </div>
        
      </div>
    </div>
 </div>
 
<div class="modal fade" id="myModalEntregables" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style='    width: 815px;left: -105px;height:600px'>
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="font-family: 'Muli-SemiBold';font-size: 12px;  text-align: center;">Listado de entregables</h4>
        </div>
        <div class="modal-body detalleEnt">
          
        </div>
        
      </div>
    </div>
 </div>

</body>
<script>
$('document').ready(function()
{ 
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover(); 
});

var padre = $(window.parent.document);
<?php echo $seleccion;?>



$(document).ready(function(){
	$('.btnMod').click(function(e) {
	    e.preventDefault();
		$('.btnMod').removeClass('selector');
		$(this).addClass('selector');
	});
});

function muestraDetalle(idDestino,idOrigen,idEje,tipo,idUsuario,idAreaUsuario)
{
	var idDestino = idDestino;
	var idOrigen = idOrigen;
	var idEje = idEje;
	var tipo = tipo;
	var idUsuario = idUsuario;
	var idAreaUsuario = idAreaUsuario;
	
	
	$(".h").css('background-color',"#4d4d57");
	$("#myModal").modal({backdrop: false});
	
	$.post("detalle.php",{idDestino:idDestino,idOrigen:idOrigen,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

$(document).ready(function(){
  
  
  $('.s').click(function(e) {
	        e.preventDefault();
			$('.s').removeClass('c');
			$(this).addClass('c');
	});
  
  
  
 
});

function abreModal(idEje,nombreEje,titulo,total,tipo)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var tipo = tipo;
	
	$("#myModal").modal("show");
	
	$.post("detalle.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,tipo:tipo}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function abreModalGlobal(titulo,total)
{

	var titulo = titulo;
	var total = total;
	
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleGlobal.php",{titulo:titulo,total:total}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function muestraParticular(idArea)
{

	var idArea = idArea;
	
	
	
	$.post("indexArea.php",{idArea:idArea}, function(data) {
		$(".resumen").html('');
		$(".resumen").html(data);
	});
	
}

function muestraGrafica(tipo)
{
	var tipo = tipo;

	$("#myModal").modal({backdrop: false});
	
	$.post("grafica.php",{tipo:tipo}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function muestraExposiciones()
{

	$("#myModalE").modal("show");
	
	$.post("exposiciones.php",{}, function(data) {
		$(".detalle2").html('');
		$(".detalle2").html(data);
		
		$(".rt").html('');
		$(".rt").html('Logros de Actividades 2020');
		
	});
	
}

function muestraExposicionesMetas()
{

	$("#myModalE").modal("show");
	
	$.post("exposicionesMetas.php",{}, function(data) {
		$(".detalle2").html('');
		$(".detalle2").html(data);
		
		$(".rt").html('');
		$(".rt").html('Logros de Metas 2020');
		
	});
	
}


function abreModalTerminados(idEje,nombreEje,titulo,total,tipo)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var tipo = tipo;
	
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleTerminados.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,tipo:tipo}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function abreModalProceso(idEje,nombreEje,titulo,total,tipo)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var tipo = tipo;
	
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleProceso.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,tipo:tipo}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function abreModalEntregable(idEje,tipo)
{

	var idEje = idEje;
	var tipo = tipo;
	$("#myModalEntregables").modal("show");
	
	$.post("entregables.php",{idEje:idEje,tipo:tipo}, function(data) {
		$(".detalleEnt").html('');
		$(".detalleEnt").html(data);
	});
	
}

</script>
</html>
