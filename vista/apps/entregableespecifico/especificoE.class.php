<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class especificoE {

    private $Id_entrEs;
    private $actividad;
    private $entregable;
    private $descripcion;
    private $avance;
    private $exp;
    private $intervalo;
    private $libro;
   

    public function getespecificoE() {
        $catalogo = new Catalogo();
        $consultaentregable = "SELECT * FROM c_entregableEspecifico WHERE IdEntregEspecifico = " . $this->Id_entrEs;
        $result = $catalogo->obtenerLista($consultaentregable);
        while ($row = mysqli_fetch_array($result)) {

            $this->Id_entrEs = $row['IdEntregEspecifico'];
            $this->entregable = $row['IdEntregable'];
            $this->descripcion = $row['Descripcion'];
            $this->avance = $row['avance'];
            $this->exp = $row['idExp'];
            $this->intervalo = $row['idIntervalo'];
            $this->libro = $row['IdLibro'];
            $this->actividad = $row['IdActividad'];
            return true;
        }
        return false;
    }

    public function Nuevo_especificoE() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_entregableEspecifico(IdEntregable,Descripcion,idExp,idIntervalo,avance,IdLibro,IdActividad)
            VALUES($this->entregable,'$this->descripcion',$this->exp,$this->intervalo,$this->avance,$this->libro,$this->actividad);";
            echo $insert;
        $this->Id_entrEs = $catalogo->insertarRegistro($insert);
        
        if ($this->Id_entrEs == 0 || $this->Id_entrEs == null) {
            return false;
        }
        return true;
    }

    public function Editar_especificoE() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_entregableEspecifico SET IdEntregable=". $this->entregable .",Descripcion='". $this->descripcion ."',idExp=". $this->exp .
        ",idIntervalo=". $this->intervalo .",avance=". $this->avance .",IdLibro=". $this->libro .",IdActividad=". $this->actividad ." WHERE IdEntregEspecifico = $this->Id_entrEs;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_entregableEspecifico', 'IdEntregEspecifico = ' . $this->Id_entrEs);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminar_especificoE() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_entregableEspecifico WHERE IdEntregEspecifico = $this->Id_entrEs;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_entregableEspecifico", "IdEntregEspecifico = " . $this->Id_entrEs);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getactividad() {
        return $this->actividad;
    } 
    function getId_entrEs() {
        return $this->Id_entrEs;
    }

    function getentregable() {
        return $this->entregable;
    }

    function getdescripcion() {
        return $this->descripcion;
    }

    function getexp() {
        return $this->exp;
    }
    function getintervalo() {
        return $this->intervalo;
    }

    function getavance() {
        return $this->avance;
    }

    function getlibro() {
        return $this->libro;
    }


    function setactividad($actividad) {
        $this->actividad = $actividad;
    }
    function setId_entrEs($Id_entrEs) {
        $this->Id_entrEs = $Id_entrEs;
    }

    function setentregable($entregable) {
        $this->entregable = $entregable;
    }

    function setdescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setexp($exp) {
        $this->exp = $exp;
    }
    function setintervalo($intervalo) {
        $this->intervalo = $intervalo;
    }

    function setavance($avance) {
        $this->avance = $avance;
    }

    function setlibro($libro) {
        $this->libro = $libro;
    }
}
