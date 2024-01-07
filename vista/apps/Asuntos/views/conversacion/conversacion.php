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
<form name="formM" method="post" action="index.php?ac=4" >
	<div class="card cardP mx-0 px-0 rounded-0 py-0 my-0 border-0" >
		<div class="header">
			
			
			<div class="row">
				<div class="col-12">
					<div style="top: -30px;position:absolute;left: 24px;" class="btn-group btn-group-sm" role="group"  aria-label="Basic example">
						<!--<button type="button" class="btnAll btnAct5 btn btn-panel rounded-0 mr-1" onclick="abrirEntregables();">I-E</button>-->

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div style="" class="btn-group btn-group-sm" role="group"  aria-label="Basic example">
						<button type="button" class="btnF btnAct1 btn btn-panel rounded-0 mr-1 active" onclick="filtrarM(1);">Todos</button>
						<button type="button" class="btnF btnAct2 btn btn-panel rounded-0 mr-1" onclick="filtrarM(2);">Directos</button>
						<button type="button" class="btnF btnAct3 btn btn-panel rounded-0 mr-1" onclick="filtrarM(3);">Invitados</button>
						<!--<button type="button" class="btnF btnAct4 btn btn-panel rounded-0 mr-1" onclick="filtrarM(4);">D</button>-->
					</div>
				</div>
			</div>
					<div class="responder" style="border-left: 1px solid yellow; border-right: 1px solid yellow; border-top: 1px solid yellow;">
					<?php if($this -> asunto->getEstatus()!='3' && $this -> idArea == $this -> idAreaU) { ?>
						
						<textarea name="mensaje" class="form-control type_msg" placeholder="Responde..." style="font-size: 12px; font-family: 'Muli', sans-serif; border-radius: 0px; grid-column: 1 / 2; grid-row: 1 / 3;" maxlength ="600"></textarea>

						<span id="enviar2" class="send_btn rounded-0 bg-info" style="width: 30.15px !important;  padding-left: 5px;  font-size: 20px; grid-column: 2 / 3; grid-row: 1 / 2;"><i class="fas fa-location-arrow"></i></span>
						
						<span class="input-group-text rounded-0" style="width: 30.15px !important;  grid-column: 2 / 3; grid-row: 2 / 3; padding-left: 7px; font-size: 15px;"><i class="fas fa-paperclip" ></i>
						</span>
						<!--<div id="menuSide" class="sideButtons" style=" grid-column: 3 / 4; grid-row: 1 / 4; ">
							<a href="#" id="todos">T</a>
							<a href="#" id="principales">P</a>
							<a href="#" id="invitados">I</a>
							<a href="#" id="destacados">D</a>
						</div>-->
						
					<?php } ?>
					</div>
			<div class="" style="">
				<div>
					<!--<span class="online_icon"></span>-->
					<input type="hidden" name="idConversacion" value="<?php echo $this->idConversacion; ?>">
					<input type="hidden" name="idUsuario" value="<?php echo $this->idUsuario; ?>">
					<input type="hidden" name="idArea" value="<?php echo $this->idArea; ?>">
					<input type="hidden" name="tipo" value="<?php echo $this->tipo; ?>">
					<input type="hidden" name="estatus" value="<?php echo $this->estatus; ?>">
					<input type="hidden" name="opcion" value="<?php echo $this->opcion; ?>">
					<input type="hidden" name="anio" value="<?php echo $this->anio; ?>">
					<input type="hidden" name="idEje" value="<?php echo $this->idEje; ?>">
					<input type="hidden" name="idAreaU" value="<?php echo $this->idAreaU; ?>">
					<input type="hidden" name="ind" value="<?php echo $this->indExt; ?>">
					<input type="hidden" name="filtroa" value="<?php echo $this->filtroa; ?>">
				</div>
				<div class="user_info2">
					<?php 
					/*$numero="";
					if(isset($this->mensajes)) {
						$numero = sizeof($this->mensajes);
					}
					echo '<p style="margin-bottom:0rem;">';
					echo 'Actividad: ';
					if($this->actividades[4]->getId() != '0') {
						echo $this->actividades[0]->getOrden().'.'.$this->actividades[1]->getOrden().'.'.$this->actividades[2]->getOrden().'.'.$this->actividades[3]->getOrden().'.'.$this->actividades[4]->getOrden().' '.$this->actividades[4]->getNombre();
					} else if($this->actividades[3]->getId() != '0') {
						echo $this->actividades[0]->getOrden().'.'.$this->actividades[1]->getOrden().'.'.$this->actividades[2]->getOrden().'.'.$this->actividades[3]->getOrden().' '.$this->actividades[3]->getNombre();
					} else if($this->actividades[2]->getId() != '0') {
						echo $this->actividades[0]->getOrden().'.'.$this->actividades[1]->getOrden().'.'.$this->actividades[2]->getOrden().' '.$this->actividades[2]->getNombre();
					} else {
						echo $this->actividades[0]->getOrden().'.'.$this->actividades[1]->getOrden().' '.$this->actividades[1]->getNombre();
					}
					echo '<br>';
					echo $numero.' mensajes.</p>';*/
					?>
				</div>
			</div>
			<!--<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
			<div class="action_menu">
				<ul>
					<li id="inv"><i class="fas fa-users"></i></li>
				
					<li><i class="fas fa-ban"></i> </li>
				</ul>
			</div>-->
			<div id="cajaEI" class="cajaEI" style="display: none; z-index: 10; border-left: 1px solid yellow; border-right: 1px solid yellow;">
			</div>
			<div id="cajaI" class="cajaI" style="display: none; z-index: 10; border-left: 1px solid yellow; border-right: 1px solid yellow;">
			</div>
		</div>
		

		<div id="caja" class=" msg_card_body">
			
			<?php
				foreach ($this->mensajes as $ms) {
					
					/*if($ms->getIndice()>=2) {
						echo '<div class="d-flex justify-content-end mb-4">';
					} else {
						echo '<div class="d-flex justify-content-start mb-4">';
					}*/
					$indice = $ms->getIndice();
					echo '<div class="rounded-0" style="padding-top:2px;">';
					/*if($ms->getIdArea()==$this->idArea) {
						echo '<div class="rounded-0" style="padding-top:2px;">';
					} else {
						echo '<div class="mb-1 rounded-0">';
					}*/
					if($indice==1) {
						echo '<div class="msj envM  msg_cotainer_send rounded-0">';
					} else if($indice==2) {
						echo '<div class="msj recM msg_cotainer rounded-0">';
					} else {
						echo '<div class="msj invM msg_cotainer_invitado rounded-0">';
					}
					echo '';
					echo $ms -> getUsuario().' ('.$ms->getArea().')<br>';
					echo $ms -> getRespuesta().'<p style="float:right;" class="fechaMsj">'.$ms->getFecha().'</p>';
					echo '</div></div>';
				} 
			?>
		</div>
		<div id="modalCom" class="modal fade"  role="dialog">
			<div class="modal-dialog modal-lg" style="max-width:800px !important;">
			    <!-- Modal content-->
			    <div class="modal-content modal-lg" style="width:100%;">
			      <div class="modal-header" style="background-color: #212529;">
			        <button type="button" class="close crx" data-dismiss="modal">&times;</button>
			      </div>
			      <div class="modal-body">
			        <iframe class="cuerpoCom" id="cuerpoCom" src=""></iframe>
			      </div>
			      <!--<div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>-->
			    </div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	function isEmptyOrSpaces(str){
	    return str === null || (/^ *$/).test(str);
	}

	$(document).ready(function(){
		$('#enviar2').click(function() {
			if(!isEmptyOrSpaces(formM.mensaje.value)) {
				$(this).closest('form').submit();
			}
	        
	        // $(this).parent().submit();
	    });
		$("#ibloque1").html(
	    	<?php
	    	echo '"'; 
			if($this -> estatus != '3' && $this -> idArea == $this -> idAreaU && $this->opcion == 'enviado') { 
				echo '<i class=\"far fa-thumbs-up\" onclick=\"terminarAsunto('.$this-> idConversacion.');\" style=\"cursor: pointer;\"></i>';
			} 
			echo '"';
			?>
		);
		$("#ibloque7").html(
			<?php
			echo '"';
			if(isset($this->indEnt2)) {
				$ind1 = $this->indEnt2;
				if($ind1[0]->getAux3() == 0 && $ind1[0]->getIdExposicion() == 0 && $ind1[0]->getAux2() == 0 && $ind1[0]->getAnio() == 0) {
                    echo 'E: s/entregable(s)';
                } else {
                	echo 'E: '.(round($ind1[0]->getFechaInicio()/$ind1[0]->getAux(),0)).'% ';
                	if($ind1[0]->getAnio() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:#33d62b; color:white;\'>'.$ind1[0]->getAnio().' </span>';
					if($ind1[0]->getAux2() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:#f0ee35; color:black;\'>'.$ind1[0]->getAux2().'</span>';
					if($ind1[0]->getIdExposicion() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:#ff8f00; color:black;\'>'.$ind1[0]->getIdExposicion().'</span>';
					if($ind1[0]->getAux3() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:red; color:white;\'>'.$ind1[0]->getAux3().'</span>';
                }
			}
			echo '"';
			?>
		);

		$("#ibloque5").html(
			<?php
			echo '"';
			$eN = 0;
			$iN = 0;
			if(isset($this->indEnt2)) {
				$ind1 = $this->indEnt2;
				if($ind1[0]->getAux()!='0') {
					$eN = $ind1[0]->getFechaInicio()/$ind1[0]->getAux();
				} 
			}
			if(isset($this->indIns)) {
				$ins1 = $this->indIns;
				if($ins1[0]->getAux()!='0') {
					$iN = $ins1[0]->getFechaInicio()/$ins1[0]->getAux();
				}
			}
			echo 'I-E: '.round(($eN+$iN)/2,0).'% <i class=\"fas fa-search\"></i>';
			echo '"';
			?>
		);
//alert("<?php echo $this->indIns[0]->getAnio();?>");
		$("#ibloque6").html(

			<?php
			echo '"';
			if(isset($this->indIns)) {
				$ins1 = $this->indIns;

				if($ins1[0]->getAux3() == 0 && $ins1[0]->getIdExposicion() == 0 && $ins1[0]->getAux2() == 0 && $ins1[0]->getAnio() == 0) {
                    echo 'I: s/insumo(s)';
                } else {
                	echo 'I: '.(round($ins1[0]->getFechaInicio()/$ins1[0]->getAux(),0)).'% ';
                	if($ins1[0]->getAnio() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:#33d62b; color:white;\'>'.$ins1[0]->getAnio().' </span>';
					if($ins1[0]->getAux2() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:#f0ee35; color:black;\'>'.$ins1[0]->getAux2().'</span>';
					if($ins1[0]->getIdExposicion() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:#ff8f00; color:black;\'>'.$ins1[0]->getIdExposicion().'</span>';
					if($ins1[0]->getAux3() != 0)echo '<span class=\'badge badge-ent\' style=\'background-color:red; color:white;\'>'.$ins1[0]->getAux3().'</span>';
                }
			}
			echo '"';
			?>

		);
		
		$("#ibloque4").html(
			<?php
			echo '"';
			if(isset($this->mensajes)) {
				echo sizeof($this->mensajes).' mensaje(s)';
			} else  {
				echo 'sin mensajes';
			}
			echo '"';
			?>
		);	

		$("#ibloque10").html(
			<?php
			echo '"';
			if(isset($this->indImp)) {
				$n = 0;
				$imp = $this->indImp;
				foreach ($imp as $i) {
					$n = $n + $i->getAux();
				}
				echo $n.' áreas impacto';
			} else  {
				echo 'sin impacto';
			}
			echo '"';
			?>
		);

		$("#compartidosN").html(
			<?php
			echo '"';
			if(isset($this->compartidos)) {
				echo $this->compartidos;
				//echo $this->idActividad;
			} 
			echo '"';
			?>
		);
		$("#ibloque11").click(function() {
			<?php
			if(isset($this->idActividad)) {
			?>
				abrirCompartidos('<?php echo $this->idActividad;?>','1');
			<?php	
			}
			?>
		});
		$("#normativosN").html(
			<?php
			echo '"';
			if(isset($this->normatividad)) {
				echo $this->normatividad;
			} 
			echo '"';
			?>
		);
		$("#ibloque12").click(function() {
			<?php
			if(isset($this->idActividad)) {
			?>
				abrirCompartidos('<?php echo $this->idActividad;?>','2');
			<?php	
			}
			?>
		});	
		//var elem = document.getElementById('caja');
		//elem.scrollTop = elem.scrollHeight;

	});

	function abrirInvitados() {
    	$("#cajaEI").show();
    	$("#cajaEI").slideDown("slow");
    	$.post("indexAct.php",{action:'invitados',idConversacion:'<?php echo $this->idConversacion; ?>',idUsuario:'<?php echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>', anio:'<?php echo $this->anio; ?>',tipo:'<?php echo $this->tipo; ?>',opcion:'<?php echo $this->opcion; ?>',idEje:'<?php echo $this->idEje; ?>',idAreaU:'<?php echo $this->idAreaU;?>'}, function( data ) {
    		$( "#cajaEI" ).html(data);
    	});
  	}

  	function filtrarM(tipo) {
  		var obj, i;
  		if(tipo==1) {
			$('.btnAct1').addClass('active');
			$('.btnAct2').removeClass('active');
			$(".btnAct3").removeClass('active');
			$('.btnAct4').removeClass('active');
			
		    obj = document.getElementsByClassName("msj");
		    for (i = 0; i < obj.length; i++) {
		    	obj[i].parentNode.style.setProperty('display', 'block');
		    }
  		} else if(tipo == 2) {
			$('.btnAct2').addClass('active');
			$('.btnAct1').removeClass('active');
			$(".btnAct3").removeClass('active');
			$('.btnAct4').removeClass('active');
			
  			obj = document.getElementsByClassName("msj");
		    for (i = 0; i < obj.length; i++) {
		    	obj[i].parentNode.style.setProperty('display', 'block');
		    }
  			obj = document.getElementsByClassName("invM");
		    for (i = 0; i < obj.length; i++) {
				obj[i].parentNode.style.setProperty('display', 'none', 'important'); 
		    }
  		} else if(tipo == 3) {
			$('.btnAct3').addClass('active');
			$('.btnAct2').removeClass('active');
			$(".btnAct1").removeClass('active');
			$('.btnAct4').removeClass('active');
			
  			obj = document.getElementsByClassName("msj");
		    for (i = 0; i < obj.length; i++) {
		    	obj[i].parentNode.style.setProperty('display', 'none', 'important');
		    }
		    obj = document.getElementsByClassName("invM");
		    for (i = 0; i < obj.length; i++) {
		    	obj[i].parentNode.style.setProperty('display', 'block');
		    }
  		} else if(tipo == 4) {
			$('.btnAct4').addClass('active');
			$('.btnAct2').removeClass('active');
			$(".btnAct3").removeClass('active');
			$('.btnAct1').removeClass('active');

  		} 
  	}

  	function abrirEntregables(opcion) {
		$(".btnAct5").addClass('active');
  		$("#cajaEI").slideDown("slow");
  		$.post("indexAct.php",{action:'entregables',idConversacion:'<?php echo $this->idConversacion; ?>',idUsuario:'<?php echo $this->idUsuario; ?>',idArea:'<?php echo $this->idArea; ?>', anio:'<?php echo $this->anio; ?>',tipo:'<?php echo $this->tipo; ?>',opcion:'<?php echo $this->opcion; ?>',idEje:'<?php echo $this->idEje; ?>',idAreaU:'<?php echo $this->idAreaU;?>',idEntregable:'<?php echo $this->idEntregable;?>',interno:'1',aux:opcion}, function( data ) {
  			
    		$( "#cajaEI" ).html(data);
    	});
  	}

  	function abrirCompartidos(idAct,tipo) {
  		//$.post("indexAct.php",{action:'compartidos',idActividad:idAct,tipo:tipo}, function( data ) {
    		$('#modalCom').modal('toggle');
    		$('#cuerpoCom').attr("src","");
			$('#cuerpoCom').attr("src","indexAct.php?action=compartidos&idActividad="+idAct+"&tipo="+tipo);
    	//});
  	}

	
</script>
