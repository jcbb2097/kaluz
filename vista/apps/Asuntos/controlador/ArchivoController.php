<?php

class ArchivoController extends Controller {

	function __construct() {
		parent:: __construct();
	}

	function mostrarVersiones() {
		$idEntregable = $_REQUEST['idEntregable'];
		$act = $_REQUEST['actividad'];
		$orden = $_REQUEST['orden'];
		$desc = $_REQUEST['desc'];
		$expo = $_REQUEST['exp'];

		$vers = $this -> model -> getVersionesTipo(['idEntregable' => $idEntregable]);

		$this -> vista -> vers = $vers;
		$this -> vista -> actividad = $act;
		$this -> vista -> orden = $orden;
		$this -> vista -> entregable = $desc;
		$this -> vista -> expo = $expo;

		$this -> vista -> renderizar('conversacion/archivos');
	}

	function mostrarCompartidos() {
		$act = $_REQUEST['idActividad'];
		$t = $_REQUEST['tipo'];
		//$orden = $_REQUEST['orden'];
		//$desc = $_REQUEST['desc'];

		$vers = $this -> model -> getCompartidos(['idActividad' => $act, 'tipo' => $t]);

		$this -> vista -> compartidos = $vers;
		if($t=='1')
			$this -> vista -> tipo = 'compartidos';
		else
			$this -> vista -> tipo = 'normatividad';
		//$this -> vista -> ordenC = $orden;
		//$this -> vista -> actividadC = $desc;

		$this -> vista -> renderizar('indicador/compartidos');
	}

	/*function mostrarVersiones() {
		$idEntregable = $_REQUEST['idEntregable'];
		$act = $_REQUEST['actividad'];
		$orden = $_REQUEST['orden'];
		$desc = $_REQUEST['desc'];
		$expo = $_REQUEST['exp'];

		$pre = $this -> model -> getVersionesPre(['idEntregable' => $idEntregable]);
		$finales = $this -> model -> getVersionesFinal(['idEntregable' => $idEntregable]);

		$this -> vista -> pre = $pre;
		$this -> vista -> finales = $finales;
		$this -> vista -> actividad = $act;
		$this -> vista -> orden = $orden;
		$this -> vista -> entregable = $desc;
		$this -> vista -> expo = $expo;

		$this -> vista -> renderizar('conversacion/archivos');
		
	}*/

}

?>