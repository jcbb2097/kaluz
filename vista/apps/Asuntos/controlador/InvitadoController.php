<?php

class InvitadoController extends Controller{
	function __construct() {
		parent:: __construct();
	}

	function renderInvitados() {
		$idConversacion = $_POST['idConversacion'];
		$idArea = $_REQUEST['idArea'];
		$idAreaU = isset($_REQUEST['idAreaU']) ? $_REQUEST['idAreaU'] : $idArea;
		$idUsuario = $_REQUEST['idUsuario'];
		$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : $_REQUEST['opcion'];
		$tipo = $_REQUEST['tipo'];
		$anio = $_REQUEST['anio'];
		$eje = isset($_REQUEST['idEje']) ? $_REQUEST['idEje'] : '0';

		$invitados = $this -> model -> getInvitados(['idConversacion' => $idConversacion]);

		require_once 'controlador/AreaController.php';
		$controladorAreas = new AreaController();
		$controladorAreas -> cargarModelo('Area');
		
		$this -> vista -> idArea = $idArea;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> opcion = $opcion;
		$this -> vista -> tipo = $tipo;
		$this -> vista -> anio = $anio;
		$this -> vista -> idEje = $eje;
		$this -> vista -> idConversacion = $idConversacion;
		$this -> vista -> areas = $controladorAreas -> obtenerAreas();
		$this -> vista -> invitados = $invitados;
		
		$this -> vista -> renderizar('registrar/invitados');
	}

	function guardarNuevosInvitados($idConversacion,$invitados,$invitadosR) {
		echo $this -> model -> guardarNuevosInvitados($idConversacion,$invitados,$invitadosR);
	}

}


?>