<?php
class ExposicionController extends Controller {

	function __construct() {
		parent:: __construct();
	}

	function obtenerExposiciones() {
		$exposiciones = $this->model->getExposiciones();
		return $exposiciones;
	}

	function obtenerExposicionesAnio() {
		$anio = "2021";
		if(isset($_POST['anio'])) {
			$anio = $_POST['anio'];
		} else if (isset($_REQUEST['anio'])) {
			$anio = $_REQUEST['anio'];
		} 
		$exposiciones = $this -> model -> getExposicionesAnio($anio);
		return $exposiciones;
	}

}
?>