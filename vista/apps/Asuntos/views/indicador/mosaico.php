<div style="top: 117px;left: 1px;" class="cuadroSec1">
<!--<img class="imgS" src="../resources/img/imgSobre.png"/>-->
<p style="font-family: 'Muli-Regular';font-size: 8.5px;font-weight: bold;position: absolute;top: 7px;left: 0px;" >Total</p>
<p data-toggle="tooltip" data-placement="bottom" title="Total directo" style="background-color:transparent;right: 34px;" class="recf11 setTooltip" onclick="entrarTotal(<?php echo $this->idArea;?>,'recibido');"><?php echo $this->indicadores->getRecibidos() + $this->indicadores->getRecibidosC();?></p>
<p data-toggle="tooltip" data-placement="bottom" title="Total invitado" style="background-color:transparent;right: 8px;" class="recf12 setTooltip" onclick="entrarTotal(<?php echo $this->idArea;?>,'invitado');"><?php echo $this->indicadores->getInvitados() + $this->indicadores->getInvitadosC();?></p>
<!--<p class="recf13">< ?php echo $this->indicadores->getInvitados() + $this->indicadores->getRecibidos();?></p>-->
</div>
<div style="top: 117px;left: 76px;" class="cuadroSec1">
<p style="font-family: 'Muli-Regular';font-size: 8.5px;font-weight: bold;position: absolute;top: 7px;left: 7px;" >Total</p>
<p data-toggle="tooltip" data-placement="bottom" title="Total enviados" style="background-color: transparent;" class="envf11 setTooltip" onclick="entrarTotal(<?php echo $this->idArea;?>,'enviado');"><?php echo $this -> indicadores -> getEnviados() + $this -> indicadores -> getEnviadosC();;?></p>
</div>

<div style="top: 143px;left: 1px;" class="cuadroSec1">
<img class="imgS" src="../resources/img/imgSobre.png"/>
<p data-toggle="tooltip" data-placement="bottom" title="Directos sin leer" style="right: 34px;" class="recf11 setTooltip" onclick="entrar(<?php echo $this->idArea;?>,'recibido','1');"><?php echo $this->indicadores->getRecibidos();?></p>
<p data-toggle="tooltip" data-placement="bottom" title="Invitado sin leer" style="right: 8px;" class="recf12 setTooltip" onclick="entrar(<?php echo $this->idArea;?>,'invitado','1');"><?php echo $this->indicadores->getInvitados();?></p>
<!--<p class="recf23">< ?php echo $this->indicadores->getInvitadosC() + $this->indicadores->getRecibidosC();?>--></p><!--<p class="recf24"></p>-->
</div>
<div style="top: 143px;left: 76px;" class="cuadroSec1">
<img class="imgE" src="../resources/img/imgEnviado.png"/>
<p data-toggle="tooltip" data-placement="bottom" title="Enviados sin leer" class="envf11 setTooltip" onclick="entrar(<?php echo $this->idArea;?>,'enviado','1');"><?php echo $this -> indicadores -> getEnviados();?></p>
</div>

<div style="top: 169px;left: 1px;" class="cuadroSec1">
<img class="imgS" src="../resources/img/imgConversacion.png"/>
<p data-toggle="tooltip" data-placement="bottom" title="Directos en conversación" style="right: 34px;" class="recf21 setTooltip" onclick="entrar(<?php echo $this->idArea;?>,'recibido','2');"><?php echo $this->indicadores->getRecibidosC();?></p>
<p data-toggle="tooltip" data-placement="bottom" title="Invitado en conversación" style="right: 8px;" class="recf22 setTooltip" onclick="entrar(<?php echo $this->idArea;?>,'invitado','2');"><?php echo $this->indicadores->getInvitadosC();?></p>

<img style="top: 29px;z-index: 1;" class="imgS" src="../resources/img/imgTerminado.png"/>

<p onclick="entrarResueltos('recibido');" data-toggle="tooltip" data-placement="bottom" title="Directos resueltos" style="top: 26px;left: 23px;z-index: 1;" class="recf31 setTooltip"><?php echo $this->indicadores->getRecibidosR();?></p>

<p onclick="entrarResueltos('invitado');" data-toggle="tooltip" data-placement="bottom" title="Invitado resueltos" style="top: 26px;left: 49px;z-index: 1;" class="recf32 setTooltip"><?php echo $this->indicadores->getInvitadosR();?></p>
<!--
<p class="recf33">< ?php echo $this->indicadores->getInvitadosR() + $this->indicadores->getRecibidosR();?></p>
-->
</div>

<div style="top: 169px;left: 76px;" class="cuadroSec1">
<img class="imgE" src="../resources/img/imgConversacion.png"/>
<p data-toggle="tooltip" data-placement="bottom" title="Enviados en conversación" class="envf11 setTooltip" onclick="entrar(<?php echo $this->idArea;?>,'enviado','2');"><?php echo $this -> indicadores -> getEnviadosC();?></p>

<img style="top: 29px;z-index: 1;" class="imgE" src="../resources/img/imgTerminado.png"/>

<p onclick="entrarResueltos('enviado');" data-toggle="tooltip" data-placement="bottom" title="Enviados resueltos" style="top: 26px;left: 37px;z-index: 1;" class="envf11 setTooltip"><?php echo $this -> indicadores -> getEnviadosR();?></p>

</div>





<script type="text/javascript">
	function entrar(idArea,opcion,estatus) {
		location.replace("apps/Asuntos/index.php?ac=1&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=0&opcion="+opcion+"&estatus="+estatus+"&idEje=0&idAreaU=<?php echo $this->idAreaU; ?>"); 
	}
	
	function entrarTotal(idArea,opcion) {
		location.replace("apps/Asuntos/index.php?ac=1&idUsuario=<?php echo $this->idUsuario; ?>&idArea=<?php echo $this->idArea; ?>&anio=<?php echo $this->anio; ?>&tipo=0&opcion="+opcion+"&estatus=0&idEje=0&idAreaU=<?php echo $this->idAreaU; ?>"); 
	}
	
	$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>