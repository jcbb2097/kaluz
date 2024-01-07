<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Indicador.php";

interface IndicadorDao
{
	public function totalOpiniones();
	public function opinionesAnio();
	public function opinionesTipo();
	public function opinionesOrigen();
	public function opinionesEje();
	public function totalOpinionesPorTurnar();
	public function totalOrigenTurnar();

	public function totalAnioOpinion($anio);
	public function totalOpinionEje($idEje);
	public function totalOpinionArea($idArea);
	public function obtenerTiposOpinion();
	public function obtenerOpinionTipoAtencionEje($idEje,$idTipo);
	public function obtenerOpinionTipoAtencionArea($idArea,$idTipo);
	public function obtenerRangoAnio();

	public function totalNoAtendidasEje($idEje);
	public function totalNoAtendidasOrigenEje($idEje,$cadena);
	public function totalNoAtendidasArea($idArea);

	public function totalTipoNoAtendidasEje($idEje);
	public function totalCorreoNoAtendidasEje($idEje);
	public function totalTipoNoAtendidasArea($idArea);
	public function totalCorreoNoAtendidasArea($idArea);
	
}

?>