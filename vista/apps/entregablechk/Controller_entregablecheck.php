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
include_once("Entregablecheck.class.php");
$catalogo = new Catalogo();



if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Entregablecheck();


    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            if (isset($parametros['entregable']) && $parametros['entregable'] != "") {
                $obj->setentregable($parametros['entregable']);
            }else {
                $obj->setentregable(0);
            }

            if (isset($parametros['checklist']) && $parametros['checklist'] != "") {
                $obj->setchecklist($parametros['checklist']);
            }else {
                $obj->setchecklist('NULL');
            }

            if (isset($parametros['responsable']) && $parametros['responsable'] != "") {
                $obj->setresponsable($parametros['responsable']);
            }else {
                $obj->setresponsable('NULL');
            }


            if ($obj->Nuevo_entregablecheck()) {
                echo "Registro guardado correctamente";
            } else {
                echo 'Error al guardar';
                
            }


            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_entregablecheck($_POST['id']);
            
             if (isset($parametros['entregable']) && $parametros['entregable'] != "") {
                $obj->setentregable($parametros['entregable']);
            }else {
                $obj->setentregable(0);
            }

            if (isset($parametros['checklist']) && $parametros['checklist'] != "") {
                $obj->setchecklist($parametros['checklist']);
            }else {
                $obj->setchecklist('NULL');
            }

            if (isset($parametros['responsable']) && $parametros['responsable'] != "") {
                $obj->setresponsable($parametros['responsable']);
            }else {
                $obj->setresponsable('NULL');
            }

            
            if ($obj->Editar_entregablecheck()) {
                echo 'Éxito: El Registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Registro';
            }



            break;
        case 'eliminar':
            $obj->setId_entregablecheck($_POST['id']);
            if ($obj->Eliminar_entregablecheck()) {

                echo 'Éxito: Se ha eliminado registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
} 
?>
