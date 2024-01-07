<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/DetalleDaoImp.php";
	include_once __DIR__."/../entities/Detalle.php";
	
	class DetalleController
	{
		function __construct()
		{
			
		}
		
		
		public function almacenarTurnarOpinion($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idUsuario,$idPersonaResponde)
		{
			$daoImpAct = new DetalleDaoImp();
			$act = new Detalle($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idUsuario,$idPersonaResponde);
			return ($daoImpAct -> registrarTurnarOpinion($act));
		}

		public function actualizarOpinionTurnada($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idPersonaResponde)
		{
			$daoImpAct = new DetalleDaoImp();
			$act = new Detalle($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idPersonaResponde);
			return ($daoImpAct -> modificarOpinionTurnada($act));
		}
		
	}

?>