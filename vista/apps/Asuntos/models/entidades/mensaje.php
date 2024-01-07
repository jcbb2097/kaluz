<?php

class Mensaje {
	private $idConversacion;
	private $idRespuesta;
	private $idUsuario;
	private $usuario;
	private $idArea;
	private $area;
	private $respuesta;
	private $fecha;
	private $orden;
	private $indice;

	public function getIdRespuesta() {
		return $this->idRespuesta;
	}
	public function getIdConversacion() {
		return $this->idConversacion;
	}
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	public function getUsuario() {
		return $this->usuario;
	}
	public function getIdArea() {
		return $this->idArea;
	}
	public function getArea() {
		return $this->area;
	}
	public function getRespuesta() {
		return $this->respuesta;
	}
	public function getFecha() {
		return $this->fecha;
	}
	public function getOrden() {
		return $this->orden;
	}
	public function getIndice() {
		return $this->indice;
	}

	public function setIdRespuesta($idRespuesta) {
		$this -> idRespuesta = $idRespuesta;
	}
	public function setIdConversacion($idConversacion) {
		$this -> idConversacion = $idConversacion;
	}
	public function setIdUsuario($idUsuario) {
		$this -> idUsuario = $idUsuario;
	}
	public function setUsuario($usuario) {
		$this -> usuario = $usuario;
	}
	public function setIdArea($idArea) {
		$this -> idArea = $idArea;
	}
	public function setArea($area) {
		$this -> area = $area;
	}
	public function setRespuesta($respuesta) {
		$this -> respuesta = $respuesta;
	}
	public function setFecha($fecha) {
		$this -> fecha = $fecha;
	}
	public function setOrden($orden) {
		$this -> orden = $orden;
	}
	public function setIndice($indice) {
		$this -> indice = $indice;
	}

}

?>