<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class MedioNoticia{
	private $idMedio;
	private $nombre;
	private $fechaAlta;
	private $modificacion;
	private $activo;

	public function getTipoMedio(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_medio WHERE idMedio = " . $this->idMedio;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idMedio = $rs['idMedio'];
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
		$consulta = "INSERT INTO c_medio (Nombre, FechaAlta, FechaModificacion, Activo) VALUES(".$this->nombre."', NOW(), NOW(), 1);";
		$this->idMedio = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idMedio == 0 || $this->idMedio == null) {
            return false;
        }
        return true;
	}

	public function editarTipoMedio(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_medio SET Nombre = '".$this->nombre."', FechaModificacion = NOW() WHERE idMedio=". $this->idMedio;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_medio', 'idMedio = ' . $this->idMedio);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarTipoMedio(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_medio WHERE idMedio = $this->idMedio;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_medio", "idMedio = " . $this->idMedio);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidMedio(){
		return $this->idMedio;
	}
	function setidMedio($idMedio){
		$this->idMedio = $idMedio;
	}

	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre = $nombre;
	}
}

?>