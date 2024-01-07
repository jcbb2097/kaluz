<?php
session_start();
include_once __DIR__."/../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../source/controller/UsuarioController.php";
include_once __DIR__."/../source/controller/EjeController.php";
include_once __DIR__."/../source/controller/AreaController.php";
include_once __DIR__."/../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>
<script>
	top.location.href="login.php";
	window.reload();
</script>
<?php
}
if(isset($_SESSION["user_session"]))
{
	if(isLoginSessionExpired())
	{
?>
<script>
	top.location.href="logout.php?session_expired=1";
</script>
<?php
	}
}
$anio = date("Y");
/*usuario*/
$usuarioControllerAct = new UsuarioController();
$usuario = $usuarioControllerAct -> mostrarUsuario($_SESSION['user_session']);

$idUser = $usuario -> getIdUsuario();
$idArea = $usuario -> getIdArea();
$nombreUser = $usuario -> getNombreUsuario();
$nombreArea = $usuario -> getNombreArea();
$idPerfil = $usuario -> getIdPerfil();
/**/

/*Areas*/
$areaControllerAct =  new AreaController();
$areas = $areaControllerAct -> mostrarAreas();
$cadenaAreas = "";
$pStyle= "";
$divStyle= "";
$caracteres = 0;
$nombreAreaCorto ="";
$totali = 0;
$resta = 0;
$color = "";
$toolName = "";
foreach($areas as $area)
{
	if($area->getIdArea() == $idArea ){ $divStyle="style='background-color:#298095;'"; }else{ $divStyle =''; }
	$caracteres = strlen($area->getNombre());
	if($caracteres >= 16){ 
		if($area->getIdArea() == 52){
			$nombreAreaCorto = $area->getNombre();
		}else{
			$nombreAreaCorto = substr($area->getNombre(), 0,-1);
			$toolName = "<span class='tooltiptext'>".$area->getNombre()."</span>";
		}
	}else{
		$nombreAreaCorto = $area->getNombre();
		$toolName = "";
		
	}
	$cadenaAreas .= "<div ".$divStyle." data-orden='".$area->getOrden()."' id='a".$area->getIdArea()."' onclick='notifArea(".$area->getIdArea().",".$idUser.",\"".$area->getNombre()."\");portada(".$anio.",".$area->getIdArea().",".$idUser.",".$idPerfil.",".$idArea.",1,\"".$nombreUser."\")'  class='A j l div notif tooltip'> ".$toolName."<p ".$pStyle." style='width: 83px;color:".$area->getColor()."'  class='rotar' >".$nombreAreaCorto."</p><input type='hidden' class='id' value='".$area->getIdArea()."'></input></div>";
	$totali++;
}
$resta = 30 - $totali;
$r = 0;

for($r = 1; $r <= $resta;$r++)
{
	$cadenaAreas .= "<div id='a' onclick=''  class='A j l div'><p class='rotar' style='width: 83px;'></p></div>";
}
/*
$cadenaAreas .= "<div id='a' onclick=''  class='A j l div'><p class='rotar'></p></div>";
$cadenaAreas .= "<div id='a' onclick=''  class='A j l div'><p class='rotar'></p></div>";
$cadenaAreas .= "<div id='a' onclick=''  class='A j l div'><p class='rotar'></p>".$totali."restan=".$resta."</div>";
*/
/**/

/*Ejes*/
$ejeControllerAct =  new EjeController();
$ejes = $ejeControllerAct -> mostrarEjes();
$cadenaEjes = "";
$top = 79;
$i = 1;

foreach($ejes as $eje)
{
	$cadenaEjes .= "<p onclick='portada(".$anio.",".$eje->getIdEje().",".$idUser.",".$idPerfil.",".$idArea.",2)' style='top:".$top."px; left:-1px' class='ejes nEje".$i."'><a style='color:white' href='../resources/pdfEje/".$eje->getPdf()."' target='scorm_object'>".$eje ->getOrden()."</a>&nbsp;&nbsp;&nbsp;<a style='color:white;' href='indicadores/Opiniones/Principal_indicador.php?nombreUsuario=".$nombreUser."&Periodo=".$anio."&estatus=1&idUsuario=".$idUser."&idAreaUsuario=".$idArea."&idArea=".$eje->getIdEje()."&TipoAreaEje=2&Tipo=0&nombreArea=".$nombreArea."&nombreEje=".$eje ->getNombre()."' target='scorm_object' ><i class='far fa-comment-dots'></i></a><br><a style='color:white;' href='indicadores/asuntos/eje/indexGlobal.php?anio=".$anio."&idUsuario=".$idUser."&idAreaUsuario=".$idArea."&idArea=".$idArea."&idEje=".$eje->getIdEje()."&nombreArea=".$nombreArea."&nombreEje=".$eje ->getNombre()."' target='scorm_object' >".$eje ->getNombre()."</a></p>";
	$top += 53;
	$i++;
}
$cadenaEjes .= "<p style='cursor: default;top:609px; left:-1px' class='ejes'></p>";
/**/
$cadenaTablaRecibidos = "";
$aumento = 79;
$background = "";
$sty = "";
for($iTabla = 0; $iTabla <= 35; $iTabla++)
{
	if($iTabla >= 33){$background = "background-color:#393641;color:#fefefe";}
	if($iTabla == 1 || $iTabla == 4 || $iTabla == 7 || $iTabla == 10 || $iTabla == 12 || $iTabla == 15 || $iTabla == 18 || $iTabla == 21 || $iTabla == 24 || $iTabla == 27 || $iTabla == 30 || $iTabla == 32 ){$sty="height:16.5px;";}else{$sty="";}
    $cadenaTablaRecibidos.= "<p style='".$sty."top:".$aumento."px;left:128px;".$background."' class='ejesCuadriculaAsuntos p".$iTabla."r'>0</p>";
	//$aumento += 26.5;
	$aumento += 17.65;
}

$cadenaTablaEnviados = "";
$aumentoE = 79;
$backgroundE = "";
$styE = "";
for($iTablaE = 0; $iTablaE <= 35; $iTablaE++)
{
	if($iTablaE >= 33){$backgroundE = "background-color:#393641;color:#fefefe";}
	if($iTablaE == 1 || $iTablaE == 4 || $iTablaE == 7 || $iTablaE == 10 || $iTablaE == 12 || $iTablaE == 15 || $iTablaE == 18 || $iTablaE == 21 || $iTablaE == 24 || $iTablaE == 27 || $iTablaE == 30 || $iTablaE == 32 ){$styE="height:16.5px;";}else{$styE="";}
    $cadenaTablaEnviados.= "<p style='".$styE."top:".$aumentoE."px;left:154px;".$backgroundE."' class='ejesCuadriculaAsuntos p".$iTablaE."e'>0</p>";
	$aumentoE += 17.65;
}

$cadenaTablaInvitado = "";
$aumentoI = 79;
$backgroundI = "";
$styI = "";
for($iTablaI = 0; $iTablaI <= 35; $iTablaI++)
{
	if($iTablaI >= 33){$backgroundI = "background-color:#393641;color:#fefefe";}
	if($iTablaI == 1 || $iTablaI == 4 || $iTablaI == 7 || $iTablaI == 10 || $iTablaI == 12 || $iTablaI == 15 || $iTablaI == 18 || $iTablaI == 21 || $iTablaI == 24 || $iTablaI == 27 || $iTablaI == 30 || $iTablaI == 32 ){$styI="height:16.5px;";}else{$styI="";}
    $cadenaTablaInvitado.= "<p style='".$styI."top:".$aumentoI."px;left:179px;".$backgroundI."' class='ejesCuadriculaAsuntos p".$iTablaI."e'>0</p>";
	$aumentoI += 17.65;
}
/*
$cadenaTablaOpinion = "";
$aumentoO = 79;
$backgroundO = "";
for($iTablaO = 0; $iTablaO <= 23; $iTablaO++)
{
	if($iTablaO >= 22){$backgroundO = "background-color:#393641;color:#fefefe";}
    $cadenaTablaOpinion.= "<p style='top:".$aumentoO."px;left:180px;".$backgroundO."' class='ejesCuadricula p".$iTablaO."o'>0</p>";
	$aumentoO += 26.5;
}
*/
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

$grupoD = $areaControllerAct -> mostrarTotalGrupo(1);
$totalD = $grupoD ->getTotal();
$grupoT = $areaControllerAct -> mostrarTotalGrupo(2);
$totalT = $grupoT ->getTotal();
$grupoA = $areaControllerAct -> mostrarTotalGrupo(3);
$totalA = $grupoA ->getTotal();

$widthD = 0;
$widthT = 0;
$widthA = 0;

$widthD = (30.26 * $totalD) - 3;
$widthT = (30.26 * $totalT) - 3;
$widthA = (30.26 * $totalA) - 3;

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../resources/font/index.css"/>
	<link rel="stylesheet" type="text/css" href="../resources/css/inicio.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="../resources/js/jquery.min.js"></script>
	<script src="../resources/js/cruces.js"></script>
    <script src="../resources/js/inicio.js"></script>
	<script src="../resources/js/funcionesPrincipal.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XHMWZ87SNE"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-XHMWZ87SNE');
	</script>
	<style>
		.tooltip {
		  position: relative;
		  display: inline-block;
		  border-bottom: 1px dotted black;
		}

		.tooltip .tooltiptext {
		  visibility: hidden;
		  width: 100px;
		  background-color: #4d4d57;
		  color: #fff;
		  text-align: center;
		  border-radius: 3px;
		  padding: 1px 0;
		  
		  /* Position the tooltip */
		  position: absolute;
		  z-index: 1;
		  top: 100%;
		  left: 85%;
		  margin-left: -60px;
		}

		.tooltip:hover .tooltiptext {
		  visibility: visible;
		}
	</style>
</head>
<body>
<div class="container" style="border-color: transparent;">
<div id="menuArriba" style="background-color:#e2e2e1;border-color:#e2e2e1;font-family: 'Muli-Regular';text-align:center;color:#434343;font-size:11px;"><a class="hov" style="color:#000; position:absolute; left:600px;top:15px;"  href="javascript:location.reload();">INICIO</a> <a class="hov" style="color:#000; position:absolute; left:700px; cursor:pointer;top:15px;"  onclick="aplicaciones(<?php echo $idPerfil; ?>,'<?php echo $nombreUser; ?>',<?php echo $idUser; ?>);">APLICACIONES</a> <a class="hov" style="color:#000; position:absolute; left:840px;cursor:pointer;top:15px;"  onclick="kpi(<?php echo $idPerfil; ?>,'<?php echo $nombreUser; ?>',<?php echo $idUser; ?>);">KPI'S</a> <a class="hov" style="color:#000; position:absolute; left:1056px;top:15px;" target="_top" href="logout.php">SALIR</a></div>
<div class="usuario">
	<i class="fas fa-user-circle" style="font-size:20px;position:absolute;top:2px;left:2px;color:#fefefe;"></i>
	<p style="top:-18px; left:26px; z-index: -1;" class="user"><br><?php echo $nombreUser ?><br><?php echo $nombreArea ?></p>
	<i style="color: white;position: absolute;left: 188px;top: 7px;" class="far fa-bell"></i>
	<div style="border: transparent;" id="notificacionOpinion"><span class="dot">0</span></div>
	<div class="notificaciones">
		<iframe scrolling="no"   name="myiframeNot" id="myiframeNot" src="" style="border: 0;width: 216px; height: 119px; margin-top: -25px; margin-left: -1px;"></iframe>
	</div>

	<p class="menuCambios " style="top: 145px;left:-1px;border: none"><a href="http://palacioba1.ddns.net:8081/palacio/soe/intranet/index3.html" target="_blank" style="color: white; text-decoration: none;">V</a></p>
	<p onclick="cambiaVista('Opinión',1);" class="menuCambios cam" style="left: 27px;top: 144px;">O</p>
	<p onclick="cambiaVista('Invitado',2);" class="menuCambios cam camColor" style="left: 43px;top: 144px;">I</p>

</div>


<div class="general">
	<p onclick="cambiarP();" class="Ppersonal">Personal <img id="imgC" src="../resources/img/interruptorVerde.png"/> </p>
	<p onclick="cambiarG();" class="Pgeneral">General <img id="imgD" src="../resources/img/interruptorRojo.png"/> </p>
</div>
<p class="seccionAsuntos" style="cursor:pointer;" onclick="asuntos()" ><a style="cursor:pointer;color: white;position: absolute;left: 7px;top: 21px;">Asuntos</a><p onclick="asuntos()" style="position: absolute;top: 203px;left: 139px;cursor:pointer;" class="tooltipAsunto"><i style="font-size: 13px;color: #fcfafc;position: absolute;left: 21px;top: -5px;" class="far fa-edit"></i><span style="z-index: 59;top: -19px;left: -6px;" class="tooltiptextAsunto">redactar</span></p></p>
<p onclick="asuntosRec(<?php echo $anio; ?>,<?php echo $idArea; ?>,<?php echo $idUser; ?>);" class="seccionRecibidos"><img width="20px" height="20px" src="../resources/icon/sobre.svg"/></p>
<p onclick="asuntosEnv(<?php echo $anio; ?>,<?php echo $idArea; ?>,<?php echo $idUser; ?>);" class="seccionEnviados"><img width="20px" height="20px" src="../resources/icon/avion.svg"/></p>
<p class="seccionOpinion">Invitado</p>

<img style='top: 25px;left: 32px;width: 155px;' onclick="verCruces()" class="imgMuseo" src="../resources/img/museo21.png"/>
<marquee style="left:224.5px;top:55px;background-color:#e4c29b; color:#4d4d57" scrolldelay="120" direction="left" speed="slow" behavior="loop" >
    <?php echo $cadenaNoticiasExternas;?>
</marquee>
<marquee style="left:224.5px;top:75px;background-color:#aeb599;color:#4d4d57" direction="right" scrolldelay="120" direction="left" speed="slow" behavior="loop" >
    <?php echo $cadenaNoticiasInternas;?>
</marquee>

<div style="display:flex;background-color: #4d4d57;border-color: #4d4d57;font-family: 'Muli-Regular';text-align: center;color: white;font-size: 11px;border-left: 0.5px solid #646472;width: 904px;padding: 2px 0;top: 94px;margin: 0;min-height: 21px;position: absolute;left: 227px;">
	<div id="directivas" style="width:<?php echo $widthD; ?>px;background-color:#4d4d57;border-color:#4d4d57;border-right-color: #4d4d57;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Directivas</div>
	<div id="tecnicas" style="width:<?php echo $widthT; ?>px;background-color:#4d4d57;border-color:#4d4d57;border-right-color: #4d4d57;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Técnicas</div>
	<div id="administrativas" style="width:<?php echo $widthA; ?>px;background-color:#4d4d57;border-color:#4d4d57;border-right-color: #4d4d57;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Administrativas</div>
</div>
<!--
<div id="directivas" style="background-color:#4d4d57;border-color:#4d4d57;border-right-color: #646472;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Directivas</div>
<div id="tecnicas" style="background-color:#4d4d57;border-color:#4d4d57;border-right-color: #646472;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Técnicas</div>
<div id="administrativas" style="background-color:#4d4d57;border-color:#4d4d57;border-right-color: #646472;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Administrativas</div>
<div id="amigos" style="background-color:#A9A9AE;border-color:#4d4d57;border-right-color: #646472;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;">Proyecto José María Velasco</div>
-->
<!--div id="inba" style="background-color:#4d4d57;border-color:#4d4d57;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;border-left: .5px solid #646472;"></div-->
<!--
<div id="sobrante" style="background-color:#4d4d57;border-color:#4d4d57;font-family: 'Muli-Regular';text-align:center;color:white;font-size:11px;border-left: .5px solid #646472;"></div>
-->
<div id="flotante">
  <div hidden class=" A j active "></div>
  <?php echo $cadenaAreas;?>
</div>

<div class="verticalEjes">
	<!--<div class="div5">
		<p class="div0"></p>
		<p class="div1"><p class="texto1">Gestión e infraestructura</p></p>
		<p class="div2"><p class="texto2">Acervos</p></p>
		<p class="div3"><p class="texto3">Difusión</p></p>
		<p class="div4"></p>
	</div>-->
	<p class="divTotal"></p>
	<?php echo $cadenaEjes;?>
	<p  class="ejesTotal">Total</p>
	<p style='top:661px; left:138px;' class='tableEjes'></p>
    <p style='top:661px; left:164px;' class='tableEjes'></p>
	<div style='height: 586px;margin-top: 64px;width: 209px;background-color: #a9a9ae;' class="cs123 cT"><?php echo $cadenaTablaRecibidos; ?></div>
	<div class="cs124 cT"><?php echo $cadenaTablaEnviados; ?></div>
	<div class="cs125 cT"><?php echo $cadenaTablaInvitado; ?></div>
 </div>

<div class="centro">
	<iframe name="scorm_object" id="scorm_object" src="" style="width:100%;height:708px;border:0;z-index:100"></iframe>
</div>
<p style='background-color: #d3d3d3;' class="franja"></p>
<p style='background-color: #a9a9ae;' class="franjaGris"></p>
</div>
</body>
<script>
$('document').ready(function()
{
	$('.cam').click(function(e) {
	        e.preventDefault();
			$('.cam').removeClass('camColor');
			$(this).addClass('camColor');
	});
});
$('document').ready(function()
{

	var opcion ="recibido";
	$.post("apps/Asuntos/index.php",{ac:5,idArea:'<?php echo $idArea; ?>',opcion:opcion,anio:'<?php echo $anio; ?>',idUsuario:'<?php echo $idUser; ?>'}, function(data)
	{
		$(".cs123").html('');
		$(".cs123").html( data );
	});

	var opcionE ="enviado";
	$.post("apps/Asuntos/index.php",{ac:5,idArea:'<?php echo $idArea; ?>',opcion:opcionE,anio:'<?php echo $anio; ?>',idUsuario:'<?php echo $idUser; ?>'}, function(data)
	{
		$(".cs124").html('');
		$(".cs124").html( data );
	});


	var opcionI ="invitado";
	$.post("apps/Asuntos/index.php",{ac:5,idArea:'<?php echo $idArea; ?>',opcion:opcionI,anio:'<?php echo $anio; ?>',idUsuario:'<?php echo $idUser; ?>'}, function(data)
	{
		$(".cs125").html('');
		$(".cs125").html( data );
	});
	/*
	$.post("apps/Opiniones/barra_opiniones.php?idUsuario=<?php echo $idUser; ?>&nombreUsuario=<?php echo $nombreUser; ?>",{}, function(data)
	{
		$(".cs125").html('');
		$(".cs125").html( data );
	});
	*/
	$.post("apps/Opiniones/pendientes.php?idUsuario=<?php echo $idUser; ?>&nombreUsuario=<?php echo $nombreUser; ?>&id_area=<?php echo $idArea; ?>",{}, function(data)
	{
		$("#notificacionOpinion").html('');
		$("#notificacionOpinion").html( data );
	});

	verCruces();

	var idAreaNot =<?php echo $idArea; ?>;
	var idUsuarioNot = <?php echo $idUser; ?>;
	$('iframe#myiframeNot').attr('src','notificaciones/index.php?idArea='+idAreaNot+'&idUsuario='+idUsuarioNot);


	//setInterval( recargarNotificacion, 40000);


});



function recargarNotificacion()
{
	var idAreaNoti =<?php echo $idArea; ?>;
	var idUsuarioNoti = <?php echo $idUser; ?>;
	$('iframe#myiframeNot').attr('src','notificaciones/index.php?idArea='+idAreaNoti+'&idUsuario='+idUsuarioNoti);
}

// function verCruces()
// {
// 	$('iframe#scorm_object').attr('src','cruces.php');
// }
function verCruces()
{
	$('iframe#scorm_object').attr('src','cruces.php?idUsuario=<?php echo $idUser; ?>&idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>&nombreUsuario=<?php echo $nombreUser; ?>');
}

// function asuntos()
// {
// 	$('iframe#scorm_object').attr('src','apps/Asuntos/index.php?ac=1&idUsuario=<?php echo $idUser; ?>&idArea=<?php echo $idArea; ?>&anio=<?php echo $anio; ?>&tipo=0&opcion=recibido&estatus=0&idEje=0&idAreaU=<?php echo $idArea; ?>&nuevo=1');
// }
function asuntos(){ // se cambia lo de rogelio por la version de alfonso
	var idusr = <?php echo $idUser; ?>;
	//$('iframe#scorm_object').attr('src','apps/Asuntos/index.php?ac=1&idUsuario=<?php echo $idUser; ?>&idArea=<?php echo $idArea; ?>&anio=<?php echo $anio; ?>&tipo=0&opcion=recibido&estatus=0&idEje=0&idAreaU=<?php echo $idArea; ?>&nuevo=1');
	$('iframe#scorm_object').attr('src','apps/Planeacion/Alta_asunto.php?accion=guardar&tipoPerfil=1&origen=3&idUsuario='+idusr+'&ac=1&idArea=<?php echo $idArea; ?>&anio=<?php echo $anio; ?>&tipo=0&opcion=recibido&estatus=0&idEje=0&idAreaU=<?php echo $idArea; ?>&nuevo=1&periodo=11');
}

function cambiaVista(titulo,seleccion)
{
	var titulo = titulo;
	var seleccion = seleccion;

	if(seleccion == 1)
	{
		$.post("apps/Opiniones/barra_opiniones.php?idUsuario=<?php echo $idUser; ?>&nombreUsuario=<?php echo $nombreUser; ?>",{}, function(data)
		{
			$(".seccionOpinion").html('');
			$(".seccionOpinion").html(titulo);
			$(".cs125").html('');
			$(".cs125").html( data );
		});
	}else if(seleccion == 2)
	{
		var opcionI ="invitado";
		$.post("apps/Asuntos/index.php",{ac:5,idArea:'<?php echo $idArea; ?>',opcion:opcionI,anio:'<?php echo $anio; ?>',idUsuario:'<?php echo $idUser; ?>'}, function(data)
		{
			$(".seccionOpinion").html('');
			$(".seccionOpinion").html(titulo);
			$(".cs125").html('');
			$(".cs125").html( data );
		});

	}else{}

	$("p.ejes").css("background-color","#4d4d57");
	$(".franja").css("height","64px");
	$(".ejesCuadricula").css({"background-color":"#a9a9ae","color":"black"});
	$(".ejesCuadriculaAsuntos").css({"background-color":"#a9a9ae"});
}

function asuntosGlobal(anio,idUsuario,idAreaUsuario,nombreArea,idEje)
{
	var anio = anio;
	var idUsuario = idUsuario;
	var idAreaUsuario = idAreaUsuario;
	var idArea = idAreaUsuario;
	var nombreArea = nombreArea;
	var idEje = idEje;
	$('iframe#scorm_object').attr('src','indicadores/asuntos/eje/indexGlobal.php?anio='+anio+'&idUsuario='+idUsuario+'&idAreaUsuario='+idAreaUsuario+'&idArea='+idArea+'&idEje='+idEje+'&nombreArea='+nombreArea);

}

let idAreaNotificacion = <?php echo $idArea;?>;
	if(idAreaNotificacion == 52 || idAreaNotificacion == 54)
	{
		function notifArea(idAreaNotif,idUsuarioSession,nombreArea)
		{
			var idAreaNotif = idAreaNotif;
			var idUsuarioSession = idUsuarioSession;
			var nombreArea = nombreArea;

			if(idAreaNotif == 52 && idAreaNotificacion == 52  || idAreaNotif == 54 && idAreaNotificacion == 54)
			{
				var idAreaNot =<?php echo $idArea; ?>;
				var idUsuarioNot = <?php echo $idUser; ?>;
				$('iframe#myiframeNot').attr('src','notificaciones/index.php?idArea='+idAreaNot+'&idUsuario='+idUsuarioNot);
			}else
			{
				$('iframe#myiframeNot').attr('src','notificaciones/indexArea.php?idArea='+idAreaNotif+'&idUsuario='+idUsuarioSession+'&nombreArea='+nombreArea);

			}

		}

	}

function notifArea(){}

function kpi(perfil,nombreUsuario,idUsuario)
{
	var tipoPerfil = perfil;
	var nombreUsuario = nombreUsuario;
	var idUsuario = idUsuario;
	$('iframe#scorm_object').attr('src','cruceskpi.php?tipoPerfil='+tipoPerfil+'&nombreUsuario='+nombreUsuario+'&idUsuario='+idUsuario);
    $("#cruces").attr("hidden",true);
	$("img#eje11").attr("hidden",true);
	$("img#eje10").attr("hidden",true);
	$("img#eje9").attr("hidden",true);
	$("img#eje8").attr("hidden",true);
	$("img#eje7").attr("hidden",true);
	$("img#eje6").attr("hidden",true);
	$("img#eje5").attr("hidden",true);
	$("img#eje4").attr("hidden",true);
	$("img#eje3").attr("hidden",true);
	$("img#eje2").attr("hidden",true);
	$("img#eje1").attr("hidden",true);
	$("#oculta").attr("hidden",true);
	$("p.ejes").css("background-color","#4d4d57");
	$("p.ejes a").css("color","#fff");
	$("p.ejes a").css("font-family", "Muli-Regular"); 
	$(".franja").css("height","64px");
	$(".ejesCuadricula").css({"background-color":"#a9a9ae","color":"black"});
	$(".ejesCuadriculaAsuntos").css({"background-color":"#a9a9ae"});
	
}
</script>
</html>
