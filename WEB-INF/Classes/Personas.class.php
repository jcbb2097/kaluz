<?php
/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/

include_once("Catalogo.class.php");

class Persona{
	private $id_Personas;
	private $id_tipopersona;
    private $idEje; #verificar con datos en tabla
    private $id_area;
	private $id_subarea;
	private $relevancia;
	private $nombre;
	private $app;
	private $apm;
	private $seudonimo;
	private $dia;
	private $mes;
	private $anio;
	private $pais_nac;
	private $id_gradoacademico;
	private $id_institucion;
	private $id_institucionE;
	private $cargo;
	private $parentesco;
	private $infoRel;
	private $calle;
	private $num_ext;
	private $num_int;
	private $colonia;
	private $municipio;
	private $id_ciudad;
	private $id_estado;
	private $id_pais;
	private $cp;
	private $correo;
	private $correo_institucional;
	private $rfc;
	private $curp;
	private $estatus;
	private $activo;
	private $UsuarioCreacion;
    private $UsuarioUltimaModificacion;

    //Datos para telefono
    private $id_telefono;
    private $id_tipotel;
    private $numero;
    private $ext;
    private $emergencia;
    private $estatustel;
    private $activotel;

    //Roles
    private $Rol;
    private $id_rolPersona;

    //Instituciones $id_institucion
    private $personaInstitucion;

    //autor Textos
    private $resenia;
	private $semblanza;
	private $ocupacion;
	private $id_institucionA;
	private $IdRegimenFiscal;
	private $telCelular;
	private $telCasa;
	private $teloficina;
	private $fechaNacimiento;

    public function getPersona(){
    	$catalogo = new catalogo();
    	  $consultaP = "SELECT * FROM c_personas WHERE id_Personas = " . $this->id_Personas;
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
    		$this->id_tipopersona = $row['id_TipoPersona'];
    		$this->idEje = $row['idEje']; #verificar con datos en tabla
    		$this->id_area = $row['idArea'];
			$this->id_subarea = $row['idSubArea'];
			$this->relevancia = $row['Relevancia'];
			$this->nombre = $row['Nombre'];
			$this->app = $row['Apellido_Paterno'];
			$this->apm = $row['Apellido_Materno'];
			$this->seudonimo = $row['Apodo'];
			$this->dia = $row['Dia_nacimiento'];
			$this->mes = $row['Mes_nacimiento'];
			$this->anio = $row['Anio_nacimiento'];
			$this->pais_nac = $row['id_PaisNac'];
			$this->id_gradoacademico = $row['id_GradoAcademico'];
			$this->id_institucion = $row['id_Institucion'];
			$this->id_institucionE = $row['id_InstitucionExterno'];
			$this->cargo = $row['Cargo'];
			$this->parentesco = $row['Parentesco'];
			$this->infoRel = $row['InforRel'];
			$this->calle = $row['Calle'];
			$this->num_ext = $row['Numero_Exterior'];
			$this->num_int = $row['Numero_Interior'];
			$this->colonia = $row['id_Colonia'];
			$this->municipio = $row['id_Municipio'];
			$this->id_ciudad = $row['Ciudad'];
			$this->id_estado = $row['id_Estado'];
			$this->id_pais = $row['id_PaisDom'];
			$this->cp = $row['CodigoPostal'];
			$this->correo = $row['Correo'];
			$this->correo_institucional = $row['Correo_Institucional'];
			$this->rfc = $row['RFC'];
			$this->curp = $row['CURP'];
			$this->estatus = $row['id_Estatus'];
			$this->activo = $row['Activo'];
			$this->UsuarioCreacion = $row['created_at'];
    		$this->UsuarioUltimaModificacion = $row['updated_at'];
    		$this->resenia = $row['ResenaCurricular'];
			$this->semblanza = $row['Semblanza'];
			$this->ocupacion = $row['ocupacion'];
			$this->id_institucionA = $row['dependencia'];
			$this->IdRegimenFiscal = $row['IdRegimenFiscal'];
			$this->Telefono = $row['Telefono'];
    		return true;
    	}
    	return false;
    }

    public function obtenerDatosPrincipalPersona(){
    	$consulta = "SELECT
			cp.Semblanza,
			CONCAT(
				cp.Anio_nacimiento,
				'-',
				cp.Mes_nacimiento,
				'-',
				cp.Dia_nacimiento
			) fechaNacimiento,
			cp.Correo,
			cp.RFC,
			cp.IdRegimenFiscal,
		  	cdf.nombre AS regFiscal
			FROM
			`c_personas` AS cp
			LEFT JOIN c_documentofiscal AS cdf ON cdf.Id_docf = cp.IdRegimenFiscal
			WHERE id_Personas = ".$this->id_Personas;
			$catalogo = new catalogo();
			$resultado = $catalogo->obtenerLista($consulta);

			//echo "$consulta";
			while ($row = mysqli_fetch_array($resultado)) {
				
				$this->fechaNacimiento = $row['fechaNacimiento'];
				$this->correo = $row['Correo'];
				$this->rfc = $row['RFC'];
				$this->IdRegimenFiscal = $row['regFiscal'];
				$this->semblanza = $row['Semblanza'];
		     
		    }
    }
    public function obtenerInstitucionesPersona(){
    	$consulta = "SELECT cpe.id_persona,cpe.id_institucion,ci.Nombre FROM `c_personaInstitucion` AS cpe
		INNER JOIN c_personas AS cp ON cp.id_Personas = cpe.id_persona
		INNER JOIN  c_institucion AS ci ON ci.Id_institucion = cpe.id_institucion WHERE cpe.id_persona=".$this->id_Personas.";";

		//echo "$consulta";
		$catalogo = new catalogo();
	    $result = $catalogo->obtenerLista($consulta);
	    /*while ($row1 = mysqli_fetch_array($result)) {
	    	$row1 ['']

	    }*/
	    return $result;
    }
    public function obtenerTelPersona(){
    	$consultaTelefonos = "SELECT id_TipoTelefono,CONCAT(Numero_Telefonico,' Ext. ',Ext) AS Telefono FROM `c_telefonoContacto` WHERE id_Personas =".$this->id_Personas. " AND Activo = 1 ORDER BY id_TipoTelefono;";
    //echo "$consultaTelefonos";
    		$catalogo = new catalogo();
		    $resultado = $catalogo->obtenerLista($consultaTelefonos);
		    
			while ($row = mysqli_fetch_array($resultado)) {	
				if($row['id_TipoTelefono'] == '1'){
					$this->telCelular = $row['Telefono'];
				}
				if($row['id_TipoTelefono'] == '2'){
					$this->telCasa = $row['Telefono'];
				}
				if($row['id_TipoTelefono'] == '3'){
					$this->teloficina = $row['Telefono'];
				}   
    	}
	}
    public function corroborarPersona(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_personas WHERE Nombre = '" . $this->nombre . "' AND Apellido_Paterno = '" . $this->app."'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }

    public function getNumerotelefonico(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_telefonoContacto WHERE id_Personas = " . $this->id_Personas;
    	$rtelefono = $catalogo->obtenerLista($consultaT);
    	while ($row = mysqli_fetch_array($rtelefono)) {
    		$this->id_tipotel = $row['id_TipoTelefono'];
    		$this->id_Personas = $row['id_Personas'];
    		$this->numero = $row['Numero_Telefonico'];
    		$this->ext = $row['Ext'];
    		$this->emergencia = $row['Es_Emergencia'];
    		$this->estatustel = $row['id_Estatus'];
    		$this->activotel = $row['Activo'];
    		return true;
    	}
    	return false;
    }

    public function obtenerRol(){
  		$catalogo = new Catalogo();
  		$rolArray = array();
  		$consulta ="SELECT id_Persona,id_Rol FROM `c_rolPersona` WHERE id_Persona = ".$this->id_Personas;
  		//echo $consulta;
		$result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {
            	array_push($rolArray,$row['id_Rol']);
            }
         return $rolArray;
	}

    public function nuevaPersona(){
    	$catalogo = new Catalogo();
    	$insertarP = "INSERT INTO c_personas(id_TipoPersona, idEje, IdArea, idSubArea, Relevancia, Nombre, Apellido_Paterno,
		 			Apellido_Materno, Apodo, Dia_nacimiento, Mes_nacimiento, Anio_nacimiento, id_PaisNac, id_GradoAcademico, 
					id_Institucion, id_InstitucionExterno, Cargo, Parentesco, InforRel, Calle, Numero_Exterior, Numero_Interior, 
					id_Colonia, id_Municipio, Ciudad, id_Estado, id_PaisDom, CodigoPostal, Correo, Correo_Institucional, RFC, CURP, 
					id_Estatus, Activo, created_at, updated_at, ResenaCurricular, Semblanza, ocupacion, dependencia, IdRegimenFiscal, Telefono)
    	VALUES (".$this->id_tipopersona.",".$this->idEje.",".$this->id_area.",".$this->id_subarea.",'".$this->relevancia."',
		'".$this->nombre."','".$this->app."','".$this->apm."','".$this->seudonimo."','".$this->dia."','".$this->mes."',
		'".$this->anio."',".$this->pais_nac.",".$this->id_gradoacademico.",".$this->id_institucion.",".$this->id_institucionE.",
		'".$this->cargo."','".$this->parentesco."','".$this->infoRel."','".$this->calle."','".$this->num_ext."','".$this->num_int."',
		".$this->colonia.",".$this->municipio.",'".$this->id_ciudad."',".$this->id_estado.",".$this->id_pais.",'".$this->cp."',
		'".$this->correo."','".$this->correo_institucional."','".$this->rfc."','".$this->curp."',".$this->estatus.",1,NOW(),NOW(), 
		'".$this->resenia."','".$this->semblanza."', '".$this->ocupacion."', '".$this->id_institucionA."', '".$this->id_institucionA."'
		, '".$this->IdRegimenFiscal."', '".$this->Telefono."');";
    	$this->id_Personas = $catalogo->insertarRegistro($insertarP);
    	//echo "<br><br>$insertarP<br><br>"; 
        if ($this->id_Personas == 0 || $this->id_Personas == null) {
            return false;
        }
        return true;
    }
	public function nuevaRel_Persona(){
    	$catalogo = new Catalogo();
    	$insertarT = "INSERT INTO k_textoAutor(idTexto, idAutor) VALUES (".$this->Texto.", ".$this->id_Personas.");";
    	//echo "<br><br>$insertarT<br><br>"; 
        if ($catalogo->insertarRegistro($insertarT)) {
			//echo "1";
            return false;
        }
		return true;
    }


    public function agregarNumerotelefonico(){

    	if (!isset($this->id_tipotel) || $this->id_tipotel == NULL){
            $this->id_tipotel = 1;
        }

    	$catalogo = new Catalogo();
    	$insertarT = "INSERT INTO c_telefonoContacto(id_TipoTelefono, id_Personas, Numero_Telefonico, Ext, Es_Emergencia, id_Estatus, Activo)
    		VALUES(".$this->id_tipotel.",".$this->id_Personas.", '".$this->numero."', '".$this->ext."',NULL,NULL,1);";
    	$this->id_telefono = $catalogo->insertarRegistro($insertarT);
    	//echo "<br><br>$insertarT<br><br>";
    	if ($this->id_telefono == 0 || $this->id_telefono == null){
    		return false;
    	}
    	return true;
    }

    public function agregarRol(){

		$insert ="INSERT INTO c_rolPersona (id_Persona,id_Rol) VALUES (".$this->id_Personas.",".$this->Rol.");";

		$catalogo = new Catalogo();
         //echo "<br>".$insert."<br>";
  		$this->id_rolPersona = $catalogo->insertarRegistro($insert);

        if ($this->id_rolPersona == 0 || $this->id_rolPersona == null) {
            return false;
        }
        return true;
	}

	public function agregarInstitucion(){

		$insert ="INSERT INTO c_personaInstitucion (id_persona,id_institucion) VALUES (".$this->id_Personas.",".$this->id_institucion.");";

		$catalogo = new Catalogo();
        echo "<br> Inst: ".$insert."<br>";
  		$this->id_rolPersona = $catalogo->insertarRegistro($insert);

        if ($this->id_rolPersona == 0 || $this->id_rolPersona == null) {
            return false;
        }
        return true;
	}

    public function editarPersona(){
    	$catalogo = new Catalogo();
    	$editarP = "UPDATE c_personas SET id_TipoPersona=".$this->id_tipopersona.", idEje=".$this->idEje.", IdArea=".$this->id_area.", idSubArea=".$this->id_subarea.", Relevancia='".$this->relevancia."', Nombre='".$this->nombre."', Apellido_Paterno='".$this->app."', Apellido_Materno='".$this->apm."', Apodo='".$this->seudonimo."', Dia_nacimiento='".$this->dia."', Mes_nacimiento='".$this->mes."', Anio_nacimiento='".$this->anio."', id_PaisNac=".$this->pais_nac.", id_GradoAcademico=".$this->id_gradoacademico.", id_Institucion=".$this->id_institucion.", 
		id_InstitucionExterno=".$this->id_institucionE.", Cargo='".$this->cargo."', Parentesco='".$this->parentesco."', InforRel='".$this->infoRel."', Calle='".$this->calle."', Numero_Exterior='".$this->num_ext."', Numero_Interior='".$this->num_int."', id_Colonia=".$this->colonia.", id_Municipio=".$this->municipio.", Ciudad='".$this->id_ciudad."', id_Estado=".$this->id_estado.", id_PaisDom=".$this->id_pais.", CodigoPostal='".$this->cp."', Correo='".$this->correo."', Correo_Institucional='".$this->correo_institucional."', RFC='".$this->rfc."', CURP='".$this->curp."', 
		id_Estatus='".$this->estatus."', Activo=1, updated_at=NOW(), ResenaCurricular='".$this->resenia."', Semblanza='".$this->semblanza."', ocupacion='".$this->ocupacion."'
		, dependencia='".$this->id_institucionA."', IdRegimenFiscal='".$this->IdRegimenFiscal."', Telefono='".$this->Telefono."' WHERE id_Personas=$this->id_Personas";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarP, 'c_personas', 'id_Personas = ' . $this->id_Personas);
    	//echo "<br><br>$editarP<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function editarPersona2(){
    	$catalogo = new Catalogo();
    	$editarP = "UPDATE c_personas SET Nombre='".$this->nombre."', Apellido_Paterno='".$this->app."', Apellido_Materno='".$this->apm."', id_PaisNac=".$this->pais_nac.",
		 Correo='".$this->correo."', RFC='".$this->rfc."', CURP='".$this->curp."', 
		 ResenaCurricular='".$this->resenia."'
		, dependencia='".$this->id_institucionA."', IdRegimenFiscal='".$this->IdRegimenFiscal."', Telefono='".$this->Telefono."' WHERE id_Personas=$this->id_Personas";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarP, 'c_personas', 'id_Personas = ' . $this->id_Personas);
    	//echo "<br><br>$editarP<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function editarPersona3(){
    	$catalogo = new Catalogo();
    	$editarP = "UPDATE c_personas SET Correo='".$this->correo."', IdRegimenFiscal='".$this->IdRegimenFiscal."', Telefono='".$this->Telefono."' WHERE id_Personas=$this->id_Personas";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarP, 'c_personas', 'id_Personas = ' . $this->id_Personas);
    	//echo "<br><br>$editarP<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function editarNumerotelefonico(){

    	if (!isset($this->id_tipotel) || $this->id_tipotel == NULL){
            $this->id_tipotel = 1;
        }

    	$catalogo = new Catalogo();
    	$editarT = "UPDATE c_telefonoContacto SET id_TipoTelefono='".$this->id_tipotel."', Numero_Telefonico='".$this->numero."', Ext='".$this->ext."', Es_Emergencia=NULL, id_Estatus=NULL, Activo=1 WHERE id_Personas=".$this->id_Personas;
    	$queryt = $catalogo->ejecutaConsultaActualizacion($editarT, 'c_telefonoContacto', 'id_Personas = ' . $this->id_Personas);
    	//echo "<br><br>$editarT<br><br>";
        if ($queryt == 1) {
            return true;
        }
        return false;
    }

    public function eliminarPersona(){
    	$catalogo = new Catalogo();
    	$eliminarP = "DELETE FROM c_personas WHERE id_Personas = $this->id_Personas;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarP, 'c_personas', 'id_Personas = ' . $this->id_Personas);
    	//echo "<br><br>$eliminarP<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
	public function DeleteRel_Persona(){
    	$catalogo = new Catalogo();
    	$eliminarP = "DELETE FROM k_textoAutor  WHERE idAutor = $this->id_Personas and  idTexto= $this->Texto;";
		$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarP, 'k_textoAutor', 'idAutor = ' . $this->id_Personas);
    	//echo "<br><br>$eliminarP<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
    public function eliminarNumerotelefonico(){
    	$catalogo = new Catalogo();
    	$eliminarT = "DELETE FROM c_telefonoContacto WHERE id_Personas = $this->id_Personas;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarT, 'c_telefonoContacto', 'id_Personas = ' . $this->id_Personas);
    	//echo "<br><br>$eliminarT<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }

    public function eliminarRol(){
    	$catalogo = new Catalogo();
        $consulta = "DELETE FROM c_rolPersona WHERE id_Persona =". $this->id_Personas.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_rolPersona", "id_Persona = " . $this->id_Personas);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_Personas(){
    	return $this->id_Personas;
    }
    function setId_Personas($id_Personas) {
        $this->id_Personas = $id_Personas;
    }

	function getId_tipopersona(){
		return $this->id_tipopersona;
	}
	function setId_tipopersona($id_tipopersona){
		$this->id_tipopersona = $id_tipopersona;
	}

    function getIdEje(){
    	return $this->idEje;
    }
    function setIdEje($idEje){
    	$this->idEje = $idEje;
    }

    function getId_area(){
    	return $this->id_area;
    }
    function setId_area($id_area){
    	$this->id_area = $id_area;
    }

	function getId_subarea(){
		return $this->id_subarea;
	}
	function setId_subarea($id_subarea){
		$this->id_subarea = $id_subarea;
	}

	function getRelevancia(){
		return $this->relevancia;
	}
	function setRelevancia($relevancia){
		$this->relevancia = $relevancia;
	}

	function getNombre(){
		return $this->nombre;
	}
	function setNombre($nombre){
		$this->nombre = $nombre;
	}

	function getApp(){
		return $this->app;
	}
	function setApp($app){
		$this->app = $app;
	}

	function getApm(){
		return $this->apm;
	}
	function setApm($apm){
		$this->apm = $apm;
	}

	function getSeudonimo(){
		return $this->seudonimo;
	}
	function setSeudonimo($seudonimo){
		$this->seudonimo = $seudonimo;
	}

	function getDia(){
		return $this->dia;
	}
	function setDia($dia){
		$this->dia = $dia;
	}

	function getMes(){
		return $this->mes;
	}
	function setMes($mes){
		$this->mes = $mes;
	}

	function getAnio(){
		return $this->anio;
	}
	function setAnio($anio){
		$this->anio = $anio;
	}

	function getPais_nac(){
		return $this->pais_nac;
	}
	function setPais_nac($pais_nac){
		$this->pais_nac = $pais_nac;
	}

	function getId_gradoacademico(){
		return $this->id_gradoacademico;
	}
	function setId_gradoacademico($id_gradoacademico){
		$this->id_gradoacademico = $id_gradoacademico;
	}

	function getId_institucion(){
		return $this->id_institucion;
	}
	function setId_institucion($id_institucion){
		$this->id_institucion = $id_institucion;
	}

	function getId_institucionE(){
		return $this->id_institucionE;
	}
	function setId_institucionE($id_institucionE){
		$this->id_institucionE = $id_institucionE;
	}

	function getCargo(){
		return $this->cargo;
	}
	function setCargo($cargo){
		$this->cargo = $cargo;
	}

	function getParentesco(){
		return $this->parentesco;
	}
	function setParentesco($parentesco){
		$this->parentesco = $parentesco;
	}

	function getInfoRel(){
		return $this->infoRel;
	}
	function setInfoRel($infoRel){
		$this->infoRel = $infoRel;
	}

	function getCalle(){
		return $this->calle;
	}
	function setCalle($calle){
		$this->calle = $calle;
	}

	function getNum_ext(){
		return $this->num_ext;
	}
	function setNum_ext($num_ext){
		$this->num_ext = $num_ext;
	}

	function getNum_int(){
		return $this->num_int;
	}
	function setNum_int($num_int){
		$this->num_int = $num_int;
	}

	function getColonia(){
		return $this->colonia;
	}
	function setColonia($colonia){
		$this->colonia = $colonia;
	}

	function getMunicipio(){
		return $this->municipio;
	}
	function setMunicipio($municipio){
		$this->municipio = $municipio;
	}

	function getId_ciudad(){
		return $this->id_ciudad;
	}
	function setId_ciudad($id_ciudad){
		$this->id_ciudad = $id_ciudad;
	}

	function getId_estado(){
		return $this->id_estado;
	}
	function setId_estado($id_estado){
		$this->id_estado = $id_estado;
	}

	function getId_pais(){
		return $this->id_pais;
	}
	function setId_pais($id_pais){
		$this->id_pais = $id_pais;
	}

	function getCp(){
		return $this->cp;
	}
	function setCp($cp){
		$this->cp = $cp;
	}

	function getCorreo(){
		return $this->correo;
	}
	function setCorreo($correo){
		$this->correo = $correo;
	}

	function getCorreo_institucional(){
		return $this->correo_institucional;
	}
	function setCorreo_institucional($correo_institucional){
		$this->correo_institucional = $correo_institucional;
	}

	function getRfc(){
		return $this->rfc;
	}
	function setRfc($rfc){
		$this->rfc = $rfc;
	}

	function getCurp(){
		return $this->curp;
	}
	function setCurp($curp){
		$this->curp = $curp;
	}

	function getEstatus(){
		return $this->estatus;
	}
	function setEstatus($estatus){
		$this->estatus = $estatus;
	}

	function getActivo(){
		return $this->activo;
	}
	function setActivo($activo){
		$this->activo = $activo;
	}

    function getId_telefono(){
    	return $this->id_telefono;
    }
    function setId_telefono($id_telefono){
    	$this->id_telefono = $id_telefono;
    }

    function getId_tipotel(){
    	return $this->id_tipotel;
    }
    function setId_tipotel($id_tipotel){
    	$this->id_tipotel = $id_tipotel;
    }

    function getNumero(){
    	return $this->numero;
    }
    function setNumero($numero){
    	$this->numero = $numero;
    }

    function getExt(){
    	return $this->ext;
    }
    function setExt($ext){
    	$this->ext = $ext;
    }

    function getEmergencia(){
    	return $this->emergencia;
    }
    function setEmergencia($emergencia){
    	$this->emergencia = $emergencia;
    }

    function getEstatustel(){
    	return $this->estatustel;
    }
    function setEstatustel($estatustel){
    	$this->estatustel = $estatustel;
    }

    function getActivotel(){
    	return $this->activotel;
    }
    function setActivotel($activotel){
    	$this->activotel = $activotel;
    }

    function getRol(){
    	return $this->Rol;
    }
    function setRol($Rol){
    	$this->Rol = $Rol;
    }

    function getidRolp(){
    	return $this->id_rolPersona;
    }

    function setidRolp(){
    	$this->id_rolPersona = $id_rolPersona;
    }

    function getResenia(){
    	return $this->resenia;
    }
    function setResenia($resenia){
    	$this->resenia = $resenia;
    }

    function getSemblanza(){
    	return $this->semblanza;
    }
    function setSemblanza($semblanza){
    	$this->semblanza = $semblanza;
    }
	
	function getOcupacion(){
    	return $this->ocupacion;
    }
    function setOcupacion($ocupacion){
    	$this->ocupacion = $ocupacion;
    }
	
	function getInstitucionA(){
    	return $this->id_institucionA;
    }
	function setInstitucionA($id_institucionA){
    	$this->id_institucionA = $id_institucionA;
    }

    function getTelCelular(){
    	return $this->telCelular;
    }
	function setTelCelular($telCelular){
    	$this->telCelular = $telCelular;
    }
    function getTelCasa(){
    	return $this->telCasa;
    }
	function setTelCasa($telCasa){
    	$this->telCasa = $telCasa;
    }
    function getTelOficina(){
    	return $this->teloficina;
    }
	function setTelOficina($teloficina){
    	$this->teloficina = $teloficina;
    }
    function getFechaNacimiento(){
    	return $this->fechaNacimiento;
    }
	function setFechaNacimiento($fechaNacimiento){
    	$this->fechaNacimiento = $fechaNacimiento;
    }

    function getIdRegimenFiscal(){
    	return $this->IdRegimenFiscal;
    }
	function setIdRegimenFiscal($IdRegimenFiscal){
    	$this->IdRegimenFiscal = $IdRegimenFiscal;
    }
	function getTelefono(){
    	return $this->Telefono;
    }
	function setTelefono($Telefono){
    	$this->Telefono = $Telefono;
    }
	function getTexto(){
    	return $this->Texto;
    }
	function setTexto($Texto){
    	$this->Texto = $Texto;
    }
	function getidTexto(){
    	return $this->idTexto;
    }
	function setidTexto($idTexto){
    	$this->idTexto = $idTexto;
    }
	
}
?>