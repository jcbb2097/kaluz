<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/ArchivoCompartido.class.php");
include_once("../../Classes/AreaArchivo.class.php");
include_once("../../Classes/ActividadArchivo.class.php");
include_once("../../Classes/Evidencias.class.php");
include_once("../../../vista/apps/Planeacion/Classes/ActividadCategoria.class.php");

$obj = new ArchivoCompartido();
$obj2 = new actividades();
$obj3 = new Areas();
$obj4 = new Evidencia();
$obj5 = new Actividad_Categoria();
$catalogo = new Catalogo();

$Global = "";
$General = "";
$Particular = "";
$Sub = "";
$entregable_final = 0;
$origenasunto = 0;
$tipo_entregable = "";
$variable = "";
$variable2 = "";
$variableedit = "";
$ruta = "";
$idcategoria = "";
$check_list = "";
$sub_check_list = "";
$id_check = "";
$id_actividad = "";
$check_global = "";


if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) { //aqui se tranforma los campos del formulario a parametros
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //aqui asignamos si es categoria o subcategoria al entregable para guardar en c_documento
            if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                $idcategoria = $parametros['subcate'];
            } else {
                $idcategoria = $parametros['cate'];
            }
            //aqui asignamos comprobamos si check y subcheck tienen valor
            if (isset($parametros['Check']) && $parametros['Check'] != "" && $parametros['Check'] > 0) {
                $check_list = $parametros['Check'];
            }
            if (isset($parametros['subCheck']) && $parametros['subCheck'] != "" && $parametros['subCheck'] > 0) {
                $sub_check_list = $parametros['subCheck'];
            }
            if (isset($_POST['check_global']) && $_POST['check_global'] != "") {
                $check_global = $_POST['check_global'];
            }
            //aqui asignamos si es check o subcheck para guardar en c_documento
            if ($sub_check_list > 0 && $check_list > 0) {
                $id_check = $parametros['subCheck'];
            } else {
                $id_check = $parametros['Check'];
            }
            if ($check_global > 0) {
                $id_check = $check_global;
            }

            //aqui asignamos si es actividad globlal o general para la validacion de abajo
            if (isset($parametros['ActvGlobal']) && $parametros['ActvGlobal'] != "" && $parametros['ActvGlobal'] > 0) {
                $Global = $parametros['ActvGlobal'];
            }
            if (isset($parametros['ActvGeneral']) && $parametros['ActvGeneral'] != "" && $parametros['ActvGeneral'] > 0) {
                $General = $parametros['ActvGeneral'];
            }
            if ($General > 0 && $Global > 0) {
                $id_actividad = $parametros['ActvGeneral'];
            } else {
                $id_actividad = $parametros['ActvGlobal'];
            }

            if (isset($parametros['origenasunto']) && $parametros['origenasunto'] != "" && $parametros['origenasunto'] > 0) {
                $origenasunto = $parametros['origenasunto'];
            }

            //obtenemos el tipo de entregable para buscar en la bd que no exista mas de un final o inicial de cada actividad
            $tipo_entregable = $parametros['categoria'];
            if ($tipo_entregable == 10 || $tipo_entregable == 9) {
                //funcion que busca si existe
                $entregable_final = $obj->Entregable_final($id_actividad, $tipo_entregable, $idcategoria, $id_check, $parametros['ano']);
            }
            //aqui se procesa el archivo o el link del formulario
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
            //valores a guradar en la tabla c_documento
            $obj->setId_usuario($parametros['idUsuario']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $obj->setId_area($parametros['area']);
            $obj->setUsuarioCreacion($parametros['usuario']);
            $obj->setUsuarioUltimaModificacion($parametros['usuario']);
            $obj->setPantalla('Controller_archivo.php');
            $obj->setId_check($id_check);
            $obj->setIdCategoriadeEje($idcategoria);
            $obj->setorigenasunto($origenasunto);

            if ($entregable_final <= 0) {
                if ($obj->nuevoAcuerdo()) {
                    if ($parametros['aplicacion'] == 1) {
                        echo 'Éxito: El archivo ha sido creado';
                    } elseif ($parametros['aplicacion'] == 2) {
                        echo 'Éxito: El entregable ha sido creado';
                    } elseif ($parametros['aplicacion'] == 3) {
                        echo 'Éxito: El Archivo de normatividad ha sido creado';
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
                        $obj2->setId_actividad1($Global);
                    } else {
                        $obj2->setId_actividad1("NULL");
                    }
                    if (isset($parametros['ActvGeneral']) && $parametros['ActvGeneral'] != "" && $parametros['ActvGeneral'] != 0) {
                        $obj2->setId_actividad2($General);
                    } else {
                        $obj2->setId_actividad2("NULL");
                    }
                    $obj2->setId_actividad3("NULL");
                    $obj2->setId_actividad4("NULL");
                    $obj2->setId_categoria($parametros['cate']);
                    if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                        $obj2->setId_subcategoria($parametros['subcate']);
                    } else {
                        $obj2->setId_subcategoria("NULL");
                    }
                    $obj2->setId_tipo($parametros['acme']);
                    $obj2->setId_actividad($id_actividad);
                    if (isset($parametros['Check']) && $parametros['Check'] != "" && $parametros['Check'] > 0) {
                        $obj2->setId_check_list($check_list);
                    } else {
                        $obj2->setId_check_list("NULL");
                    }
                    // if (isset($parametros['check_global']) && $parametros['check_global'] != "" && $parametros['check_global'] > 0) {
                    //     $obj2->setcheck_global($check_global);
                    // } else {
                    //     $obj2->setcheck_global("NULL");
                    // }
                    if (isset($parametros['subCheck']) && $parametros['subCheck'] != "" && $parametros['subCheck'] > 0) {
                        $obj2->setId_subcheck_list($sub_check_list);
                    } else {
                        $obj2->setId_subcheck_list("NULL");
                    }
                    if ($obj2->acuerdoac()) {
                    }
                    if ($check_list > 0) {
                        $obj2->check_list($tipo_entregable, $parametros['ano'], $id_check, $id_actividad, $IDIndicador, $idcategoria);
                    }
                    if ($sub_check_list > 0) {
                        $obj2->check_list2($parametros['ano'], $check_list, $id_actividad, $idcategoria);
                    }
                    if ($parametros['ano'] == 9 && $parametros['Eje'] == 7 || $parametros['acme'] = 2 && $parametros['ano'] == 9) {
                        $obj4->actualizarAvance2022(14, $idcategoria, $id_actividad, $id_check, $parametros['categoria']);
                    }
                    if ($check_list == "" && $sub_check_list == "") {
                        $obj5->Entregable($IDIndicador, $id_actividad, $idcategoria, $parametros['ano']);
                    }

                    if (isset($_POST['check_global']) && $_POST['check_global'] != "" && $_POST['check_global'] != 0) {
                        $check_global = $_POST['check_global'];

                        $obj2->actualiza_porcentaje($tipo_entregable, $parametros['ano'], $check_global, $id_actividad,  $idcategoria);
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
                    echo 'Éxito: El archivo ha sido editado';
                } elseif ($parametros['aplicacion'] == 2) {
                    echo 'Éxito: El entregable ha sido editado';
                } elseif ($parametros['aplicacion'] == 3) {
                    echo 'Éxito: El Archivo de normatividad ha sido editado';
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
                    if (isset($parametros['ActvGeneral_edit' . $i]) && $parametros['ActvGeneral_edit' . $i] != "" && $parametros['ActvGeneral' . $i] != 0) {
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
                        if (isset($parametros['ActvGeneral' . $index]) && $parametros['ActvGeneral' . $index] != "" && $parametros['ActvGeneral' . $index] != 0) {
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
            //aqui asignamos si es categoria o subcategoria al entregable para guardar en c_documento
            if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                $idcategoria = $parametros['subcate'];
            } else {
                $idcategoria = $parametros['cate'];
            }
            //aqui asignamos comprobamos si check y subcheck tienen valor
            if (isset($parametros['Check']) && $parametros['Check'] != "" && $parametros['Check'] > 0) {
                $check_list = $parametros['Check'];
            }
            if (isset($parametros['subCheck']) && $parametros['subCheck'] != "" && $parametros['subCheck'] > 0) {
                $sub_check_list = $parametros['subCheck'];
            }
            if (isset($_POST['check_global']) && $_POST['check_global'] != "" && $_POST['check_global'] > 0) {
                $check_global = $_POST['check_global'];
            }

            //aqui asignamos si es check o subcheck para guardar en c_documento
            if ($check_list > 0 && $check_global == '' && $sub_check_list == "") {
                $id_check = $check_list;
            } elseif ($check_list > 0 && $check_global == '' && $sub_check_list > 0) {
                $id_check = $sub_check_list;
            } else {
                $id_check = $check_global;
            }

            //aqui asignamos si es actividad globlal o general para la validacion de abajo
            if (isset($parametros['ActvGlobal']) && $parametros['ActvGlobal'] != "" && $parametros['ActvGlobal'] > 0) {
                $Global = $parametros['ActvGlobal'];
            }
            if (isset($parametros['ActvGeneral']) && $parametros['ActvGeneral'] != "" && $parametros['ActvGeneral'] > 0) {
                $General = $parametros['ActvGeneral'];
            }
            if ($General > 0 && $Global > 0) {
                $id_actividad = $parametros['ActvGeneral'];
            } else {
                $id_actividad = $parametros['ActvGlobal'];
            }
            //consultamos para saber que tipos de entregables ya tiene el check
            $consulta = "SELECT ka.Inicial,ka.Proceso,ka.Final,Avance FROM k_checklist_actividad ka
            WHERE ka.Id_Periodo=" . $parametros['ano'] . " AND ka.IdCheckList=$id_check AND ka.IdActividad=$id_actividad";
            $resultado = $catalogo->obtenerLista($consulta);
            //echo $consulta;
            while ($row = mysqli_fetch_array($resultado)) {
                $Inicial = $row['Inicial'];
                $proceso = $row['Proceso'];
                $Final = $row['Final'];
                $Avance = $row['Avance'];
            }
            //asignamos el tipo a editar para validaciones
            $tipo_entregable = $parametros['categoria'];
            $tipo_entregable_last = $parametros['Tipo_last'];

            if ($tipo_entregable == 9 && $tipo_entregable_last == 9 || $tipo_entregable == 10 && $tipo_entregable_last == 10) {
                $bandera = false;
            } else {
                $bandera = true;
            }
            $IDIndicador = $_POST['id'];
            $obj->setId_documento($IDIndicador);
            $tipo_entregable = $parametros['categoria'];
            $Tipo_anterior = $parametros['Tipo_last'];
            //aqui se procesa el archivo o el link del formulario
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
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $obj->setId_area($parametros['area']);
            $obj->setUsuarioUltimaModificacion($parametros['idUsuario']);
            $obj->setId_check($id_check);
            $obj->setIdCategoriadeEje($idcategoria);
            if ($bandera == true) {
                if ($obj->editaracuerdo()) {
                    if ($parametros['aplicacion'] == 1) {
                        echo 'Éxito: El archivo ha sido editado';
                    } elseif ($parametros['aplicacion'] == 2) {
                        echo 'Éxito: El entregable ha sido editado';
                    } else {
                        echo 'Éxito: El Archivo de normatividad ha sido editado';
                    }
                    $obj4->Regresar_entregable($tipo_entregable, $id_check, $id_actividad, $parametros['ano'], $tipo_entregable_last, $idcategoria);
                    //$obj4->actualizarAvance2022($parametros['ano'], $idcategoria, $id_actividad, $id_check, $parametros['categoria']);
                    $obj2->setId_archivo($IDIndicador);
                    $obj2->setId_proyecto($parametros['Eje']);
                    if (isset($parametros['ActvGlobal']) && $parametros['ActvGlobal'] != "") {
                        $obj2->setId_actividad1($Global);
                    } else {
                        $obj2->setId_actividad1("NULL");
                    }
                    if (isset($parametros['ActvGeneral']) && $parametros['ActvGeneral'] != "" && $parametros['ActvGeneral'] != 0) {
                        $obj2->setId_actividad2($General);
                    } else {
                        $obj2->setId_actividad2("NULL");
                    }
                    $obj2->setId_categoria($parametros['cate']);
                    if (isset($parametros['subcate']) && $parametros['subcate'] != "" && $parametros['subcate'] > 0) {
                        $obj2->setId_subcategoria($parametros['subcate']);
                    } else {
                        $obj2->setId_subcategoria("NULL");
                    }
                    $obj2->setId_tipo($parametros['acme']);
                    $obj2->setId_actividad($id_actividad);
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
                    if ($obj2->editaracuerdoac()) {
                    }
                } else {
                    echo 'Error: No se ha podido editar el archivo';
                }
            } else {
                echo 'Error: No se pueden tener dos archivos iniciales o finales';
            }
            break;
        case 'eliminar':
            $nombre_archivo = '';
            $ruta = "";
            $tipo_entregable = "";
            $periodo = "";
            $Id_check = "";
            $id_actividad = "";
            $elimina = true;
            $validacion = 0;
            $IDIndicador = $_POST['id'];
            $obj2->setId_archivo($IDIndicador);
            $obj->setId_documento($IDIndicador);
            $obj->getAcuerdo();
            $obj2->getActividades();
            $idcategoria = $obj->getIdCategoriadeEje();
            $id_actividad = $obj2->getId_actividad();
            $nombre_archivo = $obj->getPdfcedulafiscal();
            $rutaimg = $obj->getRuta();
            $tipo_entregable = $obj->getId_tipo();
            $Id_check = $obj->getId_check();
            $periodo = $obj->getAnio();
            $ruta = $rutaimg . $nombre_archivo;
            if ($Id_check != "" && $Id_check != 0) {
                $archivo = $obj2->obtener_ultimo_archivo($Id_check, $periodo, $id_actividad, $idcategoria);
            } else {
                $archivo = $obj2->obtener_ultimo_archivo($Id_check, $periodo, $id_actividad, $idcategoria);
                $obj5->Entregable($archivo, $id_actividad, $idcategoria, $periodo);
            }

            if ($validacion <= 0) {
                if ($nombre_archivo != 'link') {
                    unlink($ruta);
                }
                $obj3->setId_Archivo($IDIndicador);
                if ($obj3->Eliminarea()) {
                    $obj2->setId_archivo($IDIndicador);
                    $obj2->Eliminaractividad();
                    $obj->setId_documento($IDIndicador);
                    $obj->eliminarAcuerdo();
                    $obj->eliminardetalle_doc();
                    if ($Id_check != "" && $Id_check != 0) {
                        $obj2->Eliminar_check_avance($id_actividad, $Id_check, $tipo_entregable, $periodo, $archivo, $idcategoria);
                    }

                    echo 'Éxito: Se ha eliminado el archivo';
                } else {
                    echo 'Error: No se ha podido eliminar el archivo';
                }
            } else {
                if ($tipo_entregable == 9) {
                    echo '<br>Error: No se puede eliminar un entregable inicial si existe un entregable en proceso o final';
                } elseif ($tipo_entregable == 14) {
                    echo 'Error: No se puede eliminar un entregable en proceso si existe un entregable inicial o final';
                } elseif ($tipo_entregable == 10) {
                    echo 'Error: No se puede eliminar un entregable en proceso si existe un entregable inicial o final';
                }
            }

            break;
        case 'eliminarsub':
            $obj2->setId_archivoactividad($_POST['id']);
            if ($obj2->Eliminaractividad2()) {
                echo 'Éxito: Se ha desvinculado la actividad del archivo';
            } else {
                echo 'Error: No se ha podido desvincular la actividad del archivo';
            }
            break;
        case 'eliminartodo':
            $IDIndicador = $_POST['id'];
            $obj->setId_documento($IDIndicador);
            $obj2->setId_archivo($IDIndicador);
            $obj3->setId_Archivo($IDIndicador);
            $obj->getAcuerdo();
            $nombre_archivo = $obj->getPdfcedulafiscal();
            $rutaimg = $obj->getRuta();
            $ruta = $rutaimg . $nombre_archivo;
            if ($nombre_archivo != 'link') {
                unlink($ruta);
            }
            if ($obj2->Eliminaractividad()) {
                $obj->eliminarAcuerdo();
                $obj3->Eliminarea();
                echo 'Éxito: Se ha eliminado registro';
            } else {
                echo 'Error: No se ha podido eliminar el Registro';
            }
            break;
    }
}
