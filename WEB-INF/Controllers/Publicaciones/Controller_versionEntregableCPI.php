<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../Classes/ArchivoCompartido.class.php');
include_once('../../Classes/entregableEspecificoVersion.class.php');
include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$objEV = new EntregableEspecificoVersion();
$objAC = new ArchivoCompartido();
$fechaHora = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s");
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //echo "Entra";
            /*************c_documento******************/ /////////////    
            $IdArchPreliminar = "";
            $exito = false;

            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setUsuarioCreacion($_POST['usuario']);
            $objAC->setPantalla('Controller_carpetaPresentacion(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anioVer']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            $objAC->setDescripcion('Archivo Carpeta Presentacion Índice Preliminar del libro ' . $parametros['tituloVer'] . '. Versión_' . $fechaHora);
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarIndiceCarpeta/Preliminar/";
            $agregoArchivo = false;

            if (isset($_FILES[4])) {
                $agregoArchivo = true;
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[4]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[4]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[4]['name'];

                    $nameimg = $rutaPDF . "(" . $fechaHora . ")" . $archivo;
                    //$count =1;
                    $namesoloimagen = "(" . $fechaHora . ")" . $archivo;
                } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[4]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[4]['name'];

                    $nameimg = $rutaPDF . "(" . $fechaHora . ")" . $resultado;
                    $namesoloimagen = "(" . $fechaHora . ")" . $resultado;
                }

                $objAC->setPdfcedulafiscal($namesoloimagen);

                move_uploaded_file($_FILES[4]['tmp_name'], "../../../" . $nameimg);
            } else {
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }

            if ($agregoArchivo) {
                if ($objAC->nuevoAcuerdo()) {
                    $IdArchPreliminar = $objAC->getId_documento();
                    $exito = true;
                } else {
                    echo 'Warning: El archivo para La versión del entregable <b>Carpeta Presentacion  Preliminar de libro <i>' . $parametros['tituloVer'] . '</i></b> no se generó, intente nuevamente';
                    //return;
                }
            }

            $objEV->setIdEntregableEspecifico($parametros['IdEntregableEspVer']);
            $objEV->setIdArchivoPreliminar($IdArchPreliminar);

            if ($exito && $objEV->agregarEntregableEspecificoVersion()) {
                echo 'Éxito: Se guardo correctamente';
            } else {
                echo 'Error: No se pudo guardar el archivo';
            }

            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }


            break;
       case 'eliminar':

        $objEV->setIdEntregableEspecifico($_POST['IdEntregableEspVer']);
        $objEV->setIdArchivoPreliminar($_POST['IdArchivoPreliminar']); 
        $objAC->setId_documento($_POST['IdArchivoPreliminar']);
        $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/ElaborarIndiceCarpeta/Preliminar/";
        $objAC->getAcuerdo();
        $rutaConNameFile = $ruta.$objAC->getPdfcedulafiscal();
        if($objEV->eliminarEntregableEspecificoVersion()){
            
            if(unlink($rutaConNameFile) && $objAC->eliminarAcuerdo()){
                echo 'Éxito: Eliminado correctamente';
            }else{
                echo 'Error: No se pudo eliminar el archivo';
            }
        }else{
            echo 'Error: No se pudo eliminar la relación del archivo con la versión del archivo'; 
        }

        break;
    }
}