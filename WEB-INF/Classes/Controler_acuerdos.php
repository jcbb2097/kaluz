<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/AcuerdoEscrito.class.php");
include_once("../../Classes/AreaAcuerdo.class.php");
include_once("../../Classes/ActividadAcuerdo.class.php");
//include_once("../../../vista/apps/AcuerdosEscritos/Acuerdopdf.class.php");
$obj = new documento();
$catalogo = new Catalogo();
$obj2 = new actividades();
$obj3 = new Areas();
//$obj4 = new PDFAcuerdo();

$variable = "";
$variable2 = "";
$variableedit="";
$idparapdf="";

if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //aqui insertamos en la tabla c_acuerdopdf
            //$obj4->parametros($parametros);
            $rutaimg = "resources/aplicaciones/PDF/AcuerdosEscritos/";
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
            $obj->setId_usuario($parametros['persona']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setId_area($parametros['area']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $variable = $parametros['tamanoArt'];
            $variable2 = $parametros['tamanoAreas'];
            $variableif = $variable + 1;
            $obj->setId_destino($variableif);
            $obj->setId_destino2($variable2);
            $obj->setUsuarioCreacion("SIE");
            $obj->setUsuarioUltimaModificacion("SIE");
            $obj->setPantalla('AltaAcuerdos.php');
            $obj->setFecha_convocado($parametros['fechac']);
            if (isset($parametros['realizado']) && $parametros['realizado'] == 'on') {
                $obj->setEstatus(1); /* NOTA */
                $obj->setFecha_realizado($parametros['fechaf']);
            } else {
                $obj->setEstatus(0); /* NOTA */
                $obj->setFecha_realizado("NULL");
            }
            if ($obj->nuevoAcuerdo()) {
                echo "Acuerdo guardado correctamente";
                if ($variable >= 0) {
                    //aqui insertamos en la tabla k_acuerdoactividad
                    $IDIndicador = $obj->getId_acuerdo_escrito();
                    $obj2->setId_acuerdo($IDIndicador);
                    $obj2->setId_proyecto($parametros['Eje']);
                    if (isset($parametros['Expotem']) && $parametros['Expotem'] != "") {
                        $obj2->setId_exposicion($parametros['Expotem']);
                    } else {
                        $obj2->setId_exposicion("NULL");
                    }
                    if (isset($parametros['ActvGlobal']) && $parametros['ActvGlobal'] != "") {
                        $obj2->setId_actividad1($parametros['ActvGlobal']);
                    } else {
                        $obj2->setId_actividad1("NULL");
                    }
                    if (isset($parametros['ActvGeneral']) && $parametros['ActvGeneral'] != "") {
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
                    $obj2->setId_tipo($parametros['acme']);
                    if (isset($parametros['realizadoact']) && $parametros['realizadoact'] == 'on') {
                        $obj2->setrealizado_act("1");
                    } else {
                        $obj2->setrealizado_act("0");
                    }
                    if (isset($parametros['resolucion']) && $parametros['resolucion'] != "") {
                        $obj2->setResolucion($parametros['resolucion']);
                    } else {
                        $obj2->setResolucion("");
                    }
                    if (isset($parametros['cate']) && $parametros['cate'] != "") {
                        $obj2->setId_categoria($parametros['cate']);
                    } else {
                        $obj2->setId_categoria("NULL");
                    }
                    if (isset($parametros['subcate']) && $parametros['subcate'] != "") {
                        $obj2->setId_subcategoria($parametros['subcate']);
                    } else {
                        $obj2->setId_subcategoria("NULL");
                    }

                    //nuevos campos
                    if (isset($parametros['descripcionacuerdo']) && $parametros['descripcionacuerdo'] != "") {
                        $obj2->setdescripcion_acuerdo($parametros['descripcionacuerdo']);
                    } else {
                        $obj2->setdescripcion_acuerdo("NULL");
                    }

                    if (isset($parametros['tipoacuerdo']) && $parametros['tipoacuerdo'] != "") {
                        $obj2->settipo_acuerdo($parametros['tipoacuerdo']);
                    } else {
                        $obj2->settipo_acuerdo("NULL");
                    }

                    if ($obj2->acuerdoac()) {
                    }
                    if ($variable != 0) {
                        for ($index = 0; $index < $variable; $index++) {
                            $obj2->setId_acuerdo($IDIndicador);
                            $obj2->setId_proyecto($parametros['Eje' . $index]);
                            if (isset($parametros['Expotem' . $index]) && $parametros['Expotem' . $index] != "") {
                                $obj2->setId_exposicion($parametros['Expotem' . $index]);
                            } else {
                                $obj2->setId_exposicion("NULL");
                            }
                            if (isset($parametros['ActvGlobal' . $index]) && $parametros['ActvGlobal' . $index] != "") {
                                $obj2->setId_actividad1($parametros['ActvGlobal' . $index]);
                            } else {
                                $obj2->setId_actividad1("NULL");
                            }
                            if (isset($parametros['ActvGeneral' . $index]) && $parametros['ActvGeneral' . $index] != "") {
                                $obj2->setId_actividad2($parametros['ActvGeneral' . $index]);
                            } else {
                                $obj2->setId_actividad2("NULL");
                            }
                            if (isset($parametros['ActvParticular' . $index]) && $parametros['ActvParticular' . $index] != "") {
                                $obj2->setId_actividad3($parametros['ActvParticular' . $index]);
                            } else {
                                $obj2->setId_actividad3("NULL");
                            }
                            if (isset($parametros['SubActividad' . $index]) && $parametros['SubActividad' . $index] != "") {
                                $obj2->setId_actividad4($parametros['SubActividad' . $index]);
                            } else {
                                $obj2->setId_actividad4("NULL");
                            }
                            $obj2->setId_tipo($parametros['acme' . $index]);
                            if (isset($parametros['realizadoact' . $index]) && $parametros['realizadoact' . $index] == 'on') {
                                $obj2->setrealizado_act("1");
                            } else {
                                $obj2->setrealizado_act("0");
                            }
                            if (isset($parametros['resolucion' . $index]) && $parametros['resolucion' . $index] != "") {
                                $obj2->setResolucion($parametros['resolucion' . $index]);
                            } else {
                                $obj2->setResolucion("");
                            }
                            if (isset($parametros['cate' . $index]) && $parametros['cate' . $index] != "") {
                                $obj2->setId_categoria($parametros['cate' . $index]);
                            } else {
                                $obj2->setId_categoria("NULL");
                            }
                            if (isset($parametros['subcate' . $index]) && $parametros['subcate' . $index] != "") {
                                $obj2->setId_subcategoria($parametros['subcate' . $index]);
                            } else {
                                $obj2->setId_subcategoria("NULL");
                            }

                            //nuevos campos
                            if (isset($parametros['descripcionacuerdo' . $index]) && $parametros['descripcionacuerdo' . $index] != "") {
                            $obj2->setdescripcion_acuerdo($parametros['descripcionacuerdo' . $index]);
                            } else {
                            $obj2->setdescripcion_acuerdo("NULL");
                            }

                            if (isset($parametros['tipoacuerdo' . $index]) && $parametros['tipoacuerdo' . $index] != "") {
                            $obj2->settipo_acuerdo($parametros['tipoacuerdo' . $index]);
                            } else {
                            $obj2->settipo_acuerdo("NULL");
                            }

                            if ($obj2->acuerdoac()) {
                            }
                        }
                    }
                    if ($variable2 > 0) {
                        $IDIndicador = $obj->getId_acuerdo_escrito();
                        for ($index = 0; $index < $variable2; $index++) {
                            $obj3->setId_Acuerdo($IDIndicador);
                            $obj3->setId_Area_invitada($parametros['invitados' . $index]);
                            if ($obj3->acuerdoareas()) {
                            }
                        }
                    }
                }
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_acuerdo_escrito($_POST['id']);
            $idparapdf=$_POST['id'];
            $rutaimg = "resources/aplicaciones/PDF/AcuerdosEscritos/";
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
                $obj->setPdfcedulafiscal("SIN");
            }
            $variable = $parametros['tamanoArt'];
            $variableedit = $parametros['tamanoArtedit'];
            $variable2 = $parametros['tamanoAreas'];
            $obj->setId_usuario($parametros['persona']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setId_area($parametros['area']);
            $obj->setAnio($parametros['ano']);
            $obj->setId_tipo($parametros['categoria']);
            $obj->setId_destino($variable);
            $obj->setId_destino2($variable2);
            $obj->setUsuarioUltimaModificacion("SIE");
            $obj->setFecha_convocado($parametros['fechac']);
            if (isset($parametros['realizado']) && $parametros['realizado'] == 'on') {
                $obj->setEstatus(1); /* NOTA */
                $obj->setFecha_realizado($parametros['fechaf']);
            } else {
                $obj->setEstatus(0); /* NOTA */
                $obj->setFecha_realizado("NULL");
            }
            if ($obj->editaracuerdo()) {
                echo 'Éxito: El Acuerdo a sido modificado';
                $IDIndicador = $_POST['id'];
                $obj3->setId_Acuerdo($IDIndicador);
                //if ($obj3->Eliminarea()) {
                //}
                if (isset($parametros['id_edit']) && $parametros['id_edit'] == 1) {
                     for ($index = $variableedit; $index < $variable; $index++) {
                        $obj2->setId_acuerdo($IDIndicador);
                            $obj2->setId_proyecto($parametros['Eje' . $index]);
                            if (isset($parametros['Expotem' . $index]) && $parametros['Expotem' . $index] != "") {
                                $obj2->setId_exposicion($parametros['Expotem' . $index]);
                            } else {
                                $obj2->setId_exposicion("NULL");
                            }
                            if (isset($parametros['ActvGlobal' . $index]) && $parametros['ActvGlobal' . $index] != "") {
                                $obj2->setId_actividad1($parametros['ActvGlobal' . $index]);
                            } else {
                                $obj2->setId_actividad1("NULL");
                            }
                            if (isset($parametros['ActvGeneral' . $index]) && $parametros['ActvGeneral' . $index] != "") {
                                $obj2->setId_actividad2($parametros['ActvGeneral' . $index]);
                            } else {
                                $obj2->setId_actividad2("NULL");
                            }
                            if (isset($parametros['ActvParticular' . $index]) && $parametros['ActvParticular' . $index] != "") {
                                $obj2->setId_actividad3($parametros['ActvParticular' . $index]);
                            } else {
                                $obj2->setId_actividad3("NULL");
                            }
                            if (isset($parametros['SubActividad' . $index]) && $parametros['SubActividad' . $index] != "") {
                                $obj2->setId_actividad4($parametros['SubActividad' . $index]);
                            } else {
                                $obj2->setId_actividad4("NULL");
                            }
                            $obj2->setId_tipo($parametros['acme' . $index]);
                            if (isset($parametros['realizadoact' . $index]) && $parametros['realizadoact' . $index] == 'on') {
                                $obj2->setrealizado_act("1");
                            } else {
                                $obj2->setrealizado_act("0");
                            }
                            if (isset($parametros['resolucion' . $index]) && $parametros['resolucion' . $index] != "") {
                                $obj2->setResolucion($parametros['resolucion' . $index]);
                            } else {
                                $obj2->setResolucion("");
                            }
                            if (isset($parametros['cate' . $index]) && $parametros['cate' . $index] != "") {
                                $obj2->setId_categoria($parametros['cate' . $index]);
                            } else {
                                $obj2->setId_categoria("NULL");
                            }
                            if (isset($parametros['subcate' . $index]) && $parametros['subcate' . $index] != "") {
                                $obj2->setId_subcategoria($parametros['subcate' . $index]);
                            } else {
                                $obj2->setId_subcategoria("NULL");
                            }

                            //nuevos campos
                            if (isset($parametros['descripcionacuerdo' . $index]) && $parametros['descripcionacuerdo' . $index] != "") {
                            $obj2->setdescripcion_acuerdo($parametros['descripcionacuerdo' . $index]);
                            } else {
                            $obj2->setdescripcion_acuerdo("NULL");
                            }

                            if (isset($parametros['tipoacuerdo' . $index]) && $parametros['tipoacuerdo' . $index] != "") {
                            $obj2->settipo_acuerdo($parametros['tipoacuerdo' . $index]);
                            } else {
                            $obj2->settipo_acuerdo("NULL");
                            }
                    

                            if ($obj2->acuerdoac()) {
                            }
                    } 
                }
                if (isset($parametros['id_edit0'])) {
                    for ($i = 0; $i < $variable; $i++) {
                        if(!isset($parametros['id_edit' . $i]) && isset($parametros['Eje' . $i])){
                           //Si no existe una nueva actividad de las que ya estan debe ingresar una nueva 
                            $obj2->setId_acuerdo($IDIndicador);
                            $obj2->setId_proyecto($parametros['Eje' . $i]);
                            if (isset($parametros['Expotem' . $i]) && $parametros['Expotem' . $i] != "") {
                                $obj2->setId_exposicion($parametros['Expotem' . $i]);
                            } else {
                                $obj2->setId_exposicion("NULL");
                            }
                            if (isset($parametros['ActvGlobal' . $i]) && $parametros['ActvGlobal' . $i] != "") {
                                $obj2->setId_actividad1($parametros['ActvGlobal' . $i]);
                            } else {
                                $obj2->setId_actividad1("NULL");
                            }
                            if (isset($parametros['ActvGeneral' . $i]) && $parametros['ActvGeneral' . $i] != "") {
                                $obj2->setId_actividad2($parametros['ActvGeneral' . $i]);
                            } else {
                                $obj2->setId_actividad2("NULL");
                            }
                            if (isset($parametros['ActvParticular' . $i]) && $parametros['ActvParticular' . $i] != "") {
                                $obj2->setId_actividad3($parametros['ActvParticular' . $i]);
                            } else {
                                $obj2->setId_actividad3("NULL");
                            }
                            if (isset($parametros['SubActividad' . $i]) && $parametros['SubActividad' . $i] != "") {
                                $obj2->setId_actividad4($parametros['SubActividad' . $i]);
                            } else {
                                $obj2->setId_actividad4("NULL");
                            }
                            $obj2->setId_tipo($parametros['acme' . $i]);
                            if (isset($parametros['realizadoact' . $i]) && $parametros['realizadoact' . $i] == 'on') {
                                $obj2->setrealizado_act("1");
                            } else {
                                $obj2->setrealizado_act("0");
                            }
                            if (isset($parametros['resolucion' . $i]) && $parametros['resolucion' . $i] != "") {
                                $obj2->setResolucion($parametros['resolucion' . $i]);
                            } else {
                                $obj2->setResolucion("");
                            }
                            if (isset($parametros['cate' . $i]) && $parametros['cate' . $i] != "") {
                                $obj2->setId_categoria($parametros['cate' . $i]);
                            } else {
                                $obj2->setId_categoria("NULL");
                            }
                            if (isset($parametros['subcate' . $i]) && $parametros['subcate' . $i] != "") {
                                $obj2->setId_subcategoria($parametros['subcate' . $i]);
                            } else {
                                $obj2->setId_subcategoria("NULL");
                            }

                            
                            //nuevos campos
                            if (isset($parametros['descripcionacuerdo' . $i]) && $parametros['descripcionacuerdo' . $i] != "") {
                            $obj2->setdescripcion_acuerdo($parametros['descripcionacuerdo' . $i]);
                            } else {
                            $obj2->setdescripcion_acuerdo("NULL");
                            }

                            if (isset($parametros['tipoacuerdo' . $i]) && $parametros['tipoacuerdo' . $i] != "") {
                            $obj2->settipo_acuerdo($parametros['tipoacuerdo' . $i]);
                            } else {
                            $obj2->settipo_acuerdo("NULL");
                            }


                            if ($obj2->acuerdoac()) {
                            }

                        }else{
                        $IDIndicador = $parametros['id_edit' . $i];
                        $obj2->setId_acuerdoactividad($IDIndicador);
                        $obj2->setId_proyecto($parametros['Eje' . $i]);
                        $obj2->setId_tipo($parametros['acme' . $i]);
                        if (isset($parametros['Expotem' . $i]) && $parametros['Expotem' . $i] != "") {
                            $obj2->setId_exposicion($parametros['Expotem' . $i]);
                        } else {
                            $obj2->setId_exposicion("NULL");
                        }
                        if (isset($parametros['ActvGlobal' . $i]) && $parametros['ActvGlobal' . $i] != "") {
                            $obj2->setId_actividad1($parametros['ActvGlobal' . $i]);
                        } else {
                            $obj2->setId_actividad1("NULL");
                        }
                        if (isset($parametros['ActvGeneral' . $i]) && $parametros['ActvGeneral' . $i] != "") {
                            $obj2->setId_actividad2($parametros['ActvGeneral' . $i]);
                        } else {
                            $obj2->setId_actividad2("NULL");
                        }
                        if (isset($parametros['ActvParticular' . $i]) && $parametros['ActvParticular' . $i] != "") {
                            $obj2->setId_actividad3($parametros['ActvParticular' . $i]);
                        } else {
                            $obj2->setId_actividad3("NULL");
                        }
                        if (isset($parametros['SubActividad' . $i]) && $parametros['SubActividad' . $i] != "") {
                            $obj2->setId_actividad4($parametros['SubActividad' . $i]);
                        } else {
                            $obj2->setId_actividad4("NULL");
                        }
                        if (isset($parametros['cate' . $i]) && $parametros['cate' . $i] != "") {
                            $obj2->setId_categoria($parametros['cate' . $i]);
                        } else {
                            $obj2->setId_categoria("NULL");
                        }
                        if (isset($parametros['subcate' . $i]) && $parametros['subcate' . $i] != "") {
                            $obj2->setId_subcategoria($parametros['subcate' . $i]);
                        } else {
                            $obj2->setId_subcategoria("NULL");
                        }
                        if (isset($parametros['realizadoact' . $i]) && $parametros['realizadoact' . $i] == 'on') {
                            $obj2->setrealizado_act("1");
                        } else {
                            $obj2->setrealizado_act("0");
                        }
                        if (isset($parametros['resolucion' . $i]) && $parametros['resolucion' . $i] != "") {
                            $obj2->setResolucion($parametros['resolucion' . $i]);
                        } else {
                            $obj2->setResolucion("");
                        }


                        //nuevos campos
                        if (isset($parametros['descripcionacuerdo' . $i]) && $parametros['descripcionacuerdo' . $i] != "") {
                        $obj2->setdescripcion_acuerdo($parametros['descripcionacuerdo' . $i]);
                        } else {
                        $obj2->setdescripcion_acuerdo("NULL");
                        }

                        if (isset($parametros['tipoacuerdo' . $i]) && $parametros['tipoacuerdo' . $i] != "") {
                        $obj2->settipo_acuerdo($parametros['tipoacuerdo' . $i]);
                        } else {
                        $obj2->settipo_acuerdo("NULL");
                        }

                        if ($obj2->editaractividades()) {
                        }
                    }
                }
                }
                if ($variable2 > 0) {
                    $IDIndicador = $_POST['id'];
                    for ($index = 0; $index < $variable2; $index++) {
                        $obj3->setId_Acuerdo($IDIndicador);
                        $obj3->setId_Area_invitada($parametros['invitados' . $index]);
                        if ($obj3->validaareas()) {
                        }
                        if ($obj3->validaEliminarea()) {
                        }
                        if ($obj3->eliminarareacorrespondiente()) {
                        }
                    }
                }
            } else {
                echo 'Error: No se ha podido modificar el Acuerdo';
            }

            break;
        case 'eliminar':
            $nombre_archivo = '';
            $IDIndicador = $_POST['id'];
            $obj->setId_acuerdo_escrito($IDIndicador);
            $obj->getAcuerdo();
            $nombre_archivo = $obj->getPdfcedulafiscal();
            $rutaimg = "../../../resources/aplicaciones/PDF/AcuerdosEscritos/" . $nombre_archivo;
            if (unlink($rutaimg)) {
                $obj3->setId_Acuerdo($_POST['id']);
                if ($obj3->Eliminarea()) {
                    $obj2->setId_acuerdo($_POST['id']);
                    if ($obj2->Eliminaractividad()) {
                        $obj->setId_acuerdo_escrito($_POST['id']);
                    }
                    if ($obj->eliminarAcuerdo()) {
                    }
                }
                echo 'Éxito: Se ha eliminado el Acuerdo';
            } else {
                echo 'Error: No se ha podido eliminar el Acuerdo';
            }


            break;
    }
}


