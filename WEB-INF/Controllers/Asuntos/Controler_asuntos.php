<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/Asunto.class.php");
include_once("../../Classes/AsuntoActividad.class.php");
include_once("../../Classes/AsuntoArea.class.php");
include_once("../../Classes/AsuntoRespuesta.class.php");

$obj1 = new asunto();
$obj2 = new asunto_actividad();
$obj3 = new asunto_area();
$obj4 = new asunto_respuesta();

$id_categoria = "";
$id_subcategoria = "";
$categoria = "";
$id_check = "";
$id_subcheck = "";
$check = "";


if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'nuevo_asunto':
            if (isset($_POST['form'])) { //aqui se tranforma los campos del formulario a parametros
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $id_categoria = $parametros['cate'];
            $id_subcategoria = $parametros['subcate'];
            $id_check = $parametros['Checklist'];
            $id_subcheck = $parametros['subchecklist'];

            if ($id_subcategoria > 0) {
                $categoria = $parametros['subcate'];
            } else {
                $categoria = $parametros['cate'];
            }
            if ($id_subcheck > 0) {
                $check = $parametros['subchecklist'];
            } else {
                $check = $parametros['Checklist'];
            }

            $obj1->setAsunto($parametros['titulo']);
            $obj1->setIdOrigen($parametros['IdAreaOrigen']);
            $obj1->setIdUsuarioOrigen($parametros['idUsuario']);
            $obj1->setIdDestino($parametros['area']);
            $obj1->setIdUsuarioDestino($parametros['usuario']);
            $obj1->setFechaInicio('now()');
            $obj1->setTipo($parametros['tipo']);
            $obj1->setFechaRespuesta('now()');
            $obj1->setEstatus(1);
            //aqui insertamos los valores de la primera tabla de asuntos son los de arriva k_conversacion//
            if ($obj1->nuevoAsunto()) {
                $Id_asunto = $obj1->getIdConversacion();
                $obj2->setIdConversacion($Id_asunto);
                $obj2->setIdEje($parametros['eje']);
                $obj2->setIdGlobal($parametros['AGlobal']);
                $obj2->setIdGeneral($parametros['AGeneral']);
                $obj2->setIdEE(0);
                $obj2->setIdExpo(0);
                $obj2->setIdCategoria($categoria);
                $obj2->setIdChecklist($check);
                $obj2->nuevoAsuntoActividad();
                //aqui insertamos los valores de la segunda tabla de asuntos son los de arriva k_conversacionactividad//
                for ($i = 0; $i < 2; $i++) {
                    $obj3->setIdConversacion($Id_asunto);
                    if ($i == 0) {
                        $obj3->setIdArea($parametros['IdAreaOrigen']);
                        $obj3->setOrden(1);
                        $obj3->setRespuestas(0);
                    } else {
                        $obj3->setIdArea($parametros['area']);
                        $obj3->setOrden(2);
                        $obj3->setRespuestas(1);
                    }
                    $obj3->setEstatus(1);
                    $obj3->nuevoAsuntoArea();
                }
                //se inserta el area que crea el asunto y el area que lo resive
                //aqui insertamos los valores de la tercera tabla de asuntos son los de arriva k_conversacionArea//
                if ($parametros['tamanoAreas'] > 0) {
                    $o = 3;
                    for ($i = 0; $i < $parametros['tamanoAreas']; $i++) {
                        $obj3->setIdConversacion($Id_asunto);
                        $obj3->setIdArea($parametros['invitados' . $i]);
                        $obj3->setOrden($o);
                        $obj3->setRespuestas(1);
                        $obj3->setEstatus(1);
                        $obj3->nuevoAsuntoArea();
                        $o++;
                    }
                }
                //se inserta solo en el caso que alla areas invitadas
                //aqui insertamos los valores de la tercera tabla de asuntos son los de arriva k_conversacionArea//
                $obj4->setIdConversacion($Id_asunto);
                $obj4->setRespuesta($parametros['mensaje']);
                $obj4->setIdUsuario($parametros['idUsuario']);
                $obj4->setIdArea($parametros['IdAreaOrigen']);
                $obj4->setOrden(1);
                $obj4->nuevoAsuntoRespuesta();
                //aqui insertamos los valores de la cuarta tabla de asuntos son los de arriva k_conversacionRespuesta//

                $objeto = [
                            "asunto_id" => $Id_asunto,
                            "mensaje" => "Éxito: El asunto ha sido creado",
                          ];
                echo json_encode($objeto);
              //  echo 'Éxito: El asunto ha sido creado';


            } else {
              $objeto = [
                          "asunto_id" => 0,
                          "mensaje" => "Error: No se ha podido crear el asunto",
                        ];
              echo json_encode($objeto);
                //echo 'Error: No se ha podido crear el asunto';
            }
            break;
    }
}
