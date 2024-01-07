<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/PVP.class.php');
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/Texto.class.php");
include_once("../../Classes/Personas.class.php");
$catalogo = new Catalogo();
$Texto= new Texto();
$Personas= new Persona();

if(isset($_POST['accion']) && $_POST['accion']=="nuevo"){
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $libro= $parametros['libro']; 
    $titulo=$parametros['titulo']; 
    $cuartillas=$parametros['cuartillas']; 
    $Tipo_texto=$parametros['Tipo_texto']; 
    $idioma_original=$parametros['idioma_original']; 
    $idioma_traducir=$parametros['idioma_traducir']; 
    $Texto->setlibro($libro);
    $Texto->settitulo($titulo);
    $Texto->setcuartillas($cuartillas);
    $Texto->setTipo_texto($Tipo_texto);
    $Texto->setidioma_original($idioma_original);
    $Texto->setidioma_traducir($idioma_traducir);
    $ruta2="/var/www/html/sie/vista/apps/Publicaciones/ImagenTexto/";
    $ruta="/vista/apps/Publicaciones/ImagenTexto/";
    
    $images=0;
    if (isset($_FILES[$images]) && !empty($_FILES[$images]) ) {		
        //echo $_FILES[$images]['name'];
        if (file_exists("../../../" . $ruta . $_FILES[$images]['name'])) {
            //echo "2";
            /*$cadena=$_FILES[$images]['name'];
            $cadena =str_replace(' ', '', $cadena);*/
            $archivo = $_FILES[$images]['name'];
            $resultado = str_replace(" ", "_",$archivo);
            $explode = explode('.',  $resultado);
            $extension = array_pop($explode);
            $nameimg = $ruta. $images . $archivo;
            $namesoloimagen= "$images".$archivo;
            $archivo="$images".$archivo;
            $abd=$images . $archivo;        
        }else{
            //echo "1	";
            $archivo = $_FILES[$images]['name'];
            $resultado = str_replace(" ", "_",$archivo);
            $explode = explode('.', $resultado);
            $extension = array_pop($explode);
            $nameimg = $ruta. $resultado;
            $namesoloimagen= $resultado;
            $abd=$images . $resultado;
        }
        move_uploaded_file($_FILES[$images]['tmp_name'], "../../../" . $nameimg);

    }else{
        $resultado="";
    }
    $Texto->setRutaImagen($ruta2);
    $Texto->setimagen($resultado);
    if($Texto->newTexto()){
            echo "Registro exitoso";

    }else{
        echo "Fallo el registro";
    }
}elseif(isset($_POST['accion']) && $_POST['accion']=="Editar"){
    $id_texto=$_POST['IdTexto'];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $ruta2="/var/www/html/sie/vista/apps/Publicaciones/ImagenTexto/";
    $ruta="/vista/apps/Publicaciones/ImagenTexto/";
    
    $images=0;
    if (isset($_FILES[$images]) && !empty($_FILES[$images]) ) {		
        //echo $_FILES[$images]['name'];
        if (file_exists("../../../" . $ruta . $_FILES[$images]['name'])) {
            //echo "2";
            /*$cadena=$_FILES[$images]['name'];
            $cadena =str_replace(' ', '', $cadena);*/
            $archivo = $_FILES[$images]['name'];
            $resultado = str_replace(" ", "_",$archivo);
            $explode = explode('.',  $resultado);
            $extension = array_pop($explode);
            $nameimg = $ruta. $images . $archivo;
            $namesoloimagen= "$images".$archivo;
            $archivo="$images".$archivo;
            $abd=$images . $archivo;        
        }else{
            //echo "1	";
            $archivo = $_FILES[$images]['name'];
            $resultado = str_replace(" ", "_",$archivo);
            $explode = explode('.', $resultado);
            $extension = array_pop($explode);
            $nameimg = $ruta. $resultado;
            $namesoloimagen= $resultado;
            $abd=$images . $resultado;
        }
        move_uploaded_file($_FILES[$images]['tmp_name'], "../../../" . $nameimg);

    }else{
        $resultado="";
    }

    $libro= $parametros['libro']; 
    $titulo=$parametros['titulo']; 
    $cuartillas=$parametros['cuartillas']; 
    $Tipo_texto=$parametros['Tipo_texto']; 
    $idioma_original=$parametros['idioma_original']; 
    $idioma_traducir=$parametros['idioma_traducir']; 
    $Texto->setRutaImagen($ruta2);
    $Texto->setimagen($resultado);
    $Texto->settextoid($_POST['IdTexto']);
    $Texto->setlibro($libro);
    $Texto->settitulo($titulo);
    $Texto->setcuartillas($cuartillas);
    $Texto->setTipo_texto($Tipo_texto);
    $Texto->setidioma_original($idioma_original);
    $Texto->setidioma_traducir($idioma_traducir);
    if($Texto->editTexto()){
        echo "Edición exitosa";
    }else{
        echo "Error: Fallo el registro";
    }

}elseif(isset($_POST['accion']) && $_POST['accion']=="Eliminar"){
    $id_texto=$_POST['IdTexto'];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $Texto->settextoid($_POST['IdTexto']);
    if($Texto->deleteTexto()){
        echo "Eliminación exitosa";
    }

}elseif(isset($_POST['Buscar']) && $_POST['Buscar']=="Buscar"){
    $IdTexto=$_POST['IdTexto'];
    $Texto->settextoid($IdTexto);
    $Texto->getTexto();
    echo $Texto->getautor()."/*".$Texto->gettitulo()."/*"
        .$Texto->gecuartillas()."/*".$Texto->getTipo_texto()."/*".
        $Texto->getidioma_original()."/*".$Texto->getidioma_traducir()."/*".$Texto->getimagen();
}
?>