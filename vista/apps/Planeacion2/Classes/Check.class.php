<?php

include_once __DIR__ . "/../../../../WEB-INF/Classes/Catalogo.class.php";

class Check
{
    private $IdCheckList;
    private $IdActividad;
    private $Id_Periodo;
    private $IdCategoria;
    private $Archivo;
    private $Inicial;
    private $Proceso;
    private $Final;
    private $Avance;
    private $Fecha_entrega_propuesta;
    private $Nombre_alterno;
    private $Orden;
    private $Fecha_entrega_final;
    private $Entregable;
    private $Visible;
    private $Nivel;
    private $Tipo;
    private $IdCheckListPadre;
    private $Estructura;
    private $Automatico;




    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function getLastId()
    {
        $consulta = "SELECT MAX(a.IdCheckList) id FROM c_checkList a";
        $resultado = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $idLast = $row['id'];
        }
        $idLast = $idLast + 1;
        return $idLast;
    }

    /*----------------------------------------------------------------------------------------------------*/
    public function Nuevocheck2()
    {
        $insert = "INSERT into c_checkList (IdCheckList,Nombre,Nivel,IdCheckListPadre,Tipo,IdResponsable,Estructura)
       VALUES( $this->IdCheckList,' $this->Nombre_alterno', $this->Nivel, $this->IdCheckListPadre,$this->Tipo,$this->IdEncargado,'$this->Estructura');";
        $this->IdCheckList = $this->catalogo->insertarRegistro($insert);

        if ($this->IdCheckList == 0 || $this->IdCheckList == null) {
            return false;
        }
        return true;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function Nuevocheck()
    {
        $insert = "INSERT INTO k_checklist_actividad(IdCheckList,IdActividad,Id_Periodo,IdCategoria,Orden,IdEncargado,Entregable,Visible)
           VALUES( $this->IdCheckList, $this->IdActividad, $this->Id_Periodo, $this->IdCategoria,$this->Orden,$this->IdEncargado,'$this->Entregable',$this->Visible);";
        $this->IdCheckList = $this->catalogo->insertarRegistro($insert);

        if ($this->IdCheckList == 0 || $this->IdCheckList == null) {
            return false;
        }
        return true;
    }
    /*----------------------------------------------------------------------------------------------------*/

    public function  updatecheck()
    {
        $consulta = "UPDATE k_checklist_actividad a set a.IdEncargado=$this->IdEncargado,a.Nombre_alterno='$this->Nombre_alterno',a.Visible=$this->Visible,a.Entregable='$this->Entregable',a.Orden=$this->Orden
         WHERE a.Id_Periodo=$this->Id_Periodo and a.IdActividad=$this->IdActividad and a.IdCategoria=$this->IdCategoria and a.IdCheckList=$this->IdCheckList";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdCheckList = ' . $this->IdCheckList);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/

    public function Eliminar_check()
    {
        $ids = $this->get_hijos($this->IdCheckList);
        $consulta = "DELETE FROM k_checklist_actividad WHERE Id_Periodo=$this->Id_Periodo AND idActividad=$this->IdActividad AND IdCheckList in($ids) AND IdCategoria=$this->IdCategoria";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdCheckList = ' . $this->IdCheckList);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Deactive_check_categoria($acme)
    {
        $IdsDeActividad = $this->getActividadesCategoria($this->IdCategoria, $acme, $this->Id_Periodo);
        $consulta = "UPDATE k_checklist_actividad ch set ch.Visible=$this->Visible WHERE ch.IdCategoria in($this->IdCategoria) AND ch.Id_Periodo=$this->Id_Periodo AND ch.IdActividad in ($IdsDeActividad)";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdCheckList = ' . $this->IdCheckList);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function getActividadesCategoria($idcategoria, $tipo, $anio)
    {
        $ids = array();
        $consulta_sub = "SELECT DISTINCTROW
        a.IdActividad
    FROM
        c_actividad a
        INNER JOIN k_checklist_actividad aa ON aa.IdActividad = a.IdActividad
        WHERE aa.IdCategoria in($idcategoria) AND a.IdTipoActividad=$tipo AND aa.Id_Periodo=$anio";
        //echo$consulta_sub;
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['IdActividad']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }

    public function get_hijos($IdCheckList)
    {
        $ids = array();
        array_push($ids, $IdCheckList);
        $consulta_sub = "SELECT c.IdCheckList FROM c_checkList c where c.IdCheckListPadre=$IdCheckList ORDER BY c.Orden";
        //echo $consulta_sub;
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['IdCheckList']);
            }
        }

        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }
    public function getPadre($idCheck)
    {
        $idChecks = array();
        array_push($idChecks, $idCheck);
        $consulta_sub = "SELECT c.IdCheckListPadre FROM c_checklist c where c.IdCheckList=$idCheck";
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($idChecks, $row['IdCheckListPadre']);
            }
        }

        return $idChecks;
    }

    public function deactivate_check($IdCheckList, $Periodo, $Idactividad, $Activa, $idcategoria)
    {
        $IdsDeCategoria = $IdCheckList ; //$this->get_hijos($IdCheckList);
        $consulta = "UPDATE k_checklist_actividad as a SET a.Visible=$Activa WHERE a.Id_Periodo=$Periodo AND a.IdActividad=$Idactividad AND a.IdCheckList IN($IdsDeCategoria) AND a.IdCategoria =$idcategoria";
        $query =  $this->catalogo->ejecutaConsultaActualizacion($consulta, 'c_actividad', 'IdActividad=' . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function deactivate_check_actividad($idcategoria, $Periodo, $Idactividad, $Activa)
    {
        $consulta = "UPDATE k_checklist_actividad as a SET a.Visible=$Activa WHERE a.Id_Periodo=$Periodo AND a.IdActividad in ($Idactividad) AND a.IdCategoria =$idcategoria";
        $query =  $this->catalogo->ejecutaConsultaActualizacion($consulta, 'c_actividad', 'IdActividad=' . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //funcion para actualizar avance de check_padre
    public function Actualiza_avance($avance, $periodo, $check, $actividad, $idcategoria)
    {

        $consulta = "UPDATE k_checklist_actividad as ch set ch.Avance=$avance WHERE  ch.Id_Periodo=$periodo and ch.IdCheckList=$check and ch.IdActividad=$actividad and ch.Idcategoria=$idcategoria";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdActividad=' . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function avance_subchecks($IdActividad, $periodo, $categoria, $idcheck)
    {
        $total_check = 0;
        $total_check_v = 0;
        $avance = 0;
        $consulta = "SELECT ch.IdCheckList,ch.Avance
        FROM k_checklist_actividad ch INNER JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList INNER JOIN c_actividad a on a.IdActividad=ch.IdActividad
        WHERE c.IdCheckListPadre=$idcheck AND ch.Id_Periodo=$periodo AND ch.IdActividad=$IdActividad and ch.Idcategoria=$categoria AND ch.Visible=1
            ORDER BY ch.Orden";
        //echo"<br>".$consulta."<br>";
        $resultado = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $total_check++;
            $total_check_v = $total_check_v += $row['Avance'];
        }
        if ($total_check > 0) {
            $avance = $total_check_v  / $total_check;
        }

        return $avance;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function get_checks($IdActividad, $periodo, $categoria)
    {
        $total_check = 0;

        $consulta = "SELECT COUNT(a.IdCheckList) checks FROM k_checklist_actividad a WHERE a.Id_Periodo=$periodo AND a.IdCategoria=$categoria AND a.IdActividad=$IdActividad";
        $resultado = $this->catalogo->obtenerLista($consulta);
        //echo$consulta;
        while ($row = mysqli_fetch_array($resultado)) {
            $total_check = $row['checks'];
        }
        return $total_check;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function insertCheck()
    {
        $insert = "INSERT INTO k_checklist_actividad(IdCheckList,IdActividad,Id_Periodo,IdCategoria)
        VALUES( $this->IdCheckList, $this->IdActividad, $this->Id_Periodo, $this->IdCategoria );";
        $accion = $this->IdCheckList = $this->catalogo->insertarRegistro($insert);
        // echo "<br><br>$insert<br><br>";
        return $accion;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function existe($idCategoria, $idactividad, $idPeriodo, $idCheck)
    {
        $id = "";
        $consulta = "SELECT COUNT(a.IdCheckList)existe FROM k_checklist_actividad a
        WHERE a.Id_Periodo=$idPeriodo AND a.IdCategoria=$idCategoria AND a.IdActividad=$idactividad AND a.IdCheckList=$idCheck";
        $resultado = $this->catalogo->obtenerLista($consulta);
        //echo$consulta;
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_array($resultado)) {
                $id = $row['existe'];
            }
        } else {
            $id = 0;
        }
        return $id;
    }
    /*----------------------------------------------------------------------------------------------------*/


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
     * Get the value of Avance
     */
    public function getAvance()
    {
        return $this->Avance;
    }

    /**
     * Set the value of Avance
     *
     * @return  self
     */
    public function setAvance($Avance)
    {
        $this->Avance = $Avance;

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
     * Get the value of IdEncargado
     */
    public function getIdEncargado()
    {
        return $this->IdEncargado;
    }

    /**
     * Set the value of IdEncargado
     *
     * @return  self
     */
    public function setIdEncargado($IdEncargado)
    {
        $this->IdEncargado = $IdEncargado;

        return $this;
    }

    /**
     * Get the value of Nivel
     */
    public function getNivel()
    {
        return $this->Nivel;
    }

    /**
     * Set the value of Nivel
     *
     * @return  self
     */
    public function setNivel($Nivel)
    {
        $this->Nivel = $Nivel;

        return $this;
    }

    /**
     * Get the value of Tipo
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @return  self
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * Get the value of IdCheckListPadre
     */
    public function getIdCheckListPadre()
    {
        return $this->IdCheckListPadre;
    }

    /**
     * Set the value of IdCheckListPadre
     *
     * @return  self
     */
    public function setIdCheckListPadre($IdCheckListPadre)
    {
        $this->IdCheckListPadre = $IdCheckListPadre;

        return $this;
    }

    /**
     * Get the value of Estructura
     */
    public function getEstructura()
    {
        return $this->Estructura;
    }

    /**
     * Set the value of Estructura
     *
     * @return  self
     */
    public function setEstructura($Estructura)
    {
        $this->Estructura = $Estructura;

        return $this;
    }

    /**
     * Get the value of Automatico
     */
    public function getAutomatico()
    {
        return $this->Automatico;
    }

    /**
     * Set the value of Automatico
     *
     * @return  self
     */
    public function setAutomatico($Automatico)
    {
        $this->Automatico = $Automatico;

        return $this;
    }
}
