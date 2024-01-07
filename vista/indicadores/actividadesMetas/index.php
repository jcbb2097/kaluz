<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	
	$anio = 2020;
	
	$actEje = new EjeController();
	$act = new IndicadorController();
	
	$ejes = $actEje -> mostrarEjes();
	
	$cadena = "";
	$cadenaGlobales = "";
	$cadenaGenerales = "";
	$cadenaParticulares = "";
	$cadenaSub = "";
	$aumento = 63;
	$totalActividades = 0;
	$totalMetas = 0;
	$totalActividadesGlo = 0;
	$totalMetasGlo = 0;
	$totalActividadesGen = 0;
	$totalMetasGen = 0;
	$totalActividadesPar = 0;
	$totalMetasPar = 0;
	$totalActividadesSub = 0;
	$totalMetasSub = 0;
	$seleccion="";
	
	foreach($ejes as $eje)
	{
		$ActMet = $act -> mostrarTotalActividadesMetas($eje->getIdEje(),$anio);
		$cadena.="<div class='eje' style='top: ".$aumento."px;'><p class='tAct a".$eje->getIdEje()."' style='left: -1px;' >".$ActMet->getTotalActividades()."</p><p class='tMet m".$eje->getIdEje()."' style='left: 86px;' >".$ActMet->getTotalMetas()."</p></div>";
		$totalActividades += $ActMet->getTotalActividades();
		$totalMetas += $ActMet->getTotalMetas();
		$seleccion.= "$('.a".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		$seleccion.= "$('.m".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		
		
		$ActMetGlobal = $act -> mostrarTotalActividadesMetasGlobales($eje->getIdEje(),$anio);
		$cadenaGlobales.="<div class='ejeGlobal' style='top: ".$aumento."px;'><p class='tActT agl".$eje->getIdEje()."' style='left: -1px;' >".$ActMetGlobal->getTotalActividades()."</p><p class='tMetT mgl".$eje->getIdEje()."' style='left: 59px;' >".$ActMetGlobal->getTotalMetas()."</p></div>";
		$totalActividadesGlo += $ActMetGlobal->getTotalActividades();
		$totalMetasGlo += $ActMetGlobal->getTotalMetas();
		$seleccion.= "$('.agl".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		$seleccion.= "$('.mgl".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		
		
		$ActMetGeneral = $act -> mostrarTotalActividadesMetasGenerales($eje->getIdEje(),$anio);
		$cadenaGenerales.="<div class='ejeGeneral' style='top: ".$aumento."px;'><p class='tActT agen".$eje->getIdEje()."' style='left: -1px;' >".$ActMetGeneral->getTotalActividades()."</p><p class='tMetT mgen".$eje->getIdEje()."' style='left: 59px;' >".$ActMetGeneral->getTotalMetas()."</p></div>";
		$totalActividadesGen += $ActMetGeneral->getTotalActividades();
		$totalMetasGen += $ActMetGeneral->getTotalMetas();
		$seleccion.= "$('.agen".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		$seleccion.= "$('.mgen".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		
		
		$ActMetParticular = $act -> mostrarTotalActividadesMetasParticulares($eje->getIdEje(),$anio);
		$cadenaParticulares.="<div class='ejeParticular' style='top: ".$aumento."px;'><p class='tActT apar".$eje->getIdEje()."' style='left: -1px;' >".$ActMetParticular->getTotalActividades()."</p><p class='tMetT apar".$eje->getIdEje()."' style='left: 59px;' >".$ActMetParticular->getTotalMetas()."</p></div>";
		$totalActividadesPar += $ActMetParticular->getTotalActividades();
		$totalMetasPar += $ActMetParticular->getTotalMetas();
		$seleccion.= "$('.apar".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		$seleccion.= "$('.mpar".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		
		
		$ActMetSub = $act -> mostrarTotalActividadesMetasSub($eje->getIdEje(),$anio);
		$cadenaSub.="<div class='ejeSub' style='top: ".$aumento."px;'><p class='tActT asub".$eje->getIdEje()."' style='left: -1px;' >".$ActMetSub->getTotalActividades()."</p><p class='tMetT msub".$eje->getIdEje()."' style='left: 59px;' >".$ActMetSub->getTotalMetas()."</p></div>";
		$totalActividadesSub += $ActMetSub->getTotalActividades();
		$totalMetasSub += $ActMetSub->getTotalMetas();
		$seleccion.= "$('.asub".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		$seleccion.= "$('.msub".$eje->getIdEje()."').hover(function(){ $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#5d2852'); }, function() { $(padre).find('p.nEje".$eje->getIdEje()."').css('background-color','#4d4d57'); }); "; 
		
		
		$aumento += 53;
	}
	
	
	
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
    width: 86px;
    left: 1px;
    top: 46px;
    text-align: center;
}

.pMet{
	position: absolute;
    border: 1px solid white;
    left: 86px;
    width: 90px;
    top: 46px;
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
    width: 88px;
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
    width: 90px;
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
	</style>
	
</head>
<body>
<div onclick="window.location.reload();" class="well2 ">
	Indicador actividades y metas <?php echo $anio;?>
</div>
<div class="well2 wr">
	<div>
		<p class="pAct">Actividades</p>
		<p class="pMet">Metas</p>
	</div>
	
	<div>
		<p class="pAct" style="left: 208px;width: 122px;">Globales</p>
		<p class="pMet" style="left: 329px;width: 122px;">Generales</p>
		<p class="pMet" style="left: 450px;width: 122px;">Particulares</p>
		<p class="pMet" style="left: 571px;width: 122px;">Sub</p>
	</div>
</div>

<div class="global">
	<?php echo $cadena; ?>
	
</div>
<div class="global">
	<?php echo $cadenaGlobales; ?>
</div>
<div class="global">
	<?php echo $cadenaGenerales; ?>
</div>
<div class="global">
	<?php echo $cadenaParticulares; ?>
</div>
<div class="global">
	<?php echo $cadenaSub; ?>
</div>
<div class="global">
	<div class="totales" style="top:646px;">
		<p class="tAct" style="left:-1px;background-color: #1a1a27;color: white;"><?php echo $totalActividades; ?></p>
		<p class='tMet' style='left: 86px;background-color: #4d4d57;color: white;'><?php echo $totalMetas; ?></p>
	</div>
</div>

<div class="global">
	<div class="totalesGlo" style="top:646px;">
		<p class="tActT" style="left:-1px;background-color: #1a1a27;color: white;"><?php echo $totalActividadesGlo; ?></p>
		<p class='tMetT' style='left: 59px;background-color: #4d4d57;color: white;'><?php echo $totalMetasGlo; ?></p>
	</div>
</div>

<div class="global">
	<div class="totalesGen" style="top:646px;">
		<p class="tActT" style="left:-1px;background-color: #1a1a27;color: white;"><?php echo $totalActividadesGen; ?></p>
		<p class='tMetT' style='left: 59px;background-color: #4d4d57;color: white;'><?php echo $totalMetasGen; ?></p>
	</div>
</div>

<div class="global">
	<div class="totalesPar" style="top:646px;">
		<p class="tActT" style="left:-1px;background-color: #1a1a27;color: white;"><?php echo $totalActividadesPar; ?></p>
		<p class='tMetT' style='left: 59px;background-color: #4d4d57;color: white;'><?php echo $totalMetasPar; ?></p>
	</div>
</div>

<div class="global">
	<div class="totalesSub" style="top:646px;">
		<p class="tActT" style="left:-1px;background-color: #1a1a27;color: white;"><?php echo $totalActividadesSub; ?></p>
		<p class='tMetT' style='left: 59px;background-color: #4d4d57;color: white;'><?php echo $totalMetasSub; ?></p>
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
  
  
  $('.a').click(function(e) {
	        e.preventDefault();
			$('.a').removeClass('resalta');
			$(this).addClass('resalta');
	});
  
  
  
 
});

</script>
</html>
