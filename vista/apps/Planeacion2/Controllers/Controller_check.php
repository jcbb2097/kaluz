<?php
include_once("../Classes/Check.class.php");
$check = new Check();
if (isset($_POST['accion']) && $_POST['accion'] != "") {


    switch ($_POST['accion']) {

        case 'eliminar':
            $check->setIdCheckList($_POST["id"]);
            $check->setId_Periodo($_POST["Id_periodo"]);
            $check->setIdActividad($_POST["Id_actividad"]);
            $check->setIdCategoria($_POST["Id_categoria"]);
            $accion = $check->Eliminar_check();
            if ($accion == 1) {
                echo "Éxito:El check ha sido eliminado";
            } else {
                echo "Error:El check no ha sido eliminado";
            }
            break;

        case 'subeliminar':
            $check->setIdCheckList($_POST["id"]);
            $check->setId_Periodo($_POST["Id_periodo"]);
            $check->setIdActividad($_POST["Id_actividad"]);
            $check->setIdCategoria($_POST["Id_categoria"]);
            $accion = $check->Eliminar_check();
            if ($accion == 1) {
                echo "Éxito:El Sub-check ha sido eliminado";
            } else {
                echo "Error:El Sub-check no ha sido eliminado";
            }
            break;
        case 'agregarmeta':
            $accion = 1;
            $idActividad = $_POST['Id_actividad'];
            $tipo = $_POST["tipo"];
            $subcheck = $_POST["subcheck"];
            if ($idActividad > 0) {
                echo'fer entra';
                if ($subcheck == 1) {
                    if ($tipo == 2) {
                        $id = $check->get_hijos($_POST["id"]);
                        $idInsertar = explode(',', $id);
                        for ($i = 0; $i < count($idInsertar); $i++) {
                            $check->setIdCheckList($idInsertar[$i]);
                            $check->setId_Periodo($_POST["Id_periodo"]);
                            $check->setIdActividad($_POST["Id_actividad"]);
                            $check->setIdCategoria($_POST["Id_categoria"]);
                            $accion = $check->insertCheck();
                        }
                    } else {
                        $check->setIdCheckList($_POST["id"]);
                        $check->setId_Periodo($_POST["Id_periodo"]);
                        $check->setIdActividad($_POST["Id_actividad"]);
                        $check->setIdCategoria($_POST["Id_categoria"]);
                        $accion = $check->insertCheck();
                    }
                } else {
                    $idInsertar = $check->getPadre($_POST["id"]);
                    for ($i = 0; $i < count($idInsertar); $i++) {
                        $check->setIdCheckList($idInsertar[$i]);
                        $check->setId_Periodo($_POST["Id_periodo"]);
                        $check->setIdActividad($_POST["Id_actividad"]);
                        $check->setIdCategoria($_POST["Id_categoria"]);
                        $accion = $check->insertCheck();
                    }
                }
            }

            // $accion = $check->insertCheck();
            if ($accion == 0) {
                echo "Éxito:Meta agregada";
            } else {
                echo "Error:La meta no ha podido ser agregada";
            }
            break;
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros); //convertimos los datos del formulario
            }
            $num = $parametros['acti']; //asignamos el numero de checks a editar o agregar
            for ($i = 1; $i <= $num; $i++) {
                $idCategoria = $parametros['cate'];
                $nivel = 0;
                $idSubCategoria = $parametros['subcate'];
                $idCate = '';
                $idGlobal = $parametros['ActvGlobal'];
                $idGeneral = $parametros['ActvGeneral'];
                $idPeriodo = $parametros['ano'];
                $idAct = '';
                if ($idSubCategoria > 0) {
                    $idCate = $idSubCategoria;
                } else {
                    $idCate = $idCategoria;
                }
                if ($idGeneral > 0) {
                    $idAct = $idGeneral;
                } else {
                    $idAct = $idGlobal;
                }
                if (isset($parametros['checkpadre']) && $parametros['checkpadre'] > 0) {
                    $idCheckPadre = $parametros['checkpadre'];
                    $nivel = 2;
                } else {
                    $idCheckPadre = 'NULL';
                    $nivel = 1;
                }
                $orden = $parametros['orden' . $i];
                $nCheck = $parametros['check' . $i];
                $respo = $parametros['respo' . $i];
                $entre = $parametros['entre' . $i];
                $tipo = $parametros['tipo' . $i];
                $idcheck = $parametros['idcheck' . $i];
                if (isset($parametros['visible' . $i])) {
                    $visible = 1;
                } else {
                    $visible = 0;
                }
                if ($idcheck != 0) {
                    $existe = $check->existe($idCate, $idAct, $idPeriodo, $idcheck);
                    if ($existe > 0) {
                        echo 'solo actualiza<br>';
                        $check->setIdCheckList($idcheck);
                        $check->setIdCategoria($idCate);
                        $check->setIdActividad($idAct);
                        $check->setId_Periodo($idPeriodo);
                        $check->setIdEncargado($respo);
                        $check->setorden($orden);
                        $check->setNombre_alterno($nCheck);
                        $check->setvisible($visible);
                        $check->setentregable($entre);
                        $check->updatecheck();
                    } else {
                        echo 'crea en la intermedia<br>';
                        $ids = $check->get_hijos($existe);
                        $idInsertar = explode(',', $ids);
                        for ($i = 0; $i < count($idInsertar); $i++) {
                            $check->setIdCheckList($idInsertar[$i]);
                            $check->setIdCategoria($idCate);
                            $check->setIdActividad($idAct);
                            $check->setId_Periodo($idPeriodo);
                            $check->setIdEncargado($respo);
                            if ($i == 0) {
                                $check->setorden($orden);
                            } else {
                                $check->setorden($i);
                            }
                            $check->setvisible($visible);
                            $check->setentregable($entre);
                            $check->Nuevocheck();
                        }
                    }
                } else {
                    echo 'crear el check y crea en la intermedia<br>';
                }
            }
            break;
        case 'editar':
            echo 'editar';
            break;
    }
}
