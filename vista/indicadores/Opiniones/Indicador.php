<?PHP
include_once('../../../WEB-INF/Classes/Indicadores_opiniones.class.php');
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$indicadores = new Indicadores_opiniones();
$ano = "";
$tipo = "";
$select1 = "";
$select2 = "";
$select3 = "";
$select4 = "";
$select5 = "";
$titulo = "";
$consulta = "";
$where_1 = "";
$persona = "";
$titulo_sin = "";
$stylo = "";
$total_opiniones = 0;
$total_atendidas = 0;
$total_natendidas = 0;
$extra_nombre = "";
$t = 0;
$categorias = array();
$series = array();
$Total_indicador = 0;
$titulo_grafica = "";
$total_opiniones = $indicadores->totales();
if (isset($_GET['tipo']) && $_GET['tipo'] != "") {
    $ano = $_GET['periodo'];
    $tipo = $_GET['tipo'];
    $persona = $_GET['persona'];
    echo '<input type="hidden" id="persona" name="persona" value="' . $persona . '" />';
    //echo$ano;
}
if ($tipo == 1) {
    if ($ano == 'Todos') {
        $select1 = "selected";
        $titulo = "Origen";
        $titulo2 = "Opiniones por " . $titulo;
        $consulta = "SELECT
        oo.IdOpinionOrigen as ID,
        oo.Descripcion AS datos,
        ( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen) AS series,
        (SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND op.IdEstatusOpinion = 4 ) AS atendidas ,
(SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND op.IdEstatusOpinion in(1,2,3)	) AS n_atendidas  
    FROM
        c_opinionesOrigen oo 
    ORDER BY
        oo.Descripcion";
    } else {
        $select1 = "selected";
        $titulo = "Origen";
        $titulo2 = "Opiniones por " . $titulo . ' ' . $ano;
        $consulta = "SELECT
	oo.IdOpinionOrigen as ID,
	oo.Descripcion AS datos,
	( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND YEAR(op.Fecha) = $ano ) AS series,
    (SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND op.IdEstatusOpinion = 4 AND YEAR(op.Fecha) = $ano  ) AS atendidas ,
(SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdOrigenOpinion = oo.IdOpinionOrigen AND op.IdEstatusOpinion in(1,2,3) AND YEAR(op.Fecha) = $ano ) AS n_atendidas 
FROM
	c_opinionesOrigen oo 
ORDER BY
	oo.Descripcion";
    }
    //echo$consulta;
} elseif ($tipo == 2) {
    if ($ano == 'Todos') {
        $select2 = "selected";
        $titulo = "Tipo";
        $titulo2 = "Opiniones por " . $titulo;
        $consulta = "SELECT
	oo.IdOpinionTipo as ID,
	oo.Descripcion AS datos,
	( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdTipoOpinion = oo.IdOpinionTipo ) AS series,
	( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdTipoOpinion = oo.IdOpinionTipo AND op.IdEstatusOpinion=4) AS atendidas,
	( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdTipoOpinion = oo.IdOpinionTipo AND op.IdEstatusOpinion in(1,2,3)) AS n_atendidas 
FROM
	c_opinionesTipo oo 
ORDER BY
	oo.Descripcion";
    } else {
        $select2 = "selected";
        $titulo = "Tipo";
        $titulo2 = "Opiniones por " . $titulo . ' ' . $ano;
        $consulta = "SELECT
        oo.IdOpinionTipo as ID,
        oo.Descripcion AS datos,
        ( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdTipoOpinion = oo.IdOpinionTipo AND YEAR(op.Fecha) = $ano ) AS series,
	( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdTipoOpinion = oo.IdOpinionTipo AND op.IdEstatusOpinion=4 AND YEAR(op.Fecha) = $ano) AS atendidas,
	( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdTipoOpinion = oo.IdOpinionTipo AND op.IdEstatusOpinion in(1,2,3) AND YEAR(op.Fecha) = $ano) AS n_atendidas  
    FROM
        c_opinionesTipo oo 
    ORDER BY
        oo.Descripcion";
    }
   // echo$consulta;
} elseif ($tipo == 3) {
    if ($ano == 'Todos') {
        $select3 = "selected";
        $titulo = "Eje";
        $titulo2 = "Opiniones por Eje";
        $titulo_sin = "Sin turnar a eje";
        $consulta = "SELECT
       oo.idEje as ID,
            CONCAT(oo.IdEje,'.-',oo.Nombre) as datos,
        ( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje) AS series,
( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje AND op.IdEstatusOpinion=4) AS atendidas,
( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje AND op.IdEstatusOpinion in
(1,2,3)) AS n_atendidas 
    FROM
        c_eje oo 
    ORDER BY
        oo.idEje";
    } else {
        $select3 = "selected";
        $titulo = "Eje";
        $titulo2 = "Opiniones por " . $titulo . ' ' . $ano;
        $consulta = "SELECT
         oo.idEje as ID,
            CONCAT(oo.IdEje,'.-',oo.Nombre) as datos,
        ( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje AND YEAR(op.Fecha) = $ano ) AS series,
( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje AND op.IdEstatusOpinion=4 AND YEAR(op.Fecha) = $ano) AS atendidas,
( SELECT COUNT( op.IdOpinion ) FROM c_opiniones op WHERE op.IdEjeTurnado = oo.idEje AND op.IdEstatusOpinion in
(1,2,3) AND YEAR(op.Fecha) = $ano) AS n_atendidas 
    FROM
        c_eje oo 
    ORDER BY
        oo.idEje";
    }
    //echo$consulta;
} elseif ($tipo == 4) {
    if ($ano == 'Todos') {
        $select4 = "selected";
        $titulo = "Área";
        $titulo_sin = "Sin turnar a Área";
        $titulo2 = "Opiniones por " . $titulo;
        $consulta = "SELECT a.Id_Area AS ID,a.Nombre AS datos,
        (SELECT COUNT(op.IdOpinion) FROM c_opiniones op INNER JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada WHERE ac.IdArea=a.Id_Area) as series,
        (SELECT COUNT(op.IdOpinion) FROM c_opiniones op INNER JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada WHERE op.IdEstatusOpinion=4 AND ac.IdArea=a.Id_Area) as atendidas,
        (SELECT COUNT(op.IdOpinion) FROM c_opiniones op INNER JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada WHERE op.IdEstatusOpinion in(1,2,3) AND ac.IdArea=a.Id_Area) as n_atendidas
        FROM c_area a JOIN c_actividad ac ON ac.IdArea = a.Id_Area GROUP BY a.Nombre ORDER BY series DESC";
        $stylo = "overflow:scroll;height:500px;";
    } else {
        $select4 = "selected";
        $titulo = "Área";
        $titulo2 = "Opiniones por " . $titulo . ' ' . $ano;
        $consulta = "SELECT a.Id_Area AS ID,a.Nombre AS datos,
        (SELECT COUNT(op.IdOpinion) FROM c_opiniones op INNER JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada WHERE ac.IdArea=a.Id_Area AND YEAR(op.Fecha)=$ano) as series,
        (SELECT COUNT(op.IdOpinion) FROM c_opiniones op INNER JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada WHERE op.IdEstatusOpinion=4 AND ac.IdArea=a.Id_Area AND YEAR(op.Fecha)=$ano) as atendidas,
        (SELECT COUNT(op.IdOpinion) FROM c_opiniones op INNER JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada WHERE op.IdEstatusOpinion in(1,2,3) AND ac.IdArea=a.Id_Area AND YEAR(op.Fecha)=$ano) as n_atendidas
        FROM c_area a JOIN c_actividad ac ON ac.IdArea = a.Id_Area GROUP BY a.Nombre ORDER BY series DESC";
        $stylo = "overflow:scroll;height:500px;";
    }
    // echo$consulta;
} elseif ($tipo == 5) {
    if ($ano == 'Todos') {
        $select5 = "selected";
        $titulo = "Persona";
        $stylo = "overflow:scroll;height:500px;";
        $titulo2 = "Opiniones por " . $titulo;
        $consulta = "SELECT 
        p.id_Personas as ID,
        CASE
	WHEN
		ISNULL(
			CONCAT('[', p.Nombre, ' ', p.Apellido_Paterno, ']',' ','[', a.Nombre, ']' )) THEN
			'Sin respuesta' ELSE CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']',' ','[', a.Nombre, ']'  ) 
		END AS datos,
                COUNT( op.IdOpinion ) AS series,
(SELECT COUNT( o.IdOpinion ) FROM c_opiniones o LEFT JOIN c_actividad a ON a.IdActividad = o.IdActTurnada LEFT JOIN c_personas p ON p.id_Personas=a.IdResponsable WHERE a.IdResponsable=ac.IdResponsable and o.IdEstatusOpinion=4) AS atendidas,
(SELECT COUNT( o.IdOpinion ) FROM c_opiniones o LEFT JOIN c_actividad a ON a.IdActividad = o.IdActTurnada LEFT JOIN c_personas p ON p.id_Personas=a.IdResponsable WHERE a.IdResponsable=ac.IdResponsable and o.IdEstatusOpinion in(1,2,3)) AS n_atendidas
        FROM
            c_opiniones op
            LEFT JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada
            LEFT JOIN c_personas p ON p.id_Personas=ac.IdResponsable
            LEFT JOIN c_area a ON a.Id_Area=p.idArea
            GROUP BY
            datos";
    } else {
        $select5 = "selected";
        $titulo = "Persona";
        $stylo = "overflow:scroll;height:500px;";
        $titulo2 = "Opiniones por " . $titulo . ' ' . $ano;
        $consulta = "SELECT 
        p.id_Personas as ID,
        CASE
	WHEN
		ISNULL(
			CONCAT('[', p.Nombre, ' ', p.Apellido_Paterno, ']',' ','[', a.Nombre, ']' )) THEN
			'Sin respuesta' ELSE CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']',' ','[', a.Nombre, ']'  ) 
		END AS datos,
                COUNT( op.IdOpinion ) AS series,
(SELECT COUNT( o.IdOpinion ) FROM c_opiniones o LEFT JOIN c_actividad a ON a.IdActividad = o.IdActTurnada LEFT JOIN c_personas p ON p.id_Personas=a.IdResponsable WHERE a.IdResponsable=ac.IdResponsable and o.IdEstatusOpinion=4 AND YEAR(o.Fecha)=$ano) AS atendidas,
(SELECT COUNT( o.IdOpinion ) FROM c_opiniones o LEFT JOIN c_actividad a ON a.IdActividad = o.IdActTurnada LEFT JOIN c_personas p ON p.id_Personas=a.IdResponsable WHERE a.IdResponsable=ac.IdResponsable and o.IdEstatusOpinion in(1,2,3) AND YEAR(o.Fecha)=$ano) AS n_atendidas 
        FROM
            c_opiniones op
            LEFT JOIN c_actividad ac on ac.IdActividad=op.IdActTurnada
            LEFT JOIN c_personas p ON p.id_Personas=ac.IdResponsable
            LEFT JOIN c_area a ON a.Id_Area=p.idArea
            WHERE YEAR(op.Fecha)=$ano
            GROUP BY
            datos";
    }
    // echo$consulta;
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <!--  <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_opiniones.css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div id="recargar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="tipo" class="form-control" name="tipo" onchange="indicador();">
                                <option <?php echo $select1; ?> value="1">Origen</option>
                                <option <?php echo $select2; ?> value="2">Tipo</option>
                                <option <?php echo $select3; ?> value="3">Eje</option>
                                <option <?php echo $select4; ?> value="4">Área</option>
                                <option <?php echo $select5; ?> value="5">Persona</option>
                            </select>
                        </div>
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Año : </label>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <select id="anio" class="form-control" name="anio" onchange="indicador();">
                                <?php
                                $AÑO = "SELECT DISTINCT 
                            CASE
                                    WHEN ISNULL(YEAR ( p.Fecha ) ) THEN 'Todos' 
                                    ELSE YEAR ( p.Fecha ) 
                                END as Periodo
                            FROM
                                c_opiniones p";
                                $resulaño = $catalogo->obtenerLista($AÑO);
                                if ($ano == 'Todos') {
                                    $selected2 = "selected";
                                }

                                while ($row = mysqli_fetch_array($resulaño)) {

                                    if ($ano == $row['Periodo'] && $ano != 'Todos') {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $row['Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                                }
                                echo "<option value='Todos' " . $selected2 . "> Todos</option>";

                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- overflow:scroll;height:500px; -->
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-6 col-sm-6 col-xs-6" style="<?php echo $stylo; ?>">
                    <table class="table table-striped table-bordered" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th><?php echo $titulo; ?></th>
                                <th> # </th>
                                <th>Atendidas</th>
                                <th>Sin atender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $catalogo->obtenerLista($consulta);
                            $onclick = "";
                            $tituloM = "";
                            //echo$consulta;
                            while ($rowareas = mysqli_fetch_array($result)) {
                                $Total_indicador = $Total_indicador + $rowareas['series'];
                                $total_atendidas = $total_atendidas + $rowareas['atendidas'];
                                $total_natendidas = $total_natendidas + $rowareas['n_atendidas'];
                                $ID = $rowareas['ID'];
                                if ($tipo == 3) {
                                    $separador = explode('-', $rowareas['datos']);
                                    $tituloM = $separador[1];
                                } elseif ($tipo == 4 || $tipo == 5) {
                                    $tituloM = $rowareas['datos'];
                                } else {
                                    $tituloM = $titulo;
                                }
                                $onclick = "onclick='muestraDetalle2(\"$tipo\",\"$ano\",\"$ID\",\"0\");mostrarModal(\"$tituloM\",\"$ano\",\"0\");' ";
                                $onclickA = "onclick='muestraDetalle2(\"$tipo\",\"$ano\",\"$ID\",\"1\");mostrarModal(\"$tituloM\",\"$ano\",\"1\");' ";
                                $onclickNA = "onclick='muestraDetalle2(\"$tipo\",\"$ano\",\"$ID\",\"2\");mostrarModal(\"$tituloM\",\"$ano\",\"2\");' ";

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['datos'] . '</td>';
                                echo '<td ' . $onclick . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['series'] . '</td>';
                                echo '<td ' . $onclickA . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['atendidas'] . '</td>';
                                echo '<td ' . $onclickNA . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $rowareas['n_atendidas'] . '</td>';
                                echo '</tr>';
                                array_push($categorias, $rowareas['datos']);
                                array_push($series, $rowareas['series']);
                            }
                            $nombres = "";
                            for ($i = 0; $i < count($categorias); $i++) {
                                $nombres = $nombres . "'" . $categorias[$i] . "'";
                                if ($i + 1 < count($categorias)) {
                                    $nombres = $nombres . ",";
                                }
                            }
                            $resultados = "";
                            for ($index = 0; $index < count($series); $index++) {
                                $resultados = $resultados . $series[$index];
                                if ($index + 1 < count($series)) {
                                    $resultados = $resultados . ",";
                                }
                            }
                            if ($tipo == 4 && $ano == 'Todos' || $tipo == 3 && $ano == 'Todos') {
                                $onclick2 = "onclick='muestraDetalle2(\"6\",\"$ano\",\"$tipo\");'";
                                echo '<tr id="trFila">';
                                echo '<td>' . $titulo_sin . '</td>';
                                echo '<td ' . $onclick2 . 'style="color: rgb(124,181,236); text-decoration: underline;">' . $t = $total_opiniones - $Total_indicador . '</td>';
                                echo '<td>0</td>';
                                echo '<td>0</td>';
                                echo '</tr>';
                            }
                            ?>

                        </tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <td>Total</td>
                                <td><?php

                                    if ($tipo == 4 && $ano == 'Todos' || $tipo == 3 && $ano == 'Todos') {
                                        echo $total_opiniones;
                                    } else {
                                        echo $Total_indicador;
                                    }
                                    ?></td>
                                <td><?php echo $total_atendidas; ?></td>
                                <td><?php echo $total_natendidas; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
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
</body>

<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            }
        },
        title: {
            text: '<?php echo $titulo2; ?>'
        },
        xAxis: {
            categories: [
                <?php
                echo $nombres;
                ?>
            ],
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            }
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Número de Opiniones',
                skew3d: true
            }
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },
        series: [{
            name: 'Opiniones',
            data: [
                <?php
                echo $resultados;
                ?>
            ],
            stack: 'male'
        }]
    });

    function indicador() {
        var periodo = $("#anio").val();
        var tipo = $("#tipo").val();
        var persona = $("#persona").val();

        $("#recargar").load("Indicador.php?periodo=" + periodo + "&tipo=" + tipo + '&persona=' + persona);
    }

    function muestraDetalle2(tipo, ano, id, caso) {

        $(".h").css('background-color', "#4d4d57");
        $("#myModal").modal({
            backdrop: false
        });
        $.post("Datos_grafica.php", {
            tipo: tipo,
            Ano: ano,
            Id: id,
            Caso: caso
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });
    }

    function mostrarModal(nombre, ano, tipo) {
        var extra = "";
        if (tipo == 1) {
            extra = 'atendidas';
        } else if (tipo == 2) {
            extra = 'sin atender';
        } else {
            extra = "";
        }
        if (ano != 'Todos') {
            var titulo = 'Opiniones ' + extra + ' de ' + nombre + ' en ' + ano;
        } else {
            var titulo = 'Opiniones ' + extra + ' de ' + nombre;
        }
        $("#modalTitle").html(titulo);
        $("#myModal").modal("show");
    }
</script>

</html>