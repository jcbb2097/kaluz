<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/ImpresionPublicacion.class.php');

include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new ImpresionPublicacion();

//$fecha = date("Y_m_d");
//$Tiempo = date("h:i");
//echo "Fecha: ".$fecha."<br>";
//echo "Hora: ".$Tiempo."<br>";
//$fechaHora = $fecha."_".date("h").date("i");
//echo "<br>".$fechaHora."<br>";

if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setIdLibro($_POST['id']);
            $obj->setIdPreprensa($parametros['preprensista']);
            $obj->setIdImprenta($parametros['imprenta']);
            $obj->setFechaEntregaPruebasColor($parametros['fechaPruebasColor']);
            $obj->setFechaEntregaPieImprenta($parametros['fechaEntregaPieImprenta']);
            $obj->setFechaEntregaVboSTecnicaImpFinal($parametros['fechaImpresionFinal']);
            

            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/CoordinarImpresion/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF . "(".$_POST['id'].")" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")".$resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaPruebasColor($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaPruebasColor("");
            }

             if (isset($_FILES[1])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[1]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")". $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")".$resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaVboPieImprenta($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaVboPieImprenta("");
            }

             if (isset($_FILES[2])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[2]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")". $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")".$resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaVoboSTecnicaImpFinal($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaVoboSTecnicaImpFinal("");
            }

            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_impresionPublicacion.php');
            if($obj->agregarImpresionPublicacion()){

               echo "Éxito: El registro se guardo correctamente";
            }else{
              echo 'Error: El registro no se ha podido guardar';
            }
            break;

        case 'editar':

            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           $obj->setIdLibro($_POST['id']);
            $obj->setIdPreprensa($parametros['preprensista']);
            $obj->setIdImprenta($parametros['imprenta']);
            $obj->setFechaEntregaPruebasColor($parametros['fechaPruebasColor']);
            $obj->setFechaEntregaPieImprenta($parametros['fechaEntregaPieImprenta']);
            $obj->setFechaEntregaVboSTecnicaImpFinal($parametros['fechaImpresionFinal']);
            

            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/CoordinarImpresion/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF . "(".$_POST['id'].")" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")".$resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaPruebasColor($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaPruebasColor("");
            }

             if (isset($_FILES[1])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[1]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")". $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[1]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[1]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")".$resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaVboPieImprenta($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaVboPieImprenta("");
            }

             if (isset($_FILES[2])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[2]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")". $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[2]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[2]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")".$resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaVoboSTecnicaImpFinal($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaVoboSTecnicaImpFinal("");
            }

            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_impresionPublicacion.php');
            if($obj->editarImpresionPublicacion()){

               echo "Éxito: El registro se guardo correctamente";
            }else{
              echo 'Error: El registro no se ha podido guardar';
            }

            break;

        case 'eliminar':
          //echo "Entra controller eliminar";


            break;
    }
}