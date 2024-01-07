<?php

include_once('../Classes/Categorias.class.php');
include_once('../Classes/Planeacion.class.php');
include_once('../Classes/Check.class.php');
include_once('../Classes/ActividadCategoria.class.php');
include_once('../Classes/ActividadAnio.class.php');
include_once('../../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
$cate = new Categoria();
$obj = new Planeacion();
$check = new Check();
$Accate = new Actividad_Categoria();
$Acan = new Actividad_Anio();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    switch ($_POST['accion']) {
        case 'Deactivate':
            if ($_POST['tipo'] == 1) {
                $Activa = 1;
                $exito = "activada";
            } else {
                $Activa = 0;
                $exito = "desactivada";
            }
            $ids = $_POST['id'];
            //$cate->get_categorias($_POST['id'], $_POST['ACME'], $_POST['periodo']);
            $cate->setACME($_POST['ACME']);
            $cate->setVisible($Activa);
            $cate->setAnio($_POST['periodo']);
            if ($cate->DeactivateCategoria($ids)) {
                // $Accate->setActivo($Activa);
                // $Accate->setIdPeriodo($_POST['Id_periodo']);
                // $Accate->setIdCategoria($ids);
                // $Accate->DeactivateAct();
                // $check->setVisible($Activa);
                // $check->setId_Periodo($_POST['Id_periodo']);
                // $check->setIdCategoria($ids);
                // $check->Deactive_check_categoria($_POST['ACME']);
                echo "Éxito:La Categoría ha sido" . $exito;
            } else {
                echo "Error:La Categoría no ha sido" . $exito;
            }
            break;
        case 'activar':
            if ($_POST['tipo'] == 1) {
                $Activa = 1;
            } else {
                $Activa = 0;
            }
            $ids = $_POST['id'];
            //$obj->get_ACME($_POST['id']);
            $Accate->setIdActividad($ids);
            $Accate->setIdCategoria($_POST['id_categoria']);
            $Accate->setIdPeriodo($_POST['id_periodo']);
            $Accate->setActivo($Activa);
            $accion = $Accate->DeactivateAct();
            /*  $Acan->setIdActividad($ids);
            $Acan->setVisible($Activa);
            $Acan->setAnio($_POST['Periodo']);
            $Acan->DeactivateACME(); */
            //$accion = $check->deactivate_check_actividad($_POST['id_categoria'], $_POST['id_periodo'], $ids, $Activa);
            if ($accion == true && $_POST['tipo'] == 1) {
                echo "Activada correctamente";
            } elseif ($accion == true && $_POST['tipo'] == 2) {
                echo "Desactivada correctamente";
            } else {
                echo "Error: contacta al equipo de sistemas";
            }

            break;
        case 'Deactivatecheck':
            if ($_POST['tipo'] == 1) {
                $Activa = 1;
                $exito = "activada";
            } else {
                $Activa = 0;
                $exito = "desactivada";
            }
            $deactivate = $check->deactivate_check($_POST['id'], $_POST['periodo'], $_POST['idactividad'], $Activa, $_POST['idcategoria']);
            if ($deactivate == true && $_POST['tipo'] == 1) {
                echo "Activada correctamente";
            } elseif ($deactivate == true && $_POST['tipo'] == 2) {
                echo "Desactivada correctamente";
            } else {
                echo "Error: contacta al equipo de sistemas";
            }
            break;
        case 'actualizar':
            $check_a_actualizar = array();
            $consula = "SELECT
             ch.IdCheckList,ch.Avance
            FROM k_checklist_actividad ch
             INNER JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList
             INNER JOIN c_actividad a on a.IdActividad=ch.IdActividad
            WHERE
             ch.IdActividad = " . $_POST['id_actividad'] . "
             AND ch.Id_Periodo = " . $_POST['periodo'] . "
             AND c.Nivel = 1
             AND c.Tipo = 2
             AND ch.Idcategoria =" . $_POST['categoria'] . " AND ch.Visible=1
            ORDER BY
             ch.Orden";
            $resul = $catalogo->obtenerLista($consula);

            while ($row = mysqli_fetch_array($resul)) {
                array_push($check_a_actualizar, $row['IdCheckList']);
            }
            for ($i = 0; $i < count($check_a_actualizar); $i++) {
                $avance = $check->avance_subchecks($_POST['id_actividad'], $_POST['periodo'], $_POST['categoria'], $check_a_actualizar[$i]);
                $check->Actualiza_avance($avance, $_POST['periodo'], $check_a_actualizar[$i], $_POST['id_actividad'], $_POST['categoria']);
            }

            break;
        case 'buscaCheck':
            $data = array();
            $ids = array();
            $nombreCheck = $_POST['nombre'];
            $posicion = $_POST['posicion'];
            $consula = "SELECT
            c.IdCheckList,c.Nombre,c.Tipo,(SELECT COUNT(a.IdCheckList) FROM c_checkList a WHERE a.IdCheckListPadre=c.IdCheckList) hijos
            ,c.IdResponsable
        FROM c_checkList c
        WHERE c.Nivel = 1 AND c.Nombre like'%$nombreCheck%' AND c.Estructura=1
        ORDER BY c.Nombre LIMIT 10";
            //echo $consula;
            $resul = $catalogo->obtenerLista($consula);
            $nombre = "";
            while ($row = mysqli_fetch_array($resul)) {
                if ($row['Tipo'] == 2) {
                    $nombre = $row['Nombre'] . "(con hijos)";
                } else {
                    $nombre = $row['Nombre'] . "(sin hijos)";
                }
                $JSONData = '{"id": "' . $row['IdCheckList'] . '",  "nombre": "' . $nombre . '","nivel":"' . $row['Tipo'] . '","posicion":"' . $posicion . '","responsable":"' . $row['IdResponsable'] . '"}';
                array_push($ids, $JSONData);
                /*  echo print_r($json); */
            }
            $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
            $total = count($ids);
            for ($i = 0; $i < count($ids); $i++) {
                $micoma = "";
                if ($i == 0) {
                    $miComa = "";
                } else {
                    $miComa = ",";
                } //Solo la primera vez se concatena la coma cbc
                $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
            }
            $jsonFinal = '[' . $IdsDeCategoria . ']';

            if (count($ids) > 0) {
                $data['status'] = 'ok';
                $data['result'] = $jsonFinal;
            } else {
                $data['status'] = 'err';
                $data['result'] = '';
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
