<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/EvidenciaDaoImp.php";
	include_once __DIR__."/../entities/Evidencia.php";
	
	class EvidenciaController
	{
		function __construct()
		{
			
		}
		
		public function almacenarRespuesta($idOpinion,$respuesta,$archivo,$idUsuario,$fechaAtendio,$estatus,$datos,$clasificacion)
		{
			$daoImpAct = new EvidenciaDaoImp();
			$act = new Evidencia($idOpinion,$respuesta,$archivo,$idUsuario,$fechaAtendio,$estatus,$datos,$clasificacion);
			return ($daoImpAct -> registrarRespuesta($act));
		}
		
	}

?>