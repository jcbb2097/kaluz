<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
date_default_timezone_set('America/Mexico_City');
$Aplicacion="Archivos Entregables";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])      && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario'])       && $_GET['idUsuario'] != ""))           { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario'])   && $_GET['nombreUsuario'] != ""))       { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$where_ae = '';
$idArea = "";
$TipoAreaEje = "";
$where_ano = "";
$where_eje="";
if (isset($_GET['id']) && $_GET['id'] != "") {
    $idArea = $_GET['id'];

}
if (isset($_GET['TipoAreaEje']) && $_GET['TipoAreaEje'] != "") {

    $TipoAreaEje = $_GET['TipoAreaEje'];
}
if ($TipoAreaEje == 1) {
    $where_ae = "WHERE d.id_tipo not in(1,2,9,10,11,14) AND a.Id_Area=" . $idArea;
} elseif ($TipoAreaEje == 2) {
    $where_eje='LEFT JOIN k_archivoactividad k_ar on k_ar.id_archivo=d.id_documento';
    $where_ae = " WHERE d.id_tipo not in(1,2,9,10,11,14) AND k_ar.id_proyecto=" . $idArea;
} elseif ($TipoAreaEje == 3) {
    $where_ae = " WHERE d.id_tipo=" . $idArea;
} else {
    $where_ae = "WHERE d.id_tipo not in(1,2,9,10,11,14)";
}

if ((isset($_GET['anio']) && $_GET['anio'] != "")) {
    $anio = $_GET["anio"];
    $where_ae .= " and p.Periodo = $anio";
} else {
    $anio = '';
}
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "")) {
    $tipoPerfil = $_GET["tipoPerfil"];
} else {
    $tipoPerfil = '';
}
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
    $nombreUsuario = $_GET["nombreUsuario"];
} else {
    $nombreUsuario = '';
}
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) {
    $idUsuario = $_GET["idUsuario"];
} else {
    $idUsuario = '';
}

if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../../login.php";
        window.reload();
    </script>
    <?php
}
if (isset($_SESSION["user_session"])) {
    if (isLoginSessionExpired()) {
    ?>
        <script>
            top.location.href = "../../logout.php?session_expired=1";
        </script>
<?php
    }
}

$AnioActual=date("Y"); //Año actual para mostrar por default
$VarWhere= " ";

$FiltroAnio="";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $FiltroAnio= " AND isnull(p.Periodo) "; } //Para fechas nulas
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " =1 "; }
    else { $FiltroAnio= " AND p.Periodo='".$_GET['F_IdAnio']."' "; }
}
else {$FiltroAnio= ""; }

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND a.Id_Area=".$_GET['F_IdArea'];}
    else {  $FiltroArea="  AND isnull(a.Id_Area)"; }
}

$FiltroTipoDoc="";
if ((isset($_GET['F_IdTipo']) && $_GET['F_IdTipo'] != ""))
{   if ($_GET['F_IdTipo']!="0") {$FiltroTipoDoc =" AND t.id_tipo=".$_GET['F_IdTipo'];}
    else {  $FiltroTipoDoc="  AND isnull(t.id_tipo)"; }
}

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND k_ar.id_proyecto= ".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(k_ar.id_proyecto)"; } //Si el parametro es igual a 0 se buscan los NULOS
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <!--  <script src="../../../resources/js/aplicaciones/ArchivosCompartidos/Alta_archivocompatido.js"></script> -->
    <title>::.Archivos Compartidos.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe; cursor: pointer;" href="lista_archivo.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario?>">Archivos Compartidos</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Lista Archivos Compartidos</a></div>
    <div class="well2 wr">
        <a style="color:#fefefe; cursor: pointer;" href="vista.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario?>"> Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="lista_archivo.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario?>">Lista Archivos Compartidos</a> /
        <a style="color:#fefefe; cursor: pointer;" onclick="Alta(<?php echo $idUsuario ?>,15,'Alta_archivo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>');">Agregar +</a>
        <!--<a style="color:#fefefe; cursor: pointer;" href="lista_categorias.php?tipoPerfil=<?php echo $tipoPerfil; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Categorías </a>-->
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tEntregable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Área</th>
                            <th>Eje</th>
                            <th>Actividad/Meta</th>
                            <th>Año</th>
                            <th>Fecha</th>
                            <th>Exposición</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id_usuario = $_SESSION['user_session'];
                        $Entregables = "SELECT
                        d.id_documento,
                        d.descripcion,
                        d.ruta,
                        d.pdf,
                        a.Nombre AS area,
                        p.Periodo,
                        d.fechaCreacion,
                        d.id_usuario  baja_mod,
                        t.tipo,
                        t.id_tipo
                        FROM
                        c_documento AS d
                        INNER JOIN c_area AS a ON a.Id_Area = d.id_area
                        INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
                        INNER JOIN c_periodo p ON p.Id_Periodo = d.anio
                        INNER JOIN k_archivoactividad k_ar on k_ar.id_archivo=d.id_documento
                        WHERE 1 $FiltroAnio $FiltroTipoDoc $FiltroArea $FiltroEje
                        AND d.id_tipo not in(1,2,9,10,11,14)";
                        //echo $Entregables;
                        $resultEntregable = $catalogo->obtenerLista($Entregables);
                        while ($row = mysqli_fetch_array($resultEntregable)) {
                            $id_archivo = $row['id_documento'];
                            $ruta_edita = "Alta_archivo.php?accion=editar2&id=" . $id_archivo . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario. "&regreso=1&plan=2";
                            $editar = "onclick='edita($idUsuario,15,\"$ruta_edita\")'";
                            $eliminar = "onclick='elimina($idUsuario,15,$id_archivo);'";
                            if ($row['id_tipo'] == 9) $color_texto = "#dfa739";
                            if ($row['id_tipo'] == 10) $color_texto = "#33ab15";
                            if ($row['id_tipo'] == 14) $color_texto = "#dbd909";
                            echo '<tr>';
                            echo '<td>';
                            if ($row['baja_mod'] == $idUsuario)   //solo si son archivos del usuario los puede borrar o editar
                                echo '<a style="color:purple;cursor:pointer" ' . $eliminar . '><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:purple;cursor:pointer" ' . $editar . '><span class="glyphicon glyphicon-pencil"></span></a>';
                            echo '</td>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                            $ruta = $row['ruta'] . $row['pdf'];
                            if ($row['id_tipo'] == 3) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            } else if ($row['id_tipo'] == 4) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-book"></i></a></td>';
                                }
                            } else if ($row['id_tipo'] == 5) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-film"></i></a></td>';
                                }
                            } else if ($row['id_tipo'] == 6) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-volume-up"></i></a></td>';
                                }
                            } else if ($row['id_tipo'] == 7) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-tasks"></i></a></td>';
                                }
                            } else if ($row['id_tipo'] == 8) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-picture"></i></a></td>';
                                }
                            } else {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            }
                            echo '<td>' . $row['area'] . '</td>';
                            echo '<td>';
                            $area_eje = "SELECT
                            CONCAT(p.orden,'.',p.Nombre) eje
                           FROM
                               k_archivoactividad AS a
                               INNER JOIN c_eje AS p ON p.idEje = a.id_proyecto
                           WHERE
                               a.id_archivo=" . $id_archivo;
                            $resultarea_eje = $catalogo->obtenerLista($area_eje);
                            while ($row2 = mysqli_fetch_array($resultarea_eje)) {
                                echo $row2["eje"] . "<br>";
                            }
                            echo '<td>';
                            $consultaactiv = "SELECT
                            ac.IdTipoActividad,
                            CONCAT(ac.Numeracion,ac.Nombre)actividad
                           FROM
                               k_archivoactividad AS a
                               INNER JOIN c_actividad ac on a.id_actividad=ac.IdActividad
                           WHERE
                               a.id_archivo=" . $id_archivo . ";";
                            $result_actividad = $catalogo->obtenerLista($consultaactiv);
                            while ($row3 = mysqli_fetch_array($result_actividad)) {
                                if ($row3['IdTipoActividad'] == 1) {
                                    echo "A-";
                                } else {
                                    echo "M-";
                                }
                                echo $row3["actividad"] . "<br>";
                            }
                            echo '</td>';
                            echo '<td>' . $row['Periodo'] . '</td>';
                            echo '<td>' . $row['fechaCreacion'] . '</td>';
                            echo '<td>';
                            $exposiciom = "SELECT
                            e.tituloFinal
                           FROM
                               k_archivoactividad AS a
                               LEFT JOIN c_exposicionTemporal as e on e.idExposicion=a.id_exposicion
                           WHERE
                               a.id_archivo=" . $id_archivo;
                            $resultexpo = $catalogo->obtenerLista($exposiciom);
                            while ($row4 = mysqli_fetch_array($resultexpo)) {
                                echo $row4["tituloFinal"] . "<br>";
                            }
                            echo '</td>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var cont = 0;
        // DataTable
        $('#tEntregable thead tr').clone(true).appendTo('#tEntregable thead');
        $('#tEntregable thead tr:eq(1) th').each(function(i) {
            cont++;
            if (cont != 1 && cont != 3) {
                var title = $(this).text();
                $(this).html('<input type="text" style="width : 85px;" placeholder="' + title + '" />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }
        });

        var table = $('#tEntregable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "order": [
                [6, "desc"]
            ],
            "scrollX": "0px",
            responsive: false,
            pageLength: 10,
            "scrollY": "370px",
            "scrollCollapse": true,
            "paging": true
            //"ordering": false
        });
    });

    function eliminar(Id) {
        //var con = "'"+controller+"'";
        $.confirm({
            icon: 'glyphicon glyphicon-minus-sign',
            title: '¿Desea eliminar el archivo?',
            content: 'No podrás revertir los cambios',
            autoClose: 'cancelar|8000',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                aceptar: {
                    btnClass: 'btn-dark',
                    action: function() {
                        $.post('../../../WEB-INF/Controllers/ArchivosCompartidos/Controler_archivo.php', {
                            id: Id,
                            accion: "eliminartodo"
                        }, function(data) {
                            if (data.toString().indexOf("Error:") === -1) {
                                //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: {
                                        aceptar: {
                                            action: function() {
                                                location.reload();
                                            }

                                        }
                                    }
                                });
                                //location.reload();
                            } else {
                                $.confirm({
                                    icon: 'glyphicon glyphicon-remove-sign',
                                    title: data,
                                    content: '',
                                    type: 'red',
                                    buttons: {
                                        aceptar: {
                                            action: function() {
                                                location.reload();
                                            }

                                        }
                                    }
                                });
                                //$.dialog(data);
                            }
                            //location.reload();
                        });
                    }
                },
                cancelar: function() {
                    //$.alert('Cancelado!');
                }
            }
        });
    }
</script>

</html>
