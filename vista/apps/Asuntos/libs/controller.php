<?php 

class Controller {
 
	function __construct() {
		$this->vista = new View();
	}

 	function cargarModelo($modeloNombre) {
 		$url = 'models/'.$modeloNombre.'Model.php';
 		if(file_exists($url)) {
 			require_once $url;
 			$modeloNombre = $modeloNombre.'Model';
 			$this->model = new $modeloNombre();
 		}
 	}

}

?>