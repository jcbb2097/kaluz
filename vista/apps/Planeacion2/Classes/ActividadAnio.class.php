<?php

include_once __DIR__ . "/../../../../WEB-INF/Classes/Catalogo.class.php";
//clase principal de Planeacion 
class Actividad_Anio
{
    private $IdActividad;
    private $Anio;
    private $Visible;

    public function DeactivateACME()
    {
        $consulta = "UPDATE k_actividad_anios a SET a.Visible = $this->Visible WHERE a.IdActividad in($this->IdActividad)  AND a.Anio=$this->Anio;";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_actividad_anios', 'IdActividad = ' . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }



    public function __construct()
    {
        $this->catalogo = new Catalogo();
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
     * Get the value of Visible
     */ 
    public function getVisible()
    {
        return $this->Visible;
    }

    /**
     * Set the value of Visible
     *
     * @return  self
     */ 
    public function setVisible($Visible)
    {
        $this->Visible = $Visible;

        return $this;
    }
}
