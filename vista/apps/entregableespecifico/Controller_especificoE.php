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
include_once("especificoE.class.php");
$catalogo = new Catalogo();



if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new especificoE();


    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            if (isset($parametros['nombre_actividad']) && $parametros['nombre_actividad'] != "") {
                $obj->setactividad($parametros['nombre_actividad']);
            }else {
                $obj->setactividad('NULL');
            }
            
            echo $parametros['nombre_entregable'];
            if (isset($parametros['nombre_entregable']) && $parametros['nombre_entregable'] != "") {
                $obj->setentregable($parametros['nombre_entregable']);
            }else {
                $obj->setentregable(0);
            }

            if (isset($parametros['desc_entregableE']) && $parametros['desc_entregableE'] != "") {
                $obj->setdescripcion($parametros['desc_entregableE']);
            }else {
                $obj->setdescripcion('NULL');
            }

            if (isset($parametros['nom_expot']) && $parametros['nom_expot'] != "") {
                $obj->setexp($parametros['nom_expot']);
            }else {
                $obj->setexp('NULL');
            }

            if (isset($parametros['desc_intervalo']) && $parametros['desc_intervalo'] != "") {
                $obj->setintervalo($parametros['desc_intervalo']);
            }else {
                $obj->setintervalo(0);
            }

            if (isset($parametros['avance']) && $parametros['avance'] != "") {
                $obj->setavance($parametros['avance']);
            }else {
                $obj->setavance('NULL');
            }

            if (isset($parametros['nom_libro']) && $parametros['nom_libro'] != "") {
                $obj->setlibro($parametros['nom_libro']);
            }else {
                $obj->setlibro('NULL');
            }




            if ($obj->Nuevo_especificoE()) {
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
            $obj->setId_entrEs($_POST['id']);

            if (isset($parametros['nombre_actividad']) && $parametros['nombre_actividad'] != "") {
                $obj->setactividad($parametros['nombre_actividad']);
            }else {
                $obj->setactividad('NULL');
            }

            if (isset($parametros['nombre_entregable']) && $parametros['nombre_entregable'] != "") {
                $obj->setentregable($parametros['nombre_entregable']);
            }else {
                $obj->setentregable(0);
            }

            if (isset($parametros['desc_entregableE']) && $parametros['desc_entregableE'] != "") {
                $obj->setdescripcion($parametros['desc_entregableE']);
            }else {
                $obj->setdescripcion('NULL');
            }

            if (isset($parametros['nom_expot']) && $parametros['nom_expot'] != "") {
                $obj->setexp($parametros['nom_expot']);
            }else {
                $obj->setexp('NULL');
            }

            if (isset($parametros['desc_intervalo']) && $parametros['desc_intervalo'] != "") {
                $obj->setintervalo($parametros['desc_intervalo']);
            }else {
                $obj->setintervalo(0);
            }

            if (isset($parametros['avance']) && $parametros['avance'] != "") {
                $obj->setavance($parametros['avance']);
            }else {
                $obj->setavance('NULL');
            }

            if (isset($parametros['nom_libro']) && $parametros['nom_libro'] != "") {
                $obj->setlibro($parametros['nom_libro']);
            }else {
                $obj->setlibro('NULL');
            }
            
            

            
            if ($obj->Editar_especificoE()) {
                echo 'Éxito: El Registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Registro';
            }



            break;
        case 'eliminar':
            $obj->setId_entrEs($_POST['id']);
            if ($obj->Eliminar_especificoE()) {

                echo 'Éxito: Se ha eliminado registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
} 
?>
