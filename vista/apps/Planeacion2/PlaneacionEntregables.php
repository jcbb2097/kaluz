<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$titulo = "";
$color_anio = "efff00";

$Periodo = $_GET["periodo"];
$ano = $_GET["ano"];
//$ano = $_GET["ano"];

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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
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
    <div class="well2 "><a style="color:#fefefe;" href="Index.php?nombreUsuario=<?php  ?>&idUsuario=<?php ?>&tipoPerfil=<?php  ?>&perfil=<?php  ?>&periodo=<?php echo $Periodo ?>&Year=<?php echo $ano ?>"> <a style="color:#<?php echo $color_anio; ?>;" href="javascript:window.location.reload(true)">Periodo: <?php echo $ano ?></a></b>
            <i onclick="history.back()" data-toggle="tooltip" data-placement="bottom" title="" style="position: absolute;right: 73px;cursor:pointer; margin-right: -63px;" class="fa fa-undo" aria-hidden="true" data-original-title="Regresar"></i>
    </div>
    <div class="well2 wr">
        <div class="titlecategoria"> &nbsp;&nbsp; <b></b></div>
        <div class="cateSelect">

        </div>

        <div class="titleacme"> &nbsp;&nbsp; <b></b></div>
        <div class="acmeSelect">

        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <button id="mostrarFiltros" style="width: 87px; height: 20px; font-size: 10px; background-color: #f4c7f9; border-color: #5a274f;">Mostrar Filtros</button>
        <div id="plan" class="">
        </div>

    </div>

</body>
<script>
    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
        var periodo = <?php echo $Periodo; ?>;
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
        var persona = $('#perso').val();
        if (subcategoria > 0) {
            filtro = subcategoria;
        } else {
            filtro = categoria;
        }
        var tipoFiltro = 3;
        $.post("verplanecionEntregables.php", {
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
            persona: persona,

        }, function(data) {
            $("#plan").html('');
            $("#plan").html(data);
            $("#filtro").val(filtro);
        });

        $("#mostrarFiltros").click(function() {
            filtrosTabla();
            $("#mostrarFiltros").hide();
        });
    });

    function filtrosTabla() {
        var table = $('#datosTabla').DataTable({
            orderCellsTop: true,
            fixedHeader: true
        });
   
        $('#datosTabla thead tr').clone(true).appendTo('#datosTabla thead');

        $('#datosTabla thead tr:eq(1) th').each(function(i) {
            var title = $(this).text(); 
            $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });
    }

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
        var persona = $('#perso').val();
        if (subcategoria > 0) {
            filtro = subcategoria;
        } else {
            filtro = categoria;
        }
        url = "PlaneacionPersona.php?IdEje=" + eje + "&tipo=" + tipo + "&Periodo=" + periodo + "&ano=" + ano + "&nombreeje=" + Nombreeje + "&Id_usuario=" + Id_usuario + "&nombreUsuario=" + nombreUsuario + "&Perfil=" + Perfil + "&tipoPerfil=" + Perfil + "&categoria=" + categoria + "&subcategoria=" + subcategoria + "&persona=" + persona;
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


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

<script>
    $(document).ready(function() {

    });
</script>

</html>