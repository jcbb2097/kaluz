<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Categoria.php";

interface CategoriaDao
{
	public function obtenerCategoriasEje($idEje,$anio);
	public function obtenerSubcategorias($idCategoriaPadre);
}

?>