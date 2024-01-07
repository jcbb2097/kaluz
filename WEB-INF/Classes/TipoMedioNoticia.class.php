<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class TipoMedio{
	private $idTipoMedio;
	private $idSoporteMedio;
	private $nombre;
	private $fechaAlta;
	private $modificacion;
	private $activo;

	public function getTipoMedio(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_tipoMedio WHERE idTipoMedio = " . $this->idTipoMedio;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idTipoMedio = $rs['idTipoMedio'];
			$this->idSoporteMedio = $rs['idSoporteMedio'];
			$this->nombre = $rs['Nombre'];
			$this->fechaAlta = $rs['FechaAlta'];
			$this->modificacion = $rs['FechaModificacion'];
			$this->activo = $rs['Activo'];
			return true;
		}
		return false;
	}

	public function agregarTipoMedio(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_tipoMedio (idSoporteMedio, Nombre, FechaAlta, FechaModificacion, Activo) VALUES(".$this->idSoporteMedio.",'".$this->nombre."', NOW(), NOW(), 1);";
		$this->idTipoMedio = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idTipoMedio == 0 || $this->idTipoMedio == null) {
            return false;
        }
        return true;
	}

	public function editarTipoMedio(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_tipoMedio SET idSoporteMedio = ".$this->idSoporteMedio.", Nombre = '".$this->nombre."', FechaModificacion = NOW() WHERE idTipoMedio =" . $this->idTipoMedio;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_tipoMedio', 'idTipoMedio = ' . $this->idTipoMedio);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarTipoMedio(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_tipoMedio WHERE idTipoMedio = $this->idTipoMedio;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_tipoMedio", "idTipoMedio = " . $this->idTipoMedio);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidTipoMedio(){
		return $this->idTipoMedio;
	}
	function setidTipoMedio($idTipoMedio){
		$this->idTipoMedio = $idTipoMedio;
	}

	function getidSoporteMedio(){
		return $this->idSoporteMedio;
	}
	function setidSoporteMedio($idSoporteMedio){
		$this->idSoporteMedio = $idSoporteMedio;
	}

	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre = $nombre;
	}
}

?>