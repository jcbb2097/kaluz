<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class LugarNoticias{
	private $idLugarNoticia;
	private $nombre;
	private $fechaAlta;
	private $FechaModificacion;
	private $activo;

	public function getLugarNoticia(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_lugarNoticia WHERE idLugarNoticia = " . $this->idLugarNoticia;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idLugarNoticia = $rs['idLugarNoticia'];
			$this->nombre = $rs['Nombre'];
			$this->fechaAlta = $rs['FechaAlta'];
			$this->FechaModificacion = $rs['FechaModificacion'];
			$this->activo = $rs['Activo'];
			return true;
		}
		return false;
	}

	public function agregarLugarNoticia(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_lugarNoticia (Nombre, FechaAlta, FechaModificacion, Activo) VALUES('".$this->nombre."', NOW(), NOW(), 1);";
		$this->idLugarNoticia = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idLugarNoticia == 0 || $this->idLugarNoticia == null) {
            return false;
        }
        return true;
	}

	public function editarLugarNoticia(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_lugarNoticia SET Nombre = '".$this->nombre."', FechaModificacion=NOW() WHERE idLugarNoticia =". $this->idLugarNoticia;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_lugarNoticia', 'idLugarNoticia = ' . $this->idLugarNoticia);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarLugarNoticia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_lugarNoticia WHERE idLugarNoticia = $this->idLugarNoticia;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_lugarNoticia", "idLugarNoticia = " . $this->idLugarNoticia);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidLugarNoticia(){
		return $this->idLugarNoticia;
	}
	function setidLugarNoticia($idLugarNoticia){
		$this->idLugarNoticia = $idLugarNoticia;
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