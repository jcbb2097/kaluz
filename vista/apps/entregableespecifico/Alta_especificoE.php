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


include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('especificoE.class.php');

$catalogo = new Catalogo();
$EspeE = new especificoE();


$editar = false;
date_default_timezone_set('America/Mexico_City');

$entregable = "";
$descripcion = "";
$exp = "";
$intervalo = "";
$avance = "";
$libro = "";
$actividad = "";



if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
    $user = $_GET['usuario'];
    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}

if ($editar == true) {
    
    $id = $_GET['id'];
    $EspeE->setId_entrEs($_GET['id']);
    $EspeE->getespecificoE();
    $entregable = $EspeE->getentregable();
    $descripcion = $EspeE->getdescripcion();
    $exp = $EspeE->getexp();
    $intervalo = $EspeE->getintervalo();
    $avance = $EspeE->getavance();
    $libro = $EspeE->getlibro();
    $actividad = $EspeE->getactividad();
    
}
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.ENTREGABLE ESPECIFICO.::</title>

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
    <script src="Alta_especificoE.js"></script>
    <script src="Acciones_menu.js"></script>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_especificoE.php?nombreUsuario=<?php echo ($user); ?>">Entregables Especificos</a> / Agregar </div>
    <div id="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" id="formEspecifico" name="formEspecifico">


                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombre_actividad">* Nombre de la Actividad</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="nombre_actividad" class="form-control" name="nombre_actividad" onchange="menu();" style="height: 60px; width:220px; white-space: initial;">
                                <option value="">Seleccione una actividad</option>
                                <?php 
                                    #$consultactividad = "SELECT IdActividad, Concat (Numeracion,' ',Nombre) AS Nombre FROM c_actividad ";
                                    $consultactividad = "SELECT en.IdEntregable, en.Nombre AS nom_entre,ac.IdActividad, CONCAT(ac.Numeracion,' ',ac.Nombre) AS Nombre
                                    FROM c_entregableEspecifico AS ene
                                    LEFT JOIN c_entregable AS en ON en.IdEntregable=ene.IdEntregable
                                    LEFT JOIN c_actividad AS ac ON ac.IdActividad=en.idActividad";
                                    $resultado = $catalogo->obtenerLista($consultactividad);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        if ($row['IdActividad'] == $actividad) {
                                            $selected= 'selected = "selected"';
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option value='" . $row['IdActividad'] . "' " . $selected . ">" . $row['Nombre'] . "</option>";
                                        #echo '<option value = "' . $row['IdActividad'] . '" >' . $row['Nombre'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>    
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombre_entregable">* Nombre del Entregable</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">

                            <select id="nombre_entregable" class="form-control" name="nombre_entregable"  style="height: 60px; width:220px; white-space: initial;" disabled="disabled">
                                <option value="" >Entregable correspondiente</option>
                                <?php
                                if ($editar == true) {
                                    $consultaentre = "SELECT en.IdEntregable, en.Nombre AS nom_entre FROM c_entregable AS en";
                                    $resul = $catalogo->obtenerLista($consultaentre);
                                    while ($row = mysqli_fetch_array($resul)) {
                                        $s = '';
                                        if ($row['IdEntregable'] == $entregable) {
                                            $s= 'selected = "selected"';
                                        } else {
                                            $s = "";
                                        }
                                        #echo "<option value='" . $row['IdEntregable'] . "' " . $selected . ">" . $row['nom_entre'] . "</option>";
                                        #echo '<option value = "' . $row['IdEntregable'] . '" >' . $row['nom_entre'].'</option>';
                                        echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['nom_entre'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>    
                        
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="libro">* Libro </label>
                        <div class="col-md-2 col-sm-2 col-xs-2">

                            <select id="nom_libro" class="form-control" name="nom_libro">
                                <option value = "">Seleccione un titulo </option>
                                <?php 
                                    $consultaL = "SELECT IdLibro, Titulo FROM c_libro ORDER BY Titulo ASC";
                                    $resultado = $catalogo->obtenerLista($consultaL);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['IdLibro'] == $libro) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdLibro'] . '" ' . $s . '>' . $row['Titulo'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>


                    </div>


                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="desc_entregableE">* Descripción del Entregable Especifico</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <textarea class="form-control" id="desc_entregableE" name="desc_entregableE" ><?php echo $descripcion; ?></textarea>
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="avance">* Avance </label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <input class="form-control" id="avance" name="avance"  placeholder="%" type="number" max="100" value="<?php echo $avance;?>"></input>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nom_expot">* Exposición Temporal </label>
                        <div class="col-md-2 col-sm-2 col-xs-2">

                            <select id="nom_expot" class="form-control" name="nom_expot" style="width:220px;"> 
                                <option value = "">Seleccione una exposición </option>
                                <?php 
                                    $consultaET = "SELECT idExposicion, tituloFinal FROM c_exposicionTemporal ORDER BY tituloFinal ASC";
                                    $resultado = $catalogo->obtenerLista($consultaET);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['idExposicion'] == $exp) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="desc_intervalo">* Intervalo descriptivo</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">

                            <select id="desc_intervalo" class="form-control" name="desc_intervalo">
                                <option value = "">Seleccione un intervalo </option>
                                <?php 
                                    $consultaIn = "SELECT idIntervalo, descripcion FROM c_intervalo ORDER BY descripcion ASC";
                                    $resultado = $catalogo->obtenerLista($consultaIn);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                    $s = '';
                                    if ($row['idIntervalo'] == $intervalo) {
                                    $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['idIntervalo'] . '" ' . $s . '>' . $row['descripcion'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group form-group-sm">
                        
                    </div>


                  
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <!-- <button type="cancel" class="btn btn-default btn-xs" id="cancelar" onclick="javascript:window.location='Lista_noticias.php">Cancelar</button> -->
                            <a href="Lista_especificoE.php" class="btn btn-default btn-xs">Regresar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script language="javascript">
    $(document).ready(function(){
        $("#nombre_actividad").on('change', function () {
            $("#nombre_actividad option:selected").each(function () {
                var id_category = $(this).val();
                $.post("subcategories.php", { IdActividad: idActividad }, function(data) {
                    $("#nombre_entregable").html(data);
                });			
            });
    });
    });
    </script>-->

</body>
</html>
