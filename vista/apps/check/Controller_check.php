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
include_once("Check.class.php");
$catalogo = new Catalogo();



if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Check();


    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            
            if (isset($parametros['nombre']) && $parametros['nombre'] != "") {
                $obj->setnombre($parametros['nombre']);
            }else {
                $obj->setnombre(0);
            }

            if (isset($parametros['descripcion']) && $parametros['descripcion'] != "") {
                $obj->setdescripcion($parametros['descripcion']);
            }else {
                $obj->setdescripcion(0);
            }

            if (isset($parametros['nivel']) && $parametros['nivel'] != "") {
                $obj->setnivel($parametros['nivel']);
            }else {
                $obj->setnivel('NULL');
            }

            if (isset($parametros['padre']) && $parametros['padre'] != "") {
                $obj->setpadre($parametros['padre']);
            }else {
                $obj->setpadre('NULL');
            }

            if (isset($parametros['anio']) && $parametros['anio'] != "") {
                $obj->setanio($parametros['anio']);
            }else {
                $obj->setanio('NULL');
            }

            if (isset($parametros['categoria']) && $parametros['categoria'] != "") {
                $obj->setcategoria($parametros['categoria']);
            }else {
                $obj->setcategoria('NULL');
            }  

            if (isset($parametros['subcategoria']) && $parametros['subcategoria'] != "") {
                $obj->setsubcategoria($parametros['subcategoria']);
            }else {
                $obj->setsubcategoria('NULL');
            }

            if (isset($parametros['actividadglobal']) && $parametros['actividadglobal'] != "") {
                $obj->setglobal($parametros['actividadglobal']);
            }else {
                $obj->setglobal('NULL');
            }

            if (isset($parametros['actividadgeneral']) && $parametros['actividadgeneral'] != "") {
                $obj->setgeneral($parametros['actividadgeneral']);
            }else {
                $obj->setgeneral('NULL');
            }

            if (isset($parametros['persona']) && $parametros['persona'] != "") {
                $obj->setresponsable($parametros['persona']);
            }else {
                $obj->setresponsable('NULL');
            }

            if (isset($parametros['tiene']) && $parametros['tiene'] != "") {
                $obj->settiene($parametros['tiene']);
            }else {
                $obj->settiene('NULL');
            }

            if (isset($parametros['orden']) && $parametros['orden'] != "") {
                $obj->setorden($parametros['orden']);
            }else {
                $obj->setorden(0);
            }

            if (isset($parametros['entregable']) && $parametros['entregable'] != "") {
                $obj->setentregable($parametros['entregable']);
            }else {
                $obj->setentregable('NULL');
            }


            if ($obj->Nuevo_check()) {
                echo "Registro guardado correctamente";
            } else {
                //echo 'Error al guardar'; 
            }

            if ($obj->Nuevo_kcheck()) {
                //echo "Registro guardado correctamente";
            } else {
                //echo 'Error al guardar'; 
            }


            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_check($_POST['id']);
            
            if (isset($parametros['nombre']) && $parametros['nombre'] != "") {
                $obj->setnombre($parametros['nombre']);
            }else {
                $obj->setnombre(0);
            }

            if (isset($parametros['descripcion']) && $parametros['descripcion'] != "") {
                $obj->setdescripcion($parametros['descripcion']);
            }else {
                $obj->setdescripcion(0);
            }

            if (isset($parametros['nivel']) && $parametros['nivel'] != "") {
                $obj->setnivel($parametros['nivel']);
            }else {
                $obj->setnivel('NULL');
            }

            if (isset($parametros['padre']) && $parametros['padre'] != "") {
                $obj->setpadre($parametros['padre']);
            }else {
                $obj->setpadre('NULL');
            }

            if (isset($parametros['anio']) && $parametros['anio'] != "") {
                $obj->setanio($parametros['anio']);
            }else {
                $obj->setanio('NULL');
            }

            if (isset($parametros['categoria']) && $parametros['categoria'] != "") {
                $obj->setcategoria($parametros['categoria']);
            }else {
                $obj->setcategoria('NULL');
            }   

            if (isset($parametros['subcategoria']) && $parametros['subcategoria'] != "") {
                $obj->setsubcategoria($parametros['subcategoria']);
            }else {
                $obj->setsubcategoria('NULL');
            }

            if (isset($parametros['actividadglobal']) && $parametros['actividadglobal'] != "") {
                $obj->setglobal($parametros['actividadglobal']);
            }else {
                $obj->setglobal('NULL');
            }

            if (isset($parametros['actividadgeneral']) && $parametros['actividadgeneral'] != "") {
                $obj->setgeneral($parametros['actividadgeneral']);
            }else {
                $obj->setgeneral('NULL');
            }

            if (isset($parametros['persona']) && $parametros['persona'] != "") {
                $obj->setresponsable($parametros['persona']);
            }else {
                $obj->setresponsable('NULL');
            }

            
            if (isset($parametros['tiene']) && $parametros['tiene'] != "") {
                $obj->settiene($parametros['tiene']);
            }else {
                $obj->settiene('NULL');
            }


            if (isset($parametros['orden']) && $parametros['orden'] != "") {
                $obj->setorden($parametros['orden']);
            }else {
                $obj->setorden(0);
            }

            if (isset($parametros['entregable']) && $parametros['entregable'] != "") {
                $obj->setentregable($parametros['entregable']);
            }else {
                $obj->setentregable('NULL');
            }


            if ($obj->Editar_check()) {
                echo 'Éxito: El Registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Registro o o ya tiene dependencias de insumos';
            } 

            break;
        case 'eliminar':
            $obj->setId_check($_POST['id']);
            if ($obj->Eliminar_check()) {
                echo 'Éxito: Se ha eliminado registro';
            } else {

                echo 'Error: No puedes eliminar hasta eliminar todos los subcheck o ya tiene dependencias de insumos';
            } 
            break;

        case 'subeliminar':
            $obj->setId_check($_POST['id']);
            if ($obj->Eliminar_subcheck()) {
                echo 'Éxito: Se ha eliminado registro';
            } else {
                echo 'Error: No se ha podido eliminar el Registro';
            } 
            break;
    }
} 
?>
