<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class TipoNoticia{
	private $idTipoNoticia;
	private $descripcion;

	public function getTipoNoticia(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_tipo_noticia WHERE Id_tipo = " . $this->idTipoNoticia;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idTipoNoticia = $rs['Id_tipo'];
			$this->descripcion = $rs['Descripcion'];
			return true;
		}
		return false;
	}

	public function agregarTipoNoticia(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_tipo_noticia (Descripcion) VALUES('".$this->descripcion."');";
		$this->idTipoNoticia = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idTipoNoticia == 0 || $this->idTipoNoticia == null) {
            return false;
        }
        return true;
	}

	public function editarTipoNoticia(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_tipo_noticia SET Descripcion = '".$this->descripcion."' WHERE Id_tipo =" . $this->idTipoNoticia;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_tipo_noticia', 'Id_tipo = ' . $this->idTipoNoticia);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarTipoNoticia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_tipo_noticia WHERE Id_tipo = $this->idTipoNoticia;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_tipo_noticia", "Id_tipo = " . $this->idTipoNoticia);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidTipoNoticia(){
		return $this->idTipoNoticia;
	}
	function setidTipoNoticia($idTipoNoticia){
		$this->idTipoNoticia = $idTipoNoticia;
	}

	function getDescripcion(){
		return $this->descripcion;
	}
	function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
}

?>