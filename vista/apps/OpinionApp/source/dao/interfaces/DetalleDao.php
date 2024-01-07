<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Detalle.php";

interface DetalleDao
{
	public function registrarTurnarOpinion(Detalle $act);
	public function modificarOpinionTurnada(Detalle $act);

}

?>