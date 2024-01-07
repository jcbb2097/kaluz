<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Entregablecheck {

    private $Id_entregablecheck;
    private $entregable;
    private $checklist;
    private $responsable;
    private $anio;
    private $eje;
    private $tipoactividad;
    private $global;
    private $general;
    private $particular;
    private $subactividad;
    private $categoria;
    private $subcategoria;

    public function getentregablecheck() {
        $catalogo = new Catalogo();
        //$consultaIntervalo = "SELECT * FROM k_entregableCheckList WHERE IdEntregableCheckList = " . $this->Id_entregablecheck;

        $consultaIntervalo = "SELECT enche.IdEntregable as IdEntregable, enche.IdCheckList as IdCheckList, enche.IdResponsableVbo as IdResponsableVbo, pe.Id_Periodo AS Periodo, ej.idEje AS Eje, a.IdTipoActividad as TipoActividad
                            from k_entregableCheckList AS enche
                            LEFT JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                            LEFT JOIN c_checkList AS lis ON lis.IdCheckList=enche.IdCheckList
                            LEFT JOIN c_personas AS per ON per.id_Personas=enche.IdResponsableVbo
                            LEFT JOIN c_actividad a ON a.IdActividad=en.idActividad
                            LEFT JOIN c_eje ej ON ej.idEje=a.IdEje
                            LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                            WHERE enche.IdEntregableCheckList = " . $this->Id_entregablecheck;

        $result = $catalogo->obtenerLista($consultaIntervalo);
        while ($row = mysqli_fetch_array($result)) {
            $this->entregable = $row['IdEntregable'];
            $this->checklist = $row['IdCheckList'];
            $this->responsable = $row['IdResponsableVbo'];
            $this->anio = $row['Periodo'];
            $this->eje = $row['Eje'];
            $this->tipoactividad = $row['TipoActividad'];
        }
        /*$consultasubactividad = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=".$this->categoria." ORDER BY ce.orden";
        $result1 = $catalogo->obtenerLista($consultasubactividad);
        echo $consultasubactividad;
        while ($row = mysqli_fetch_array($result1)) {
            $this->subcategoria = $row['idCategoria'];
        }*/
        $consultaIntervalo = "SELECT act1.IdActividad AS act1,act1.IdNivelActividad as n1,act1.Nombre, act2.IdActividad AS act2,act2.IdNivelActividad as n2,act2.Nombre,
        act3.IdActividad AS act3,act3.IdNivelActividad as n3,act3.Nombre,act4.IdActividad AS act4,act4.IdNivelActividad as n4,act4.Nombre
        FROM c_actividad act1
        LEFT JOIN c_actividad act2 ON act1.IdActividadSuperior = act2.IdActividad
        LEFT JOIN c_actividad act3 ON act2.IdActividadSuperior = act3.IdActividad
        LEFT JOIN c_actividad act4 ON act3.IdActividadSuperior = act4.IdActividad
        LEFT JOIN c_entregable ent ON act1.IdActividad = ent.idActividad
        WHERE ent.IdEntregable = " . $this->entregable;
        $result = $catalogo->obtenerLista($consultaIntervalo);
        while ($row = mysqli_fetch_array($result)) {
            if($row['n1'] == 1){
            $this->global = $row['act1'];
            $this->general = "";
            $this->particular = "";
            $this->subactividad = "";
        }if($row['n1'] == 2){
            $this->global = $row['act2'];
            $this->general = $row['act1'];
            $this->particular = "";
            $this->subactividad = "";
        }if($row['n1'] == 3){
            $this->global = $row['act3'];
            $this->general = $row['act2'];
            $this->particular = $row['act1'];
            $this->subactividad = "";
        }if($row['n1'] == 4){
            $this->global = $row['act4'];
            $this->general = $row['act3'];
            $this->particular = $row['act2'];
            $this->subactividad = $row['act1'];
        }
        }
        if ($this->global != "") {
        $categoria= "";
        $consultaactividad1 = "SELECT *
        FROM c_actividad a 
        WHERE a.IdActividad=".$this->global." ORDER BY a.Orden";
        //echo $consultaactividad1;
        $result1 = $catalogo->obtenerLista($consultaactividad1);
        while ($row3 = mysqli_fetch_array($result1)) {
            $this->eje = $row3['IdEje'];
            $this->tipoactividad = $row3['IdTipoActividad'];
            $categoria = $row3['Idcategoria'];
        }
        if ($categoria != "") {
            $consultaactividadglobal = "SELECT ce.idCategoriaPadre AS categoria,ce.idCategoria AS subcategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE ce.nivelCategoria=2 AND p.Id_Periodo=".$this->anio." AND ce.idEje=".$this->eje." AND ce.idCategoria=".$categoria." ORDER BY ce.Orden";
        $result1 = $catalogo->obtenerLista($consultaactividadglobal);
        //echo $consultaactividadglobal;
        while ($row4 = mysqli_fetch_array($result1)) {
            $this->categoria = $row4['categoria'];
            $this->subcategoria = $row4['subcategoria'];
        }
        return true;
        return false;
        }else{

        }
        }else{

        }
    }


    public function Nuevo_entregablecheck() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_entregableCheckList(IdEntregable,IdCheckList,IdResponsableVbo)
            VALUES($this->entregable,$this->checklist,$this->responsable);";
        $this->Id_entregablecheck = $catalogo->insertarRegistro($insert);
        
        if ($this->Id_entregablecheck == 0 || $this->Id_entregablecheck == null) {
            return false;
        }
        return true;
    }

    public function Editar_entregablecheck() {
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_entregableCheckList SET IdEntregable=". $this->entregable .",IdCheckList=". $this->checklist .",IdResponsableVbo=". $this->responsable ." WHERE IdEntregableCheckList = $this->Id_entregablecheck;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_entregableCheckList', 'IdEntregableCheckList = ' . $this->Id_entregablecheck);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminar_entregablecheck() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_entregableCheckList WHERE IdEntregableCheckList = $this->Id_entregablecheck;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_entregableCheckList", "IdEntregableCheckList = " . $this->Id_entregablecheck);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

     function getId_entregablecheck() {
        return $this->Id_entregablecheck;
    }

    function getentregable() {
        return $this->entregable;
    }

    function getchecklist() {
        return $this->checklist;
    }

    function getresponsable() {
        return $this->responsable;
    }

    function getanio() {
        return $this->anio;
    }

    function geteje() {
        return $this->eje;
    }

    function gettipoactividad() {
        return $this->tipoactividad;
    }

    function getglobal() {
        return $this->global;
    }

    function getgeneral() {
        return $this->general;
    }

    function getparticular() {
        return $this->particular;
    }

    function getsubactividad() {
        return $this->subactividad;
    }

    function getcategoria() {
        return $this->categoria;
    }

    function getsubcategoria() {
        return $this->subcategoria;
    }

    function setId_entregablecheck($Id_entregablecheck) {
        $this->Id_entregablecheck = $Id_entregablecheck;
    }

    function setentregable($entregable) {
        $this->entregable = $entregable;
    }

    function setchecklist($checklist) {
        $this->checklist = $checklist;
    }

    function setresponsable($responsable) {
        $this->responsable = $responsable;
    }
}
