<?php 
class IndicadorController extends Controller {

	function __construct() {
		parent:: __construct();
	}

	function obtenerIndicadoresGeneral($idEje){
		$idArea = $_REQUEST['idArea'];
		$opcion = $_REQUEST['opcion'];
		$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '0';
		$indicador = $this->model->getIndicadoresGeneral(['idArea' => $idArea, 'opcion'=>$opcion, 'estatus'=>$estatus, 'idEje' => $idEje]);
		return $indicador;
	}

	function obtenerIndicadoresEje() {
		$idArea = $_REQUEST['idArea'];
		$opcion = $_REQUEST['opcion'];
		$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '0';
		$eje = $_REQUEST['idEje'];
		$indicador = $this->model->getIndicadoresEje(['idArea' => $idArea, 'opcion'=>$opcion, 'idEje'=>$eje, 'estatus'=>$estatus]);
		return $indicador;
	}

	function obtenerIndicadoresResueltos() {
		$idArea = $_REQUEST['idArea'];
		$opcion = $_REQUEST['opcion'];
		$eje = $_REQUEST['idEje'];
		$indicador = $this->model->getIndicadoresResueltos(['idArea' => $idArea, 'opcion'=>$opcion, 'idEje'=>$eje]);
		return $indicador;
	}

	function obtenerIndicadoresEjeLateral($opcion,$estatus,$idArea) {
		$indicador = $this -> model -> getIndicadoresEjeLateral(['idArea' => $idArea, 'opcion'=>$opcion, 'estatus' => $estatus]);
		return $indicador;
	}

	function renderTabla() {
		$idArea = $_REQUEST['idArea'];
		$opcion = $_REQUEST['opcion'];
		$idUsuario = $_REQUEST['idUsuario'];
		$anio = $_REQUEST['anio'];
		$size = '128';
		$aux = 'r';
		$indicadores = $this -> model -> getIndicadoresEjeLateral(['idArea' => $idArea, 'opcion'=>$opcion]);
		//var_dump( $indicadores);
		$this -> vista -> indicadores = $indicadores;
		if($opcion == 'enviado'){
			$size = '154';
			$aux = 'e';
		} else if($opcion == 'invitado') {
			$size = '179';
			$aux = 'e';
		}
		$this -> vista -> size = $size;
		$this -> vista -> opcion = $opcion;
		$this -> vista -> aux = $aux;
		$this -> vista -> idArea = $idArea;
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> anio = $anio;
		$this -> vista -> renderizar('indicador/tabla');
	}

	function renderMosaico() {
		$idArea = $_REQUEST['idArea'];
		$idAreaU = $_REQUEST['idAreaU'];
		$idUsuario = $_REQUEST['idUsuario'];
		$anio = $_REQUEST['anio'];
		$indicadores = $this -> model -> getIndicadorPortada(['idArea' => $idArea]);
		
		$this -> vista -> indicadores = $indicadores;
		$this -> vista -> idArea = $idArea;
		$this -> vista -> idAreaU = $idAreaU;
		$this -> vista -> idUsuario = $idUsuario;
		$this -> vista -> anio = $anio;
		$this -> vista -> renderizar('indicador/mosaico');
	}
}
?>