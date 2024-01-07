<?php
include_once("Catalogo.class.php");
class Evidencia
{

    private $IdCheckList;
    private $IdActividad;
    private $Id_Periodo;
    private $Archivo;
    private $Inicial;
    private $Proceso;
    private $Final;
    private $Fecha_entrega_propuesta;
    private $Nombre_alterno;
    private $Orden;
    private $Fecha_entrega_final;
    private $idcategoria;
    private $idscategoria;
    private $Entregable;


    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function Regresar_entregable($tipo_nuevo, $id_check, $id_actividad, $Id_Periodo, $tipo_viejo,$idcategoria)
    {
        $Inicial = "";
        $Final = "";
        $proceso = "";
        $Avance = "";
        $Fecha = "";

        $consulta = "SELECT ka.Inicial,ka.Proceso,ka.Final,Avance FROM k_checklist_actividad ka 
        WHERE ka.Id_Periodo=$Id_Periodo AND ka.IdCheckList=$id_check AND ka.IdActividad=$id_actividad AND ka.IdCategoria=$idcategoria";
        //echo$consulta;
        $resultado =  $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $Inicial = $row['Inicial'];
            $proceso = $row['Proceso'];
            $Final = $row['Final'];
            $Avance = $row['Avance'];
        }
        if ($tipo_nuevo == 9 && $tipo_viejo == 10) {
       
            $Fecha = ",ch.Fecha_entrega_final=null";
            $Final = 0;
            $Inicial = 1;
            if ($proceso >= 1) {
                $Avance = 50;
            } else {
                $Avance = 25;
            }
        } elseif ($tipo_nuevo == 14 && $tipo_viejo == 10) {
            $Fecha = ",ch.Fecha_entrega_final=null";
            $Avance = 50;
            $Final = 0;
            if ($proceso > 1) {
                $proceso = $proceso += 1;
            } else {
                $proceso = 1;
            }
        } elseif ($tipo_nuevo == 9 && $tipo_viejo == 14) {
            $Inicial = 1;
       
            if ($proceso > 1) {
                $proceso = $proceso -= 1;
            } else {
                $proceso = 0;
            }
            if ($Final == 1) {
                $Avance = 100;
            } else {
                $Avance = 25;
            }
        } elseif ($tipo_nuevo == 10 && $tipo_viejo == 14) {
            $Avance = 100;
        
            $Fecha = ",ch.Fecha_entrega_final=now()";
            $Final = 1;
            if ($proceso > 1) {
                $proceso = $proceso -= 1;
            } else {
                $proceso = 0;
            }
        } elseif ($tipo_nuevo == 10 && $tipo_viejo == 9) {
            $Avance = 100;
      
            $Fecha = ",ch.Fecha_entrega_final=now()";
            $Final = 1;
            $Inicial = 0;
        } elseif ($tipo_nuevo == 14 && $tipo_viejo == 9) {
      
            if ($Final == 1) {
                $Avance = 100;
            } else {
                $Avance = 50;
            }
            if ($proceso > 1) {
                $proceso = $proceso -= 1;
            } else {
                $proceso = 0;
            }
            $Inicial = 0;
        }
        $consulta = "UPDATE k_checklist_actividad as ch set ch.Avance=$Avance ,ch.Inicial=$Inicial,ch.Proceso=$proceso,ch.Final=$Final" . $Fecha . " WHERE ch.Id_Periodo=$Id_Periodo AND ch.IdActividad=$id_actividad AND ch.IdCheckList=$id_check AND ch.IdCategoria=$idcategoria;";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdCheckList = ' . $this->IdCheckList);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function get_Avance($Id_periodo, $Id_categoria, $Id_actividad, $Id_check)
    {
        $avance = 0;
        $consulta = "SELECT a.Avance FROM k_checklist_actividad as a WHERE a.Id_Periodo=$Id_periodo AND a.IdActividad=$Id_actividad AND a.IdCategoria=$Id_categoria AND a.IdCheckList=$Id_check";
        $resul_Ac =  $this->catalogo->obtenerLista($consulta);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['Avance'];
        }
        return $avance;
    }

    public function actualizarAvance2022($Id_periodo, $Id_categoria, $Id_actividad, $Id_check, $id_tipo)
    {
        $avance = 0;
        if ($id_tipo == 9) {
            $avance = 25;
        } elseif ($id_tipo == 14) {
            $avance = 50;
        }
        $consulta = "update k_checklist_actividad a set a.Avance=$avance WHERE a.Id_Periodo=$Id_periodo AND a.IdActividad=$Id_actividad AND a.IdCheckList=$Id_check AND a.IdCategoria=$Id_categoria";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdCategoria = ' . $this->idcategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    /**
     * Get the value of IdCheckList
     */
    public function getIdCheckList()
    {
        return $this->IdCheckList;
    }

    /**
     * Set the value of IdCheckList
     *
     * @return  self
     */
    public function setIdCheckList($IdCheckList)
    {
        $this->IdCheckList = $IdCheckList;

        return $this;
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
     * Get the value of Id_Periodo
     */
    public function getId_Periodo()
    {
        return $this->Id_Periodo;
    }

    /**
     * Set the value of Id_Periodo
     *
     * @return  self
     */
    public function setId_Periodo($Id_Periodo)
    {
        $this->Id_Periodo = $Id_Periodo;

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
     * Get the value of Inicial
     */
    public function getInicial()
    {
        return $this->Inicial;
    }

    /**
     * Set the value of Inicial
     *
     * @return  self
     */
    public function setInicial($Inicial)
    {
        $this->Inicial = $Inicial;

        return $this;
    }

    /**
     * Get the value of Proceso
     */
    public function getProceso()
    {
        return $this->Proceso;
    }

    /**
     * Set the value of Proceso
     *
     * @return  self
     */
    public function setProceso($Proceso)
    {
        $this->Proceso = $Proceso;

        return $this;
    }

    /**
     * Get the value of Final
     */
    public function getFinal()
    {
        return $this->Final;
    }

    /**
     * Set the value of Final
     *
     * @return  self
     */
    public function setFinal($Final)
    {
        $this->Final = $Final;

        return $this;
    }

    /**
     * Get the value of Fecha_entrega_propuesta
     */
    public function getFecha_entrega_propuesta()
    {
        return $this->Fecha_entrega_propuesta;
    }

    /**
     * Set the value of Fecha_entrega_propuesta
     *
     * @return  self
     */
    public function setFecha_entrega_propuesta($Fecha_entrega_propuesta)
    {
        $this->Fecha_entrega_propuesta = $Fecha_entrega_propuesta;

        return $this;
    }

    /**
     * Get the value of Nombre_alterno
     */
    public function getNombre_alterno()
    {
        return $this->Nombre_alterno;
    }

    /**
     * Set the value of Nombre_alterno
     *
     * @return  self
     */
    public function setNombre_alterno($Nombre_alterno)
    {
        $this->Nombre_alterno = $Nombre_alterno;

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
     * Get the value of Fecha_entrega_final
     */
    public function getFecha_entrega_final()
    {
        return $this->Fecha_entrega_final;
    }

    /**
     * Set the value of Fecha_entrega_final
     *
     * @return  self
     */
    public function setFecha_entrega_final($Fecha_entrega_final)
    {
        $this->Fecha_entrega_final = $Fecha_entrega_final;

        return $this;
    }

    /**
     * Get the value of idcategoria
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Set the value of idcategoria
     *
     * @return  self
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get the value of idscategoria
     */
    public function getIdscategoria()
    {
        return $this->idscategoria;
    }

    /**
     * Set the value of idscategoria
     *
     * @return  self
     */
    public function setIdscategoria($idscategoria)
    {
        $this->idscategoria = $idscategoria;

        return $this;
    }

    /**
     * Get the value of Entregable
     */
    public function getEntregable()
    {
        return $this->Entregable;
    }

    /**
     * Set the value of Entregable
     *
     * @return  self
     */
    public function setEntregable($Entregable)
    {
        $this->Entregable = $Entregable;

        return $this;
    }
}
