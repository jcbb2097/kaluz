<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Actividad.php";

interface ActividadDao
{
	public function obtenerActGlobalEjeCat($idEje,$anio,$idCategoria);
	public function obtenerActGeneralEjeCat($idEje,$anio,$idCategoria,$idActividadGlobal);

}

?>