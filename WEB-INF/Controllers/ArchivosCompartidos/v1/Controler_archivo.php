<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/ArchivoCompartido.class.php");
include_once("../../Classes/AreaArchivo.class.php");
include_once("../../Classes/ActividadArchivo.class.php");
$obj = new ArchivoCompartido();
$obj2 = new actividades();
$obj3 = new Areas();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_usuario(0);
            $rutaimg = "resources/aplicaciones/imagenes/ArchivosCompartidos/";
            if (isset($_FILES[0])) {
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg . "(1)" . $archivo;
                    $namesoloimagen = "(1)" . $archivo;
                } else {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen = $resultado;
                }
                $obj->setPdfcedulafiscal($namesoloimagen);
                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                $obj->setPdfcedulafiscal("");
            }
            if(isset($parametros['link_pdf'])){//si es un link en vez de archivo
              $obj->setRuta($parametros['link_pdf']);
              $obj->setPdfcedulafiscal("link");
            }else{
              $obj->setRuta("../../../resources/aplicaciones/imagenes/ArchivosCompartidos/");
            }
            if(isset($parametros['ActvGlobal']))if($parametros['ActvGlobal'] != "")$obj->setId_actividad1($parametros['ActvGlobal']);
            if(isset($parametros['ActvGeneral']))if($parametros['ActvGeneral'] != "")$obj->setId_actividad1($parametros['ActvGeneral']);
            if(isset($parametros['ActvParticular']))if($parametros['ActvParticular'] != "")$obj->setId_actividad1($parametros['ActvParticular']);
            if(isset($parametros['SubActividad']))if($parametros['SubActividad'] != "")$obj->setId_actividad1($parametros['SubActividad']);
            $obj->setUsuarioCreacion($parametros['usuario']);
            $obj->setUsuarioUltimaModificacion($parametros['usuario']);
            $obj->setId_usuario($parametros['idUsuario']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setId_area($parametros['area']);
            $obj->setAnio($parametros['anio']);
            $obj->setId_tipo($parametros['categoria']);
            $variable = $parametros['tamanoArt'];
            $variable2 = $parametros['tamanoAreas'];
            $variableif = $variable + 1;
            $obj->setId_destino($variableif);
            $obj->setId_destino2($variable2);
            $obj->setUsuarioUltimaModificacion("SIE");
            $obj->setPantalla('AltaArchivo.php');
            if ($obj->nuevoAcuerdo()) {
                echo "Archivo guardado correctamente";
                if($parametros['detalle'] == 1)//solo en el caso que sea necesario
                    $obj->nuevo_detalle_acuerdo();
                if ($variable >= 0) {
                    $IDIndicador = $obj->getId_documento();
                    $obj2->setId_archivo($IDIndicador);
                    $obj2->setId_actividad1($parametros['ActvGlobal']);
                    $obj2->setId_tipo($parametros['acme']);
                    $obj2->setId_proyecto($parametros['Eje']);

                    if (isset($parametros['ActvGeneral']) &&  $parametros['ActvGeneral'] != "") {
                        $obj2->setId_actividad2($parametros['ActvGeneral']);
                    } else {
                        $obj2->setId_actividad2("NULL");
                    }
                    if (isset($parametros['ActvParticular']) && $parametros['ActvParticular'] != "") {
                        $obj2->setId_actividad3($parametros['ActvParticular']);
                    } else {
                        $obj2->setId_actividad3("NULL");
                    }
                    if (isset($parametros['SubActividad']) && $parametros['SubActividad'] != "") {
                        $obj2->setId_actividad4($parametros['SubActividad']);
                    } else {
                        $obj2->setId_actividad4("NULL");
                    }
                    if ($obj2->acuerdoac()) {
                    }
                    for ($index = 0; $index < $variable; $index++) {
                        $obj2->setId_archivo($IDIndicador);
                        $obj2->setId_tipo($parametros['acme' . $index]);
                        $obj2->setId_actividad1($parametros['ActvGlobal' . $index]);
                        $obj2->setId_proyecto($parametros['Eje' . $index]);
                        if ($parametros['ActvGeneral' . $index] != "") {
                            $obj2->setId_actividad2($parametros['ActvGeneral' . $index]);
                        } else {
                            $obj2->setId_actividad2("NULL");
                        }
                        if ($parametros['ActvParticular' . $index] != "") {
                            $obj2->setId_actividad3($parametros['ActvParticular' . $index]);
                        } else {
                            $obj2->setId_actividad3("NULL");
                        }
                        if ($parametros['SubActividad' . $index] != "") {
                            $obj2->setId_actividad4($parametros['SubActividad' . $index]);
                        } else {
                            $obj2->setId_actividad4("NULL");
                        }

                    }
                }
                if ($variable2 > 0) {
                    $IDIndicador = $obj->getId_documento();
                    for ($index = 0; $index < $variable2; $index++) {
                        $obj3->setId_archivo($IDIndicador);
                        $obj3->setId_Area_invitada($parametros['invitados' . $index]);
                        if ($obj3->acuerdoareas()) {
                        }
                    }
                }
            } else {
                echo 'Error al guardar';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_documento($_POST['id']);
            $obj->setId_usuario(0);
            $rutaimg = "resources/aplicaciones/imagenes/ArchivosCompartidos/";
            if (isset($_FILES[0])) {
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg . "(1)" . $archivo;
                    $namesoloimagen = "(1)" . $archivo;
                } else {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen = $resultado;
                }
                $obj->setPdfcedulafiscal($namesoloimagen);
                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                $obj->setPdfcedulafiscal("");
            }
            if(isset($parametros['link_pdf'])){//si es un link en vez de archivo
              $obj->setRuta($parametros['link_pdf']);
              $obj->setPdfcedulafiscal("link");
            }else{
              $obj->setRuta("../../../resources/aplicaciones/imagenes/ArchivosCompartidos/");
            }
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setId_area($parametros['area']);
            $obj->setAnio($parametros['anio']);
            $obj->setId_tipo($parametros['categoria']);
            $variable = $parametros['tamanoArt'];
            $variable2 = $parametros['tamanoAreas'];
            $obj->setId_destino($variable);
            $obj->setId_destino2($variable2);
            $obj->setUsuarioUltimaModificacion("SIE");
            if ($obj->editaracuerdo()) {
                if ($variable >= 0) {
                    $IDIndicador = $_POST['id'];
                    $obj3->setId_Archivo($IDIndicador);
                    if ($obj3->Eliminarea()) {
                        $obj2->setId_archivo($IDIndicador);
                        if ($obj2->Eliminaractividad()) {
                        }
                    }
                    for ($index = 0; $index < $variable; $index++) {
                        $IDIndicador = $_POST['id'];
                        $obj2->setId_archivo($IDIndicador);
                        $obj2->setId_tipo($parametros['acme' . $index]);
                        $obj2->setId_actividad1($parametros['ActvGlobal' . $index]);
                        $obj2->setId_proyecto($parametros['Eje' . $index]);
                        if ($parametros['ActvGeneral' . $index] != "") {
                            $obj2->setId_actividad2($parametros['ActvGeneral' . $index]);
                        } else {
                            $obj2->setId_actividad2("NULL");
                        }
                        if ($parametros['ActvParticular' . $index] != "") {
                            $obj2->setId_actividad3($parametros['ActvParticular' . $index]);
                        } else {
                            $obj2->setId_actividad3("NULL");
                        }
                        if ($parametros['SubActividad' . $index] != "") {
                            $obj2->setId_actividad4($parametros['SubActividad' . $index]);
                        } else {
                            $obj2->setId_actividad4("NULL");
                        }
                        if ($obj2->acuerdoac()) {

                        }
                    }
                    if ($variable2 > 0) {
                        $IDIndicador = $_POST['id'];
                        for ($index = 0; $index < $variable2; $index++) {
                            $obj3->setId_Archivo($IDIndicador);
                            $obj3->setId_Area_invitada($parametros['invitados' . $index]);
                            if ($obj3->acuerdoareas()) {

                            }
                        }
                    }

                }

                echo 'Éxito: El Archivo a sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Archivo';
            }

           // echo 'entra a editar';
            break;
        case 'eliminar':
            $obj3->setId_Archivo($_POST['id']);
            if ($obj3->Eliminarea()) {

                $obj2->setId_archivo($_POST['id']);
                if ($obj2->Eliminaractividad()) {
                    $obj->setId_documento($_POST['id']);
                }
                $obj->eliminardetalle_doc();//elimina de la tabla de specif_version
                if ($obj->eliminarAcuerdo()) {
                  echo 'Éxito: Se ha eliminado el Archivo';
                }else{
                  echo 'Error: No se ha podido eliminar el Archivo';
                }

            } else {
                echo 'Error: No se ha podido eliminar el Archivo';
            }
            break;
    }
}
