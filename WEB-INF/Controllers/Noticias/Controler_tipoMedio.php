<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>  
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php   
}
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once ('../../Classes/TipoMedioNoticia.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new TipoMedio();
    
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            if (isset($parametros['soportemedio']) && $parametros['soportemedio'] != "") {
                $obj->setidSoporteMedio($parametros['soportemedio']);
            } else {
                $obj->setidSoporteMedio('NULL');
            }
            $obj->setNombre($parametros['tipomedio']);           

            if ($obj->agregarTipoMedio()) {
                echo "Se agregó el Tipo de Medio correctamente.";
            } else {
                echo "Error: No se pudo agregar el Tipo de Medio.";
            }
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setidTipoMedio($_POST['id']);
            if (isset($parametros['soportemedio']) && $parametros['soportemedio'] != "") {
                $obj->setidSoporteMedio($parametros['soportemedio']);
            } else {
                $obj->setidSoporteMedio('NULL');
            }
            $obj->setNombre($parametros['tipomedio']); 

            if ($obj->editarTipoMedio()) {
                echo "Se edito el Tipo de Medio correctamente.";
            } else {
                echo "Error: No se pudo editar el Tipo de Medio.";
            }

            break;
        case 'eliminar':
            $obj->setidTipoMedio($_POST['id']);
            if ($obj->eliminarTipoMedio()) {
                echo 'Éxito: Se ha eliminado el Tipo de Medio.';
            } else {
                echo 'Error: No se ha podido eliminar el Tipo de Medio.';
            }
            break;
        }
    }
?>