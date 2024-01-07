<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Estatusd{
	private $nombre;
	private $descripcion;
	private $tf;
    public function getEstatusd(){
    	$catalogo = new catalogo();
    	  $consultaP = "SELECT nombre FROM c_estatusdispositivop WHERE idEstatusDispositivo = '".$this->dispositivosod."'";
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->Estatustx = $row['nombre'];
    		return true;
    	}
    	return false;
    }

    public function corroborarEstatusd(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_estatusdispositivop WHERE nombre = '".$this->Estatustx."'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoEstatusd(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_estatusdispositivop (nombre, estatus, fechaCreacion, usuarioCreacion,fechaUltimaModificacion,usuarioUltimaModificacion, pantalla)
    	VALUES ('".$this->Estatustx."',".$this->Estatus.", NOW(), 'prueba',NOW(), 'prueba','alta_simulacro.php');";
    	$this->dispositivosod = $catalogo->insertarRegistro($insertarA);
    	//echo "<br><br>$insertarA<br><br>"; 
        if ($this->dispositivosod == 0 || $this->dispositivosod == null) {
            return false;
        }
        return true;
    }
    public function editarEstatusd(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_estatusdispositivop SET nombre='".$this->Estatustx."' WHERE idEstatusDispositivo ='".$this->dispositivosod."' ";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_estatusdispositivop', 'idEstatusDispositivo = ' . $this->dispositivosod);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarEstatusd(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_estatusdispositivop WHERE idEstatusDispositivo = $this->dispositivosod;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_estatusdispositivop', 'idEstatusDispositivo = ' . $this->dispositivosod);
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