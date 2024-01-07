<?php

include_once __DIR__ . "/../../../../WEB-INF/Classes/Catalogo.class.php";
//clase principal de Planeacion 
class ACME
{
    private $IdActividad;
    private $Nombre;
    private $Anio;
    private $Periodo;
    private $IdArea;
    private $IdEje;
    private $IdResponsable;
    private $IdTipoActividad;
    private $IdNivelActividad;
    private $IdActividadSuperior;
    private $Fecha;
    private $Orden;
    private $FechaCreacion;
    private $UsuarioCreacion;
    private $FechaUltimaModificacion;
    private $UsuarioUltimaModificacion;
    private $Pantalla;
    private $Numeracion;
    private $cap3000;
    private $ActividadDeTexto;
    private $Idcategoria;
    private $OrdenDeEje;
    private $Idscategoria;
    private $visible_plan;
    private $nombre_entregable;


    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }


    public function getAcme($idAcme)
    {
        $consultaAcuerdo = "SELECT * FROM c_actividad a WHERE a.IdActividad=$idAcme";
        $resultAcuerdo = $this->catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->IdActividad = $row['IdActividad'];
            $this->Nombre = $row['Nombre'];
            $this->Anio = $row['Anio'];
            $this->Periodo = $row['Periodo'];
            $this->IdArea = $row['IdArea'];
            $this->IdEje = $row['IdEje'];
            $this->IdResponsable = $row['IdResponsable'];
            $this->IdTipoActividad = $row['IdTipoActividad'];
            $this->IdNivelActividad = $row['IdNivelActividad'];
            $this->IdActividadSuperior = $row['IdActividadSuperior'];
            $this->Fecha = $row['Fecha'];
            $this->Orden = $row['Orden'];
            $this->FechaCreacion = $row['FechaCreacion'];
            $this->UsuarioCreacion = $row['UsuarioCreacion'];
            $this->FechaUltimaModificacion = $row['FechaUltimaModificacion'];
            $this->UsuarioUltimaModificacion = $row['UsuarioUltimaModificacion'];
            $this->Pantalla = $row['Pantalla'];
            $this->Numeracion = $row['Numeracion'];
            $this->cap3000 = $row['cap3000'];
            $this->ActividadDeTexto = $row['ActividadDeTexto'];
            $this->Idcategoria = $row['Idcategoria'];
            $this->OrdenDeEje = $row['OrdenDeEje'];
            $this->Idscategoria = $row['Idscategoria'];
            $this->visible_plan = $row['visible_plan'];
            $this->nombre_entregable = $row['nombre_entregable'];

            return true;
        }
        return false;
    }

    public function lastID()
    {
        $consulta = "SELECT MAX(a.IdActividad) id FROM c_actividad a";
        $resultado = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $idLast = $row['id'];
        }
        $idLast = $idLast + 1;
        return $idLast;
    }

    public function newAcme()
    {
        if ($this->IdActividadSuperior == "") {
            $this->IdActividadSuperior = 'NULL';
        }

        $insert = "insert into c_actividad (IdActividad,Nombre,Anio,Periodo,IdArea,IdEje,IdResponsable,IdTipoActividad,IdNivelActividad,IdActividadSuperior,Fecha,Orden,FechaCreacion,UsuarioCreacion,FechaUltimaModificacion,UsuarioUltimaModificacion,Pantalla)
            VALUES(" . $this->IdActividad . ",'" . $this->Nombre . "'," . $this->Anio . "," . $this->Periodo . "," . $this->IdArea . "," . $this->IdEje . "," . $this->IdResponsable . "," . $this->IdTipoActividad . "," . $this->IdNivelActividad . "," . $this->IdActividadSuperior . ",now()," . $this->Orden . ",now(),'" . $this->UsuarioCreacion . "',now(),'" . $this->UsuarioUltimaModificacion . "','" . $this->Pantalla . "');";
        $this->IdActividad = $this->catalogo->insertarRegistro($insert);
        if ($this->IdActividad == 0 || $this->IdActividad == null) {
            return false;
        }
        return true;
    }

    public function newAcmeCategoria()
    {
        
        $insert = "insert into k_actividad_categoria (IdActividad,IdCategoria,IdPeriodo,Numeracion,Orden,Activo) 
        VALUES(" . $this->IdActividad . "," . $this->Idcategoria . "," . $this->Periodo . ",'" . $this->Numeracion . "'," . $this->Orden . ",1);";
        $this->IdActividad = $this->catalogo->insertarRegistro($insert);
        if ($this->IdActividad == 0 || $this->IdActividad == null) {
            return false;
        }
        return true;
    }



    /**
     * Get the value of IdActividad
     */
    public function getIdActividad()
    {
        return $this->IdActividad;
    }

    /**
     * Set the value of IdActividad
     *
     * @return  self
     */
    public function setIdActividad($IdActividad)
    {
        $this->IdActividad = $IdActividad;

        return $this;
    }

    /**
     * Get the value of Nombre
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @return  self
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Anio
     */
    public function getAnio()
    {
        return $this->Anio;
    }

    /**
     * Set the value of Anio
     *
     * @return  self
     */
    public function setAnio($Anio)
    {
        $this->Anio = $Anio;

        return $this;
    }

    /**
     * Get the value of Periodo
     */
    public function getPeriodo()
    {
        return $this->Periodo;
    }

    /**
     * Set the value of Periodo
     *
     * @return  self
     */
    public function setPeriodo($Periodo)
    {
        $this->Periodo = $Periodo;

        return $this;
    }

    /**
     * Get the value of IdArea
     */
    public function getIdArea()
    {
        return $this->IdArea;
    }

    /**
     * Set the value of IdArea
     *
     * @return  self
     */
    public function setIdArea($IdArea)
    {
        $this->IdArea = $IdArea;

        return $this;
    }

    /**
     * Get the value of IdEje
     */
    public function getIdEje()
    {
        return $this->IdEje;
    }

    /**
     * Set the value of IdEje
     *
     * @return  self
     */
    public function setIdEje($IdEje)
    {
        $this->IdEje = $IdEje;

        return $this;
    }

    /**
     * Get the value of IdResponsable
     */
    public function getIdResponsable()
    {
        return $this->IdResponsable;
    }

    /**
     * Set the value of IdResponsable
     *
     * @return  self
     */
    public function setIdResponsable($IdResponsable)
    {
        $this->IdResponsable = $IdResponsable;

        return $this;
    }

    /**
     * Get the value of IdTipoActividad
     */
    public function getIdTipoActividad()
    {
        return $this->IdTipoActividad;
    }

    /**
     * Set the value of IdTipoActividad
     *
     * @return  self
     */
    public function setIdTipoActividad($IdTipoActividad)
    {
        $this->IdTipoActividad = $IdTipoActividad;

        return $this;
    }

    /**
     * Get the value of IdNivelActividad
     */
    public function getIdNivelActividad()
    {
        return $this->IdNivelActividad;
    }

    /**
     * Set the value of IdNivelActividad
     *
     * @return  self
     */
    public function setIdNivelActividad($IdNivelActividad)
    {
        $this->IdNivelActividad = $IdNivelActividad;

        return $this;
    }

    /**
     * Get the value of IdActividadSuperior
     */
    public function getIdActividadSuperior()
    {
        return $this->IdActividadSuperior;
    }

    /**
     * Set the value of IdActividadSuperior
     *
     * @return  self
     */
    public function setIdActividadSuperior($IdActividadSuperior)
    {
        $this->IdActividadSuperior = $IdActividadSuperior;

        return $this;
    }

    /**
     * Get the value of Fecha
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * Set the value of Fecha
     *
     * @return  self
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    /**
     * Get the value of Orden
     */
    public function getOrden()
    {
        return $this->Orden;
    }

    /**
     * Set the value of Orden
     *
     * @return  self
     */
    public function setOrden($Orden)
    {
        $this->Orden = $Orden;

        return $this;
    }

    /**
     * Get the value of FechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->FechaCreacion;
    }

    /**
     * Set the value of FechaCreacion
     *
     * @return  self
     */
    public function setFechaCreacion($FechaCreacion)
    {
        $this->FechaCreacion = $FechaCreacion;

        return $this;
    }

    /**
     * Get the value of UsuarioCreacion
     */
    public function getUsuarioCreacion()
    {
        return $this->UsuarioCreacion;
    }

    /**
     * Set the value of UsuarioCreacion
     *
     * @return  self
     */
    public function setUsuarioCreacion($UsuarioCreacion)
    {
        $this->UsuarioCreacion = $UsuarioCreacion;

        return $this;
    }

    /**
     * Get the value of FechaUltimaModificacion
     */
    public function getFechaUltimaModificacion()
    {
        return $this->FechaUltimaModificacion;
    }

    /**
     * Set the value of FechaUltimaModificacion
     *
     * @return  self
     */
    public function setFechaUltimaModificacion($FechaUltimaModificacion)
    {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;

        return $this;
    }

    /**
     * Get the value of UsuarioUltimaModificacion
     */
    public function getUsuarioUltimaModificacion()
    {
        return $this->UsuarioUltimaModificacion;
    }

    /**
     * Set the value of UsuarioUltimaModificacion
     *
     * @return  self
     */
    public function setUsuarioUltimaModificacion($UsuarioUltimaModificacion)
    {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;

        return $this;
    }

    /**
     * Get the value of Pantalla
     */
    public function getPantalla()
    {
        return $this->Pantalla;
    }

    /**
     * Set the value of Pantalla
     *
     * @return  self
     */
    public function setPantalla($Pantalla)
    {
        $this->Pantalla = $Pantalla;

        return $this;
    }

    /**
     * Get the value of Numeracion
     */
    public function getNumeracion()
    {
        return $this->Numeracion;
    }

    /**
     * Set the value of Numeracion
     *
     * @return  self
     */
    public function setNumeracion($Numeracion)
    {
        $this->Numeracion = $Numeracion;

        return $this;
    }

    /**
     * Get the value of cap3000
     */
    public function getCap3000()
    {
        return $this->cap3000;
    }

    /**
     * Set the value of cap3000
     *
     * @return  self
     */
    public function setCap3000($cap3000)
    {
        $this->cap3000 = $cap3000;

        return $this;
    }

    /**
     * Get the value of ActividadDeTexto
     */
    public function getActividadDeTexto()
    {
        return $this->ActividadDeTexto;
    }

    /**
     * Set the value of ActividadDeTexto
     *
     * @return  self
     */
    public function setActividadDeTexto($ActividadDeTexto)
    {
        $this->ActividadDeTexto = $ActividadDeTexto;

        return $this;
    }

    /**
     * Get the value of Idcategoria
     */
    public function getIdcategoria()
    {
        return $this->Idcategoria;
    }

    /**
     * Set the value of Idcategoria
     *
     * @return  self
     */
    public function setIdcategoria($Idcategoria)
    {
        $this->Idcategoria = $Idcategoria;

        return $this;
    }

    /**
     * Get the value of OrdenDeEje
     */
    public function getOrdenDeEje()
    {
        return $this->OrdenDeEje;
    }

    /**
     * Set the value of OrdenDeEje
     *
     * @return  self
     */
    public function setOrdenDeEje($OrdenDeEje)
    {
        $this->OrdenDeEje = $OrdenDeEje;

        return $this;
    }

    /**
     * Get the value of Idscategoria
     */
    public function getIdscategoria()
    {
        return $this->Idscategoria;
    }

    /**
     * Set the value of Idscategoria
     *
     * @return  self
     */
    public function setIdscategoria($Idscategoria)
    {
        $this->Idscategoria = $Idscategoria;

        return $this;
    }

    /**
     * Get the value of visible_plan
     */
    public function getVisible_plan()
    {
        return $this->visible_plan;
    }

    /**
     * Set the value of visible_plan
     *
     * @return  self
     */
    public function setVisible_plan($visible_plan)
    {
        $this->visible_plan = $visible_plan;

        return $this;
    }

    /**
     * Get the value of nombre_entregable
     */
    public function getNombre_entregable()
    {
        return $this->nombre_entregable;
    }

    /**
     * Set the value of nombre_entregable
     *
     * @return  self
     */
    public function setNombre_entregable($nombre_entregable)
    {
        $this->nombre_entregable = $nombre_entregable;

        return $this;
    }
}
