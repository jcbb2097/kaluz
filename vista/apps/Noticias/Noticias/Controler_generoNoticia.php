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

include_once ('../../Classes/GeneroNoticia.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new GeneroNoticia();
    
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            
            $obj->setDescripcion($parametros['genero']);            

            if ($obj->agregarSoporteNoticia()) {
                echo "Se agregó el Género de Noticia correctamente.";
            } else {
                echo "Error: No se pudo agregar el Género de Noticia.";
            }
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setidGenero($_POST['id']);
            $obj->setDescripcion($parametros['genero']); 

            if ($obj->editarSoporteNoticia()) {
                echo "Se edito el Género de Noticia correctamente.";
            } else {
                echo "Error: No se pudo editar el Género de Noticia.";
            }

            break;
        case 'eliminar':
            $obj->setidGenero($_POST['id']);
            if ($obj->eliminarSoporteNoticia()) {
                echo 'Éxito: Se ha eliminado el Género de Noticia';
            } else {
                echo 'Error: No se ha podido eliminar el Género de Noticia';
            }
            break;
        }
    }
?>