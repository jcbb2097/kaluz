<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/ActividadDaoImp.php";
	include_once __DIR__."/../entities/Actividad.php";
	
	class ActividadController
	{
		function __construct()
		{
			
		}
		
		public function mostrarActGlobalEjeCat($idEje,$anio,$idCategoria)
		{
			$daoImpAct = new ActividadDaoImp();
			$array = $daoImpAct -> obtenerActGlobalEjeCat($idEje,$anio,$idCategoria);
			return $array;
		}
		
		public function mostrarActGeneralEjeCat($idEje,$anio,$idCategoria,$idActividadGlobal)
		{
			$daoImpAct = new ActividadDaoImp();
			$array = $daoImpAct -> obtenerActGeneralEjeCat($idEje,$anio,$idCategoria,$idActividadGlobal);
			return $array;
		}
		
	}

?>