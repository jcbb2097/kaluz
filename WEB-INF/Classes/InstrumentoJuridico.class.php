<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Instrumento {
    private $idInstrumento;
    private $nombre;
    private $tipo;
    private $estatus;
    
    public function obtenerInstrumento() {
        $catalogo = new Catalogo();
        $consulta = "SELECT * FROM c_instrumentoJuridico WHERE idInstrumento= " . $this->idInstrumento;
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($result)) {
            $this->nombre = $row['nombre'];
            $this->tipo = $row['tipo'];
            $this->estatus= $row['estatus'];
           
            return true;
        }
        return false;
    }
    
    public function nuevoInstrumento() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_instrumentoJuridico(nombre,tipo,estatus)
            VALUES( '" . $this->nombre . "'," . $this->tipo . "," . $this->estatus . ");";
        $this->idInstrumento = $catalogo->insertarRegistro($insert);
         //echo "<br><br>$insert<br><br>"; 
        if ($this->idInstrumento == 0 || $this->idInstrumento == null) {
            return false;
        }
        return true;
    }
    public function editarInstrumento() {
        
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_instrumentoJuridico SET nombre='" . $this->nombre . "' WHERE c_instrumentoJuridico.idInstrumento = $this->idInstrumento;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_instrumentoJuridico', 'idInstrumento = ' . $this->idInstrumento);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarInstrumento() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_instrumentoJuridico WHERE idInstrumento = $this->idInstrumento;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_instrumentoJuridico", "idInstrumento = " . $this->idInstrumento);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }
    
    
    function getIdInstrumento() {
        return $this->idInstrumento;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdInstrumento($idInstrumento) {
        $this->idInstrumento = $idInstrumento;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}