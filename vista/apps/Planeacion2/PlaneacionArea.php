<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$titulo = "";
$color_anio = "";
$id_eje = $_GET["IdEje"];
$tipo = $_GET["tipo"];
$Periodo = $_GET["Periodo"];
$ano = $_GET["ano"];
$Nombreeje = $_GET["nombreeje"];
$nombreUsuario = $_GET['nombreUsuario'];
$Id_usuario = $_GET['Id_usuario'];
$Perfil = $_GET['Perfil'];
$tipoPerfil = $_GET['Perfil'];

if (isset($_GET['categoria']) && $_GET['categoria'] != "") {
    $idCategoria = $_GET['categoria'];
} else {
    $idCategoria = "";
}
if (isset($_GET['persona']) && $_GET['persona'] != "") {
    $persona = $_GET['persona'];
} else {
    $persona = $Id_usuario;
}
if (isset($_GET['area']) && $_GET['area'] != "") {
    $area = $_GET['area'];
} else {
    $area = "";
}
if (isset($_GET['subcategoria']) && $_GET['subcategoria'] != "") {
    $idSubategoria = $_GET['subcategoria'];
} else {
    $idSubategoria = "";
}
if ($ano == 2021) {
    $color_anio = '4ffa2d';
} else {
    $color_anio = 'ffef5e';
}
if ($tipo == 1) {
    $titulo = "Planeación " . $ano;
    $selectA = "selected";
    $selectM = "";
} else {
    $titulo = "Planeación " . $ano;
    $selectM = "selected";
    $selectA = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
        .titlesubcategoria {
            position: absolute;
            top: 43px;
            left: 210px;
        }

        .cateSelect {
            position: absolute;
            top: 43px;
            left: 74px;
        }

        .subcateSelect {
            position: absolute;
            top: 43px;
            left: 301px;
        }

        .titleacme {
            position: absolute;
            top: 43px;
            left: 215px;
        }

        .acmeSelect {
            position: absolute;
            top: 43px;
            left: 255px;
        }

        .check {
            position: absolute;
            top: 40px;
            left: 455px;
        }

        .namecheck {
            position: absolute;
            top: 43px;
            left: 400px;
        }

        .rein {
            position: absolute;
            top: 39px;
            left: 681px;
        }

        .plus {
            position: absolute;
            top: 39px;
            left: 711px;
        }
    </style>
</head>

<body>
    <div class="well2 "><a style="color:#fefefe;" href="Index.php?nombreUsuario=<?php echo $nombreUsuario ?>&idUsuario=<?php echo $Id_usuario ?>&tipoPerfil=<?php echo $tipoPerfil ?>&perfil=<?php echo $Perfil ?>&periodo=<?php echo $Periodo ?>&Year=<?php echo $ano ?>"><?php echo $titulo ?> / <a style="color:#<?php echo $color_anio; ?>;" href="javascript:window.location.reload(true)"><?php echo $Nombreeje; ?></a></b>
    <i onclick="history.back()" data-toggle="tooltip" data-placement="bottom" title="" style="position: absolute;right: 73px;cursor:pointer; margin-right: -63px;" class="fa fa-undo" aria-hidden="true" data-original-title="Regresar"></i>    
</div>
    <div class="well2 wr">
        <div class="titlecategoria">Área: &nbsp;&nbsp; <b></b></div>
        <div class="cateSelect">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';color: black;" name="area" id="area" onchange="filtros();">
                <option value="0">Seleccione una opción</option>
                <?php
                $consultapersonas = "SELECT a.Id_Area,a.Nombre FROM c_area as a WHERE a.estatus=1 ORDER BY a.Nombre";
                $resul_cate = $catalogo->obtenerLista($consultapersonas);
                while ($row = mysqli_fetch_array($resul_cate)) {
                    $s = '';
                    if ($row['Id_Area'] == $area) {
                        $s = 'selected="selected"';
                    }
                    echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="titleacme">Tipo : &nbsp;&nbsp; <b></b></div>
        <div class="acmeSelect">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';color: black;" name="tipo" id="tipo" onchange="filtros();">
                <option value="1" <?php echo $selectA ?>>Actividad</option>
                <option value="2" <?php echo $selectM ?>>Meta</option>
            </select>
        </div>
        
        <div id="totalEntregable" class="titleacme" style="margin-left: 205px;">
        </div>
        <div id="totalPorcentaje" class="titleacme" style="margin-left: 324px;">
        </div>
       
        <input type="hidden" id="eje" value="<?php echo $id_eje ?>">
        <input type="hidden" id="anio" value="<?php echo $Periodo ?>">
        <input type="hidden" id="Nombreeje" value="<?php echo $Nombreeje ?>">
        <input type="hidden" id="ano" value="<?php echo $ano ?>">
        <input type="hidden" id="Id_usuario" value="<?php echo $Id_usuario ?>">
        <input type="hidden" id="nombreUsuario" value="<?php echo $nombreUsuario ?>">
        <input type="hidden" id="Perfil" value="<?php echo $Perfil ?>">
        <input type="hidden" id="categoria" value="<?php echo $idCategoria ?>">
        <input type="hidden" id="subcategoria" value="<?php echo $idCategoria ?>">
        <input type="hidden" id="filtro" value="<?php echo $filtro ?>">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="cargando" style="display:none; margin-left: 203px;margin-top: 10px;">
        </div>
        <div id="cab" class="">
        </div>
        <div id="plan" class="">
        </div>
    </div>
    <div style="top: -73px;" class="modal fade check" id="myModal" role="dialog">

    <div class="modal-dialog" style="top: 150px;position: absolute;left: 20px;width: 784px;">
       <!-- Modal content-->
      <div class="modal-content">
       <div class="modal-header h" style="padding: 7px 5px;font-size: 11px;">
         <button type="button" class="close" data-dismiss="modal" style="color: white;font-size: 15px;">&times;</button>
         <span style="font-size: 11px;color: white;" id="titulo_modal"></span>
         </div>
           <div class="modal-body detalle" style="padding: 10px;"></div>
        </div>
    </div>
</div>
</body>
<script>

    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
        var periodo = $('#anio').val();
        var categoria = 0;
        var subcategoria = 0;
        var eje = $('#eje').val();
        var tipo = $('#tipo').val();
        var Nombreeje = $('#Nombreeje').val();
        var ano = $('#ano').val();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var check = $('#muestra').val();
        var filtro = $('#filtro').val();
        var area = $('#area').val();
        if (subcategoria > 0) {
            filtro = subcategoria;
        } else {
            filtro = categoria;
        }

        document.getElementById("cargando").style.display="block";
        document.getElementById("cargando").innerHTML="<img src='cargando.gif' width = '400' heigth = '400' >";

        var tipoFiltro = 3;
        $.post("verplanecion.php", {
            categoria: categoria,
            subcategoria: subcategoria,
            periodo: periodo,
            IdEje: eje,
            Tipo: tipo,
            Nombreeje: Nombreeje,
            ano: ano,
            Id_usuario: Id_usuario,
            nombreUsuario: nombreUsuario,
            Perfil: Perfil,
            check: check,
            filtro: filtro,
            tipoFiltro: tipoFiltro,
            area: area,

        }, function(data) {

            $("#filtro").val(filtro);

            var datosConsulta = data.split('+');

                  $("#plan").html('');
                  $("#plan").html(datosConsulta[0]);

                  $("#totalEntregable").html('');
                  $("#totalEntregable").html(datosConsulta[1]);
        
                  $("#totalPorcentaje").html('');
                  $("#totalPorcentaje").html(datosConsulta[2]);
           
                  document.getElementById("cargando").style.display="none";
        });


    });

    function filtros(reini) {
        if (reini == 1) {
            var categoria = 0;
            var subcategoria = 0;
            seleccionar();
            filtro = 0;
        } else {
            var categoria = $('#cate').val();
            var subcategoria = $('#subcate').val();
        }
        var periodo = $('#anio').val();
        var eje = $('#eje').val();
        var tipo = $('#tipo').val();
        var Nombreeje = $('#Nombreeje').val();
        var ano = $('#ano').val();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var check = $('#muestra').val();
        var area = $('#area').val();
        if (subcategoria > 0) {
            filtro = subcategoria;
        } else {
            filtro = categoria;
        }
        url = "PlaneacionArea.php?IdEje=" + eje + "&tipo=" + tipo + "&Periodo=" + periodo + "&ano=" + ano + "&nombreeje=" + Nombreeje + "&Id_usuario=" + Id_usuario + "&nombreUsuario=" + nombreUsuario + "&Perfil=" + Perfil + "&tipoPerfil=" + Perfil + "&categoria=" + categoria + "&subcategoria=" + subcategoria + "&area=" + area;
        $(location).attr('href', url);
    }

    function activa() {
        var check = $('#muestra').val();
        if (check == 0) {
            check++;
            $("#muestra").val(check);
        } else {
            check--;
            $("#muestra").val(check);
        }
        filtros();
    }

    function seleccionar() {
        $('#cate').html("");
        $('#subcate').html("");
        $("#muestra").prop("checked", false);
        $("#muestra").val(0);
        Categorias();
    }

</script>

</html>