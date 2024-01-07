<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class Noticias{
	private $idNoticia;
	private $fnoticia;
	private $titulo;
	private $autor;
	private $resumen;
	private $url;
	private $lugarn;
	private $tnoticia;
	private $snoticia;
	private $tmedio;
	private $genero;
	private $medio;
	private $etapa;
	private $calif;
	private $fpub;
	private $fview;
	private $UsrCreacion;
	private $FechaCreacion;
	private $UsrModificacion;
	private $FechaModificacion;
	private $idEje;
	private $idArea;
	private $idAct;
	private $expo;
	private $evento;
	private $archivo;
	private $ruta;
	//private $pantalla;
	private $precio;
	private $comercial;
	private $precioreal;
	private $analisis;
	private $origen;
	private $variable1;

	public function getNoticias(){
		$catalogo = new Catalogo();
		$consulta = "SELECT * FROM c_noticia WHERE idNoticia = " . $this->idNoticia;
		$result = $catalogo->obtenerLista($consulta);
		while ($rs = mysqli_fetch_array($result)) {
			$this->idNoticia = $rs['idNoticia'];
			$this->fnoticia = $rs['FechaNoticia'];
			$this->titulo = $rs['Titulo'];
			$this->analisis = $rs['Analisis'];
			$this->autor = $rs['idAutor'];
			$this->resumen = $rs['Resumen'];
			$this->url = $rs['Url'];
			$this->lugarn = $rs['idLugarNoticia'];
			$this->tnoticia = $rs['idTipo'];
			$this->snoticia = $rs['idSoporte'];
			$this->tmedio = $rs['idTipoMedio'];
			$this->genero = $rs['idGenero'];
			$this->medio = $rs['idMedio'];
			$this->etapa = $rs['idEtapa'];
			$this->calif = $rs['idCalificacion'];
			$this->fpub = $rs['FechaPublicacion'];
			$this->fview = $rs['FechaCaducidad'];
			$this->UsrCreacion = $rs['UsuarioCreacion'];
			$this->FechaCreacion = $rs['FechaCreacion'];
			$this->UsrModificacion = $rs['UsuarioModificacion'];
			$this->FechaModificacion = $rs['FechaModificacion'];
			$this->idEje = $rs['idEje'];
			$this->idArea = $rs['idArea'];
			$this->idAct = $rs['idActividad'];
			$this->expo = $rs['idExposicion'];
			$this->evento = $rs['idEvento'];
			$this->archivo = $rs['Archivo'];
			$this->ruta = $rs['RutaArchivo'];
			$this->precio = $rs['Precio'];
			$this->comercial = $rs['Reach'];
			$this->precioreal = $rs['PrecioReal'];

			$this->origen = $rs['Origen'];
			$this->variable1 = $rs['Variable1'];
			return true;
		}
		return false;
	}

	public function agregarNoticia(){
		if (!isset($this->tnoticia) || $this->tnoticia == ""){
            $this->tnoticia = NULL;
        }
        if (!isset($this->genero) || $this->genero == ""){
            $this->genero = NULL;
        }
        if (!isset($this->snoticia) || $this->snoticia == ""){
            $this->snoticia = NULL;
        }
        if (!isset($this->autor) || $this->autor == ""){
            $this->autor = NULL;
        }
        if (!isset($this->expo) || $this->expo == ""){
            $this->expo = 'NULL';
        }
        if (!isset($this->evento) || $this->evento == ""){
            $this->evento = 'NULL';
        }
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO c_noticia (Titulo,Analisis, FechaPublicacion ,idMedio, idTipoMedio, Url, idLugarNoticia, idEtapa, idCalificacion, Activo, Resumen, idAutor,idTipo, idGenero, FechaNoticia,FechaCaducidad, UsuarioCreacion, FechaCreacion, UsuarioModificacion, FechaModificacion,idSoporte, idEje, idArea, idActividad, idExposicion, idEvento, Archivo, RutaArchivo,Precio,Reach,PrecioReal ,Origen,Variable1)
		 VALUES('".$this->titulo."','".$this->analisis."','".$this->fpub."',".$this->medio.",".$this->tmedio.",'".$this->url."', ".$this->lugarn.", ".$this->etapa.", ".$this->calif.", NULL, '".$this->resumen."', ".$this->autor.",".$this->tnoticia.", ".$this->genero.", '".$this->fnoticia."',".$this->fview.", '".$this->UsrCreacion."', NOW(), '".$this->UsrModificacion."', NOW(),
		  ".$this->snoticia.", ".$this->idEje.", ".$this->idArea.", ".$this->idAct.", ".$this->expo.", ".$this->evento.",'" . $this->archivo . "','" . $this->ruta . "', ".$this->precio.", ".$this->comercial.", ".$this->precioreal.", ".$this->origen.", ".$this->variable1.");";
		$this->idNoticia = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idNoticia == 0 || $this->idNoticia == null) {
            return false;
        }
        return true;
	}

	public function editarNoticia(){
		if (!isset($this->tnoticia) || $this->tnoticia == ""){
            $this->tnoticia = NULL;
        }
        if (!isset($this->genero) || $this->genero == ""){
            $this->genero = NULL;
        }
        if (!isset($this->snoticia) || $this->snoticia == ""){
            $this->snoticia = NULL;
        }
        if (!isset($this->autor) || $this->autor == ""){
            $this->autor = NULL;
        }
        if (!isset($this->expo) || $this->expo == ""){
            $this->expo = 'NULL';
        }
        if (!isset($this->evento) || $this->evento == ""){
            $this->evento = 'NULL';
        }
		$catalogo = new Catalogo();
		$consulta = "UPDATE c_noticia SET Titulo = '".$this->titulo."', Analisis = '".$this->analisis."' ,FechaPublicacion = '".$this->fpub."', idMedio =".$this->medio.", idTipoMedio=".$this->tmedio.", Url='".$this->url."',  idLugarNoticia=".$this->lugarn.", idEtapa=".$this->etapa.", idCalificacion=".$this->calif.", Activo=NULL, Resumen='".$this->resumen."', idAutor=".$this->autor.",idTipo=".$this->tnoticia.", idGenero=".$this->genero.", FechaNoticia='".$this->fnoticia."',
		FechaCaducidad =".$this->fview.",UsuarioModificacion='".$this->UsrModificacion."', FechaModificacion=NOW(), idSoporte=".$this->snoticia.",idEje=".$this->idEje.", idArea=".$this->idArea.", idActividad=".$this->idAct.", idExposicion=".$this->expo.", idEvento=".$this->evento.", Archivo='".$this->archivo."', RutaArchivo='".$this->ruta."', Precio=".$this->precio.", Reach=".$this->comercial.", PrecioReal=".$this->precioreal.",Origen = ".$this->origen.",Variable1 = ".$this->variable1." WHERE idNoticia =". $this->idNoticia;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_noticia', 'idNoticia = ' . $this->idNoticia);
      //  echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarNoticia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_noticia WHERE idNoticia =" . $this->idNoticia;
		//echo $delete;
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_noticia", "idNoticia = " . $this->idNoticia);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}
	public function new_urlnoticia(){
		$catalogo = new Catalogo();
		$consulta = "INSERT INTO k_url_noticia (Id_noticia, url) VALUES('".$this->idNoticia."','".$this->url."');";
		$this->idurl = $catalogo->insertarRegistro($consulta);
		//echo "Insertar: " . $consulta;
		if ($this->idurl == 0 || $this->idurl == null) {
            return false;
        }
        return true;
	}

	public function editarurlNoticia(){
		$catalogo = new Catalogo();
		$consulta = "UPDATE k_url_noticia SET url = '".$this->url."' WHERE Id_noticia =". $this->idNoticia;
		$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_url_noticia ', 'Id_noticia = ' . $this->idNoticia);
        //echo "<br>EDITAR:  " . $consulta;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	function getIdurl(){
		return $this->idurl;
	}
	function setIdurl($idNoticia){
		$this->idurl = $idurl;
	}
	function getidNoticia(){
		return $this->idNoticia;
	}
	function setidNoticia($idNoticia){
		$this->idNoticia = $idNoticia;
	}

	function getfnoticia(){
		return $this->fnoticia;
	}
	function setfnoticia($fnoticia){
		$this->fnoticia = $fnoticia;
	}

	function gettitulo(){
		return $this->titulo;
	}
	function settitulo($titulo){
		$this->titulo = $titulo;
	}

	function getautor(){
		return $this->autor;
	}
	function setautor($autor){
		$this->autor = $autor;
	}

	function getresumen(){
		return $this->resumen;
	}
	function setresumen($resumen){
		$this->resumen = $resumen;
	}

	function geturl(){
		return $this->url;
	}
	function seturl($url){
		$this->url = $url;
	}

	function getlugarn(){
		return $this->lugarn;
	}
	function setlugarn($lugarn){
		$this->lugarn = $lugarn;
	}

	function gettnoticia(){
		return $this->tnoticia;
	}
	function settnoticia($tnoticia){
		$this->tnoticia = $tnoticia;
	}

	function getsnoticia(){
		return $this->snoticia;
	}
	function setsnoticia($snoticia){
		$this->snoticia = $snoticia;
	}

	function gettmedio(){
		return $this->tmedio;
	}
	function settmedio($tmedio){
		$this->tmedio = $tmedio;
	}

	function getgenero(){
		return $this->genero;
	}
	function setgenero($genero){
		$this->genero = $genero;
	}

	function getmedio(){
		return $this->medio;
	}
	function setmedio($medio){
		$this->medio = $medio;
	}

	function getetapa(){
		return $this->etapa;
	}
	function setetapa($etapa){
		$this->etapa = $etapa;
	}

	function getcalif(){
		return $this->calif;
	}
	function setcalif($calif){
		$this->calif = $calif;
	}

	function getfpub(){
		return $this->fpub;
	}
	function setfpub($fpub){
		$this->fpub = $fpub;
	}

	function getfview(){
		return $this->fview;
	}
	function setfview($fview){
		$this->fview = $fview;
	}

	function getUsrCreacion(){
		return $this->UsrCreacion;
	}
	function setUsrCreacion($UsrCreacion){
		$this->UsrCreacion = $UsrCreacion;
	}

	function getFechaCreacion(){
		return $this->FechaCreacion;
	}
	function setFechaCreacion($FechaCreacion){
		$this->FechaCreacion = $FechaCreacion;
	}

	function getUsrModificacion(){
		return $this->UsrModificacion;
	}
	function setUsrModificacion($UsrModificacion){
		$this->UsrModificacion = $UsrModificacion;
	}

	function getFechaModificacion(){
		return $this->FechaModificacion;
	}
	function setFechaModificacion($FechaModificacion){
		$this->FechaModificacion = $FechaModificacion;
	}

	function getidEje(){
		return $this->idEje;
	}
	function setidEje($idEje){
		$this->idEje = $idEje;
	}

	function getidArea(){
		return $this->idArea;
	}
	function setidArea($idArea){
		$this->idArea = $idArea;
	}

	function getidAct(){
		return $this->idAct;
	}
	function setidAct($idAct){
		$this->idAct = $idAct;
	}

	function getExpo(){
		return $this->expo;
	}
	function setExpo($expo){
		$this->expo = $expo;
	}

	function getEvento(){
		return $this->evento;
	}
	function setEvento($evento){
		$this->evento = $evento;
	}

	function getArchivo(){
		return $this->archivo;
	}
	function setArchivo($archivo){
		$this->archivo = $archivo;
	}

	function getRutaArchivo(){
		return $this->ruta;
	}
	function setRutaArchivo($ruta){
		$this->ruta = $ruta;
	}

	function getPrecio(){
		return $this->precio;
	}
	function setPrecio($precio){
		$this->precio = $precio;
	}

	function getComercial(){
		return $this->comercial;
	}
	function setComercial($comercial){
		$this->comercial = $comercial;
	}

	function getPrecioReal(){
		return $this->precioreal;
	}
	function setPrecioReal($precioreal){
		$this->precioreal = $precioreal;
	}
	function getAnalisis(){
		return $this->analisis;
	}
	function setAnalisis($analisis){
		$this->analisis = $analisis;
	}

	function getVariable1(){
		return $this->variable1;
	}
	function setVariable1($variable1){
		$this->variable1 = $variable1;
	}

	function getOrigen(){
		return $this->origen;
	}
	function setOrigen($origen){
		$this->origen = $origen;
	}


}

?>
