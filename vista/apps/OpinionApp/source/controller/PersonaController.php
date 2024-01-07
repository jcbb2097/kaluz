<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/PersonaDaoImp.php";
	include_once __DIR__."/../entities/Persona.php";
	
	class PersonaController
	{
		function __construct()
		{
			
		}
		
		public function mostrarPersonasArea($idArea)
		{
			$daoImpAct = new PersonaDaoImp();
			$array = $daoImpAct -> obtenerPersonasArea($idArea);
			return $array;
		}
		
		
		
	}

?>