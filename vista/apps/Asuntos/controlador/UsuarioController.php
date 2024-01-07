<?php
class UsuarioController extends Controller {

	function __construct() {
		parent:: __construct();
	}

	function obtenerUsuarios() {
		$idArea = $_POST['idArea'];
		$usuarios = $this->model->getUsuarios(['idArea' => $idArea]);
		return $usuarios;
	}
}
?>