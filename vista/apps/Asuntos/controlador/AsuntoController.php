<?php

class AsuntoController extends Controller {

	function __construct() {
		parent:: __construct();
	}

	function renderNuevo() {
		require_once 'controlador/AreaController.php';
		$controladorAreas = new AreaController();
		$controladorAreas -> cargarModelo('Area');
		$this -> vista -> areas = $controladorAreas -> obtenerAreas();
		$this -> vista -> ejes = $controladorAreas -> obtenerEjes();

		require_once 'controlador/ExposicionController.php';
		$controladorExpo = new ExposicionController();
		$controladorExpo -> cargarModelo('Exposicion');
		$this -> vista -> exposiciones = $controladorExpo -> obtenerExposicionesAnio();

		$idArea = $_REQUEST['idArea'];
		$idAreaU = isset($_REQUEST['idAreaU']) ? $_REQUEST['idAreaU'] : $idArea;
		$idUsuario = $_REQUEST['idUsuario'];
		$opcion = $_REQUEST['opcion'];
		$tipo = $_REQUEST['tipo'];
		$anio = $_REQUEST['anio'];
		$eje = isset($_REQUEST['idEje']) ? $_REQUEST['idEje'] : '0';
		$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '0';
		$this -> vista -> estatus = $estatus;
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> idArea = $idArea;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> anio = $anio;
		$this -> vista -> opcion = $opcion;
		$this -> vista -> tipo = $tipo;
		$this -> vista -> idEje = $eje;
		$this -> vista -> estatus = $estatus;
		$this -> vista -> renderizar('registrar/nuevoAsunto');
	}

	function renderChatGeneral() {
		$this -> obtenerRecibidos();
		
	}

	function obtenerRecibidos() {
		$ac = $_REQUEST['ac'];
		$idArea = $_REQUEST['idArea'];
		$idAreaU = isset($_REQUEST['idAreaU']) ? $_REQUEST['idAreaU'] : $idArea;
		$idUsuario = $_REQUEST['idUsuario'];
		$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : $_REQUEST['opcion'];
		$tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '0';
		$anio = $_REQUEST['anio'];
		$eje = isset($_REQUEST['idEje']) ? $_REQUEST['idEje'] : '0';
		$nuevo = isset($_REQUEST['nuevo']) ? $_REQUEST['nuevo'] : '0';
		$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '0';
		$indExt = isset($_REQUEST['ind']) ? $_REQUEST['ind'] : '0';
		$estInd = isset($_REQUEST['estatusIndicador']) ? $_REQUEST['estatusIndicador'] : '0';
		$filtroa = isset($_REQUEST['filtroa']) ? $_REQUEST['filtroa'] : '0';

		$asuntos = [];

		require_once 'controlador/AreaController.php';
		$controladorAreas = new AreaController();
		$controladorAreas -> cargarModelo('Area');
		$this -> vista -> areas = $controladorAreas -> obtenerIndicadoresArea();

		require_once 'controlador/IndicadorController.php';
		$indC = new IndicadorController();
		$indC -> cargarModelo('Indicador');
		
		
		$asuntos = $this -> model -> getRecibidos(['idArea' => $idArea, 'opcion' => $opcion, 'tipo' => $tipo, 'idEje' => $eje, 'estatus' => $estatus, 'filtroa' => $filtroa]);
		$this -> vista-> asuntos = $asuntos;
		$this -> vista -> indicador = $indC -> obtenerIndicadoresGeneral($eje);
		 
		
		//primera conversacion o conversación que se respondió
		$idConversacion = '';
		if(isset($_REQUEST['idConversacion']) && $_REQUEST['ac'] != '6') {
			$idConversacion = $_REQUEST['idConversacion'];
			$this -> vista -> idConversacion = $idConversacion;
			$this -> vista -> asunto = $this->model->getAsunto($idConversacion);                                            
		} else if($asuntos != null) {
			$idConversacion =  $asuntos[0] -> getIdConversacion();
			$this -> vista -> idConversacion = $idConversacion;
			$this -> vista -> asunto = $this->model->getAsunto($idConversacion);
		}
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> idArea = $idArea;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> anio = $anio;
		$this -> vista -> opcion = $opcion;
		$this -> vista -> tipo = $tipo;
		$this -> vista -> idEje = $eje;
		$this -> vista -> nuevo = $nuevo;
		$this -> vista -> estatus = $estatus;
		$this -> vista -> ac = $ac;
		$this -> vista -> indExt = $indExt;
		$this -> vista -> estInd = $estInd;
		$this -> vista -> filtroa = $filtroa;

		$cnvaux = '';
		foreach ($asuntos as $ast) {
			if($ast->getEstatus()=='3' && $cnvaux != $ast -> getIdConversacion()){
				//$fecha = date('Y-m-d H:i');
				//echo $ast -> getIdConversacion().': ';
				$fechaTermino = new DateTime($ast -> getFechaFin());
				$fecha = new DateTime();
				$interval = date_diff($fechaTermino, $fecha);
				//echo $fecha->format('Y-m-d H:i:s').', ';
				//echo $fechaTermino->format('Y-m-d H:i:s') . 'total: ';
				// $interval->format('%a');
				if($interval->format('%a') >= 1)
					$this -> model -> terminarCompleto($ast -> getIdConversacion());
				//
			} /*else {
				$fechaRespuesta = new DateTime($ast -> getFechaRespuesta());
				$fecha = new DateTime();
				$interval = date_diff($fechaRespuesta, $fecha);
				if($interval->format('%a') >= 10) {
					$mensaje = 'Este asunto lleva '.$interval->format('%a').' días inactivo.';
					require_once 'controlador/MensajeController.php';
					$msjC = new MensajeController();
					$msjC -> cargarModelo('Mensaje');
					echo $msjC -> model ->mensajeSistema(['idConversacion' => $ast -> getIdConversacion(), 'mensaje' => $mensaje]);
				}
			}*/
			$cnvaux = $ast -> getIdConversacion();
		}
		$this -> vista -> renderizar('recibidos/recibidos');
	}

	/*function consultarConversacion() {
		$asuntos = $this -> model -> getConversacion($idConversacion);
		return $asuntos;
	}*/

	function guardarNuevo() {

		$titulo = $_POST['titulo'];
		$texto = $_POST['mensaje'];
		$origen = $_POST['idArea'];
		$usuario = $_POST['idUsuario'];
		$destino = $_POST['areaDestino'];
		$eleccion = $_POST['eleccion'];
		$idExpo = isset($_POST['expo']) ? $_POST['expo'] : '0';
		$idEntregable = isset($_POST['idEE']) ? $_POST['idEE'] : '0';
		$destinatario = isset($_POST['destinatario']) ? $_POST['destinatario'] : '0';
		$invitados = isset($_POST['invitados']) ? $_POST['invitados'] : null;
		//guardar conversacion
		//$idConversacion = $this-> model-> guardarConversacion(['titulo' => $titulo, 'origen' => '1','destino' => '2', 'tipo' => $eleccion]);
		//echo '<br>"'.$idConversacion.'"<br>';
		//Actividades
		$eje = $_POST['ejes'];
		$global = $_POST['AGlobal'];
		$general = $_POST['AGeneral'];
		$part = $_POST['AParticular'];
		$sub = $_POST['SActividad'];
		$mensaje = $_POST['mensaje'];
		$idConversacion = $this-> model-> guardarConversacion(['titulo' => $titulo, 'origen' => $origen,'destino' => $destino, 'tipo' => $eleccion,'eje'=>$eje, 'global'=>$global, 'general'=>$general, 'particular'=>$part, 'sub'=>$sub, 'mensaje'=>$mensaje, 'idUsuario'=>$usuario,'destinatario'=> $destinatario, 'idEntregable' => $idEntregable, 'idExpo' => $idExpo]);
	    if(isset($invitados))
	    	$this -> model -> guardarInvitados($idConversacion, $invitados,$destino);
		//$this -> model -> guardarConvAct(['idConversacion'=>$idConversacion, 'eje'=>$eje, 'global'=>$global, 'general'=>$general, 'particular'=>$part, 'sub'=>$sub]); 

	}

	function terminarAsunto() {
		$idConversacion = $_REQUEST['idConversacion'];
		$idArea = $_REQUEST['idArea'];
		echo $this -> model -> terminar(['idConversacion' => $idConversacion]);
		$this -> obtenerRecibidos();
	}

	function salirAsunto() {
		$idConversacion = $_REQUEST['idConversacion'];
		$idArea = $_REQUEST['idArea'];
		$this -> model -> salirConversacion(['idConversacion' => $idConversacion, 'idArea' => $idArea]);
		unset($_REQUEST['idConversacion']);
		unset($_POST['idConversacion']);
		$this -> obtenerRecibidos();
	}

	function cargarNuevoExterno() {
		$idEntregable = $_REQUEST['idEntregable'];
		$idAreaU = $_REQUEST['idAreaU'];
		$idUsuario = $_REQUEST['idUsuario'];

		require_once 'controlador/ActividadController.php';
		$actC = new ActividadController();
		$actC -> cargarModelo('Actividad');
		$actividades = $actC -> obtenerActEnt($idEntregable);

		require_once 'controlador/AreaController.php';
		$controladorAreas = new AreaController();
		$controladorAreas -> cargarModelo('Area');
		$this -> vista -> areas = $controladorAreas -> obtenerAreas();

		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> idEntregable = $idEntregable;
		$this -> vista -> idEje = $actividades[0]->getId();
		$this -> vista -> idExp = $actividades[0]->getExp();

		$this -> vista -> idArea = $actividades[0]->getIdArea();
		$this -> vista -> idAreaD = $actividades[0]->getIdArea();
		$this -> vista -> areaDN = $actividades[0]->getArea();
		$this -> vista -> idGlobal = '0';
		$this -> vista -> idGeneral = '0';
		$this -> vista -> idParticular = '0';
		$this -> vista -> idSub = '0';
		$this -> vista -> nombreAct = $actividades[1]->getNombre();
		$this -> vista -> entregable = $actividades[0]->getIdEntregable();
		
		if($actividades[4]->getId() != null) {
			$this -> vista -> idGlobal = $actividades[4]->getId();
			$this -> vista -> idGeneral = $actividades[3]->getId();
			$this -> vista -> idParticular = $actividades[2]->getId();
			$this -> vista -> idSub = $actividades[1]->getId();
			$this -> vista -> ordenAct = $actividades[0]->getOrden().'.'.$actividades[4]->getOrden().'.'.$actividades[3]->getOrden().'.'.$actividades[2]->getOrden().'.'.$actividades[1]->getOrden();
			$this -> vista -> actividad = $actividades[1]->getId();
		} else if($actividades[3]->getId() != null) {
			$this -> vista -> idGlobal = $actividades[3]->getId();
			$this -> vista -> idGeneral = $actividades[2]->getId();
			$this -> vista -> idParticular = $actividades[1]->getId();
			$this -> vista -> ordenAct = $actividades[0]->getOrden().'.'.$actividades[3]->getOrden().'.'.$actividades[2]->getOrden().'.'.$actividades[1]->getOrden();
			$this -> vista -> actividad = $actividades[1]->getId();
		} else if($actividades[2]->getId() != null) {
			$this -> vista -> idGlobal = $actividades[2]->getId();
			$this -> vista -> idGeneral = $actividades[1]->getId();
			$this -> vista -> ordenAct = $actividades[0]->getOrden().'.'.$actividades[2]->getOrden().'.'.$actividades[1]->getOrden();
			$this -> vista -> actividad = $actividades[1]->getId();
		} else {
			$this -> vista -> idGlobal = $actividades[1]->getId();
			$this -> vista -> ordenAct = $actividades[0]->getOrden().'.'.$actividades[1]->getOrden();
			$this -> vista -> actividad = $actividades[1]->getId();
		}
		
		/*if($actividades[0]->getId() == '7') {

		} else {

		}*/

		$this -> vista -> renderizar('registrar/nuevoExterno');
	}

	function guardarInvitadosExtra() {
		$idConversacion = $_POST['idConversacion'];
		$invitados = isset($_POST['invitados']) ? $_POST['invitados'] : null;
		$invitadosR = isset($_POST['invitadosR']) ? $_POST['invitadosR'] : null;

		require_once 'controlador/InvitadoController.php';
		$indC = new InvitadoController();
		$indC -> cargarModelo('Invitado');
		if(isset($invitados) || isset($invitadosR)) {
			$indC -> guardarNuevosInvitados($idConversacion,$invitados,$invitadosR);
			
		}
		$this -> obtenerRecibidos();


	}

	function obtenerResueltos() {
		$ac = $_REQUEST['ac'];
		$idArea = $_REQUEST['idArea'];
		$idAreaU = isset($_REQUEST['idAreaU']) ? $_REQUEST['idAreaU'] : $idArea;
		$idUsuario = $_REQUEST['idUsuario'];
		$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : $_REQUEST['opcion'];
		$tipo = $_REQUEST['tipo'];
		$anio = $_REQUEST['anio'];
		$eje = isset($_REQUEST['idEje']) ? $_REQUEST['idEje'] : '0';
		$nuevo = isset($_REQUEST['nuevo']) ? $_REQUEST['nuevo'] : '0';
		$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '0';
		$indExt = isset($_REQUEST['ind']) ? $_REQUEST['ind'] : '0';
		$asuntos = [];

		require_once 'controlador/IndicadorController.php';
		$indC = new IndicadorController();
		$indC -> cargarModelo('Indicador');
		
		//if($eje == '0') {
			$asuntos = $this -> model -> getResueltos(['idArea' => $idArea, 'opcion' => $opcion, 'tipo' => $tipo, 'idEje' => $eje]);
			$this -> vista-> asuntos = $asuntos;
			$this -> vista -> indicador = $indC -> obtenerIndicadoresResueltos();
		//} 
		
		//primera conversacion o conversación que se respondió
		$idConversacion = '';
		if(isset($_REQUEST['idConversacion'])) {
			$idConversacion = $_REQUEST['idConversacion'];
			$this -> vista -> idConversacion = $idConversacion;
			$this -> vista -> asunto = $this->model->getAsunto($idConversacion);		                                                                                                          
		} else if($asuntos != null) {
			$idConversacion =  $asuntos[0] -> getIdConversacion();
			$this -> vista -> idConversacion = $idConversacion;
			$this -> vista -> asunto = $this->model->getAsunto($idConversacion);
		}
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> idArea = $idArea;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> anio = $anio;
		$this -> vista -> opcion = $opcion;
		$this -> vista -> tipo = $tipo;
		$this -> vista -> idEje = $eje;
		$this -> vista -> nuevo = $nuevo;
		$this -> vista -> estatus = $estatus;
		$this -> vista -> indExt = $indExt;
		$this -> vista -> ac = $ac;
		$this -> vista -> renderizar('recibidos/recibidos');

	}

	/*function guardarRespuesta() {
		$idConversacion = $_POST['idConversacion'];
		$idAreaOrigen = $_POST['idArea'];
		$mensaje = $_POST['mensaje'];
		$fecha = $_POST['fecha'];
		$this-> model -> guardarRespuesta(['idConversacion'=>$idConversacion,'idArea'=>$idAreaOrigen,'mensaje'=>$mensaje]);
	}*/

}

?>