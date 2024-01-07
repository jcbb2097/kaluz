<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class GeneroNoticia{
	private $idGenero;
	private $Descripcion;

	public function getSoporteNoticia(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_genero_noticia WHERE Id_genero = " . $this->idGenero;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idGenero = $rs['Id_genero'];
			$this->Descripcion = $rs['Descripcion'];
			return true;
		}
		return false;
	}

	public function agregarSoporteNoticia(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_genero_noticia (Descripcion) VALUES('".$this->Descripcion."');";
		$this->idGenero = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idGenero == 0 || $this->idGenero == null) {
            return false;
        }
        return true;
	}

	public function editarSoporteNoticia(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_genero_noticia SET Descripcion = '".$this->Descripcion."' WHERE Id_genero = " . $this->idGenero;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_genero_noticia', 'Id_genero = ' . $this->idGenero);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarSoporteNoticia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_genero_noticia WHERE Id_genero = $this->idGenero;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_genero_noticia", "Id_genero = " . $this->idGenero);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}


	function getidGenero(){
		return $this->idGenero;
	}
	function setidGenero($idGenero){
		$this->idGenero = $idGenero;
	}

	function getDescripcion(){
		return $this->Descripcion;
	}
	function setDescripcion($Descripcion){
		$this->Descripcion = $Descripcion;
	}
}

?>