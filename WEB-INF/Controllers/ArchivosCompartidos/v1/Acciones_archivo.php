<?php
include_once("../../Classes/Catalogo.class.php");

$catalogo = new Catalogo();
if (isset($_POST['Eje']) && $_POST['Eje'] != "") {
  $Eje=$_POST['Eje'];
  $Tipo=$_POST['tipo'];
  $Periodo=$_POST['Periodo'];
  $consulta_actividad="SELECT a.IdActividad,a.Nombre FROM c_actividad as a 
  INNER JOIN c_periodo as p on a.Anio=p.Periodo
  WHERE a.IdEje=$Eje AND p.Id_Periodo=$Periodo AND a.IdTipoActividad=$Tipo AND IdNivelActividad=1";
  $s = "";
  $contador = 1;
  $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $contador . "." . " " . $row['Nombre'] . '</option>';
        $contador++;
    }

}else if (isset($_POST['General']) && $_POST['General'] != "") {
    $actividad = $_POST['actividad2'];
    $texto = $_POST['text'];
    $men = explode(" ", $texto);
    $contador = 1;
    $s = "";
    $consultaactividads = "SELECT a.IdActividad, a.Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad";

    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $men[0] . $contador . " " . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['Particular']) && $_POST['Particular'] != "") {
    $actividad = $_POST['actividad3'];
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultaactividads = "SELECT a.IdActividad, a.Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad";
    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $men[0] . "." . $contador . " " . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['SubActividad']) && $_POST['SubActividad'] != "") {
    $actividad = $_POST['actividad5'];
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultaactividads = "SELECT a.IdActividad, a.Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad";
    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $men[0] . "." . $contador . " " . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
    $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
                                            $resultado = $catalogo->obtenerLista($consultagiro);
                                            echo '<option value = "">Seleccione una opción</option>';
                                            while ($row = mysqli_fetch_array($resultado)) {
                                                $s = '';
                                                echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                            }


}else if (isset($_POST['expo']) && $_POST['expo'] != "") {
    $Periodo = $_POST['Periodo'];
    $consultaperiodo6 = "SELECT
    e.idExposicion,
    e.tituloFinal,
    p.Periodo
    FROM
    c_exposicionTemporal AS e
    INNER JOIN c_periodo AS p ON e.anio = p.Periodo
    WHERE p.Id_Periodo=$Periodo
    ORDER BY
    e.tituloFinal ASC";
    echo$consultaperiodo6;
    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
    echo '<option value = "">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado6)) {
        $s = '';
        echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
    }
}