<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
session_start();

include_once '../../../WEB-INF/Classes/Catalogo.class.php';
$catalogo    = new Catalogo();
$where_ae = '';
$idArea = "";
$TipoAreaEje = "";
if (isset($_GET['IdAreaEje']) && $_GET['IdAreaEje'] != "") {
    $idArea = $_GET['IdAreaEje'];
    $TipoAreaEje = $_GET['TipoAreaEje'];
}
if ($TipoAreaEje == 1) {
    $where_ae = "AND a.Id_Area=" . $idArea;
} elseif ($TipoAreaEje == 2) {
    $where_ae = "AND k_ar.id_proyecto=" . $idArea;
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
if ((isset($_GET['anio']) && $_GET['anio'] != "")) {
    $anio = $_GET["anio"];
    $where_ae .= " and per.Periodo = $anio";
} else {
    $anio = '';
}
if (!isset($_SESSION['user_session'])) {
?>
<script>
        top.location.href = "../../login.php";
        window.reload();
    </script>
    <?php
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
    <script src="../../../resources/js/aplicaciones/ArchivosCompartidos/Alta_archivo.js"></script>
    <title>::.ARCHIVOS COMPARTIDOS.::</title>
</head>

<body>
  <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Archivos Entregables</a></div>
  <div class="well2 wr">
      <a style="color:#fefefe; cursor: pointer;" href="Alta_archivo.php?accion=guardar&tipoPerfil=<?php echo $tipoPerfil; ?>&usuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">agregar +</a> /
      <a style="color:#fefefe; cursor: pointer;" href="../../indicadores/Entregables/index.php?tipoPerfil=<?php echo $tipoPerfil; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Dashboard </a> /
      <a style="color:#fefefe; cursor: pointer;" href="lista_categorias.php?tipoPerfil=<?php echo $tipoPerfil; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Categorías </a>
  </div>
  <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <!-- <?php
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
    $user = $_GET['nombreUsuario'];

    //echo $user;
    echo '<a style="color:purple;" href="Alta_archivo.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a> / <a style="color:purple;" href="Vista2.php?usuario=' . $user . '"' . '>Indicador </a> / <a style="color:purple;" href="lista_categorias.php?usuario=' . $user . '"' . '>Categorías </a>';
} else {
    $user = "User_desconocido";

    //echo $user;
    echo '<a style="color:purple;" href="Alta_archivo.php?accion=guardar&usuario=' . $user . '"' . '>agregar +</a> / <a style="color:purple;" href="Vista2.php?usuario=' . $user . '"' . '>Indicador </a> / <a style="color:purple;" href="lista_categorias.php?usuario=' . $user . '"' . '>Categorías </a>';
}

?> -->

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <table id="tArchivo" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
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
$consulta   = "SELECT d.id_documento, d.descripcion,d.ruta,  d.pdf, a.Nombre AS area,per.Periodo,
                                      t.tipo,expo.tituloFinal AS expo,
                                      t.id_tipo, d.fechaCreacion,IF(d.id_usuario = $id_usuario,1,0)  baja_mod
                                      FROM c_documento AS d
                                      INNER JOIN c_area AS a ON a.Id_Area = d.id_area
                                      INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
                                      LEFT JOIN k_archivoactividad k_ar ON d.id_documento = k_ar.id_archivo
                                      LEFT JOIN c_exposicionTemporal expo ON k_ar.id_exposicion = expo.idExposicion
                                      LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo
                                      WHERE d.id_tipo IN(9,10,14) $where_ae";
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
    $ValUser = "'" . $user . "'";
} else {
    $user    = "User_desconocido";
    $ValUser = "'" . $user . "'";
}
// echo $consulta;
$resultConsulta = $catalogo->obtenerLista($consulta);
while ($row = mysqli_fetch_array($resultConsulta)) {
    $id_archivo = $row['id_documento'];
    if ($row['id_tipo'] == 9) {
        $color_texto = "#dfa739";
    }

    if ($row['id_tipo'] == 10) {
        $color_texto = "#33ab15";
    }

    if ($row['id_tipo'] == 14) {
        $color_texto = "#dbd909";
    }

    echo '<tr>';
    echo '<td>';
    if ($row['baja_mod'] == 1) //solo si son archivos del usuario los puede borrar o editar
    {
        echo '<a style="color:purple;cursor:pointer" onclick="eliminar(' . $row['id_documento'] . ')"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:purple;cursor:pointer" onclick="modificar(' . $row['id_documento'] . ',' . $ValUser . ')"><span class="glyphicon glyphicon-pencil"></span></a>';
    }

    echo '</td>';
    echo '<td>' . $row['descripcion'] . '</td>';
    $ruta = '../../../resources/aplicaciones/imagenes/ArchivosCompartidos/' . $row['pdf'];
    if ($row['id_tipo'] == 3) {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
    } else if ($row['id_tipo'] == 4) {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-book"></i></a></td>';
    } else if ($row['id_tipo'] == 5) {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-film"></i></a></td>';
    } else if ($row['id_tipo'] == 6) {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-volume-up"></i></a></td>';
    } else if ($row['id_tipo'] == 7) {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-tasks"></i></a></td>';
    } else if ($row['id_tipo'] == 8) {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-picture"></i></a></td>';
    } else if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
        if ($row['pdf'] == "link") {
            //si es un link a un archivo
            echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
        } else {
            echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
        }
    } else {
        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
    }
    echo '<td>' . $row['area'] . '</td>';
    echo '<td>';
    $area_eje = "SELECT a.id_proyecto,p.Nombre FROM k_archivoactividad as a INNER JOIN c_eje as p on p.idEje=a.id_proyecto where a.id_archivo=" . $id_archivo;
    //echo$area_eje;
    $resultarea_eje = $catalogo->obtenerLista($area_eje);
    while ($row2 = mysqli_fetch_array($resultarea_eje)) {
        echo $row2["id_proyecto"] . "." . $row2["Nombre"] . "<br>";
    }
    echo '</td>';
    echo '<td>';
    $consultaactiv = "SELECT p.IdTipoActividad,CASE WHEN a.id_actividad4 IS NOT NULL AND a.id_actividad3 IS NOT NULL AND a.id_actividad2 IS NOT NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(p.idEje,'.',p.Orden,'.',o.Orden,'.',b.Orden,'.',l.Orden,' ',l.Nombre) WHEN a.id_actividad4 IS NULL AND a.id_actividad3 IS not NULL AND a.id_actividad2 IS NOT NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(p.idEje,'.',p.Orden,'.',o.Orden,'.',b.Orden,' ',b.Nombre) WHEN a.id_actividad4 IS NULL AND a.id_actividad3 IS NULL AND a.id_actividad2 IS NOT NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(p.idEje,'.',p.Orden,'.',o.Orden,' ',o.Nombre) WHEN a.id_actividad4 IS NULL AND a.id_actividad3 IS NULL AND a.id_actividad2 IS NULL AND a.id_actividad1 IS NOT NULL THEN CONCAT(p.idEje,'.',p.Orden,'.',p.Nombre) END as Nombre, a.id_actividad1, a.id_actividad2, a.id_actividad3, a.id_actividad4 FROM k_archivoactividad AS a LEFT JOIN c_actividad AS p ON p.IdActividad = a.id_actividad1 LEFT JOIN c_actividad AS o ON o.IdActividad = a.id_actividad2 LEFT JOIN c_actividad AS b ON b.IdActividad = a.id_actividad3 LEFT JOIN c_actividad AS l ON l.IdActividad = a.id_actividad4 WHERE a.id_archivo =" . $id_archivo . ";";
    // echo$consultaactiv;
    $result_actividad = $catalogo->obtenerLista($consultaactiv);
    while ($row3 = mysqli_fetch_array($result_actividad)) {
        if ($row3['IdTipoActividad'] == 1) {
            echo "A-";
        } else {
            echo "M-";
        }
        echo $row3["Nombre"] . "<br>";
    }
    echo '</td>';
    echo '<td>' . $row['Periodo'] . '</td>';
    echo '<td>' . $row['fechaCreacion'] . '</td>';
    echo '<td>';
    echo $row['expo'];
    //$area_invitada = "SELECT a.id_Area_invitada,p.Nombre FROM k_archivoarea as a INNER JOIN c_area as p on p.Id_Area=a.id_Area_invitada where a.id_archivo=" . $id_archivo;
    //echo$area_invitada;
    /*$resultarea_area_invitada = $catalogo->obtenerLista($area_invitada);
    while ($row4 = mysqli_fetch_array($resultarea_area_invitada)) {
    echo $row4["Nombre"] . "<br>";
    }*/
    echo '</td>';
    echo '</tr>';
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
            pageLength: 100,
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
            title: '¿Desea eliminar el entregable?',
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
                            accion: "eliminar"
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
