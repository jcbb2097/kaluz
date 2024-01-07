<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/AreaDaoImp.php";
	include_once __DIR__."/../entities/Area.php";
	
	class AreaController
	{
		function __construct()
		{
			
		}
		
		public function mostrarAreas()
		{
			$daoImpAct = new AreaDaoImp();
			$array = $daoImpAct -> obtenerAreas();
			return $array;
		}
		
		
		
	}

?>