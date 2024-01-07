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

include_once ('../../Classes/EtapaNoticia.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new EtapaNoticias();
    
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            
            $obj->setNombre($parametros['etapa']);            

            if ($obj->agregarEtapaNoticia()) {
                echo "Se agregó la Etapa de Noticia correctamente.";
            } else {
                echo "Error: No se pudo agregar la Etapa de Noticia.";
            }
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setidEtapa($_POST['id']);
            $obj->setNombre($parametros['etapa']); 

            if ($obj->editarEtapaNoticia()) {
                echo "Se edito la Etapa de Noticia correctamente.";
            } else {
                echo "Error: No se pudo editar la Etapa de Noticia.";
            }

            break;
        case 'eliminar':
            $obj->setidEtapa($_POST['id']);
            if ($obj->eliminarEtapaNoticia()) {
                echo 'Éxito: Se ha eliminado la Etapa de Noticia';
            } else {
                echo 'Error: No se ha podido eliminar la Etapa de Noticia';
            }
            break;
        }
    }
?>