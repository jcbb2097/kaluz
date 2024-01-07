<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/CategoriaDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Categoria.php";
	
	class CategoriaDaoImp implements CategoriaDao
	{
		function __construct(){}
		
		public function obtenerCategoriasEje($idEje,$anio)
		{
			$categorias = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_categoriasdeejes WHERE idEje = :idEje AND anio = :anio AND nivelCategoria = 1 
			ORDER BY orden asc");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> bindValue(':anio',$anio,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Categoria();
					$act -> setIdCategoria($row['idCategoria']);
					$act -> setDescripcion($row['descCategoria']);
					$act -> setAnio($row['anio']);
					$act -> setOrden($row['orden']);
					
					array_push($categorias,$act);
				}
			}
			$conexion = null;
			return $categorias;	
		}

		public function obtenerSubcategorias($idCategoriaPadre)
		{
			$categorias = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_categoriasdeejes WHERE  nivelCategoria = 2 AND idCategoriaPadre = :idCategoriaPadre
			ORDER BY orden asc");
			$consulta -> bindValue(':idCategoriaPadre',$idCategoriaPadre,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Categoria();
					$act -> setIdCategoria($row['idCategoria']);
					$act -> setIdCategoriaPadre($row['idCategoriaPadre']);
					$act -> setDescripcion($row['descCategoria']);
					$act -> setAnio($row['anio']);
					$act -> setOrden($row['orden']);
					
					array_push($categorias,$act);
				}
			}
			$conexion = null;
			return $categorias;	
		}
		
	}

?>