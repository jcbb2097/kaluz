<?php
$id_eje = $_POST["Id_eje"];
$id_categoria = $_POST["Id_categoria"];
$periodo = $_POST["periodo"];
$query = "";
$total_e = 0;
$total_p=0;
$total_ac=0;
$total_a=0;
$totales="";

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Indicador_entregables.class.php');

$catalogo = new Catalogo();
$entregables = new Indicador_entregable();

$totales=$entregables->Total_categoria($id_categoria,$periodo);
$total_ac=$totales[0];
$total_a=$totales[1];
$total_p=$totales[2];


//echo$query;
echo '<input type="hidden" id="periodo" name="id" value="' . $periodo . '"/>';
echo '<input type="hidden" id="categoria" name="id" value="' . $id_categoria . '"/>';
echo '<input type="hidden" id="eje" name="id" value="' . $id_eje . '"/>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categorias</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group form-group-sm">
                    <ul class="nav nav-tabs" style="font-family: 'Muli-Regular';font-size: 11px;">
                        <li id="LisI"><a style='color: #3c3c3c;' id="Li" onclick="muestraActividad();"  data-toggle="tab" href="#Actividad">Áctividad <span style="background-color: #1d3d73;" class="label label-primary listaI"><?php echo$total_ac;?></span></a></li>
                        <li id="LisP"><a style='color: #3c3c3c;' id="Lp" onclick="muestraArea();" data-toggle="tab" href="#Area">Área <span style="background-color: #1d3d73;" class="label label-primary listaP"><?php echo$total_a;?></span></a></li>
                        <li id="LisM"><a style='color: #3c3c3c;' id="Lm" onclick="muestraResponsable();" data-toggle="tab" href="#Persona">Responsables <span style="background-color: #1d3d73;" class="label label-primary listaM"><?php echo$total_p;?></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <input type="hidden" id="opcion" name="opcion" value="1" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tab-content">
                    <div id="home2" class="tab-pane fade in active"><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
        
        var periodo = $('#periodo').val();
        var cate = $('#categoria').val();
        var eje = $('#eje').val();
        $.post("Actividades_categorias.php", {
            periodo: periodo,
            categoria: cate,
            eje: eje,
        }, function(data) {
            $("#LisI").addClass("active");
            $("#home2").html('');
            $("#home2").html(data);
        });

    });

    function muestraActividad() {
        var periodo = $('#periodo').val();
        var cate = $('#categoria').val();
        var eje = $('#eje').val();
        $("#opcion").val(1);
        $.post("Actividades_categorias.php", {
            periodo: periodo,
            categoria: cate,
            eje: eje,
        }, function(data) {
            $("#home2").html('');
            $("#home2").html(data);
        });
    }

    function muestraArea() {
        var periodo = $('#periodo').val();
        var cate = $('#categoria').val();
        var eje = $('#eje').val();
        $("#opcion").val(2);
        $.post("Area_categorias.php", {
            periodo: periodo,
            categoria: cate,
            eje: eje,
        }, function(data) {
            $("#home2").html('');
            $("#home2").html(data);
        });
    }

    function muestraResponsable() {
        var periodo = $('#periodo').val();
        var cate = $('#categoria').val();
        var eje = $('#eje').val();
        $("#opcion").val(3);
        $.post("Responsables_categorias.php", {
            periodo: periodo,
            categoria: cate,
            eje: eje,
        }, function(data) {
            $("#home2").html('');
            $("#home2").html(data);
        });
    }
</script>

</html>