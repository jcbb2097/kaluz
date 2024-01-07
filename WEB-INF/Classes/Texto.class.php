<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class Texto{
	private $nombre;
	private $descripcion;
	private $tf;
    public function getTexto(){
    	$catalogo = new catalogo();
    	  $consultaP = "SELECT * FROM c_textosLibro WHERE IdTexto = " . $this->textoid." ";
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->IdLibro = $row['IdLibro'];
			$this->titulo = $row['tituloTexto'];
            $this->cuartillas = $row['numCuartillas'];
            $this->autor = $row['id_Personas'];
            $this->Tipo_texto = $row['IdTipoTexto'];
            $this->idioma_original = $row['IdiomaOriginal'];
            $this->idioma_traducir = $row['IdiomaATraducir'];
            $this->imagen=$row['imagen'];
    		return true;
    	}
    	return false;
    }

    public function newTexto(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_textosLibro (IdLibro, tituloTexto, numCuartillas, IdTipoTexto, IdiomaOriginal, IdiomaATraducir, FechaCreacion, UsuarioCreacion,FechaUltimaModificacion,UsuarioUltimaModificacion, pantalla, imagen, RutaImagen)
    	VALUES ('".$this->libro."','".$this->titulo."', '".$this->cuartillas."', '".$this->Tipo_texto."', '".$this->idioma_original."', '".$this->idioma_traducir."', NOW(), 'sistemas',NOW(), 'sistemas','alta_texto.php', '".$this->imagen."', '".$this->RutaImagen."');";
    	// "<br><br>$insertarA<br><br>"; 
        $this->textoid = $catalogo->insertarRegistro($insertarA);
        if ($this->textoid == 0 || $this->textoid == null) {
            return false;
        }
        return true;
    }
    public function editTexto(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_textosLibro SET IdLibro='".$this->libro."',  tituloTexto='".$this->titulo."',
                    numCuartillas='".$this->cuartillas."', IdTipoTexto='".$this->Tipo_texto."', imagen='".$this->imagen."', 
                    RutaImagen='".$this->RutaImagen."', IdiomaOriginal='".$this->idioma_original."', 
                    IdiomaATraducir='".$this->idioma_traducir."' 
                    WHERE IdTexto ='".$this->textoid."' ";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_textosLibro', 'IdTexto = ' . $this->textoid);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function deleteTexto(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_textosLibro WHERE IdTexto = $this->textoid;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_textosLibro', 'IdTexto = ' . $this->textoid);
    	//echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }
    function getimagen(){
    	return $this->imagen;
    }
    function setimagen($imagen){
    	$this->imagen = $imagen;
    }
    function getRutaImagen(){
    	return $this->RutaImagen;
    }
    function setRutaImagen($RutaImagen){
    	$this->RutaImagen = $RutaImagen;
    }
    function gettextoid(){
    	return $this->textoid;
    }
    function settextoid($textoid){
    	$this->textoid = $textoid;
    }
	function getlibro(){
    	return $this->libro;
    }
    function setlibro($libro){
    	$this->libro = $libro;
    }
    function getautor(){
    	return $this->autor;
    }
    function setautor($autor){
    	$this->autor = $autor;
    }
    function gettitulo(){
    	return $this->titulo;
    }
    function settitulo($titulo){
    	$this->titulo = $titulo;
    }
    function gecuartillas(){
        return $this->cuartillas;
    }
    function setcuartillas($cuartillas){
        $this->cuartillas = $cuartillas;
    }
    function getTipo_texto(){
        return $this->Tipo_texto;
    }
    function setTipo_texto($Tipo_texto){
        $this->Tipo_texto = $Tipo_texto;
    }
    function getidioma_original(){
        return $this->idioma_original;
    }
    function setidioma_original($idioma_original){
        $this->idioma_original = $idioma_original;
    }
    function getidioma_traducir(){
        return $this->idioma_traducir;
    }
    function setidioma_traducir($idioma_traducir){
        $this->idioma_traducir = $idioma_traducir;
    }

}
?>