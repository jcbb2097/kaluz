<?php

class Asunto {
	public $idConversacion;
	public $titulo;
	public $idOrigen;
	public $origen;
	public $idUsuarioOrigen;
	public $idDestino;
	public $destino;
	public $idUsuarioDestino;
	public $estatus;
	public $fechaInicio;
	public $fechaFin;
	public $fechaRespuesta;
	public $numero;
	public $numero2;
	public $numero3;
	public $actividad;
	public $tipo;
	public $expo;
	public $emisorfechaultres;
	public $receptorfechaultres;
	public $invitadofechaultres;

	public function setIdConversacion($idConversacion) {
		$this->idConversacion = $idConversacion;
	}
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function setIdOrigen($idOrigen) {
		$this->idOrigen = $idOrigen;
	}
	public function setIdDestino($idDestino) {
		$this->idDestino = $idDestino;
	}
	public function setOrigen($origen) {
		$this->origen = $origen;
	}
	public function setDestino($destino) {
		$this->destino = $destino;
	}
	public function setIdUsuarioDestino($idUsuarioDestino) {
		$this->idUsuarioDestino = $idUsuarioDestino;
	}
	public function setIdUsuarioOrigen($idUsuarioOrigen) {
		$this->idUsuarioOrigen = $idUsuarioOrigen;
	}
	public function setEstatus($estatus) {
		$this->estatus = $estatus;
	}
	public function setFechaInicio($fechaInicio) {
		$this->fechaInicio = $fechaInicio;
	}
	public function setFechaFin($fechaFin) {
		$this->fechaFin = $fechaFin;
	}
	public function setFechaRespuesta($fechaRespuesta) {
		$this->fechaRespuesta = $fechaRespuesta;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
	}
	public function setNumero2($numero2) {
		$this->numero2 = $numero2;
	}
	public function setNumero3($numero3) {
		$this->numero3 = $numero3;
	}
	public function setActividad($actividad) {
		$this->actividad = $actividad;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	public function setExpo($expo) {
		$this->expo = $expo;
	}

	public function setInvitadosUltres($inv) {
		$this->invitadofechaultres = $inv;
	}
	public function setReceptorUltres($rec) {
		$this->receptorfechaultres = $rec;
	}
	public function setEmisorUltres($emis) {
		$this->emisorfechaultres = $emis;
	}

	public function getIdConversacion() {
		return $this->idConversacion;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	public function getIdOrigen() {
		return $this->idOrigen;
	}
	public function getIdDestino() {
		return $this->idDestino;
	}
	public function getOrigen() {
		return $this->origen;
	}
	public function getDestino() {
		return $this->destino;
	}
	public function getIdUsuarioOrigen() {
		return $this->idUsuarioOrigen;
	}
	public function getIdUsuarioDestino() {
		return $this->idUsuarioDestino;
	}
	public function getEstatus() {
		return $this->estatus;
	}
	public function getFechaInicio() {
		return $this->fechaInicio;
	}
	public function getFechaFin() {
		return $this->fechaFin;
	}
	public function getFechaRespuesta() {
		return $this->fechaRespuesta;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function getNumero2() {
		return $this->numero2;
	}
	public function getNumero3() {
		return $this->numero3;
	}
	public function getActividad() {
		return $this->actividad;
	}
	public function getTipo() {
		return $this->tipo;
	}
	public function getExpo() {
		return $this->expo;
	}
	public function getFechaResEmisor() {
		return $this->emisorfechaultres;
	}
	public function getFechaResReceptor() {
		return $this->receptorfechaultres;
	}
	public function getFechaResInvitado() {
		return $this->invitadofechaultres;
	}

}

?>
