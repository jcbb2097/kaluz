<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Evidencia.php";

interface EvidenciaDao
{
	public function registrarRespuesta(Evidencia $act);
	
}

?>