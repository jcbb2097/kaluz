<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Agentes{
	private $nombre;
	private $descripcion;
	private $tf;


    public function getAgente(){
    	$catalogo = new catalogo();
    	$consultaP = "SELECT * FROM c_agenteseguridad WHERE Id_agente = " . $this->Agentesid;
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->nombre = $row['nombre'];
			$this->descripcion = $row['descripcion'];
    		$this->tf = $row['tipo_fuego'];
    		return true;
    	}
    	return false;
    }

    public function corroborarAgente(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_agenteseguridad WHERE nombre = '" . $this->nombre . "'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoAgente(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_agenteseguridad(nombre, descripcion, tipo_fuego, estatus, fecha_creacion, usuario_creacion, fechaUltimaModificacion, usuarioUltimaModificacion, pantalla)
    	VALUES ('".$this->nombre."','".$this->descripcion."','".$this->tf."','".$this->estatus."',NOW(),'prueba',NOW(), 'prueba', 'alta_agente.php');";
    	$this->Agentesid = $catalogo->insertarRegistro($insertarA);
    	//echo "<br><br>$insertarA<br><br>"; 
        if ($this->Agentesid == 0 || $this->Agentesid == null) {
            return false;
        }
        return true;
    }
    public function editarAgente(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_agenteseguridad SET nombre='".$this->nombre."', descripcion='".$this->descripcion."', tipo_fuego='".$this->tf."'WHERE id_agente = $this->Agentesid;";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_agentesseguridad', 'id_agente = ' . $this->Agentesid);
    	//echo "<br><br>$editarP<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarAgente(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_agenteseguridad WHERE id_agente = $this->Agentesid;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_agentesseguridad', 'id_agente = ' . $this->Agentesid);
    	//echo "<br><br>$eliminarP<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
	function getNombre(){
    	return $this->nombre;
    }
    function setNombre($nombre){
    	$this->nombre = $nombre;
    }

    function getDescripcion(){
    	return $this->descripcion;
    }
    function setDescripcion($descripcion){
    	$this->descripcion = $descripcion;
    }

    function getTf(){
    	return $this->tf;
    }

    function setTf($tf){
    	$this->tf = $tf;
    }
    function getAgentesid(){
    	return $this->Agentesid;
    }

    function setAgentesid($Agentesid){
    	$this->Agentesid = $Agentesid;
    }
     function getEstatus(){
    	return $this->estatus;
    }

    function setEstatus($estatus){
    	$this->estatus = $estatus;
    }
}
?>