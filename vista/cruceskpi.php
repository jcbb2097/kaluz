<?php

$tipoPerfil = $_GET["tipoPerfil"];
$nombreUsuario = $_GET["nombreUsuario"];
$idUsuario = $_GET["idUsuario"];

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../resources/font/index.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	<script src="../resources/js/funcionesPrincipal.js"></script>

	<link rel="stylesheet" type="text/css" href="../resources/css/cruces.css"/>
		<link rel="stylesheet" type="text/css" href="../resources/css/aplicaciones.css"/>
</head>
<body>

<div id="imprimeCuadros" style="position: absolute;left: -3px;top: 63px;margin-top: -62px;"></div>



<div id="ex1" class="modal" style="background-color: #8d8d8d;font-family: muli-regular;height:285px;">
	<p for="" id="area_responsable_modal" style="font-size: 14px;margin-top: 0px !important;;text-align:center;width:100%;color:white">Área responsable</p>
	<div  style="width:100%">
  <div  style="width:25%;float:left;">
  






  </div>
  <div style="font-family: muli-regular;width:73%;float:right;" class="table-responsive">
    <p style="font-size:11px;font-weight:500;margin-top:0px;color:white;" id="titulo_tabla">Avance / Entregables e Insumos</p>
		<table id="tabla_principal" cellspacing="0" cellpadding="0" style="border: none;width:100%;border-radius: 6px;background-color:#4d4d57;margin-top:10px;display: block;height: 190px;overflow-y: scroll;" class="compactar">






		</table>
  </div>
</div>
</div>


<div id="ex2" class="modal" style="background-color: #8d8d8d;font-family: muli-regular;height:400px;">
	<div class="row">
  
 

</div>
</div>
<input type="hidden" id="eje_x" value="0">
<input type="hidden" id="eje_y" value="0">
</body>
<style media="screen">
.compactar td{
	padding: 2px !important;
}
.primer_td{
	min-width: 230px;
	max-width: 230px;
}

	.bolas{
		background-color: #0000000f;width: 5px;height: 5px;margin-left: 11px;border-radius:15px;    text-align: center;
	}
	.bolas_2{
		background-color: #00000054;width: 8px;height: 8px;margin-left: 10px;border-radius:15px;    text-align: center;
	}
	.bolas_3{
		background-color: #0d4ea3;width: 10px;height: 10px;margin-left: 10px;border-radius:15px;cursor:pointer;    text-align: center;
	}
	.es_blanco{
		background-color: white;
		height: 12px !important;
	}
	
.numeroArriba{
	font-family: 'Muli-SemiBold';
    font-size: 10px;
    position: relative;
    top: -25px;
    text-align: center;
	text-decoration: none;
    color: black;
}

.numeroArriba2{
	font-family: 'Muli-SemiBold';
    font-size: 10px;
    position: relative;
    top: 5px;
    text-align: center;
	text-decoration: none;
    color: black;
}

.numeroArribaHijo{
	font-family: 'Muli-SemiBold';
    font-size: 10px;
    position: relative;
    top: -15px;
    text-align: center;
	opacity: .6;
	text-decoration: none;
    color: black;
}

.titP{
	    font-family: 'Muli-Bold';
    font-size: 11px;
    position: relative;
    top: -13px;
    left: 10px;
	width: 887px;
}

.fontdatos{
	font-family: 'Muli-SemiBold';
    font-size: 11px;
	background-color: #f4f4f4; /*#ae96a6;#5d28522e*/
    box-shadow: 0 0 6px #5a274f;
	z-index: 10;
}

.cerrarDatos{
	position: absolute;
    float: right;
    font-size: 14px;
	top: -2px;
    right: -1px;
    color: #5d2852;
}
</style>
<style>
	div.cu{
/*width: 29.3px;*/
/*width: 32.65px; este tamaño tenia hasta la version 82 de chrome*/
/*width: 31.65px;*/
width: 28.3px;

padding: 24.6px 0;
margin: 0;
border: .5px solid white;
height: 2px;
background-color: #f4f4f4;
/*height: 2px; veriosn 83 en adelante chrome*/

}
	</style>
<script>

	var dv="";
	var e_x =1;
	var e_y =0;
	
	for(var f=1; f <=348; f++)
	{
		if(e_y==0){//si es la linea blanca
			if(e_x==29){
				dv +="<div  class=' A j cu ejex_49 ejey_"+e_y+" es_blanco' style='cursor:default'></div>";
				
			}
			dv +="<div  class=' A j cu ejex_"+e_x+" ejey_"+e_y+" es_blanco' style='cursor:default'></div>";
		}else{
			if(e_x==29){
				dv +="<div  class=' A j cu ejex_49 ejey_"+e_y+"' style='cursor:default'><div id='x_49_y_"+e_y+"' class='bolas bolax_49 bolay_"+e_y+"'></div></div>";
				
			}
			dv +="<div  class=' A j cu ejex_"+e_x+" ejey_"+e_y+"' style='cursor:default'><div style='cursor:pointer' onclick='abreDiv("+e_x+","+e_y+")' id='x_"+e_x+"_y_"+e_y+"' class='bolas bolax_"+e_x+" bolay_"+e_y+"'></div></div>";
		}
		if(f%29==0){
			 e_x = 1 ;
			 e_y = e_y +1 ;
		}else{
			e_x = e_x +1 ;
		}
/*
		if(e_y==0){
			
		}else{
			if(e_x==9){
				dv +="<div  class=' A j cu ejex_49 ejey_"+e_y+"' style='cursor:default'><div id='x_49_y_"+e_y+"' class='bolas bolax_49 bolay_"+e_y+"'></div></div>";
			}
			dv +="<div  class=' A j cu ejex_"+e_x+" ejey_"+e_y+"' style='cursor:default'><div style='cursor:pointer;' onclick='abreDiv("+e_x+","+e_y+")' id='x_"+e_x+"_y_"+e_y+"' class='bolas bolax_"+e_x+" bolay_"+e_y+"'></div></div>";
		}
		if(f%29==0){
			 e_x = 1 ;
			 e_y = e_y +1 ;
		}else{
			e_x = e_x +1 ;
		}
*/
	}
	//menu
	
	$("#imprimeCuadros").html("<div  class=' A j cud lin' style='padding: 24.6px 0;position:absolute;cursor:default'><p class='titP'>KPI´s Anuales     <a  href='indicadores.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>'>	<i style='float:right; cursor:pointer;color: #000;' class='fas fa-undo'></i></a>  <a href='cruceskpiGlobal.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>'><i style=' cursor:pointer;float:right;position: relative;right: 20px;' class='fas fa-globe'></i> </a></p></div>"+dv);
	
	

	function reset_colors(){
		$(".A.j.cu").css("background-color", "#f4f4f4");
		$(".A.j.cu").css("border", "1px solid #f4f4f4");
	}

$(document).ready(function(){
	obtener_cruces();


	$("p.ejpos1").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos1").css("background-color", "#4d4d57");
		$(".eje1").css("width", "522px");
		$(".eje12").css("width", "1.5px");
		$(".eje12").css("height", "68px");

		setTimeout(function(){
			$(".eje123").css("width", "905px");
		}, 1000);

		$(".eje1231").css("height", "16px");
		$(".eje1232").css("height", "16px");
		$(".eje1233").css("height", "16px");
		$(".eje1234").css("height", "16px");
		$(".eje1235").css("height", "16px");
		$(".eje1236").css("height", "16px");
		$(".imgEje1").show(700);
		$(".imgEje1a").show(2500);

		$(".eje2,.eje3,.eje4,.eje5,.eje6,.eje7,.eje8,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos7,.ejpos8,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje22,.eje32,.eje42,.eje52,.eje62,.eje72,.eje82,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje223,.eje323,.eje423,.eje523,.eje623,.eje723,.eje823,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje2231,.eje3231,.eje4231,.eje5231,.eje6231,.eje7231,.eje8231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje2232,.eje3232,.eje4232,.eje5232,.eje6232,.eje7232,.eje8232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje2233,.eje3233,.eje4233,.eje5233,.eje6233,.eje7233,.eje8233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje2234,.eje3234,.eje4234,.eje5234,.eje6234,.eje7234,.eje8234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje2235,.eje4235,.eje5235,.eje6235,.eje7235,.eje8235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje2236,.eje4236,.eje5236,.eje6236,.eje7236,.eje8236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje2237,.eje4237,.eje7237,.eje8237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje7238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje7239,.eje9239,.eje11239").css("height", "0px");
		$(".eje92310,.eje112310").css("height", "0px");
		$(".eje112311,.eje112312").css("height", "0px");
		$(".imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos2").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio

		$(".ejpos2").css("background-color", "#4d4d57");
		$(".eje2").css("width", "9px");
		$(".eje22").css("width", "1.5px");
		$(".eje22").css("height", "121px");

		setTimeout(function(){
			$(".eje223").css("width", "905px");
		},1000);

		$(".eje2231").css("height", "16px");
		$(".eje2232").css("height", "16px");
		$(".eje2233").css("height", "16px");
		$(".eje2234").css("height", "16px");
		$(".eje2235").css("height", "16px");
		$(".eje2236").css("height", "16px");
		$(".eje2237").css("height", "16px")
		$(".imgEje2").show(700);
		$(".imgEje2a").show(2500);

		$(".eje1,.eje3,.eje4,.eje5,.eje6,.eje7,.eje8,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos7,.ejpos8,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje32,.eje42,.eje52,.eje62,.eje72,.eje82,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje323,.eje423,.eje523,.eje623,.eje723,.eje823,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje3231,.eje4231,.eje5231,.eje6231,.eje7231,.eje8231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje3232,.eje4232,.eje5232,.eje6232,.eje7232,.eje8232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje3233,.eje4233,.eje5233,.eje6233,.eje7233,.eje8233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje3234,.eje4234,.eje5234,.eje6234,.eje7234,.eje8234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje3235,.eje4235,.eje5235,.eje6235,.eje7235,.eje8235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje3236,.eje4236,.eje5236,.eje6236,.eje7236,.eje8236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje3237,.eje4237,.eje5237,.eje6237,.eje7237,.eje8237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje3238,.eje4238,.eje5238,.eje6238,.eje7238,.eje8238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje3239,.eje4239,.eje5239,.eje6239,.eje7239,.eje8239,.eje9239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje32310,.eje42310,.eje52310,.eje62310,.eje72310,.eje82310,.eje92310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje32311,.eje42311,.eje52311,.eje62311,.eje72311,.eje82311,.eje92311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje32312,.eje42312,.eje52312,.eje62312,.eje72312,.eje82312,.eje92312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});





	$("p.ejpos4").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos4").css("background-color", "#4d4d57");
		$(".eje4").css("width", "522px");
		$(".eje42").css("width", "1.5px");
		$(".eje42").css("height", "227px");

		setTimeout(function() {
			$(".eje423").css("width", "905px");
		},1000);
		$(".eje4231").css("height", "16px");
		$(".eje4232").css("height", "16px");
		$(".eje4233").css("height", "16px");
		$(".eje4234").css("height", "16px");
		$(".eje4235").css("height", "16px");
		$(".eje4236").css("height", "16px");
		$(".eje4237").css("height", "16px");
		$(".imgEje4").show(700);
		$(".imgEje4a").show(2500);

		$(".eje1,.eje2,.eje3,.eje5,.eje6,.eje7,.eje8,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos5,.ejpos6,.ejpos7,.ejpos8,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje52,.eje62,.eje72,.eje82,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje523,.eje623,.eje723,.eje823,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje5231,.eje6231,.eje7231,.eje8231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje5232,.eje6232,.eje7232,.eje8232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje5233,.eje6233,.eje7233,.eje8233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje5234,.eje6234,.eje7234,.eje8234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje5235,.eje6235,.eje7235,.eje8235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje5236,.eje6236,.eje7236,.eje8236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje5237,.eje6237,.eje7237,.eje8237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje5238,.eje6238,.eje7238,.eje8238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje5239,.eje6239,.eje7239,.eje8239,.eje9239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje52310,.eje62310,.eje72310,.eje82310,.eje92310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje52311,.eje62311,.eje72311,.eje82311,.eje92311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje52312,.eje62312,.eje72312,.eje82312,.eje92312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos5").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos5").css("background-color", "#4d4d57");
		$(".eje5").css("width", "765px");
		$(".eje52").css("width", "1.5px");
		$(".eje52").css("height", "280px");

		setTimeout(function(){
			$(".eje523").css("width", "905px");
		},1000);

		$(".eje5231").css("height", "16px");
		$(".eje5232").css("height", "16px");
		$(".eje5233").css("height", "16px");
		$(".eje5234").css("height", "16px");
		$(".eje5235").css("height", "16px");
		$(".eje5236").css("height", "16px");
		$(".imgEje5").show(700);
		$(".imgEje5a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje6,.eje7,.eje8,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos6,.ejpos7,.ejpos8,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje62,.eje72,.eje82,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje623,.eje723,.eje823,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje6231,.eje7231,.eje8231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje6232,.eje7232,.eje8232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje6233,.eje7233,.eje8233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje6234,.eje7234,.eje8234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje6235,.eje7235,.eje8235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje6236,.eje7236,.eje8236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje6237,.eje7237,.eje8237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje6238,.eje7238,.eje8238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje6239,.eje7239,.eje8239,.eje9239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje62310,.eje72310,.eje82310,.eje92310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje62311,.eje72311,.eje82311,.eje92311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje62312,.eje72312,.eje82312,.eje92312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos6").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos6").css("background-color", "#4d4d57");
		$(".eje6").css("width", "493px");
		$(".eje62").css("width", "1.5px");
		$(".eje62").css("height", "333px");

		setTimeout(function(){
			$(".eje623").css("width", "905px");
		},1000);

		$(".eje6231").css("height", "16px");
		$(".eje6232").css("height", "16px");
		$(".eje6233").css("height", "16px");
		$(".eje6234").css("height", "16px");
		$(".eje6235").css("height", "16px");
		$(".eje6236").css("height", "16px");
		$(".imgEje6").show(700);
		$(".imgEje6a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje5,.eje7,.eje8,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos7,.ejpos8,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje52,.eje72,.eje82,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje523,.eje723,.eje823,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje5231,.eje7231,.eje8231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje5232,.eje7232,.eje8232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje5233,.eje7233,.eje8233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje5234,.eje7234,.eje8234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje5235,.eje7235,.eje8235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje5236,.eje7236,.eje8236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje5237,.eje7237,.eje8237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje5238,.eje7238,.eje8238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje5239,.eje7239,.eje8239,.eje9239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje52310,.eje72310,.eje82310,.eje92310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje52311,.eje72311,.eje82311,.eje92311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje52312,.eje72312,.eje82312,.eje92312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos7").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos7").css("background-color", "#4d4d57");
		$(".eje7").css("width", "249px");
		$(".eje72").css("width", "1.5px");
		$(".eje72").css("height", "386px");

		setTimeout(function(){
			$(".eje723").css("width", "905px");
		},1000);

		$(".eje7231").css("height", "16px");
		$(".eje7232").css("height", "16px");
		$(".eje7233").css("height", "16px");
		$(".eje7234").css("height", "16px");
		$(".eje7235").css("height", "16px");
		$(".eje7236").css("height", "16px");
		$(".eje7237").css("height", "16px");
		$(".eje7238").css("height", "16px");
		$(".eje7239").css("height", "16px");
		$(".imgEje7").show(700);
		$(".imgEje7a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje5,.eje6,.eje8,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos8,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje52,.eje62,.eje82,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje523,.eje623,.eje823,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje5231,.eje6231,.eje8231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje5232,.eje6232,.eje8232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje5233,.eje6233,.eje8233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje5234,.eje6234,.eje8234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje5235,.eje6235,.eje8235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje5236,.eje6236,.eje8236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje5237,.eje6237,.eje8237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje5238,.eje6238,.eje8238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje5239,.eje6239,.eje8239,.eje9239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje52310,.eje62310,.eje82310,.eje92310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje52311,.eje62311,.eje82311,.eje92311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje52312,.eje62312,.eje82312,.eje92312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos8").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos8").css("background-color", "#4d4d57");
		$(".eje8").css("width", "310px");
		$(".eje82").css("width", "1.5px");
		$(".eje82").css("height", "439px");

		setTimeout(function(){
			$(".eje823").css("width", "905px");
		},1000);

		$(".eje8231").css("height", "16px");
		$(".eje8232").css("height", "16px");
		$(".eje8233").css("height", "16px");
		$(".eje8234").css("height", "16px");
		$(".eje8235").css("height", "16px");
		$(".eje8236").css("height", "16px");
		$(".eje8237").css("height", "16px");
		$(".imgEje8").show(700);
		$(".imgEje8a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje5,.eje6,.eje7,.eje9,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos7,.ejpos9,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje52,.eje62,.eje72,.eje92,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje523,.eje623,.eje723,.eje923,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje5231,.eje6231,.eje7231,.eje9231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje5232,.eje6232,.eje7232,.eje9232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje5233,.eje6233,.eje7233,.eje9233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje5234,.eje6234,.eje7234,.eje9234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje5235,.eje6235,.eje7235,.eje9235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje5236,.eje6236,.eje7236,.eje9236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje5237,.eje6237,.eje7237,.eje9237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje5238,.eje6238,.eje7238,.eje9238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje5239,.eje6239,.eje7239,.eje9239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje52310,.eje62310,.eje72310,.eje92310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje52311,.eje62311,.eje72311,.eje92311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje52312,.eje62312,.eje72312,.eje92312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos9").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos9").css("background-color", "#4d4d57");
		$(".eje9").css("width", "340px");
		$(".eje92").css("width", "1.5px");
		$(".eje92").css("height", "492px");

		setTimeout(function(){
			$(".eje923").css("width", "905px");
		},1000);

		$(".eje9231").css("height", "16px");
		$(".eje9232").css("height", "16px");
		$(".eje9233").css("height", "16px");
		$(".eje9234").css("height", "16px");
		$(".eje9235").css("height", "16px");
		$(".eje9236").css("height", "16px");
		$(".eje9237").css("height", "16px");
		$(".eje9238").css("height", "16px");
		$(".eje9239").css("height", "16px");
		$(".eje92310").css("height", "16px");
		$(".imgEje9").show(700);
		$(".imgEje9a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje5,.eje6,.eje7,.eje8,.eje10,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos7,.ejpos8,.ejpos10,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje52,.eje62,.eje72,.eje82,.eje102,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje523,.eje623,.eje723,.eje823,.eje1023,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje5231,.eje6231,.eje7231,.eje8231,.eje10231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje5232,.eje6232,.eje7232,.eje8232,.eje10232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje5233,.eje6233,.eje7233,.eje8233,.eje10233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje5234,.eje6234,.eje7234,.eje8234,.eje10234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje5235,.eje6235,.eje7235,.eje8235,.eje10235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje5236,.eje6236,.eje7236,.eje8236,.eje10236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje5237,.eje6237,.eje7237,.eje8237,.eje10237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje5238,.eje6238,.eje7238,.eje8238,.eje10238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje5239,.eje6239,.eje7239,.eje8239,.eje10239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje52310,.eje62310,.eje72310,.eje82310,.eje102310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje52311,.eje62311,.eje72311,.eje82311,.eje102311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje52312,.eje62312,.eje72312,.eje82312,.eje102312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje10,.imgEje10a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos10").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos10").css("background-color", "#4d4d57");
		$(".eje10").css("width", "462px");
		$(".eje102").css("width", "1.5px");
		$(".eje102").css("height", "545px");

		setTimeout(function(){
			$(".eje1023").css("width", "905px");
		},1000);

		$(".eje10231").css("height", "16px");
		$(".eje10232").css("height", "16px");
		$(".eje10233").css("height", "16px");
		$(".eje10234").css("height", "16px");
		$(".eje10235").css("height", "16px");
		$(".eje10236").css("height", "16px");
		$(".eje10237").css("height", "16px");
		$(".eje10238").css("height", "16px");
		$(".imgEje10").show(700);
		$(".imgEje10a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje5,.eje6,.eje7,.eje8,.eje9,.eje11").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos7,.ejpos8,.ejpos9,.ejpos11").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje52,.eje62,.eje72,.eje82,.eje92,.eje112").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje523,.eje623,.eje723,.eje823,.eje923,.eje1123").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje5231,.eje6231,.eje7231,.eje8231,.eje9231,.eje11231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje5232,.eje6232,.eje7232,.eje8232,.eje9232,.eje11232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje5233,.eje6233,.eje7233,.eje8233,.eje9233,.eje11233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje5234,.eje6234,.eje7234,.eje8234,.eje9234,.eje11234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje5235,.eje6235,.eje7235,.eje8235,.eje9235,.eje11235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje5236,.eje6236,.eje7236,.eje8236,.eje9236,.eje11236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje5237,.eje6237,.eje7237,.eje8237,.eje9237,.eje11237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje5238,.eje6238,.eje7238,.eje8238,.eje9238,.eje11238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje5239,.eje6239,.eje7239,.eje8239,.eje9239,.eje11239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje52310,.eje62310,.eje72310,.eje82310,.eje92310,.eje112310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje52311,.eje62311,.eje72311,.eje82311,.eje92311,.eje112311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje52312,.eje62312,.eje72312,.eje82312,.eje92312,.eje112312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje11,.imgEje11a").hide();

	}, function(){});

	$("p.ejpos11").hover(function()
	{
		//cambio
		reset_colors();
		return;
		// hasta aqui cambio
		$(".ejpos11").css("background-color", "#4d4d57");
		$(".eje11").css("width", "188px");
		$(".eje112").css("width", "1.5px");
		$(".eje112").css("height", "599px");

		setTimeout(function(){
			$(".eje1123").css("width", "905px");
		},1000);

		$(".eje11231").css("height", "16px");
		$(".eje11232").css("height", "16px");
		$(".eje11233").css("height", "16px");
		$(".eje11234").css("height", "16px");
		$(".eje11235").css("height", "16px");
		$(".eje11236").css("height", "16px");
		$(".eje11237").css("height", "16px");
		$(".eje11238").css("height", "16px");
		$(".eje11239").css("height", "16px");
		$(".eje112310").css("height", "16px");
		$(".eje112311").css("height", "16px");
		$(".eje112312").css("height", "16px");
		$(".imgEje11").show(700);
		$(".imgEje11a").show(2500);

		$(".eje1,.eje2,.eje3,.eje4,.eje5,.eje6,.eje7,.eje8,.eje9,.eje10").css("width", "0px");
		$(".ejpos1,.ejpos2,.ejpos3,.ejpos4,.ejpos5,.ejpos6,.ejpos7,.ejpos8,.ejpos9,.ejpos10").css("background-color", "#5a274f");
		$(".eje12,.eje22,.eje32,.eje42,.eje52,.eje62,.eje72,.eje82,.eje92,.eje102").css({"width": "0px","height": "0px"});
		$(".eje123,.eje223,.eje323,.eje423,.eje523,.eje623,.eje723,.eje823,.eje923,.eje1023").css("width", "0px");
		$(".eje1231,.eje2231,.eje3231,.eje4231,.eje5231,.eje6231,.eje7231,.eje8231,.eje9231,.eje10231").css("height", "0px");
		$(".eje1232,.eje2232,.eje3232,.eje4232,.eje5232,.eje6232,.eje7232,.eje8232,.eje9232,.eje10232").css("height", "0px");
		$(".eje1233,.eje2233,.eje3233,.eje4233,.eje5233,.eje6233,.eje7233,.eje8233,.eje9233,.eje10233").css("height", "0px");
		$(".eje1234,.eje2234,.eje3234,.eje4234,.eje5234,.eje6234,.eje7234,.eje8234,.eje9234,.eje10234").css("height", "0px");
		$(".eje1235,.eje2235,.eje3235,.eje4235,.eje5235,.eje6235,.eje7235,.eje8235,.eje9235,.eje10235").css("height", "0px");
		$(".eje1236,.eje2236,.eje3236,.eje4236,.eje5236,.eje6236,.eje7236,.eje8236,.eje9236,.eje10236").css("height", "0px");
		$(".eje1237,.eje2237,.eje3237,.eje4237,.eje5237,.eje6237,.eje7237,.eje8237,.eje9237,.eje10237").css("height", "0px");
		$(".eje1238,.eje2238,.eje3238,.eje4238,.eje5238,.eje6238,.eje7238,.eje8238,.eje9238,.eje10238").css("height", "0px");
		$(".eje1239,.eje2239,.eje3239,.eje4239,.eje5239,.eje6239,.eje7239,.eje8239,.eje9239,.eje10239").css("height", "0px");
		$(".eje12310,.eje22310,.eje32310,.eje42310,.eje52310,.eje62310,.eje72310,.eje82310,.eje92310,.eje102310").css("height", "0px");
		$(".eje12311,.eje22311,.eje32311,.eje42311,.eje52311,.eje62311,.eje72311,.eje82311,.eje92311,.eje102311").css("height", "0px");
		$(".eje12312,.eje22312,.eje32312,.eje42312,.eje52312,.eje62312,.eje72312,.eje82312,.eje92312,.eje102312").css("height", "0px");
		$(".imgEje1,.imgEje1a,.imgEje2,.imgEje2a,.imgEje3,.imgEje3a,.imgEje4,.imgEje4a,.imgEje5,.imgEje5a,.imgEje6,.imgEje6a,.imgEje7,.imgEje7a,.imgEje8,.imgEje8a,.imgEje9,.imgEje9a,.imgEje10,.imgEje10a").hide();

	}, function(){});

});

$( ".bolas" ).click(function() {
	// $('#eje_x').val($(this).data('eje_x'));
	// $('#eje_y').val($(this).data('eje_y'));
	// $('#area_responsable_modal').html($(this).data('area_responsable'));
	// $('#primero').click();
	//
	// $('#ex1').modal({
	//  closeExisting: false
	//  });
		 console.log('data');

});


function obtener_cruces(){
	$.ajax({
				 type: "POST",
				 url: "../source/controller/CrucesKPIController.php",
				 data : { da1 : 'da1', da2 : 'da2' }, // serializes the form's elements.
				 success: function(data)
				 {
					 if(data==0){
						 console.log('no data');
					 }else{
						 //ok
						 var obj = JSON.parse(data);
						 console.log(obj);
						 var cadena = "";
						 var cadena2 = "";
						
						 for (var i = 0; i < obj.length; i++) {
							 if(obj[i].Id_Area==obj[i].Id_AreaResponsable){
								 if(obj[i].comodin == 1){
									$(".bolax_"+obj[i].orden+".bolay_"+obj[i].idEje).addClass('bolas_3');
									
									cadena = "<a href='"+obj[i].liga+"' class='numeroArriba'>"+obj[i].total+"</a>"
									//$(".bolax_"+obj[i].orden+".bolay_"+obj[i].idEje).html("<a class='numeroArriba'>"+obj[i].total+"</a>"); 
									var cadena2 = "";
								 }
								 if(obj[i].comodin == 2){
									cadena2 = "<br><a href='"+obj[i].liga+"' class='numeroArribaHijo'>"+obj[i].total+"</a>"
								 }
								 $(".bolax_"+obj[i].orden+".bolay_"+obj[i].idEje).html(cadena+cadena2+"<div class='fontdatos' id='divDatos"+obj[i].orden+"E"+obj[i].idEje+"' style='border:.5px solid #5d2852;width:145px;height:auto;position:relative; display:none;top: -54px;left: 19px;'><br><div class='muestraData"+obj[i].orden+"E"+obj[i].idEje+"'></div><i onclick='cierraDiv2("+obj[i].orden+","+obj[i].idEje+");' class='cerrarDatos far fa-window-close'></i></div>"); 
								 
							 }else{
								 $(".bolax_"+obj[i].orden+".bolay_"+obj[i].idEje).addClass('bolas_2');
								 $(".bolax_"+obj[i].orden+".bolay_"+obj[i].idEje).html("<a href='"+obj[i].liga+"' style='opacity: .6;' class='numeroArriba2'>"+obj[i].total+"</a>  <div class='fontdatos' id='divDatos"+obj[i].orden+"E"+obj[i].idEje+"' style='border:.5px solid #5d2852;width:145px;height:auto;position:relative; display:none;top: -35px;left: 19px;'><br><div class='muestraData"+obj[i].orden+"E"+obj[i].idEje+"'></div><i onclick='cierraDiv2("+obj[i].orden+","+obj[i].idEje+");' class='cerrarDatos far fa-window-close'></i></div>");
								 //$(".bolax_"+obj[i].orden+".bolay_"+obj[i].idEje).html("<div style='border:1px solid red;width:60px;height:40px;position:relative; display:none'>prueba de div</div>");
								 
								 
								 
								 
							 }

							 $("#x_"+obj[i].orden+"_y_"+obj[i].idEje).data("area_responsable",obj[i].AreaResponsable);
							 $("#x_"+obj[i].orden+"_y_"+obj[i].idEje).data("eje_x",obj[i].orden);
							 $("#x_"+obj[i].orden+"_y_"+obj[i].idEje).data("eje_y",obj[i].idEje);
							 //txt = txt+"<tr style='cursor:pointer;'><td>"+obj[i].nombre+"</td><td>"+obj[i].paterno+"</td><td>"+obj[i].materno+"</td><td>"+obj[i].edad_c+"</td><td>"+obj[i].curp+"</td><td>"+obj[i].direccion+"</td><td>"+obj[i].municipio+"</td><td><a target='_blank' href='ficha_ciudadano.php?ciu="+obj[i].id+"'><i title='Generar ficha' class='ti-layout-list-thumb'></i></a></td></tr>";
							 console.log(obj[i]);
						 }
				 }
			 }
			 });
}

var actual_x = -1;
var actual_y = -1;

$(".bolas").hover(function()
{
	if(typeof($(this).data("eje_x")) != "undefined" && $(this).data("eje_x") !== null){
		console.log($(this).data("eje_x"));
		reset_colors();
		$(".ejey_"+$(this).data("eje_y")).css("background-color", "#ae96a6");
		$(".ejey_"+$(this).data("eje_y")).css("border", "1px solid #ae96a6");
		for(var i=0;i<$(this).data("eje_y");i++){
			$(".ejex_"+$(this).data("eje_x")+".ejey_"+i).css("background-color", "#a4c4cf");
			$(".ejex_"+$(this).data("eje_x")+".ejey_"+i).css("border", "1px solid #a4c4cf");
		}
		actual_x = $(this).data("eje_x");
		actual_y = $(this).data("eje_y");
		//cambiar los menus de fuera del iframe
		$(padre).find(".ejes").css("background-color","#4d4d57");
		$(padre).find(".notif").css("background-color","#4d4d57");
		$(padre).find("div#a"+actual_x).css("background-color","#0093a3");
		$(padre).find("p.nEje"+actual_y).css("background-color","#5d2852");
		$(".ejex_"+$(this).data("eje_x")+".ejey_"+$(this).data("eje_y")).css("background-color", "#6f7487");
		$(".ejex_"+$(this).data("eje_x")+".ejey_"+$(this).data("eje_y")).css("border", "1px solid #6f7487");

	}
	//cambio



	// hasta aqui cambio
	//cambio aqui


}, function(){});



function cambio_menu(item){
	$('.es_menu').css('display','none');
	$('.'+item).css('display','revert');
}

function setTitulo(obj,query){
	$("#titulo_tabla").html($(obj).data("titulo"));
		$.ajax({
					 type: "POST",
					 url: "../source/controller/CrucesController_"+query+".php",
					 data : { ejex : $('#eje_x').val(), ejey : $('#eje_y').val() }, // serializes the form's elements.
					 success: function(data)
					 {
						 if(data==0){
							 console.log('no data');
						 }else{

									$('#tabla_principal').html(data);
					 }
				 }
				 });

}

var padre = $(window.parent.document);


function pantalla(caso){
	if(caso=='asuntos'){
		$('.men').toggle();
		return true;
	}
	if(actual_x==-1 || actual_y==-1){
		//ok
	}else{
		console.log(caso);
		if(caso=='entregables'){
			window.location.href = 'https://www.siemuseo.com/sie/vista/indicadores/entregablesInsumos/index_cruces.php?idarea='+actual_y+'&ideje='+actual_x;
		}else if(caso=='avances'){
			window.location.href = 'https://www.siemuseo.com/sie/vista/apps/Planeacion/Index.php?idarea='+actual_y+'&ideje='+actual_x;
			//window.location.href = '/cruces/index.php?idarea='+actual_y+'&ideje='+actual_x+'&pantalla='+caso;

		}
	}
}

function acuerdos(){
  location.href='apps/AcuerdosEscritos/Vista.php?nombreUsuario=<?php echo $_GET['nombreUsuario']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&perfil=1&tipoPerfil=1';
}

function asuntos_enviados(){
  location.href='indicadores/asuntos/indexEnviados.php?idArea=<?php echo $_GET['idArea']; ?>&nombreArea=<?php echo $_GET['nombreArea']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&idAreaUsuario=<?php echo $_GET['idArea']; ?>&totalAsuntosEnv=0';
}

function avances(){
	//es duplicado
  location.href='apps/Planeacion/Index_cruces.php?nombreUsuario=<?php echo $_GET['nombreUsuario']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&perfil=1&tipoPerfil=1';
}

function opiniones(){
	//es duplicado
  location.href='indicadores/Opiniones/indicadores_opiniones_cruces.php?nombreUsuario=<?php echo $_GET['nombreUsuario']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&titulo=4&estatus=1&Periodo=Todos';
}

function aplicaciones(){
		//es duplicado
  location.href='aplicaciones_cruces.php?tipoPerfil=1&nombreUsuario=<?php echo $_GET['nombreUsuario']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>';
}

function asuntos_enviados_global(){
	location.href='indicadores/asuntos/indexGlobalEnviados.php?idArea=<?php echo $_GET['idArea']; ?>&nombreArea=<?php echo $_GET['nombreArea']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&idAreaUsuario=<?php echo $_GET['idArea']; ?>';
}
function kpis(){
	location.href='apps/Piezas/vista/indicadorMosaico/index_cruces.php?tipoPerfil=1&idUsuario=<?php echo $_GET['idUsuario']; ?>&nombreUsuario=<?php echo $_GET['nombreUsuario']; ?>&anio=2022&aplicacion=piezas&tipoAplicacion=1';
}
function presupuesto(){
	location.href='apps/SIEGBA/index_cruces.php?idusuario=<?php echo $_GET['nombreUsuario']; ?>&perfil=1nombreUsuario=<?php echo $_GET['nombreUsuario']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&perfil=1&tipoPerfil=1';
}
function asuntos_recibidos(){
	location.href='indicadores/asuntos/index.php?idArea=<?php echo $_GET['idArea']; ?>&nombreArea=<?php echo $_GET['nombreArea']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&idAreaUsuario=<?php echo $_GET['idArea']; ?>'
}

function asuntos_recibidos_global(){
	location.href='indicadores/asuntos/indexGlobal.php?idArea=<?php echo $_GET['idArea']; ?>&nombreArea=<?php echo $_GET['nombreArea']; ?>&idUsuario=<?php echo $_GET['idUsuario']; ?>&idAreaUsuario=<?php echo $_GET['idArea']; ?>'
}

<?php
	if(isset($_REQUEST['idarea']) && isset($_REQUEST['ideje'])){
		echo '

			$(".ejey_"+'.$_REQUEST['idarea'].').css("background-color", "#ae96a6");
			$(".ejey_"+'.$_REQUEST['idarea'].').css("border", "1px solid #ae96a6");
			for(var i=1;i<'.$_REQUEST['idarea'].';i++){
				$(".ejex_"+'.$_REQUEST['ideje'].'+".ejey_"+i).css("background-color", "#a4c4cf");
				$(".ejex_"+'.$_REQUEST['ideje'].'+".ejey_"+i).css("border", "1px solid #a4c4cf");
			}
			actual_x = '.$_REQUEST['ideje'].';
			actual_y = '.$_REQUEST['idarea'].';
			//cambiar los menus de fuera del iframe
			$(padre).find(".ejes").css("background-color","#4d4d57");
			$(padre).find(".notif").css("background-color","#4d4d57");
			$(padre).find("div#a"+actual_x).css("background-color","#0093a3");
			$(padre).find("p.nEje"+actual_y).css("background-color","#5d2852");
			$(".ejex_"+'.$_REQUEST['ideje'].'+".ejey_"+'.$_REQUEST['idarea'].').css("background-color", "#6f7487");
			$(".ejex_"+'.$_REQUEST['ideje'].'+".ejey_"+'.$_REQUEST['idarea'].').css("border", "1px solid #6f7487");

		';
	}
 ?>


 $(document).ready(function(){
   $("#h_asuntos").hover(function(){
     pantalla('asuntos');
     }, function(){
     pantalla('asuntos');
   });
 });

</script>
<style>
/* cambio descuadra todo */
* {
/*  box-sizing: border-box;*/
}

/* cambio quitar bordes */
div.cu {
	border: 1px solid #f4f4f4;
}
.lin{
	width:906px !important;
	height: 12px !important;
}
.linm{
	width:11.1111% !important
}
/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}
.column2 {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.displayDiv1{
	display: block !important;
}




</style>

<script>
function cierraDiv2(idArea,idEje)
{ 
	var idArea = idArea;
	var idEje = idEje;
	//$("#divDatos"+idArea).removeClass( "displayDiv1" );
	$("#divDatos"+idArea+"E"+idEje).toggleClass("cero");
}



function abreDiv(idArea,idEje)
{
	
	var idArea = idArea;
	var idEje = idEje;
	
	//$("#divDatos"+idArea).addClass("displayDiv1");
	
	$("#divDatos"+idArea+"E"+idEje).toggleClass("displayDiv1");
	
	$.post("kpiLista.php",{idArea:idArea,idEje:idEje}, function( data ) 
	{
		$(".muestraData"+idArea+"E"+idEje).html('');
		$(".muestraData"+idArea+"E"+idEje).html(data);	
	});
	
}



</script>
</html>
