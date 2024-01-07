<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Ubicacion{
	private $nombre;
	private $descripcion;
	private $tf;
    public function getUbicacion(){
    	$catalogo = new catalogo();
    	 $consultaP = "SELECT * FROM c_espacios WHERE id_espacio = " . $this->ubicacionid;
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->nombre = $row['espacio'];
			$this->descripcion = $row['descripcion'];
            $this->id_sede = $row['sed_id_sede'];
    		return true;
    	}
    	return false;
    }

    public function corroborarUbicacion(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_espacios WHERE espacio = '" . $this->nombre . "'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoUbicacion(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_espacios (espacio, descripcion, sed_id_sede, estatus, fechaCreacion, usuarioCreacion,fechaUltimaModificacion,usuarioUltimaModificacion, pantalla)
    	VALUES ('".$this->nombre."','".$this->descripcion."', '".$this->id_sede."',1, NOW(), 'sistemas',NOW(), 'sistemas','alta_ubicaciones.php');";
    	$this->Simulacroid = $catalogo->insertarRegistro($insertarA);
    	//echo "<br><br>$insertarA<br><br>"; 
        if ($this->Simulacroid == 0 || $this->Simulacroid == null) {
            return false;
        }
        return true;
    }
    public function editarUbicacion(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_espacios SET espacio='".$this->nombre."', descripcion='".$this->descripcion."', sed_id_sede='".$this->id_sede."' WHERE id_espacio ='".$this->ubicacionid."' ";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_espacios', 'id_espacio = ' . $this->ubicacionid);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarUbicacion(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_espacios WHERE id_espacio = $this->ubicacionid;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_espacios', 'id_espacio = ' . $this->ubicacionid);
    	//echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
	function getnombre(){
    	return $this->nombre;
    }
    function setnombre($nombre){
    	$this->nombre = $nombre;
    }
    function getdescripcion(){
    	return $this->descripcion;
    }
    function setdescripcion($descripcion){
    	$this->descripcion = $descripcion;
    }
    function getubicacionid(){
    	return $this->ubicacionid;
    }
    function setubicacionid($ubicacionid){
    	$this->ubicacionid = $ubicacionid;
    }
    function getid_sede(){
        return $this->id_sede;
    }
    function setid_sede($id_sede){
        $this->id_sede = $id_sede;
    }

}
?>