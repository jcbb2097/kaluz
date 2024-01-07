<?php

include_once("Catalogo.class.php");
class CronIndicadores{
    private $id_indicador;
    private $Series;
    private $fecha2;
    private $Datos;
    private $fecha;
    
     public function getcron() {
        $catalogo = new Catalogo();
        $consultaRegistro = "SELECT * FROM cron_unico WHERE id_indicador= " . $this->id_indicador ;
        $resultCRegistro = $catalogo->obtenerLista($consultaRegistro);
        //var_dump($resultCRegistro);
        while ($row = mysqli_fetch_array($resultCRegistro)) {
            $this->id_indicador = $row['id_indicador'];
            $this->Series = $row['Series'];
            $this->fecha = $row['fecha'];
     
            return true;
        }
        return false;
    }
    public function getcron2() {
        $catalogo = new Catalogo();
        $consultaRegistro = "SELECT * FROM cron_multiple WHERE id_indicador= " . $this->id_indicador ;
        $resultCRegistro = $catalogo->obtenerLista($consultaRegistro);
        //var_dump($resultCRegistro);
        while ($row = mysqli_fetch_array($resultCRegistro)) {
            $this->id_indicador = $row['id_indicador'];
            $this->Series = $row['Series'];
            $this->Datos = $row['Datos'];
            $this->fecha = $row['fecha'];
     
            return true;
        }
        return false;
    }
    public function insertardatos() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO cron_unico(id_indicador,Series,fecha)
                VALUES(" . $this->id_indicador . "," . $this->Series .",now());";
        $this->IdIndicador = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if($this->id_indicador == 0 || $this->id_indicador == null){
        return false;
    }
    }
   public function insertardatos2() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO cron_multiple(id_indicador,Datos,Series,fecha)
                VALUES(" . $this->id_indicador . ",'" .$this->Datos ."'," .$this->Series   .",now());";
        $this->IdIndicador = $catalogo->insertarRegistro($insert);
       // echo "<br><br>$insert<br><br>";
        if($this->id_indicador == 0 || $this->id_indicador == null){
        return false;
        }
    }
    function getFecha2() {
        return $this->fecha2;
    }

    function setFecha2($fecha2) {
        $this->fecha2 = $fecha2;
    }

    function getDatos() {
        return $this->Datos;
    }

    function setDatos($Datos) {
        $this->Datos = $Datos;
    }

        
    function getId_indicador() {
        return $this->id_indicador;
    }

    function getSeries() {
        return $this->Series;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId_indicador($id_indicador) {
        $this->id_indicador = $id_indicador;
    }

    function setSeries($Series) {
        $this->Series = $Series;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}