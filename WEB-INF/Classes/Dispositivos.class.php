<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Dispositivos{
	private $nombre;
	private $descripcion;
	private $tf;


    public function getDispositivos($id){
    	$catalogo = new catalogo();
   $consultaP = "SELECT idTipoDispositivo, idEje, idArea, id_actividad, idPersonaUsa, idPersonaResguarda, inventario, control, serie, marca, modelo, idEstatusDispositivo, observacion, fechaAdquisicion, accesorio, valor,Proveedor, idUbicacion, fechaCreacion, iddisp,idExposicion,id_Trabajosrealizados FROM k_dispositivo2 WHERE idDispositivo = " . $id;
    	$dispositiv = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($dispositiv)) {
			$this->Tdispositivo = $row['idTipoDispositivo'];
			$this->Eje = $row['idEje'];
    		$this->area = $row['idArea'];
            $this->ActividadM = $row['id_actividad'];
            $this->Personau = $row['idPersonaUsa'];
            $this->Personar = $row['idPersonaResguarda'];
            $this->Inventario = $row['inventario'];
            $this->Ncontrol = $row['control'];
            $this->Nserie = $row['serie'];
            $this->Marca = $row['marca'];
            $this->Modelo = $row['modelo'];
            $this->Modelo = $row['modelo'];
            $this->Estatus = $row['idEstatusDispositivo'];
            $this->Observacion = $row['observacion'];
            $this->Adquisicion = $row['fechaAdquisicion'];
            $this->Accesorio = $row['accesorio'];
            $this->Valor = $row['valor'];
            $this->Proveedor = $row['Proveedor'];
            $this->ubicacion = $row['idUbicacion'];
            $this->iddisp=  $row['iddisp'];
             $this->idExposicion= $row['idExposicion'];
           $this->id_Trabajosrealizados= $row['id_Trabajosrealizados'];
    		return true;
    	}
    	return false;
    }
        public function getExtintores($id){
        $catalogo = new catalogo();
           $consultaP = "SELECT idTipoDispositivo, idEje, idArea, id_actividad, idPersonaUsa, idPersonaResguarda, serie, marca, modelo, idEstatusExtintor, observacion, fechaAdquisicion, idUbicacion, fechaUltimaRecarga, fechaProximaRecarga, idAgente, color, senalamiento, soporte, capacidad, incidente, fechaIncidente, reemplazo, Proveedor, idMantenimiento, idTipodeincidencia, id_Trabajosrealizados, idExposicion, fecha_p_hidrostatica, fecha_pp_hidrostatica, empresaRecargo, presionenzonaverde , iddisp, valor
          FROM k_extintores WHERE idDispositivo = " . $id;
        $dispositiv = $catalogo->obtenerLista($consultaP);
        while ($row = mysqli_fetch_array($dispositiv)) {
            $this->Tdispositivo = $row['idTipoDispositivo'];
            $this->Eje = $row['idEje'];
            $this->area = $row['idArea'];
            $this->ActividadM = $row['id_actividad'];
            $this->Personau = $row['idPersonaUsa'];
            $this->Personar = $row['idPersonaResguarda'];
            $this->Nserie = $row['serie'];
            $this->Marca = $row['marca'];
            $this->Modelo = $row['modelo'];
            $this->Modelo = $row['modelo'];
            $this->Estatus = $row['idEstatusExtintor'];
            $this->Observacion = $row['observacion'];
            $this->Adquisicion = $row['fechaAdquisicion'];
            $this->ubicacion = $row['idUbicacion'];
            $this->Ultimar= $row['fechaUltimaRecarga'];
            $this->Proximar= $row['fechaProximaRecarga'];
            $this->Agente= $row['idAgente'];
            $this->Color= $row['color'];
            $this->senalamiento= $row['senalamiento'];
            $this->Soporte= $row['soporte'];
            $this->Capacidad= $row['capacidad'];
            $this->Incidente= $row['incidente'];
            $this->fechaIncidente= $row['fechaIncidente'];
            $this->Reemplazo= $row['reemplazo'];
            $this->Proveedor = $row['Proveedor'];
            $this->idMantenimiento= $row['idMantenimiento'];
            $this->idTipodeincidencia= $row['idTipodeincidencia'];
            $this->id_Trabajosrealizados= $row['id_Trabajosrealizados'];
            $this->idExposicion= $row['idExposicion'];
            $this->fecha_p_hidrostatica= $row['fecha_p_hidrostatica'];
            $this->fecha_pp_hidrostatica= $row['fecha_pp_hidrostatica'];
            $this->empresaRecargo= $row['empresaRecargo'];
            $this->presionenzonaverde= $row['presionenzonaverde'];
            $this->iddisp=  $row['iddisp'];
             $this->Valor = $row['valor'];
           
            return true;
        }
        return false;
    }

    public function corroborarDispositivos(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM k_dispositivoP WHERE nombre = '" . $this->nombre . "'";
    	echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoDispositivos(){
        if (!isset($this->ActividadM) || $this->ActividadM == NULL){
            $this->ActividadM = 0;
        }
    	$catalogo = new Catalogo();

    	$insertarA = "INSERT INTO k_dispositivo2 (idTipoDispositivo, idEje, idArea, id_actividad, idPersonaUsa, idPersonaResguarda, inventario, control, serie, marca, modelo, idEstatusDispositivo, observacion, fechaAdquisicion, accesorio, valor,Proveedor, idUbicacion, fechaCreacion, usuarioCreacion, fechaUltimaModificacion, usuarioUltimaModificacion,pantalla, iddisp, idExposicion, id_Trabajosrealizados)
    	VALUES ('".$this->Tdispositivo."','".$this->Eje."','".$this->area."','".$this->ActividadM."','".$this->Personau."','".$this->Personar."','".$this->Inventario."','".$this->Ncontrol."','".$this->Nserie."','".$this->Marca."','".$this->Modelo."','".$this->Estatus."','".$this->Observacion."','".$this->Adquisicion."','".$this->Accesorio."','".$this->Valor."', '".$this->Proveedor."','".$this->ubicacion."',NOW(),'Admin',NOW(), 'Admin', 'altadispositivo.php','".$this->iddisp."', '".$this->idExposicion."',  '".$this->id_Trabajosrealizados."');";
    	$this->Agentesid = $catalogo->insertarRegistro($insertarA);
    	//echo "<br>Insertar: <br>$insertarA<br><br>"; 
        if ($this->Agentesid == 0 || $this->Agentesid == null) {
            return false;
        }
        return true;
    } 
    public function nuevoExtintor(){
        if (!isset($this->ActividadM) || $this->ActividadM == NULL){
            $this->ActividadM = 0;
        }
        $catalogo = new Catalogo();

        $insertarA = "INSERT INTO k_extintores (idTipoDispositivo, idEje, idArea, id_actividad, idPersonaUsa, idPersonaResguarda, serie, marca, modelo, idEstatusExtintor, observacion, fechaAdquisicion, idUbicacion, fechaUltimaRecarga, fechaProximaRecarga, idAgente, color, senalamiento, soporte, capacidad, incidente, fechaIncidente, reemplazo, Proveedor, idMantenimiento, idTipodeincidencia, id_Trabajosrealizados, idExposicion, fecha_p_hidrostatica, fecha_pp_hidrostatica, empresaRecargo, presionenzonaverde, fechaCreacion, usuarioCreacion, fechaUltimaModificacion, usuarioUltimaModificacion,pantalla, iddisp, valor)
        VALUES ('".$this->Tdispositivo."','".$this->Eje."','".$this->area."','".$this->ActividadM."','".$this->Personau."','".$this->Personar."','".$this->Nserie."','".$this->Marca."','".$this->Modelo."','".$this->Estatus."','".$this->Observacion."', '".$this->Adquisicion."', '".$this->ubicacion."', '".$this->Ultimar."', '".$this->Proximar."', '".$this->Agente."', '".$this->Color."', '".$this->senalamiento."', '".$this->Soporte."', '".$this->Capacidad."', '".$this->Incidente."', '".$this->fechaIncidente."', '".$this->Reemplazo."', '".$this->Proveedor."', '".$this->idMantenimiento."', '".$this->idTipodeincidencia."',  '".$this->id_Trabajosrealizados."', '".$this->idExposicion."', '".$this->fecha_p_hidrostatica."', '".$this->fecha_pp_hidrostatica."', '".$this->empresaRecargo."', '".$this->presionenzonaverde."', NOW(),'Admin',NOW(), 'Admin', 'altadispositivo.php','".$this->iddisp."','".$this->Valor."');";
        $this->Agentesid = $catalogo->insertarRegistro($insertarA);
        //echo "<br>Insertar: <br>$insertarA<br><br>"; 
        if ($this->Agentesid == 0 || $this->Agentesid == null) {
            return false;
        }
        return true;
    }
    public function editarExtintor(){
        if($this->ActividadM==""){
            $this->ActividadM=0;
        }
        $catalogo = new Catalogo();
        $editarA = "UPDATE k_extintores SET idTipoDispositivo= '".$this->Tdispositivo."', idEje='".$this->Eje."', idArea='".$this->area."', id_actividad='".$this->ActividadM."', idPersonaUsa='".$this->Personau."', idPersonaResguarda='".$this->Personar."', serie='".$this->Nserie."', marca='".$this->Marca."', modelo='".$this->Modelo."', idEstatusExtintor='".$this->Estatus."', observacion ='".$this->Observacion."', fechaAdquisicion='".$this->Adquisicion."', idUbicacion='".$this->ubicacion."', fechaUltimaRecarga='".$this->Ultimar."', fechaProximaRecarga='".$this->Proximar."', idAgente='".$this->Agente."', color='".$this->Color."', senalamiento='".$this->senalamiento."', soporte='".$this->Soporte."', capacidad='".$this->Capacidad."', incidente='".$this->Incidente."', fechaIncidente='".$this->fechaIncidente."', reemplazo='".$this->Reemplazo."', Proveedor='".$this->Proveedor."', idMantenimiento='".$this->idMantenimiento."', idTipodeincidencia='".$this->idTipodeincidencia."', id_Trabajosrealizados='".$this->id_Trabajosrealizados."', idExposicion='".$this->idExposicion."', fecha_p_hidrostatica='".$this->fecha_p_hidrostatica."', fecha_pp_hidrostatica='".$this->fecha_pp_hidrostatica."', empresaRecargo='".$this->empresaRecargo."', iddisp= '".$this->iddisp."' , presionenzonaverde= '".$this->presionenzonaverde."', valor= '".$this->Valor."'
         WHERE idDispositivo = $this->dispositivoid;";
        $query = $catalogo->ejecutaConsultaActualizacion($editarA, 'k_dispositivoP', 'idDispositivo = ' . $this->dispositivoid);
        //echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function editarDispositivos(){
        if($this->ActividadM==""){
            $this->ActividadM=0;
        }
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE k_dispositivo2 SET idTipoDispositivo='".$this->Tdispositivo."', idEje ='".$this->Eje."', idArea='".$this->area."', id_actividad='".$this->ActividadM."', idPersonaUsa='".$this->Personau."', idPersonaResguarda='".$this->Personar."', inventario='".$this->Inventario."', control='".$this->Ncontrol."', serie='".$this->Nserie."', marca='".$this->Marca."', modelo='".$this->Modelo."', idEstatusDispositivo='".$this->Estatus."', observacion='".$this->Observacion."', fechaAdquisicion='".$this->Adquisicion."', accesorio='".$this->Accesorio."', valor='".$this->Valor."', Proveedor='".$this->Proveedor."', idUbicacion='".$this->ubicacion."', fechaUltimaModificacion=NOW(), usuarioUltimaModificacion='admin',pantalla='alta_agente.php' , iddisp= '".$this->iddisp."' , idExposicion='".$this->idExposicion."', id_Trabajosrealizados='".$this->id_Trabajosrealizados."'
        WHERE idDispositivo = $this->dispositivoid;";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'k_dispositivoP', 'idDispositivo = ' . $this->dispositivoid);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarDispositivos(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM k_dispositivo2 WHERE idDispositivo = $this->dispositivoid;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'k_dispositivo2', 'idDispositivo = ' . $this->dispositivoid);
    	//echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
    public function eliminarExtintores(){
        $catalogo = new Catalogo();
        $eliminarA = "DELETE FROM k_extintores WHERE idDispositivo = $this->dispositivoid;";
        $queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'k_extintores', 'idDispositivo = ' . $this->dispositivoid);
        //echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
	function getTdispositivo(){
    	return $this->Tdispositivo;
    }
    function setTdispositivo($Tdispositivo){
    	$this->Tdispositivo = $Tdispositivo;
    }

    function getEje(){
    	return $this->Eje;
    }
    function setEje($Eje){
    	$this->Eje = $Eje;
    }

    function getPersonau(){
    	return $this->Personau;
    }

    function setPersonau($Personau){
    	$this->Personau = $Personau;
    }
    function getarea(){
    	return $this->area;
    }

    function setarea($area){
    	$this->area = $area;
    }
    function getPersonar(){
        return $this->Personar;
    }
    function setPersonar($Personar){
        $this->Personar = $Personar;
    }
    function setActividadM($ActividadM){
        $this->ActividadM = $ActividadM;
    }
    function getActividadM(){
        return $this->ActividadM;
    }
    function setInventario($Inventario){
        $this->Inventario = $Inventario;
    }
    function getInventario(){
        return $this->Inventario;
    }
    function setNcontrol($Ncontrol){
        $this->Ncontrol = $Ncontrol;
    }
    function getNcontrol(){
        return $this->Ncontrol;
    }
    function setNserie($Nserie){
        $this->Nserie = $Nserie;
    }
    function getNserie(){
        return $this->Nserie;
    }
    function setMarca($Marca){
        $this->Marca = $Marca;
    }
    function getMarca(){
        return $this->Marca;
    }
    function setModelo($Modelo){
        $this->Modelo = $Modelo;
    }
    function getModelo(){
        return $this->Modelo;
    }
    function setEstatus($Estatus){
        $this->Estatus = $Estatus;
    }
    function getEstatus(){
        return $this->Estatus;
    }
    function setObservacion($Observacion){
        $this->Observacion = $Observacion;
    }
    function getObservacion(){
        return $this->Observacion;
    }
    function setAdquisicion($Adquisicion){
        $this->Adquisicion = $Adquisicion;
    }
    function getAdquisicion(){
        return $this->Adquisicion;
    }
    function setAccesorio($Accesorio){
        $this->Accesorio = $Accesorio;
    }
    function getAccesorio(){
        return $this->Accesorio;
    }
    function setValor($Valor){
        $this->Valor = $Valor;
    }
    function getValor(){
        return $this->Valor;
    }
    function setubicacion($ubicacion){
        $this->ubicacion = $ubicacion;
    }
    function getubicacion(){
        return $this->ubicacion;
    }
    function setUltimar($Ultimar){
        $this->Ultimar = $Ultimar;
    }
    function getUltimar(){
        return $this->Ultimar;
    }
    function setProximar($Proximar){
        $this->Proximar = $Proximar;
    }
    function getProximar(){
        return $this->Proximar;
    }
    function setAgente($Agente){
        $this->Agente = $Agente;
    }
    function getAgente(){
        return $this->Agente;
    }
    function setColor($Color){
        $this->Color = $Color;
    }
    function getColor(){
        return $this->Color;
    }
    function setEstadoe($Estadoe){
        $this->Estadoe = $Estadoe;
    }
    function getEstadoe(){
        return $this->Estadoe;
    }
    function setsenalamiento($senalamiento){
        $this->senalamiento = $senalamiento;
    }
    function getsenalamiento(){
        return $this->senalamiento;
    }    
    function setSoporte($Soporte){
        $this->Soporte = $Soporte;
    }
    function getSoporte(){
        return $this->Soporte;
    }    
    function setEmpresar($Empresar){
        $this->Empresar = $Empresar;
    }
    function getEmpresar(){
        return $this->Empresar;
    }    
    function setCapacidad($Capacidad){
        $this->Capacidad = $Capacidad;
    }
    function getCapacidad(){
        return $this->Capacidad;
    }    
    function setIncidente($Incidente){
        $this->Incidente = $Incidente;
    }
    function getIncidente(){
        return $this->Incidente;
    }    
    function setReemplazo($Reemplazo){
        $this->Reemplazo = $Reemplazo;
    }
    function getReemplazo(){
        return $this->Reemplazo;
    }  
      function setEstatusBien($EstatusBien){
        $this->EstatusBien = $EstatusBien;
    }
    function getEstatusBien(){
        return $this->EstatusBien;
    }    
    
    function setdispositivoid($dispositivoid){
        $this->dispositivoid = $dispositivoid;
    }
    function getdispositivoid(){
        return $this->dispositivoid;
    }   

     function setidTipodeincidencia($idTipodeincidencia){
        $this->idTipodeincidencia = $idTipodeincidencia;
    }
    function getidTipodeincidencia(){
        return $this->idTipodeincidencia;
    }   

     function setidMantenimiento($idMantenimiento){
        $this->idMantenimiento = $idMantenimiento;
    }
    function getidMantenimiento(){
        return $this->idMantenimiento;
    }   
     function setid_Trabajosrealizados($id_Trabajosrealizados){
        $this->id_Trabajosrealizados = $id_Trabajosrealizados;
    }
    function getid_Trabajosrealizados(){
        return $this->id_Trabajosrealizados;
    }   
     function setProveedor($Proveedor){
        $this->Proveedor = $Proveedor;
    }
    function getProveedor(){
        return $this->Proveedor;
    }   
    function setidExposicion($idExposicion){
        $this->idExposicion = $idExposicion;
    }
    function getidExposicion(){
        return $this->idExposicion;
    }  
    function setfecha_pp_hidrostatica($fecha_pp_hidrostatica){  
        $this->fecha_pp_hidrostatica = $fecha_pp_hidrostatica;
    }
    function getfecha_pp_hidrostatica(){
        return $this->fecha_pp_hidrostatica;
    }  
    function setfecha_p_hidrostatica($fecha_p_hidrostatica){
        $this->fecha_p_hidrostatica = $fecha_p_hidrostatica;
    }
    function getfecha_p_hidrostatica(){
        return $this->fecha_p_hidrostatica;
    }  
    function setempresaRecargo($empresaRecargo){
        $this->empresaRecargo = $empresaRecargo;
    }
    function getempresaRecargo(){
        return $this->empresaRecargo;
    }  
    function setpresionenzonaverde($presionenzonaverde){
        $this->presionenzonaverde = $presionenzonaverde;
    }
    function getpresionenzonaverde(){
        return $this->presionenzonaverde;
    }  
    function setfechaIncidente($fechaIncidente){
        $this->fechaIncidente = $fechaIncidente;
    }
    function getfechaIncidente(){
        return $this->fechaIncidente;
    }
    function setiddisp($iddisp){
        $this->iddisp = $iddisp;
    }
    function getiddisp(){
        return $this->iddisp;
    }


}
?>