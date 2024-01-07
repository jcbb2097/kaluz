<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$where_ = "";
$join_periodo = "";
if(isset($_POST["fecha"]))
  if($_POST["fecha"] != "todos"){
    $join_periodo = " join c_periodo pe on pe.Id_Periodo=ju.Id_periodo ";
    $where_ .= " AND pe.Periodo = ".$_POST["fecha"];
  }
if(isset($_POST["eje_filtro"]))
  if($_POST["eje_filtro"] != "todos")  $where_ .= " AND ju.Id_eje  = ".$_POST["eje_filtro"];
if(isset($_POST["area_filtro"]))
  if($_POST["area_filtro"] != "todos")  $where_ .= " AND ju.IdArea  = ".$_POST["area_filtro"];
if(isset($_POST["exposicion"]))
  if($_POST["exposicion"] != "todos")  $where_ .= " AND ju.Id_Exposicion  = ".$_POST["exposicion"];



  $accion = $_POST["accion"];
  switch ($accion) {
    case 'anios':
        $consulta="SELECT pe.Periodo AS Anio
                      FROM c_juridico ju
                      LEFT JOIN c_periodo pe on pe.Id_Periodo=ju.Id_periodo
                      GROUP by pe.Periodo desc";
      break;
    case 'ejes':
        $consulta="SELECT idEje,Nombre FROM c_eje";
      break;
    case 'areas':
        $consulta="SELECT Id_Area,Nombre FROM c_area WHERE estatus = 1";
      break;
    case 'totales':
        $consulta=" SELECT COUNT(*) as total FROM c_juridico ju  $join_periodo where 1 $where_ ";
      break;
    case 'por_eje':
        $consulta="SELECT ej.idEje AS id_eje, concat(ej.idEje, '. ', ej.Nombre) AS nombre_eje,
                            (SELECT COUNT(*) FROM c_juridico ju $join_periodo
                            WHERE  ju.Id_eje=ej.idEje $where_ ) AS total
                            FROM c_eje ej

                            ORDER BY ej.idEje";
      break;
    case 'por_area':
        $consulta="SELECT   ar.Nombre AS nombre_area,
                            (SELECT COUNT(*) FROM c_juridico ju $join_periodo
                            WHERE  ju.IdArea = ar.Id_Area $where_ ) AS total
                            FROM c_area ar
                            WHERE ar.estatus = 1
                            ORDER BY ar.Id_Area";
      break;
    case 'por_anio':
        $consulta="SELECT
                      if (ISNULL(pe.Periodo),'Sin información', pe.Periodo) AS Anio,
                      COUNT(*) AS total
                      FROM c_juridico ju
                      LEFT JOIN c_periodo pe on pe.Id_Periodo=ju.Id_periodo
                      WHERE 1 $where_
                      GROUP by pe.Periodo desc";
      break;
    case 'por_expo':
        $consulta="SELECT
                      if (ISNULL(et.tituloFinal),'Sin información', et.tituloFinal) AS ExpoTemp,
                      COUNT(*) AS total
                      FROM c_juridico ju
                      LEFT JOIN c_exposicionTemporal et ON et.idExposicion=ju.Id_Exposicion
                      LEFT JOIN c_periodo pe ON pe.Id_Periodo=ju.Id_periodo
                      WHERE 1 $where_
                      GROUP by ju.Id_Exposicion
                      ORDER BY total desc";
      break;
    case 'expos':
        if($_POST["fecha"] == "todos")$where = "";
        else $where = "WHERE YEAR(e.fechaInicio)= ".$_POST["fecha"];
        $consulta="SELECT e.idExposicion,CONCAT('(',e.anio,')-',e.tituloFinal) tituloFinal
         FROM c_exposicionTemporal as e  $where  ORDER BY e.anio desc";
      break;
    default:
      // code...
      break;
  }
	$rows=array();
	$result = $catalogo->obtenerLista($consulta);
	while ($row = mysqli_fetch_array($result)) {
	   $rows[]=$row;
  }

	echo json_encode($rows);

?>
