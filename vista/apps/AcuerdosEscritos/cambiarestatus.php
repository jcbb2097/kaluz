<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
include_once('../../../WEB-INF/Classes/ActividadAcuerdo.class.php');

$catalogo = new Catalogo();
$acuerdo = new documento();
$editar = false;
$contadorac = 0;
$contadorar = 0;
$estatus = "";
$periodo2 = "";
$tipoPerfil = "";
$periodo_actual = "";

$IdAcuerdo=""; //Se inicializa la variable
if ((isset($_GET['idacuerdo']) && $_GET['idacuerdo'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idacuerdo']!="0") {$IdAcuerdo ="".$_GET['idacuerdo'];} //Si el parametro es diferente de 0 se busca el valor
    else { $IdAcuerdo="0"; } //Si el parametro es igual a 0 se buscan los NULOS
}
//echo $IdAcuerdo;

$TipoPerfil=""; //Se inicializa la variable
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) //Si el parametro existe se procesa
{   if ($_GET['tipoPerfil']!="0") {$TipoPerfil ="".$_GET['tipoPerfil'];} //Si el parametro es diferente de 0 se busca el valor
    else { $TipoPerfil="Sin valor"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$idUsuario=""; //Se inicializa la variable
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idUsuario']!="0") {$idUsuario ="".$_GET['idUsuario'];} //Si el parametro es diferente de 0 se busca el valor
    else { $idUsuario="Sin valor"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$nombreUsuario=""; //Se inicializa la variable
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) //Si el parametro existe se procesa
{   if ($_GET['nombreUsuario']!="0") {$nombreUsuario ="".$_GET['nombreUsuario'];} //Si el parametro es diferente de 0 se busca el valor
    else { $nombreUsuario="Sin valor"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="tipoPerfil" name="tipoPerfil" value="' . $_GET['tipoPerfil'] . '"/>';
    echo '<input type="hidden" id="nombreUsuario" name="nombreUsuario" value="' . $_GET['nombreUsuario'] . '"/>';
    echo '<input type="hidden" id="idUsuario" name="idUsuario" value="' . $_GET['idUsuario'] . '"/>';
    
    if ($_GET['accion'] == "editarcheck") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['idacuerdo'] . '"/>';
    }else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}

if ($editar == true) {
    $acuerdo->setId_acuerdo_escrito($_GET['idacuerdo']);
    $objAcuerdoEscrito = new actividades();
    $idacuerdo = $_GET['idacuerdo'];
    $acuerdo->getAcuerdo($_GET['idacuerdo']);
    $periodo2 = $acuerdo->getAnio();
    $contadorac = $acuerdo->getId_destino();
    $contadorar = $acuerdo->getId_destino2();
    $objAcuerdoEscrito->setId_acuerdo($_GET['idacuerdo']);
    $resultAcuerdoActividad = $objAcuerdoEscrito->getActividades();
    echo '<input type="hidden" id="ons" name="ons" value="' . $estatus . '"/>';
}

/*$count = 0;
$validafirmasexisten = "SELECT estatus FROM k_acuerdoactividad WHERE id_acuerdo=$IdAcuerdo";
$resulvalida = $catalogo->obtenerLista($validafirmasexisten);
while ($row = mysqli_fetch_array($resulvalida)) {
    //echo $row['estatus']."<br>";
    if($row['estatus'] == "0"){
        //echo "<br>faltan";
    }else{
        //echo "<br>esta lleno";
        $count++;
        $validallenadopdf = "SELECT count(*) as total FROM k_acuerdoactividad WHERE id_Acuerdo=$IdAcuerdo";
        $resul = $catalogo->obtenerLista($validallenadopdf);
        while ($row = mysqli_fetch_array($resul)) {
          $totalregistros = $row['total'];
        }
        //echo $totalregistros;
        if ($count == $totalregistros){
        $query="UPDATE c_acuerdospdf SET estatus = 1, fecha_realizado= NOW() where id_acuerdo_escrito=".$idacuerdo;
        //echo $query;
        //$query = $catalogo->ejecutaConsultaActualizacion($query, 'c_acuerdospdf', 'id_acuerdo_escrito='.$idacuerdo);
        }
    }
    }*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO ACUERDO ESCRITO.::</title>

    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>

    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/AcuedosEscritos/Acciones_acuerdo.js"></script>
    <script src="../../../resources/js/aplicaciones/AcuedosEscritos/Alta_acuerdo.js"></script>
    </head>
    <body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / 
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $tipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Acuerdos</a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Cambiar estatus acuerdo</a></div>
    <div class="well2 wr">
        <a style="color:#fefefe;" href="Vista.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Lista_acuerdos.php?nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Lista Acuerdos</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Acuerdosfocos.php?usuario=<?php echo $nombreUsuario; ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=1&idUsuario=<?= $idUsuario ?>">Focos</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Alta_acuerdo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Agregar +</a>  
    </div>
    <div id="container">
    <form class="form-horizontal" id="formAcuerdoEscrito" name="formAcuerdoEscrito">
    <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
    <div class="form-group form-group-sm">
        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="display:none;">* Periodo</label>
                        <div class="col-md-2 col-sm-2 col-xs-2" style="display:none;">
                            <select id="ano" class="form-control" name="ano" onchange="">
                                <option value="">Seleccione un Periodo</option>
                                <?php
                                $Ano = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo as p WHERE p.CPE_ESTATUS=1 ORDER BY p.Periodo DESC";
                                $resulaño = $catalogo->obtenerLista($Ano);
                                while ($row = mysqli_fetch_array($resulaño)) {
                                    if ($periodo2 == $row['Id_Periodo'] && $editar == true) {
                                        $selected = "selected";
                                    } else if ($periodo_actual == $row['Id_Periodo'] && $editar == false) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
        <?php
        $indice = 0;
        $numerodeacuerodos=1;
        $IdProyecto = 0;
        $IdExposición = 0;
        $IdTipoConcepto = 0;
        $IdGlobal = 0;
        $IdGeneral = 0;
        $Id_categoria = 0;
        $Id_subcategoria = 0;
        $Descripcion_acuerdo = 0;
        $Tipo_acuerdo = 0;
        $estatus = 0;
        $Check = 0;
        $Subcheck=0;
        $acuerdoestatus=0;
        while ($rowAcuerdoActividad = mysqli_fetch_array($resultAcuerdoActividad)) {
                            $Ideditar = $rowAcuerdoActividad['id_acuerdoactividad'];
                            $IdProyecto = $rowAcuerdoActividad['id_proyecto'];
                            $IdExposición = $rowAcuerdoActividad['id_exposicion'];
                            $IdTipoConcepto = $rowAcuerdoActividad['id_tipo'];
                            $IdGlobal = $rowAcuerdoActividad['id_actividad1'];
                            $IdGeneral = $rowAcuerdoActividad['id_actividad2'];
                            $IdParticular = $rowAcuerdoActividad['id_actividad3'];
                            $IdSubActividad = $rowAcuerdoActividad['id_actividad4'];
                            $resdsd = $rowAcuerdoActividad['resolucion'];
                            $Id_categoria = $rowAcuerdoActividad['id_categoria'];
                            $Id_subcategoria = $rowAcuerdoActividad['id_subcategoria'];
                            $Descripcion_acuerdo = $rowAcuerdoActividad['DescAcuerdo'];
                            $Tipo_acuerdo = $rowAcuerdoActividad['TipoAcuerdo'];
                            $estatus = $rowAcuerdoActividad['estatus'];
                            $Check = $rowAcuerdoActividad['Id_check'];
                            $Subcheck = $rowAcuerdoActividad['subcheck'];
                            $acuerdoestatus = $rowAcuerdoActividad['Id_acuerdoestatus'];

                            if ($IdGeneral > 0) {
                            $Actividad = $IdGeneral;
                            } else {
                            $Actividad = $IdGlobal;
                            }
                            ?>             
                            <div class="form-group form-group-sm" style="display:none;">
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="width: 110px; ">* Descripción Acuerdo:</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <textarea class="form-control" id="descripcionacuerdo<?php echo $indice; ?>" name="descripcionacuerdo<?php echo $indice; ?>" ><?php echo $Descripcion_acuerdo; ?></textarea>
                            </div>
                            <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="width: 110px; ">* Tipo Acuerdo:</label>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                               <select id="tipoacuerdo<?php echo $indice; ?>" class="form-control" name="tipoacuerdo<?php echo $indice; ?>"  style="width: 200px; ">
                                   <option value="">Selecciona un Tipo Acuerdo</option>
                                   <?php 
                                   $selectconocimiento = "";
                                   $selectproblematica = "";
                                   $selectsolicitud = "";
                                   $selectsugerencia = "";
                                   if($Tipo_acuerdo == "Conocimiento") $selectconocimiento = "Selected";
                                           
                                    if($Tipo_acuerdo == "Problematica") $selectproblematica = "Selected";

                                        if($Tipo_acuerdo == "Solicitud") $selectsolicitud = "Selected";

                                        if($Tipo_acuerdo == "Sugerencia") $selectsugerencia = "Selected";
                                   ?>
                                   <option value="Conocimiento" <?php echo $selectconocimiento?>>Conocimiento</option>
                                   <option value="Problematica" <?php echo $selectproblematica?>>Problematica</option>
                                   <option value="Solicitud" <?php echo $selectsolicitud?>>Solicitud</option>
                                   <option value="Sugerencia" <?php echo $selectsugerencia?>>Sugerencia</option>
                               </select>
                            </div>
                            </div>
                            <div class="form-group form-group-sm" style="display:none;">
                                <input type="hidden" id="id_edit<?php echo $indice; ?>" name="id_edit<?php echo $indice; ?>" value="<?php echo $Ideditar; ?>" />
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="width: 110px;">* Eje:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="Eje<?php echo $indice; ?>" style="width: 157px;" class="form-control" name="Eje<?php echo $indice; ?>" onchange="Categorias(<?php echo $indice; ?>);actividades1(<?php echo $indice; ?>);">
                                        <?php
                                        $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e";
                                        $resultado = $catalogo->obtenerLista($consultagiro);
                                        echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if ($row['idEje'] == $IdProyecto) {
                                                $s = 'selected="selected"';
                                            }
                                            echo '<option value="' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="width: 150px;">Categoría:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="cate<?php echo $indice; ?>" class="form-control" name="cate<?php echo $indice; ?>" onchange="Sub_Categorias(<?php echo $indice; ?>);actividades11(<?php echo $indice; ?>);" style="width: 157px;">
                                        <?php
                                        if ($Id_categoria) {
                                            $consultagiro = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$periodo2 AND ce.idEje=$IdProyecto ORDER BY ce.orden";
                                            $resultado = $catalogo->obtenerLista($consultagiro);
                                            echo '<option value="">Seleccione una opción</option>';
                                            while ($row = mysqli_fetch_array($resultado)) {
                                                $s = '';
                                                if ($row['idCategoria'] == $Id_categoria) {
                                                    $s = 'selected="selected"';
                                                }
                                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="width: 152px;">Sub categoría:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="subcate<?php echo $indice; ?>" class="form-control" name="subcate<?php echo $indice; ?>" onchange="actividades111(<?php echo $indice; ?>);" style="width: 157px;">
                                        <?php
                                        if ($Id_subcategoria) {
                                            $consultagiro = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Id_categoria ORDER BY ce.orden ";
                                            $resultado = $catalogo->obtenerLista($consultagiro);
                                            echo '<option value="">Seleccione una opción</option>';
                                            while ($row = mysqli_fetch_array($resultado)) {
                                                $s = '';
                                                if ($row['idCategoria'] == $Id_subcategoria) {
                                                    $s = 'selected="selected"';
                                                }
                                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" style="display:none;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO" style="width: 111px;">Exposición Temporal:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="Expotem<?php echo $indice; ?>" class="form-control" name="Expotem<?php echo $indice; ?>" style="width: 157px;">
                                        <?php
                                        $consultaperiodo6 = "SELECT e.idExposicion,e.tituloFinal FROM c_exposicionTemporal as e WHERE e.estatus=1 ORDER BY e.tituloFinal ";
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['idExposicion'] == $IdExposición) {
                                                $s = 'selected = "selected"';
                                            }
                                            echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* Actividad/Meta:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="acme<?php echo $indice; ?>" class="form-control" name="acme<?php echo $indice; ?>" onchange="actividadesmetaactividadglobal(<?php echo $indice; ?>);">
                                        <?php if ($IdTipoConcepto == 1) {
                                            echo '<option value="1" selected="selected">Actividad</option>';
                                            echo '<option value="2">Meta</option>';
                                        } else {
                                            echo '<option value="1">Actividad</option>';
                                            echo '<option value="2" selected="selected">Meta</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" style="display:none;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">* A/M. Global:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="ActvGlobal<?php echo $indice; ?>" class="form-control" name="ActvGlobal<?php echo $indice; ?>" onchange="actividades2(<?php echo $indice; ?>);checklist(<?php echo $indice; ?>);">
                                        <?php
                                        $Global = "";
                                        $consultaperiodo6 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a WHERE a.IdEje=$IdProyecto AND a.IdNivelActividad=1 AND IdTipoActividad=$IdTipoConcepto ORDER BY a.Orden";
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $IdGlobal) {
                                                $s = 'selected = "selected"';
                                                $Global = $row['actividad'];
                                            }
                                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. General:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="ActvGeneral<?php echo $indice; ?>" class="form-control" name="ActvGeneral<?php echo $indice; ?>" onchange="actividades3(<?php echo $indice; ?>);checklist(<?php echo $indice; ?>);">
                                        <?php
                                        $General = "";
                                        $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 2 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdGlobal
                                        ORDER BY a.Orden";
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $IdGeneral) {
                                                $s = 'selected = "selected"';
                                                $General =  $row['actividad'] ;
                                            }
                                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="col-md-5 col-sm-5 col-xs-5  control-label" for="AÑO"> Acuerdo <?php echo $numerodeacuerodos;?></label> 
                                <label class="col-md-7 col-sm-7 col-xs-7  control-label"><?php 
                                    if ($General == "") {
                                        echo "       ".$Global;
                                    }else{
                                        echo "       ".$General;
                                    }
                                    ?> </label>
                                
                                <label class="col-md-5 col-sm-5 col-xs-5  control-label" for="AÑO"><br>Acuerdo estatus:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2"><br>
                            <select id="acuerdoestatus<?php echo $indice; ?>" class="form-control" name="acuerdoestatus<?php echo $indice; ?>" style="width: 140px;">
                                    <?php
                                    $consultaacuerdoestatus= "SELECT aest.Id_acuerdoestatus AS Id_acuerdoestatus, aest.Descripcion AS des FROM c_acuerdoestatus AS aest";
                                    $resultadoacuerdoestatus = $catalogo->obtenerLista($consultaacuerdoestatus);
                                    echo '<option value = "">Seleccione</option>';
                                    while ($rowae = mysqli_fetch_array($resultadoacuerdoestatus)) {
                                        $s = '';
                                        if ($rowae['Id_acuerdoestatus'] == $acuerdoestatus) {
                                            $s = 'selected = "selected"';
                                        }
                                        echo '<option value = "' . $rowae['Id_acuerdoestatus'] . '" ' . $s . '>' . $rowae['des'] . '</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                                <?php 
                                //echo $estatus;
                                $check_realizado = "";
                                if ($estatus == "1") {
                                    $check_realizado = "checked";
                                }else{
                                    $check_realizado = "";
                                }
                                /*$consultaGeneral =  "SELECT estatus FROM k_acuerdoactividad WHERE id_acuerdo = $idacuerdo AND id_actividad1 =$IdGlobal";
                                $resultGeneral = $catalogo->obtenerLista($consultaGeneral);
                                $check_realizado = "";
                                while ($row = mysqli_fetch_array($resultGeneral)) {
                                    if ($row['estatus'] == $estatus) $check_realizado = "checked"; 
                                } */
                                ?>
                                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="display:none"></label>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="display:none">
                                    <input type="checkbox" class="custom-control-input" id="realizadoact<?php echo $indice; ?>" name="realizadoact<?php echo $indice; ?>" <?php echo $check_realizado; ?>><?php 
                                    /*if ($General == "") {
                                        echo $Global;
                                    }else{
                                        echo $General;
                                    }*/
                                    ?> 
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="col-md-5 col-sm-5 col-xs-5  control-label" for="AÑO">  Descripción del Acuerdo</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <textarea class="form-control" cols="40" rows="5" style="width: 650px; height: 150px;" readonly> <?php echo $Descripcion_acuerdo; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" style="display:none;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">A/M. Particular:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="ActvParticular<?php echo $indice; ?>" class="form-control" name="ActvParticular<?php echo $indice; ?>" onchange="actividades4(<?php echo $indice; ?>);">
                                        <?php
                                        if ($IdGeneral) {
                                            $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                            FROM c_actividad a 
                                            WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 3 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdGeneral
                                            ORDER BY a.Orden";
                                            $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                            echo '<option value = "">Seleccione una opción</option>';
                                            while ($row = mysqli_fetch_array($resultado6)) {
                                                $s = '';
                                                if ($row['IdActividad'] == $IdParticular) {
                                                    $s = 'selected = "selected"';
                                                }
                                                echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">SubActividad/Meta:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="SubActividad<?php echo $indice; ?>" class="form-control" name="SubActividad<?php echo $indice; ?>">
                                        <?php
                                        if ($IdParticular) {
                                            $consultaperiodo6 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $IdProyecto AND a.IdNivelActividad = 4 AND a.IdTipoActividad = $IdTipoConcepto AND a.IdActividadSuperior=$IdParticular
                                        ORDER BY a.Orden";
                                            $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                            echo '<option value = "">Seleccione una opción</option>';
                                            while ($row = mysqli_fetch_array($resultado6)) {
                                                $s = '';
                                                if ($row['IdActividad'] == $IdSubActividad) {
                                                    $s = 'selected = "selected"';
                                                }
                                                echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!--para check -->
                            <div class="form-group form-group-sm" style="display:none;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">check:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="check<?php echo $indice; ?>" class="form-control" name="check<?php echo $indice; ?>" onchange="subchecklist(<?php echo $indice; ?>);" style="width: 157px;">
                                        <?php
                                        if ($editar == true) {
                            $consultacheck = "SELECT ch.IdCheckList,ch.Nombre 
                            FROM c_checkList ch INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
                                WHERE che.IdActividad=$Actividad AND che.Id_Periodo=$periodo2 AND ch.Nivel=1";
                            $resultado6 = $catalogo->obtenerLista($consultacheck);
                            echo '<option value = "NULL">Seleccione</option>';
                            while ($row = mysqli_fetch_array($resultado6)) {
                                $s = '';
                                if ($row['IdCheckList'] == $Check) {
                                    $s = 'selected = "selected"';
                                }
                                echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                }
                                }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Sub-Check:</label>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <select id="Subcheck<?php echo $indice; ?>" class="form-control" name="Subcheck<?php echo $indice; ?>" style="width: 157px;">
                                        <?php
                        if ($editar == true && $Subcheck > 1) {
                            $consultacheck = "SELECT
                                    ch.IdCheckList,
                                    ch.Nombre 
                                FROM
                                    c_checkList ch
                                    INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
                                    WHERE che.IdActividad=$Actividad AND che.Id_Periodo=$periodo2 AND ch.Nivel=2 AND ch.IdCheckListPadre=$Check";

                            $resultado6 = $catalogo->obtenerLista($consultacheck);
                            echo '<option value = "NULL">Seleccione</option>';
                            while ($row = mysqli_fetch_array($resultado6)) {
                                $s = '';
                                if ($row['IdCheckList'] == $Subcheck) {
                                    $s = 'selected = "selected"';
                                }
                                echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                            }
                        } elseif ($editar == true && $Subcheck == "") {
                            echo ' <option value="0">Seleccione</option>';
                        }


                        ?>
                        </select>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" style="display:none;">
                                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Resolución</label>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <textarea class="form-control" id="resolucion<?php echo $indice; ?>" name="resolucion<?php echo $indice; ?>" rows="2"><?php echo $resdsd; ?></textarea>
                                </div>
                            </div>
        <?php
        $indice++;
        $numerodeacuerodos++;
        }
        ?>
        <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <?php
                            echo '<input type="hidden" id="tamanoArt" name="tamanoArt" value="' . $contadorac . '"/>';
                            echo '<input type="hidden" id="tamanoArtedit" name="tamanoArtedit" value="' . $contadorac . '"/>';
                            echo '<input type="hidden" id="tamanoAreas" name="tamanoAreas" value="' . $contadorar . '"/>';
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <a href="Vista.php?nombreUsuario=<?= $nombreUsuario ?>" class="btn btn-default btn-xs">Regresar</a>
                        </div>
                    </div>        
                </div>
        </div>
        </div>
</form>
</div>
</body>
</html>