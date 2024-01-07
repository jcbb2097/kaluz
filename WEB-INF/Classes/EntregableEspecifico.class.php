<?php

include_once("Catalogo.class.php");
//include_once("Conexion.class.php");
class EntregableEspecifico{

	private $IdEntregableEspecifico;
	private $IdEntregable;
	private $Descripcion;
	private $IdExp;
	private $IdIntervalo;
	private $FechaPlaneadaPreliminar;
	private $FechaRealPreliminar;
	private $FechaPlaneadaFinal;
	private $FechaRealFinal;
	private $IdArchPreliminar;
	private $IdArchFinal;
	private $TipoEntregableFinal;
	private $IdEntregEspecifCheckList;
	private $IdCheckList;
	private $Valor;
	private $FechaValor;
	private $UsrValor;
	private $NombreCheckList;
	private $DescCheckList;
	private $UsuarioCreacion;
	private $FechaCreacion;
	private $UsuarioUltimaModificacion;
	private $FechaUltimaModificacion;
	private $Pantalla;
	
	  private $checkDefinirTemas;
    private $checkDefinirAgradecimiento;
    /*******k_insumo**********/
    private $IdInsumo;


    public function obtenerEntregableEsp($IdEntregableEspecifico){
        $consulta = "SELECT cee.IdEntregEspecifico,cee.Descripcion AS nomEntEsp,cee.IdEntregable,DATE_FORMAT(cee.FechaPlaneadaPreliminar,'%Y-%m-%d') AS FechaPlaneadaPreliminar,
            DATE_FORMAT(cee.FechaRealPreliminar,'%Y-%m-%d') AS FechaRealPreliminar,
            DATE_FORMAT(cee.FechaPlaneadaFinal,'%Y-%m-%d') AS FechaPlaneadaFinal,
            DATE_FORMAT(cee.FechaRealFinal,'%Y-%m-%d') AS FechaRealFinal,
            cee.IdArchPreliminar,cee.IdArchFinal,cdP.descripcion AS descArchivoPreliminar,
        cdP.pdf AS rutaArchivoPreliminar,cdF.descripcion AS descArchivoFinal,cdF.pdf AS rutaArchivoFinal,
            CONCAT(cdF.ruta,cdF.pdf) AS pathArchFinal,
            CONCAT(cdP.ruta,cdP.pdf) AS pathArchPreliminar
        FROM
            `c_entregableEspecifico` AS cee
        LEFT JOIN c_documento AS cdP ON cdP.id_documento = cee.IdArchPreliminar
        LEFT JOIN c_documento AS cdF ON cdF.id_documento = cee.IdArchFinal
                WHERE cee.IdEntregEspecifico =".$IdEntregableEspecifico.";";

        //echo "<br>$consulta<br>";
         $catalogo = new Catalogo();
            $query = $catalogo->obtenerLista($consulta);

            return $query;

    }
	public function obtenerEntregableEspCheck($IdEntregableEspecifico){
        $consulta = ("SELECT IdEntregEspecif,IdCheckList,Valor FROM 
            `k_entregableEspecifCheckList` AS keecl
            WHERE IdEntregEspecif =".$IdEntregableEspecifico.";");

                $catalogo = new Catalogo();

                //echo $consulta;
                $query = $catalogo->obtenerLista($consulta);
                while ($rs = mysqli_fetch_array($query)) {
                    //$this->IdEntregable = $rs[''];
                    $this->IdEntregableEspecifico = $rs['IdEntregEspecif'];
                    $this->IdCheckList = $rs['IdCheckList'];
                    $this->Valor = $rs['Valor'];
                }
                return $query;
    }

    public function obtenerEntregableEspChecks($IdEntregableEspecifico){
        $consulta = ("SELECT IdEntregEspecif,IdCheckList,Valor FROM 
            `k_entregableEspecifCheckList`
            WHERE IdEntregEspecif =".$IdEntregableEspecifico.";");

                $catalogo = new Catalogo();

                //echo $consulta;
                $query = $catalogo->obtenerLista($consulta);
               
                return $query;
    }
    public function obtenerEntregableEspCheckVer2($IdEntregableEspecifico,$IdCheckList){
        $consulta = ("SELECT IdEntregEspecif,IdCheckList,Valor FROM 
            `k_entregableEspecifCheckList`
            WHERE IdEntregEspecif =".$IdEntregableEspecifico." AND IdCheckList =".$IdCheckList.";");
                $catalogo = new Catalogo();

                //echo $consulta;
                $query = $catalogo->obtenerLista($consulta);
                while ($rs = mysqli_fetch_array($query)) {
                    //$this->IdEntregable = $rs[''];
                    $this->IdEntregableEspecifico = $rs['IdEntregEspecif'];
                    $this->IdCheckList = $rs['IdCheckList'];
                    $this->Valor = $rs['Valor'];
                }
    }

    public function obtenerKInsumos($IdEntregableEspecifico){
        $consulta = ("SELECT idInsumo FROM `k_insumo`
            WHERE idEntregable =".$IdEntregableEspecifico.";");
                $catalogo = new Catalogo();
                $query = $catalogo->obtenerLista($consulta);

                return $query;
    }
	
    public function agregarEntregableEspecifico() {
        if(!isset($this->IdEntregable) || $this->IdEntregable == null){
            $this->IdEntregable = "NULL";
        }
        if(!isset($this->idExp) || $this->idExp == null){
            $this->idExp = "NULL";
        }
        if(!isset($this->idIntervalo) || $this->idIntervalo == null){
            $this->idIntervalo = "NULL";
        }
        if(!isset($this->FechaPlaneadaPreliminar) || $this->FechaPlaneadaPreliminar == null){
            $this->FechaPlaneadaPreliminar = "0000-00-00";
        }
         if(!isset($this->FechaPlaneadaFinal) || $this->FechaPlaneadaFinal == null){
            $this->FechaPlaneadaFinal = "0000-00-00";
        }
        if(!isset($this->FechaRealFinal) || $this->FechaRealFinal == null){
            $this->FechaRealFinal = "0000-00-00";
        }
        if(!isset($this->FechaRealPreliminar) || $this->FechaRealPreliminar == null){
            $this->FechaRealPreliminar = "0000-00-00";
        }
        if(!isset($this->IdArchPreliminar) || $this->IdArchPreliminar == null){
            $this->IdArchPreliminar = "NULL";
        }
        if(!isset($this->IdArchFinal) || $this->IdArchFinal == null){
            $this->IdArchFinal = "NULL";
        }
         if(!isset($this->TipoEntregableFinal) || $this->TipoEntregableFinal == null){
            $this->TipoEntregableFinal = "NULL";
        }
        $consulta = ("INSERT INTO c_entregableEspecifico(IdEntregable,Descripcion,idExp,idIntervalo,FechaPlaneadaPreliminar,FechaRealPreliminar,FechaPlaneadaFinal,FechaRealFinal,IdArchPreliminar,IdArchFinal,TipoEntregableFinal)
            VALUES(".$this->IdEntregable.",'" . $this->Descripcion . "',".$this->idExp.",".$this->idIntervalo.",'".$this->FechaPlaneadaPreliminar."','".$this->FechaRealPreliminar."','" . $this->FechaPlaneadaFinal . "','".$this->FechaRealFinal."'," . $this->IdArchPreliminar . "," . $this->IdArchFinal . ",".$this->TipoEntregableFinal.");");
        //echo "<br><br>".$consulta."<br><br>";
        $catalogo = new Catalogo();
        $this->IdEntregableEspecifico = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregableEspecifico != NULL && $this->IdEntregableEspecifico != 0) {
            return true;
        }
        return false;
    }

    public function editarEntregableEspecifico() {
        if(!isset($this->IdEntregable) || $this->IdEntregable == null){
            $this->IdEntregable = "NULL";
        }
        if(!isset($this->idExp) || $this->idExp == null){
            $this->idExp = "NULL";
        }
        if(!isset($this->idIntervalo) || $this->idIntervalo == null){
            $this->idIntervalo = "NULL";
        }
        if(!isset($this->FechaPlaneadaPreliminar) || $this->FechaPlaneadaPreliminar == null){
            $this->FechaPlaneadaPreliminar = "0000-00-00";
        }
         if(!isset($this->FechaPlaneadaFinal) || $this->FechaPlaneadaFinal == null){
            $this->FechaPlaneadaFinal = "0000-00-00";
        }
        if(!isset($this->FechaRealFinal) || $this->FechaRealFinal == null){
            $this->FechaRealFinal = "0000-00-00";
        }
        if(!isset($this->FechaRealPreliminar) || $this->FechaRealPreliminar == null){
            $this->FechaRealPreliminar = "0000-00-00";
        }
        if(!isset($this->IdArchPreliminar) || $this->IdArchPreliminar == null){
            $this->IdArchPreliminar = "NULL";
        }
        if(!isset($this->IdArchFinal) || $this->IdArchFinal == null){
            $this->IdArchFinal = "NULL";
        }
         if(!isset($this->TipoEntregableFinal) || $this->TipoEntregableFinal == null){
            $this->TipoEntregableFinal = "NULL";
        }
        $insert = ("UPDATE c_entregableEspecifico SET IdEntregable = ".$this->IdEntregable.",Descripcion = '". $this->Descripcion ."',idExp = ".$this->idExp.",idIntervalo =".$this->idIntervalo.",FechaPlaneadaPreliminar = '".$this->FechaPlaneadaPreliminar."',FechaRealPreliminar = '".$this->FechaRealPreliminar."',FechaPlaneadaFinal = '" . $this->FechaPlaneadaFinal . "',FechaRealFinal = '".$this->FechaRealFinal."',IdArchPreliminar = ". $this->IdArchPreliminar .",IdArchFinal = " . $this->IdArchFinal . ",TipoEntregableFinal = ".$this->TipoEntregableFinal." WHERE IdEntregEspecifico = ".$this->IdEntregableEspecifico.";");
        //echo "<br><br>$insert<br><br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_entregableEspecifico', 'IdEntregEspecifico = ' . $this->IdEntregableEspecifico);

        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarEntregableEspecifico($IdEntregableEspecifico){
        $consulta = "DELETE FROM c_entregableEspecifico WHERE IdEntregEspecifico =".$IdEntregableEspecifico.";";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_entregableEspecifico", "IdEntregEspecifico = " . $this->IdEntregableEspecifico);
        //echo "<br><br>".$consulta."<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;

    }
    public function eliminarEspecifCheckByIdEntregEspecif(){
        $consulta ="DELETE FROM k_entregableEspecifCheckList WHERE IdEntregEspecif = ".$this->IdEntregableEspecifico.";";
        //echo "<br>".$consulta."<br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta,'k_entregableEspecifCheckList', 'IdEntregable = '.$this->IdEntregableEspecifico);

        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarkInsumo(){
        $consulta ="DELETE FROM k_insumo WHERE IdEntregable = ".$this->IdEntregableEspecifico." AND idInsumo = ".$this->IdInsumo.";";
        //echo "<br>".$consulta."<br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta,'k_entregableEspecifCheckList', 'IdEntregable = '.$this->IdEntregableEspecifico);

        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function agregarCheckList() {
    	$consulta = ("INSERT INTO c_checkList(Nombre,Descripcion,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla)
            VALUES(".$this->Nombre.",'" . $this->Descripcion . "',".$this->UsuarioCreacion.",".$this->FechaCreacion.",'".$this->UsuarioUltimaModificacion."','".$this->FechaUltimaModificacion."','" . $this->Pantalla . "');");

    	$catalogo = new Catalogo();
        $this->IdCheckList = $catalogo->insertarRegistro($consulta);

        if ($this->IdCheckList != NULL && $this->IdCheckList != 0) {
            return true;
        }
        return false;
    }

    public function agregarEntregableEspecifCheck(){

        
        if(!isset($this->UsrValor) || $this->UsrValor == null){
            $this->UsrValor = "NULL";
        }
    	$consulta = ("INSERT INTO k_entregableEspecifCheckList(IdEntregEspecif,IdCheckList,Valor,FechaValor,UsrValor)
            VALUES(".$this->IdEntregableEspecifico."," . $this->IdCheckList . ",".$this->Valor.",NOW(),".$this->UsrValor.");");
    	 $catalogo = new Catalogo();

        // echo "<br>".$consulta."<br>";
        $this->IdEntregableEspecifico = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregableEspecifico != NULL && $this->IdEntregableEspecifico != 0) {
            return true;
        }
        return false;
	        
    }
    public function editarEntregableEspecifCheck(){

        $insert ="UPDATE k_entregableEspecifCheckList SET Valor = ".$this->Valor." WHERE IdEntregEspecif = ".$this->IdEntregableEspecifico." AND IdCheckList = ".$this->IdCheckList.";";

       // echo "<br>".$insert."<br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($insert, 'k_entregableEspecifCheckList', ' IdEntregable = '.$this->IdEntregableEspecifico.' AND IdCheckList = '.$this->IdCheckList);

        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function selectEntregable(){
	 $select ="select * from k_entregableEspecifCheckList WHERE IdEntregEspecif = ".$this->IdEntregableEspecifico." AND IdCheckList = ".$this->IdCheckList.";";

        //echo "<br>".$select."<br>";
       
       
        return $select;
	}		
    public function agregarKInsumo(){

        
        if(!isset($this->UsrValor) || $this->UsrValor == null){
            $this->UsrValor = "NULL";
        }
        $consulta = ("INSERT INTO k_insumo(idEntregable,idInsumo,idExposicion,idIntervalo)
            VALUES(".$this->IdEntregableEspecifico."," . $this->IdInsumo . ",NULL,NULL)");
         $catalogo = new Catalogo();

         echo "<br>".$consulta."<br>";
        $this->IdEntregableEspecifico = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregableEspecifico != NULL && $this->IdEntregableEspecifico != 0) {
            return true;
        }
        return false;
            
    }
    public function new_entregable(){
       
        if(!isset($this->IdExp) || $this->IdExp == null || $this->IdExp == ""){
            //echo $this->IdExp."asd";
            $this->IdExp="NULL";
        }
        $consulta = ("INSERT INTO c_entregableEspecifico(IdEntregable, Descripcion, idExp, avance, IdArchFinal, IdLibro)
                    VALUES(".$this->IdEntregable.",'" . $this->Descripcion . "',".$this->IdExp.",".$this->avance.",
                    ". $this->IdArchFinal . ", ".$this->IdLibro.");");
    //echo "<br><br>".$consulta."<br><br>";
    $catalogo = new Catalogo();
        $this->IdEntregableEspecifico = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregableEspecifico != NULL && $this->IdEntregableEspecifico != 0) {
            return true;
        }
        return false;

    }
    public function setAvance($avance) {
        $this->avance = $avance;
    }

    
    public function getAvance() {
        return $this->avance;
    }
    public function setIdLibro($IdLibro) {
        $this->IdLibro = $IdLibro;
    }

    
    public function getIdLibro() {
        return $this->IdLibro;
    }
    
    
	public function setcheckDefinirTemas($checkDefinirTemas) {
        $this->checkDefinirTemas = $checkDefinirTemas;
    }


    public function getcheckDefinirTemas() {
        return $this->checkDefinirTemas;
    }
	
	public function setcheckDefinirAgradecimiento($checkDefinirAgradecimiento) {
        $this->checkDefinirAgradecimiento = $checkDefinirAgradecimiento;
    }


    public function getcheckDefinirAgradecimiento() {
        return $this->checkDefinirAgradecimiento;
    }
	
	
	public function setIdEntregableEspecifico($IdEntregableEspecifico) {
        $this->IdEntregableEspecifico = $IdEntregableEspecifico;
    }


    public function getIdEntregableEspecifico() {
        return $this->IdEntregableEspecifico;
    }

    public function setIdEntregable($IdEntregable) {
        $this->IdEntregable = $IdEntregable;
    }

    
    public function getIdEntregable() {
        return $this->IdEntregable;
    }
    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    
    public function getDescripcion() {
        return $this->Descripcion;
    }
    public function setIdExp($IdExp) {
        $this->IdExp = $IdExp;
    }

    
    public function getIdExp() {
        return $this->IdExp;
    }
    public function setIdIntervalo($IdIntervalo) {
        $this->IdIntervalo = $IdIntervalo;
    }

    
    public function getIdIntervalo() {
        return $this->IdIntervalo;
    }
    public function setFechaPlaneadaPreliminar($FechaPlaneadaPreliminar) {
        $this->FechaPlaneadaPreliminar = $FechaPlaneadaPreliminar;
    }

    
    public function getFechaPlaneadaPreliminar() {
        return $this->FechaPlaneadaPreliminar;
    }
    public function setFechaRealPreliminar($FechaRealPreliminar) {
        $this->FechaRealPreliminar = $FechaRealPreliminar;
    }

    
    public function getFechaRealPreliminar() {
        return $this->FechaRealPreliminar;
    }

	public function setFechaPlaneadaFinal($FechaPlaneadaFinal) {
        $this->FechaPlaneadaFinal = $FechaPlaneadaFinal;
    }

    
    public function getFechaPlaneadaFinal() {
        return $this->FechaPlaneadaFinal;
    }

    public function setFechaRealFinal($FechaRealFinal) {
        $this->FechaRealFinal = $FechaRealFinal;
    }

    
    public function getFechaRealFinal() {
        return $this->FechaRealFinal;
    }

    public function setIdArchPreliminar($IdArchPreliminar) {
        $this->IdArchPreliminar = $IdArchPreliminar;
    }

    
    public function getIdArchPreliminar() {
        return $this->IdArchPreliminar;
    }

    public function setIdArchFinal($IdArchFinal){
        $this->IdArchFinal = $IdArchFinal;
    }

    public function getIdArchFinal(){
        $this->IdArchFinal = $IdArchFinal;
    }
    public function setTipoEntregableFinal($TipoEntregableFinal) {
        $this->TipoEntregableFinal = $TipoEntregableFinal;
    }

    
    public function getTipoEntregableFinal() {
        return $this->TipoEntregableFinal;
    }

	
    public function setFechaCreacion($FechaCreacion) {
        $this->FechaCreacion = $FechaCreacion;
    }

    
    public function getFechaCreacion() {
        return $this->FechaCreacion;
    }
    public function setUsuarioUltimaModificacion($UsuarioUltimaModificacion) {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;
    }

    
    public function getUsuarioUltimaModificacion() {
        return $this->UsuarioUltimaModificacion;
    }
    public function setFechaUltimaModificacion($FechaUltimaModificacion) {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;
    }

    
    public function getFechaUltimaModificacion() {
        return $this->FechaUltimaModificacion;
    }
    public function setPantalla($Pantalla) {
        $this->Pantalla = $Pantalla;
    }

    
    public function getPantalla() {
        return $this->Pantalla;
    }

	public function setValor($Valor) {
        $this->Valor = $Valor;
		
    }
  
    public function getValor() {
        return $this->Valor;
    }
    public function setFechaValor($FechaValor) {
        $this->FechaValor = $FechaValor;
    }

    public function getFechaValor() {
        return $this->FechaValor;
    }

    public function setUsrValor($UsrValor) {
        $this->UsrValor = $UsrValor;
    }

    public function getUsrValor() {
        return $this->UsrValor;
    }
    public function setIdEntregEspecifCheckList($IdEntregEspecifCheckList) {
        $this->IdEntregEspecifCheckList = $IdEntregEspecifCheckList;
    }

    public function getIdEntregEspecifCheckList() {
        return $this->IdEntregEspecifCheckList;
    }

	public function setNombreCheckList($NombreCheckList) {
        $this->NombreCheckList = $NombreCheckList;
    }

    public function getNombreCheckList() {
        return $this->NombreCheckList;
    }

    public function setDescCheckList($DescCheckList) {
        $this->DescCheckList = $DescCheckList;
    }

    public function getDescCheckList() {
        return $this->DescCheckList;
    }

    public function setUsuarioCreacion($UsuarioCreacion) {
        $this->UsuarioCreacion = $UsuarioCreacion;
    }

    public function getUsuarioCreacion() {
        return $this->UsuarioCreacion;
    }

   public function setIdCheckList($IdCheckList){
        $this->IdCheckList = $IdCheckList;
   }
   public function getIdCheckList(){
        return $this->IdCheckList;
   }
   public function setIdInsumo($IdInsumo){
        $this->IdInsumo = $IdInsumo;
   }
   public function getIdInsumo($IdInsumo){
       return $this->IdInsumo;
   }
}