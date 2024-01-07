<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../session.php";
$catalogo = new Catalogo();
$id_eje = $_GET["IdEje"];
$tipo = $_GET["tipo"];
$Periodo = $_GET["Periodo"];
$ano = $_GET["ano"];
$Nombreeje = $_GET["nombreeje"];
$idCategoria = "";
$idSubategoria = "";
$titulo = "";

if (isset($_GET['filtro']) && $_GET['filtro'] != "") {
    $filtro = $_GET["filtro"];
} elseif (isset($_POST['filtro']) && $_GET['_POST'] != "") {
    $filtro = $_POST["filtro"];
} else {
    $filtro = "";
}
if (isset($_GET['categoria']) && $_GET['categoria'] != "") {
    $categoria_filtro = $_GET["categoria"];
}else{
  $categoria_filtro = "";
}

$nombreUsuario = $_GET['nombreUsuario'];
$Id_usuario = $_GET['Id_usuario'];
$Perfil = $_GET['Perfil'];
$tipoPerfil = $_GET['Perfil'];
$color_anio = "";
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
            left: 435px;
        }

        .acmeSelect {
            position: absolute;
            top: 43px;
            left: 470px;
        }

        .check {
            position: absolute;
            top: 40px;
            left: 655px;
        }

        .namecheck {
            position: absolute;
            top: 43px;
            left: 604px;
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
    </div>
    <div class="well2 wr">
        <div class="titlecategoria">Categorías : &nbsp;&nbsp; <b></b></div>
        <div class="cateSelect">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';color: black;" name="cate" id="cate" onchange="filtros();Sub_Categorias();">
                <option value="0">Seleccione una opción</option>
                <?php
                $c_categoria = "SELECT
                *
            FROM
                c_categoriasdeejes ce
                INNER JOIN k_categoriasdeejes_anios cea ON cea.idCategoria = ce.idCategoria
                INNER JOIN c_periodo p on p.Periodo=cea.Anio
                WHERE p.Id_Periodo=$Periodo AND ce.nivelCategoria=1 AND ce.idEje=$id_eje AND cea.Visible=1 AND ACME=$tipo
                ORDER BY ce.orden";
                $resul_cate = $catalogo->obtenerLista($c_categoria);
                while ($row = mysqli_fetch_array($resul_cate)) {
                    $selected = "";
                    if($categoria_filtro == $row['idCategoria'])
                      $selected = "selected";
                    echo "<option value='" . $row['idCategoria'] . "' " . $selected . ">" . $row['descCategoria'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="titlesubcategoria">Sub-Categorías : &nbsp;&nbsp; <b></b></div>
        <div class="subcateSelect">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';color: black;" name="subcate" id="subcate" onchange="filtros();">
                <option value="">no aplica</option>
            </select>
        </div>
        <div class="titleacme">Tipo : &nbsp;&nbsp; <b></b></div>
        <div class="acmeSelect">
            <select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';color: black;" name="tipo" id="tipo" onchange="filtros();">
                <option value="1" <?php echo $selectA ?>>Actividad</option>
                <option value="2" <?php echo $selectM ?>>Meta</option>
            </select>
        </div>
        <div class="namecheck">mostrar : &nbsp;&nbsp; <b></b></div>
        <div class="check">
            <input type="checkbox" name="muestra" id="muestra" value="0" onchange="activa()">
        </div>
        <div class="rein"><button onclick="filtros(1);"><i class="fas fa-undo" data-toggle="tooltip" data-placement="top" data-original-title="restablecer filtros"></i></button></div>
        <div class="plus"><button onclick="newCategoria(1,<?php echo $tipo ?>,<?php echo $id_eje ?>,<?php echo $Periodo ?>,'<?php echo $Nombreeje ?>',<?php echo $ano ?>,<?php echo $Id_usuario ?>,'<?php echo $nombreUsuario ?>',<?php echo $Perfil ?>)"><i class="fas fa-plus-circle" data-toggle="tooltip" data-placement="top" data-original-title="agregar categoría"></i></button></div>
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

        <div id="plan" class="">
        </div>
    </div>
<!--     <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
        <div id="check" class="">

        </div>
    </div> -->

</body>
<script>
    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        <?php if (isset($_GET['categoria']) && $_GET['categoria'] != ""){
          echo "$('#categoria').val(".$_GET['categoria'].");";
        } ?>

        var periodo = $('#anio').val();
        var categoria = $('#categoria').val();
        console.log("cat: "+categoria);
        var subcategoria = $('#subcategoria').val();
        var eje = $('#eje').val();
        var tipo = $('#tipo').val();
        var Nombreeje = $('#Nombreeje').val();
        var ano = $('#ano').val();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var check = $('#muestra').val();
        var filtro = $('#filtro').val();
        var tipoFiltro = 1;
        $.post("Avance_categoria.php", {
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

        }, function(data) {
            $("#plan").html('');
            $("#plan").html(data);
            $("#filtro").val(filtro);
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
        var tipoFiltro = 1;
        if (subcategoria > 0) {
            filtro = subcategoria;
        } else {
            filtro = categoria;
        }

        $.post("Avance_categoria.php", {
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

        }, function(data) {
            $("#plan").html('');
            $("#plan").html(data);

        });
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

    function Sub_Categorias() {

        var cate = $('#cate').val();
        var periodo = $('#anio').val();
        $('#subcate').load("Controllers/Acciones_planeacion.php", {
            cate: cate,
            subcategoria: 'subcategoria',
            periodo: periodo,
        }, function(data) {
            $(this).select();
        });
    }

    function seleccionar() {
        $('#cate').html("");
        $('#subcate').html("");
        $("#muestra").prop("checked", false);
        $("#muestra").val(0);
        Categorias();
    }

    function Categorias() {
        var eje = $('#eje').val();
        var periodo = $('#anio').val();
        $('#cate').load("Controllers/Acciones_planeacion.php", {
            categoria: 'categoria',
            ideje: eje,
            anio: periodo
        }, function(data) {
            $(this).select();
        });
    }

    function newCategoria(Nivel, Tipo, id_eje, Periodo, Nombreeje, ano, Id_usuario, nombreUsuario, Perfil) {
        url = 'Alta_categoria.php?accion=guardar&IdEje=' + id_eje + '&tipo=' + Tipo + '&Periodo=' + Periodo + '&ano=' + ano + '&nombreeje=' + Nombreeje + '&nombreUsuario=' + nombreUsuario + '&Id_usuario=' + Id_usuario + '&Perfil=' + Perfil;
        $(location).attr('href', url);
    }

</script>

</html>
