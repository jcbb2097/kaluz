<!DOCTYPE html>
<html lang="es">
<head>
    <title>Actividades</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php
$cadenaTabla="";
$Anio="2020";
$FiltroEje="<20"; //todos los ejes
$FiltroEje="=2"; //Solo un eje

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
$catalogo = new Catalogo();

$sqlTodasLasActiv="
SELECT a.IdActividad,a.Anio,a.IdNivelActividad,
CONCAT(a.IdEje,'.',a.Orden,'. ',a.Nombre) AS DescActividad, 
a.IdEje*100000000+a.orden*1000000 AS peso
FROM c_actividad a 
WHERE a.Anio=".$Anio." and a.IdNivelActividad=1 AND a.IdEje".$FiltroEje."
UNION

SELECT a.IdActividad,a.Anio,a.IdNivelActividad,
CONCAT(a.IdEje,'.',apadre.Orden,'.',a.Orden,'. ',a.Nombre) AS DescActividad, 
a.IdEje*100000000+apadre.Orden*1000000+a.Orden*10000 AS peso
FROM c_actividad a JOIN c_actividad apadre ON a.IdActividadSuperior=apadre.IdActividad 
WHERE a.Anio=".$Anio." and a.IdNivelActividad=2 AND a.IdEje".$FiltroEje."
UNION

SELECT a.IdActividad,a.Anio,a.IdNivelActividad,
CONCAT(a.IdEje,'.',abuelo.Orden,'.',apadre.Orden,'.',a.Orden,'. ',a.Nombre) AS DescActividad, 
a.IdEje*100000000+abuelo.Orden*1000000+apadre.Orden*10000+a.Orden*100 AS peso
FROM c_actividad a 
JOIN c_actividad apadre ON a.IdActividadSuperior=apadre.IdActividad
JOIN c_actividad abuelo ON apadre.IdActividadSuperior=abuelo.IdActividad 
WHERE a.Anio=".$Anio." and a.IdNivelActividad=3 AND a.IdEje".$FiltroEje."
UNION

SELECT a.IdActividad,a.Anio,a.IdNivelActividad,
CONCAT(a.IdEje,'.',tatarabuelo.Orden,'.',abuelo.Orden,'.',apadre.Orden,'.',a.Orden,'. ',a.Nombre) AS DescActividad,
a.IdEje*100000000+tatarabuelo.Orden*1000000+abuelo.Orden*10000+apadre.Orden*100+a.Orden AS peso
FROM c_actividad a 
JOIN c_actividad apadre ON a.IdActividadSuperior=apadre.IdActividad
JOIN c_actividad abuelo ON apadre.IdActividadSuperior=abuelo.IdActividad 
JOIN c_actividad tatarabuelo ON abuelo.IdActividadSuperior=tatarabuelo.IdActividad
WHERE a.Anio=".$Anio." and a.IdNivelActividad=4 AND a.IdEje".$FiltroEje."

ORDER BY 5
"; 

$Num=0; //contador Numero de actividades.

$resultActiv = $catalogo->obtenerLista($sqlTodasLasActiv);
while ($rowAc = mysqli_fetch_array($resultActiv)) {
    $Num=$Num+1;
    $cadenaTabla = $cadenaTabla."<tr><td>".$Num."</td>
                <td>".$rowAc['DescActividad']."</td>
                <td>-</td></tr>";
}
?>

<div class="fluid-container">
    
    <div class="row">
        <h3 style="text-align:center">Actividades <?php echo $Anio;?></h3><br>
    </div>
	
    <div class="row">
        <div class="col-md-12">
            
            <div class="table-responsive">
                <table id="table11" class="table table-bordered table-condensed">
                    <thead style="font-size:11px">
                        <tr>
                        <th>Num</th><th>Actividad</th><th>Otro</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 11px">
                        <?php echo $cadenaTabla; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
	

</div>

</body>

</html>