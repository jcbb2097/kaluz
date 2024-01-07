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
$año = date("Y");
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $id_formulario = $parametros['formulario'];
            $agregoArchivo = false;
            $IdArchPreliminar = "";
            $exito = false;
            if ($id_formulario == 1) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
                $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            } elseif ($id_formulario == 2) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirContenidos/Preliminar/";
                $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirContenidos/Preliminar/";
            } elseif ($id_formulario == 3) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirCaracTecnicas/Preliminar/";
                $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirCaracTecnicas/Preliminar/";
            } elseif ($id_formulario == 4) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Preliminar/";
                $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Preliminar/";
            } elseif ($id_formulario == 5) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/ElaborarRutaCritica/Preliminar/";
            } elseif ($id_formulario == 6) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/Preliminar/";
            } elseif ($id_formulario == 7) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            } else {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            }
            $objAC->setUsuarioUltimaModificacion($_POST['usuario']);
            $objAC->setUsuarioCreacion($_POST['usuario']);
            $objAC->setPantalla('Controller_definirContenidos(Publicaciones)');
            $objAC->setId_usuario('NULL');
            $objAC->setAnio($parametros['anioVer']);
            $objAC->setId_tipo('9');
            $objAC->setId_area('16');
            $objAC->setId_destino('NULL');
            $objAC->setId_destino2('NULL');
            $objAC->setDescripcion('Archivo Realizar indice Preliminar del libro ' . $parametros['tituloVer']);
            // echo'Archivo Realizar indice Preliminar del libro '.$parametros['tituloVer'];
            $objAC->setRuta($ruta);

            if (isset($_FILES[2])) {
                $agregoArchivo = true;
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[2]['name'])) {
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF . "(" . $fechaHora . ")" . $archivo;
                    //$count =1;
                    $namesoloimagen = "(" . $fechaHora . ")" . $archivo;
                } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF . "(" . $fechaHora . ")" . $resultado;
                    $namesoloimagen = "(" . $fechaHora . ")" . $resultado;
                }

                $objAC->setPdfcedulafiscal($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                $agregoArchivo = false;
                $objAC->setPdfcedulafiscal("");
            }
            if ($agregoArchivo) {
                if ($objAC->nuevoAcuerdo()) {
                    $IdArchPreliminar = $objAC->getId_documento();
                    $exito = true;
                    $objEV->setIdEntregableEspecifico($parametros['IdEntregableEspVer']);
                    $objEV->setIdArchivoPreliminar($IdArchPreliminar);
                    $objEV->agregarEntregableEspecificoVersion();
                    echo "<br>El archivo del entregable <b><i>Realizar indice preliminar (Preliminar)</i></b> ha sido modificado";
                } else {
                    echo 'Error: El archivo para el entregable <b>Realizar indice Preliminar (Preliminar) de libro<i>' . $parametros['tituloVer'] . '</i></b> no se generó, intente nuevamente';
                }
            }
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }


            break;
        case 'eliminar':
            $id_formulario = $_POST['formulario'];
            $objEV->setIdEntregableEspecifico($_POST['IdEntregableEspVer']);
            $objEV->setIdArchivoPreliminar($_POST['IdArchivoPreliminar']);
            if ($id_formulario == 1) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            } elseif ($id_formulario == 2) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirContenidos/Preliminar/";
            } elseif ($id_formulario == 3) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirCaracTecnicas/Preliminar/";
            } elseif ($id_formulario == 4) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirColaboradores/Preliminar/";
            } elseif ($id_formulario == 5) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/ElaborarRutaCritica/Preliminar/";
            } elseif ($id_formulario == 6) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/ElaborarCarpetaPresentacion/Preliminar/";
            } elseif ($id_formulario == 7) {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            } else {
                $ruta = "../../../resources/aplicaciones/Entregables/Publicaciones/DefinirFormato/Preliminar/";
            }
            $objAC->setId_documento($_POST['IdArchivoPreliminar']);
            $objAC->getAcuerdo();
            $rutaConNameFile = $ruta . $objAC->getPdfcedulafiscal();
            //echo$rutaConNameFile;
            if ($objEV->eliminarEntregableEspecificoVersion()) {
                echo 'Archivo eliminado';
                if (unlink($rutaConNameFile)) {
                    echo 'Éxito: Eliminado correctamente';
                } else {
                    echo 'Error: No se pudo eliminar el archivo';
                }
                $objAC->setId_documento($_POST['IdArchivoPreliminar']);
                $objAC->eliminarAcuerdo();
            } else {
                echo 'Error: No se pudo eliminar la relación del archivo con la versión del archivo';
            }

            break;
    }
}
