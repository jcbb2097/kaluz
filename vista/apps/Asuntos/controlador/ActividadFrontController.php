<?php

require_once 'actividadController.php';

require_once '../libs/view.php';
require_once '../libs/model.php';

$accion = $_POST['action'];
if($accion != "") {
	switch ($accion) {
		case 'actividadEje':
			$anio = $_POST['anio'];
			$eje = $_POST['eje'];
			$actC = new ActividadController();
			$actC -> cargarModelo('Actividad');
			$actividades = $actC -> obtenerGlobales ($eje,$anio);
			foreach ($actividades as $act) {
				echo '<option value="'.$act -> getId().'">'.$act -> getNombre().'</option>';
			}
		break;
		case 'actividad':
			$superior = $_POST['superior'];
			$actC = new ActividadController();
			$actC -> cargarModelo('Actividad');
			$actividades = $actC -> obtenerActividades ($superior);
			foreach ($actividades as $act) {
				echo '<option value="'.$act -> getId().'">'.$act -> getNombre().'</option>';
			}
		break;
		default:
			echo "No se pudo ejecutar la acción requerida";
		break;
	}
} else {
	echo "No se pudo ejecutar la acción requerida";
}

?>