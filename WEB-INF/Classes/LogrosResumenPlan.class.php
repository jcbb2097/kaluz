<?php
include_once("Catalogo.class.php");
class Plan_resumen
{
    private $Id_planeacion;
    private $Resumen;
    private $orden;
    private $Id_resumen;

    public function getResumen_plan() {
        $catalogo = new Catalogo();
        $consulta_logro = "SELECT * FROM c_logrosActividadesResumenPlan as la WHERE la.Id_planeacion=".$this->Id_planeacion;
        $result_logro = $catalogo->obtenerLista($consulta_logro);
        while ($row = mysqli_fetch_array($result_logro)) {
            $this->Id_planeacion = $row['Id_planeacion'];
            $this->Resumen = $row['Resumen'];
            $this->orden = $row['orden'];
            $this->Id_resumen = $row['Id_resumen'];
           
            return true;
        }
        return false;
    }
    public function nuevoResumen() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_logrosActividadesResumenPlan (Id_planeacion,Resumen,orden)
                    VALUES (".$this->Id_planeacion.",'".$this->Resumen."','".$this->orden."');";
        $this->IdLogroAct = $catalogo->insertarRegistro($insert);
         //echo "<br><br>$insert<br><br>";
        if ($this->IdLogroAct == 0 || $this->IdLogroAct == null) {
            return false;
        }
        return true;
    }
    public function editarResuemn() {
        $catalogo = new Catalogo();
        $consulta= "
                    UPDATE c_logrosActividadesResumenPlan SET
                    Resumen='".$this->Resumen."'
                    where Id_resumen = $this->Id_resumen
                    ";

        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_logrosActividadesResumenPlan', 'Id_resumen='.$this->Id_resumen);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }


    /**
     * Get the value of Id_planeacion
     */ 
    public function getId_planeacion()
    {
        return $this->Id_planeacion;
    }

    /**
     * Set the value of Id_planeacion
     *
     * @return  self
     */ 
    public function setId_planeacion($Id_planeacion)
    {
        $this->Id_planeacion = $Id_planeacion;

        return $this;
    }

    /**
     * Get the value of Resumen
     */ 
    public function getResumen()
    {
        return $this->Resumen;
    }

    /**
     * Set the value of Resumen
     *
     * @return  self
     */ 
    public function setResumen($Resumen)
    {
        $this->Resumen = $Resumen;

        return $this;
    }

    /**
     * Get the value of orden
     */ 
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set the value of orden
     *
     * @return  self
     */ 
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get the value of Id_resumen
     */ 
    public function getId_resumen()
    {
        return $this->Id_resumen;
    }

    /**
     * Set the value of Id_resumen
     *
     * @return  self
     */ 
    public function setId_resumen($Id_resumen)
    {
        $this->Id_resumen = $Id_resumen;

        return $this;
    }
}
