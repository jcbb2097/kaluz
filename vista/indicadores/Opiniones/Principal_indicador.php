<?php
session_start();
if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../login.php";
        window.reload();
    </script>
<?php
}
?>
<?php
include_once('../../../WEB-INF/Classes/Indicadores_opiniones2.class.php');
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$indicadores = new Indicadores_opiniones();
$titulo = '';
$idusuario = $_GET["idUsuario"];
$nombreUsuario ="";
$total_opiniones_atendidas = 0;
$total_opiniones = 0;
$percentResul = 0;
$cadenas_ejes = array('', '', '', '', '', '', '', '', '', '', '', '');
$array_estilos = array('top: 54px;', 'top: 52px;', 'top: 51px;', 'top: 50px;', 'top: 49px;', 'top: 48px;', 'top: 47px;', 'top: 46px;', 'top: 45px;', 'top: 44px;', 'top: 43px;', 'top: 42px;');
$totales_ejes = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$ejes = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
$total_cuadro = 0;
$cadenaTotalesArea = "";
$por_eje = 0;
$por_area = 0;
$idArea = "";
$estatus = "";
$seleccion = "";
$TipoAreaEje = "";
$Tipo = "";
$Periodo = "";
$stylo_1 = "";
$stylo_2 = "";
$stylo_3 = "";
$resalta_1 = "";
$resalta_2 = "";
$resalta_3 = "";
$porcentajesR = 0;
$nombre_area = '';
$porcentajesNR = 0;
if (isset($_GET['estatus']) && $_GET['estatus'] != "") {
    $idArea = $_GET['idArea'];
    $estatus = $_GET['estatus'];
    $TipoAreaEje = $_GET['TipoAreaEje'];
}
if (isset($_GET['Tipo']) && $_GET['Tipo'] != "") {
    $Tipo = $_GET['Tipo'];
}
if (isset($_GET['Periodo']) && $_GET['Periodo'] != "") {
    $Periodo = $_GET['Periodo'];
}
if (isset($_GET["estatus"]) && $_GET["estatus"] == 1) {
    $resalta_1 = "resalta";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $estado = '>1';
    $color = "#0093a3";
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 2) {
    $resalta_2 = "resalta";
    $stylo_1 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $estado = '=4';
    $color = "green";
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 3) {
    $resalta_3 = "resalta";
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $estado = 'in(1,2,3)';
    $color = "red";
}
if (isset($_GET["tipo"]) && $_GET["tipo"] == 1) {
    $tipo = "1";
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] == 2) {
    $tipo = "2";
} elseif (isset($_GET["tipo"]) && $_GET["tipo"] == 3) {
    $tipo = "3";
} else {
    $tipo = "";
}
//llamado a funciones
$titulo = $indicadores->titulo($TipoAreaEje, $idArea, $Tipo);
$total_opiniones = $indicadores->Total_Opiniones($TipoAreaEje, $Periodo, $idArea);
//print_r($total_opiniones);
//totales
$total_opiniones_atendidas = $total_opiniones[2];
$total_opiniones_pendientes = $total_opiniones[1];
$total_cuadro = $total_opiniones[0];

if ($total_opiniones[0] > 0) {
    $percentResul = $total_opiniones_atendidas * 100 / $total_opiniones[0];
}
//cuadro para areas
if ($TipoAreaEje == 1) {
    $areas = $indicadores->getAreas();
    $responsable = $indicadores->Usuario($idusuario);
    while ($area = mysqli_fetch_assoc($areas)) { //recorren las areas
        $total_area = 0;

        foreach ($ejes as $eje) { //recorren todos los ejes
            if ($idArea == $area["Id_Area"]) {
                $nombre_area = '"' . $area["Nombre"] . '"';
                $Opiniones = $indicadores->Opiniones_indicador($area["Id_Area"], $eje, $estado, $tipo, $Periodo);
            } else {
                $Opiniones = 0;
            }
            if ($Opiniones == 0) {
                $onclick = "";
                $style = "style='opacity:.4;'";
            } else {
                $onclick = "onclick='muestraDetalle(" . $area["Id_Area"] . ",$eje,$estatus,\"$Periodo\",$responsable,$TipoAreaEje);mostrarModal($nombre_area,$TipoAreaEje,$estatus);' ";
                $style = "style='background-color: $color;color:white;'";
                $seleccion .= "";
            }
            if ($idArea == $area["Id_Area"]) {
                $cadenas_ejes[$eje] .= "<div $style id='ae$eje" . $area["Id_Area"] . "' $onclick  class='j  horizontal'><p class='rotarT'>" . $Opiniones . "</p></div>";
            } else {
                $cadenas_ejes[$eje] .= "<div $style id='ae$eje" . $area["Id_Area"] . "' $onclick  class='j  horizontal'><p class='rotarT'>0</p></div>";
            }
            $totales_ejes[$eje] += $Opiniones;
            $total_area += $Opiniones;
            if ($total_cuadro > 0) {
                $por_area = round(($total_area * 100) / $total_cuadro, 1);
            }
        }
        $cadenaTotalesArea .= "<div  id='totalArea" . $area["Id_Area"] . "' onclick=''  class=' j2 horizontal'><p class='rotarT'>" . $total_area . "</p><p class='porcentajeTot' style='font-size: .6em;color:green;'>$por_area%</p></div>";
    }
} else {
    $consulta = "SELECT e.Nombre FROM c_eje e WHERE e.idEje=$idArea";
    $resulaño = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resulaño)) {
        $nombre_area = '"' . $row["Nombre"] . '"';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.SIE.::</title>
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_opiniones.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>

<body>
    <div class="well2 "><?php echo $titulo; ?></b>
        <p class="titRes">atendidas <b><?php echo $total_opiniones_atendidas; ?> / <?php echo $total_opiniones[0]; ?></b></p>
        <div onclick="" style="cursor:pointer;" data-toggle="tooltip" data-placement="bottom" title="atendidas" class="progress clsPro">
            <div class="clsProSub progress-bar progress-bar-success" role="progressbar" style="color: black;background-color: green;width:<?php echo $percentResul; ?>%">
                <?php echo number_format($percentResul, 1, '.', ''); ?>%
            </div>
        </div>
        <div class="titleSub">Año&nbsp;&nbsp; <b></b></div>
        <div class="titleSelect">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="select" id="select">
                <?php
                $selected2 = "";
                $AÑO = "SELECT DISTINCT YEAR ( p.Fecha )as Periodo FROM c_opiniones p ORDER BY Periodo DESC";
                $resulaño = $catalogo->obtenerLista($AÑO);
                if ($Periodo == 'Todos') {
                    $selected2 = "selected";
                }
                while ($row = mysqli_fetch_array($resulaño)) {
                    $selected = "";
                    if ($Periodo == $row['Periodo'] && $Periodo != 'Todos') {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    } ?>
                    <option <?php echo $selected; ?> value="<?php echo $row['Periodo']; ?>" onclick="Cambiar(1);"><?php echo $row['Periodo']; ?></option>
                <?php } ?>
                <option <?php echo $selected2; ?> value="Todos" onclick="Cambiar(1);">Todos</option>
            </select>
        </div>
        <i data-toggle="tooltip" data-placement="bottom" title="Gráfica" style="position: absolute;right: 39px;cursor:pointer;" class="fas fa-chart-pie" onclick='muestraDetalle2(<?php echo$nombre_area?>,<?php echo$idArea?>,<?php echo$TipoAreaEje?>,"<?php echo$Periodo?>",<?php echo$estatus?>);mostrarModal2(<?php echo $nombre_area ?>,<?php echo $TipoAreaEje ?>,<?php echo $estatus ?>);'></i>
        <i id="global" data-toggle="tooltip" data-placement="bottom" title="Opiniones Globales" style="position: absolute;right: 9px;cursor:pointer;" class="fa fa-globe" aria-hidden="true"></i>
    </div>
    <div class="well2 wr">
        <p data-toggle="tooltip" data-placement="bottom" title="Total de opiniones" style="top: 31px;cursor:pointer;background-color:#0093a3;border: 1px solid white;left:1px;color:white; <?php echo $stylo_1;  ?>" onclick="javascript:location.href='Principal_indicador.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=1&idArea=<?php echo $idArea; ?>&TipoAreaEje=<?php echo $TipoAreaEje; ?>&Periodo=<?php echo $Periodo; ?>'" class="totales a <?php echo $resalta_1; ?>"><?php echo $total_opiniones[0]; ?></p>
        <p style="position: absolute;left: 41px;top: 31px;">Totales</p>
        <p data-toggle="tooltip" data-placement="bottom" title="Atendidas" style="top: 31px;cursor:pointer;background-color:green;border: 1px solid white;left:116px;color:white; <?php echo $stylo_2; ?>" onclick="javascript:location.href='Principal_indicador.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=2&idArea=<?php echo $idArea; ?>&TipoAreaEje=<?php echo $TipoAreaEje; ?>&Periodo=<?php echo $Periodo; ?>'" class="totales a <?php echo $resalta_2; ?>"><?php echo $total_opiniones_atendidas; ?></p>
        <p data-toggle="tooltip" data-placement="bottom" title="Pendientes de atender" style="top: 31px;cursor:pointer;background-color:red;left: 146px;border: 1px solid white; <?php echo $stylo_3; ?>" onclick="javascript:location.href='Principal_indicador.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=3&idArea=<?php echo $idArea; ?>&TipoAreaEje=<?php echo $TipoAreaEje; ?>&Periodo=<?php echo $Periodo; ?>'" class="totales a  <?php echo $resalta_3; ?>"><?php echo $total_opiniones_pendientes; ?></p>
        <p style="position:absolute;top:42px;right:30px;"># total</p>
    </div>
    <div class="global">
        <?php if ($TipoAreaEje == 1) {
            $top_px = 54;
            foreach ($ejes as $eje) {
                $top_px--;
                if ($total_cuadro > 0) {
                    $por_eje = round(($totales_ejes[$eje] * 100) / $total_cuadro, 1);
                } ?>
                <div style="top:<?php echo $top_px; ?>px" class="flotante">
                    <?php echo $cadenas_ejes[$eje]; ?>
                    <div class="totEj">
                        <p class="totEjeFin"><?php echo $totales_ejes[$eje]; ?></p>
                        <p class="totEjeFinPercent" style="font-size: .9em;color:green;"><?php echo $por_eje; ?>%</p>
                    </div>
                </div>
            <?php } ?>
            <div class="flotante" style="top: 42px;">
                <?php echo $cadenaTotalesArea; ?>
                <div class="totEj">
                    <p style="font-size: 15px;"><?php echo $total_cuadro; ?></p>
                </div>
            </div>
        <?php } else {  ?>
            <?php $eje = 0;
            for ($i = 0; $i < 12; $i++) {
                $eje = $i + 1; ?>
                <div style="<?php echo $array_estilos[$i] ?>" class="flotante">
                    <?php if ($eje == $idArea) {
                        $areas = $indicadores->getAreas();
                        $totales = $indicadores->porcentajes($eje, $Periodo, $estatus);
                        $responsable = $indicadores->Usuario($idusuario);
                        while ($area = mysqli_fetch_assoc($areas)) {
                            $Opiniones = $indicadores->Por_eje($area["Id_Area"], $eje, $Periodo, $estatus);
                            if ($Opiniones == 0) {
                                $style = "style='opacity:.4;'";
                            } else {
                                $style = "style='background-color: #0093a3;color:white;'";
                            }

                            $onclick = "onclick='muestraDetalle(" . $area["Id_Area"] . ",$eje,$estatus,\"$Periodo\",$responsable,$TipoAreaEje);mostrarModal($nombre_area,$TipoAreaEje,$estatus);' ";

                            echo " <div $style id='ae$eje" . $area["Id_Area"] . "'  class='j  horizontal' $onclick><p class='rotarT'>" . $Opiniones . "</p></div>";
                        }
                        if ($totales[0] > 0) {
                            $porcentajesR = round($totales[1] * 100 / $totales[0]);
                            $porcentajesNR = round($totales[2] * 100 / $totales[0]);
                        }
                        echo '<div class="totEj">';
                        echo ' <p class="totEjeFin">' . $totales[0] . '</p>';
                        echo ' <p class="totEjeFinPercent2" style="font-size: .9em;color:black;">' . $porcentajesNR . '% en proceso</p>';
                        echo ' <p class="totEjeFinPercent" style="font-size: .9em;color:green;">' . $porcentajesR . '% resueltas</p>';
                        echo '</div>';
                    } ?>
                </div>
            <?php  } ?>
        <?php } ?>
    </div>
    <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="left: -132px;width: 860px;">
                <div class="modal-header h" style="padding: 7px 5px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-title" id="modalTitle">Opiniones detalle</div>
                </div>
                <div class="modal-body detalle" style="padding: 31px 5px;"></div>
            </div>
        </div>
    </div>
    <div style="top: 33px;" class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="left: -132px;width: 860px;">
                <div class="modal-header h" style="padding: 7px 5px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-title" id="modalTitle">Opiniones detalle</div>
                </div>
                <div class="modal-body detalle" style="padding: 31px 5px;"></div>
            </div>
        </div>
    </div>
</body>
<script>
    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

    });
    //funcion para los datos del mondal
    function muestraDetalle(Area, Eje, Estado, Periodo, Persona, Tipo) {

        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("Datos_indicador_opiniones.php", {
            Id_area: Area,
            Id_eje: Eje,
            Id_estado: Estado,
            Id_periodo: Periodo,
            Id_persona: Persona,
            Id_tipo: Tipo
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });
    }

    function muestraDetalle2(Area,Id,Estado,Periodo,Tipo) {

        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("Grafica_indicador_opiniones.php", {
            Nombre: Area,
            Id_area_eje: Id,
            Id_estado: Estado,
            Id_periodo: Periodo,
            Id_tipo:Tipo
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });
    }
    //funcion para el titulo del modal
    function mostrarModal(nombre, tipo, estatus) {
        var sub = "";
        if (estatus == 2) {
            sub = '/ Atendidas';
        } else if (estatus == 3) {
            sub = '/ Pendientes de atender';
        }
        if (tipo == 1) {
            var titulo = 'Opiniones detalle del área de ' + nombre + ' ' + sub;
        } else {
            var titulo = 'Opiniones detalle del eje de ' + nombre + ' ' + sub;
        }

        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }

    function mostrarModal2(nombre, tipo, estatus) {
        var sub = "";
        if (estatus == 2) {
            sub = '/ Atendidas';
        } else if (estatus == 3) {
            sub = '/ Pendientes de atender';
        }
        if (tipo == 1) {
            var titulo = 'Gráfico de las Opiniones del área de ' + nombre + ' ' + sub;
        } else {
            var titulo = 'Gráfico de las Opiniones del eje de ' + nombre + ' ' + sub;
        }

        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }


    //funciones para que funcione en chrome
    $('#select').on('change', function() {
        var Periodo = $('#select').val();
        url = "Principal_indicador.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idusuario; ?>&estatus=<?php echo $estatus; ?>&idArea=<?php echo $idArea; ?>&TipoAreaEje=<?php echo $TipoAreaEje; ?>&Periodo=" + Periodo;
        $(location).attr('href', url);
    });
    $('#global').on("click", function() {
        url = "indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario ?>&idUsuario=<?php echo $idusuario ?>&titulo=4&estatus=1";
        $(location).attr('href', url);
    });
</script>

</html>