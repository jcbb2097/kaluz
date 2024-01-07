<?php
class Eje {
	private $idEje;
	private $descripcion;

	public function setIdEje($idEje){
		$this->idEje = $idEje;
	}
	public function setNombre($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getIdEje(){
		return $this->idEje;
	}
	public function getNombre(){
		return $this->descripcion;
	}
}
?>