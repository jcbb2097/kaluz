<?php
class Usuario {
	public $idUsuario;
	public $nombre;
	public $apellidoP;
	public $apellidoM;
	public $idPersona;

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setApellidoP($apellidoP){
		$this->apellidoP = $apellidoP;
	}
	public function setApellidoM($apellidoM){
		$this->apellidoM = $apellidoM;
	}
	public function setIdPersona($idPersona){
		$this->idPersona = $idPersona;
	}

	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getApellidoP(){
		return $this->apellidoP;
	}
	public function getApellidoM(){
		return $this->apellidoM;
	}
	public function getIdPersona() {
		return $this->idPersona;
	}
}
?>