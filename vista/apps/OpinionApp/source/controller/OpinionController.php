<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/OpinionDaoImp.php";
	include_once __DIR__."/../entities/Opinion.php";
	
	class OpinionController
	{
		function __construct()
		{
			
		}
		
		public function mostrarOpiniones()
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpiniones();
			return $array;
		}
		
		public function almacenarOpinion($descripcion,$fechaCreo,$idOrigen,$idTipo,$idProceso,$estatus,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero,$usuarioCreo,$fechaCrea,$recibeInfo)
		{
			$daoImpAct = new OpinionDaoImp();
			$act = new Opinion($descripcion,$fechaCreo,$idOrigen,$idTipo,$idProceso,$estatus,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero,$usuarioCreo,$fechaCrea,$recibeInfo);
			return ($daoImpAct -> registrarOpinion($act));
		}

		public function mostrarOpinion($idOpinion)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinion($idOpinion);
			return $array;
		}

		public function actualizarOpinion($idOpinion,$descripcion,$fechaCreo,$idTipo,$nombre,$apPat,$apMat,$email,$telefono,$usuarioMod,$fechaMod)
		{
			$daoImpAct = new OpinionDaoImp();
			$act = new Opinion($idOpinion,$descripcion,$fechaCreo,$idTipo,$nombre,$apPat,$apMat,$email,$telefono,$usuarioMod,$fechaMod);
			return ($daoImpAct -> modificarOpinion($act));
		}

		public function eliminarOpinionLibro($idOpinion)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> eliminarOpinionLibro($idOpinion);
			return $array;
		}
		
		public function mostrarOpinionesEje($id)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesEje($id);
			return $array;
		}

		public function mostrarDetalleOpinionTurnada($id)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerDetalleOpinionTurnada($id);
			return $array;
		}

		public function mostrarOpinionesOrigen($id)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesOrigen($id);
			return $array;
		}

		public function mostrarOpinionesTipo($id)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesTipo($id);
			return $array;
		}

		public function mostrarOpinionesGlobalKpi()
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesGlobalKpi();
			return $array;
		}

		public function mostrarOpinionesAnualKpi($anio)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesAnualKpi($anio);
			return $array;
		}

		public function mostrarOpinionesTurnadasEjeResponder($idEje,$cadena)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesTurnadasEjeResponder($idEje,$cadena);
			return $array;
		}

		public function mostrarNombreEje($idEje)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerNombreEje($idEje);
			return $array;
		}

		public function mostrarNombreArea($idArea)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerNombreArea($idArea);
			return $array;
		}

		public function mostrarOpinionesTurnadasAreaResponder($idArea,$cadena)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerOpinionesTurnadasAreaResponder($idArea,$cadena);
			return $array;
		}

		public function mostrarResponsableEje($idEje)
		{
			$daoImpAct = new OpinionDaoImp();
			$array = $daoImpAct -> obtenerResponsableEje($idEje);
			return $array;
		}

		
	}

?>