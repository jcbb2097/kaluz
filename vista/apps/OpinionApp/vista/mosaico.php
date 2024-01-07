<?php 
include_once __DIR__."/../source/controller/IndicadorController.php";

	$idEjeArea = $_GET["idEjeArea"];
	$ejeArea = $_GET["ejeArea"];
	$idUsuario = $_GET["idUsuario"];
	$nombreUsuario = $_GET["nombreUsuario"];
	
	$act =  new IndicadorController();
	$act2 =  new IndicadorController();

	$rango = $act -> mostrarRangoAnio();
	$anioInicio = $rango -> getAnioInicio();
	$anioUltimo = $rango -> getAnioUltimo();
	

	$tipos = $act -> mostrarTiposOpinion();
	$cadenaTipos = "";
	$cadenaAtendido = "";
	$cadenaNoAtendido = "";
	$cadenaTotal = 0;

	$totAtendido = 0;
	$totNoAtendido = 0;

	$percent = 0.0;
	$cadenaSinCorreo = "";
	$cadenaConCorreo = "";

	$totSinCorreo = 0;
	$totConCorreo = 0;

	$totalOpNa = 0;
	$totalOpC = 0;
	$totalOpS = 0;
	$totalOpAte = 0;

	$perAtencionGral = 0.0;
	$totPercentG = 0.0;

	$totalOpinion = 0;
	
	if($ejeArea == 1){
		$opinionAreas = $act -> mostrarTotalOpinionArea($idEjeArea);
		$totalOpinion = $opinionAreas -> getTotal();
	}else{
		$opinionEjes = $act -> mostrarTotalOpinionEje($idEjeArea);
		$totalOpinion = $opinionEjes -> getTotal();
	}

	
	foreach($tipos as $tipo)
	{
		if($ejeArea == 1){
			$atenciones = $act2 -> mostrarOpinionTipoAtencionArea($idEjeArea,$tipo->getId());
			$cadenaAtendido = $atenciones -> getAtendida();
			$cadenaNoAtendido = $atenciones -> getNoAtendida();
			$cadenaTotal = $atenciones -> getTotal();
			$cadenaSinCorreo = $atenciones -> getSinCorreo();
			$cadenaConCorreo = $atenciones -> getConCorreo();

			if($cadenaAtendido != ''){
				$totAtendido = $cadenaAtendido ;
			}else{
				$totAtendido = 0;
			}

			if($cadenaNoAtendido != ''){
				$totNoAtendido = $cadenaNoAtendido ;
			}else{
				$totNoAtendido = 0;
			}

			if($cadenaTotal > 0){
				$percent = ($totAtendido * 100) / $cadenaTotal;
 
			}else{
				$percent = 0;
		
			}

			if($cadenaSinCorreo != ''){
				$totSinCorreo = $cadenaSinCorreo ;
			}else{
				$totSinCorreo = 0;
			}

			if($cadenaConCorreo != ''){
				$totConCorreo = $cadenaConCorreo ;
			}else{
				$totConCorreo = 0;
			}
			 

			
		}else{
			$atenciones = $act2 -> mostrarOpinionTipoAtencionEje($idEjeArea,$tipo->getId());
			$cadenaAtendido = $atenciones -> getAtendida();
			$cadenaNoAtendido = $atenciones -> getNoAtendida();
			$cadenaTotal = $atenciones -> getTotal();
			$cadenaSinCorreo = $atenciones -> getSinCorreo();
			$cadenaConCorreo = $atenciones -> getConCorreo();
			
			if($cadenaAtendido != ''){
				$totAtendido = $cadenaAtendido ;
			}else{
				$totAtendido = 0;
			}

			if($cadenaNoAtendido != ''){
				$totNoAtendido = $cadenaNoAtendido ;
			}else{
				$totNoAtendido = 0;
			}

			if($cadenaTotal > 0){
				$percent = ($totAtendido * 100) / $cadenaTotal;
 
			}else{
				$percent = 0;
		
			}

			if($cadenaSinCorreo != ''){
				$totSinCorreo = $cadenaSinCorreo ;
			}else{
				$totSinCorreo = 0;
			}

			if($cadenaConCorreo != ''){
				$totConCorreo = $cadenaConCorreo ;
			}else{
				$totConCorreo = 0;
			}

		}

		$cadenaTipos .= "<tr><td>".$tipo->getDescripcion()."</td><td style='text-align:center;'><b style='font-family: Muli-Bold;'>".$totNoAtendido."</b></td><td style='text-align:center;font-size: 9px;'>".$totConCorreo."</td><td style='text-align:center;font-size: 9px;'>".$totSinCorreo."</td><td style='text-align:center;'><b style='font-family: Muli-Bold;color: green;'>".$totAtendido."</b></td><td><meter min='0' max='100' low='15' high='99' optimum='100' value='".$percent."'></meter> <a class='numb'>".number_format($percent, 1, '.', '')." %</td></tr>";
	
		$totalOpNa = $totalOpNa + $totNoAtendido;
		$totalOpC = $totalOpC + $totConCorreo;
		$totalOpS = $totalOpS + $totSinCorreo;
		$totalOpAte = $totalOpAte + $totAtendido;
		$totPercentG = $totPercentG + $percent;
	}

	if($totalOpinion > 0)
	{
		$perAtencionGral = ($totalOpAte * 100) / $totalOpinion;
	}
	else{
		$perAtencionGral = 0.0;
	}
	
	$cadenaTipos .= "<tr><td class='tdTotales'>Totales</td><td class='tdTotales'>".$totalOpNa."</td><td class='tdTotales'>".$totalOpC."</td><td class='tdTotales'>".$totalOpS."</td><td class='tdTotales'>".$totalOpAte."</td><td style='text-align:left;' class='tdTotales'><meter min='0' max='100' low='15' high='99' optimum='100' value='".$perAtencionGral."'></meter> <a style='color:white;' class='numb'>".number_format($perAtencionGral, 1, '.', '')." %</td></tr>";

	
	
	
	
	




?>		
	<style>
	.numb{
		text-decoration: none !important;
    	color: black;
	}

	.tdTotales{
		background-color: #4d4d57;
		color: white;
		text-align: center;
		font-size: 9.5px;
		padding: 2px !important;
		font-family: 'Muli-SemiBold';
	}

	</style>	
	<div style="top: 488px;left: 1px;width: 300px;" class="divSec3">Opiniones (<?php echo $anioInicio." - ".$anioUltimo; ?>) = <?php echo $totalOpinion; ?></div>
	<div style="top: 525px;left: 1px;width: 300px; background-color: white;" class="cuadroSec9">
		<table style='width:100%;margin-left: -4px;margin-top: -6px;font-family: Muli-SemiBold; font-size: 10px;'>
			<thead>
				<tr>
					<th></th>
					<th style='text-align:center;color:red;'><a style="cursor:pointer;color:red;" href='apps/OpinionApp/vista/atencion.php?ejeArea=<?php echo $ejeArea; ?>&idEjeArea=<?php echo $idEjeArea; ?>&idUsuario=<?php echo $idUsuario; ?>'>No atendidas</a></th>
					<th style='text-align:center;color:red;'>Con correo</th>
					<th style='text-align:center;color:red;'>Sin correo</th>
					<th style='text-align:center;'>Atendidas</th>
					<th style='text-align:center;'>% atención</th>								
				</tr>
			</thead>
			<tbody>
				<?php echo $cadenaTipos; ?>
			</tbody>
		</table>
	
	</div>
	<!--
	<div style="top: 567px;left: 1px;width: 300px;" class="cuadroSec9">Solicitudes <p class="opSec9">0</p>
	</div>
	<div style="top: 594px;left: 1px;width: 300px;" class="cuadroSec9">Quejas <p class="opSec9">0</p>
	</div>
	<div style="top: 621px;left: 1px;width: 300px;" class="cuadroSec9">
	</div>
	<div style="top: 648px;left: 1px;width: 300px;" class="cuadroSec9"></div>
-->
	<div style="top: 675px;left: 1px;width: 300px;" class="cuadroSec9-1"></div>