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
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Indicador_entregables.class.php');
$catalogo = new Catalogo();
$Entregable = new Indicador_entregable();
$Periodo_sistema = date('Y');
$categoria_select = false;
$sub_categoria_select = false;
$Periodo = "9";
$titulo = 'Indicadores/DASHBOARD Entregables';
$total_Entregables = 0;
$stylo_1 = "";
$stylo_2 = "";
$stylo_3 = "";
$stylo_4 = "";
$resalta_1 = "";
$resalta_2 = "";
$resalta_3 = "";
$resalta_4 = "";
$Id_eje = "";
$Categoria = "";
$Sub_categoria = "";
$seleccion = "";
$estatus = "";
$cadenas_ejes = array('', '', '', '', '', '', '', '', '', '', '', '');
$totales_ejes = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$ejes = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
$cadenaTotalesArea = "";
$array_estilos = array('top: 54px;', 'top: 52px;', 'top: 51px;', 'top: 50px;', 'top: 49px;', 'top: 48px;', 'top: 47px;', 'top: 46px;', 'top: 45px;', 'top: 44px;', 'top: 43px;', 'top: 42px;');

if (isset($_GET['estatus']) && $_GET['estatus'] != "") {
    $estatus = $_GET['estatus'];
}
if (isset($_GET['eje']) && $_GET['eje'] != "") {
    $Id_eje = $_GET['eje'];
    $categoria_select = true;
}
if (isset($_GET['cate']) && $_GET['cate'] != "" && $_GET['cate'] > 0) {
    $Categoria = $_GET['cate'];
    $sub_categoria_select = true;
}
if (isset($_GET['subcate']) && $_GET['subcate'] != "" && $_GET['subcate'] > 0) {
    $Sub_categoria = $_GET['subcate'];
}
if (isset($_GET['anio']) && $_GET['anio'] != "") {
    $Periodo = $_GET['anio'];
}
$totales = $Entregable->Total_entregables($Periodo, $Id_eje, $Categoria, $estatus);
if (isset($_GET["estatus"]) && $_GET["estatus"] == 9) {
    $resalta_3 = "resalta";
    $stylo_2 = "opacity: .5;";
    $stylo_1 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $color = "#dfa739";
    $total_cuadro = $totales[2];
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 10) {
    $resalta_2 = "resalta";
    $stylo_1 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $stylo_4 = "opacity: .5;";
    $color = "#33ab15";
    $total_cuadro = $totales[1];
} elseif (isset($_GET["estatus"]) && $_GET["estatus"] == 14) {
    $resalta_4 = "resalta";
    $stylo_1 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $color = "#dbd909";
    $total_cuadro = $totales[3];
} else {
    $resalta_1 = "resalta";
    $stylo_4 = "opacity: .5;";
    $stylo_2 = "opacity: .5;";
    $stylo_3 = "opacity: .5;";
    $color = "#0093a3";
    $total_cuadro = $totales[0];
}

if ($Id_eje == "" || $Id_eje == 0) {
    $areas = $Entregable->getAreas();
    while ($area = mysqli_fetch_assoc($areas)) { //recorren las areas
        $total_area = 0;
        foreach ($ejes as $eje) { //recorren todos los ejes
            $Entregables = $Entregable->Entregables_indicador($Periodo, $area["Id_Area"], $eje, $Categoria, $estatus);
            if ($Entregables == 0) {
                $onclick = "";
                $style = "style='opacity:.4;color: black;'";
            } else {
                $nombre_area = '"' . $area["Nombre"] . '"';
                $onclick = "onclick='muestraDetalle(" . $area["Id_Area"] . ",$eje,$Periodo,$estatus);'";
                $style = "style='background-color: $color;color:white;'";
                $seleccion .= "";
            }
            $cadenas_ejes[$eje] .= "<div $style id='ae$eje" . $area["Id_Area"] . "' $onclick  class='j  horizontal'><p class='rotarT'>" . $Entregables . "</p></div>";
            $seleccion .= "";
            $totales_ejes[$eje] += $Entregables;
            $total_area += $Entregables;
        }
        if ($total_cuadro > 0) {
            $por_area = round(($total_area * 100) / $total_cuadro, 1);
        } else {
            $por_area = 0;
        }
        $cadenaTotalesArea .= "<div  id='totalArea" . $area["Id_Area"] . "' onclick=''  class=' j2 horizontal'><p class='rotarT'>" . $total_area . "</p><p class='porcentajeTot' style='font-size: .6em;color:green;'>$por_area%</p></div>";
        $seleccion .= "";
    }
} else {
    // $Entregables = $Entregable->Entregables_indicador($periodo, 1, 8, $categoria, $estatus);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.SIE.::</title>
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_entregables.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_opiniones.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style type="text/css">
        a:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="well2 "><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Entregables dashboard</a></b>
        <i id="global" data-toggle="tooltip" data-placement="bottom" title="Entregables general" style="position: absolute;right: 9px;cursor:pointer;" class="fas fa-grip-horizontal" aria-hidden="true"></i>

    </div>

    <div class="well2 wr">
        <p style="position: absolute;left: -1px;top: 31px;">Totales</p>
        <p id="t" data-toggle="tooltip" data-placement="bottom" title="Total de Entregables" style="top: 46px;cursor:pointer;background-color:#0093a3;border: 1px solid white;left:1px;color:white; <?php echo $stylo_1;  ?>" onclick="tipo(1);" class="totales a <?php echo $resalta_1; ?>"><?php echo $totales[0]; ?></p>
        <p id="a" data-toggle="tooltip" data-placement="bottom" title="Final" style="top: 46px;cursor:pointer;background-color: #33ab15;border: 1px solid white;left:94px;color:white; <?php echo $stylo_4; ?>" onclick="tipo(10);" class="totales a <?php echo $resalta_2; ?>"><?php echo $totales[1]; ?></p>
        <p id="pa" data-toggle="tooltip" data-placement="bottom" title="Inicial" style="top: 46px;cursor:pointer;background-color:#dfa739;border: 1px solid white;left:32px;color:white; <?php echo $stylo_2; ?>" onclick="tipo(9);" class="totales a  <?php echo $resalta_3; ?>"><?php echo $totales[2]; ?></p>
        <p id="pt" data-toggle="tooltip" data-placement="bottom" title="Proceso" style="top: 46px;cursor:pointer;background-color:#dbd909;left: 63px;border: 1px solid white; <?php echo $stylo_3; ?>" onclick="tipo(14);" class="totales a <?php echo $resalta_4; ?>"><?php echo $totales[3]; ?></p>


        <p style="position:absolute;top:42px;right:30px;"># total</p>
        <div class="titleano">Año&nbsp;&nbsp; <b></b></div>
        <div class="anoSelect">
            <select style="width: 47px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="anio" id="anio" onchange="filtros();">>
                <option value="todos">Todos</option>
                <?php
                $Perfil = "SELECT p.Id_Periodo,p.Periodo from c_periodo p ORDER BY p.Periodo  DESC";
                $resul = $catalogo->obtenerLista($Perfil);
                while ($row = mysqli_fetch_array($resul)) {
                    if ($Periodo == $row['Periodo'] || $Periodo == $row['Id_Periodo']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="titleeje">Eje&nbsp;&nbsp; <b></b></div>
        <div class="ejeSelect" style="padding-left: 0; padding-right: 0;">
            <select style="width: 146px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="eje" id="eje" onchange="filtros();">>
                <option value="0">Seleccione una opción</option>
                <?php
                $eje = "SELECT e.idEje,CONCAT(e.orden,'.-',e.Nombre) nombre FROM c_eje e";
                $resul = $catalogo->obtenerLista($eje);
                while ($row = mysqli_fetch_array($resul)) {
                    if ($Id_eje == $row['idEje']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='" . $row['idEje'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="titlecate">Categorías&nbsp;&nbsp; <b></b></div>
        <div class="cateSelect" style="padding-left: 0;">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="cate" id="cate" onchange="filtros();">
                <option value="0">Seleccione una opción</option>
                <?php
                if ($categoria_select == true) {
                    $c_categoria = "SELECT
                    ce.idCategoria,
                    ce.descCategoria 
                FROM
                    c_categoriasdeejes ce
                    INNER JOIN c_periodo p ON p.Periodo = ce.anio 
                WHERE
                    ce.idEje = $Id_eje 
                    AND p.Id_Periodo =$Periodo AND ce.nivelCategoria=1 ORDER BY ce.orden";
                    $resul_cate = $catalogo->obtenerLista($c_categoria);
                    while ($row = mysqli_fetch_array($resul_cate)) {
                        if ($Categoria == $row['idCategoria']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="titlesubcate">Sub-Categorías&nbsp;&nbsp; <b></b></div>
        <div class="subcateSelect" style="padding-left: 0;">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="subcate" id="subcate" onchange="filtros();">
                <option value="0">Seleccione una opción</option>
                <?php
                if ($sub_categoria_select == true) {
                    $c_subcategoria = "SELECT
                    ce.idCategoria,
                    ce.descCategoria 
                FROM
                    c_categoriasdeejes ce
                WHERE
                    ce.idCategoriaPadre=1 ORDER BY ce.orden";
                    $resul_subcate = $catalogo->obtenerLista($c_subcategoria);
                    while ($row = mysqli_fetch_array($resul_subcate)) {
                        if ($Sub_categoria == $row['idCategoria']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
                    }
                }

                ?>
            </select>
        </div>
    </div>
    <div class="global">
        <?php if ($Id_eje == "" || $Id_eje == 0) {  ?>
            <?php
            $top_px = 54;
            foreach ($ejes as $eje) { //imprime toda la linea
                $top_px--;
                if ($total_cuadro > 0) {
                    $por_eje = round(($totales_ejes[$eje] * 100) / $total_cuadro, 1);
                } else {
                    $por_eje = 0;
                }

            ?>
                <div style="top:<?php echo $top_px; ?>px" class="flotante">
                    <?php echo $cadenas_ejes[$eje]; ?>
                    <div class="totEj">
                        <p class="totEjeFin"><?php echo $totales_ejes[$eje]; ?></p>
                        <p class="totEjeFinPercent" style="font-size: .9em;color:green;"><?php echo $por_eje; ?>%</p>
                    </div>

                </div>
            <?php
            }
            ?>
            <div class="flotante" style="top: 42px;">
                <?php echo $cadenaTotalesArea; ?>
                <div class="totEj">
                    <p style="font-size: 15px;color:black"><?php echo $total_cuadro; ?></p>
                </div>
            </div>
        <?php } else {  ?>
            <?php $eje = 0;
            for ($i = 0; $i < 12; $i++) {
                $eje = $i + 1; ?>
                <div style="<?php echo $array_estilos[$i] ?>" class="flotante">
                    <?php if ($eje == $Id_eje) {
                        $areas = $Entregable->getAreas();
                        while ($area = mysqli_fetch_assoc($areas)) {

                            $Entregables = $Entregable->Entregables_indicador($Periodo, $area["Id_Area"], $eje, $Categoria, $estatus);
                            if ($Entregables == 0) {
                                $style = "style='opacity:.4;'";
                                $onclick = "";
                            } else {
                                $style = "style='background-color: #0093a3;color:white;'";
                                $onclick = "onclick='muestraDetalle(" . $area["Id_Area"] . ",$eje,$Periodo,$estatus);'";
                            }



                            echo " <div $style id='ae$eje" . $area["Id_Area"] . "'  class='j  horizontal' $onclick><p class='rotarT'>" . $Entregables . "</p></div>";
                        }
                        if ($totales[0] > 0) {
                            $porcentajesR = round($totales[1] * 100 / $totales[0]);
                            $porcentajesNR = round($totales[2] * 100 / $totales[0]);
                        }
                        echo '<div class="totEj">';
                        echo ' <p class="totEjeFin">' . $totales[0] . '</p>';
                        /*            echo ' <p class="totEjeFinPercent2" style="font-size: .9em;color:black;">' . $porcentajesNR . '% en proceso</p>';
                    echo ' <p class="totEjeFinPercent" style="font-size: .9em;color:green;">' . $porcentajesR . '% resueltas</p>'; */
                        echo '</div>';
                    } ?>
                </div>
            <?php  } ?>
        <?php } ?>
    </div>
    <input type="hidden" id="opcion" name="opcion" value="<?php echo $estatus ?>" />
    <div>
        <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="left: -132px;width: 860px;">
                    <div class="modal-header h" style="padding: 7px 5px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="modal-title" id="modalTitle">Entregables detalle</div>
                    </div>
                    <div class="modal-body detalle_entregable" style="padding: 31px 5px;"></div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

    });


    function tipo(estatus) {
        var eje = $('#eje').val();
        var anio = $('#anio').val();
        var cate = $('#cate').val();
        var subcate = $('#subcate').val();
        url = "Dashboard_entregables.php?estatus=" + estatus + "&eje=" + eje + "&anio=" + anio + "&cate=" + cate + "&subcate=" + subcate;
        $(location).attr('href', url);
    }

    function filtros() {
        var eje = $('#eje').val();
        var anio = $('#anio').val();
        var cate = $('#cate').val();
        var subcate = $('#subcate').val();
        var tipo = $('#opcion').val();
        url = "Dashboard_entregables.php?estatus=" + tipo + "&eje=" + eje + "&anio=" + anio + "&cate=" + cate + "&subcate=" + subcate;
        $(location).attr('href', url);

    }

    function muestraDetalle(Id_area, Id_eje, Periodo, Estatus) {
        var cate = $('#cate').val();
        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("Entregable_detalle.php", {
            Id_area: Id_area,
            eje: Id_eje,
            cate: cate,
            anio: Periodo,
            estatus: Estatus
        }, function(data) {
            $(".detalle_entregable").html('');
            $(".detalle_entregable").html(data);
        });
    }
    $('#global').on("click", function() {
        url = "index.php";
        $(location).attr('href', url);
    });
</script>

</html>