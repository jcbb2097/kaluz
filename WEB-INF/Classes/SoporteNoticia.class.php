<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class SoporteNoticia{
	private $idSoporteNoticia;
	private $nombre;
	private $fechaAlta;
	private $modificacion;
	private $activo;

	public function getSoporteNoticia(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_soporteNoticia WHERE IdSoporte = " . $this->idSoporteNoticia;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idSoporteNoticia = $rs['IdSoporte'];
			$this->nombre = $rs['Nombre'];
			$this->fechaAlta = $rs['FechaAlta'];
			$this->modificacion = $rs['FechaModificacion'];
			$this->activo = $rs['Activo'];
			return true;
		}
		return false;
	}

	public function agregarSoporteNoticia(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_soporteNoticia (Nombre, FechaAlta, FechaModificacion, Activo) VALUES('".$this->descripcion."', NOW(), NOW(), 1);";
		$this->idSoporteNoticia = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idSoporteNoticia == 0 || $this->idSoporteNoticia == null) {
            return false;
        }
        return true;
	}

	public function editarSoporteNoticia(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_soporteNoticia SET Nombre = '".$this->nombre."', FechaModificacion = NOW() WHERE IdSoporte=" . $this->idSoporteNoticia;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_soporteNoticia', 'IdSoporte = ' . $this->idSoporteNoticia);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarSoporteNoticia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_soporteNoticia WHERE IdSoporte = $this->idSoporteNoticia;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_soporteNoticia", "IdSoporte = " . $this->idSoporteNoticia);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidSoporteNoticia(){
		return $this->idSoporteNoticia;
	}
	function setidSoporteNoticia($idSoporteNoticia){
		$this->idSoporteNoticia = $idSoporteNoticia;
	}

	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre = $nombre;
	}
}

?>