<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Pais.php";

interface PaisDao
{
	public function obtenerPaises();
	public function obtenerEstadosMexico();
}

?>