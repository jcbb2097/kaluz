<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/ReporteDaoImp.php";
	include_once __DIR__."/../entities/Reporte.php";
	
	class ReporteController
	{
		function __construct()
		{
			
		}
		public function mostrarTotalOpinionArea($idArea,$anio)
		{
			$daoImpAct = new ReporteDaoImp();
			$array = $daoImpAct -> totalOpinionArea($idArea,$anio);
			return $array;
		}

		public function mostrarTotalOpinionEje($idEje,$anio)
		{
			$daoImpAct = new ReporteDaoImp();
			$array = $daoImpAct -> totalOpinionEje($idEje,$anio);
			return $array;
		}

		public function mostrarTotalOpinionEjeArea($idEje,$anio)
		{
			$daoImpAct = new ReporteDaoImp();
			$array = $daoImpAct -> totalOpinionEjeArea($idEje,$anio);
			return $array;
		}

		
		
		
	}

?>