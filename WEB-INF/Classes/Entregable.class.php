<?php

include_once("Catalogo.class.php");
//include_once("Conexion.class.php");
class Entregable{

    private $IdEntregable;
    private $IdProyecto;
    private $IdConcepto;
    private $Nombre;
    private $Descripcion;
    private $FechaInicio;
    private $FechaFinEstimada;
    private $IdEstatus;
    private $IdPeriodo;
    private $FechaInicioReal;
    private $FechaFinReal;
    private $usuarioCreacion;
    private $usuarioModificacion;
    private $pantalla;
    private $IdActividad;

    private $IdInsumo;
    private $IdEntregableInsumo;

    private $IdCheckList;
    private $Vbo;
    private $NombreChk;
    private $desChk;

    public function obtenerEntregableVobo($IdActividad){
        $consulta = ("SELECT
                        kea.IdActividad,
                        kea.IdEntregable,
                        ce.Nombre AS entregable,
                      cesp.IdEntregEspecifico,
                      cesp.Descripcion AS entregableEsp,
                      cck.Nombre AS checkNombre,
                      kech.Valor,
                      kech.IdCheckList,
                      cck.Descripcion AS checkDesc
                    FROM
                        `k_entregableActividad` AS kea
                    INNER JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                    INNER JOIN c_entregableEspecifico AS cesp ON cesp.IdEntregable = ce.IdEntregable
                    INNER JOIN k_entregableEspecifCheckList AS kech ON  kech.IdEntregEspecif= cesp.IdEntregEspecifico
                    INNER JOIN c_checkList AS cck ON cck.IdCheckList = kech.IdCheckList
                    WHERE kea.IdActividad = ".$IdActividad.";");
        //echo $consulta;
                $catalogo = new Catalogo();
                $query = $catalogo->obtenerLista($consulta);
                while ($rs = mysqli_fetch_array($query)) {
                    //$this->IdEntregable = $rs[''];
                    $this->IdEntregable = $rs['IdEntregEspecifico'];
                    $this->Nombre = $rs['entregableEsp'];
                    $this->IdCheckList = $rs['IdCheckList'];
                    $this->Vbo = $rs['Valor'];
                    $this->NombreChk = $rs['checkNombre'];
                    $this->desChk = $rs['checkDesc'];

                }
    }
    public function obtenerEntregableVobos($IdActividad){
        $consulta = ("SELECT kea.IdActividad,kea.IdEntregable,ce.Nombre AS entregable,kech.IdCheckList,kech.Vbo,
                    cchk.Nombre AS mombreChk,cchk.Descripcion AS desChk
                FROM
                    `k_entregableActividad` AS kea
                INNER JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                INNER JOIN k_entregableEspecifCheckList AS kech ON kech.IdEntregable = ce.IdEntregable
                INNER JOIN c_checkList AS cchk ON cchk.IdCheckList = kech.IdCheckList
                WHERE kea.IdActividad = ".$IdActividad.";");
        //echo $consulta;
                $catalogo = new Catalogo();
                $query = $catalogo->obtenerLista($consulta);
                /*while ($rs = mysqli_fetch_array($query)) {
                  
                    $this->IdEntregable = $rs['IdEntregable'];
                    $this->Nombre = $rs['entregable'];
                    $this->IdCheckList = $rs['IdCheckList'];
                    $this->Vbo = $rs['Vbo'];
                    $this->NombreChk = $rs['mombreChk'];
                    $this->desChk = $rs['desChk'];

                }*/
                return $query;
    }
    public function getEntregableByActividad($IdActividad) {
        $consulta = ("SELECT kea.IdActividad,kea.IdEntregable,ce.Nombre AS entregable, ca.Periodo FROM
                        `k_entregableActividad` AS kea
                    INNER JOIN c_actividad AS ca ON ca.IdActividad = kea.IdActividad
                    INNER JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                    WHERE kea.IdActividad=".$IdActividad.";");
        //echo $consulta;
        $catalogo = new Catalogo();
        $query = $catalogo->obtenerLista($consulta);
        while ($rs = mysqli_fetch_array($query)) {
            //$this->IdEntregable = $rs[''];
            $this->IdEntregable = $rs['IdEntregable'];
            $this->Nombre = $rs['entregable'];
            //$this->IdPeriodo = $rs['IdPeriodo'];

        }
        return $query;
    }

    public function getEntregablesByActividad($IdActividad) {
        $consulta = ("SELECT kea.IdActividad,kea.IdEntregable,ce.Nombre AS entregable FROM
                        `k_entregableActividad` AS kea
                    INNER JOIN c_actividad AS ca ON ca.IdActividad = kea.IdActividad
                    INNER JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                    WHERE kea.IdActividad=".$IdActividad.";");
        //echo $consulta;
        $catalogo = new Catalogo();
        $query = $catalogo->obtenerLista($consulta);
        /*while ($rs = mysqli_fetch_array($query)) {
          
            $this->IdEntregable = $rs['IdEntregable'];
            $this->Nombre = $rs['entregable'];

        }*/
        return $query;
    }
    public function getCheckListByEntregable($IdActividad) {
        $consulta = ("SELECT kea.IdActividad,kea.IdEntregable,ce.Nombre AS entregable FROM
                        `k_entregableActividad` AS kea
                    INNER JOIN c_actividad AS ca ON ca.IdActividad = kea.IdActividad
                    INNER JOIN c_entregable AS ce ON ce.IdEntregable = kea.IdEntregable
                    WHERE kea.IdActividad=".$IdActividad.";");
        //echo $consulta;
        $catalogo = new Catalogo();
        $query = $catalogo->obtenerLista($consulta);
        /*while ($rs = mysqli_fetch_array($query)) {
          
            $this->IdEntregable = $rs['IdEntregable'];
            $this->Nombre = $rs['entregable'];

        }*/
        return $query;
    }

    public function getEntregableById($id) {
        $consulta = ("SELECT * FROM c_entregableprocesos WHERE IdEntregable='" . $id . "'");
        $catalogo = new Catalogo();
        $query = $catalogo->obtenerLista($consulta);
        if ($rs = mysqli_fetch_array($query)) {
            //$this->IdEntregable = $rs[''];
            $this->IdProyecto = $rs['IdProyecto'];
            $this->IdConcepto = $rs['IdConcepto'];
            $this->Nombre = $rs['Nombre'];
            $this->Descripcion = $rs['Descripcion'];
            $this->FechaInicio= $rs['FechaInicio'];
            $this->FechaFinEstimada=$rs['FechaFinEstimada'];
            $this->IdEstatus = $rs['IdEstatus'];
            $this->IdPeriodo = $rs['IdPeriodo'];
            $this->FechaInicioReal = $rs['FechaInicioReal'];
            $this->FechaFinReal = $rs['FechaFinReal'];
        }
        return $query;
    }


     public function agregarEntregable() {
        if(!isset($this->IdProyecto) || $this->IdProyecto == null){
            $this->IdProyecto = "NULL";
        }
        if(!isset($this->IdConcepto) || $this->IdConcepto == null){
            $this->IdConcepto = "NULL";
        }
        if(!isset($this->IdEstatus) || $this->IdEstatus == null){
            $this->IdEstatus = NULL;
        }
        if(!isset($this->FechaInicio) || $this->FechaInicio == null){
            $this->FechaInicio = "NULL";
        }
         if(!isset($this->FechaFinEstimada) || $this->FechaFinEstimada == null){
            $this->FechaFinEstimada = "NULL";
        }
        if(!isset($this->FechaInicioReal) || $this->FechaInicioReal == null){
            $this->FechaInicioReal = "NULL";
        }
        if(!isset($this->FechaFinReal) || $this->FechaFinReal == null){
            $this->FechaFinReal = "NULL";
        }
        if(!isset($this->IdPeriodo) || $this->IdPeriodo == null){
            $this->IdPeriodo = "NULL";
        }
        $consulta = ("INSERT INTO c_entregable(Nombre,Descripcion,FechaInicio,FechaFinEstimada,FechaInicioReal,FechaFinReal,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla)
            VALUES('".$this->Nombre."','" . $this->Descripcion . "',".$this->FechaInicio.",".$this->FechaFinEstimada.",".$this->FechaInicioReal.",".$this->FechaFinReal.",'" . $this->usuarioCreacion . "',
                now(),'" . $this->usuarioModificacion . "',now(),'" . $this->pantalla . "');");
        //echo "<br><br>$consulta<br><br>";
        $catalogo = new Catalogo();
        $this->IdEntregable = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregable != NULL && $this->IdEntregable != 0) {
            return true;
        }
        return false;
    }
    public function agregarActividadEntregable(){
        $consulta = "INSERT INTO k_entregableActividad(IdActividad,IdEntregable) VALUES (".$this->IdActividad.",".$this->IdEntregable.")";
        $catalogo = new Catalogo();
        //echo "<br><br>".$consulta."<br><br>";
        $kDetalle = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregable != NULL && $this->IdEntregable != 0) {
            return true;
        }
        return false;

    }

    public function agregarInsumoEntregable(){
        $consulta = "INSERT INTO k_entregableinsumo(IdEntregable,IdInsumo) VALUES (".$this->IdEntregable.",".$this->IdInsumo.")";
        $catalogo = new Catalogo();
        //echo "<br><br>".$consulta."<br><br>";
        $this->IdEntregableInsumo = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregableInsumo != NULL && $this->IdEntregableInsumo != 0) {
            return true;
        }
        return false;

    }

    public function editarEntregable() {
         if(!isset($this->IdProyecto) || $this->IdProyecto == null){
            $this->IdProyecto = "NULL";
        }
        if(!isset($this->IdConcepto) || $this->IdConcepto == null){
            $this->IdConcepto = "NULL";
        }
        if(!isset($this->IdEstatus) || $this->IdEstatus == null){
            $this->IdEstatus = NULL;
        }
        if(!isset($this->FechaInicio) || $this->FechaInicio == null){
            $this->FechaInicio = "0000-00-00";
        }
         if(!isset($this->FechaFinEstimada) || $this->FechaFinEstimada == null){
            $this->FechaFinEstimada = "0000-00-00";
        }
        if(!isset($this->IdPeriodo) || $this->IdPeriodo == null){
            $this->IdPeriodo = NULL;
        }
        if(!isset($this->FechaInicioReal) || $this->FechaInicioReal == null){
            $this->FechaInicioReal = "0000-00-00";
        }
         if(!isset($this->FechaFinReal) || $this->FechaFinReal == null){
            $this->FechaFinReal = "0000-00-00";
        }
        $tabla = "c_entregable";
        $where = "IdEntregable=" . $this->IdEntregable;
        $consulta = ("UPDATE $tabla SET Nombre='".$this->Nombre."',UsuarioUltimaModificacion = '" . $this->usuarioModificacion . "',FechaUltimaModificacion = now(),Pantalla = '" . $this->pantalla . "' "
            ." WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }
    function eliminarEntregable() {
        $catalogo = new Catalogo();

        $tabla = "c_entregable";
        $where = "IdEntregable = " . $this->IdEntregable;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function eliminarEntregableActividad(){
        $catalogo = new Catalogo();

        $tabla = "k_entregableActividad";
        $where = "IdEntregable = " . $this->IdEntregable." AND IdActividad = ".$this->IdActividad;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;

    }
    function eliminarEntregableDetalleInsumo(){
        $catalogo = new Catalogo();

        $tabla = "k_entregableinsumo";
        $where = "IdEntregableInsumo = " .  $this->IdEntregableInsumo;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function eliminarEntregableInsumo(){
         $catalogo = new Catalogo();

        $tabla = "c_entregable";
        $where = "IdEntregable =".$this->IdInsumo;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function eliminarAcciones(){
         $catalogo = new Catalogo();

        $tabla = "k_entregableaccionprocesos";
        $where = "IdEntregable=" . $this->IdEntregable;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function eliminarCaracteristicas(){
         $catalogo = new Catalogo();

        $tabla = "k_entregablecaracteristicasprocesos";
        $where = "IdEntregable = " . $this->IdEntregable;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function actualizarVbo(){

        /*if (!isset($this->Vbo) || $this->Vbo == NULL){
            $this->Vbo = "NULL";
        }*/
        $insert ="UPDATE k_entregableEspecifCheckList SET Valor = ".$this->Vbo." WHERE IdEntregEspecif = ".$this->IdEntregable." AND IdCheckList = ".$this->IdCheckList.";";

        //echo "<br>".$insert."<br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($insert, 'k_entregableEspecifCheckList', ' IdEntregable = '.$this->IdEntregable.' AND IdCheckList = '.$this->IdCheckList);

        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function getVbo()
    {
        return $this->Vbo;
    }

    public function setVbo($Vbo)
    {
        $this->Vbo = $Vbo;

    }

    public function getIdCheckList()
    {
        return $this->IdCheckList;
    }

    public function setIdCheckList($IdCheckList)
    {
        $this->IdCheckList = $IdCheckList;

    }

    public function getNombreChk()
    {
        return $this->NombreChk;
    }

    public function setNombreChk($NombreChk)
    {
        $this->NombreChk = $NombreChk;

    }

    public function getDesChk()
    {
        return $this->desChk;
    }

    public function setDesChk($desChk)
    {
        $this->desChk = $desChk;

    }
    public function getIdInsumo(){
        return $this->IdInsumo;
    }

    public function setIdInsumo($IdInsumo){
        $this->IdInsumo = $IdInsumo;
    }

    public function getIdEntregableInsumo(){
        return $this->IdEntregableInsumo;
    }

    public function setIdEntregableInsumo($IdEntregableInsumo){
        $this->IdEntregableInsumo = $IdEntregableInsumo;
    }

    public function getIdEntregable() {
        return $this->IdEntregable;
    }

    public function getIdProyecto() {
        return $this->IdProyecto;
    }

    public function getIdConcepto() {
        return $this->IdConcepto;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getFechaInicio() {
        return $this->FechaInicio;
    }

    public function getFechaFinEstimada() {
        return $this->FechaFinEstimada;
    }

    public function getIdEstatus() {
        return $this->IdEstatus;
    }

    public function getUsuarioCreacion() {
        return $this->usuarioCreacion;
    }

    public function getUsuarioModificacion() {
        return $this->usuarioModificacion;
    }

    public function getPantalla() {
        return $this->pantalla;
    }

    public function setIdEntregable($IdEntregable) {
        $this->IdEntregable = $IdEntregable;
    }

    public function setIdProyecto($IdProyecto) {
        $this->IdProyecto = $IdProyecto;
    }

    public function setIdConcepto($IdConcepto) {
        $this->IdConcepto = $IdConcepto;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setFechaInicio($FechaInicio) {
        $this->FechaInicio = $FechaInicio;
    }

    public function setFechaFinEstimada($FechaFinEstimada) {
        $this->FechaFinEstimada = $FechaFinEstimada;
    }

    public function setIdEstatus($IdEstatus) {
        $this->IdEstatus = $IdEstatus;
    }

    public function setUsuarioCreacion($usuarioCreacion) {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    public function setUsuarioModificacion($usuarioModificacion) {
        $this->usuarioModificacion = $usuarioModificacion;
    }

    public function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
    }

    public function setIdPeriodo($IdPeriodo){
        $this->IdPeriodo= $IdPeriodo;
    }

    public function getIdPeriodo(){
        return $this->IdPeriodo;
    }

    public function setFechaInicioReal($param){
        $this->FechaInicioReal=$param;
    }

    public function getFechaInicioReal(){
        return $this->FechaInicioReal;
    }

    public function setFechaFinReal($param){
        $this->FechaFinReal=$param;
    }

    public function getFechaFinReal(){
        return $this->FechaFinReal;
    }

    public function getIdActividad(){
        return $this->IdActividad;
    }
    public function setIdActividad($IdActividad){
        $this->IdActividad = $IdActividad;
    }
}

