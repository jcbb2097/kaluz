<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Conexion.class.php");
//include_once("Catalogo.class.php");
/**
 * Description of Activo Fijo
 *
 * @author CBC 20190303
 */
class ActividadesMetas {

    private $IdActividad;
    private $Nombre;
    //private $Anio;
    private $Periodo;
    private $IdArea;
    private $IdEje;
    private $IdResponsable;
    private $IdTipoActividad;
    private $IdNivelActividad;
    private $IdActividadSuperior;
    private $Fecha;
    private $Orden;
    private $usuarioCreacion;
    private $usuarioUltimaModificacion;
    private $pantalla;
    private $Idcategoria;
    private $Idscategoria;

    private $IdActividadGlobal;
    private $IdActividadGeneral;
    private $IdActividadParticular;

    private $NombreGlobal;
    private $NombreGeneral;
    private $NombreParticular;

    public function obtenerASupGeneral(){
         $catalogo = new Catalogo();
            $consulta = "SELECT
            cc.IdActividad AS IdActividadGen,
            ccDos.IdActividad IdActividadGlob,
            CONCAT(cp.orden,'.',ccDos.Orden,'. ',ccDos.Nombre)AS AGlobal,
            CONCAT(cp.orden,'.',ccDos.Orden,'.',cc.Orden,'. ',cc.Nombre) AS AGeneral
        FROM
            `c_actividad` AS cc
        INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
        LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
        WHERE cc.IdActividad=" . $this->IdActividad;

        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($result)) {

            $this->IdActividadGlobal = $row['IdActividadGlob'];
            $this->NombreGlobal = $row['AGlobal'];

        }
    }
    public function obtenerASupParticular(){
         $catalogo = new Catalogo();
        $consulta ="SELECT
                cc.IdActividad AS IdActividadPar,
                ccDos.IdActividad AS IdActividadGen,
                ccTres.IdActividad AS IdAGlob,
                CONCAT(cp.orden,'.',ccTres.Orden,'. ',ccTres.Nombre)AS AGlobal,
                CONCAT(cp.orden,'.',ccTres.Orden,'.',ccDos.Orden,'. ',ccDos.Nombre) AS AGeneral,
                CONCAT(cp.orden,'.',ccTres.Orden,'.',ccDos.Orden,'. ',cc.Nombre) AS AParticular
            FROM
                `c_actividad` AS cc
            INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
            LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
            LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
            WHERE cc.IdActividad=". $this->IdActividad;

            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

                $this->IdActividadGeneral = $row['IdActividadGen'];
                $this->IdActividadGlobal = $row['IdAGlob'];
                $this->NombreGlobal = $row['AGlobal'];
                $this->NombreGeneral = $row['AGeneral'];
            }
    }
    public function obtenerASupSub(){
         $catalogo = new Catalogo();
        $consulta = "SELECT
                cc.IdActividad AS IdActividadSub,
                ccDos.IdActividad AS IdActividadPar,
                ccTres.IdActividad AS IdActividadGen,
                ccCuatro.IdActividad AS IdActividadGlob,
                CONCAT(cp.orden,'.',ccCuatro.Orden,'. ',ccCuatro.Nombre)AS AGlobal,
                CONCAT(cp.orden,'.',ccCuatro.Orden,'.',ccTres.Orden,'. ',ccTres.Nombre) AS AGeneral,
                CONCAT(cp.orden,'.',ccCuatro.Orden,'.',ccTres.Orden,'. ',ccDos.Nombre) AS AParticular,
                CONCAT(cp.orden,'.',ccCuatro.Orden,'.',ccTres.Orden,'.',ccDos.Orden,'.',cc.Orden,'. ',cc.Nombre) AS ASub
                FROM
                `c_actividad` AS cc
                INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
                LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
                LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
                LEFT JOIN c_actividad AS ccCuatro ON ccCuatro.IdActividad = ccTres.IdActividadSuperior
                WHERE cc.IdActividad=".$this->IdActividad;

                $result = $catalogo->obtenerLista($consulta);
                while ($row = mysqli_fetch_array($result)) {

                    $this->IdActividadParticular =$row['IdActividadPar'];
                    $this->IdActividadGeneral = $row['IdActividadGen'];
                    $this->IdActividadGlobal = $row['IdActividadGlob'];

                    $this->NombreGlobal =$row['AGlobal'];
                    $this->NombreGeneral = $row['AGeneral'];
                    $this->NombreParticular = $row['AParticular'];

                }

    }

    public function obtenerActividadMeta() {
        $catalogo = new Catalogo();
        $consulta = "SELECT
                        Nombre,
                        Periodo,
                        IdArea,
                        IdEje,
                        IdResponsable,
                        IdTipoActividad,
                        IdNivelActividad,
                        IdActividadSuperior,
                        Orden,
                        Numeracion,
                        Idcategoria,
                        Idscategoria
                    FROM
                        `c_actividad`
                    WHERE
                        IdActividad =  " . $this->IdActividad;
     //  echo $consultaactivofijo;
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($result)) {
            //$this->idactivofijo =$row['IdActivoFijo'];
            $this->Nombre = $row['Nombre'];
            $this->Periodo = $row['Periodo'];
            $this->IdArea = $row['IdArea'];
            $this->IdEje= $row['IdEje'];
            $this->IdResponsable = $row['IdResponsable'];
            $this->IdTipoActividad= $row['IdTipoActividad'];
            $this->IdActividadSuperior=$row['IdActividadSuperior'];
            $this->Orden = $row['Orden'];
            $this->IdNivelActividad = $row['IdNivelActividad'];
            $this->Numeracion = $row['Numeracion'];
            $this->Idscategoria = $row['Idcategoria'];
            $consultaobtenerejes= "SELECT ce1.idCategoria as idCategoria,ce1.descCategoria,ce.idCategoria as idsCategoria,ce.descCategoria FROM c_categoriasdeejes ce
            LEFT JOIN c_categoriasdeejes ce1 ON ce1.idCategoria=ce.idCategoriaPadre
            WHERE ce.idCategoria=$this->Idscategoria";
            $resultcategoria = $catalogo->obtenerLista($consultaobtenerejes);
            while ($row3 = mysqli_fetch_array($resultcategoria)) {
                 if($row3['idCategoria'] != ""){
            $this->Idcategoria = $row3['idCategoria'];
            $this->Idscategoria = $row3['idsCategoria'];
            }else{
            $this->Idcategoria = $row3['idsCategoria'];
            }
            }
            }
        //return false;
    }

    public function agregarActividadMeta(){

        if (!isset($this->Periodo) || $this->Periodo == NULL || $this->Periodo == ""){
            $this->Periodo = "NULL";
        }
        if (!isset($this->IdArea) || $this->IdArea == NULL){
            $this->IdArea = "NULL";
        }
        if (!isset($this->IdEje) || $this->IdEje == NULL){
            $this->IdEje = "NULL";
        }
        if (!isset($this->IdResponsable) || $this->IdResponsable == NULL){
            $this->IdResponsable = "NULL";
        }
        if (!isset($this->IdNivelActividad) || $this->IdNivelActividad == NULL){
            $this->IdNivelActividad = "NULL";
        }
        if (!isset($this->IdActividadSuperior) || $this->IdActividadSuperior == NULL){
            $this->IdActividadSuperior = "NULL";
        }
        if (!isset($this->IdTipoActividad) || $this->IdTipoActividad == NULL){
            $this->IdTipoActividad = "NULL";
        }
        if (!isset($this->Idscategoria) || $this->Idscategoria == NULL || $this->Idscategoria == ""){
            $this->Idscategoria = "NULL";
        }
        
        $catalogo = new Catalogo();
        $numeroperiodo = "";
        $consultaparaobteneraño = "SELECT Periodo from c_periodo where Id_Periodo=$this->Periodo";
        $result = $catalogo->obtenerLista($consultaparaobteneraño);
        while ($row = mysqli_fetch_array($result)) {
            $numeroperiodo = $row['Periodo'];
        }

        /*$Idsubcategoriaobtenida = "";
        $consultavalidaidcategoria="SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$this->Idcategoria";
        $result2 = $catalogo->obtenerLista($consultaparaobteneraño);
        while ($row2 = mysqli_fetch_array($result2)) {
            $Idsubcategoriaobtenida = $row2['ce.idCategoria'];
        }*/
        if($this->Idscategoria != "NULL"){
        $catalogo = new Catalogo();
        //echo $this->Idcategoria;
        //echo "subcategoria";
        $insert = "INSERT INTO c_actividad(Nombre,Anio,Periodo,IdArea,IdEje,IdResponsable,IdTipoActividad,IdNivelActividad,IdActividadSuperior,Fecha,Orden,FechaCreacion,UsuarioCreacion,FechaUltimaModificacion,UsuarioUltimaModificacion,Pantalla, Numeracion, Idcategoria)
            VALUES('" . $this->Nombre . "',$numeroperiodo," . $this->Periodo . "," . $this->IdArea. "," . $this->IdEje . "," . $this->IdResponsable . ",".$this->IdTipoActividad."," . $this->IdNivelActividad . "," . $this->IdActividadSuperior . ",NOW()," . $this->Orden . ",NOW(),'" . $this->usuarioCreacion . "',NOW(),'". $this->usuarioUltimaModificacion . "','".$this->pantalla."','".$this->Numeracion."',".$this->Idscategoria.");";
        }else{
        $catalogo = new Catalogo();
        //echo $this->Idcategoria;
        //echo "categoria";
        $insert = "INSERT INTO c_actividad(Nombre,Anio,Periodo,IdArea,IdEje,IdResponsable,IdTipoActividad,IdNivelActividad,IdActividadSuperior,Fecha,Orden,FechaCreacion,UsuarioCreacion,FechaUltimaModificacion,UsuarioUltimaModificacion,Pantalla, Numeracion, Idcategoria)
            VALUES('" . $this->Nombre . "',$numeroperiodo," . $this->Periodo . "," . $this->IdArea. "," . $this->IdEje . "," . $this->IdResponsable . ",".$this->IdTipoActividad."," . $this->IdNivelActividad . "," . $this->IdActividadSuperior . ",NOW()," . $this->Orden . ",NOW(),'" . $this->usuarioCreacion . "',NOW(),'". $this->usuarioUltimaModificacion . "','".$this->pantalla."','".$this->Numeracion."',".$this->Idcategoria.");";
        }

        //echo "<br><br>".$insert."<br><br>";
        $this->IdActividad = $catalogo->insertarRegistro($insert);
        //echo "<br><br>ID: ".$this->idactivofijo."<br><br>";
        //$this->idactivofijo = null;
        if ($this->IdActividad == 0 || $this->IdActividad == null) {
            return false;
        }
        return true;
    }
    public function editarActividadMeta() {

        if (!isset($this->Periodo) || $this->Periodo == NULL || $this->Periodo == ""){
            $this->Periodo = "NULL";
        }
        if (!isset($this->IdArea) || $this->IdArea == NULL){
            $this->IdArea = "NULL";
        }
        if (!isset($this->IdEje) || $this->IdEje == NULL){
            $this->IdEje = "NULL";
        }
        if (!isset($this->IdResponsable) || $this->IdResponsable == NULL){
            $this->IdResponsable = "NULL";
        }
        if (!isset($this->IdNivelActividad) || $this->IdNivelActividad == NULL){
            $this->IdNivelActividad = "NULL";
        }
        if (!isset($this->IdActividadSuperior) || $this->IdActividadSuperior == NULL){
            $this->IdActividadSuperior = "NULL";
        }
        if (!isset($this->IdTipoActividad) || $this->IdTipoActividad == NULL){
            $this->IdTipoActividad = "NULL";
        }
        if (!isset($this->Idscategoria) || $this->Idscategoria == NULL || $this->Idscategoria == ""){
            $this->Idscategoria = "NULL";
        }
        $catalogo = new Catalogo();
        $numeroperiodo = "";
        $consultaparaobteneraño = "SELECT Periodo from c_periodo where Id_Periodo=$this->Periodo";
        $result = $catalogo->obtenerLista($consultaparaobteneraño);
        while ($row = mysqli_fetch_array($result)) {
            $numeroperiodo = $row['Periodo'];
        }

        if($this->Idscategoria != "NULL"){
        $consulta = "UPDATE c_actividad SET Nombre='" . $this->Nombre . "',Anio='".$numeroperiodo."',Periodo=" . $this->Periodo . ",IdArea=" . $this->IdArea . ",IdEje=" . $this->IdEje . ",IdResponsable=" . $this->IdResponsable . ",IdNivelActividad=" . $this->IdNivelActividad . ",IdActividadSuperior=" . $this->IdActividadSuperior . ",Orden=" . $this->Orden . ",FechaUltimaModificacion=NOW(),UsuarioUltimaModificacion='" . $this->usuarioUltimaModificacion . "',Pantalla ='".$this->pantalla."',Numeracion ='".$this->Numeracion."',Idcategoria =".$this->Idscategoria.",IdTipoActividad =".$this->IdTipoActividad." WHERE IdActividad ='". $this->IdActividad."';";

        }else{
            $consulta = "UPDATE c_actividad SET Nombre='" . $this->Nombre . "',Anio='".$numeroperiodo."',Periodo=" . $this->Periodo . ",IdArea=" . $this->IdArea . ",IdEje=" . $this->IdEje . ",IdResponsable=" . $this->IdResponsable . ",IdNivelActividad=" . $this->IdNivelActividad . ",IdActividadSuperior=" . $this->IdActividadSuperior . ",Orden=" . $this->Orden . ",FechaUltimaModificacion=NOW(),UsuarioUltimaModificacion='" . $this->usuarioUltimaModificacion . "',Pantalla ='".$this->pantalla."',Numeracion ='".$this->Numeracion."',Idcategoria =".$this->Idcategoria.",IdTipoActividad =".$this->IdTipoActividad." WHERE IdActividad ='". $this->IdActividad."';";
        }

        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, '', '');

        if ($query == 1) {
            return true;
        }
        return false;
    }

 public function eliminarActividadMeta(){
        $catalogo = new Catalogo();
        $consulta = "delete from   c_actividad  WHERE IdActividad =". $this->IdActividad.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_actividad", "IdActividad = " . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }


    function getNombreGlobal() {
        return $this->NombreGlobal;
    }

    function getNombreGeneral() {
        return $this->NombreGeneral;
    }

    function getNombreParticular() {
        return $this->NombreParticular;
    }

    function getIdActividadGlobal() {
        return $this->IdActividadGlobal;
    }

    function getIdActividadGeneral() {
        return $this->IdActividadGeneral;
    }

    function getIdActividadParticular() {
        return $this->IdActividadParticular;
    }

    function getIdActividad() {
        return $this->IdActividad;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getPeriodo() {
        return $this->Periodo;
    }

    function getIdArea(){
        return $this->IdArea;
    }

    function getIdEje() {
        return $this->IdEje;
    }

    function getIdResponsable() {
        return $this->IdResponsable;
    }

    function getIdTipoActividad() {
        return $this->IdTipoActividad;
    }

    function getIdNivelActividad() {
        return $this->IdNivelActividad;
    }

    function getIdActividadSuperior() {
        return $this->IdActividadSuperior;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function getOrden() {
        return $this->Orden;
    }

    function getUsuarioUltimaModificacion() {
        return $this->usuarioUltimaModificacion;
    }

    function getUsuarioCreacion() {
        return $this->usuarioCreacion;
    }

    function getPantalla() {
        return $this->pantalla;
    }
    function getNumeracion() {
        return $this->Numeracion;
    }
    function getIdcategoria() {
        return $this->Idcategoria;
    }
    function getIdscategoria() {
        return $this->Idscategoria;
    }
    function setIdscategoria($Idscategoria) {
        $this->Idscategoria = $Idscategoria;
    }
    function setIdcategoria($Idcategoria) {
        $this->Idcategoria = $Idcategoria;
    }
    function setNumeracion($Numeracion) {
        $this->Numeracion = $Numeracion;
    }
    function setIdActividad($IdActividad) {
        $this->IdActividad = $IdActividad;
    }
    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }
    function setPeriodo($Periodo) {
        $this->Periodo = $Periodo;
    }

    function setIdArea($IdArea) {
        $this->IdArea = $IdArea;
    }

    function setIdEje($IdEje) {
        $this->IdEje = $IdEje;
    }

    function setIdResponsable($IdResponsable) {
        $this->IdResponsable = $IdResponsable;
    }

    function setIdTipoActividad($IdTipoActividad) {
        $this->IdTipoActividad = $IdTipoActividad;
    }

    function setIdNivelActividad($IdNivelActividad) {
        $this->IdNivelActividad = $IdNivelActividad;
    }

    function setIdActividadSuperior($IdActividadSuperior) {
        $this->IdActividadSuperior = $IdActividadSuperior;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    function setOrden($Orden) {
        $this->Orden = $Orden;
    }

    function setUsuarioCreacion($usuarioCreacion) {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
    }

    function setUsuarioUltimaModificacion($usuarioUltimaModificacion) {
        $this->usuarioUltimaModificacion = $usuarioUltimaModificacion;
    }

    function setIdActividadGlobal($IdActividadGlobal) {
        $this->IdActividadGlobal = $IdActividadGlobal;
    }

    function setIdActividadGeneral($IdActividadGeneral) {
        $this->IdActividadGeneral = $IdActividadGeneral;
    }

    function setIdActividadParticular($IdActividadParticular) {
        $this->IdActividadParticular = $IdActividadParticular;
    }

    function setNombreGlobal($NombreGlobal) {
        $this->NombreGlobal = $NombreGlobal;
    }

    function setNombreGeneral($NombreGeneral) {
        $this->NombreGeneral = $NombreGeneral;
    }

    function setNombreParticular($NombreParticular) {
        $this->NombreParticular = $NombreParticular;
    }
}

?>
