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


include_once ('../../Classes/Noticias.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Noticias();

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }


            $obj->setfnoticia($parametros['fnoticia']);
            $obj->settitulo($parametros['titulo']);
            if (isset($parametros['autor']) && $parametros['autor'] != "") {
                $obj->setautor($parametros['autor']);
            } else {
                $obj->setautor('NULL');
            }
            $obj->setresumen($parametros['resumen']);
            if (isset($parametros['url0']) && $parametros['url0'] != "") {
                $obj->seturl($parametros['url0']);
            } else {
                $obj->seturl(NULL);
            }
            if (isset($parametros['lugarn']) && $parametros['lugarn'] != "") {
                $obj->setlugarn($parametros['lugarn']);
            } else {
                $obj->setlugarn('NULL');
            }
            if (isset($parametros['tnoticia']) && $parametros['tnoticia'] != "") {
                $obj->settnoticia($parametros['tnoticia']);
            } else {
                $obj->settnoticia('NULL');
            }
            if (isset($parametros['snoticia']) && $parametros['snoticia'] != "") {
                $obj->setsnoticia($parametros['snoticia']);
            } else {
                $obj->setsnoticia('NULL');
            }
            if (isset($parametros['tmedio']) && $parametros['tmedio'] != "") {
                $obj->settmedio($parametros['tmedio']);
            } else {
                $obj->settmedio('NULL');
            }
            if (isset($parametros['genero']) && $parametros['genero'] != "") {
                $obj->setgenero($parametros['genero']);
            } else {
                $obj->setgenero('NULL');
            }
            if (isset($parametros['medio']) && $parametros['medio'] != "") {
                $obj->setmedio($parametros['medio']);
            } else {
                $obj->setmedio('NULL');
            }
            if (isset($parametros['etapa']) && $parametros['etapa'] != "") {
                $obj->setetapa($parametros['etapa']);
            } else {
                $obj->setetapa(NULL);
            }
            if (isset($parametros['calif']) && $parametros['calif'] != "") {
                $obj->setcalif($parametros['calif']);
            } else {
                $obj->setcalif('NULL');
            }
            if (isset($parametros['fpub']) && $parametros['fpub'] != "") {
                $obj->setfpub($parametros['fpub']);
            } else {
                $obj->setfpub(NULL);
            }
            if (isset($parametros['fview']) && $parametros['fview'] != "") {
                $obj->setfview($parametros['fview']);
            } else {
                $obj->setfview(NULL);
            }
            if (isset($parametros['eje']) && $parametros['eje'] != "") {
                $obj->setidEje($parametros['eje']);
            } else {
                $obj->setidEje('NULL');
            }
            if (isset($parametros['area']) && $parametros['area'] != "") {
                $obj->setidArea($parametros['area']);
            } else {
                $obj->setidArea('NULL');
            }
            if (isset($parametros['actividad']) && $parametros['actividad'] != "") {
                $obj->setidAct($parametros['actividad']);
            } else {
                $obj->setidAct('NULL');
            }
            $obj->setExpo($parametros['expo']);
            $obj->setEvento($parametros['evento']);

            $ruta = "resources/aplicaciones/Noticias/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $ruta . $_FILES[0]['name'])) {
                    //echo '2';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $name = $ruta . "(1)" . $archivo;
                } else {

                   // echo '3';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $name = $ruta . $archivo;
                }
               // echo '4';
                $obj->setArchivo($nombre);
                $obj->setRutaArchivo($ruta);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $name);
            } else {
                //echo '5';
                $obj->setArchivo("");
                $obj->setRutaArchivo("");
            }

            $obj->setUsrCreacion($_SESSION['user_session']);
            $obj->setUsrModificacion($_SESSION['user_session']);

            if ($obj->agregarNoticia()) {
                echo "Se agrego la Noticia correctamente.";
                if(isset($parametros['tamanoUrl']) and $parametros['tamanoUrl']!=""){
                    $cont_inicio =0;
                    while($cont_inicio<$parametros['tamanoUrl']){
                        $obj->seturl($parametros['url'.$cont_inicio ]);
                        if ($obj->new_urlnoticia()){

                        }else{
                            echo "No se registraron las URL.";
                            exit;
                        }
                        $cont_inicio++;
                    }
                }
            } else {
                echo "Error: No se pudo agregar la Noticia.";
            }
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setidNoticia($_POST['id']);

            $obj->setfnoticia($parametros['fnoticia']);
            $obj->settitulo($parametros['titulo']);
            if (isset($parametros['autor']) && $parametros['autor'] != "") {
                $obj->setautor($parametros['autor']);
            } else {
                $obj->setautor('NULL');
            }
            $obj->setresumen($parametros['resumen']);
            $obj->seturl($parametros['url0']);
            if (isset($parametros['lugarn']) && $parametros['lugarn'] != "") {
                $obj->setlugarn($parametros['lugarn']);
            } else {
                $obj->setlugarn('NULL');
            }
            if (isset($parametros['tnoticia']) && $parametros['tnoticia'] != "") {
                $obj->settnoticia($parametros['tnoticia']);
            } else {
                $obj->settnoticia('NULL');
            }
            if (isset($parametros['snoticia']) && $parametros['snoticia'] != "") {
                $obj->setsnoticia($parametros['snoticia']);
            } else {
                $obj->setsnoticia('NULL');
            }
            if (isset($parametros['tmedio']) && $parametros['tmedio'] != "") {
                $obj->settmedio($parametros['tmedio']);
            } else {
                $obj->settmedio('NULL');
            }
            if (isset($parametros['genero']) && $parametros['genero'] != "") {
                $obj->setgenero($parametros['genero']);
            } else {
                $obj->setgenero('NULL');
            }
            if (isset($parametros['medio']) && $parametros['medio'] != "") {
                $obj->setmedio($parametros['medio']);
            } else {
                $obj->setmedio('NULL');
            }
            if (isset($parametros['etapa']) && $parametros['etapa'] != "") {
                $obj->setetapa($parametros['etapa']);
            } else {
                $obj->setetapa(NULL);
            }
            if (isset($parametros['calif']) && $parametros['calif'] != "") {
                $obj->setcalif($parametros['calif']);
            } else {
                $obj->setcalif('NULL');
            }
            if (isset($parametros['fpub']) && $parametros['fpub'] != "") {
                $obj->setfpub($parametros['fpub']);
            } else {
                $obj->setfpub(NULL);
            }
            if (isset($parametros['fview']) && $parametros['fview'] != "") {
                $obj->setfview($parametros['fview']);
            } else {
                $obj->setfview(NULL);
            }
            if (isset($parametros['eje']) && $parametros['eje'] != "") {
                $obj->setidEje($parametros['eje']);
            } else {
                $obj->setidEje('NULL');
            }
            if (isset($parametros['area']) && $parametros['area'] != "") {
                $obj->setidArea($parametros['area']);
            } else {
                $obj->setidArea('NULL');
            }
            if (isset($parametros['actividad']) && $parametros['actividad'] != "") {
                $obj->setidAct($parametros['actividad']);
            } else {
                $obj->setidAct('NULL');
            }
            $obj->setExpo($parametros['expo']);
            $obj->setEvento($parametros['evento']);

            $ruta = "resources/aplicaciones/Noticias/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $ruta . $_FILES[0]['name'])) {
                    //echo '2';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $name = $ruta . "(1)" . $archivo;
                } else {

                   // echo '3';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $name = $ruta . $archivo;
                }
               // echo '4';
                $obj->setArchivo($nombre);
                $obj->setRutaArchivo($ruta);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $name);
            } else {
                //echo '5';
                $obj->setArchivo("");
                $obj->setRutaArchivo("");
            }

            $obj->setUsrModificacion($_SESSION['user_session']);


            if ($obj->editarNoticia()) {
                echo "Se edito la Noticia correctamente.";
            } else {
                echo "Error: No se pudo editar la Noticia.";
            }

            break;
        case 'eliminar':
            $obj->setidNoticia($_POST['id']);
            if ($obj->eliminarNoticia()) {
                echo 'Éxito: Se ha eliminado la Noticia';
            } else {
                echo 'Error: No se ha podido eliminar la Noticia';
            }
            break;
        }
    } elseif (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
        $eje = "";
        $area = "";
        $Actividad = "";

        $eje = $_POST['act'];
        $area = $_POST['area'];
        //$area = $_POST['area'];
        //echo "EJE: " . $eje;
        //echo "AREA: " . $area;

        if ($eje != 0) {
            $consulta = " SELECT act.IdActividad,CONCAT(act.Numeracion,' ',act.Nombre) Nombre FROM c_actividad act WHERE act.IdTipoActividad = 1 AND act.IdEje = $eje AND act.Anio = if((SELECT COUNT(*) FROM c_actividad WHERE act.Anio = YEAR(NOW()) ) > 0,YEAR(NOW()),2020) ORDER BY act.Nombre; ";

            //echo "<br> ACTIVIDAD: " . $consulta;
            $resultado = $catalogo->obtenerLista($consulta);
            echo '<option value="">Seleccione una opción</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                $s = '';
                if ($row['IdActividad'] == $Actividad) {

                    $s = 'selected="selected"';
                } echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
             }
         } elseif ($area != 0) {
             $consulta = "SELECT act.IdActividad,CONCAT(act.Numeracion,' ',act.Nombre) Nombre FROM c_actividad act WHERE act.IdTipoActividad = 1 AND act.IdEje = $eje AND act.Anio = if((SELECT COUNT(*) FROM c_actividad WHERE act.Anio = YEAR(NOW()) ) > 0,YEAR(NOW()),2020) ORDER BY act.Nombre; ";

            //echo "<br> ACTIVIDAD: " . $consulta;
            $resultado = $catalogo->obtenerLista($consulta);
            echo '<option value="">Seleccione una opción</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                $s = '';
                if ($row['IdActividad'] == $Actividad) {

                    $s = 'selected="selected"';
                } echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Actividad'] . '</option>';
             }
         }
    }
?>
