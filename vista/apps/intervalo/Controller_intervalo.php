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
include_once("Intervalo.class.php");
$catalogo = new Catalogo();



if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Intervalo();


    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            
            if (isset($parametros['descripcion']) && $parametros['descripcion'] != "") {
                $obj->setdescripcion($parametros['descripcion']);
            }else {
                $obj->setdescripcion(0);
            }

            if ($obj->Nuevo_intervalo()) {
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
            $obj->setId_intervalo($_POST['id']);
            
            if (isset($parametros['descripcion']) && $parametros['descripcion'] != "") {
                $obj->setdescripcion($parametros['descripcion']);
            }else {
                $obj->setdescripcion(0);
            }
            
            if ($obj->Editar_intervalo()) {
                echo 'Éxito: El Registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Registro';
            }



            break;
        case 'eliminar':

            $obj->setId_intervalo($_POST['id']);
            if ($obj->Eliminar_intervalo()) {

                echo 'Éxito: Se ha eliminado registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
} 
?>
