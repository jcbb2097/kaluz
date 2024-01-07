<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class DefinirFormato {

	private $IdLibro;
    private $Titulo;
    private $IdFormatoLibro;
    //Tabla c_Libro
	private $IdEje;
	private $IdActividad;
	private $Imagen;
	private $PDF;
    private $ISBN;
    private $ISSN;
    private $Resena;
    private $IdPeriodo;
    private $IdExposicion;
    private $PDFindice;
    private $PDFpag3Texto;
    private $Estado;
    private $anioPublicacion;
    //Tabla c_formatoLibro
    private $IdEditorPersona;
    private $IdConceptoLibro;
    private $IdInstitucionesLibro;
    private $IdSoporte;
    private $IdTipoPublicacion;
    private $IdEntregableDF;
    private $RutaEntregableDF;

    private $Coedicion;
    private $IdCoeditorFormatoLibro;

    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;

	public function totalCamposLlenados(){
		$contadorLibro = 0;
		$condatorDF=0;
		$totalCampos =0;
		$catalogo = new Catalogo();

        $consulta ="SELECT Titulo,Imagen,PDF,ISBN,Resena,cl.IdActividad,ca.IdEje,IdExposicion,IdPeriodo,ISSN,PDFindice,PDFpag3Texto,IdEstado,AnioPublicacion FROM `c_libro` AS cl INNER JOIN c_actividad AS ca ON ca.IdActividad = cl.IdActividad WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	if($row['Titulo'] != "" || !empty($row['Titulo'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['Imagen'] != "" || !empty($row['Imagen'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	
            	if($row['PDF'] != "" || !empty($row['PDF'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['ISBN'] != "" || !empty($row['ISBN'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
               	if($row['Resena'] != "" || !empty($row['Resena'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
                if($row['AnioPublicacion'] != "0000-00-00"){
                    $contadorLibro = $contadorLibro + 1;
                }
            	if($row['IdPeriodo'] != "" || !empty($row['IdPeriodo'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['IdEje'] != "" || !empty($row['IdEje'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['IdActividad'] != "" || !empty($row['IdActividad'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['IdExposicion'] != "" || !empty($row['IdExposicion'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['ISSN'] != "" || !empty($row['ISSN'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	if($row['PDFindice'] != "" || !empty($row['PDFindice'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            	/*if($row['PDFpag3Texto'] != "" || !empty($row['PDFpag3Texto'])){
            		$contadorLibro = $contadorLibro + 1;
            	}*/
            	if($row['IdEstado'] != "" || !empty($row['IdEstado'])){
            		$contadorLibro = $contadorLibro + 1;
            	}
            }
            //echo "Total Libro: ".$contadorLibro;
        $consultaDF ="SELECT IdFormatoLibro,IdEditorPersona,IdTipoPublicacion,IdSoporte
					,IdConceptoLibro,IdInstitucionesLibro FROM `c_formatoLibro` WHERE IdLibro = ".$this->IdLibro;
		//echo "<br><br>".$consultaDF."<br><br>";			
		$resultDF = $catalogo->obtenerLista($consultaDF);
            while ($row = mysqli_fetch_array($resultDF)) {

            	if($row['IdEditorPersona'] != "" || !empty($row['IdEditorPersona'])){
            		$condatorDF = $condatorDF + 1;
            	}
            	if($row['IdConceptoLibro'] != "" || !empty($row['IdConceptoLibro'])){
            		$condatorDF = $condatorDF + 1;
            	}
            	if($row['IdTipoPublicacion'] != "" || !empty($row['IdTipoPublicacion'])){
            		$condatorDF = $condatorDF + 1;
            	}
            	if($row['IdSoporte'] != "" || !empty($row['IdSoporte'])){
            		$condatorDF = $condatorDF + 1;
            	}
            	if($row['IdInstitucionesLibro'] != "" || !empty($row['IdInstitucionesLibro'])){
            		$condatorDF = $condatorDF + 1;
            	}
            	
            }
            $totalCampos = $contadorLibro +  $condatorDF;

            return $totalCampos;     
	}
	public function obtenerLibro(){

		$catalogo = new Catalogo();
        $consulta ="SELECT Titulo,Imagen,PDF,ISBN,Resena,AnioPublicacion,cl.IdActividad,ca.IdEje,IdExposicion,IdPeriodo,ISSN,PDFindice,PDFpag3Texto,IdEstado FROM `c_libro` AS cl INNER JOIN c_actividad AS ca ON ca.IdActividad = cl.IdActividad WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->Titulo = $row['Titulo'];
            	$this->Imagen = $row['Imagen'];
            	$this->PDF = $row['PDF'];
            	$this->ISBN = $row['ISBN'];
            	$this->Resena = $row['Resena'];
            	$this->IdEje = $row['IdEje'];
            	$this->IdActividad = $row['IdActividad'];
            	$this->IdExposicion = $row['IdExposicion'];
            	$this->IdPeriodo = $row['IdPeriodo'];
            	$this->ISSN = $row['ISSN'];
            	$this->PDFindice = $row['PDFindice'];
            	$this->PDFpag3Texto = $row['PDFpag3Texto'];
            	$this->Estado = $row['IdEstado'];
                $this->anioPublicacion = $row['AnioPublicacion'];
            }
	}

	public function obtenerDefinirFormato(){
  		$catalogo = new Catalogo();

  		$consulta ="SELECT IdFormatoLibro,IdEditorPersona,IdTipoPublicacion,IdSoporte
					,IdConceptoLibro,IdInstitucionesLibro, IdEntregableFormatoLibro,RutaEntregableFormatoLibro FROM `c_formatoLibro` WHERE IdLibro = ".$this->IdLibro;
		$result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdEditorPersona = $row['IdEditorPersona'];
            	$this->IdConceptoLibro = $row['IdConceptoLibro'];
            	$this->IdTipoPublicacion = $row['IdTipoPublicacion'];
            	$this->IdSoporte = $row['IdSoporte'];
            	$this->IdInstitucionesLibro = $row['IdInstitucionesLibro'];
            	$this->IdFormatoLibro = $row['IdFormatoLibro'];
                $this->IdEntregableDF = $row['IdEntregableFormatoLibro'];
                $this->RutaEntregableDF = $row['RutaEntregableFormatoLibro'];

            }
	}
	public function obtenerCoeditor(){
  		$catalogo = new Catalogo();
  		$coeditorArray = array();
  		$consulta ="SELECT IdFormatoLibro,IdCoeditor FROM `k_coeditorFormatoLibro` WHERE IdFormatoLibro = ".$this->IdFormatoLibro;
  		//echo $consulta;
		$result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	//$this->Coedicion = $row['IdCoeditor'];
            	array_push($coeditorArray,$row['IdCoeditor']);
            }
         return $coeditorArray;
	}

	public function agregarLibro(){
		$img = "";
		$pdf = "";
		$pdfindice = "";
		$pdfpag3Texto = "";
		if (!isset($this->IdActividad) || $this->IdActividad == NULL || $this->IdActividad == ""){
            $this->IdActividad = "NULL";
        }
        if (!isset($this->IdExposicion) || $this->IdExposicion == NULL || $this->IdExposicion == ""){
            $this->IdExposicion = "NULL";
        }
        if (!isset($this->IdPeriodo) || $this->IdPeriodo == NULL || $this->IdPeriodo == ""){
            $this->IdPeriodo = "NULL";
        }
        if (!isset($this->anioPublicacion) || $this->anioPublicacion == NULL || $this->anioPublicacion == ""){
            $this->anioPublicacion = "0000-00-00";
        }
        if (!isset($this->Imagen) || $this->Imagen == NULL || $this->Imagen == ""){
            //$this->Imagen = "NULL";
            $img = "NULL";
        }else{
        	$img =  "'".$this->Imagen."'";
        }
        if (!isset($this->PDF) || $this->PDF == NULL || $this->PDF == ""){
            //$this->PDF = "NULL";
            $pdf = "NULL";
        }else{
        	$pdf =  "'".$this->PDF."'";
        }
       
        if (!isset($this->PDFindice) || $this->PDFindice == NULL || $this->PDFindice == ""){
            //$this->PDF = "NULL";
            $pdfindice = "NULL";
        }else{
        	$pdfindice =  "'".$this->PDFindice."'";
        }
        if (!isset($this->PDFpag3Texto) || $this->PDFpag3Texto == NULL || $this->PDFpag3Texto == ""){
            //$this->PDF = "NULL";
            $pdfpag3Texto = "NULL";
        }else{
        	$pdfpag3Texto =  "'".$this->PDFpag3Texto."'";
        }
        if (!isset($this->Estado) || $this->Estado == NULL || $this->Estado == ""){
            $this->Estado = "NULL";
        }


  		$insert ="INSERT INTO c_libro (IdActividad,Titulo,Imagen,PDF,ISBN,Resena,AnioPublicacion,IdExposicion,IdPeriodo,IdEstado,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla,ISSN,PDFindice,PDFpag3Texto) VALUES (".$this->IdActividad.",'".$this->Titulo."',".$img.",".$pdf.",'".$this->ISBN."','".$this->Resena."','".$this->anioPublicacion."',".$this->IdExposicion.",".$this->IdPeriodo.",".$this->Estado.",'".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."','".$this->ISSN."',".$pdfindice.",".$pdfpag3Texto.");";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdLibro = $catalogo->insertarRegistro($insert);

        if ($this->IdLibro == 0 || $this->IdLibro == null) {
            return false;
        }
        return true;
	}
	public function editarLibro(){
		$img = "";
		$pdf = "";
		$pdfIndice = "";
		$pdfPaginas = "";
        
		if (!isset($this->IdActividad) || $this->IdActividad == NULL || $this->IdActividad == ""){
            $this->Periodo = "NULL";
        }
        if (!isset($this->IdExposicion) || $this->IdExposicion == NULL || $this->IdExposicion == ""){
            $this->IdExposicion = "NULL";
        }
        if (!isset($this->IdPeriodo) || $this->IdPeriodo == NULL || $this->IdPeriodo == ""){
            $this->IdPeriodo = "NULL";
        }
        if (!isset($this->anioPublicacion) || $this->anioPublicacion == NULL || $this->anioPublicacion == ""){
            $this->anioPublicacion = "0000-00-00";
        }
        if (!isset($this->Estado) || $this->Estado == NULL || $this->Estado == ""){
            $this->Estado = "NULL";
        }
        if (!isset($this->Imagen) || $this->Imagen == NULL || $this->Imagen == ""){
            //$this->Imagen = "NULL";
            $img = "";
        }else{
        	$img =  ",Imagen = "."'".$this->Imagen."'";
        }
        if (!isset($this->PDF) || $this->PDF == NULL || $this->PDF == ""){
            //$this->PDF = "NULL";
            $pdf = "";
        }else{
        	$pdf =  ",PDF = "."'".$this->PDF."'";
        }
        if (!isset($this->PDFindice) || $this->PDFindice == NULL || $this->PDFindice == ""){
          
            $pdfIndice = "";
        }else{
        	$pdfIndice =  ",PDFindice = "."'".$this->PDFindice."'";
        }
        if (!isset($this->PDFpag3Texto) || $this->PDFpag3Texto == NULL || $this->PDFpag3Texto == ""){
           
            $pdfPaginas = "";
        }else{
        	$pdfPaginas =  ",PDFpag3Texto = "."'".$this->PDFpag3Texto."'";
        }

      


  		$insert ="UPDATE c_libro SET IdActividad = ".$this->IdActividad.",Titulo = '".$this->Titulo."'".$img.$pdf.",ISBN = '".$this->ISBN."',Resena = '".$this->Resena."',AnioPublicacion ='".$this->anioPublicacion."',IdExposicion = ".$this->IdExposicion.",IdPeriodo = ".$this->IdPeriodo.",IdEstado = ".$this->Estado.",ISSN = '".$this->ISSN."'".$pdfIndice.$pdfPaginas.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion=NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_libro', 'IdLibro = ' . $this->IdLibro);

        if ($query == 1) {
            return true;
        }
        return false;
	}
	public function editarDefinirFormato(){
        $rutaEntregable = "";
		/*if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }*/
        if (!isset($this->IdConceptoLibro) || $this->IdConceptoLibro == NULL || $this->IdConceptoLibro == ""){
            $this->IdConceptoLibro = "NULL";
        }
        if (!isset($this->IdInstitucionesLibro) || $this->IdInstitucionesLibro == NULL || $this->IdInstitucionesLibro == ""){
            $this->IdInstitucionesLibro = "NULL";
        }
        if (!isset($this->IdSoporte) || $this->IdSoporte == NULL || $this->IdSoporte == ""){
            $this->IdSoporte = "NULL";
        }
        if (!isset($this->IdTipoPublicacion) || $this->IdTipoPublicacion == NULL || $this->IdTipoPublicacion == ""){
            $this->IdTipoPublicacion = "NULL";
        }
        if (!isset($this->IdEditorPersona) || $this->IdEditorPersona == NULL || $this->IdEditorPersona == ""){
            $this->IdEditorPersona = "NULL";
        }
        if (!isset($this->IdEntregableDF) || $this->IdEntregableDF == NULL || $this->IdEntregableDF == ""){
            $this->IdEntregableDF = "NULL";
        }
        if (!isset($this->RutaEntregableDF) || $this->RutaEntregableDF == NULL || $this->RutaEntregableDF == ""){
           
            $rutaEntregable = "";
        }else{
            $rutaEntregable =  ",RutaEntregableFormatoLibro = "."'".$this->RutaEntregableDF."'";
        }
       
		$insert ="UPDATE c_formatoLibro SET IdEditorPersona= ".$this->IdEditorPersona.",IdEntregableFormatoLibro = ".$this->IdEntregableDF.$rutaEntregable.",Titulo='".$this->Titulo."',IdConceptoLibro = ".$this->IdConceptoLibro.",IdInstitucionesLibro = ".$this->IdInstitucionesLibro.",IdSoporte = ".$this->IdSoporte.",IdTipoPublicacion = ".$this->IdTipoPublicacion.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion =now(),Pantalla ='".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

		$catalogo = new Catalogo();

		//echo "<br>".$insert."<br>";
		$query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_formatoLibro', 'IdLibro = ' . $this->IdLibro);

        if ($query == 1) {
            return true;
        }
        return false;
	}
	public function agregarDefinirFormato(){
        $rutaEntregable = "";

		/*if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }*/
        if (!isset($this->IdConceptoLibro) || $this->IdConceptoLibro == NULL || $this->IdConceptoLibro == ""){
            $this->IdConceptoLibro = "NULL";
        }
        if (!isset($this->IdInstitucionesLibro) || $this->IdInstitucionesLibro == NULL || $this->IdInstitucionesLibro == ""){
            $this->IdInstitucionesLibro = "NULL";
        }
        if (!isset($this->IdSoporte) || $this->IdSoporte == NULL || $this->IdSoporte == ""){
            $this->IdSoporte = "NULL";
        }
        if (!isset($this->IdTipoPublicacion) || $this->IdTipoPublicacion == NULL || $this->IdTipoPublicacion == ""){
            $this->IdTipoPublicacion = "NULL";
        }
        if (!isset($this->IdEditorPersona) || $this->IdEditorPersona == NULL || $this->IdEditorPersona == ""){
            $this->IdEditorPersona = "NULL";
        }
        if (!isset($this->IdEntregableDF) || $this->IdEntregableDF == NULL || $this->IdEntregableDF == ""){
            $this->IdEntregableDF = "NULL";
        }
        if (!isset($this->RutaEntregableDF) || $this->RutaEntregableDF == NULL || $this->RutaEntregableDF == ""){
            //$this->PDF = "NULL";
            $rutaEntregable = "NULL";
        }else{
            $rutaEntregable =  "'".$this->RutaEntregableDF."'";
        }
        
		$insert ="INSERT INTO c_formatoLibro (IdLibro,IdEditorPersona,IdEntregableFormatoLibro,RutaEntregableFormatoLibro,Titulo,IdConceptoLibro,IdInstitucionesLibro,IdSoporte,IdTipoPublicacion,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdEditorPersona.",".$this->IdEntregableDF.",".$rutaEntregable.",'".$this->Titulo."',".$this->IdConceptoLibro.",".$this->IdInstitucionesLibro.",".$this->IdSoporte.",".$this->IdTipoPublicacion.",'".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

		$catalogo = new Catalogo();
        //echo "<br>".$insert."<br>";
  		$this->IdFormatoLibro = $catalogo->insertarRegistro($insert);

        if ($this->IdFormatoLibro == 0 || $this->IdFormatoLibro == null) {
            return false;
        }
        return true;
	}

	public function agregarCoedicion(){

		$insert ="INSERT INTO k_coeditorFormatoLibro (IdFormatoLibro,IdCoeditor) VALUES (".$this->IdFormatoLibro.",".$this->Coedicion.");";

		$catalogo = new Catalogo();
        //echo "<br>".$insert."<br>";
  		$this->IdCoeditorFormatoLibro = $catalogo->insertarRegistro($insert);

        if ($this->IdCoeditorFormatoLibro == 0 || $this->IdCoeditorFormatoLibro == null) {
            return false;
        }
        return true;
	}
    public function eliminarCoedicion(){
    	$catalogo = new Catalogo();
        $consulta = "delete from k_coeditorFormatoLibro WHERE IdFormatoLibro =". $this->IdFormatoLibro.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_coeditorFormatoLibro", "IdFormatoLibro = " . $this->IdFormatoLibro);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
	public function getIdLibro()
	{
	    return $this->IdLibro;
	}

	public function setIdLibro($IdLibro)
	{
	    $this->IdLibro = $IdLibro;

	}
	

    public function getIdExposicion()
	{
	    return $this->IdExposicion;
	}

	public function setIdExposicion($IdExposicion)
	{
	    $this->IdExposicion = $IdExposicion;

	}

    public function getIdPeriodo()
	{
	    return $this->IdPeriodo;
	}

	public function setIdPeriodo($IdPeriodo)
	{
	    $this->IdPeriodo = $IdPeriodo;

	}

	public function getTitulo()
	{
	    return $this->Titulo;
	}

	public function setTitulo($Titulo)
	{
	    $this->Titulo = $Titulo;

	}

	public function getIdEje()
	{
	    return $this->IdEje;
	}

	public function setIdEje($IdEje)
	{
	    $this->IdEje = $IdEje;

	}

	public function getIdActividad()
	{
	    return $this->IdActividad;
	}

	public function setIdActividad($IdActividad)
	{
	    $this->IdActividad = $IdActividad;

	}

	public function getImagen()
	{
	    return $this->Imagen;
	}

	public function setImagen($Imagen)
	{
	    $this->Imagen = $Imagen;

	}

	public function getPDF()
	{
	    return $this->PDF;
	}

	public function setPDF($PDF)
	{
	    $this->PDF = $PDF;

	}

	public function getISBN()
	{
	    return $this->ISBN;
	}

	public function setISBN($ISBN)
	{
	    $this->ISBN = $ISBN;

	}

	public function getResena()
	{
	    return $this->Resena;
	}

	public function setResena($Resena)
	{
	    $this->Resena = $Resena;

	}

	public function getIdEditorPersona()
	{
	    return $this->IdEditorPersona;
	}

	public function setIdEditorPersona($IdEditorPersona)
	{
	    $this->IdEditorPersona = $IdEditorPersona;

	}

	public function getIdConceptoLibro()
	{
	    return $this->IdConceptoLibro;
	}

	public function setIdConceptoLibro($IdConceptoLibro)
	{
	    $this->IdConceptoLibro = $IdConceptoLibro;

	}

	public function getIdInstitucionesLibro()
	{
	    return $this->IdInstitucionesLibro;
	}

	public function setIdInstitucionesLibro($IdInstitucionesLibro)
	{
	    $this->IdInstitucionesLibro = $IdInstitucionesLibro;

	}

	public function getIdSoporte()
	{
	    return $this->IdSoporte;
	}

	public function setIdSoporte($IdSoporte)
	{
	    $this->IdSoporte = $IdSoporte;

	}

	public function getUsuarioCreacion()
	{
	    return $this->UsuarioCreacion;
	}

	public function setUsuarioCreacion($UsuarioCreacion)
	{
	    $this->UsuarioCreacion = $UsuarioCreacion;

	}

	public function getFechaCreacion()
	{
	    return $this->FechaCreacion;
	}

	public function setFechaCreacion($FechaCreacion)
	{
	    $this->FechaCreacion = $FechaCreacion;

	}

	public function getUsuarioUltimaModificiacion()
	{
	    return $this->UsuarioUltimaModificiacion;
	}

	public function setUsuarioUltimaModificiacion($UsuarioUltimaModificiacion)
	{
	    $this->UsuarioUltimaModificiacion = $UsuarioUltimaModificiacion;

	}

	public function getFechaUltimaModificacion()
	{
	    return $this->FechaUltimaModificacion;
	}

	public function setFechaUltimaModificacion($FechaUltimaModificacion)
	{
	    $this->FechaUltimaModificacion = $FechaUltimaModificacion;

	}

	public function getPantalla()
	{
	    return $this->Pantalla;
	}

	public function setPantalla($Pantalla)
	{
	    $this->Pantalla = $Pantalla;

	}

	public function getIdFormatoLibro()
	{
	    return $this->IdFormatoLibro;
	}

	public function setIdFormatoLibro($IdFormatoLibro)
	{
	    $this->IdFormatoLibro = $IdFormatoLibro;

	}

	public function getIdTipoPublicacion()
	{
	    return $this->IdTipoPublicacion;
	}

	public function setIdTipoPublicacion($IdTipoPublicacion)
	{
	    $this->IdTipoPublicacion = $IdTipoPublicacion;

	}

	public function getCoedicion()
	{
	    return $this->Coedicion;
	}

	public function setCoedicion($Coedicion)
	{
	    $this->Coedicion = $Coedicion;

	}

	public function getISSN()
	{
	    return $this->ISSN;
	}

	public function setISSN($ISSN)
	{
	    $this->ISSN = $ISSN;

	}
	public function getPDFindice()
	{
	    return $this->PDFindice;
	}

	public function setPDFindice($PDFindice)
	{
	    $this->PDFindice = $PDFindice;

	}
	public function getPDFpag3Texto()
	{
	    return $this->PDFpag3Texto;
	}

	public function setPDFpag3Texto($PDFpag3Texto)
	{
	    $this->PDFpag3Texto = $PDFpag3Texto;

	}
	public function getEstado()
	{
	    return $this->Estado;
	}

	public function setEstado($Estado)
	{
	    $this->Estado = $Estado;

	}

    public function setIdEntregableDF($IdEntregableDF){

        $this->IdEntregableDF = $IdEntregableDF;
    }

    public function getIdEntregableDF()
    {
        return $this->IdEntregableDF;
    }

    public function setRutaEntregableDF($RutaEntregableDF){

        $this->RutaEntregableDF = $RutaEntregableDF;
    }

    public function getRutaEntregableDF()
    {
        return $this->RutaEntregableDF;
    }

    public function getAnioPublicacion(){
        return $this->anioPublicacion;
    }

    public function setAnioPublicacion($anioPublicacion){

        $this->anioPublicacion = $anioPublicacion;
    }   
    
}

?>