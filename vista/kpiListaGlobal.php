<?php
	include_once __DIR__."/../source/controller/KpiGlobalController.php";

	$idArea = $_POST["idArea"];
	$idEje = $_POST["idEje"];
	$act = new KpiController();
	
	$kpis = $act -> mostrarListado($idArea,$idEje);
	
	$cadena = "";
	$i = 1;
	$valorPercent = "";
	foreach($kpis as $kpi){
		if($kpi -> getTipoPV() == 1)
		{
			$valorPercent ="<br><meter min='0' max='100' low='24' high='75' optimum='100' value='".$kpi->getPorcentaje()."'></meter>".$kpi->getPorcentaje()."%<br>";
		}else if($kpi -> getTipoPV() == 2){
			$valorPercent =" (<b style='color: #1143b3;'>".$kpi->getValor()."</b>)<br>";
		
		}else{
			$valorPercent = "";
		}
		$cadena .= "<a style='    color: black; text-decoration: none;' href='".$kpi->getLiga()."'>".$i.". ".$kpi->getDescripcion()." ".$valorPercent." </a>";
		$i++;
	}
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<style>
.plista{
	font-family: 'Muli-Bold';
    font-size: 9.5px;
	text-align: left;
    padding: 4px;
	    margin-top: -6px;
}

a:hover {
     color: #5d2852 !important;
    text-decoration: underline !important;
}
</style>
</head>
<body >

<p class='plista'>
<?php
echo $cadena;
?>
</p>
</body>
</html>
