<?php

include_once("Catalogo.class.php");

class actividades
{

    private $id_archivoactividad;
    private $id_archivo;
    private $id_proyecto;
    private $id_exposicion;
    private $id_actividad1;
    private $id_actividad2;
    private $id_actividad3;
    private $id_actividad4;
    private $id_tipo;
    private $id_actividad;
    private $id_categoria;
    private $id_subcategoria;
    private $id_check_list;
    private $id_subcheck_list;


    public function getActividades()
    {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM k_archivoactividad WHERE k_archivoactividad.id_archivo = " . $this->id_archivo;
        //echo '<br><br>'.$consultaAcuerdo.'<br><br>';
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->id_proyecto = $row['id_proyecto'];
            $this->id_exposicion = $row['id_exposicion'];
            $this->id_actividad1 = $row['id_actividad1'];
            $this->id_actividad2 = $row['id_actividad2'];
            $this->id_actividad3 = $row['id_actividad3'];
            $this->id_tipo = $row['id_tipo'];
            $this->id_categoria = $row['id_categoria'];
            $this->id_subcategoria = $row['id_subcategoria'];
            $this->id_actividad = $row['id_actividad'];
            $this->id_check_list = $row['id_check_list'];
            $this->id_subcheck_list = $row['id_subcheck_list'];
            return true;
        }
        return false;
    }

    public function acuerdoac()
    {
        $catalogo = new Catalogo();

        $insert = "INSERT INTO k_archivoactividad(id_archivo,id_proyecto,id_actividad1,id_actividad2,id_tipo,id_actividad,id_categoria,id_subcategoria,id_check_list,id_subcheck_list)
                VALUES(" . $this->id_archivo . "," . $this->id_proyecto . "," . $this->id_actividad1 . "," . $this->id_actividad2 . "," . $this->id_tipo . "," . $this->id_actividad . "," . $this->id_categoria . "," . $this->id_subcategoria . "," . $this->id_check_list . "," . $this->id_subcheck_list . ");";
        $this->id_archivoactividad = $catalogo->insertarRegistro($insert);
        // echo "<br><br>$insert<br><br>";
        if ($this->id_archivoactividad == 0 || $this->id_archivoactividad == null) {
            return false;
        }
        return true;
    }

    public function editaracuerdoac()
    {
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_archivoactividad SET id_proyecto=$this->id_proyecto,id_tipo = $this->id_tipo
        id_actividad1=$this->id_actividad1, id_actividad2=$this->id_actividad2,id_actividad=$this->id_actividad,
        id_categoria=$this->id_categoria,id_subcategoria=$this->id_subcategoria,id_check_list=$this->id_check_list,id_subcheck_list=$this->id_subcheck_list
                    WHERE id_archivo = $this->id_archivo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_archivoactividad', 'id_archivo = ' . $this->id_archivo);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }


    public function Eliminaractividad()
    {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_archivoactividad WHERE id_archivo = $this->id_archivo;";
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_archivoactividad", "id_archivo = " . $this->id_archivo);
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function Eliminaractividad2()
    {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_archivoactividad WHERE id_archivoactividad = $this->id_archivoactividad;";
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_archivoactividad", "id_archivo = " . $this->id_archivo);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function check_list($tipo_entregable, $periodo, $Id_check, $Id_actividad, $Id_archivo)
    {
        $catalogo = new Catalogo();
        $where_tipo = "";
        $fecha_final = "";
        $avance = 0;
        if ($tipo_entregable == 9) {
            $where_tipo = 'ch.Inicial=1';
            $avance = 25;
        } elseif ($tipo_entregable == 10) {
            $where_tipo = 'ch.Final=1';
            $avance = 100;
            $fecha_final = " ,ch.Fecha_entrega_final=now()";
        } else {
            $total_avance = 1;
            $consulta_procesos = "SELECT ka.Proceso FROM k_checklist_actividad ka WHERE ka.Id_Periodo=$periodo AND ka.IdCheckList=$Id_check AND ka.IdActividad=$Id_actividad";
            //echo $consulta_procesos;
            $resultado = $catalogo->obtenerLista($consulta_procesos);
            while ($row = mysqli_fetch_array($resultado)) {
                $total_avance = $total_avance += $row['Proceso'];
            }
            $where_tipo = 'ch.Proceso=' . $total_avance;
            $avance = 50;
        }
        $consulta = "UPDATE k_checklist_actividad as ch set $where_tipo ,ch.Archivo=$Id_archivo,ch.Avance=$avance $fecha_final WHERE ch.Id_Periodo=$periodo AND ch.IdActividad=$Id_actividad AND ch.IdCheckList=$Id_check;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdActividad = ' . $this->id_actividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function check_list2($periodo, $Id_check, $Id_actividad)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $avance_total = 0;
        $avance_final = 0;
        $consulta_check = "SELECT c.IdCheckList,ch.Avance FROM k_checklist_actividad ch
     LEFT JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList
     WHERE c.IdCheckListPadre = $Id_check AND ch.Id_Periodo = $periodo AND ch.IdActividad = $Id_actividad ";
        //echo $consulta_check;
        $resultado = $catalogo->obtenerLista($consulta_check);
        while ($row = mysqli_fetch_array($resultado)) {
            $avance = $avance += $row['Avance'];
            $avance_total++;
        }
        $avance_final = $avance / $avance_total;
        $consulta = "UPDATE k_checklist_actividad as ch set ch.Avance=$avance_final WHERE ch.Id_Periodo=$periodo AND ch.IdActividad=$Id_actividad AND ch.IdCheckList=$Id_check;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdActividad = ' . $this->id_actividad);
        // echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function Eliminar_check_avance($id_actividad, $id_check, $tipo_entregable, $periodo, $archivo, $id_categoria)
    {
        $Inicial = "";
        $Final = "";
        $proceso = "";
        $Archivo_cambia = 'NULL';
        $Avance = "";
        $catalogo = new Catalogo();
        if ($archivo > 0) {
            $Archivo_cambia = $archivo;
        }

        $consulta = "SELECT ka.Inicial,ka.Proceso,ka.Final,Avance FROM k_checklist_actividad ka
        WHERE ka.Id_Periodo=$periodo AND ka.IdCheckList=$id_check AND ka.IdActividad=$id_actividad AND ka.IdCategoria=$id_categoria";
        //echo $consulta;
        $resultado = $catalogo->obtenerLista($consulta);

        while ($row = mysqli_fetch_array($resultado)) {
            $Inicial = $row['Inicial'];
            $proceso = $row['Proceso'];
            $Final = $row['Final'];
            $Avance = $row['Avance'];
        }
        if ($tipo_entregable == 9) {
            $Avance = $Avance -= 25;
            if ($Avance <= 0) {
                $Avance = 0;
            }
            $Inicial = 0;
        } elseif ($tipo_entregable == 14 && $proceso > 1) {
            $proceso = $proceso -= 1;
        } elseif ($tipo_entregable == 14 && $proceso == 1) {
            $proceso = 0;
            if ($Final == 1 && $Inicial == 1) {
            } elseif ($Final == 0 && $Inicial == 1) {
                $Avance = $Avance -= 25;
            }
        } elseif ($tipo_entregable == 10) {
            $Final = 0;
            if ($proceso > 1 && $Inicial == 1) {
                $Avance = 50;
            } elseif ($proceso == 1 && $Inicial == 1) {
                $Avance = 50;
            } elseif ($proceso == 0 && $Inicial == 1) {
                $Avance = 25;
            } else {
                $Avance = 0;
            }
        }
        $consulta = "UPDATE k_checklist_actividad as ch set ch.Avance=$Avance ,ch.Inicial=$Inicial,ch.Proceso=$proceso,ch.Final=$Final,Archivo=$Archivo_cambia WHERE ch.Id_Periodo=$periodo AND ch.IdActividad=$id_actividad AND ch.IdCheckList=$id_check AND ch.IdCategoria=$id_categoria";
        //echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', 'IdActividad = ' . $this->id_actividad);
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function obtener_ultimo_archivo($id_doc, $id_actividad)
    {
        $existe = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT d.id_documento
       FROM c_documento d INNER JOIN k_archivoactividad ka ON ka.id_archivo = d.id_documento
       WHERE d.id_documento = $id_doc  AND ka.id_actividad=$id_actividad";
        //echo $consulta;
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $existe = $row['id_documento'];
        }
        return $existe;
    }

    public function actualiza_porcentaje($tipo_entregable, $periodo, $check_global, $id_actividad,  $idcategoria)
    {
        $Avance = 0;
        if ($tipo_entregable == 9) {
            $Avance = $Avance = 25;
        }
        if ($tipo_entregable == 14) {
            $Avance = $Avance = 66;
        }
        if ($tipo_entregable == 10) {
            $Avance = $Avance = 100;
        }
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_checklist_actividad as ch set ch.Avance=$Avance  WHERE ch.Id_Periodo=$periodo AND ch.IdActividad=$id_actividad AND ch.IdCheckList=$check_global and ch.IdCategoria = $idcategoria;";
        //echo$consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_checklist_actividad', "ch.Id_Periodo=$periodo AND ch.IdActividad=$id_actividad AND ch.IdCheckList=$check_global and ch.IdCategoria = $idcategoria");
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_archivoactividad()
    {
        return $this->id_archivoactividad;
    }

    function getId_archivo()
    {
        return $this->id_archivo;
    }

    function getId_proyecto()
    {
        return $this->id_proyecto;
    }

    function getId_exposicion()
    {
        return $this->id_exposicion;
    }

    function getId_actividad1()
    {
        return $this->id_actividad1;
    }

    function getId_actividad2()
    {
        return $this->id_actividad2;
    }

    function getId_actividad3()
    {
        return $this->id_actividad3;
    }

    function getId_actividad4()
    {
        return $this->id_actividad4;
    }

    function getId_tipo()
    {
        return $this->id_tipo;
    }

    function setId_archivoactividad($id_archivoactividad)
    {
        $this->id_archivoactividad = $id_archivoactividad;
    }

    function setId_archivo($id_archivo)
    {
        $this->id_archivo = $id_archivo;
    }

    function setId_proyecto($id_proyecto)
    {
        $this->id_proyecto = $id_proyecto;
    }

    function setId_exposicion($id_exposicion)
    {
        $this->id_exposicion = $id_exposicion;
    }

    function setId_actividad1($id_actividad1)
    {
        $this->id_actividad1 = $id_actividad1;
    }

    function setId_actividad2($id_actividad2)
    {
        $this->id_actividad2 = $id_actividad2;
    }

    function setId_actividad3($id_actividad3)
    {
        $this->id_actividad3 = $id_actividad3;
    }

    function setId_actividad4($id_actividad4)
    {
        $this->id_actividad4 = $id_actividad4;
    }

    function setId_tipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }

    public function getId_actividad()
    {
        return $this->id_actividad;
    }

    public function setId_actividad($id_actividad)
    {
        $this->id_actividad = $id_actividad;

        return $this;
    }

    /**
     * Get the value of id_categoria
     */
    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    /**
     * Set the value of id_categoria
     *
     * @return  self
     */
    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    /**
     * Get the value of id_subcategoria
     */
    public function getId_subcategoria()
    {
        return $this->id_subcategoria;
    }

    /**
     * Set the value of id_subcategoria
     *
     * @return  self
     */
    public function setId_subcategoria($id_subcategoria)
    {
        $this->id_subcategoria = $id_subcategoria;

        return $this;
    }

    /**
     * Get the value of id_check_list
     */
    public function getId_check_list()
    {
        return $this->id_check_list;
    }

    /**
     * Set the value of id_check_list
     *
     * @return  self
     */
    public function setId_check_list($id_check_list)
    {
        $this->id_check_list = $id_check_list;

        return $this;
    }

    /**
     * Get the value of id_subcheck_list
     */
    public function getId_subcheck_list()
    {
        return $this->id_subcheck_list;
    }

    /**
     * Set the value of id_subcheck_list
     *
     * @return  self
     */
    public function setId_subcheck_list($id_subcheck_list)
    {
        $this->id_subcheck_list = $id_subcheck_list;

        return $this;
    }
}
