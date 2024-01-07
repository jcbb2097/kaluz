<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Insumo {

    private $IdChecklistInsumoUsado;
    private $IdActividadInsumoUsado;
    private $IdChecklistEntregable;
    private $IdActividadEntregable;
    private $anio;
    private $fechaInsumoRequerido;
    private $general;
    private $check;
    private $subcheck;

    public function getcheckListEntregableInsumo() {
        $catalogo = new Catalogo();
        $consultaIntervalo = "SELECT * FROM k_checkListEntregableInsumo
        WHERE idActividadInsumoUsado = " . $this->IdActividadInsumoUsado;
        $result = $catalogo->obtenerLista($consultaIntervalo);
        while ($row = mysqli_fetch_array($result)) {
            $this->IdChecklistInsumoUsado = $row['idChecklistInsumoUsado'];
            $this->IdActividadInsumoUsado = $row['idActividadInsumoUsado'];
            $this->IdChecklistEntregable = $row['idChecklistEntregable'];
            $this->IdActividadEntregable = $row['idActividadEntregable'];
            $this->anio = $row['Anio'];
            $this->fechaInsumoRequerido = $row['FechaInsumoRequerido'];
        } 
        return true;
        }   

    public function Nuevo_checkListEntregableInsumo() {
        if ($this->general != "NULL") {
            $this->IdActividadEntregable = $this->general;
        }

        if ($this->subcheck != "NULL") {
            $this->IdChecklistEntregable = $this->subcheck;
        }
            $anio = date("Y");
            $catalogo = new Catalogo();
        $insert = "INSERT INTO k_checkListEntregableInsumo(idChecklistInsumoUsado,idActividadInsumoUsado,idChecklistEntregable,idActividadEntregable,Anio,FechaInsumoRequerido)
            VALUES($this->IdChecklistInsumoUsado,$this->IdActividadInsumoUsado,$this->IdChecklistEntregable,$this->IdActividadEntregable,$anio,'$this->fechaInsumoRequerido');";
            //echo $insert;
        $this->IdActividadEntregable = $catalogo->insertarRegistro($insert);
        

        return true;
    }

    public function Editar_checkListEntregableInsumo() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_checkListEntregableInsumo SET idChecklistInsumoUsado=". $this->IdChecklistInsumoUsado .",idActividadInsumoUsado=". $this->IdActividadInsumoUsado .",idChecklistEntregable=". $this->IdChecklistEntregable .",idActividadEntregable=". $this->IdActividadEntregable .",Anio=". $this->anio .",FechaInsumoRequerido=". $this->fechaInsumoRequerido ." WHERE idActividadInsumoUsado = $this->IdActividadInsumoUsado;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_checkListEntregableInsumo', 'idActividadInsumoUsado = ' . $this->IdActividadInsumoUsado);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }   

    public function Eliminar_checkListEntregableInsumo() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_checkListEntregableInsumo WHERE idChecklistEntregable = $this->IdChecklistEntregable and idActividadEntregable = $this->IdActividadEntregable and idChecklistInsumoUsado = $this->IdChecklistInsumoUsado and idActividadInsumoUsado = $this->IdActividadInsumoUsado;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_checkListEntregableInsumo", "idChecklistEntregable = " . $this->IdChecklistEntregable." idActividadEntregable=".$this->IdActividadEntregable." idChecklistInsumoUsado=".$this->IdChecklistInsumoUsado." idActividadInsumoUsado=".$this->IdActividadInsumoUsado);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }                




     function getIdChecklistInsumoUsado() {
        return $this->IdChecklistInsumoUsado;
    }

    function getIdActividadInsumoUsado() {
        return $this->IdActividadInsumoUsado;
    }

    function getIdChecklistEntregable() {
        return $this->IdChecklistEntregable;
    }

    function getIdActividadEntregable() {
        return $this->IdActividadEntregable;
    }

    function getanio() {
        return $this->anio;
    }

    function getfechaInsumoRequerido() {
        return $this->fechaInsumoRequerido;
    }

    function getgeneral() {
        return $this->general;
    }

    function getsubcheck() {
        return $this->subcheck;
    }


    function setIdChecklistInsumoUsado($IdChecklistInsumoUsado) {
        $this->IdChecklistInsumoUsado = $IdChecklistInsumoUsado;
    }

    function setIdActividadInsumoUsado($IdActividadInsumoUsado) {
        $this->IdActividadInsumoUsado = $IdActividadInsumoUsado;
    }

    function setIdChecklistEntregable($IdChecklistEntregable) {
        $this->IdChecklistEntregable = $IdChecklistEntregable;
    }

    function setIdActividadEntregable($IdActividadEntregable) {
        $this->IdActividadEntregable = $IdActividadEntregable;
    }

    function setanio($anio) {
        $this->anio = $anio;
    }

    function setfechaInsumoRequerido($fechaInsumoRequerido) {
        $this->fechaInsumoRequerido = $fechaInsumoRequerido;
    }

    function setgeneral($general) {
        $this->general = $general;
    }

    function setsubcheck($subcheck) {
        $this->subcheck = $subcheck;
    }

}
