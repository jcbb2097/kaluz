<!DOCTYPE html>
<html>
	<head>
		<title>Asuntos</title>
		<link rel="stylesheet" type="text/css" href="../Asuntos/libs/css/chat.css"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
		<!--<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>-->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<script src="https://use.fontawesome.com/779a643cc8.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

		<style>
			.btnNew{
				   /* position: absolute;
					top: -31px;
					left: 27px;
					width: 33px;
					background-color: #4d4d57;*/
					position: absolute;
    top: 35px;
    right: 200px;
    width: 33px;
    background-color: transparent;
			}

.btnREI {
	/*position: relative;
	top: -62px;
    left: 58px;¨*/
}

.btnPrimerF .active {

}

.botonEnc {
	/*background-color: #c2c1be;*/
	font-family: 'Muli', sans-serif;
	font-size: 11px !important;
	width: 90.81px;
	color:white;
	/*height: 24px;*/
	height: 30px;
	background-color: transparent;
	/*opacity: 0.5; */
	border: .3px solid black;
	border-bottom: transparent;

	display: grid;
    grid-template-columns: 15px auto 15px;
 	grid-template-rows: 15px 15px;
}

.botonEnc.active .par{
	/*background-color: #e9e7e6 !important;*/
	color:black;
}

.indEnc {
	grid-column: 3 / 4;
  	grid-row: 1 / 2;
  	justify-self: start;
}

.indEnc2 {
	grid-column: 2 / 3;
  	grid-row: 2 / 3;
  	justify-self: start;
}
.indEnc3 {
	grid-column: 2 / 3;
  	grid-row: 2 / 3;
  	justify-self: end;
}

#botonRecibidos.active{
	background-color: #d0ecac;
}

#botonEnviados.active{
	background-color: #ffffff;
	color:black;
}
#botonInvitados.active{
	background-color: #eadfba;
	color:black;
}

.botonEnc2 {
	font-family: 'Muli', sans-serif;
	font-size: 11px !important;
	width: 90.81px;
	height: 26px;
	color: black !important;

	/*opacity: 0.5; */
	background-color: transparent;
	display: flex;
    align-items: center;
    justify-content: center;
    border: .3px solid black;
}
.botonEnc2.active{
	/*opacity: 1.0;*/
	border: .4px solid #464456;
	border-style: dashed;
}
.botonEnc2.active .par{
	color:black !important;
}
.botonEnc2 p{
	color: black !important;
	opacity: 0.7;
}

.envC.active{
	background-color: #ffffff;
}
.recC.active{
	background-color: #d0ecac;
}
.invC.active{
	background-color: #eadfba;
}

			.tooltip2 {
  position: relative;
  display: inline-block;

}

.tooltip2 .tooltiptext2 {
  visibility: hidden;
    width: 68px;
    background-color: transparent;
    color: #fff;
    text-align: center;
    border-radius: 0px;
    padding: 1px 0;
    position: absolute;
    z-index: 1;
   top: -12px;
    left: -2px;
    font-family: 'Muli-Regular';
    font-size: 9px;
}


.tooltip2:hover .tooltiptext2 {
  visibility: visible;
}

.card266{
	width: 360px;
	height: 583px !important;
	display:flex;
	flex-direction: column;
}

.btnPro{
	left: -3px;
}

.btnSol{
	position: absolute !important;
    left: 65px;
}

.btnCon{
	position: absolute !important;
   left: 132px;
}

.btnSug{
	position: absolute !important;
    left: 199px;
}
.divIndicador {
	height: 52px;
	width: 100%;
	padding: 2px;
	display: grid;
    grid-template-columns: 28px 87px 28px 87px 28px 28px 28px 28px;
 	grid-template-rows: 50% 50%;
 	gap: 2px 2px;
 	background-color: #464456;
 	line-height: normal;

 	border-top: 1px solid yellow;
 	border-left: 1px solid yellow;
}

.ibloque {
	background-color: white;
	white-space: nowrap;
	font-family: 'Muli', sans-serif;
}
/*#bloqueT{
	width: 100%;
	grid-column: 1 / span 3;
  	grid-row: 1 / 2;
  	justify-self: center;
}*/
#ibloque1{
	grid-column: 1 / 2;
  	grid-row: 1 / 2;
  	white-space: normal;
  	text-align: center;
  	padding: 15% 0;
}
#ibloque2{
	grid-column: 1 / 2;
  	grid-row: 2 / 3;
}
#ibloque3{
	grid-column: 2 / 3;
  	grid-row: 1 / 2;
}
#ibloque4{
	grid-column: 2 / 3;
  	grid-row: 2 / 3;
}
#ibloque5{
	cursor: pointer;
	grid-column: 3 / 4;
  	grid-row: 1 / 3;
  	white-space: normal;
  	text-align: center;
  	padding: 30% 0;
}
#ibloque6{
	grid-column: 4 / 5;
  	grid-row: 1 / 2;
}
#ibloque7{
	grid-column: 4 / 5;
  	grid-row: 2 / 3;
}
#ibloque8{
	grid-column: 5 / 6;
  	grid-row: 1 / 2;
}
#ibloque9{
	grid-column: 5 / 6;
  	grid-row: 2 / 3;
  	white-space: normal;
  	text-align: center;
  	padding-top: 5px;
}
#ibloque10{
	grid-column: 6 / 9;
  	grid-row: 1 / 2;
}
#ibloque11{
	grid-column: 6 / 7;
  	grid-row: 2 / 3;
}
#ibloque12{
	grid-column: 7 / 8;
  	grid-row: 2 / 3;
}
#ibloque13{
	grid-column: 8 / 9;
  	grid-row: 2 / 3;
}
.actividad {
	width: 100%;
	font-size:8px;
	font-family: 'Muli', sans-serif;
	white-space: nowrap;
    word-break: keep-all;
	overflow: hidden;
    text-overflow: ellipsis;

}

.titulo {

	width: 100%;
	font-size:12px;
}

.divLinea{
    border: transparent;
    width: 100%;
    /*height: 89px;*/
	/*min-height: 78px;*/
    left: -1px;
    top: 0px;
    background-color: #464456;
	display: grid;
    align-items: center;
    padding-left: 5px;
    border-left: 1px solid yellow;
    border-bottom: 1px solid yellow;
    /*justify-content: center;*/
}


.contacts_body{
			/*padding:  0.75rem 0 !important;*/
			/*height: 583px;*/
			overflow-y: auto;
			/*white-space: nowrap;*/

		}

.contacts_body::-webkit-scrollbar {
    -webkit-appearance: none;
}

.contacts_body::-webkit-scrollbar:vertical {
    width:10px;
}

.contacts_body::-webkit-scrollbar-button:increment,.contacts_body::-webkit-scrollbar-button {
    display: none;
}

.contacts_body::-webkit-scrollbar:horizontal {
    height: 10px;
}

.contacts_body::-webkit-scrollbar-thumb {
    background-color: #797979;
    /*border-radius: 20px;
    border: 2px solid #f1f2f3;*/
	border-radius: 0px;
    border: 2px solid #464456;
}

.contacts_body::-webkit-scrollbar-track {
    border-radius: 10px;
}

.btnF1{
	left: 6px;
}

.btnF2{
	left: 3px;
	border-right: none;
    border-left: none;
}
.cardP{
			/*height: 500px;*/
			height: 583px;
			font-family: 'Muli', sans-serif;
			font-size: 11px;
			background-color: #e9e7e6 !important;
			/*width: 266px;*/
		}

.clDis{
	display: none;
}

.contenidoLi{
	cursor:pointer;
}

.contenidoLi:hover{
	background-color:#a9a9ae;
}

.par{
	font-family: 'Muli', sans-serif;
	font-size: 10px;
	grid-column: 2 / 3;
  	grid-row: 1 / 2;
	justify-self: center;

}
.par2{
	/*position: absolute;*/
    display: grid;
    grid-template-columns: 10px auto 10px;
 	grid-template-rows: 50% 50%;
}
.par3 {
	font-size:8px !important;
	grid-column: 2 / 3;
  	grid-row: 2 / 3;
  	justify-self: center;
}

.estatus {
	background-color: #007bff;
}
.img_cont{
	position: relative;
	width: 25px;
	display:grid;
	grid-template-columns: 10px auto;
 	grid-template-rows: 70% 30%;
}
.respCheck {
	padding-left: 4px;
	grid-column: 2 / 3;
	grid-row: 2 / 3;
}
.online_icon{
	/*position: absolute;*/
	height: 18px;
	width:18px;
	background-color: #4cd137;
	border-radius: 50%;
	bottom: 0.2em;
	right: 0.4em;
	border:1.5px solid black;
	grid-column: 2 / 3;
	grid-row: 1 / 2;
}
.blinkred {
  animation: blink-animation 2s steps(5, start) infinite;
  -webkit-animation: blink-animation 2s steps(5, start) infinite;
}
@keyframes blink-animation {
  to {
    border:2px solid purple;
  }
}
@-webkit-keyframes blink-animation {
  to {
    border:2px solid purple;
  }
}

.blinkyellow {
  animation: blink-animation2 2s steps(5, start) infinite;
  -webkit-animation: blink-animation2 2s steps(5, start) infinite;
}
@keyframes blink-animation2 {
  to {
    border:2px solid green;
  }
}
@-webkit-keyframes blink-animation2 {
  to {
    border:2px solid green;
  }
}

.b-blanco {
  animation: a-blanco1 2s steps(5, start) infinite;
  -webkit-animation: a-blanco1 2s steps(5, start) infinite;
}
.b-verde {
  animation: a-verde1 2s steps(5, start) infinite;
  -webkit-animation: a-verde1 2s steps(5, start) infinite;
}
.b-naranja {
  animation: a-naranja1 2s steps(5, start) infinite;
  -webkit-animation: a-naranja1 2s steps(5, start) infinite;
}
@keyframes a-blanco1 {
  to {
    border:3px solid white;
  }
}
@keyframes a-verde1 {
  to {
    border:3px solid green;
  }
}
@keyframes a-naranja1 {
  to {
    border:3px solid orange;
  }
}


.b-bv {
  animation: a-bv 2s steps(5, start) infinite;
  -webkit-animation: a-bv 2s steps(5, start) infinite;
}
.b-bn {
  animation: a-bn 2s steps(5, start) infinite;
  -webkit-animation: a-bn 2s steps(5, start) infinite;
}
.b-vn {
  animation: a-vn 2s steps(5, start) infinite;
  -webkit-animation: a-vn 2s steps(5, start) infinite;
}

.b-bvn {
  animation: a-bvn 2s steps(5, start) infinite;
  -webkit-animation: a-bvn 2s steps(5, start) infinite;
}

@keyframes a-bv {
  0% {border:3px solid white;}
  100% {border:3px solid green;}
}
@keyframes a-bn {
  0% {border:3px solid white;}
  100% {border:3px solid orange;}
}
@keyframes a-vn {
  0% {border:3px solid white;}
  100% {border:3px solid green;}
}
@keyframes a-bvn {
  0% {border:3px solid white;}
  50% {border:3px solid green;}
  100% {border:3px solid orange;}
}

.numerador {
	grid-column: 1 / 1;
	grid-row: 2 / 2;
}
.tipoM {
	font-size: 10px;
	padding-left: 2.5px;
	padding-top: 1.5px;
	grid-column: 2 / 2;
	grid-row: 1 / 1;
	color:white;
}
.per{
	position: absolute;
    font-size: 9px;
    top: -1px;
}
.inf1 {
	background-color: #c8f2ff;
	color: #31708f;
	font-size: 9px !important;
	font-family: 'Muli', sans-serif;
}
.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 5px;
		width: 301.5px;
	}
.user_info span{
		/*font-size: 16px;*/
		/*color: white;*/
	}


.filtros {
  height: 0;
  width: 100%;
  position: fixed;
  z-index: 15;
  top: 0;
  left: 0;
  background-color: #4d4d57;
  overflow-x: hidden;
  transition: 0.5s;
}

.filtros .closebtn {
	position: absolute;
	top: 5px;
	right: 10px;
	color: white !important;
	font-size: 15px;
	font-weight: 700;
	line-height: 1;
	text-shadow: 0 1px 0 #fff;
	opacity: .5;
	font-family: 'Muli', sans-serif;
	cursor: pointer;
	text-decoration: none;
}

@media screen and (max-height: 450px) {
  .filtros {padding-top: 15px;}
  .filtros a {font-size: 18px;}
}

.div {
	width: 30.27px;
    padding-top: 5px;
    margin: 0;
    border: .5px solid;
    height: 55px;
    border-color: #4d4d57;
    border-right-color: #646472;
    border-bottom-color: #646472;
    border-radius: 0px 0px 5px 5px;
    float: left;

}
.div2 {
	width: 60.54px;
    padding-top: 5px;
    margin: 0;
    border: .5px solid;
    height: 55px;
    border-color: #4d4d57;
    border-right-color: #646472;
    border-bottom-color: #646472;
    border-radius: 0px 0px 5px 5px;
    float: left;

}
.divCent {
	text-align: center;
	color: white;
	font-size: 10px;
	padding: 0px;
	margin:0px;
}
.pastilla {
	background-color: #713163;
	font-size:11px;
	cursor: pointer;
}

.toolF .tooltipF {
  visibility: hidden;
  width: 180px;
  background-color: black;
  color: #fff;
  font-size: 10px;
  text-align: left;
  border-radius: 6px;
  padding: 5px;

  /* Position the tooltip */
  position: absolute;
  top:30px;
  left: -100px;
  z-index: 1;
}

.toolF:hover .tooltipF {
  visibility: visible;
}

</style>
<style>
.headTam{
	/*min-height: 79px;*/
}
.cajaEI {
   background-color: #464456;
    z-index: 15;
}

.btnAll{
	/*background-color: transparent;
	/*border: .5px solid #9f9fa2;*/
	font-family: 'Muli-SemiBold';
    font-size: 10px !important;
    width: 60px;
}


.btnF{
	/*background-color: transparent;*/
	border: .5px solid #9f9fa2;
	font-family: 'Muli-SemiBold', sans-serif;
    font-size: 10px !important;
    border: 1px solid yellow;

}

.btnAll:hover{
	border: .5px solid #9f9fa2;
}

.btnAll.active{
		border: 1px solid #9f9fa2;
}
.msg_card_body {
	padding: 0px 4px 4px 4px;
	overflow-y: auto;
	background-color: #464456 !important;
	height: 100%;
	border-right: 1px solid yellow;
	border-bottom: 1px solid yellow;
	border-left: 1px solid yellow;
}

.msg_card_body::-webkit-scrollbar {
    -webkit-appearance: none;
}

.msg_card_body::-webkit-scrollbar:vertical {
    width:10px;
}

.msg_card_body::-webkit-scrollbar-button:increment,.msg_card_body::-webkit-scrollbar-button {
    display: none;
}

.msg_card_body::-webkit-scrollbar:horizontal {
    height: 10px;
}

.msg_card_body::-webkit-scrollbar-thumb {
    background-color: #797979;
    /*border-radius: 20px;
    border: 2px solid #f1f2f3;*/
	border-radius: 0px;
}

.msg_card_body::-webkit-scrollbar-track {
    border-radius: 10px;
}

.header {
	padding: 0px;
}
.type_msg{
	/*background-color: rgba(0,0,0,0.3) !important;*/
	border:1 !important;

	overflow-y: auto;
	/*height: 74px;
	min-height: 74px !important;*/
}
.type_msg:focus{
     box-shadow:none !important;
   outline:0px !important;
}
.controles{
	position: absolute;
    top: -31px;
    left: 60px;
    background-color: transparent;
}

.responder {
	padding: 2px 2px 2px 4px;
	background-color: #464456 !important;
	display: grid;
    grid-template-columns: 506.55px 30.15px;
 	grid-template-rows: 26px 26px;

}
.msj {
	/*margin-top: 2px;
	margin-bottom: 2px;*/
	padding: 5px 5px 5px 5px;
	display: grid;
	grid-template-columns: 100%;
 	grid-template-rows: auto 26px;
}

.fechaMsj {
	padding-top: 10px;
	grid-column: 1 / 2;
	grid-row: 2 / 3;
	text-align: right;
	/*align-self: end;*/
}

.msg_cotainer{
	/*margin-left: 10px;*/
	background-color: #d0ecac;

	position: relative;
	width: 100%;
	min-height: 78px;
	font-family: 'Muli', sans-serif;
	padding-right: 30.15px;
}
.msg_cotainer_invitado{
	/*margin-left: 10px;*/
	background-color: #eadfba;

	position: relative;
	width: 100%;
	min-height: 78px;
	font-family: 'Muli', sans-serif;
	padding-right: 30.15px;
}
.msg_cotainer_send{

	/*margin-right: 10px;*/
	/*background-color: #78e08f;*/
	background-color: #ffffff;

	position: relative;
    width: 100%;
    min-height: 78px;
    font-family: 'Muli', sans-serif;
    padding-right: 30.15px;
}

/*****Botones de la conversacion******/
#menuSide a {
  transition: 0.3s;
  width: 70px;
  text-decoration: none;
  font-size: 10px;
  color: white;
  border-radius: 5px 0 0 5px;
  z-index: 1;
}

#menuSide a:hover {
  right: 0;
}

#todos {
  top: 130px;
  background-color: #585066;
}

#principales {
  top: 160px;
  background-color: #585066;
}

#invitados {
  top: 190px;
  background-color: #585066;
}

#destacados {
  top: 220px;
  background-color: #585066
}
 .badge-ent {
            /*height: 26px;*/
            min-width: 25px;
            font-size:12px;
            padding: 6px;
            border-radius: 0px !important;
        }
.cuerpoCom {
  width: 100%;
  height: 380px;
  border: none;
}
</style>
	</head>

	<body>
		<div id="filtrosAsuntos" class="filtros">

			<div style="display:flex; position: relative; left:-3px;">
				<?php
					$texto='';
					$color='';
					$areaFiltro='';
					$contRojo=0;
					$contAmari=0;
					$contVerde=0;
					$rojos = array (array("","0"),array("","0"));
					$amarillos = array (array("","0"),array("","0"));
					if($this->opcion=='recibido'){$texto='Recibidos'; $color='#d0ecac';}
					if($this->opcion=='enviado'){$texto='Enviados'; $color='#ffffff';}
					if($this->opcion=='invitado'){$texto='Invitados'; $color='#eadfba';}
					if(isset($this->areas)) {
						foreach ($this->areas as $a) {
							if($a->getTipo()=='1') {
								$na='';
								$con='';
								$res='';
								if($a->getNA()!='0'){$na='color:red;'; $contRojo++;}
								if($a->getCon()!='0'){$con='color:yellow;'; $contAmari++;}
								if($a->getRes()!='0'){$res='color:#9dfb9d;'; $contVerde++;}
								echo '<div id="a1" class="div">'
									.'<p class="divCent" style="cursor:pointer; '.$na.'" onclick="filtrarArea('.$a->getIdArea().',1);">'.$a->getNA().'</p>'
									.'<p class="divCent" style="cursor:pointer; '.$con.'" onclick="filtrarArea('.$a->getIdArea().',2);">'.$a->getCon().'</p>'
									.'<p class="divCent" style="cursor:pointer; '.$res.'" onclick="filtrarArea('.$a->getIdArea().',3);">'.$a->getRes().'</p>'
									.'</div>';
									//<p class="divCent"><i class="fas fa-filter"></i></p>

								if($a->getIdArea() == $this->filtroa) {
									$areaFiltro = $a->getNombre();
								}
							} else if($a->getTipo()=='2'){

							}

							if($a->getNA()!='0' && $a->getNA()>$rojos[0][1]) {
								$rojos[0][0] = $a->getNombre(); $rojos[0][1] = $a->getNA();
							} else if($a->getNA()!='0' && $a->getNA()>$rojos[1][1]) {
								$rojos[1][0] = $a->getNombre(); $rojos[1][1] = $a->getNA();
							}
							if($a->getCon()!='0' && $a->getCon()>$amarillos[0][1]) {
								$amarillos[0][0] = $a->getNombre(); $amarillos[0][1] = $a->getCon();
							} else if($a->getCon()!='0' && $a->getCon()>$amarillos[1][1]) {
								$amarillos[1][0] = $a->getNombre(); $amarillos[1][1] = $a->getCon();
							}

						}
					}
					$embudo="";
					if($contRojo>0)$embudo="color:red !important;";
					else if($contAmari>0)$embudo="color:yellow !important;;";
					else if($contVerde>0)$embudo="color:#9dfb9d !important;;";
				?>
				<div class="div2">
					<p class="divCent" style="color:red; text-align: left !important;">NoAtendidos</p>
					<p class="divCent" style="color:yellow; text-align: left !important;">Conversacion</p>
					<p class="divCent" style="color:#9dfb9d; text-align: left !important;">Resueltos</p>
				</div>
			</div>
			<div class="divCent" style="position: relative; height: 26px; border: .5px solid; border-color: #4d4d57; color:<?php echo $color;?>;">
				<p><?php echo $texto.' de '.$this->indicador->getNombreArea() ;?></p>
			</div>
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="z-index: 20;">&times;</a>

		</div>
		<?php
			$tool = '';
			if($rojos[0][1]!='0')
				$tool = $rojos[0][0].': <span style="color:red;">'.$rojos[0][1].'</span><br>';
			if($rojos[1][1]!='0')
				$tool = $tool.$rojos[1][0].': <span style="color:red;">'.$rojos[1][1].'</span><br>';
			if($amarillos[0][1]!='0')
				$tool = $tool.$amarillos[0][0].': <span style="color:yellow;">'.$amarillos[0][1].'</span><br>';
			if($amarillos[1][1]!='0')
				$tool = $tool.$amarillos[1][0].': <span style="color:yellow;">'.$amarillos[1][1].'</span>';
		?>
		<span style="font-size:15px;cursor:pointer; position:absolute;top:5px; right: 100px; color:white; background-color: #4d4d57; width:30px; height:30px; text-align:center; border-radius: 5px 5px 0px 0px; padding-top:5px; <?php echo $embudo;?>" onclick="abrirFiltros()" class="toolF"><i class="fas fa-filter"></i>
			<span class="tooltipF"><?php echo $tool;?></span>
		</span>

		<div class="well2" style="font-family: 'Muli', sans-serif;">Asuntos
			<?php
			echo '/ '.$this->indicador->getNombreArea();
			if($this->ac == '10')echo' / Resueltos';
			if($this->idEje != '0')echo ' / <span class="badge pastilla" onclick="filtrarEje(0);"> Eje '.$this->idEje.' <i class="fas fa-times"></i></span>';
			if($areaFiltro!='') echo ' / <span class="badge pastilla" onclick="filtrarArea(0,0);">de: '.$areaFiltro.' <i class="fas fa-times"></i></span>';
			else if($this->indExt == '1') {
				echo ' / <a href="../../indicadores/focosAsuntos/focoProblematica.php?idArea='.$this->idArea.'&nombreArea='.$this->indicador->getNombreArea().'&idUsuario='.$this->idUsuario.'&idAreaUsuario='.$this->idAreaU.'&estatusIndicador='.$this->estInd.'">Volver a indicadores</a>';
			} else if($this->indExt == '2') {
				echo ' / <a href="../../indicadores/asuntos/index.php?idArea='.$this->idArea.'&nombreArea='.$this->indicador->getNombreArea().'&idUsuario='.$this->idUsuario.'&idAreaUsuario='.$this->idAreaU.'&estatusIndicador='.$this->estInd.'">Volver a indicadores</a>';
				//http://162.253.124.160/sie/vista/indicadores/asuntos/index.php?idArea=1&nombreArea=Direcci%C3%B3n&idUsuario=3&idAreaUsuario=5&estatus
			} else if($this->indExt == '3') {
				echo ' / <a href="../../indicadores/asuntos/indexGlobal.php?idArea='.$this->idArea.'&nombreArea='.$this->indicador->getNombreArea().'&idUsuario='.$this->idUsuario.'&idAreaUsuario='.$this->idAreaU.'&estatusIndicador='.$this->estInd.'">Volver a indicadores</a>';
			} else if($this->indExt == '11') {
				echo ' / <a href="../../indicadores/asuntos/indexEnviados.php?idArea='.$this->idArea.'&nombreArea='.$this->indicador->getNombreArea().'&idUsuario='.$this->idUsuario.'&idAreaUsuario='.$this->idAreaU.'&estatusIndicador='.$this->estInd.'">Volver a indicadores</a>';
			}
			else if($this->indExt == '12') {
				echo ' / <a href="../../indicadores/asuntos/indexGlobalEnviados.php?idArea='.$this->idArea.'&nombreArea='.$this->indicador->getNombreArea().'&idUsuario='.$this->idUsuario.'&idAreaUsuario='.$this->idAreaU.'&estatusIndicador='.$this->estInd.'">Volver a indicadores</a>';
			}
			?>
			<span style="float:right;" onclick="<?php if($this->ac == '10')echo'quitarResuelto(1)';else echo'quitarResuelto(10)'?>; "><?php if($this->ac == '10')echo'quitar';else echo'Resueltos %';?> </span>
		</div>

		<div class="container-fluid my-0 py-0">
			<div class="row" style="margin-bottom:0px; background-color: #464456;">
				<div class="col-12 px-0" style="display: flex;">
						<div id="botonRecibidos" class="botonEnc rounded-0 <?php if($this->opcion=='recibido')echo 'active';?>" style="" >
							<span class="par" onclick="cambiarOrigen('recibido');">Recibidos</span>
							<span class="badge badge-dark rounded-0 indEnc <?php if(($this->estatus=='0' && $this->opcion=='recibido' && $this->tipo == '0') || ($this->ac=='10' && $this->opcion=='recibido' && $this->tipo == '0')) echo 'estatus';?>" onclick="cambiarOrigen('recibido');"><?php echo $this->indicador->getRecibidos(); ?></span>
							<span class="badge badge-dark rounded-0 indEnc2 <?php if($this->estatus=='1' && $this->opcion=='recibido')echo 'estatus';?>" onclick="cambiarEstatus('recibido','1');"><i class="fas fa-envelope"></i> <?php echo $this->indicador->getNoAtendido1(); ?></span>
							<span class="badge badge-dark rounded-0 indEnc3 <?php if($this->estatus=='2' && $this->opcion=='recibido')echo 'estatus';?>" onclick="cambiarEstatus('recibido','2');"><i class="fas fa-envelope-open"></i> <?php echo $this->indicador->getConversacion1(); ?></span>
						</div>
						<div id="botonInvitados" class="botonEnc rounded-0 <?php if($this->opcion=='invitado')echo 'active';?>">
							<span class="par" onclick="cambiarOrigen('invitado');">Invitados</span>
							<span class="badge badge-dark rounded-0 indEnc <?php if(($this->estatus=='0' && $this->opcion=='invitado' && $this->tipo == '0') || ($this->ac=='10' && $this->opcion=='invitado' && $this->tipo == '0')) echo 'estatus';?>" onclick="cambiarOrigen('invitado');"><?php echo $this->indicador->getInvitados(); ?></span>
							<span class="badge badge-dark rounded-0 indEnc2 <?php if($this->estatus=='1' && $this->opcion=='invitado')echo 'estatus';?>" onclick="cambiarEstatus('invitado','1');"><i class="fas fa-envelope"></i> <?php echo $this->indicador->getNoAtendido2(); ?></span>
							<span class="badge badge-dark rounded-0 indEnc3 <?php if($this->estatus=='2' && $this->opcion=='invitado')echo 'estatus';?>" onclick="cambiarEstatus('invitado','2');"><i class="fas fa-envelope-open"></i> <?php echo $this->indicador->getConversacion2(); ?></span>
						</div>
						<div id="botonEnviados" class="botonEnc rounded-0 <?php if($this->opcion=='enviado')echo 'active';?>">
							<span class="par" onclick="cambiarOrigen('enviado');">Enviados</span>
							<span class="badge badge-dark rounded-0 indEnc <?php if(($this->estatus=='0' && $this->opcion=='enviado' && $this->tipo == '0') || ($this->ac=='10' && $this->opcion=='enviado' && $this->tipo == '0')) echo 'estatus';?>" onclick="cambiarOrigen('enviado');"><?php echo $this->indicador->getEnviados(); ?></span>
							<span class="badge badge-dark rounded-0 indEnc2 <?php if($this->estatus=='1' && $this->opcion=='enviado')echo 'estatus';?>" onclick="cambiarEstatus('enviado','1');"><i class="fas fa-envelope"></i> <?php echo $this->indicador->getNoAtendido3(); ?></span>
							<span class="badge badge-dark rounded-0 indEnc3 <?php if($this->estatus=='2' && $this->opcion=='enviado')echo 'estatus';?>" onclick="cambiarEstatus('enviado','2');"><i class="fas fa-envelope-open"></i> <?php echo $this->indicador->getConversacion3(); ?></span>
						</div>
				</div>
			</div>
			<?php
			$tipoA = '';
			$fondo = '';
			if($this->opcion=='enviado'){
				$tipoA = 'envC';
				$fondo = 'background-color: #ffffff;';
			}
			else if($this->opcion=='recibido'){
				$tipoA = 'recC';
				$fondo = 'background-color: #d0ecac;';}
			else if($this->opcion=='invitado'){
				$tipoA = 'invC';
				$fondo = 'background-color: #eadfba;';}
			if($this->tipo == '0')
					$auxTipo = $fondo;
			?>
			<div id="plano" class="row" style="width: 905px !important; ">
				<div class="card266 cardP mt-0 pt-0 mx-0 px-0 contacts_card rounded-0" style="">
					<?php
					if($this->idAreaU == 5){
					?>
					<button type="button" class="btn btn-sm rounded-0 mr-1 btnNew " onclick="nuevoAsunto();"><div class="tooltip2"><i style="font-size:18px;color: #fcfafc;" class="far fa-edit"></i><span class="tooltiptext2">redactar asunto</span></div></button>
					<?php
					}
					?>

					<div class="row">
						<div class="col-12">
							<div class="btn-group btn-group-sm special" role="group" aria-label="Basic example">
								<button type="button" class="btn rounded-0  botonEnc2 par2 <?php if($this->tipo=='4')echo 'active '; echo $tipoA;?>" style="<?php echo $auxTipo;  ?>" onclick="cambiarTipo(4);">
									<span class="par" style="color:red !important;">Problemática</span>
									<span class="badge badge-dark rounded-0 par3 mt-2 <?php if($this->tipo == '4') echo 'estatus';?>"><?php echo $this->indicador->getProblematica(); ?></span></button>
								<button type="button" class="btn rounded-0  botonEnc2 par2 <?php if($this->tipo=='1')echo 'active '; echo $tipoA;?>" style="<?php echo $auxTipo; ?>" onclick="cambiarTipo(1);">
									<span class="par">Solicitud</span>
									<span class="badge badge-dark rounded-0 par3 mt-2 <?php if($this->tipo == '1') echo 'estatus';?>"><?php echo $this->indicador->getSolicitud(); ?></span></button>
								<button type="button" class="btn rounded-0  botonEnc2 par2 <?php if($this->tipo=='2')echo 'active '; echo $tipoA;?>" style="<?php echo $auxTipo; ?>" onclick="cambiarTipo(2);">
									<span class="par">Conocimiento</span>
									<span class="badge badge-dark rounded-0 par3 mt-2 <?php if($this->tipo == '2') echo 'estatus';?>"><?php echo $this->indicador->getConocimiento(); ?></span></button>
								<button type="button" class="btn rounded-0  botonEnc2 par2 <?php if($this->tipo=='3')echo 'active '; echo $tipoA;?>" style="<?php echo $auxTipo; ?>" onclick="cambiarTipo(3);">
									<span class="par">Sugerencia</span>
									<span class="badge badge-dark rounded-0 par3 mt-2 <?php if($this->tipo == '3') echo 'estatus';?>"><?php echo $this->indicador->getSugerencia(); ?></span></button>
							</div>

						</div>
					</div>
					<div class="divIndicador">
						<!--<div id="bloqueT" class="ibloque">Indicadores</div>-->
						<div id="ibloque1" class="ibloque"></div>
						<div id="ibloque2" class="ibloque"></div>
						<div id="ibloque3" class="ibloque"></div>
						<div id="ibloque4" class="ibloque"></div>
						<div id="ibloque5" class="ibloque" onclick="abrirEntregables('0');"></div>
						<div id="ibloque6" class="ibloque" onclick="abrirEntregables('1');"></div>
						<div id="ibloque7" class="ibloque" onclick="abrirEntregables('2');"></div>
						<div id="ibloque8" class="ibloque"></div>
						<div id="ibloque9" class="ibloque">
							<i class="fas fa-users" onclick="abrirInvitados();" style="cursor: pointer;"></i><br>
							<?php //if($this -> asunto->getEstatus()!='3' && $this -> idArea == $this -> idAreaU && $this -> opcion == 'invitado') { ?>
								 <!--<i class="fas fa-door-open" onclick="salirAsunto(<?php //echo $this->idConversacion;?>);" style="cursor: pointer;"></i>-->
							<?php// } ?>
						</div>
						<div id="ibloque10" class="ibloque"></div>
						<div id="ibloque11" class="ibloque toolF" style="cursor:pointer;">
							<i class="far fa-folder-open" style="position:relative; top:2px; left:4px; font-size:20px;\"></i><span id="compartidosN" class="badge badge-dark" style="position:relative; top:2px; left:-10px; z-index:2;">0</span>

							<span class="tooltipF" style="position:relative !important;">Archivos compartidos</span>

						</div>
						<div id="ibloque12" class="ibloque toolF" style="cursor:pointer;">
							<i class="fas fa-folder-open" style="position:relative; top:2px; left:4px; font-size:20px;\"></i><span id="normativosN" class="badge badge-light" style="position:relative; top:2px; left:-10px; z-index:2;">0</span>
							<span class="tooltipF" style="position:relative !important;">Archivos de normatividad</span>
						</div>
						<div id="ibloque13" class="ibloque"></div>
					</div>
					<div class="divLinea"></div>
					<div class="contacts_body" style="<?php echo $fondo;?>">
						<ui class="contacts">
							<?php
								if(isset($this->asuntos)) {
									$rId = "";
									$i = 0;
									//echo $this->asuntos;
									//echo sizeof($this->asuntos).',';
									foreach ($this->asuntos as $cnv) {
										if($rId != $cnv -> getIdConversacion()) {
											$negrita = '';
											$online = '';
											$estatus = $cnv->getEstatus();
											$numero = '';
											$auxYellow = '';
											//if($cnv->getTipo()=='4') {
											if($estatus == '1') {
												$online = "redOnline";
											} else if($estatus == '2') {
												$online = "yellowOnline";
												$auxYellow = 'style="color:black !important;"';
											} else if($estatus == '3' || $estatus == '4') {
												$online = "offline";
											}
											//}
											if($estatus == '1') {
												$negrita = 'font-family: \'Muli-Bold\', sans-serif !important; font-weight: bold; text-decoration: underline;';
											} else if($estatus == '2') {
												$negrita = 'font-family: \'Muli-Regular\', sans-serif !important;';
											} else if($estatus == '3') {
												$online = "offline";
											} else {
												$negrita = 'font-family: \'Muli-Regular\', sans-serif !important;';
											}
											$tipoCnv='';
											//if($this->tipo=='0') {
												if($cnv->getTipo()=='1') {
													$tipoCnv='So';
												} else if($cnv->getTipo()=='2') {
													$tipoCnv='Co';
												} else if($cnv->getTipo()=='3') {
													$tipoCnv='Su';
												} else if($cnv->getTipo()=='4') {
													$tipoCnv='Pr';
												}
											//}

											/*if($cnv->getNumero()>=1 ) {
												$numero = '<span style="font-size:9px;    position: relative;right: 208px;top: 10px;" class="badge badge-pill badge-danger float-right">'.$cnv->getNumero().'</span>';
											} */
											$check ="";
											if($cnv->getNumero()>=1 && $cnv->getNumero2()>=1 && $cnv->getNumero3()>=1) {
												$numero='b-bvn';
											} else if($cnv->getNumero()>=1 && $cnv->getNumero2()>=1) {
												$numero='b-bv';
											} else if($cnv->getNumero()>=1 && $cnv->getNumero3()>=1) {
												$numero='b-bn';
											} else if($cnv->getNumero2()>=1 && $cnv->getNumero3()>=1) {
												$numero='b-vn';
											} else if($cnv->getNumero()>=1) {
												$numero='b-blanco';
											} else if($cnv->getNumero2()>=1) {
												$numero='b-verde';
											} else if($cnv->getNumero3()>=1) {
												$numero='b-naranja';
											} else {
												$check ='<i class="fas fa-check"></i>';
											}


											$marcador="";
											if($this->opcion == 'recibido') {
												$marcador = $cnv->getIdOrigen();
											} else if($this->opcion == 'enviado') {
												$marcador = $cnv->getIdDestino();
											}


											$hoy = date('Y-m-d');
											$diasInactivo = date_diff(date_create($cnv->getFechaRespuesta()), date_create($hoy));
											//alfonso 04 11 21
											$diasInactivo_emisor = date_diff(date_create($cnv->getFechaResEmisor()), date_create($hoy));
											$diasInactivo_receptor = date_diff(date_create($cnv->getFechaResReceptor()), date_create($hoy));
											$diasInactivo_emisor = $diasInactivo_emisor->format(' %a');
											if($diasInactivo_emisor > 3)
												$diasInactivo_emisor = "Inact E<span style='color: #da5930'>".$diasInactivo_emisor."</span>";
											else
												$diasInactivo_emisor = "Inact E<span style='color: #9ce336'>".$diasInactivo_emisor."</span>";

											$diasInactivo_receptor = $diasInactivo_receptor->format(' %a');
											if($diasInactivo_receptor > 3)
													$diasInactivo_receptor = " R<span style='color: #da5930'>".$diasInactivo_receptor."</span>";
												else
													$diasInactivo_receptor = " R<span style='color: #9ce336'>".$diasInactivo_receptor."</span>";


											$diasAbierto = date_diff(date_create($cnv->getFechaInicio()),date_create($hoy));
											$fecha = explode(' ', $cnv->getFechaRespuesta());

											echo '<li id="cn'.$cnv->getIdConversacion().'" class="contenidoLi li'.$i.'" inactivo="'.$diasInactivo_emisor.$diasInactivo_receptor.'" abierto="'.$diasAbierto->format(' %a días abierto').'"><div class="d-flex bd-highlight" onclick="abrirDialogo('.$cnv->getIdConversacion().','.$marcador.');" >';
											echo '<div class="img_cont"><span id="blink" class="online_icon '.$online.' '.$numero.'"></span><span class="tipoM" '.$auxYellow.'><b>'.$tipoCnv.'</b></span><span class="numerador">'.($i+1).'</span><span class="respCheck">'.$check.'</span></div>';
											echo '<div class="user_info">';
											echo '<span class="badge badge-info inf1">'.$cnv->getOrigen().' ('.$cnv->getIdUsuarioOrigen().') para: '.$cnv->getDestino().' ('.$cnv->getIdUsuarioDestino().')'.'</span><br>';
											echo '<div class="actividad">'.$cnv->getActividad().'</div>';
											echo '<div class="actividad">'.$cnv->getExpo().'</div>';
											echo '<div class="titulo" style="'.$negrita.'" >'.$cnv->getTitulo().'</div>'.$fecha[0].'<br></div>';
											echo '</div></li>';
											$rId = $cnv -> getIdConversacion();
											$i++;
										}

									}
								}
							?>
						</ui>
					</div>
				</div>


				<div style="position: absolute;left: 360px; width: 545px;" id="bloqueConversacion" class=" mx-0 px-0 chat">

					<div class="card cardP mx-0 px-0 rounded-0">

					</div>
				</div>
			</div>
		</div>
<script type="text/javascript">

	$(document).ready(function() {
        <?php
        	if($this->nuevo == '1') {
        		if ($this->idArea == $this->idAreaU) {
        ?>
        			$.post("index.php",{ac:'2', idUsuario:'<?php echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>',anio:'<?php echo $this->anio; ?>',tipo:'<?php echo $this->tipo; ?>',opcion:'<?php echo $this->opcion; ?>',idEje:'<?php echo $this->idEje; ?>',idAreaU:'<?php echo $this->idAreaU;?>'}, function( data ){
						$( "#plano" ).html(data);
						$.getScript( "libs/js/funcionesRegistrar.js", function( data, textStatus, jqxhr) {
				        });
			    	});
        <?php } else { ?>
        			alert("No perteneces a esta área");
        <?php
        		}
        	} else if(isset($this->idConversacion)) {
        ?>
				$.post("indexAct.php",{action:'mensajes',idConversacion:'<?php echo $this->idConversacion; ?>',idUsuario:'<?php echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>', anio:'<?php echo $this->anio; ?>',tipo:'<?php echo $this->tipo; ?>',estatus:'<?php echo $this->estatus; ?>',opcion:'<?php echo $this->opcion; ?>',idEje:'<?php echo $this->idEje; ?>',idAreaU:'<?php echo $this -> idAreaU; ?>',ind:'<?php echo $this-> indExt;?>',filtroa:'<?php echo $this-> filtroa;?>'}, function( data ) {
		    		$( "#bloqueConversacion" ).html(data);
		    		var ina = document.getElementById("cn<?php echo $this->idConversacion; ?>").getAttribute("inactivo");
					var ab = document.getElementById("cn<?php echo $this->idConversacion; ?>").getAttribute("abierto");
		    		$("#ibloque3").html(ab+'<br>'+ina);
					//$("#ibloque4").html(ina);
		    		$.getScript( "libs/js/chat.js", function( data, textStatus, jqxhr) {
			        });
		    	});
		<?php } ?>
    });

	function abrirDialogo(idConversacion,idOrigen) {
		$.post("indexAct.php",{action:'mensajes',idConversacion:idConversacion,idUsuario:'<?php echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>', anio:'<?php echo $this->anio; ?>',tipo:'<?php echo $this->tipo; ?>',estatus:'<?php echo $this->estatus; ?>',opcion:'<?php echo $this->opcion; ?>',idEje:'<?php echo $this->idEje; ?>',idAreaU:'<?php echo $this->idAreaU;?>',ind:'<?php echo $this-> indExt;?>',filtroa:'<?php echo $this-> filtroa;?>'}, function( data ) {
    		$( "#bloqueConversacion" ).html(data);

			var ina = document.getElementById("cn"+idConversacion).getAttribute("inactivo");
			var ab = document.getElementById("cn"+idConversacion).getAttribute("abierto");
    		//$("#ibloque1").html(ab);
			//$("#ibloque4").html(ina);
			$("#ibloque3").html(ab+'<br>'+ina);
    		$.getScript( "libs/js/chat.js", function( data, textStatus, jqxhr) {
	        });
    	});

		var padre = $(window.parent.document);
		var idAreaEnvia = idOrigen;
		var i= 0;
		for(i=0; i <= 28; i++){
			if(i == idAreaEnvia){
				$(padre).find("div#a"+idAreaEnvia).removeClass("gyhg");
				$(padre).find("div#a"+idAreaEnvia).addClass("gyh");
			}else{
				$(padre).find("div#a"+[i]).removeClass("gyh");
			}

		}
	}

	function nuevoAsunto() {
		<?php if ($this->idArea == $this->idAreaU) { ?>
		$.post("index.php",{ac:'2', idUsuario:'<?php echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>',anio:'<?php echo $this->anio; ?>',tipo:'<?php echo $this->tipo; ?>',opcion:'<?php echo $this->opcion; ?>',idEje:'<?php echo $this->idEje; ?>',idAreaU:'<?php echo $this->idAreaU;?>'}, function( data ){
			$( "#plano" ).html(data);
			$.getScript( "libs/js/funcionesRegistrar.js", function( data, textStatus, jqxhr) {
	        });
    	});
    	<?php } else { ?>
    		alert("No perteneces a ésta área");
    	<?php } ?>
	}
	function quitarResuelto(opcion) {
		location.replace("index.php?ac="+opcion+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=<?php echo $this->tipo;?>&opcion=<?php echo $this->opcion;?>&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU; ?>");
	}
	function cambiarOrigen(opcion) {
		var ac="<?php echo $this->ac;?>";
		if("<?php echo $this->ac;?>"!="10" && "<?php echo $this->ac;?>"!="1") {
			ac="1";
		}
		location.replace("index.php?ac="+ac+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=0&opcion="+opcion+"&estatus=0&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU; ?>");
		/*$.post("index.php",{ac:'1', idUsuario:'<?php //echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>',anio:'<?php //echo $this->anio; ?>',tipo:'1',opcion:opcion,idEje:'<?php //echo $this->idEje; ?>'}, function( data ){

			document.getElementsByTagName('html')[0].innerHTML = data;
    	});*/
    	//alert("<?php //echo $this->opcion; ?>");
	}
	function cambiarEstatus(origen,opcion) {
		var ac="<?php echo $this->ac;?>";
		if("<?php echo $this->ac;?>"!="10" && "<?php echo $this->ac;?>"!="1") {
			ac="1";
		}
		location.replace("index.php?ac="+ac+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=0&opcion="+origen+"&estatus="+opcion+"&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU; ?>");
	}

	function cambiarTipo(tipo) {
		var ac="<?php echo $this->ac;?>";
		if("<?php echo $this->ac;?>"!="10" && "<?php echo $this->ac;?>"!="1") {
			ac="1";
		}
		location.replace("index.php?ac="+ac+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo="+tipo+"&opcion=<?php echo $this->opcion;?>&estatus=<?php echo $this->estatus;?>&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU;?>");
	}
	function filtrarEje(idEje) {
		var ac="<?php echo $this->ac;?>";
		if("<?php echo $this->ac;?>"!="10" && "<?php echo $this->ac;?>"!="1") {ac="1";}
		location.replace("index.php?ac="+ac+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=0&opcion=<?php echo $this->opcion;?>&estatus=<?php echo $this->estatus; ?>&idEje="+idEje+"&idAreaU=<?php echo $this->idAreaU; ?>&filtroa=<?php echo $this->filtroa; ?>");
	}
	function filtrarArea(idArea,estatus) {
		var ac="<?php echo $this->ac;?>";
		if("<?php echo $this->ac;?>"!="10" && "<?php echo $this->ac;?>"!="1") {
			ac="1";
		}
		location.replace("index.php?ac="+ac+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=0&opcion=<?php echo $this->opcion;?>&estatus="+estatus+"&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU; ?>&filtroa="+idArea);
	}

	function terminarAsunto(idCnv) {
		//alert(idCnv);
		$.confirm({
			title: 'Confirmación',
			content: '¿Desea terminar el asunto?',
			autoClose: 'cancelar|8000',
			type: 'dark',
			typeAnimated: true,
			buttons: {
				aceptar: {
					btnClass: 'btn-dark',
					action: function() {
						<?php
							if(isset($this->asunto)) {
								if($this->idArea == $this->asunto->getIdOrigen()) {
						?>
						location.replace("index.php?ac=6&idConversacion="+idCnv+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=<?php echo $this->tipo; ?>&opcion=<?php echo $this->opcion;?>&estatus=<?php echo $this->estatus;?>&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU;?>");

						<?php 	} else { ?>
							$.alert('No puedes terminar el Asunto, no perteneces al área');
						<?php }
							}
						?>
					}
				},
				cancelar: function() {
					$.alert('Cancelado!');
				}
			}
		});
	}

	function salirAsunto(idCnv) {
    	$.confirm({
			title: 'Confirmación',
			content: '¿Desea salir del asunto?',
			autoClose: 'cancelar|8000',
			type: 'dark',
			typeAnimated: true,
			buttons: {
				aceptar: {
					btnClass: 'btn-dark',
					action: function() {
						<?php
							if(isset($this->asunto)) {
								if($this -> idArea == $this -> idAreaU) {
						?>
						location.replace("index.php?ac=7&idConversacion="+idCnv+"&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=<?php echo $this->tipo; ?>&opcion=<?php echo $this->opcion;?>&idEje=<?php echo $this->idEje; ?>&idAreaU=<?php echo $this->idAreaU;?>");

						<?php 	} else { ?>
							$.alert('No puedes salir del Asunto, no perteneces a ésta área');
						<?php
							}
						}
						?>
					}
				},
				cancelar: function() {
					$.alert('Cancelado!');
				}
			}
		});
  	}

	$(document).ready(function() {
        var contador = <?php echo $i;?>;
		console.log(contador);

		<?php
			if(isset($this->idConversacion)) {
				?>
				var contenido = $("#cn<?php echo $this->idConversacion;?>").html();
				$(".divLinea").html(contenido);
				$(".divLinea").css("color","white");
				$('li').removeClass('active');
		        $("#cn<?php echo $this->idConversacion;?>").addClass('active');
				$('li').removeClass('clDis');
				$("#cn<?php echo $this->idConversacion;?>").addClass('clDis');
				<?php
			} else if(isset($this->asuntos[0])) {
				?>
				var contenido = $("#cn<?php echo $this->asuntos[0]->getIdConversacion();?>").html();
				$(".divLinea").html(contenido);
				$(".divLinea").css("color","white");
				$('li').removeClass('active');
		        $("#cn<?php echo $this->asuntos[0]->getIdConversacion();?>").addClass('active');
				$('li').removeClass('clDis');
				$("#cn<?php echo $this->asuntos[0]->getIdConversacion();?>").addClass('clDis');
				<?php
			}
		?>

	 	$(".contenidoLi").click(function(){
		    var info = $(this).html();
		    $(".divLinea").html(info);
			$(".divLinea").css("color","white");
		});

		var r = 0;
		for(r;r<contador;r++)
		{

			$(".li"+r).click(function(){

			g = r+1;

			for(g;g<contador;g++){

			}

		});


		}

    });



function areaEnvia(idAreaEnvia){
	var padre = $(window.parent.document);
	var idAreaEnvia = idAreaEnvia;
	$(padre).find("div#a"+idAreaEnvia).css("background-color","#0093a3");
}

function abrirFiltros() {
	document.getElementById("filtrosAsuntos").style.height = "648px";
}
function closeNav() {
  document.getElementById("filtrosAsuntos").style.height = "0";
}

console.log("ntro a socket");

//$.get("http://162.253.124.160:3000/actualizaContadoresAsuntos");
let idArea = <?php echo $this->idArea; ?>;
console.log("******="+idArea);
$.get("https://peaceful-reaches-15276.herokuapp.com/actualizaContadoresAsuntos?idArea="+idArea);
//$.get("https://162.253.124.160/actualizaContadoresAsuntos?idArea="+idArea);
$(document).ready(function(){

$('#action_menu_btn').click(function(){
	$('.action_menu').toggle();
});


	$('li').click(function(e) {
	        e.preventDefault();
	        $('li').removeClass('active');
	        $(this).addClass('active');
			$('li').removeClass('clDis');
			$(this).addClass('clDis');
	});

	$('#enviar').click(function() {
        $(this).closest('form').submit();
        // Will also work, but might fail if nesting is changed:
        // $(this).parent().submit();
    });
});
</script>
</body>
</html>
