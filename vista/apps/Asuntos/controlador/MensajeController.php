<?php 

class MensajeController extends Controller {
	function __construct() {
		parent:: __construct();
		//posiblemente no necesite una vista
	}

	function obtenerMensajes($idConversacion) {
		$mensajes = $this -> model -> getMensajes($idConversacion);
		return $mensajes;
	}

	function guardarMensaje() {
		$idConversacion = $_POST['idConversacion'];
		$idAreaOrigen = $_POST['idArea'];
		$usuario = $_POST['idUsuario'];
		$mensaje = $_POST['mensaje'];
		$this-> model -> guardarRespuesta(['idConversacion'=>$idConversacion,'idArea'=>$idAreaOrigen, 'idUsuario' => $usuario,'mensaje'=>$mensaje]);
	}

}

?>