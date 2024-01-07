<?php

include_once("Catalogo.class.php");

class Cuestionario {

    private $Id_Cuestionario;
    private $Id_Eje;
    private $Id_Exposicion;
    private $Id_Area;
    private $Actividad_Global;
    private $Actividad_General;
    private $Periodo;
    private $Dirigido;
    private $Descripcion;
    private $Nombre_Cuestionario;
    private $Fecha_Inicio;
    private $Fecha_Fin;
    private $Estatus;
    private $Datos_Contacto;
    private $Datos_Ubicacion;
    private $Idioma;
    private $Detalle_Contacto;
    private $Categoria;
    private $Subcategoria;
    private $Tipo_Actividad;

    public function getCuestionario() {
        $catalogo = new Catalogo();
        $consultaCuestionario = "select * FROM k_cuestionarios WHERE k_cuestionarios.idCuestionario = ".$this->Id_Cuestionario;
        $resultCuestionario = $catalogo->obtenerLista($consultaCuestionario);
        while ($row = mysqli_fetch_array($resultCuestionario)) {
            $this->Id_Cuestionario = $row['idCuestionario'];
            $this->Id_Exposicion = $row['idExposicion'];
            $this->Id_Eje = $row['idEje'];
            $this->Id_Area = $row['idArea'];
            $this->Fecha_Inicio = $row['fechaInicio'];
            $this->Fecha_Fin = $row['fechaFin'];
            $this->Nombre_Cuestionario = $row['nombreCuestionario'];
            $this->Dirigido = $row['dirigido'];
            $this->Periodo = $row['periodo'];
            $this->Descripcion = $row['descripcion'];
            $this->Actividad_General = $row['actividadGeneral'];
            $this->Actividad_Global = $row['actividadGlobal'];
            $this->Estatus = $row['estatus'];
            $this->Datos_Contacto = $row['datosContacto'];
            $this->Datos_Ubicacion = $row['datosUbicacion'];
            $this->Idioma = $row['idioma'];
            $this->Detalle_Contacto = $row['detalleContacto'];
            $this->Categoria = $row['categoria'];
            $this->Subcategoria = $row['subcategoria'];
            $this->Tipo_Actividad = $row['tipoActividad'];
            return true;
        }
        return false;
    }

    public function nuevoCuestionario() {
        $catalogo = new Catalogo();
        $insert =  "insert into k_cuestionarios(idEje,idExposicion,idArea,periodo,fechaInicio,fechaFin,nombreCuestionario,
                        dirigido,descripcion,actividadGeneral,actividadGlobal,estatus,datosContacto,datosUbicacion,idioma,detalleContacto,categoria,subcategoria,tipoActividad)
                    VALUES( $this->Id_Eje,
                            $this->Id_Exposicion,
                            $this->Id_Area,
                            $this->Periodo,
                            '$this->Fecha_Inicio',
                            '$this->Fecha_Fin',
                            '$this->Nombre_Cuestionario',
                            '$this->Dirigido',
                            '$this->Descripcion',
                            $this->Actividad_General,
                            $this->Actividad_Global,
                            $this->Estatus,
                            $this->Datos_Contacto,
                            $this->Datos_Ubicacion,
                            $this->Idioma,
                            '$this->Detalle_Contacto',
                            $this->Categoria,
                            $this->Subcategoria,
                            $this->Tipo_Actividad);";
        $this->Id_Cuestionario = $catalogo->insertarRegistro($insert);
        echo "<br><br>$insert<br><br>";
        if ($this->Id_Cuestionario == 0 || $this->Id_Cuestionario == null) {
            return false;
        }
        return true;
    }

    public function editarCuestionario() {
        $catalogo = new Catalogo();
        $update = "update k_cuestionarios 
                    SET idEje = $this->Id_Eje,
                        idExposicion = $this->Id_Exposicion,
                        idArea = $this->Id_Area,
                        fechaInicio = '$this->Fecha_Inicio',
                        fechaFin = '$this->Fecha_Fin',
                        nombreCuestionario = '$this->Nombre_Cuestionario',
                        dirigido = '$this->Dirigido',
                        descripcion = '$this->Descripcion',
                        actividadGeneral = $this->Actividad_General,
                        actividadGlobal = $this->Actividad_Global,
                        estatus = $this->Estatus,
                        datosContacto = $this->Datos_Contacto,
                        datosUbicacion = $this->Datos_Ubicacion,
                        idioma = $this->Idioma,
                        detalleContacto = '$this->Detalle_Contacto',
                        categoria = $this->Categoria,
                        subcategoria = $this->Subcategoria,
                        tipoActividad = $this->Tipo_Actividad
                    WHERE idCuestionario = ".$this->Id_Cuestionario;
        $query = $catalogo->ejecutaConsultaActualizacion($update, 'k_cuestionarios', 'idCuestionario ='.$this->Id_Cuestionario);
        //echo "<br><br>$update<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarCuestionario() {
        $catalogo = new Catalogo();
        $delete = "delete FROM k_cuestionarios WHERE k_cuestionarios.idCuestionario = ".$this->Id_Cuestionario;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_cuestionarios', 'idCuestionario ='.$this->Id_Cuestionario);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function PeriodoActual($año) {
        $id_periodo = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT p.Id_Periodo FROM c_periodo as p WHERE p.Periodo=$año";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $id_periodo = $row['Id_Periodo'];
        }
        return $id_periodo;
    }

    function getId_Cuestionario() {
        return $this->Id_Cuestionario;
    }

    function getId_Eje() {
        return $this->Id_Eje;
    }

    function getId_Exposicion() {
        return $this->Id_Exposicion;
    }

    function getId_Area() {
        return $this->Id_Area;
    }

    function getActividad_General() {
        return $this->Actividad_General;
    }

    function getActividad_Global() {
        return $this->Actividad_Global;
    }

    function getPeriodo() {
        return $this->Periodo;
    }

    function getDirigido() {
        return $this->Dirigido;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getNombre_Cuestionario() {
        return $this->Nombre_Cuestionario;
    }

    function getFecha_Inicio() {
        return $this->Fecha_Inicio;
    }

    function getFecha_Fin() {
        return $this->Fecha_Fin;
    }

    function getEstatus() {
        return $this->Estatus;
    }

    function getDatos_Contacto() {
        return $this->Datos_Contacto;
    }

    function getDatos_Ubicacion() {
        return $this->Datos_Ubicacion;
    }

    function getIdioma() {
        return $this->Idioma;
    }

    function getDetalle_Contacto() {
        return $this->Detalle_Contacto;
    }

    function getCategoria() {
        return $this->Categoria;
    }

    function getSubcategoria() {
        return $this->Subcategoria;
    }

    function getTipo_Actividad() {
        return $this->Tipo_Actividad;
    }


    function setId_Cuestionario($Id_Cuestionario) {
        $this->Id_Cuestionario = $Id_Cuestionario;
    }

    function setId_Eje($Id_Eje) {
        $this->Id_Eje = $Id_Eje;
    }

    function setId_Exposicion($Id_Exposicion) {
        $this->Id_Exposicion = $Id_Exposicion;
    }

    function setId_Area($Id_Area) {
        $this->Id_Area = $Id_Area;
    }

    function setActividad_General($Actividad_General) {
        $this->Actividad_General = $Actividad_General;
    }

    function setActividad_Global($Actividad_Global) {
        $this->Actividad_Global = $Actividad_Global;
    }

    function setPeriodo($Periodo) {
        $this->Periodo = $Periodo;
    }

    function setDirigido($Dirigido) {
        $this->Dirigido = $Dirigido;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    function setNombre_Cuestionario($Nombre_Cuestionario) {
        $this->Nombre_Cuestionario = $Nombre_Cuestionario;
    }

    function setFecha_Inicio($Fecha_Inicio) {
        $this->Fecha_Inicio = $Fecha_Inicio;
    }

    function setFecha_Fin($Fecha_Fin) {
        $this->Fecha_Fin = $Fecha_Fin;
    }

    function setEstatus($Estatus) {
        $this->Estatus = $Estatus;
    }

    function setDatos_Contacto($Datos_Contacto) {
        $this->Datos_Contacto = $Datos_Contacto;
    }

    function setDatos_Ubicacion($Datos_Ubicacion) {
        $this->Datos_Ubicacion = $Datos_Ubicacion;
    }

    function setIdioma($Idioma) {
        $this->Idioma = $Idioma;
    }

    function setDetalle_Contacto($Detalle_Contacto) {
        $this->Detalle_Contacto = $Detalle_Contacto;
    }

    function setCategoria($Categoria) {
        $this->Categoria = $Categoria;
    }

    function setSubcategoria($Subcategoria) {
        $this->Subcategoria = $Subcategoria;
    }

    function setTipo_Actividad($Tipo_Actividad) {
        $this->Tipo_Actividad = $Tipo_Actividad;
    }

}
