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
	
}

?>