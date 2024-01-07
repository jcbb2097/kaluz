<?php
class App{

	function __construct () {
		$option = "";
		if(isset($_REQUEST['ac'])) {
			$opcion = $_REQUEST['ac'];
			switch($opcion){
				case '1':
					echo $this->cargarRecibidos();
				break;
				case '2':
					$this->nuevoAsunto();
				break;
				case '3':
					$this->guardarNuevo();
				break;
				case '4':
					$this->guardarRespuesta();
				break;
				case '5':
					$this->cargarIndicadoresLateral();
				break;
				case '6':
					$this->terminarAsunto();
				break;
				case '7':
					$this->salirAsunto();
				break;
				case '8':
					$this->nuevoExterno();
				break;
				case '9':
					$this->guardarInvitadosExtra();
				break;
				case '10':
					$this->resueltos();
				break;
				default:
					echo $this->cargarRecibidos();
				break;
			}
		}
		
	}
	
	function nuevoAsunto() {
		require_once 'controlador/AsuntoController.php';
		$crt = new AsuntoController();
		$crt -> cargarModelo('Asunto');
		$crt -> renderNuevo();
		//$controlador -> guardarNuevo();
	}

	function cargarRecibidos() {
		require_once 'controlador/AsuntoController.php';
		$crt = new AsuntoController();
		$crt -> cargarModelo('Asunto');
		$crt -> renderChatGeneral();
	}

	function guardarNuevo() {
		require_once 'controlador/AsuntoController.php';
		$crt = new AsuntoController();
		$crt -> cargarModelo('Asunto');
		$crt -> guardarNuevo();
		$crt -> renderChatGeneral();
	}

	function guardarRespuesta() {
		require_once 'controlador/MensajeController.php';
		$crt = new MensajeController();
		$crt -> cargarModelo('Mensaje');
		$crt -> guardarMensaje();
		$this -> cargarRecibidos();
	}

	function actividades($eje, $anio) {
		require_once 'controlador/ActividadController.php';
		$actC = new ActividadController();
		$actC -> cargarModelo('Actividad');
		$actividades = $actC -> obtenerGlobales ($eje,$anio);
		foreach ($actividades as $act) {
			echo '<option value="'.$act -> getId().'">'.$act -> getNombre().'</option>';
		}
	}

	function actividadesSub($eje, $anio){
		require_once 'controlador/ActividadController.php';
		$actC = new ActividadController();
		$actC -> cargarModelo('Actividad');
		$actividades = $actC -> obtenerGlobales ($eje,$anio);
		foreach ($actividades as $act) {
			echo '<option value="'.$act -> getId().'">'.$act -> getNombre().'</option>';
		}
	}

	function cargarIndicadoresLateral() {
		require_once 'controlador/IndicadorController.php';
		$indC = new IndicadorController();
		$indC -> cargarModelo('Indicador');
		echo $indC -> renderTabla();
	}

	function terminarAsunto() {
		require_once 'controlador/AsuntoController.php';
		$crt = new AsuntoController();
		$crt -> cargarModelo('Asunto');
	 	$crt -> terminarAsunto();
	}

	function salirAsunto() {
		require_once 'controlador/AsuntoController.php';
		$crt = new AsuntoController();
		$crt -> cargarModelo('Asunto');
		$crt -> salirAsunto();
	}

	function nuevoExterno() {
		require_once 'controlador/AsuntoController.php';
		$nC = new AsuntoController();
		$nC -> cargarModelo('Asunto');
		echo $nC -> cargarNuevoExterno();
	}

	function guardarInvitadosExtra() {
		require_once 'controlador/AsuntoController.php';
		$nC = new AsuntoController();
		$nC -> cargarModelo('Asunto');
		echo $nC -> guardarInvitadosExtra();
	}

	function resueltos() {
		require_once 'controlador/AsuntoController.php';
		$nC = new AsuntoController();
		$nC -> cargarModelo('Asunto');
		echo $nC -> obtenerResueltos();
	}
}
?>