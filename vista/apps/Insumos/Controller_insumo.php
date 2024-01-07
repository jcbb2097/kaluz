<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";


if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}


include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("Insumo.class.php");
$catalogo = new Catalogo();



if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Insumo();


    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            echo "Registro guardado correctamente";

            if (isset($parametros['actividadglobal']) && $parametros['actividadglobal'] != "") {
                $obj->setIdActividadEntregable($parametros['actividadglobal']);
            }else {
                $obj->setIdActividadEntregable('NULL');
            }

            if (isset($parametros['actividadgeneral']) && $parametros['actividadgeneral'] != "") {
                $obj->setgeneral($parametros['actividadgeneral']);
            }else {
                $obj->setgeneral('NULL');
            }

            if (isset($parametros['actividadparticular']) && $parametros['actividadparticular'] != "") {
                $obj->setIdChecklistEntregable($parametros['actividadparticular']);
            }else {
                $obj->setIdChecklistEntregable('NULL');
            }

            if (isset($parametros['SubActividad']) && $parametros['SubActividad'] != "") {
                $obj->setsubcheck($parametros['SubActividad']);
            }else {
                $obj->setsubcheck('NULL');
            }


            $checked_array=$parametros['Insumocheck'];
            foreach ($parametros['checkid'] as $key => $value) 
            {
                if(in_array($parametros['checkid'][$key], $checked_array)) 
                {

                $checkid=$parametros['checkid'][$key];
                $actividadid= $parametros['actividadid'][$key];
                $fecharequerido= $parametros['fecharequerido'][$key];

                if (isset($checkid) && $checkid != "") {
                $obj->setIdChecklistInsumoUsado($checkid);
                    }else {
                $obj->setIdChecklistInsumoUsado('NULL');
                }

                if (isset($actividadid) && $actividadid != "") {
                $obj->setIdActividadInsumoUsado($actividadid);
                }else {
                $obj->setIdActividadInsumoUsado('NULL');
                }

                if (isset($fecharequerido) && $fecharequerido != "") {
                $obj->setfechaInsumoRequerido($fecharequerido);
                }else {
                $obj->setfechaInsumoRequerido('NULL');
                }

                if ($obj->Nuevo_checkListEntregableInsumo()) {
                //echo "Registro guardado correctamente"; 
                } else {
                echo 'Error: al guardar'; 
                }

                }
            }

            /*if (isset($parametros['IdChecklistInsumoUsado']) && $parametros['IdChecklistInsumoUsado'] != "") {
                $obj->setIdChecklistInsumoUsado($parametros['IdChecklistInsumoUsado']);
            }else {
                $obj->setIdChecklistInsumoUsado('NULL');
            }

            if (isset($parametros['IdChecklistEntregable']) && $parametros['IdChecklistEntregable'] != "") {
                $obj->setIdChecklistEntregable($parametros['IdChecklistEntregable']);
            }else {
                $obj->setIdChecklistEntregable('NULL');
            }

            if (isset($parametros['fechaInsumoRequerido']) && $parametros['fechaInsumoRequerido'] != "") {
                $obj->setfechaInsumoRequerido($parametros['fechaInsumoRequerido']);
            }else {
                $obj->setfechaInsumoRequerido('NULL');
            }*/

            /*if ($obj->Nuevo_checkListEntregableInsumo()) {
                echo "Registro guardado correctamente";
            } else {
                echo 'Error: al guardar'; 
            }*/

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setidActividadInsumoUsado($_POST['id']);
            
            if (isset($parametros['actividadglobal']) && $parametros['actividadglobal'] != "") {
                $obj->setIdActividadEntregable($parametros['actividadglobal']);
            }else {
                $obj->setIdActividadEntregable('NULL');
            }

            if (isset($parametros['actividadgeneral']) && $parametros['actividadgeneral'] != "") {
                $obj->setgeneral($parametros['actividadgeneral']);
            }else {
                $obj->setgeneral('NULL');
            }

            if (isset($parametros['actividadparticular']) && $parametros['actividadparticular'] != "") {
                $obj->setIdChecklistEntregable($parametros['actividadparticular']);
            }else {
                $obj->setIdChecklistEntregable('NULL');
            }

            if (isset($parametros['SubActividad']) && $parametros['SubActividad'] != "") {
                $obj->setsubcheck($parametros['SubActividad']);
            }else {
                $obj->setsubcheck('NULL');
            }


            $checked_array=$parametros['Insumocheck'];
            foreach ($parametros['checkid'] as $key => $value) 
            {
                if(in_array($parametros['checkid'][$key], $checked_array)) 
                {

                $checkid=$parametros['checkid'][$key];
                $actividadid= $parametros['actividadid'][$key];
                $fecharequerido= $parametros['fecharequerido'][$key];

                if (isset($checkid) && $checkid != "") {
                $obj->setIdChecklistInsumoUsado($checkid);
                    }else {
                $obj->setIdChecklistInsumoUsado('NULL');
                }

                if (isset($actividadid) && $actividadid != "") {
                $obj->setIdActividadInsumoUsado($actividadid);
                }else {
                $obj->setIdActividadInsumoUsado('NULL');
                }

                if (isset($fecharequerido) && $fecharequerido != "") {
                $obj->setfechaInsumoRequerido($fecharequerido);
                }else {
                $obj->setfechaInsumoRequerido('NULL');
                }

                if ($obj->Nuevo_checkListEntregableInsumo()) {
                echo "Registro guardado correctamente";
                } else {
                echo 'Error: al guardar'; 
                }

                }
            }

            if ($obj->Editar_checkListEntregableInsumo()) {
                echo 'Éxito: El Registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Registro';
            }

            break;
        case 'eliminar':
            $obj->setIdChecklistEntregable($_POST['id']);
            $obj->setIdActividadEntregable($_POST['id2']);
            $obj->setIdChecklistInsumoUsado($_POST['id3']);
            $obj->setIdActividadInsumoUsado($_POST['id4']);
            if ($obj->Eliminar_checkListEntregableInsumo()) {
                echo 'Éxito: Se ha eliminado registro';
            } else {

                echo 'Error: No puedes eliminar hasta eliminar todos los subcheck';
            }
            break;
    }
} 
?>
