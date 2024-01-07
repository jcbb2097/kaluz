<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Check {

    private $Id_check;
    private $nombre;
    private $descripcion;
    private $nivel;
    private $padre;
    private $anio;
    private $eje;
    private $tipoactividad;
    private $global;
    private $general;
    private $categoria;
    private $subcategoria;
    private $nivelactividad;
    private $tiene;//tiene subchecklist
    private $orden;
    private $entregable;
    private $responsable;

    public function getcheck() {
        $actividad = "";
        $catalogo = new Catalogo();
        $consultaIntervalo = "SELECT * FROM c_checkList AS ch
        WHERE ch.IdCheckList = " . $this->Id_check;
        $result = $catalogo->obtenerLista($consultaIntervalo);
        while ($row = mysqli_fetch_array($result)) {
            $this->nombre = $row['Nombre'];
            $this->descripcion = $row['Descripcion'];
            $this->nivel = $row['Nivel'];
            $this->padre = $row['IdCheckListPadre'];
            $this->tiene = $row['Tipo'];
            $this->responsable = $row['IdResponsable'];
        } 
        $actividadsuperior = "";
        $consultakchecklist= "SELECT *,a.Orden AS Orden FROM k_checklist_actividad as a 
        JOIN c_actividad ac ON ac.IdActividad=a.IdActividad
        WHERE a.IdCheckList=".$this->Id_check;
        $resultk = $catalogo->obtenerLista($consultakchecklist);
        while ($rowk = mysqli_fetch_array($resultk)) {
            $this->anio = $rowk['Id_Periodo'];
            $this->orden = $rowk['Orden'];
            $this->entregable = $rowk['Entregable'];
            $actividad = $rowk['IdActividad'];
            $actividadsuperior = $rowk['IdActividadSuperior'];
        }
        if ($actividadsuperior != "") {
        $actividadsuperior = "";
        $categoria= "";
        $consultaactividad1 = "SELECT *
        FROM c_actividad a 
        WHERE a.IdActividad=".$actividad ." ORDER BY a.Orden";
        $result1 = $catalogo->obtenerLista($consultaactividad1);
        while ($row3 = mysqli_fetch_array($result1)) {
            $this->general = $row3['IdActividad'];
            $this->eje = $row3['IdEje'];
            $this->tipoactividad = $row3['IdTipoActividad'];
            $this->global = $row3['IdActividadSuperior'];
            $categoria = $row3['Idcategoria'];
        }
        $categoriarecuperada="";
        $consultaactividadglobal = "SELECT ce.idCategoriaPadre AS categoria,ce.idCategoria AS subcategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE p.Id_Periodo=".$this->anio." AND ce.idEje=".$this->eje." AND ce.idCategoria=".$categoria." ORDER BY ce.Orden";

        $result1 = $catalogo->obtenerLista($consultaactividadglobal);
        while ($row4 = mysqli_fetch_array($result1)) {
            $categoriarecuperada = $row4['categoria'];
            if ($categoriarecuperada == "") {
            $this->categoria = $row4['subcategoria'];
            $this->subcategoria = $row4['categoria'];
        }else{
            $this->categoria = $row4['categoria'];
            $this->subcategoria = $row4['subcategoria'];
        }
        }
        return true;
        return false;
        }else{
        $categoria= "";
        $consultaactividad1 = "SELECT *
        FROM c_actividad a 
        WHERE a.IdActividad=".$actividad." ORDER BY a.Orden";
        $result1 = $catalogo->obtenerLista($consultaactividad1);
        while ($row3 = mysqli_fetch_array($result1)) {
            $this->global = $row3['IdActividad'];
            $this->eje = $row3['IdEje'];
            $this->tipoactividad = $row3['IdTipoActividad'];
            $categoria = $row3['Idcategoria'];
        }
        $categoriarecuperada="";
        $consultaactividadglobal = "SELECT ce.idCategoriaPadre AS categoria,ce.idCategoria AS subcategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE p.Id_Periodo=".$this->anio." AND ce.idEje=".$this->eje." AND ce.idCategoria=".$categoria." ORDER BY ce.Orden";
        $result1 = $catalogo->obtenerLista($consultaactividadglobal);
        while ($row4 = mysqli_fetch_array($result1)) {
            $categoriarecuperada = $row4['categoria'];
            if ($categoriarecuperada == "") {
            $this->categoria = $row4['subcategoria'];
            $this->subcategoria = $row4['categoria'];
        }else{
            $this->categoria = $row4['categoria'];
            $this->subcategoria = $row4['subcategoria'];
        }
        }
        }   
    }

    public function Nuevo_check() {

        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_checkList(Nombre,Descripcion,Nivel,IdCheckListPadre,Tipo,IdResponsable)
            VALUES('$this->nombre','$this->descripcion',$this->nivel,$this->padre,$this->tiene,$this->responsable);";
        $this->Id_check = $catalogo->insertarRegistro($insert);
        
        if ($this->Id_check == 0 || $this->Id_check == null) {
            return false;
        }
        return true;
    }

    public function Nuevo_kcheck() {
        $Id_checkultimo = "";
        $catalogo = new Catalogo();
        $consultaultimoregistro = "SELECT MAX(IdCheckList) AS id FROM c_checkList";
        $result = $catalogo->obtenerLista($consultaultimoregistro);
        while ($row = mysqli_fetch_array($result)) {
        $Id_checkultimo = $row['id'];
        }

        if ($this->general != "NULL") {
            $this->global = $this->general;
        }

        $insert = "INSERT INTO k_checklist_actividad(IdCheckList,IdActividad,Id_Periodo,Orden,Entregable)
            VALUES($Id_checkultimo,$this->global,$this->anio,$this->orden,'$this->entregable');";
        $this->Id_check = $catalogo->insertarRegistro($insert);
        //echo $insert;
        if ($this->Id_check == 0 || $this->Id_check == null) {
            return false;
        }
        return true;
    }

    public function Editar_check() {
        //validar si es nivel 1 es tipo 2 para verse en app de planeación
        //validar si es nivel 2 es tipo 1 para subcheck y verse en app de planeación
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_checkList SET Nombre ='" . $this->nombre . "', Descripcion ='" . $this->descripcion . "',Nivel=". $this->nivel .",IdCheckListPadre=". $this->padre .",Tipo=".$this->tiene.",IdResponsable=".$this->responsable." WHERE IdCheckList = $this->Id_check;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_checkList', 'IdCheckList = ' . $this->Id_check);
        //echo "<br><br>$consulta<br><br>";
        
        if ($this->general != "NULL") {
            $this->global = $this->general;
        }
        
        $consulta1 = "UPDATE k_checklist_actividad SET IdActividad =" . $this->global . ",Id_Periodo=". $this->anio .",Orden=". $this->orden .",Entregable='". $this->entregable ."' WHERE IdCheckList = $this->Id_check;";
        $query1 = $catalogo->ejecutaConsultaActualizacion($consulta1, 'k_checklist_actividad', 'IdCheckList = ' . $this->Id_check);
        //echo $consulta1;

        
        //echo "<br><br>$consulta1<br><br>";
        if ($query == 1 && $query1 == 1) {
            return true;
        }
        return false;
    }   

    public function Eliminar_check() {
        $catalogo = new Catalogo();
        $subchecknumero = "";
        $consultavalidasubcheck = "SELECT COUNT(*) AS subcheck FROM c_checkList WHERE IdCheckListPadre= " . $this->Id_check;
        $result = $catalogo->obtenerLista($consultavalidasubcheck);
        while ($row = mysqli_fetch_array($result)) {
            $subchecknumero = $row['subcheck'];
        }

        if ($subchecknumero == 0) {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_checklist_actividad WHERE IdCheckList = $this->Id_check;";
        //echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_checklist_actividad", "IdCheckList = " . $this->Id_check);

        $consulta1 = "DELETE FROM c_checkList WHERE IdCheckList = $this->Id_check;";
        //echo $consulta1;
        $query1 = $catalogo->ejecutaConsultaActualizacion($consulta1, "c_checkList", "IdCheckList = " . $this->Id_check);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1 && $query1 == 1) {
            return true;
        }
        }else{
            return false;
        }
        /*$catalogo = new Catalogo();
        $consulta = "DELETE FROM k_checklist_actividad WHERE IdCheckList = $this->Id_check;";
        echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_checklist_actividad", "IdCheckList = " . $this->Id_check);

        $consulta1 = "DELETE FROM c_checkList WHERE IdCheckList = $this->Id_check;";
        //echo $consulta1;
        $query1 = $catalogo->ejecutaConsultaActualizacion($consulta1, "c_checkList", "IdCheckList = " . $this->Id_check);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1 && $query1 == 1) {
            return true;
        }
        return false;*/
    }         


    public function Eliminar_subcheck() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_checklist_actividad WHERE IdCheckList = $this->Id_check;";
        //echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_checklist_actividad", "IdCheckList = " . $this->Id_check);

        $consulta1 = "DELETE FROM c_checkList WHERE IdCheckList = $this->Id_check;";
        //echo $consulta1;
        $query1 = $catalogo->ejecutaConsultaActualizacion($consulta1, "c_checkList", "IdCheckList = " . $this->Id_check);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1 && $query1 == 1) {
            return true;
        }
        return false;
    }        




     function getId_check() {
        return $this->Id_check;
    }

    function getnombre() {
        return $this->nombre;
    }

    function getdescripcion() {
        return $this->descripcion;
    }

    function getnivel() {
        return $this->nivel;
    }

    function getpadre() {
        return $this->padre;
    }

    function getanio() {
        return $this->anio;
    }

    function getgeneral() {
        return $this->general;
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

    function getcategoria() {
        return $this->categoria;
    }

    function getsubcategoria() {
        return $this->subcategoria;
    }

    function getnivelactividad() {
        return $this->nivelactividad;
    }

    function gettiene() {
        return $this->tiene;
    }

    function getorden() {
        return $this->orden;
    }

    function getentregable() {
        return $this->entregable;
    }

    function getresponsable() {
        return $this->responsable;
    }

    function setId_check($Id_check) {
        $this->Id_check = $Id_check;
    }

    function setnombre($nombre) {
        $this->nombre = $nombre;
    }

    function setdescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setnivel($nivel) {
        $this->nivel = $nivel;
    }

    function setpadre($padre) {
        $this->padre = $padre;
    }

    function setanio($anio) {
        $this->anio = $anio;
    }

    function setgeneral($general) {
        $this->general = $general;
    }

    function setglobal($global) {
        $this->global = $global;
    }

    function setcategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setsubcategoria($subcategoria) {
        $this->subcategoria = $subcategoria;
    }

    function settiene($tiene) {
        $this->tiene = $tiene;
    }

    function setorden($orden) {
        $this->orden = $orden;
    }

    function setentregable($entregable) {
        $this->entregable = $entregable;
    }

    function setresponsable($responsable) {
        $this->responsable = $responsable;
    }
}
