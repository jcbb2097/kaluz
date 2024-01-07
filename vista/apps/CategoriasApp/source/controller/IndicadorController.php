<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/IndicadorDaoImp.php";
	include_once __DIR__."/../entities/Indicador.php";
	
	class IndicadorController
	{
		function __construct()
		{
			
		}
		public function mostrarTotalOpiniones()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalOpiniones();
			return $array;
		}

		public function mostrarOpinionesAnio()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> opinionesAnio();
			return $array;
		}

		public function mostrarOpinionesTipo()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> opinionesTipo();
			return $array;
		}

		public function mostrarOpinionesOrigen()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> opinionesOrigen();
			return $array;
		}
		
		public function mostrarOpinionesEje()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> opinionesEje();
			return $array;
		}
		
		public function mostrarTotalOpinionesPorTurnar()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalOpinionesPorTurnar();
			return $array;
		}
		
		public function mostrarTotalOrigenTurnar()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalOrigenTurnar();
			return $array;
		}
		
	}

?>