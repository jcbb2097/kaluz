<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class Calificacion{
	private $idCalificacion;
	private $nombre;
	private $fechaAlta;
	private $modificacion;
	private $activo;

	public function getCalificacion(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_calificacion WHERE idCalificacion = " . $this->idCalificacion;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idCalificacion = $rs['idCalificacion'];
			$this->nombre = $rs['Nombre'];
			$this->fechaAlta = $rs['FechaAlta'];
			$this->modificacion = $rs['FechaModificacion'];
			$this->activo = $rs['Activo'];
			return true;
		}
		return false;
	}

	public function agregarCalificacion(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_calificacion (Nombre, FechaAlta, FechaModificacion, Activo) VALUES('".$this->nombre."', NOW(), NOW(), 1);";
		$this->idCalificacion = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idCalificacion == 0 || $this->idCalificacion == null) {
            return false;
        }
        return true;
	}

	public function editarCalificacion(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_calificacion SET Nombre = '".$this->nombre."', FechaModificacion = NOW() WHERE idCalificacion = ". $this->idCalificacion;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_calificacion', 'idCalificacion = ' . $this->idCalificacion);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarCalificacion(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_calificacion WHERE idCalificacion = $this->idCalificacion;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_calificacion", "idCalificacion = " . $this->idCalificacion);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidCalificacion(){
		return $this->idCalificacion;
	}
	function setidCalificacion($idCalificacion){
		$this->idCalificacion = $idCalificacion;
	}

	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre = $nombre;
	}
}

?>