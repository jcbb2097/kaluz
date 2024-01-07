<?php

include_once("Catalogo.class.php");

class Indicadores2 {

    private $IdIndicador;
    private $IdProyecto;
    private $IdConcepto;
    private $IdArea;
    private $IdPresentacion;
    private $IdAplicacion;
    private $IdTiempo;
    private $Interes;
    private $QueryConsulta;
    private $Descripcion;
    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificacion;
    private $FechaUltimaModificacion;
    private $Pantalla;
    private $Periodo;
    private $expo;

    public function getRegistro() {
        $catalogo = new Catalogo();
        $consultaRegistro = "SELECT * FROM k_indicadores WHERE IdIndicador= " . $this->IdIndicador;
        $resultCRegistro = $catalogo->obtenerLista($consultaRegistro);
        //var_dump($resultCRegistro);
        while ($row = mysqli_fetch_array($resultCRegistro)) {
            $this->Descripcion = $row['Descripcion'];
            $this->IdArea = $row['IdArea'];
            $this->IdAplicacion = $row['IdAplicacion'];
            $this->IdProyecto = $row['IdProyecto'];
            $this->IdTiempo = $row['IdTiempo'];
            $this->Interes = $row['Interes'];
            $this->IdConcepto = $row['IdConcepto'];
            $this->QueryConsulta = $row['Consulta'];
            $this->IdPresentacion = $row['IdPresentacion'];
            $this->UsuarioCreacion = $row['usuarioCreacion'];
            $this->FechaCreacion = $row['fechaCreacion'];
            $this->UsuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->FechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->Pantalla = $row['pantalla'];
            $this->Periodo = $row['periodo'];
            $this->expo = $row['Exposicion'];
            return true;
        }
        return false;
    }

    public function nuevoRegistro() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_indicadores(Descripcion,Interes,IdProyecto,IdConcepto,IdAplicacion,IdTiempo,IdPresentacion,IdArea,Consulta,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla,periodo,Exposicion)
                VALUES('" . $this->Descripcion . "'," . $this->Interes . "," . $this->IdProyecto . "," . $this->IdConcepto . "," . $this->IdAplicacion . "," . $this->IdTiempo . "," . $this->IdPresentacion . "," . $this->IdArea . ",'" . $this->QueryConsulta . "','$this->UsuarioCreacion',now(),'$this->UsuarioUltimaModificacion',now(),'$this->Pantalla'," . $this->Periodo . ",". $this->expo .");";
        $this->IdIndicador = $catalogo->insertarRegistro($insert);
        echo "<br><br>$insert<br><br>"; 
        if ($this->IdIndicador != 0) {
            return true;
        }
        return false;
    }

    public function editarRegistro() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_indicadores SET Descripcion = '" . $this->Descripcion . "',IdProyecto=" . $this->IdProyecto . ", IdConcepto = " . $this->IdConcepto . ",IdAplicacion=" . $this->IdAplicacion . ",IdTiempo=" . $this->IdTiempo . ", IdPresentacion = " . $this->IdPresentacion . ",Interes=" . $this->Interes . ",Consulta = '" . $this->QueryConsulta . "',periodo=" . $this->Periodo . "  ,UsuarioUltimaModificacion = '" . $this->UsuarioUltimaModificacion . "', FechaUltimaModificacion= NOW(), Exposicion=". $this->expo ." WHERE IdIndicador = $this->IdIndicador;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_indicadores', 'IdIndicador = ' . $this->IdIndicador);
 //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarRegistro() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_indicadores WHERE IdIndicador = $this->IdIndicador;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_indicadores", "IdIndicador = " . $this->IdIndicador);
         //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function getIdIndicador() {
        return $this->IdIndicador;
    }

    public function getIdProyecto() {
        return $this->IdProyecto;
    }

    public function getIdConcepto() {
        return $this->IdConcepto;
    }

    public function getIdArea() {
        return $this->IdArea;
    }

    public function getIdPresentacion() {
        return $this->IdPresentacion;
    }

    public function getIdAplicacion() {
        return $this->IdAplicacion;
    }

    public function getIdTiempo() {
        return $this->IdTiempo;
    }

    public function getInteres() {
        return $this->Interes;
    }

    public function getQueryConsulta() {
        return $this->QueryConsulta;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getUsuarioCreacion() {
        return $this->UsuarioCreacion;
    }

    public function getFechaCreacion() {
        return $this->FechaCreacion;
    }

    public function getUsuarioUltimaModificacion() {
        return $this->UsuarioUltimaModificacion;
    }

    public function getFechaUltimaModificacion() {
        return $this->FechaUltimaModificacion;
    }

    public function getPantalla() {
        return $this->Pantalla;
    }

    public function setIdIndicador($IdIndicador) {
        $this->IdIndicador = $IdIndicador;
    }

    public function setIdProyecto($IdProyecto) {
        $this->IdProyecto = $IdProyecto;
    }

    public function setIdConcepto($IdConcepto) {
        $this->IdConcepto = $IdConcepto;
    }

    public function setIdArea($IdArea) {
        $this->IdArea = $IdArea;
    }

    public function setIdPresentacion($IdPresentacion) {
        $this->IdPresentacion = $IdPresentacion;
    }

    public function setIdAplicacion($IdAplicacion) {
        $this->IdAplicacion = $IdAplicacion;
    }

    public function setIdTiempo($IdTiempo) {
        $this->IdTiempo = $IdTiempo;
    }

    public function setInteres($Interes) {
        $this->Interes = $Interes;
    }

    public function setQueryConsulta($QueryConsulta) {
        $this->QueryConsulta = $QueryConsulta;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setUsuarioCreacion($UsuarioCreacion) {
        $this->UsuarioCreacion = $UsuarioCreacion;
    }

    public function setFechaCreacion($FechaCreacion) {
        $this->FechaCreacion = $FechaCreacion;
    }

    public function setUsuarioUltimaModificacion($UsuarioUltimaModificacion) {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;
    }

    public function setFechaUltimaModificacion($FechaUltimaModificacion) {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;
    }

    public function setPantalla($Pantalla) {
        $this->Pantalla = $Pantalla;
    }

    function getPeriodo() {
        return $this->Periodo;
    }

    function setPeriodo($Periodo) {
        $this->Periodo = $Periodo;
    }

    public function setExpo($expo){
        $this->expo = $expo;
    }

    public function getExpo(){
        return $this->expo;
    }

}

?>