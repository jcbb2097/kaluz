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
$Global = "";
$General = "";
$Particular = "";
$Sub = "";
$entregable_final = 0;
$tipo_entregable = "";
$variable = "";
$variable2 = "";
$variableedit = "";
$ruta = "";
$idcategoria = "";
$check_list = "";
$sub_check_list = "";
$id_check = 0;
$id_actividad = "";

if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) { //aqui se tranforma los campos del formulario a parametros
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //aqui asignamos si es categoria o subcategoria al entregable
            if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                $obj->setIdCategoriadeEje($parametros['subcate']);
                $idcategoria = $parametros['subcate'];
            } else {
                $obj->setIdCategoriadeEje($parametros['cate']);
                $idcategoria = $parametros['cate'];
            }
            //aqui asignamos comprobamos si check y subcheck tienen valor 
            if (isset($parametros['Check']) && $parametros['Check'] != "" && $parametros['Check'] > 0) {
                $check_list = $parametros['Check'];
            }
            if (isset($parametros['subCheck']) && $parametros['subCheck'] != "" && $parametros['subCheck'] > 0) {
                $sub_check_list = $parametros['subCheck'];
            }
            //aqui asignamos si es check o subcheck 
            if ($sub_check_list > 0 && $check_list > 0) {
                $id_check = $parametros['subCheck'];
            } else {
                $id_check = $parametros['Check'];
            }
            //obtenemos el tipo de entregable para buscar en la bd que no exista mas de un final o inicial de cada actividad
            $tipo_entregable = $parametros['categoria'];
            if ($tipo_entregable == 10 || $tipo_entregable == 9) {
                //funcion que busca si existe
                $entregable_final = $obj->Entregable_final($parametros['ActvGlobal'], $tipo_entregable, $idcategoria, $id_check);
            }
            if (isset($parametros['link_pdf']) &&  $parametros['link_pdf'] != "") {
                $obj->setRuta($parametros['link_pdf']);
                $obj->setPdfcedulafiscal("link");
            } else {
                $rutaimg = $obj->ruta_guardar($tipo_entregable);
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
                    $obj->setRuta("../../.." . $rutaimg . "");
                    move_uploaded_file($_FILES[0]['tmp_name'], "../../.." . $nameimg);
                } else {
                    $obj->setPdfcedulafiscal("");
                }
            }
            $variable = $parametros['tamanoArt'];
            $variable2 = $parametros['tamanoAreas'];
            $obj->setId_usuario($parametros['idUsuario']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $obj->setId_area($parametros['area']);
            $obj->setUsuarioCreacion($parametros['usuario']);
            $obj->setUsuarioUltimaModificacion($parametros['usuario']);
            $obj->setPantalla('Controller_archivo.php');
            $obj->setId_check($id_check);
            if ($entregable_final <= 0) {
                if ($obj->nuevoAcuerdo()) {
                    if ($parametros['aplicacion'] == 1) {
                        echo 'Éxito: El archivo a sido creado';
                    } elseif ($parametros['aplicacion'] == 2) {
                        echo 'Éxito: El entregable a sido creado';
                    } else {
                        echo 'Éxito: El Archivo de normatividad a sido creado';
                    }
                    //aqui insertamos en la tabla k_acuerdoactividad
                    $IDIndicador = $obj->getId_documento();
                    $obj2->setId_archivo($IDIndicador);
                    $obj2->setId_proyecto($parametros['Eje']);
                    if (isset($parametros['Expotem']) && $parametros['Expotem'] != "") {
                        $obj2->setId_exposicion($parametros['Expotem']);
                    } else {
                        $obj2->setId_exposicion("NULL");
                    }
                    if (isset($parametros['ActvGlobal']) && $parametros['ActvGlobal'] != "") {
                        $obj2->setId_actividad1($parametros['ActvGlobal']);
                        $Global = $parametros['ActvGlobal'];
                    } else {
                        $obj2->setId_actividad1("NULL");
                    }
                    if (isset($parametros['ActvGeneral']) && $parametros['ActvGeneral'] != "") {
                        $obj2->setId_actividad2($parametros['ActvGeneral']);
                        $General = $parametros['ActvGeneral'];
                    } else {
                        $obj2->setId_actividad2("NULL");
                    }
                    if (isset($parametros['ActvParticular']) && $parametros['ActvParticular'] != "") {
                        $obj2->setId_actividad3($parametros['ActvParticular']);
                        $Particular = $parametros['ActvParticular'];
                    } else {
                        $obj2->setId_actividad3("NULL");
                    }
                    if (isset($parametros['SubActividad']) && $parametros['SubActividad'] != "") {
                        $obj2->setId_actividad4($parametros['SubActividad']);
                        $Sub = $parametros['SubActividad'];
                    } else {
                        $obj2->setId_actividad4("NULL");
                    }
                    if (isset($parametros['cate']) && $parametros['cate'] != "") {
                        $obj2->setId_categoria($parametros['cate']);
                    } else {
                        $obj2->setId_categoria("NULL");
                    }

                    if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                        $obj2->setId_subcategoria($parametros['subcate']);
                    } else {
                        $obj2->setId_subcategoria("NULL");
                    }

                    $obj2->setId_tipo($parametros['acme']);
                    if ($Particular != '' && $Particular > 0 && $General != '' && $General > 0 && $Sub != '' && $Sub > 0) {
                        $obj2->setId_actividad($Sub);
                        $id_actividad = $Sub;
                    } elseif ($Particular != '' && $Particular > 0 && $General != '' && $General > 0) {
                        $obj2->setId_actividad($Particular);
                        $id_actividad = $Particular;
                    } elseif ($General != '' && $General > 0) {
                        $obj2->setId_actividad($General);
                        $id_actividad = $General;
                    } else {
                        $obj2->setId_actividad($Global);
                        $id_actividad = $Global;
                    }
                    if (isset($parametros['Check']) && $parametros['Check'] != "" && $parametros['Check'] != "NULL") {
                        $obj2->setId_check_list($check_list);
                    } else {
                        $obj2->setId_check_list("NULL");
                    }
                    if (isset($parametros['subCheck']) && $parametros['subCheck'] != "" && $parametros['subCheck'] > 0) {
                        $obj2->setId_subcheck_list($sub_check_list);
                    } else {
                        $obj2->setId_subcheck_list("NULL");
                    }
                    if ($obj2->acuerdoac()) {
                    }
                    if ($check_list > 0) {
                        $obj2->check_list($tipo_entregable, $parametros['ano'], $id_check, $id_actividad, $IDIndicador);
                    }
                    if ($sub_check_list > 0) {
                        $obj2->check_list2($parametros['ano'], $check_list, $id_actividad);
                    }
                    if ($variable2 > 0) {
                        $IDIndicador = $obj->getId_documento();
                        for ($index = 0; $index < $variable2; $index++) {
                            $obj3->setId_Archivo($IDIndicador);
                            $obj3->setId_Area_invitada($parametros['invitados' . $index]);
                            if ($obj3->acuerdoareas()) {
                            }
                        }
                    }
                } else {
                    echo 'Error: No se ha podido guardar el archivo';
                }
            } elseif ($entregable_final > 0 && $tipo_entregable == 9) {
                echo 'Error: "solo puede existir un entregable inicial por actividad/checklist"';
            } elseif ($entregable_final > 0 && $tipo_entregable == 10) {
                echo 'Error: "solo puede existir un entregable final por actividad/checklist"';
            } else {
                echo 'Error: No se ha podido guardar el archivo';
            }

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_documento($_POST['id']);
            $IDIndicador = $_POST['id'];
            $rutaimg = "resources/aplicaciones/imagenes/ArchivosCompartidos/";
            if (isset($parametros['link_pdf']) &&  $parametros['link_pdf'] != "") {
                $obj->setRuta($parametros['link_pdf']);
                $obj->setPdfcedulafiscal("link");
            } else {
                if ($parametros['archivo_registrado'] != 1 && isset($_FILES[0])) {
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
                        $obj->setRuta("../../.." . $rutaimg . "");
                        move_uploaded_file($_FILES[0]['tmp_name'], "../../.." . $nameimg);
                    } else {
                        $obj->setPdfcedulafiscal("");
                    }
                }
            }
            $variable = $parametros['tamanoArt'];
            $variable2 = $parametros['tamanoAreas'];
            $variableedit = $parametros['editaer'];
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $obj->setId_area($parametros['area']);
            $obj->setUsuarioUltimaModificacion($parametros['usuario']);
            if (isset($parametros['subcate_edit0']) && $parametros['subcate_edit0'] != "" && $parametros['subcate_edit0'] > 0) {
                $obj->setIdCategoriadeEje($parametros['subcate_edit0']);
            } else {
                $obj->setIdCategoriadeEje($parametros['cate_edit0']);
            }

            if ($obj->editaracuerdo()) {
                if ($parametros['aplicacion'] == 1) {
                    echo 'Éxito: El archivo a sido editado';
                } elseif ($parametros['aplicacion'] == 2) {
                    echo 'Éxito: El entregable a sido editado';
                } else {
                    echo 'Éxito: El Archivo de normatividad a sido editado';
                }
                for ($i = 0; $i < $variableedit; $i++) {
                    $obj2->setId_archivoactividad($parametros['id_edit' . $i]);
                    $obj2->setId_proyecto($parametros['Eje_edit' . $i]);
                    if (isset($parametros['Expotem_edit' . $i]) && $parametros['Expotem_edit' . $i] != "") {
                        $obj2->setId_exposicion($parametros['Expotem_edit' . $i]);
                    } else {
                        $obj2->setId_exposicion("NULL");
                    }
                    if (isset($parametros['ActvGlobal_edit' . $i]) && $parametros['ActvGlobal_edit' . $i] != "") {
                        $obj2->setId_actividad1($parametros['ActvGlobal_edit' . $i]);
                        $Global = $parametros['ActvGlobal_edit' . $i];
                    } else {
                        $obj2->setId_actividad1("NULL");
                    }
                    if (isset($parametros['ActvGeneral_edit' . $i]) && $parametros['ActvGeneral_edit' . $i] != "") {
                        $obj2->setId_actividad2($parametros['ActvGeneral_edit' . $i]);
                        $General = $parametros['ActvGeneral_edit' . $i];
                    } else {
                        $obj2->setId_actividad2("NULL");
                    }
                    if (isset($parametros['ActvParticular_edit' . $i]) && $parametros['ActvParticular_edit' . $i] != "") {
                        $obj2->setId_actividad3($parametros['ActvParticular_edit' . $i]);
                        $Particular = $parametros['ActvParticular_edit' . $i];
                    } else {
                        $obj2->setId_actividad3("NULL");
                    }
                    if (isset($parametros['SubActividad_edit' . $i]) && $parametros['SubActividad_edit' . $i] != "") {
                        $obj2->setId_actividad4($parametros['SubActividad_edit' . $i]);
                        $Sub = $parametros['SubActividad_edit' . $i];
                    } else {
                        $obj2->setId_actividad4("NULL");
                    }
                    if (isset($parametros['cate_edit' . $i]) && $parametros['cate_edit' . $i] != "") {
                        $obj2->setId_categoria($parametros['cate_edit' . $i]);
                    } else {
                        $obj2->setId_categoria("NULL");
                    }
                    if (isset($parametros['subcate_edit' . $i]) && $parametros['subcate_edit' . $i] != "" && $parametros['subcate_edit' . $i] > 0) {
                        $obj2->setId_subcategoria($parametros['subcate_edit' . $i]);
                    } else {
                        $obj2->setId_subcategoria("NULL");
                    }
                    if ($Particular != '' && $Particular > 0 && $General != '' && $General > 0 && $Sub != '' && $Sub > 0) {
                        $obj2->setId_actividad($Sub);
                    } elseif ($Particular != '' && $Particular > 0 && $General != '' && $General > 0) {
                        $obj2->setId_actividad($Particular);
                    } elseif ($General != '' && $General > 0) {
                        $obj2->setId_actividad($General);
                    } else {
                        $obj2->setId_actividad($Global);
                    }
                    $obj2->setId_tipo($parametros['acme_edit' . $i]);
                    if ($obj2->editaracuerdoac()) {
                    }
                }
                if ($variable != 0) {
                    for ($index = 0; $index < $variable; $index++) {
                        $obj2->setId_archivo($IDIndicador);
                        $obj2->setId_proyecto($parametros['Eje' . $index]);
                        if (isset($parametros['Expotem' . $index]) && $parametros['Expotem' . $index] != "") {
                            $obj2->setId_exposicion($parametros['Expotem' . $index]);
                        } else {
                            $obj2->setId_exposicion("NULL");
                        }
                        if (isset($parametros['ActvGlobal' . $index]) && $parametros['ActvGlobal' . $index] != "") {
                            $obj2->setId_actividad1($parametros['ActvGlobal' . $index]);
                            $Global = $parametros['ActvGlobal' . $index];
                        } else {
                            $obj2->setId_actividad1("NULL");
                        }
                        if (isset($parametros['ActvGeneral' . $index]) && $parametros['ActvGeneral' . $index] != "") {
                            $obj2->setId_actividad2($parametros['ActvGeneral' . $index]);
                            $General = $parametros['ActvGeneral' . $index];
                        } else {
                            $obj2->setId_actividad2("NULL");
                        }
                        if (isset($parametros['ActvParticular' . $index]) && $parametros['ActvParticular' . $index] != "") {
                            $obj2->setId_actividad3($parametros['ActvParticular' . $index]);
                            $Particular = $parametros['ActvParticular' . $index];
                        } else {
                            $obj2->setId_actividad3("NULL");
                        }
                        if (isset($parametros['SubActividad' . $index]) && $parametros['SubActividad' . $index] != "") {
                            $obj2->setId_actividad4($parametros['SubActividad' . $index]);
                            $Sub = $parametros['SubActividad' . $index];
                        } else {
                            $obj2->setId_actividad4("NULL");
                        }
                        if (isset($parametros['cate' . $index]) && $parametros['cate' . $index] != "") {
                            $obj2->setId_categoria($parametros['cate' . $index]);
                        } else {
                            $obj2->setId_categoria("NULL");
                        }
                        if (isset($parametros['subcate' . $index]) && $parametros['subcate' . $index] != "" && $parametros['subcate' . $index] > 0) {
                            $obj2->setId_subcategoria($parametros['subcate' . $index]);
                        } else {
                            $obj2->setId_subcategoria("NULL");
                        }
                        if ($Particular != '' && $Particular > 0 && $General != '' && $General > 0 && $Sub != '' && $Sub > 0) {
                            $obj2->setId_actividad($Sub);
                        } elseif ($Particular != '' && $Particular > 0 && $General != '' && $General > 0) {
                            $obj2->setId_actividad($Particular);
                        } elseif ($General != '' && $General > 0) {
                            $obj2->setId_actividad($General);
                        } else {
                            $obj2->setId_actividad($Global);
                        }
                        $obj2->setId_tipo($parametros['acme' . $index]);
                        if ($obj2->acuerdoac()) {
                        }
                    }
                }
            } else {
                echo 'Error: No se ha podido editar el archivo';
            }
            break;
        case 'editar2':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_documento($_POST['id']);
            $IDIndicador = $_POST['id'];
            $rutaimg = "resources/aplicaciones/imagenes/ArchivosCompartidos/";
            if (isset($parametros['link_pdf']) &&  $parametros['link_pdf'] != "") {
                $obj->setRuta($parametros['link_pdf']);
                $obj->setPdfcedulafiscal("link");
            } else {
                if ($parametros['archivo_registrado'] != 1 && isset($_FILES[0])) {
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
                        $obj->setRuta("../../.." . $rutaimg . "");
                        move_uploaded_file($_FILES[0]['tmp_name'], "../../.." . $nameimg);
                    } else {
                        $obj->setPdfcedulafiscal("");
                    }
                }
            }
            $variable = $parametros['tamanoArt'];
            $variable2 = $parametros['tamanoAreas'];
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $obj->setId_area($parametros['area']);
            $obj->setUsuarioUltimaModificacion($parametros['usuario']);
            if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                $obj->setIdCategoriadeEje($parametros['subcate']);
            } else {
                $obj->setIdCategoriadeEje($parametros['cate']);
            }
            if ($obj->editaracuerdo()) {
                if ($parametros['aplicacion'] == 1) {
                    echo 'Éxito: El archivo a sido editado';
                } elseif ($parametros['aplicacion'] == 2) {
                    echo 'Éxito: El entregable a sido editado';
                } else {
                    echo 'Éxito: El Archivo de normatividad a sido editado';
                }
                $obj2->setId_proyecto($parametros['Eje']);
                $obj2->setId_exposicion("NULL");
                if (isset($parametros['ActvGlobal']) && $parametros['ActvGlobal'] != "") {
                    $obj2->setId_actividad1($parametros['ActvGlobal']);
                    $Global = $parametros['ActvGlobal'];
                } else {
                    $obj2->setId_actividad1("NULL");
                }
                $obj2->setId_actividad2("NULL");
                $obj2->setId_actividad3("NULL");
                $obj2->setId_actividad4("NULL");
                if (isset($parametros['Check']) && $parametros['Check'] != "") {
                    $obj2->setId_categoria($parametros['Check']);
                } else {
                    $obj2->setId_categoria("NULL");
                }
                if (isset($parametros['subCheck']) && $parametros['subCheck'] != "" && $parametros['subCheck'] > 0) {
                    $obj2->setId_subcategoria($parametros['subCheck']);
                } else {
                    $obj2->setId_subcategoria("NULL");
                }
                $obj2->setId_actividad($Global);
                $obj2->setId_tipo($parametros['acme']);
                if ($obj2->editaracuerdoac()) {
                }
                
            }
            break;
        case 'eliminar':
            $nombre_archivo = '';
            $ruta = "";
            $tipo_entregable="";
            $IDIndicador = $_POST['id'];
            $obj->setId_documento($IDIndicador);
            $obj->getAcuerdo();
            $nombre_archivo = $obj->getPdfcedulafiscal();
            $rutaimg = $obj->getRuta();
            $tipo_entregable=$obj->getId_tipo();
            $ruta = $rutaimg . $nombre_archivo;
            break;
    }
}
