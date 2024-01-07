<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Intervalo {

    private $Id_intervalo;
    private $descripcion;

    public function getIntervalo() {
        $catalogo = new Catalogo();
        $consultaIntervalo = "SELECT * FROM c_intervalo WHERE idIntervalo = " . $this->Id_intervalo;
        $result = $catalogo->obtenerLista($consultaIntervalo);
        while ($row = mysqli_fetch_array($result)) {
            $this->descripcion = $row['descripcion'];
            return true;
        }
        return false;
    }

    public function Nuevo_intervalo() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_intervalo(descripcion)
            VALUES('$this->descripcion');";
        $this->Id_intervalo = $catalogo->insertarRegistro($insert);
        
        if ($this->Id_intervalo == 0 || $this->Id_intervalo == null) {
            return false;
        }
        return true;
    }

    public function Editar_intervalo() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_intervalo SET descripcion ='" . $this->descripcion . "' WHERE idIntervalo = $this->Id_intervalo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_intervalo', 'idIntervalo = ' . $this->Id_intervalo);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminar_intervalo() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_intervalo WHERE idIntervalo = $this->Id_intervalo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_intervalo", "idIntervalo = " . $this->Id_intervalo);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

     function getId_intervalo() {
        return $this->Id_intervalo;
    }

    function getdescripcion() {
        return $this->descripcion;
    }

    function setId_intervalo($Id_intervalo) {
        $this->Id_intervalo = $Id_intervalo;
    }

    function setdescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}
