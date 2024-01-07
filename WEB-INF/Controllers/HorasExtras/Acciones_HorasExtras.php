<?php
include_once("../../Classes/Catalogo.class.php");
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
$catalogo = new Catalogo();
if (isset($_POST['Eje']) && $_POST['Eje'] != "") {
  $Eje=$_POST['Eje'];
  $Periodo=$_POST['Periodo'];
  $consulta_actividad="SELECT a.IdActividad,CONCAT(a.Numeracion,' ',a.Nombre,if(IdTipoActividad = 2,' (Meta)','')) Nombre FROM c_actividad as a
  INNER JOIN c_periodo as p on a.Anio=p.Periodo
  WHERE a.IdEje=$Eje AND p.Id_Periodo=$Periodo  AND IdNivelActividad=1";
  $contador = 1;
  $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">' . " " . $row['Nombre'] . '</option>';
        $contador++;
    }

}else if (isset($_POST['General']) && $_POST['General'] != "") {
    $actividad = $_POST['actividad2'];
    $texto = $_POST['text'];
    $men = explode(" ", $texto);
    $contador = 1;
    $consultaactividads = "SELECT a.IdActividad, CONCAT(a.Numeracion,' ',a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad";

    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '">'  . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['Particular']) && $_POST['Particular'] != "") {
    $actividad = $_POST['actividad3'];
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultaactividads = "SELECT a.IdActividad, CONCAT(a.Numeracion,' ',a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad";
    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" >' . " " . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['SubActividad']) && $_POST['SubActividad'] != "") {
    $actividad = $_POST['actividad5'];
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultaactividads = "SELECT a.IdActividad, CONCAT(a.Numeracion,' ',a.Nombre) Nombre FROM c_actividad as a WHERE a.IdActividadSuperior=$actividad";
    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>'. " " . $row['Nombre'] . '</option>';
        $contador++;
    }
}else if (isset($_POST['persona']) && $_POST['persona'] != "") {
    $persona = $_POST['persona'];
    $consultaperiodo6 = "SELECT a.Id_Area,a.Nombre FROM c_personas as p
    INNER JOIN c_area as a on a.Id_Area=p.idArea
    WHERE p.Id_Personas = $persona";
    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
    echo '<option value = "">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado6)) {
        $s = '';
        echo '<option value = "' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
    }


}else if(isset($_POST['ejes']) && $_POST['ejes'] != ""){

  $consultaperiodo6 = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
  $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
  echo '<option value = "">Seleccione una opción</option>';
  while ($row = mysqli_fetch_array($resultado6)) {
      echo '<option value = "' . $row['idEje'] . '" >'.$row['idEje'] .'. '.  $row['Nombre'] . '</option>';
  }
}
