<?php

include_once("Catalogo.class.php");

class Logro_eje {

    private $IdResumenEje;
    private $idEje;
    private $Titulo;
    private $Resumen;
    private $Descripcion;
    private $Fecha_objetiva;
    private $Tipo;
    private $IdArea;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;

    public function getLogro_Eje() {
        $catalogo = new Catalogo();
        $consulta_logro = "SELECT * FROM c_logrosResumenEje as lre WHERE lre.IdResumenEje= " . $this->IdResumenEje;
        $result_logro = $catalogo->obtenerLista($consulta_logro);
        while ($row = mysqli_fetch_array($result_logro)) {
            $this->idEje = $row['idEje'];
            $this->Titulo = $row['Titulo'];
            $this->Resumen = $row['Resumen'];
            $this->Descripcion = $row['Descripcion'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            $this->Fecha_objetiva = $row['Fecha_objetiva'];
            $this->Tipo = $row['Tipo'];
            $this->IdArea = $row['IdArea'];
            return true;
        }
        return false;
    }

    public function nuevoLogro_Eje() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_logrosResumenEje(idEje,Titulo,Resumen,Descripcion,Fecha_objetiva,Tipo,IdArea,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
            VALUES( " . $this->idEje . ",'" . $this->Titulo . "','" . $this->Resumen . "','" . $this->Descripcion . "','" . $this->Fecha_objetiva . "',".$this->Tipo.",".$this->IdArea.",'$this->usuarioCreacion',now(),'$this->usuarioUltimaModificacion',now(),'$this->pantalla');";
        $this->IdResumenMuseo = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->IdResumenMuseo == 0 || $this->IdResumenMuseo == null) {
            return false;
        }
        return true;
    }

    public function editarLogro_Eje() {

        $catalogo = new Catalogo();
        $consulta = "UPDATE c_logrosResumenEje SET idEje=" . $this->idEje . ",Titulo='" . $this->Titulo . "',Resumen='" . $this->Resumen . "',Descripcion='" . $this->Descripcion . "',Fecha_objetiva='".$this->Fecha_objetiva."',IdArea=".$this->IdArea.",usuarioUltimaModificacion = '" . $this->usuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE c_logrosResumenEje.IdResumenEje = $this->IdResumenEje;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_logrosResumenEje', 'IdResumenEje = ' . $this->IdResumenEje);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarLogro_Eje() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_logrosResumenEje WHERE IdResumenEje = $this->IdResumenEje;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_logrosResumenEje", "IdResumenEje = " . $this->IdResumenEje);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getIdResumenEje() {
        return $this->IdResumenEje;
    }

    function getIdEje() {
        return $this->idEje;
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

    function getFecha_objetiva() {
        return $this->Fecha_objetiva;
    }

    function getTipo() {
        return $this->Tipo;
    }

    function getIdArea() {
        return $this->IdArea;
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

    function setIdResumenEje($IdResumenEje) {
        $this->IdResumenEje = $IdResumenEje;
    }

    function setIdEje($idEje) {
        $this->idEje = $idEje;
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

    function setFecha_objetiva($Fecha_objetiva) {
        $this->Fecha_objetiva = $Fecha_objetiva;
    }

    function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }

    function setIdArea($IdArea) {
        $this->IdArea = $IdArea;
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
