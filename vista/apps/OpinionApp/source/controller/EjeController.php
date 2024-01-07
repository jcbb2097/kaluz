<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/EjeDaoImp.php";
	include_once __DIR__."/../entities/Eje.php";
	
	class EjeController
	{
		function __construct()
		{
			
		}
		
		public function mostrarEjes()
		{
			$daoImpAct = new EjeDaoImp();
			$array = $daoImpAct -> obtenerEjes();
			return $array;
		}
		
		
		
	}

?>