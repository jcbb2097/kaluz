<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/PaisDaoImp.php";
	include_once __DIR__."/../entities/Pais.php";
	
	class PaisController
	{
		function __construct()
		{
			
		}
		
		public function mostrarPaises()
		{
			$daoImpAct = new PaisDaoImp();
			$paises = $daoImpAct -> obtenerPaises();
			return $paises;
		}
		
		public function mostrarEstadosMexico()
		{
			$daoImpAct = new PaisDaoImp();
			$paises = $daoImpAct -> obtenerEstadosMexico();
			return $paises;
		}
		
	}

?>