<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>  
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php   
}
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
include_once("../../../WEB-INF/Classes/Noticias.class.php");
$catalogo = new Catalogo();

$primero="";
if ($_GET['Eje']) {
    $primero = $_GET['Eje'];
    //echo "string " . $primero;
}
$tot = 0;
$categorias = array();
$total = array();
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
    <title>::.INDICADOR NOTICIAS.::</title>
    <style>
        .select-2 {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin-top: 2px;
        text-overflow: '';
        text-indent: 0.01px;
        border-radius: 0px!important;
        }
        .select-2{
        font-family: 'Muli', sans-serif;
        font-size: 12px;
        font-weight: 400;
        color: #BFBFC2;
        padding: 2px;
        border: none;
        outline: none;
        border: .5px double transparent;
        background-color: #ececec;
        }
        .select-input-2 {
        position: relative;
        display: inline-block;
        margin-right: 10px;
        }
        .select-input-2 select {
        width: 100%;
        }
        .select-input-2:first-of-type {
        width: 100%;
        }
        .select-input-2 {
        width: 100%;
        margin-right: 6px;
        }
        .flecha{
            color: #2D2D30;
            pointer-events: none;
            position: absolute;
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
            right: 8px;
            top: 39%;
            font-size: 9px;
        }
        .lbl-tit{
          font-family: 'Muli-Regular';
          font-size: 18px;
        }
        .img-i{
          border-radius: 23px;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          margin-bottom: 19px;
          cursor: pointer;
          height: 100px;
          width: 110px;
          min-height: 80px;
          min-width: 80px;
          transition: transform .2s; /* Animation */
        }
        .img-i:hover {
          transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
        .cantidades{
          font-family: 'Muli-Regular';
          font-size: 15px;
          font-weight: 200;
          color:#4b0207;
        }
        .cajas{
          text-align: center;
        }
        .es-li{
          list-style-type: none;
          font-family: 'Muli-Regular';
          font-size: 13px;
          font-weight: 200;
          margin-left: -39px;
          color:#737373;
        }
    </style>
</head>
<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Noticias</a></div>
    <?php
    /*if ((isset($_GET['usuario']) && $_GET['usuario'] != "")) {
        $user = $_GET['usuario'];
        echo '<a style="color:purple; font-family: Muli-SemiBold;" href="index.php?accion=guardar&usuario='.$user.'"'.'> &nbsp; Transparencia (app)</a>';
    }*/
    /*$nombre="";
    $titulo="";
    if (isset($_GET['Eje']) && $_GET['Eje'] == 1) {
        echo "<script> cambiarContenido('#recargar','grafica.php?tipo=1');</script>";
    }*/

    ?>
    <legend style="text-align: center;">Noticias</legend>
</body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="selecc" class="form-control" name="selecc" onchange="indicador();">
                        <!-- <option value="00">Seleccione una opción</option> -->
                        <option value="1">Eje</option>
                        <option value="2">Área</option>
                        <option value="3">Año</option>
                        <option value="4">Lugar de noticia</option>
                        <option value="5">Tipo de noticia</option>
                        <option value="6">Soporte de noticia</option>
                        <option value="7">Tipo de medio</option>
                        <option value="8">Género</option>
                        <option value="9">Medio</option>
                        <option value="10">Calificación</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div id="recargar">
            <?php if ($primero == 1){
                echo '
                <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Eje</th>
                        <th>Total de Noticias por Eje</th>
                    </tr>
                </thead>
                <tbody>
                ';
                $eje1 = "1. Estrategias de Seguridad";
                $eje2 = "2. Plan Estratégico";
                $eje3 = "3. Infraestructura";
                $eje4 = "4. Gestión Administrativa";
                $eje5 = "5. Autogestión de Recursos";
                $eje6 = "6. Exposición Permanente";
                $eje7 = "7. Exposiciones Temporales";
                $eje8 = "8. Bellas Artes para Todos";
                $eje9 = "9. Difusión e Imagen";
                $eje10 = "10. Publicaciones";
                $eje11 = "11. Estrategia Digital";
                $totalEje1 = 0;
                $totalEje2 = 0;
                $totalEje3 = 0;
                $totalEje4 = 0;
                $totalEje5 = 0;
                $totalEje6 = 0;
                $totalEje7 = 0;
                $totalEje8 = 0;
                $totalEje9 = 0;
                $totalEje10 = 0;
                $totalEje11 = 0;
                $eje = "SELECT
                            n.idNoticia,
                            n.Titulo,
                            n.FechaPublicacion,
                            n.idEje,
                            e.Nombre AS Nombre_eje 
                        FROM
                            c_noticia n
                            LEFT JOIN c_eje e ON e.idEje = n.idEje";
                $resulteje = $catalogo->obtenerLista($eje);
                while ($rs = mysqli_fetch_array($resulteje)) {
                    array_push($categorias, $rs['Nombre_eje']);
                    if ($rs['Nombre_eje'] == "Estrategias de Seguridad") {
                        $totalEje1 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Plan Estratégico") {
                        $totalEje2 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Infraestructura") {
                        $totalEje3 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Gestión Administrativa") {
                        $totalEje4 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Autogestión de Recursos") {
                        $totalEje5 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Exposición Permanente") {
                        $totalEje6 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Exposiciones Temporales") {
                        $totalEje7 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Bellas Artes para Todos") {
                        $totalEje8 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Difusión e Imagen") {
                        $totalEje9 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Publicaciones") {
                        $totalEje10 += 1;
                        $tot += 1;
                    }
                    if ($rs['Nombre_eje'] == "Estrategia Digital") {
                        $totalEje11 += 1;
                        $tot += 1;
                    }
                }
                echo '<tr>';
                echo '<td>' . $eje1 . '</td>';
                echo '<td>' . $totalEje1 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje2 . '</td>';
                echo '<td>' . $totalEje2 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje3 . '</td>';
                echo '<td>' . $totalEje3 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje4 . '</td>';
                echo '<td>' . $totalEje4 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje5 . '</td>';
                echo '<td>' . $totalEje5 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje6 . '</td>';
                echo '<td>' . $totalEje6 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje7 . '</td>';
                echo '<td>' . $totalEje7 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje8 . '</td>';
                echo '<td>' . $totalEje8 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje9 . '</td>';
                echo '<td>' . $totalEje9 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje10 . '</td>';
                echo '<td>' . $totalEje10 . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>' . $eje11 . '</td>';
                echo '<td>' . $totalEje11 . '</td>';
                echo '</tr>';
                $categorias = array($eje1, $eje2, $eje3, $eje4, $eje5, $eje6, $eje7, $eje8, $eje9, $eje10, $eje11);
                $total = array($totalEje1, $totalEje2, $totalEje3, $totalEje4, $totalEje5, $totalEje6, $totalEje7, $totalEje8, $totalEje9, $totalEje10, $totalEje11);
            ?>
                </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de Noticias</th>
                            <th scope="col"><?php echo $tot; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <figure class="highcharts-figure">

                    <div id="container"></div>
                </figure>
            </div>

            <script>
 
Highcharts.chart('container', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Noticias por Eje'
  },
  xAxis: {
     categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".$valor."', "; }?>]
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Noticias'
    }
  },
  legend: {
    reversed: false
  },
  plotOptions: {
    series: {
      stacking: 'normal'
    }
  },
  series: [{
    name: '<?php echo $tot;?> Noticias' ,
    data: [<?php   foreach ($total as $clave => $valor) { echo  $valor.", "; }?>]
  }]
});

</script>

            <?php } ?>
        </div>
    </div>
</div>
<script>
function indicador(){
    //var periodo = $("#periodo").val();
    $("#recargar").load("grafica.php?accion=2&&tipo=" + $("#selecc").val());
}

</script>

</html>
