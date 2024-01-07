<?php 

class ActividadController extends Controller {
	function __construct() {
		parent:: __construct();
		//posiblemente no necesite una vista
	}

	function obtenerGlobales($eje, $anio,$orden,$tipo) {
		$actividades = $this -> model -> getActividadesEje(['eje' => $eje, 'anio' => $anio,'orden'=> $orden,'tipo' => $tipo]);
		return $actividades;
	}

	function obtenerActividades($superior, $orden) {
		$actividades = $this -> model -> getActividades(['superior' => $superior, 'orden'=>$orden]);
		return $actividades;
	}

	function obtenerActEnt($idEE) {
		$actividades = $this -> model -> getActividadEntregable(['idEntregable' => $idEE]);
		return $actividades;
	}

}

?>