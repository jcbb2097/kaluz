<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/PVP.class.php');

include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new PVP();



if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setIdLibro($_POST['id']);
            $obj->setMontoPresupuesto($parametros['montoPresupuesto']);
            $obj->setFechaEntregaPresupuesto($parametros['fechaEntregaPresupuesto']);
            $obj->setPresupuestoOrigenes($parametros['presupuestoOrigenes']);
            $obj->setPresupuestoEjercido($parametros['presupuestoEjercido']);
            $obj->setCostoTiraje($parametros['costoTiraje']);
            $obj->setCostoProduccion($parametros['produccion']);
            $obj->setPVP($parametros['pvp']);
            $obj->setPorcentajeCoedicion($parametros['coedicion']);
            $obj->setCostoProduccionUnitario($parametros['produccionUnitario']);
            $obj->setIdPatrocinador($parametros['patrocinador']);
            $obj->setIdPuntosDeVenta($parametros['pventa']);
            $obj->setReimpresion($parametros['reimpresion']);
           
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/CalculoPVP/";
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

                    $nameimg = $rutaPDF . "(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")". $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaExcelPresupuesto($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaExcelPresupuesto("");
            }

           
            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_PVP.php');
            if($obj->agregarPVP()){

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
            $obj->setMontoPresupuesto($parametros['montoPresupuesto']);
            $obj->setFechaEntregaPresupuesto($parametros['fechaEntregaPresupuesto']);
            $obj->setPresupuestoOrigenes($parametros['presupuestoOrigenes']);
            $obj->setPresupuestoEjercido($parametros['presupuestoEjercido']);
            $obj->setCostoTiraje($parametros['costoTiraje']);
            $obj->setCostoProduccion($parametros['produccion']);
            $obj->setPVP($parametros['pvp']);
            $obj->setPorcentajeCoedicion($parametros['coedicion']);
            $obj->setCostoProduccionUnitario($parametros['produccionUnitario']);
            $obj->setIdPatrocinador($parametros['patrocinador']);
            $obj->setIdPuntosDeVenta($parametros['pventa']);
            $obj->setReimpresion($parametros['reimpresion']);
           
            $rutaPDF = "resources/aplicaciones/Entregables/Publicaciones/CalculoPVP/";
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

                    $nameimg = $rutaPDF . "(".$_POST['id'].")".  $resultado;
                    $namesoloimagen= "(".$_POST['id'].")". $resultado;
                }
                //echo '<br>4<br>';
                $obj->setRutaExcelPresupuesto($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setRutaExcelPresupuesto("");
            }

            $obj->setUsuarioUltimaModificiacion($_POST['usuario']);
            $obj->setUsuarioCreacion($_POST['usuario']);
            $obj->setPantalla('Controller_PVP.php');

            if($obj->editarPVP()){

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