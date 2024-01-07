<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Estatuse{
	private $nombre;
	private $descripcion;
	private $tf;
    public function getEstatuse(){
    	$catalogo = new catalogo();
    	  $consultaP = "SELECT nombre FROM c_estatusextintorp WHERE idEstatusExtintor = '".$this->dispositivosod."'";
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->Estatustx = $row['nombre'];
    		return true;
    	}
    	return false;
    }

    public function corroborarEstatuse(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_estatusextintorp WHERE nombre = '".$this->Estatustx."'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoEstatuse(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_estatusextintorp (nombre, estatus, fechaCreacion, usuarioCreacion,fechaUltimaModificacion,usuarioUltimaModificacion, pantalla)
    	VALUES ('".$this->Estatustx."',".$this->Estatus.", NOW(), 'prueba',NOW(), 'prueba','alta_Estatuse.php');";
    	$this->dispositivosod = $catalogo->insertarRegistro($insertarA);
    	//echo "<br><br>$insertarA<br><br>"; 
        if ($this->dispositivosod == 0 || $this->dispositivosod == null) {
            return false;
        }
        return true;
    }
    public function editarEstatuse(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_estatusextintorp SET nombre='".$this->Estatustx."' WHERE idEstatusExtintor ='".$this->dispositivosod."' ";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_estatusextintorp', 'idEstatusExtintor = ' . $this->dispositivosod);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarEstatuse(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_estatusextintorp WHERE idEstatusExtintor = $this->dispositivosod;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_estatusextintorp', 'idEstatusExtintor = ' . $this->dispositivosod);
    	//echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }

    function setdispositivosod($dispositivosod){
        $this->dispositivosod = $dispositivosod;
    }
    function getdispositivosod(){
        return $this->dispositivosod;
    }
        function setEstatus($Estatus){
        $this->Estatus = $Estatus;
    }
    function getEstatus(){
        return $this->Estatus;
    }
           function setEstatustx($Estatustx){
        $this->Estatustx = $Estatustx;
    }
    function getEstatustx(){
        return $this->Estatustx;
    }


}
?>  