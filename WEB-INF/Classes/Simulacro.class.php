<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Simulacro{
	private $nombre;
	private $descripcion;
	private $tf;
    public function getSimulacro(){
    	$catalogo = new catalogo();
    	 $consultaP = "SELECT * FROM c_tiposimulacrop WHERE idTipoSimulacro = " . $this->Simulacroid;
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->tipo_S = $row['tipoSimulacro'];
			$this->ubicacion = $row['idEspacio'];
    		$this->fecha = $row['fecha'];
            $this->Personase = $row['personaEvacuada'];
            $this->Personasne = $row['personaNoEvacuada'];
             $this->Personasp = $row['personaPresente'];
            $this->Tiempoe = $row['tiempo'];
    		return true;
    	}
    	return false;
    }

    public function corroborarSimulacro(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_tiposimulacrop WHERE tipoSimulacro = '" . $this->tipo_S . "'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoSimulacro(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_tiposimulacrop (tipoSimulacro, idEspacio, fecha, personaEvacuada, personaNoEvacuada, personaPresente, tiempo, estatus, fechaCreacion, usuarioCreacion,fechaUltimaModificacion,usuarioUltimaModificacion, pantalla)
    	VALUES ('".$this->tipo_S."','".$this->ubicacion."','".$this->fecha."','".$this->Personase."','".$this->Personasne."','".$this->Personasp."','".$this->Tiempoe."',".$this->Estatus.", NOW(), 'prueba',NOW(), 'prueba','alta_simulacro.php');";
    	$this->Simulacroid = $catalogo->insertarRegistro($insertarA);
    	//echo "<br><br>$insertarA<br><br>"; 
        if ($this->Simulacroid == 0 || $this->Simulacroid == null) {
            return false;
        }
        return true;
    }
    public function editarSimulacro(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_tiposimulacrop SET tipoSimulacro='".$this->tipo_S."', idEspacio='".$this->ubicacion."', fecha='".$this->fecha."', personaEvacuada='".$this->Personase."', personaNoEvacuada='".$this->Personasne."', personaPresente='".$this->Personasp."', tiempo='".$this->Tiempoe."' WHERE idTipoSimulacro ='".$this->Simulacroid."' ";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_tiposimulacrop', 'idTipoSimulacro = ' . $this->Simulacroid);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarSimulacro(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_tiposimulacrop WHERE idTipoSimulacro = $this->Simulacroid;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_tiposimulacrop', 'idTipoSimulacro = ' . $this->Simulacroid);
    	//echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }


   
	function gettipo_S(){
    	return $this->tipo_S;
    }
    function settipo_S($tipo_S){
    	$this->tipo_S = $tipo_S;
    }

    function getubicacion(){
    	return $this->ubicacion;
    }
    function setubicacion($ubicacion){
    	$this->ubicacion = $ubicacion;
    }


    function getfecha(){
    	return $this->fecha;
    }

    function setfecha($fecha){
    	$this->fecha = $fecha;
    }
    function getPersonase(){
    	return $this->Personase;
    }

    function setPersonase($Personase){
    	$this->Personase = $Personase;
    }
     function getPersonasne(){
    	return $this->Personasne;
    }

    function setPersonasne($Personasne){
    	$this->Personasne = $Personasne;
    }
      function getPersonasp(){
        return $this->Personasp;
    }

    function setPersonasp($Personasp){
        $this->Personasp = $Personasp;
    }
 

    function setTiempoe($Tiempoe){
        $this->Tiempoe = $Tiempoe;
    }
    function getTiempoe(){
        return $this->Tiempoe;
    }
      function setSimulacroid($Simulacroid){
        $this->Simulacroid = $Simulacroid;
    }
    function getSimulacroid(){
        return $this->Simulacroid;
    }
        function setEstatus($Estatus){
        $this->Estatus = $Estatus;
    }
    function getEstatus(){
        return $this->Estatus;
    }

}
?>