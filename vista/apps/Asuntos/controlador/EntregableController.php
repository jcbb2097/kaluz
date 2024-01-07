<?php

class EntregableController extends Controller{

	function __construct() {
		parent:: __construct();
	}

	function renderTabla() {
		//$idConversacion = $_POST['idConversacion'];
		$idEntregable = $_REQUEST['idEntregable'];
		$idUsuario = $_REQUEST['idUsuario'];
		$idAreaU = $_REQUEST['idAreaU'];
		$interno = isset($_REQUEST['interno']) ? $_REQUEST['interno'] : '0';
		$auxIE = isset($_REQUEST['aux']) ? $_REQUEST['aux'] : '0';
		$entregables = $this -> model -> getEntregables(['idEntregable' => $idEntregable]);
		$this -> vista -> entregables =  $entregables;
		if(isset($entregables[0])) {
			$insumos = $this -> model -> getInsumos(['idEntregable' => $entregables[0]->getIdEntregable()]);
			$this -> vista -> insumos = $insumos;
		}
		$chks = $this -> model -> getChks(['idEntregable' => $idEntregable]);
		$this -> vista -> valoresCK = $chks;
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> idEntregable = $idEntregable;
		$this -> vista -> interno = $interno;
		$this -> vista -> aux = $auxIE;

		//$this -> vista -> areas = $controladorAreas -> obtenerAreas();
		//$this -> vista -> invitados = $invitados;
		
		$this -> vista -> renderizar('conversacion/entregables');
	}

	function obtenerInsumos() {
		$idEntregable = $_POST['idEntregable'];
		$insumos = $this -> model -> getInsumos(['idEntregable' => $idEntregable]);
		
		if(isset($insumos)) {
			foreach ($insumos as $ins) {
				$fecha = explode(" ",$ins->getFechaFinEstimada());
				echo '<tr class="row-ei process-row has-children ins2-row detalle">';
				echo '<td class="row-ei i-text">--'.$ins->getDescripcion().'</td>';
				echo '<td class="row-ei area inputs">'.$ins->getResponsable().'('.$ins->getArea().')</td>';
				echo '<td class="row-ei area has-expired">'.$fecha[0].'</td>';
				echo '<td class="row-ei area"><div class="p-ei container"><span class="p-ei">75 %</span><div class="p-ei line-container"><div class="p-ei progress" style="width: 75%; background-color: rgb(128, 242, 13);"></div></div></div></td>';
				echo '<td class="row-ei"><figure class="icon-ei medium" style="margin-right: 12px;"><img src="https://s3.amazonaws.com/sitiosie/icons/descargar.svg" class="icon-ei icon default"><span class="icon-ei caption"></span></figure></td>';
				echo '</tr>';
            
			}
		}
		$chks = $this -> model -> getChks(['idEntregable' => $idEntregable]);
		if(isset($chks)) {
			foreach ($chks as $ck) {
				echo '<tr class="row-ei process-row chk-row detalle">';
				echo '<td class="row-ei" colspan="5" style="padding-left:20px;"> ';
				if($ck->getValor() != '1')
					echo '<i class="fa fa-square-o" aria-hidden="true"></i> ';
				else 
					echo '<i class="fa fa-check-square-o" aria-hidden="true"></i> ';
				echo ' '.$ck->getNombre().'</td>';
				echo '<td class="row-ei"></td>';
				echo '<td class="row-ei"></td>';
				echo '<td class="row-ei"></td>';
				echo '<td class="row-ei"></td>';
				echo '<td class="row-ei"></td>';
				echo '</tr>';
            
			}
		}

		/*foreach ($chks as $chk) {
			echo '';
		}*/
	}

	function obtenerCategoria() {
		$idActividad = $_POST['idActividad'];
		//$tipo = $_POST['tipoE'];
		$cat = $this -> model -> getCategorias(['idActividad' => $idActividad, 'tipoE' => '1']);

		//if(isset($cat)) {
		foreach ($cat as $ct) {
			echo '<option idExp="'.$ct->getIdExposicion().'" entregable="'.$ct->getAnio().'" value="'.$ct->getFechaInicio().'">'.$ct->getTitulo().'('.$ct->getAux().' '.$ct->getAnio().')</option>';
		}
		//}
		$cat = $this -> model -> getCategorias(['idActividad' => $idActividad, 'tipoE' => '2']);
		foreach ($cat as $ct) {
			echo '<option idExp="'.$ct->getIdExposicion().'" entregable="'.$ct->getAnio().'" value="'.$ct->getFechaInicio().'">'.$ct->getTitulo().'('.$ct->getAux().' '.$ct->getAnio().')</option>';
		}
	}

	function obtenerEntregableNoTemporal() {
		$idActividad = $_POST['idActividad'];

		$cat = $this -> model -> getEspecificoNoTemporal(['idActividad' => $idActividad]);

		$dato = [];
		if(isset($cat)) {
			$ins = $this -> model -> getDetalleGeneralInsumos(['idEntregable' => $cat -> getAux4()]);
			$dato = ['total' => $cat ->getAux(), 'preliminar' => $cat ->getIdExposicion(),'proceso'=>$cat->getAux2(),'cero'=>$cat->getAux3(),'final' => $cat ->getAnio(),'avance' => $cat ->getFechaInicio(), 'nombre' => $cat ->getTitulo(), 'idEE' => $cat ->getAux4(), 'itotal' => $ins[0]->getAux(), 'ifinal' => $ins[0]->getAnio(), 'ipreliminar' => $ins[0]->getIdExposicion(),'iproceso'=> $ins[0]->getAux2(),'icero'=> $ins[0]->getAux3(), 'iavance' => $ins[0]->getFechaInicio()];
		}

		$cat = $this -> model -> getGeneral(['idActividad' => $idActividad]);
		$dato['nombre'] =  $cat->getTitulo();

		header('Content-Type: application/json');
		return json_encode($dato);
	}

	function obtenerEntregableActividad() {
		$idActividad = $_POST['idActividad'];
		$expo = $_POST['expo'];

		$cat = $this -> model -> getEspecifico(['idActividad' => $idActividad, 'idExpo' => $expo]);

		$dato = [];
		if(isset($cat)) {
			$ins = $this -> model -> getDetalleGeneralInsumos(['idEntregable' => $cat ->getAux4()]);
			$dato = ['total' => $cat ->getAux(), 'preliminar' => $cat ->getIdExposicion(),'proceso'=>$cat->getAux2(),'cero'=>$cat->getAux3(),'final' => $cat ->getAnio(),'avance' => $cat ->getFechaInicio(), 'nombre' => $cat ->getTitulo(), 'idEE' => $cat ->getAux4(), 'itotal' => $ins[0]->getAux(), 'ifinal' => $ins[0]->getAnio(), 'ipreliminar' => $ins[0]->getIdExposicion(),'iproceso'=> $ins[0]->getAux2(),'icero'=> $ins[0]->getAux3(),  'iavance' => $ins[0]->getFechaInicio()];
		}

		$cat = $this -> model -> getGeneral(['idActividad' => $idActividad]);
		$dato['nombre'] =  $cat->getTitulo();

		header('Content-Type: application/json');
		return json_encode($dato);
		
	}

	function obtenerGeneralEntregables($idEntregable) {
		$entregables = $this -> model -> getDetalleGeneralEntregable(['idEntregable' => $idEntregable, 'tipoE' => '2']);
		
		if(isset($entregables)) {
			$entregables = $this -> model -> getDetalleGeneralEntregable(['idEntregable' => $idEntregable, 'tipoE' => '1']);
		}
		return $entregables;

	}

	function obtenerGeneralInsumos($idEntregable) {
		//$idEntregable = $_REQUEST['idEntregable'];
		$insumos = $this -> model -> getDetalleGeneralInsumos(['idEntregable' => $idEntregable]);
		return $insumos;
	}

	function obtenerGeneralImpacto($idEntregable) {
		//$idEntregable = $_REQUEST['idEntregable'];
		$imp = $this -> model -> getDetalleGeneralImpacto(['idEntregable' => $idEntregable]);
		return $imp;
	}

	function obtenerNombre() {
		$idActividad = $_POST['idActividad'];
		return $this -> model -> getNombre($idActividad);
	}
}

?>