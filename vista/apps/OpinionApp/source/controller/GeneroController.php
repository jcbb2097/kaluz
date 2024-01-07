<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/GeneroDaoImp.php";
	include_once __DIR__."/../entities/Genero.php";
	
	class GeneroController
	{
		function __construct()
		{
			
		}
		
		public function mostrarGeneros()
		{
			$daoImpAct = new GeneroDaoImp();
			$array = $daoImpAct -> obtenerGeneros();
			return $array;
		}
		
		
		
	}

?>