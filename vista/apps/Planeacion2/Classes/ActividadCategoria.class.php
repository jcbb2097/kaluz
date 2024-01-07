<?php

include_once __DIR__ . "/../../../../WEB-INF/Classes/Catalogo.class.php";
//clase principal de Planeacion 
class Actividad_Categoria
{
    private $IdActividad;
    private $IdCategoria;
    private $IdPeriodo;
    private $Numeracion;
    private $Orden;
    private $Activo;
    private $Archivo;
    private $NombreEntregable;


    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function DeactivateAccate($id_categoria)
    {
        $consulta = "UPDATE k_actividad_categoria a SET a.Activo = $this->Activo WHERE a.IdCategoria in($id_categoria) AND a.IdPeriodo=$this->IdPeriodo;";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_actividad_categoria', 'IdCategoria = ' . $this->IdCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function DeactivateAct()
    {
        $consulta = "UPDATE k_actividad_categoria a SET a.Activo = $this->Activo WHERE a.IdActividad  in($this->IdActividad) AND a.IdCategoria in($this->IdCategoria) AND a.IdPeriodo=$this->IdPeriodo;";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_actividad_categoria', 'IdCategoria = ' . $this->IdCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Entregable($idArchivo, $idActividad, $idCategoria, $idPeriodo)
    {
        if ($idActividad == '') {
            $idActividad = 'NULL';
        }
        $consulta = "UPDATE k_actividad_categoria a SET a.Archivo = $idArchivo WHERE a.IdActividad  in($idActividad) AND a.IdCategoria =$idCategoria AND a.IdPeriodo=$idPeriodo;";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_actividad_categoria', 'IdCategoria = ' . $idCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
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
     * Get the value of IdCategoria
     */
    public function getIdCategoria()
    {
        return $this->IdCategoria;
    }

    /**
     * Set the value of IdCategoria
     *
     * @return  self
     */
    public function setIdCategoria($IdCategoria)
    {
        $this->IdCategoria = $IdCategoria;

        return $this;
    }

    /**
     * Get the value of IdPeriodo
     */
    public function getIdPeriodo()
    {
        return $this->IdPeriodo;
    }

    /**
     * Set the value of IdPeriodo
     *
     * @return  self
     */
    public function setIdPeriodo($IdPeriodo)
    {
        $this->IdPeriodo = $IdPeriodo;

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
     * Get the value of Activo
     */
    public function getActivo()
    {
        return $this->Activo;
    }

    /**
     * Set the value of Activo
     *
     * @return  self
     */
    public function setActivo($Activo)
    {
        $this->Activo = $Activo;

        return $this;
    }

    /**
     * Get the value of Archivo
     */
    public function getArchivo()
    {
        return $this->Archivo;
    }

    /**
     * Set the value of Archivo
     *
     * @return  self
     */
    public function setArchivo($Archivo)
    {
        $this->Archivo = $Archivo;

        return $this;
    }

    /**
     * Get the value of NombreEntregable
     */
    public function getNombreEntregable()
    {
        return $this->NombreEntregable;
    }

    /**
     * Set the value of NombreEntregable
     *
     * @return  self
     */
    public function setNombreEntregable($NombreEntregable)
    {
        $this->NombreEntregable = $NombreEntregable;

        return $this;
    }
}
