<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class EtapaNoticias{
	private $idEtapa;
	private $nombre;
	private $fechaAlta;
	private $FechaModificacion;
	private $activo;

	public function getEtapaNoticia(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_etapa WHERE idEtapa = " . $this->idEtapa;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idEtapa = $rs['idEtapa'];
			$this->nombre = $rs['Nombre'];
			$this->fechaAlta = $rs['FechaAlta'];
			$this->FechaModificacion = $rs['FechaModificacion'];
			$this->activo = $rs['Activo'];
			return true;
		}
		return false;
	}

	public function agregarEtapaNoticia(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_etapa (Nombre, FechaAlta, FechaModificacion, Activo) VALUES('".$this->nombre."', NOW(), NOW(), 1);";
		$this->idEtapa = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idEtapa == 0 || $this->idEtapa == null) {
            return false;
        }
        return true;
	}

	public function editarEtapaNoticia(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_etapa SET Nombre = '".$this->nombre."', FechaModificacion=NOW() WHERE idEtapa =". $this->idEtapa;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_etapa', 'idEtapa = ' . $this->idEtapa);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarEtapaNoticia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_etapa WHERE idEtapa = $this->idEtapa;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_etapa", "idEtapa = " . $this->idEtapa);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidEtapa(){
		return $this->idEtapa;
	}
	function setidEtapa($idEtapa){
		$this->idEtapa = $idEtapa;
	}

	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre = $nombre;
	}
	
	function getfechaAlta(){
		return $this->fechaAlta;
	}
	function setfechaAlta($fechaAlta){
		$this->fechaAlta = $fechaAlta;
	}
	
	function getFechaModificacion(){
		return $this->FechaModificacion;
	}
	function setFechaModificacion($FechaModificacion){
		$this->FechaModificacion = $FechaModificacion;
	}

	function getActivo(){
		return $this->activo;
	}
	function setActivo($activo){
		$this->activo = $activo;
	}
}

?>