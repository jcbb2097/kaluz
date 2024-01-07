<?php
/*created by leasim*/

	include_once __DIR__."/../dao/clases/CategoriaDaoImp.php";
	include_once __DIR__."/../entities/Categoria.php";
	
	class CategoriaController
	{
		function __construct()
		{
			
		}
		
		public function mostrarCategoriasEje($idEje,$anio)
		{
			$daoImpAct = new CategoriaDaoImp();
			$array = $daoImpAct -> obtenerCategoriasEje($idEje,$anio);
			return $array;
		}

		public function mostrarSubcategorias($idCategoriaPadre)
		{
			$daoImpAct = new CategoriaDaoImp();
			$array = $daoImpAct -> obtenerSubcategorias($idCategoriaPadre);
			return $array;
		}
		
		
		
	}

?>