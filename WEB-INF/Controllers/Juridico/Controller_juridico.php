<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/Juridico.class.php");
$catalogo = new Catalogo();
$obj = new Juridico();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_periodo($parametros['ano']);
            if($parametros['Expotem']!=''){
                $obj->setId_Exposicion($parametros['Expotem']);
            }else{
                $obj->setId_Exposicion('NULL');
            }
            $obj->setId_Instrumento($parametros['Instrumento']);
            $obj->setId_subtipo($parametros['Sub_tipo']);
            $obj->setTipo_contrato($parametros['Tipo']);
            $obj->setObjeto($parametros['Objeto']);
            $obj->setFee_pago($parametros['Pago_derechos']);
            $obj->setPago_seguro($parametros['Pago_seguro']);
            $obj->setComite_transporte($parametros['transporte']);
            $obj->setFecha_pago_contraparte($parametros['Fecha_pagos']);
            $obj->setNum_obra($parametros['num_obras']);
            $obj->setBorrador($parametros['Borrador']);
            $obj->setAvance($parametros['Avance']);
            $obj->setEstatus($parametros['Estatus']);
            $obj->setContraparte_gestor($parametros['Contraparte_gestor']);
            if($parametros['Eje']!=''){
                $obj->setId_eje($parametros['Eje']);
            }else{
                $obj->setId_eje('NULL');
            }
            if($parametros['institucion']!=''){
                $obj->setAtraves($parametros['institucion']);
            }else{
                $obj->setAtraves('NULL');
            }
            if($parametros['contra']!=''){
                $obj->setContraparte($parametros['contra']);
            }else{
                $obj->setContraparte('NULL');
            }

            if(isset($parametros['actividad']) && $parametros['actividad']!=''){
                $obj->setAct($parametros['actividad']);
            }else{
                $obj->setAct('NULL');
            }
            if($parametros['area']!=''){
                $obj->setArea($parametros['area']);
            }else{
                $obj->setArea('NULL');
            }

            $rutaimg = "resources/aplicaciones/PDF/Juridico/";
            if (isset($_FILES[0])) {
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg . "(1)" . $archivo;
                    $namesoloimagen = "(1)" . $archivo;
                } else {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen = $resultado;
                }
                $obj->setArchivo($namesoloimagen);
                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                $obj->setArchivo("");
            }
            $obj->setUsuario_creacion("SIE");
            $obj->setUsuario_ultima_modificacion("SIE");
            $obj->setPantalla('AltaAcuerdos.php');
            if ($obj->Nuevo_juridico()) {
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
            $obj->setId_juridico($_POST['id']);
            $obj->setId_periodo($parametros['ano']);
            if($parametros['Expotem']!=''){
                $obj->setId_Exposicion($parametros['Expotem']);
            }else{
                $obj->setId_Exposicion('NULL');
            }
            $obj->setId_Instrumento($parametros['Instrumento']);
            $obj->setId_subtipo($parametros['Sub_tipo']);
            $obj->setTipo_contrato($parametros['Tipo']);
            $obj->setObjeto($parametros['Objeto']);
            $obj->setFee_pago($parametros['Pago_derechos']);
            $obj->setPago_seguro($parametros['Pago_seguro']);
            $obj->setComite_transporte($parametros['transporte']);
            $obj->setFecha_pago_contraparte($parametros['Fecha_pagos']);
            $obj->setNum_obra($parametros['num_obras']);
            $obj->setBorrador($parametros['Borrador']);
            $obj->setAvance($parametros['Avance']);
            $obj->setEstatus($parametros['Estatus']);
            $obj->setContraparte_gestor($parametros['Contraparte_gestor']);
            if($parametros['Eje']!=''){
                $obj->setId_eje($parametros['Eje']);
               // echo'entra con dato';
            }else{
                $obj->setId_eje('NULL');
               // echo'entra sin dato';
            }
            if($parametros['institucion']!=''){
                $obj->setAtraves($parametros['institucion']);
            }else{
                $obj->setAtraves('NULL');
            }
            if($parametros['contra']!=''){
                $obj->setContraparte($parametros['contra']);
            }else{
                $obj->setContraparte('NULL');
            }

            if(isset($parametros['actividad']) && $parametros['actividad']!=''){
                $obj->setAct($parametros['actividad']);
            }else{
                $obj->setAct('NULL');
            }
            if($parametros['area']!=''){
                $obj->setArea($parametros['area']);
            }else{
                $obj->setArea('NULL');
            }

            $rutaimg = "resources/aplicaciones/PDF/Juridico/";
            if (isset($_FILES[0])) {
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg . "(1)" . $archivo;
                    $namesoloimagen = "(1)" . $archivo;
                } else {
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_", $archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);
                    $nombre = $_FILES[0]['name'];
                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen = $resultado;
                }
                $obj->setArchivo($namesoloimagen);
                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                $obj->setArchivo("");
            }
            $obj->setUsuario_ultima_modificacion("SIE");
            if ($obj->Editar_juridico()) {
                echo 'Éxito: El Registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el Registro';
            }



            break;
        case 'eliminar':

            $obj->setId_juridico($_POST['id']);
            if ($obj->Eliminar_juridico()) {

                echo 'Éxito: Se ha eliminado registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
} elseif (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
        $eje = "";
        $area = "";
        $Actividad = "";

        $eje = $_POST['act'];
        //$area = $_POST['area'];
        //$area = $_POST['area'];
        /*echo "EJE: " . $eje;
        echo "AREA: " . $area;*/

        if ($eje != 0) {
            $consulta = "  SELECT CONCAT(ca.Numeracion,' ',ca.Nombre)as nombre,ca.IdActividad  FROM c_actividad ca WHERE ca.IdEje = $eje AND ca.IdTipoActividad = 1 ORDER By ca.Numeracion,ca.Orden  ";

            //echo "<br> ACTIVIDAD: " . $consulta;
            $resultado = $catalogo->obtenerLista($consulta);
            echo '<option value="">Seleccione una opción</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                $s = '';
                if ($row['IdActividad'] == $Actividad) {

                    $s = 'selected="selected"';
                } echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
             }
         }
    }
?>
