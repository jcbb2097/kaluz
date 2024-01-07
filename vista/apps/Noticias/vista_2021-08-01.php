<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$tot = 0;
$categorias = array();
$total = array();

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual=date("2020");
$Aplicacion="Noticias";
$MiTipoPerfil=1;
$MiIdUsr=1;
$MiNomUsr="Carlos";
?>

<script>
    var MiApp='<?php echo $Aplicacion; ?>';
    var MiTipoPerfil='<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr='<?php echo $MiIdUsr; ?>';
    var MiNomUsr='<?php echo $MiNomUsr; ?>';
    var MiAnioAct='<?php echo $AnioActual; ?>';
</script>

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
    <link rel="stylesheet" href="./css/noticias_vista.css">
    <title>::.Indicador.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=<?php echo $MiTipoPerfil; ?>">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"><?php echo $Aplicacion; ?></a></div>
    <legend id="AnioTitulo" style="text-align: center;"><?php echo $Aplicacion." ".$AnioActual; ?></legend>
</body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="selecc" class="form-control" name="selecc" onchange="IndicadorTipo();">
                        <option value="1">Eje</option>
                        <option value="2">Área</option>
                        <option value="3">Año</option>
                        <option value="11">Exposición</option>
                        <option value="4">Lugar de noticia</option>
                        <option value="5">Tipo de noticia</option>
                        <option value="6">Soporte de noticia</option>
                        <option value="7">Tipo de medio</option>
                        <option value="8">Género</option>
                        <option value="9">Medio (TOP 50)</option>
                        <option value="10">Calificación</option>
                    </select>
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Año : </label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="anio" class="form-control" name="anio" onchange="IndicadorAnio();">
                        <option >2021</option>
                        <option selected>2020</option>
                        <option >2019</option>
                        <option >2018</option>
                        <option >2017</option>
                        <option >2016</option>
                        <option >2015</option>
                        <option >2014</option>
                        <option >2013</option>
                        <option >Todos</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div id="recargar">
            <?php
                echo '
                <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Eje</th>
                        <th>Total de '.$Aplicacion.'</th>
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
                            LEFT JOIN c_eje e ON e.idEje = n.idEje
                            WHERE n.FechaPublicacion BETWEEN '".$AnioActual."/01/01 00:00:00' AND '".$AnioActual."/12/31 23:59:59'";
                $resulteje = $catalogo->obtenerLista($eje);
                while ($rs = mysqli_fetch_array($resulteje)) {
                    array_push($categorias, $rs['Nombre_eje']);
                    if ($rs['Nombre_eje'] == "Estrategias de Seguridad") { $totalEje1  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Plan Estratégico") {         $totalEje2  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Infraestructura") {          $totalEje3  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Gestión Administrativa") {   $totalEje4  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Autogestión de Recursos") {  $totalEje5  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Exposición Permanente") {    $totalEje6  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Exposiciones Temporales") {  $totalEje7  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Bellas Artes para Todos") {  $totalEje8  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Difusión e Imagen") {        $totalEje9  += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Publicaciones") {            $totalEje10 += 1; $tot += 1; }
                    if ($rs['Nombre_eje'] == "Estrategia Digital") {       $totalEje11 += 1; $tot += 1; }
                }
                echo '<tr><td>'.$eje1.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=1&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje1.'</a></td></tr>';
                echo '<tr><td>'.$eje2.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=2&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje2.'</a></td></tr>';
                echo '<tr><td>'.$eje3.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=3&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje3.'</a></td></tr>';
                echo '<tr><td>'.$eje4.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=4&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje4.'</a></td></tr>';
                echo '<tr><td>'.$eje5.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=5&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje5.'</a></td></tr>';
                echo '<tr><td>'.$eje6.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=6&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje6.'</a></td></tr>';
                echo '<tr><td>'.$eje7.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=7&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje7.'</a></td></tr>';
                echo '<tr><td>'.$eje8.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=8&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje8.'</a></td></tr>';
                echo '<tr><td>'.$eje9.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=9&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje9.'</a></td></tr>';
                echo '<tr><td>'.$eje10.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=10&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje10.'</a></td></tr>';
                echo '<tr><td>'.$eje11.'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje=11&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje11.'</a></td></tr>';
                $categorias = array($eje1, $eje2, $eje3, $eje4, $eje5, $eje6, $eje7, $eje8, $eje9, $eje10, $eje11);
                $total = array($totalEje1, $totalEje2, $totalEje3, $totalEje4, $totalEje5, $totalEje6, $totalEje7, $totalEje8, $totalEje9, $totalEje10, $totalEje11);
            ?>
                </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total</th>
                            <th scope="col"><?php echo '<a href="Lista.php?F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$tot.'</a>'; ?></th>
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
                chart: { type: 'bar'  },
                title: { text: '<?php echo $Aplicacion; ?> por Eje' },
                xAxis: { categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".$valor."', "; }?>] },
                yAxis: { min: 0, title: { text: '<?php echo $Aplicacion; ?>' } },
                legend: { reversed: false },
                plotOptions: { series: { stacking: 'normal' } },
                series: [{
                            name: '<?php echo $tot;?> <?php echo $Aplicacion; ?>' ,
                            data: [<?php   foreach ($total as $clave => $valor) { echo  $valor.", "; }?>]
                        }]
                });
            </script>
        </div>
    </div>
</div>

<script>
    function IndicadorTipo(){
        if ($("#selecc").val()==3) {
            $("#anio").val("Todos");
            $("#AnioTitulo").html(MiApp+' (Todos los años)');
        }
        $("#recargar").load("grafica.php?F_IdAnio="+$("#anio").val()+"&tipo="+$("#selecc").val());

    }

    function IndicadorAnio(){
        if ($("#anio").val()=="Todos") { $("#AnioTitulo").html(MiApp+' (Todos los años)'); }
        else { $("#AnioTitulo").html(MiApp+' '+$("#anio").val()); }
        $("#recargar").load("grafica.php?F_IdAnio="+$("#anio").val()+"&tipo="+$("#selecc").val());
    }
</script>
</html>