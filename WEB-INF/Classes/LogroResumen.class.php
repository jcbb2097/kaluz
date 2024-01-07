<?php

include_once("Catalogo.class.php");

class Logro {

    private $IdResumenMuseo;
    private $Etapa;
    private $Tipo;
    private $Titulo;
    private $Resumen;
    private $Descripcion;
    private $IdArea;
    private $Fecha_objetiva;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;

    public function getLogro() {
        $catalogo = new Catalogo();
        $consulta_logro = "SELECT * FROM c_LogrosResumenMuseo as lrm WHERE lrm.IdResumenMuseo= " . $this->IdResumenMuseo;
        $result_logro = $catalogo->obtenerLista($consulta_logro);
        while ($row = mysqli_fetch_array($result_logro)) {
            $this->Etapa = $row['Etapa'];
            $this->Tipo = $row['Tipo'];
            $this->Titulo = $row['Titulo'];
            $this->Resumen = $row['Resumen'];
            $this->Descripcion = $row['Descripcion'];
            $this->Fecha_objetiva = $row['Fecha_objetiva'];
            $this->IdArea = $row['IdArea'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            return true;
        }
        return false;
    }

    public function nuevoLogro() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_LogrosResumenMuseo(Etapa,Tipo,Titulo,Resumen,Descripcion,Fecha_objetiva,IdArea,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
            VALUES( " . $this->Etapa . "," . $this->Tipo . ",'" . $this->Titulo . "','" . $this->Resumen . "','" . $this->Descripcion . "','" . $this->Fecha_objetiva . "'," . $this->IdArea . ",'$this->usuarioCreacion',now(),'$this->usuarioUltimaModificacion',now(),'$this->pantalla');";
        $this->IdResumenMuseo = $catalogo->insertarRegistro($insert);
        // echo "<br><br>$insert<br><br>";
        if ($this->IdResumenMuseo == 0 || $this->IdResumenMuseo == null) {
            return false;
        }
        return true;
    }

    public function editarLogro() {

        $catalogo = new Catalogo();
        $consulta = "UPDATE c_LogrosResumenMuseo SET  Etapa=" . $this->Etapa . ",Tipo=" . $this->Tipo . ",Titulo='" . $this->Titulo . "',Resumen='" . $this->Resumen . "',Descripcion='" . $this->Descripcion . "',Fecha_objetiva='" . $this->Fecha_objetiva . "',IdArea=" . $this->IdArea . ",usuarioUltimaModificacion = '" . $this->usuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE c_LogrosResumenMuseo.IdResumenMuseo = $this->IdResumenMuseo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_LogrosResumenMuseo', 'IdResumenMuseo = ' . $this->IdResumenMuseo);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarLogro() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_LogrosResumenMuseo WHERE IdResumenMuseo = $this->IdResumenMuseo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_LogrosResumenMuseo", "IdResumenMuseo = " . $this->IdResumenMuseo);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getIdResumenMuseo() {
        return $this->IdResumenMuseo;
    }

    function getEtapa() {
        return $this->Etapa;
    }

    function getTipo() {
        return $this->Tipo;
    }

    function getTitulo() {
        return $this->Titulo;
    }

    function getResumen() {
        return $this->Resumen;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getIdArea() {
        return $this->IdArea;
    }

    function getFecha_objetiva() {
        return $this->Fecha_objetiva;
    }

    function getUsuarioCreacion() {
        return $this->usuarioCreacion;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getUsuarioUltimaModificacion() {
        return $this->usuarioUltimaModificacion;
    }

    function getFechaUltimaModificacion() {
        return $this->fechaUltimaModificacion;
    }

    function getPantalla() {
        return $this->pantalla;
    }

    function setIdResumenMuseo($IdResumenMuseo) {
        $this->IdResumenMuseo = $IdResumenMuseo;
    }

    function setEtapa($Etapa) {
        $this->Etapa = $Etapa;
    }

    function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }

    function setTitulo($Titulo) {
        $this->Titulo = $Titulo;
    }

    function setResumen($Resumen) {
        $this->Resumen = $Resumen;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    function setIdArea($IdArea) {
        $this->IdArea = $IdArea;
    }

    function setFecha_objetiva($Fecha_objetiva) {
        $this->Fecha_objetiva = $Fecha_objetiva;
    }

    function setUsuarioCreacion($usuarioCreacion) {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setUsuarioUltimaModificacion($usuarioUltimaModificacion) {
        $this->usuarioUltimaModificacion = $usuarioUltimaModificacion;
    }

    function setFechaUltimaModificacion($fechaUltimaModificacion) {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;
    }

    function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
    }

}
