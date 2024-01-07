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

		public function mostrarTotalAnioOpinion($anio)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalAnioOpinion($anio);
			return $array;
		}

		public function mostrarTotalOpinionEje($idEje)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalOpinionEje($idEje);
			return $array;
		}

		public function mostrarTotalOpinionArea($idArea)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalOpinionArea($idArea);
			return $array;
		}

		public function mostrarTiposOpinion()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> obtenerTiposOpinion();
			return $array;
		}

		public function mostrarOpinionTipoAtencionEje($idEje,$idTipo)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> obtenerOpinionTipoAtencionEje($idEje,$idTipo);
			return $array;
		}

		public function mostrarOpinionTipoAtencionArea($idArea,$idTipo)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> obtenerOpinionTipoAtencionArea($idArea,$idTipo);
			return $array;
		}

		public function mostrarRangoAnio()
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> obtenerRangoAnio();
			return $array;
		}

		public function mostrarTotalNoAtendidasEje($idEje)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalNoAtendidasEje($idEje);
			return $array;
		}
		
		public function mostrarTotalNoAtendidasOrigenEje($idEje,$cadena)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalNoAtendidasOrigenEje($idEje,$cadena);
			return $array;
		}

		public function mostrarTotalNoAtendidasArea($idArea)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalNoAtendidasArea($idArea);
			return $array;
		}

		public function mostrarTotalTipoNoAtendidasEje($idEje)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalTipoNoAtendidasEje($idEje);
			return $array;
		}

		public function mostrarTotalCorreoNoAtendidasEje($idEje)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalCorreoNoAtendidasEje($idEje);
			return $array;
		}

		public function mostrarTotalTipoNoAtendidasArea($idArea)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalTipoNoAtendidasArea($idArea);
			return $array;
		}

		public function mostrarTotalCorreoNoAtendidasArea($idArea)
		{
			$daoImpAct = new IndicadorDaoImp();
			$array = $daoImpAct -> totalCorreoNoAtendidasArea($idArea);
			return $array;
		}

		
		
	}

?>