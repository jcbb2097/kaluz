<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	include_once __DIR__."/../../../source/controller/LogroController.php";
	
	$anio = 2020;
	$idArea = $_POST["idArea"];
	
	
	$actLogro = new LogroController();
	$logro = $actLogro -> mostrarTotalLogrosArea($idArea);
	$totalLogros = $logro ->getTotal();
	
	$logroAct = $actLogro -> mostrarTotalLogrosActividadesArea($idArea);
	$totalLogrosAct = $logroAct ->getTotal();
	
	$logroMet = $actLogro -> mostrarTotalLogrosMetasArea($idArea);
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
	foreach($ejes as $eje)
	{
		$logroActEje = $actLogro -> mostrarTotalLogrosActividadesEjeArea($eje->getIdEje(),$idArea);
		$totalLogrosActEje = $logroActEje ->getTotal();
		
		$logroActEjeTer = $actLogro -> mostrarTotalLogrosActividadesEjeTerminadosArea($eje->getIdEje(),$idArea);
		$totalLogrosActEjeTer = $logroActEjeTer ->getTotal();
		
		$logroActEjeNE = $actLogro -> mostrarTotalLogrosActividadesEjeNoEditadosArea($eje->getIdEje(),$idArea);
		$totalLogrosActEjeNE = $logroActEjeNE ->getTotal();
		
		$logroActEjeE = $actLogro -> mostrarTotalLogrosActividadesEjeEditadosArea($eje->getIdEje(),$idArea);
		$totalLogrosActEjeE = $logroActEjeE ->getTotal();
		
		$logroActEjeEnt = $actLogro -> mostrarTotalLogrosActividadesEjeEntregableArea($eje->getIdEje(),$idArea);
		$totalLogrosActEjeEnt = $logroActEjeEnt ->getTotal();
		
		
		
		
		$logroMetEje = $actLogro -> mostrarTotalLogrosMetasEjeArea($eje->getIdEje(),$idArea);
		$totalLogrosMetEje = $logroMetEje ->getTotal();
		
		$logroMetEjeTer = $actLogro -> mostrarTotalLogrosMetasEjeTerminadosArea($eje->getIdEje(),$idArea);
		$totalLogrosMetEjeTer = $logroMetEjeTer ->getTotal();
		
		$logroMetEjeNE = $actLogro -> mostrarTotalLogrosMetasEjeNoEditadosArea($eje->getIdEje(),$idArea);
		$totalLogrosMetEjeNE = $logroMetEjeNE ->getTotal();
		
		$logroMetEjeE = $actLogro -> mostrarTotalLogrosMetasEjeEditadosArea($eje->getIdEje(),$idArea);
		$totalLogrosMetEjeE = $logroMetEjeE ->getTotal();
		
		$logroMetEjeEnt = $actLogro -> mostrarTotalLogrosMetasEjeEntregableArea($eje->getIdEje(),$idArea);
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
		
		$cadenaTabla .= " <tr style='height:53px'> <td style='background-color: #efeffb;'>".$totalLogrosActEje."<p class='avance'>".number_format($percentA, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentA, 0, '.', '')."'></meter></p></td><td onclick='abreModalArea(".$eje->getIdEje().",\"".$eje->getNombre()."\",\"sin llenar\",".$totalLogrosActEjeNE.",\"".$idArea."\");' style='cursor:pointer;background-color: #efeffb;color: red;'>".$totalLogrosActEjeNE."</td><td style='background-color: #efeffb;'>".$totalLogrosActEjeTer."</td><td style='background-color: #efeffb;'>".$totalLogrosActEjeE."</td><td style='background-color: #efeffb;'>".$totalLogrosActEjeEnt."</td><td style='background-color: #f7f6f1;'>".$totalLogrosMetEje."<p class='avance'>".number_format($percentM, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentM, 0, '.', '')."'></meter></p></td><td style='background-color: #f7f6f1;color:red;'>".$totalLogrosMetEjeNE."</td><td style='background-color: #f7f6f1;'>".$totalLogrosMetEjeTer."</td><td style='background-color: #f7f6f1;'>".$totalLogrosMetEjeE."</td><td style='background-color: #f7f6f1;'>".$totalLogrosMetEjeEnt."</td><td class='clTotales'>".$tot."</td> </tr>";
		
		/*low='1000' high='4100' optimum='3500'*/
	
	}
	
	$percentAGral = (($totTerA + $totEA)*100)/$totA;
	$percentMGral = (($totTerM + $totEM)*100)/$totM;
	
	$cadenaTabla .= "<tr><td class='clTotales'>".$totA."<p class='avance'>".number_format($percentAGral, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentAGral, 0, '.', '')."'></meter></p></td><td onclick='abreModalGlobalArea(\"sin llenar\",".$totSinLlenarA.",\"".$idArea."\");' class='clTotales' style='cursor:pointer;color:red;'>".$totSinLlenarA."</td><td class='clTotales'>".$totTerA."</td><td class='clTotales'>".$totEA."</td><td class='clTotales'>".$totEntA."</td><td class='clTotales'>".$totM."<p class='avance'>".number_format($percentMGral, 0, '.', '')."% avance<meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percentMGral, 0, '.', '')."'></meter></p></td><td class='clTotales' style='color:red'>".$totSinLlenarM."</td><td class='clTotales'>".$totTerM."</td><td class='clTotales'>".$totEM."</td><td class='clTotales'>".$totEntM."</td><td class='clTotales'></td></tr>";
	
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
	
	
</head>
<body>
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
		<th style="background-color: #efeffb;">Sin llenar</th>
		<th style="background-color: #efeffb;">Terminados</th>
		<th style="background-color: #efeffb;">En proceso</th>
		<th style="background-color: #efeffb;">Con entregable</th>
		
        <th style="background-color: #f7f6f1;width: 88px;">Logros metas</th>
		<th style="background-color: #f7f6f1;">Sin llenar</th>
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

</body>
<script>


function abreModalArea(idEje,nombreEje,titulo,total,idArea)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var idArea = idArea;
	
	$("#myModal").modal();
	
	$.post("detalleArea.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,idArea:idArea}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function abreModalGlobalArea(titulo,total,idArea)
{

	var titulo = titulo;
	var total = total;
	var idArea = idArea;
	
	$("#myModal").modal();
	
	$.post("detalleGlobalArea.php",{titulo:titulo,total:total,idArea:idArea}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

</script>
</html>
