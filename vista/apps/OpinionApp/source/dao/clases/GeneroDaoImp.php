<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/GeneroDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Genero.php";
	
	class GeneroDaoImp implements GeneroDao
	{
		function __construct(){}
		
		public function obtenerGeneros()
		{
			$generos = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM mk_opinionGenero WHERE estatus = 1");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Genero();
					$act -> setId($row['id']);
					$act -> setNombre($row['nombre']);
					
					array_push($generos,$act);
				}
			}
			$conexion = null;
			return $generos;	
		}
		
	}

?>