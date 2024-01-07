<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

//include_once("Conexion.class.php");
include_once("Catalogo.class.php");
/**
 * Description of Activo Fijo
 *
 * @author CBC 20190303
 */
class ActivoFijo {

    private $idactivofijo;
    private $estadoactivo;
    private $descripcion;
    private $noinventarioanterior;
    private $noinventarioactual;
    private $secuencia;
    private $noserie;
    private $fecharesguardo;
    private $valor;
    private $situacionactivo;
    private $area;
    private $empleadoresguardo;
    private $empleadousa;
    private $observaciones;
    private $proyarea;
    private $puesto;
    private $imagen;
    private $FechaCreacion;
    private $usuariocreacion;
    private $FechaUltimaModificacion;
    private $UsuarioUltimaModificacion;
    private $Pantalla;
    private $empresa;
    private $actividad;
    private $expo;

    public function obtenerActivoFijo() {
        $catalogo = new Catalogo();
        $consulta = "SELECT * FROM c_activofijotemporal WHERE c_activofijotemporal.IdActivoFijo =  " . $this->idactivofijo;
     //  echo $consultaactivofijo;
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($result)) {
            //$this->idactivofijo =$row['IdActivoFijo'];
            $this->descripcion = $row['Descripcion'];
            $this->noinventarioanterior = $row['NoInventarioAnterior'];
            $this->noinventarioactual = $row['NoInventarioActual'];
            $this->noserie= $row['NoSerie'];
            $this->fecharesguardo = $row['FechaResguardo'];
            $this->valor= $row['Valor'];
            $this->situacionactivo=$row['SituacionActivo'];
            $this->area = $row['IdArea'];
            $this->empleadoresguardo = $row['IdEmpleadoResguarda'];
            $this->empleadousa = $row['IdEmpleadoUsa'];
            $this->observaciones = $row['Observaciones'];
            $this->proyarea = $row['IdEje'];
            $this->puesto = $row['Puesto'];
            $this->imagen = $row['Imagen'];
            $this->UsuarioCreacion = $row['UsuarioCreacion'];
            $this->FechaCreacion = $row['FechaCreacion'];
            $this->UsuarioUltimaModificacion = $row['UsuarioUltimaModificacion'];
            $this->FechaUltimaModificacion = $row['FechaUltimaModificacion'];
            $this->Pantalla = $row['Pantalla'];
            $this->actividad = $row['IdActividad'];
            $this->expo = $row['IdExposicion'];
            //return true;
        }
        //return false;
    }

    public function agregarActivoFijo(){

        if (!isset($this->empleadoresguardo) || $this->empleadoresguardo == NULL || $this->empleadoresguardo == ""){
            $this->empleadoresguardo = "NULL";
        }
        if (!isset($this->empleadousa) || $this->empleadousa == NULL){
            $this->empleadousa = "NULL";
        }
        if (!isset($this->area) || $this->area == NULL){
            $this->area = "NULL";
        }
        if (!isset($this->proyarea) || $this->proyarea == NULL){
            $this->proyarea = "NULL";
        }

        if (!isset($this->imagen) || $this->imagen == NULL || $this->imagen == ""){
            //$this->imagen = "NULL";
            $foto = "NULL";
        }else{
            $foto="'".$this->imagen."'";
        }
        if (!isset($this->actividad) || $this->actividad == NULL){
            $this->actividad = "NULL";
        }
        if (!isset($this->expo) || $this->expo == NULL){
            $this->expo = "NULL";
        }
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_activofijotemporal(EstadoActivo,Descripcion,NoInventarioAnterior,NoInventarioActual,Secuencia,NoSerie,FechaResguardo,Valor,SituacionActivo,IdArea,IdEmpleadoResguarda,IdEmpleadoUsa,Observaciones,IdEje,Puesto,Imagen,FechaCreacion,UsuarioCreacion,FechaUltimaModificacion,UsuarioUltimaModificacion,Pantalla, IdActividad, IdExposicion)
            VALUES(" . $this->estadoactivo . ",'" . $this->descripcion . "','" . $this->noinventarioanterior . "','" . $this->noinventarioactual. "'," . $this->secuencia . ",'" . $this->noserie . "','" . $this->fecharesguardo . "'," . $this->valor . ",'" . $this->situacionactivo . "'," . $this->area . "," . $this->empleadoresguardo . "," . $this->empleadousa . ",'" . $this->observaciones . "',".$this->proyarea.",'" . $this->puesto . "',".$foto.",now(),'" . $this->usuariocreacion . "',now(),'" . $this->UsuarioUltimaModificacion . "' ,'$this->Pantalla', ".$this->actividad.",".$this->expo.");";


        //echo "<br><br>".$insert."<br><br>";
        $this->idactivofijo = $catalogo->insertarRegistro($insert);
        //echo "<br><br>ID: ".$this->idactivofijo."<br><br>";
        //$this->idactivofijo = null;
        if ($this->idactivofijo == 0 || $this->idactivofijo == null) {
            return false;
        }
        return true;
    }
    public function editarActivoFijo() {


        if (!isset($this->empleadoresguardo) || $this->empleadoresguardo == NULL || $this->empleadoresguardo == ""){
            $this->empleadoresguardo = "NULL";
        }
        if (!isset($this->empleadousa) || $this->empleadousa == NULL){
            $this->empleadousa = "NULL";
        }
        if (!isset($this->area) || $this->area == NULL){
            $this->area = "NULL";
        }
        if (!isset($this->proyarea) || $this->proyarea == NULL){
            $this->proyarea = "NULL";
        }

        if (!isset($this->imagen) || $this->imagen == NULL || $this->imagen == ""){
            $foto = "";
        }else{
            $foto = "Imagen='".$this->imagen."',";
        }

        if (!isset($this->actividad) || $this->actividad == NULL){
            $this->actividad = "NULL";
        }
        if (!isset($this->expo) || $this->expo == NULL){
            $this->expo = "NULL";
        }
        $catalogo = new Catalogo();

        $consulta = "UPDATE c_activofijotemporal SET Descripcion='" . $this->descripcion . "',NoInventarioAnterior='" . $this->noinventarioanterior . "',NoInventarioActual='" . $this->noinventarioactual . "',NoSerie='" . $this->noserie . "',FechaResguardo='" . $this->fecharesguardo . "',Valor=" . $this->valor . ",SituacionActivo='" . $this->situacionactivo . "',IdArea=" . $this->area . ",IdEmpleadoResguarda=" . $this->empleadoresguardo . ",IdEmpleadoUsa=" . $this->empleadousa . ",Observaciones='" . $this->observaciones . "',IdEje=" . $this->proyarea . ",Puesto='" . $this->puesto . "',".$foto."UsuarioUltimaModificacion = '" . $this->UsuarioUltimaModificacion . "', FechaUltimaModificacion = NOW(), IdActividad=".$this->actividad.", IdExposicion=".$this->expo." WHERE IdActivoFijo = $this->idactivofijo;";

        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_activofijotemporal', 'IdActivoFijo = ' . $this->idactivofijo);

        if ($query == 1) {
            return true;
        }
        return false;
    }

 public function eliminarActivoFijo(){
        $catalogo = new Catalogo();
        $consulta = "delete from   c_activofijotemporal  WHERE IdActivoFijo= $this->idactivofijo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_activofijotemporal", "IdActivoFijo = " . $this->idactivofijo);
       // echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    function getIdactivofijo() {
        return $this->idactivofijo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getNoinventarioanterior() {
        return $this->noinventarioanterior;
    }

    function getNoinventarioactual() {
        return $this->noinventarioactual;
    }

    function getNoserie() {
        return $this->noserie;
    }

    function getFecharesguardo() {
        return $this->fecharesguardo;
    }

    function getValor() {
        return $this->valor;
    }

    function getSituacionactivo() {
        return $this->situacionactivo;
    }

    function getArea() {
        return $this->area;
    }

    function getEmpleadoresguardo() {
        return $this->empleadoresguardo;
    }

    function getEmpleadousa() {
        return $this->empleadousa;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getProyarea() {
        return $this->proyarea;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getAct() {
        return $this->actividad;
    }

    function getExpo() {
        return $this->expo;
    }

    function setIdactivofijo($idactivofijo) {
        $this->idactivofijo = $idactivofijo;
    }

    function setDescripcion($descripcion) {

        $this->descripcion = $descripcion;
    }

    function setNoinventarioanterior($noinventarioanterior) {
        $this->noinventarioanterior = $noinventarioanterior;
    }

    function setNoinventarioactual($noinventarioactual) {
        $this->noinventarioactual = $noinventarioactual;
    }

    function setNoserie($noserie) {
        $this->noserie = $noserie;
    }

    function setFecharesguardo($fecharesguardo) {
        $this->fecharesguardo = $fecharesguardo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setSituacionactivo($situacionactivo) {
        $this->situacionactivo = $situacionactivo;
    }

    function setArea($area) {
        $this->area = $area;
    }

    function setEmpleadoresguardo($empleadoresguardo) {
        $this->empleadoresguardo = $empleadoresguardo;
    }

    function setEmpleadousa($empleadousa) {
        $this->empleadousa = $empleadousa;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setProyarea($proyarea) {
        $this->proyarea = $proyarea;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setAct($actividad) {
        $this->actividad = $actividad;
    }

    function setExpo($expo) {
        $this->expo = $expo;
    }

    function getFechaCreacion() {
        return $this->FechaCreacion;
    }

    function getUsuarioUltimaModificacion() {
        return $this->UsuarioUltimaModificacion;
    }

    function getFechaUltimaModificacion() {
        return $this->FechaUltimaModificacion;
    }

    function getPantalla() {
        return $this->Pantalla;
    }

    function setFechaCreacion($FechaCreacion) {
        $this->FechaCreacion = $FechaCreacion;
    }

    function setUsuarioUltimaModificacion($UsuarioUltimaModificacion) {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;
    }

    function setFechaUltimaModificacion($FechaUltimaModificacion) {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;
    }

    function setPantalla($Pantalla) {
        $this->Pantalla = $Pantalla;
    }

    function getEstadoactivo() {
        return $this->estadoactivo;
    }

    function setEstadoactivo($estadoactivo) {
        $this->estadoactivo = $estadoactivo;
    }
    function getSecuencia() {
        return $this->secuencia;
    }

    function getPuesto() {
        return $this->puesto;
    }

    function getUsuariocreacion() {
        return $this->usuariocreacion;
    }

    function setSecuencia($secuencia) {
        $this->secuencia = $secuencia;
    }

    function setPuesto($puesto) {
        $this->puesto = $puesto;
    }

    function setUsuariocreacion($usuariocreacion) {
        $this->usuariocreacion = $usuariocreacion;
    }



}

?>
