<?php
class AreaController extends Controller {

	function __construct() {
		parent:: __construct();
	}

	function renderAreas(){
		$areas = $this->model->getAreas();
		$this->view->areas = $areas;
		$this->vista->renderizar('registrar/areasOptions');
	}

	function obtenerAreas() {
		$areas = $this->model->getAreas();
		return $areas;
	}

	function obtenerEjes() {
		$ejes = $this->model->getEjes();
		return $ejes;
	}

	function obtenerIndicadoresArea() {
		$idArea = $_REQUEST['idArea'];
		$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : $_REQUEST['opcion'];
		$areas = $this->model->getIndicadoresArea(['opcion' => $opcion, 'idArea' => $idArea]);
		return $areas;
	}

}
?>