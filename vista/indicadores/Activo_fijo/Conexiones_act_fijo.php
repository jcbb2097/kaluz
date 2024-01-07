<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$where_ = "";
if(isset($_POST["fecha"]))
  if($_POST["fecha"] != "todos"){
    $where_ .= " AND pe.Periodo = ".$_POST["fecha"];
  }
if(isset($_POST["eje_filtro"]))
  if($_POST["eje_filtro"] != "todos")  $where_ .= " AND k_ar.id_proyecto  = ".$_POST["eje_filtro"];
if(isset($_POST["area_filtro"]))
  if($_POST["area_filtro"] != "todos")  $where_ .= " AND t.id_area  = ".$_POST["area_filtro"];
if(isset($_POST["exposicion"]))
  if($_POST["exposicion"] != "todos")  $where_ .= " AND k_ar.id_exposicion  = ".$_POST["exposicion"];

  $accion = $_POST["accion"];
  switch ($accion) {
    case 'anios':
        $consulta="SELECT pe.Periodo AS Anio
                      FROM c_documento t
                      LEFT JOIN c_periodo pe ON pe.Id_Periodo = t.Anio
                      where t.id_tipo $tipo_archivos
                      GROUP by pe.Periodo desc";
      break;
    case 'ejes':
        $consulta = "SELECT idEje,Nombre FROM c_eje";
      break;
    case 'areas':
        $consulta ="SELECT Id_Area,Nombre FROM c_area WHERE estatus = 1";
      break;
    case 'totales':
        $consulta = " SELECT COUNT(actf.IdActivoFijo) total FROM c_activofijotemporal as actf";
      break;
    case 'por_eje':
        $consulta = " SELECT ej.idEje AS id_eje, concat(ej.idEje, '. ', ej.Nombre) AS nombre_eje,
                            (SELECT COUNT(actf.IdActivoFijo) FROM c_activofijotemporal as actf
                              WHERE actf.IdEje=ej.IdEje) AS total
                            FROM c_eje ej
                            ORDER BY ej.idEje ";
      break;
    case 'por_area':
        $consulta = "SELECT   ar.Nombre AS nombre_area,
                            (SELECT COUNT(actf.IdActivoFijo) FROM c_activofijotemporal as actf
									           WHERE actf.IdArea=ar.Id_Area) AS total
                            FROM c_area ar
                            WHERE ar.estatus = 1
                            ORDER BY ar.Id_Area";
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
