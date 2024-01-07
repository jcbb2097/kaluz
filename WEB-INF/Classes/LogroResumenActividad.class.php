<?php
include_once("Catalogo.class.php");
class Logro_actividad {
    private $IdLogroAct;
    private $IdEje;
    private $Titulo;
    private $Resumen;
    private $Descripcion;
    private $IdActividad;
    private $Fecha_objetiva;
    private $IdArea;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;
    /*----------------------------------------------------------------------------------------------------*/
    public function getLogro() {
        $catalogo = new Catalogo();
        $consulta_logro = "SELECT * FROM c_logrosActividades as la WHERE la.IdLogroActividad=".$this->IdLogroAct;
        $result_logro = $catalogo->obtenerLista($consulta_logro);
        while ($row = mysqli_fetch_array($result_logro)) {
            $this->IdEje = $row['IdEje'];
            $this->Titulo = $row['Titulo'];
            $this->Resumen = $row['Resumen'];
            $this->Descripcion = $row['Descripcion'];
            $this->IdActividad = $row['IdActividad'];
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
    /*----------------------------------------------------------------------------------------------------*/
    public function nuevoLogro() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_logrosActividades (IdEje,Titulo,Resumen,Descripcion,IdActividad,Fecha_objetiva,IdArea,
                    usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
                    VALUES (".$this->IdEje.",'".$this->Titulo."','".$this->Resumen."',
                            '".$this->Descripcion."',$this->IdActividad,'".$this->Fecha_objetiva."',".$this->IdArea.",
                            '".$this->usuarioCreacion."',now(),'".$this->usuarioUltimaModificacion."',now(),'".$this->pantalla."');";
        $this->IdLogroAct = $catalogo->insertarRegistro($insert);
         //echo "<br><br>$insert<br><br>";
        if ($this->IdLogroAct == 0 || $this->IdLogroAct == null) {
            return false;
        }
        return true;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function editarLogro() {
        $catalogo = new Catalogo();
        $consulta= "
                    UPDATE c_logrosActividades SET
                    Titulo='".$this->Titulo."',
                    Resumen='".$this->Resumen."',
                    Descripcion='".$this->Descripcion."',
                    usuarioUltimaModificacion='".$this->usuarioUltimaModificacion."',
                    FechaUltimaModificacion=NOW()
                    where IdLogroActividad = $this->IdLogroAct
                    ";

        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_logrosActividades', 'IdLogroActividad='.$this->IdLogroAct);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function eliminarLogro() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_logrosActividades WHERE IdLogroActividad = $this->IdLogroAct;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_logrosActividades", "IdLogroActividad=".$this->IdLogroAct);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    function getIdLogroAct() {
        return $this->IdLogroAct;
    }

    function getIdEje() {
        return $this->IdEje;
    }

    function getIdActividad() {
        return $this->IdActividad;
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

    function setIdLogroAct($IdLogroAct) {

        $this->IdLogroAct = $IdLogroAct;
    }

    function setIdEje($IdEje) {
        $this->IdEje = $IdEje;
    }

    function setIdActividad($IdActividad) {
        $this->IdActividad = $IdActividad;

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
