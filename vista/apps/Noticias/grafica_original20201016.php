<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$accion = "";
$tipo = "";
//$periodo = "";
$nombre = "";
$titulo = "";
$tot = 0;
$categorias = array();
$total = array();


if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    $accion = $_GET['accion'];
    //$periodo = $_GET['periodo'];
    if ($tipo == 1) {
        $nombre = 'Eje';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 2) {
        $nombre = 'Área';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 3) {
        $nombre = 'Año';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 4) {
        $nombre = 'Lugar de Noticia';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 5) {
        $nombre = 'Tipo de Noticia';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 6) {
        $nombre = 'Soporte de Noticia';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 7) {
        $nombre = 'Tipo de Medio';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 8) {
        $nombre = 'Género';
        $titulo = 'Total de Noticias por ' . $nombre;
    } elseif ($tipo == 9) {
        $nombre = 'Medio';
        $titulo = 'Total de Noticias por ' . $nombre;
    } else {
        $nombre = 'Calificación';
        $titulo = 'Total de Noticias por ' . $nombre;
    }
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
    <script src="../../../resources/js/aplicaciones/Noticias/Alta_Noticias.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            echo '<th>' . $nombre . '</th>';
                            echo '<th>Total de Noticias por ' . $nombre . '</th>'
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($tipo == 1) {
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
                        } elseif ($tipo == 2) {
                            $area = "SELECT
                                        count( * ) AS total,
                                    CASE
                                            
                                            WHEN idArea = 1 THEN
                                            'Dirección' 
                                            WHEN idArea = 2 THEN
                                            'Jefa de Oficina' 
                                            WHEN idArea = 3 THEN
                                            'Relaciones Publicas' 
                                            WHEN idArea = 4 THEN
                                            'Proyectos Especiales' 
                                            WHEN idArea = 5 THEN
                                            'Sistemas' 
                                            WHEN idArea = 6 THEN
                                            'Fotografía' 
                                            WHEN idArea = 7 THEN
                                            'Subdirección Técnica' 
                                            WHEN idArea = 8 THEN
                                            'Indicadores' 
                                            WHEN idArea = 9 THEN
                                            'Exhibición' 
                                            WHEN idArea = 10 THEN
                                            'Registro' 
                                            WHEN idArea = 11 THEN
                                            'Mediación' 
                                            WHEN idArea = 12 THEN
                                            'Difusión' 
                                            WHEN idArea = 13 THEN
                                            'Museografía' 
                                            WHEN idArea = 14 THEN
                                            'Arquitectura' 
                                            WHEN idArea = 15 THEN
                                            'Diseño' 
                                            WHEN idArea = 16 THEN
                                            'Editorial' 
                                            WHEN idArea = 17 THEN
                                            'Investigación' 
                                            WHEN idArea = 18 THEN
                                            'Administración' 
                                            WHEN idArea = 19 THEN
                                            'Presupuesto' 
                                            WHEN idArea = 20 THEN
                                            'Recursos Humanos' 
                                            WHEN idArea = 21 THEN
                                            'Recursos Financieros' 
                                            WHEN idArea = 22 THEN
                                            'Recursos Materiales' 
                                            WHEN idArea = 23 THEN
                                            'Jurídico' 
                                            WHEN idArea = 24 THEN
                                            'Seguridad' 
                                            WHEN idArea = 25 THEN
                                            'Custodios' 
                                            WHEN idArea = 26 THEN
                                            'Amigos del MPBA' 
                                            WHEN idArea = 27 THEN
                                            'INBAL' 
                                            WHEN idArea = 28 THEN
                                            'Proyectos Externos' 
                                            WHEN idArea = 29 THEN
                                            'Jefatura de Exhibición' 
                                            WHEN idArea = 30 THEN
                                            'Gestión de Exhibición' 
                                            WHEN idArea = 31 THEN
                                            'Investigación Educativa' 
                                            WHEN idArea = 32 THEN
                                            'Programas Públicos' 
                                            WHEN idArea = 33 THEN
                                            'Redes Sociales' 
                                            WHEN idArea = 34 THEN
                                            'Prensa' 
                                            WHEN idArea = 35 THEN
                                            'Audiovisual' 
                                            WHEN idArea = 36 THEN
                                            'Promoción' 
                                            WHEN idArea = 37 THEN
                                            'Servicio Social' 
                                            WHEN idArea = 38 THEN
                                            'Archivo' 
                                            WHEN idArea = 39 THEN
                                            'Taquilla' 
                                            WHEN idArea = 40 THEN
                                            'Tienda' 
                                            WHEN idArea = 41 THEN
                                            'Presidencia' 
                                            WHEN idArea = 42 THEN
                                            'Electrónicos' 
                                            WHEN idArea = 43 THEN
                                            'Servicios al público' 
                                            WHEN idArea = 44 THEN
                                            'Coordinación Operativa' 
                                            WHEN idArea = 45 THEN
                                            'Limpieza' 
                                            WHEN idArea = 46 THEN
                                            'Pintura' 
                                            WHEN idArea = 47 THEN
                                            'Iluminación' 
                                            WHEN idArea = 1000 THEN
                                            'Administrador' ELSE 'Sin Área' 
                                        END AS Area 
                                    FROM
                                        c_noticia
                                    GROUP BY
                                        idArea";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['Area']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Area'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }

                        } elseif ($tipo == 3) {
                            $anio = "SELECT
										count( * ) AS total,
										DATE_FORMAT(FechaPublicacion,'%Y') AnioP,
									CASE
											
											WHEN DATE_FORMAT(FechaPublicacion,'%Y') = '2018' THEN
											'2018' 
											WHEN DATE_FORMAT(FechaPublicacion,'%Y') = '2019' THEN
											'2019' 
											WHEN DATE_FORMAT(FechaPublicacion,'%Y') = '2020' THEN
											'2020' ELSE 'Sin Información' 
										END AS Anio 
									FROM
										c_noticia 
									GROUP BY
										Anio";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Anio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Anio'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 4) {
                            $lugar = "SELECT
                                        count( * ) AS total,
                                        idLugarNoticia,
                                    CASE
                                            WHEN idLugarNoticia = 1 THEN
                                            'Local' 
                                            WHEN idLugarNoticia = 2 THEN
                                            'Nacional'
                                            WHEN idLugarNoticia = 3 THEN
                                            'Internacional' ELSE 'sin información' 
                                        END AS Lugar
                                    FROM
                                        c_noticia
                                    GROUP BY
                                        Lugar";
                            $resultanio = $catalogo->obtenerLista($lugar);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Lugar']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Lugar'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 5) {
                            $tipon = "SELECT
                                        count( * ) AS total,
                                        idTipo,
                                    CASE
                                            
                                            WHEN idTipo = 1 THEN
                                            'Interna' 
                                            WHEN idTipo = 2 THEN
                                            'Externa-Nacional' 
                                            WHEN idTipo = 3 THEN
                                            'Externa-Internacional' ELSE 'sin información' 
                                        END AS TipoN 
                                    FROM
                                        c_noticia 
                                    GROUP BY
                                        TipoN";
                            $resultanio = $catalogo->obtenerLista($tipon);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['TipoN']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoN'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 6){
                            $soporte = "SELECT
                                        count( * ) AS total,
                                        idSoporte,
                                    CASE
                                            
                                            WHEN idSoporte = 1 THEN
                                            'Impreso' 
                                            WHEN idSoporte = 2 THEN
                                            'Digital' 
                                            WHEN idSoporte = 3 THEN
                                            'Otro' ELSE 'Sin información' 
                                        END AS Soporte 
                                    FROM
                                        c_noticia 
                                    GROUP BY
                                        Soporte";
                            $resultanio = $catalogo->obtenerLista($soporte);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Soporte']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Soporte'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 7) {
                            $tmedio = "SELECT
                                            count( * ) AS total,
                                            idTipoMedio,
                                        CASE
                                                
                                                WHEN idTipoMedio = 1 THEN
                                                'Portal Web' 
                                                WHEN idTipoMedio = 2 THEN
                                                'Revista'
                                                WHEN idTipoMedio = 3 THEN
                                                'Periódico'
                                                WHEN idTipoMedio = 4 THEN
                                                'Agencia de Noticias'
                                                WHEN idTipoMedio = 5 THEN
                                                'Televisión'
                                                WHEN idTipoMedio = 6 THEN
                                                'Radio'
                                                WHEN idTipoMedio = 7 THEN
                                                'Blog' ELSE 'Sin información' 
                                            END AS TipoMedio 
                                        FROM
                                            c_noticia 
                                        GROUP BY
                                            TipoMedio";
                            $resultanio = $catalogo->obtenerLista($tmedio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['TipoMedio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoMedio'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 8) {
                            $genero = "SELECT
                                        count( * ) AS total,
                                        idGenero,
                                    CASE
                                            
                                            WHEN idGenero = 1 THEN
                                            'Entrevista' 
                                            WHEN idGenero = 2 THEN
                                            'Crónica'
                                            WHEN idGenero = 3 THEN
                                            'Nota'
                                            WHEN idGenero = 4 THEN
                                            'Articulo'
                                            WHEN idGenero = 5 THEN
                                            'Especial'
                                            WHEN idGenero = 6 THEN
                                            'Reportaje' ELSE 'Sin información' 
                                        END AS Genero 
                                    FROM
                                        c_noticia 
                                    GROUP BY
                                        Genero";
                            $resultanio = $catalogo->obtenerLista($genero);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Genero']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Genero'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 9) {
                            $medio = "SELECT
                                        count( * ) AS total,
                                        idMedio,
                                    CASE
                                            
                                            WHEN idMedio = 1 THEN
                                            'Travesías' 
                                            WHEN idMedio = 2 THEN
                                            'Alan por el Mundo'
                                            WHEN idMedio = 3 THEN
                                            'SDP Noticas'
                                            WHEN idMedio = 4 THEN
                                            'Chilango'
                                            WHEN idMedio = 5 THEN
                                            'Sopitas'
                                            WHEN idMedio = 6 THEN
                                            'Reforma'
                                            WHEN idMedio = 7 THEN
                                            'MXCITY' 
                                            WHEN idMedio = 8 THEN
                                            'WARP' 
                                            WHEN idMedio = 9 THEN
                                            'Time Out' 
                                            WHEN idMedio = 10 THEN
                                            'El Universal' 
                                            WHEN idMedio = 11 THEN
                                            'La Razón' 
                                            WHEN idMedio = 12 THEN
                                            'Zócalo' 
                                            WHEN idMedio = 13 THEN
                                            'Rancho Las Voces' 
                                            WHEN idMedio = 14 THEN
                                            'El Financiero' 
                                            WHEN idMedio = 15 THEN
                                            'Infórmate' 
                                            WHEN idMedio = 16 THEN
                                            'es! Diario popular' 
                                            WHEN idMedio = 17 THEN
                                            '20 Minutos' 
                                            WHEN idMedio = 18 THEN
                                            '20 Minutos' 
                                            WHEN idMedio = 19 THEN
                                            'Joven Es Hacer Política' 
                                            WHEN idMedio = 20 THEN
                                            'La Crónica' 
                                            WHEN idMedio = 21 THEN
                                            'El Sol de México' 
                                            WHEN idMedio = 22 THEN
                                            'El Heraldo de Chihuahua' 
                                            WHEN idMedio = 23 THEN
                                            'Diario de Xalapa' 
                                            WHEN idMedio = 24 THEN
                                            'La Voz de la Frontera' 
                                            WHEN idMedio = 25 THEN
                                            'El Economista' 
                                            WHEN idMedio = 26 THEN
                                            'El Sol de Tampico' 
                                            WHEN idMedio = 27 THEN
                                            'El Occidental' 
                                            WHEN idMedio = 28 THEN
                                            'Excélsior' 
                                            WHEN idMedio = 29 THEN
                                            'Milenio' 
                                            WHEN idMedio = 30 THEN
                                            'El Heraldo de México' 
                                            WHEN idMedio = 31 THEN
                                            'Capital de México' 
                                            WHEN idMedio = 32 THEN
                                            'Vértigo Político' 
                                            WHEN idMedio = 33 THEN
                                            'El Sol de San Juan del Río' 
                                            WHEN idMedio = 34 THEN
                                            'El Sol de Puebla' 
                                            WHEN idMedio = 35 THEN
                                            'El Sol de Tlaxcala' 
                                            WHEN idMedio = 36 THEN
                                            'El Sol de Zacatecas' 
                                            WHEN idMedio = 37 THEN
                                            'El Sol de Acapulco' 
                                            WHEN idMedio = 38 THEN
                                            'El Diario de Querétaro' 
                                            WHEN idMedio = 39 THEN
                                            'El Sol de Cuernavaca' 
                                            WHEN idMedio = 40 THEN
                                            'El Sol de Irapuato' 
                                            WHEN idMedio = 41 THEN
                                            'El Herlado de San Luis Potosí' 
                                            WHEN idMedio = 42 THEN
                                            'El Sol de Toluca' 
                                            WHEN idMedio = 43 THEN
                                            'Contra Réplica' 
                                            WHEN idMedio = 44 THEN
                                            'Notimex' 
                                            WHEN idMedio = 45 THEN
                                            'Reporte Índigo' 
                                            WHEN idMedio = 46 THEN
                                            'Canal Once' 
                                            WHEN idMedio = 47 THEN
                                            'El País' 
                                            WHEN idMedio = 48 THEN
                                            'El Diario' 
                                            WHEN idMedio = 49 THEN
                                            'El Sol de San Luis' 
                                            WHEN idMedio = 50 THEN
                                            'Ovaciones' 
                                            WHEN idMedio = 51 THEN
                                            'Bitácora Cultural' 
                                            WHEN idMedio = 52 THEN
                                            'Antena Radio' 
                                            WHEN idMedio = 53 THEN
                                            'Antena Radio (Vespertino)' 
                                            WHEN idMedio = 54 THEN
                                            'Radio Educación' 
                                            WHEN idMedio = 55 THEN
                                            'Angular 11/18 MX' 
                                            WHEN idMedio = 56 THEN
                                            'Noticias Once con Javier Solórzano' 
                                            WHEN idMedio = 57 THEN
                                            'Milenio TV' 
                                            WHEN idMedio = 58 THEN
                                            'Arena Pública' 
                                            WHEN idMedio = 59 THEN
                                            'El Imparcial' 
                                            WHEN idMedio = 60 THEN
                                            'Yahoo Noticias' 
                                            WHEN idMedio = 61 THEN
                                            'Pulso SLP' 
                                            WHEN idMedio = 62 THEN
                                            'Sin Embargo' 
                                            WHEN idMedio = 63 THEN
                                            'Frontera. Info' 
                                            WHEN idMedio = 64 THEN
                                            'Siempre' 
                                            WHEN idMedio = 65 THEN
                                            'Milenio TV (Noticias con Sandra Narváez)' 
                                            WHEN idMedio = 66 THEN
                                            'Milenio TV (Noticias con Marilú Kaufman)' 
                                            WHEN idMedio = 67 THEN
                                            'The Mexican Times' 
                                            WHEN idMedio = 68 THEN
                                            'Proceso' 
                                            WHEN idMedio = 69 THEN
                                            'Milenio TV (Noticiero matutino)' 
                                            WHEN idMedio = 70 THEN
                                            'Milenio TV (Noticiero vespertino)' 
                                            WHEN idMedio = 71 THEN
                                            'Cultura Colectiva' 
                                            WHEN idMedio = 72 THEN
                                            'Cuarto Poder Chiapas' 
                                            WHEN idMedio = 73 THEN
                                            'La Jornada Baja California' 
                                            WHEN idMedio = 74 THEN
                                            'UAMRadio' 
                                            WHEN idMedio = 75 THEN
                                            'La Jornada' ELSE 'Sin información' 
                                        END AS Medio 
                                    FROM
                                        c_noticia 
                                    GROUP BY
                                        Medio";
                            $resultanio = $catalogo->obtenerLista($medio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Medio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Medio'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }else {
                            $calif = "SELECT
                                count( * ) AS total,
                                idCalificacion,
                            CASE
                                    
                                    WHEN idCalificacion = 1 THEN
                                    'Positiva' 
                                    WHEN idCalificacion = 2 THEN
                                    'Informativa' ELSE 'Sin información' 
                                END AS Calif 
                            FROM
                                c_noticia 
                            GROUP BY
                                Calif";
                            $resultanio = $catalogo->obtenerLista($calif);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Calif']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Calif'] . '</td>';
                                echo '<td>' . $rowareas['total'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }

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

        </div>
    </div>
</body>

<script>
 
Highcharts.chart('container', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Noticias por <?php echo $nombre; ?>'
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
</html>