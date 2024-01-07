<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/GestionarImagenes.class.php');

include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new GestionarImagenes();

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
            $obj->setTotalImagenes($parametros['totalImagenes']);
            $obj->setImagenesCatalograficas($parametros['catalograficas']);
            $obj->setImagenesComplementarias($parametros['complementarias']);
            $obj->setFechaEntregaCatalograficas($parametros['fechaEntregaImagenesCatalograficas']);
            $obj->setFechaEntregaAmbas($parametros['fechaEntregaAmbasImagenes']);
            $obj->setFechaEntregaComplementarias($parametros['fechaEntregaImagenesComplementarias']);


            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarImagenes/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaCatalograficas($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaCatalograficas("");
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

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaComplementarias($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaComplementarias("");
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

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaAmbas($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaAmbas("");
            }

            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_gestionarImagenes.php');
            if($obj->agregarGestionarImagenes()){

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
            $obj->setTotalImagenes($parametros['totalImagenes']);
            $obj->setImagenesCatalograficas($parametros['catalograficas']);
            $obj->setImagenesComplementarias($parametros['complementarias']);
            $obj->setFechaEntregaCatalograficas($parametros['fechaEntregaImagenesCatalograficas']);
            $obj->setFechaEntregaAmbas($parametros['fechaEntregaAmbasImagenes']);
            $obj->setFechaEntregaComplementarias($parametros['fechaEntregaImagenesComplementarias']);

            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/GestionarImagenes/";
           if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaPDF . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF ."(".$_POST['id'].")" . $archivo;

                    $namesoloimagen= "(".$_POST['id'].")".$archivo;

               } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaCatalograficas($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaCatalograficas("");
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

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaComplementarias($namesoloimagen);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaComplementarias("");
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

                    $nameimg = $rutaPDF .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaAmbas($namesoloimagen);

                move_uploaded_file($_FILES[2]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaAmbas("");
            }

            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_gestionarImagenes.php');

            if($obj->editarGestionarImagenes()){

               echo "Éxito: El registro se modifico correctamente";
            }else{
              echo 'Error: El registro no se ha podido modificar';
            }
            break;

        case 'eliminar':
          //echo "Entra controller eliminar";


            break;
    }
}