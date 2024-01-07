<?php
class IndicadorEje {
	private $idEje;
	private $estatus;
	private $total;
	private $noatendidos;
	private $conversacion;
	private $resueltos;

	public function getEje() {
		return $this -> idEje;
	}
	public function getEstatus() {
		return $this -> estatus;
	}
	public function getTotal() {
		return $this -> total;
	}
	public function getNoatendidos() {
		return $this -> noatendidos;
	}
	public function getConversacion() {
		return $this -> conversacion;
	}
	public function getResueltos() {
		return $this -> resueltos;
	}

	public function setEje($idEje) {
		$this -> idEje = $idEje;
	}
	public function setEstatus($estatus) {
		$this -> estatus = $estatus;
	}
	public function setTotal($total) {
		$this -> total = $total;
	}
	public function setNoatendidos($noatendidos) {
		$this -> noatendidos = $noatendidos;
	}
	public function setConversacion($conversacion) {
		$this -> conversacion = $conversacion;
	}
	public function setResueltos($resueltos) {
		$this -> resueltos = $resueltos;
	}
}
?>