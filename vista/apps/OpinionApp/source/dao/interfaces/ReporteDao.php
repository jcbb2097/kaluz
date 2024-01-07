<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Reporte.php";

interface ReporteDao
{
	public function totalOpinionArea($idArea,$anio);
	public function totalOpinionEje($idEje,$anio);
	public function totalOpinionEjeArea($idEje,$anio);
}

?>