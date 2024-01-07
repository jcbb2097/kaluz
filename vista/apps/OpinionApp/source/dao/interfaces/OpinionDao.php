<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Opinion.php";

interface OpinionDao
{
	public function obtenerOpiniones();
	public function registrarOpinion(Opinion $act);
	public function obtenerOpinion($idOpinion);
	public function modificarOpinion(Opinion $act);
	public function eliminarOpinionLibro($idOpinion);
	
	public function obtenerOpinionesEje($id);
	public function obtenerDetalleOpinionTurnada($id);
	public function obtenerOpinionesOrigen($id);
	public function obtenerOpinionesTipo($id);

	public function obtenerOpinionesGlobalKpi();
	public function obtenerOpinionesAnualKpi($anio);
	public function obtenerOpinionesTurnadasEjeResponder($idEje,$cadena);

	public function obtenerNombreEje($idEje);
	public function obtenerNombreArea($idArea);
	public function obtenerOpinionesTurnadasAreaResponder($idArea,$cadena);
	public function obtenerResponsableEje($idEje);

}

?>