<?php
include_once("../../Classes/Catalogo.class.php");

$catalogo = new Catalogo();

if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "usuario") {
    $area = $_POST['area'];
    //aqui buscamos en base de datos las personas que pertenezcan a esa area
    $consulta_usuario = "SELECT u.IdUsuario,p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno) nombre FROM c_area a INNER JOIN c_personas p on p.idArea=a.Id_Area INNER JOIN c_usuario u on u.IdPersona=p.id_Personas WHERE u.Activo=1 AND a.Id_Area=$area ORDER BY p.Nombre";
    $resul = $catalogo->obtenerLista($consulta_usuario);
    echo ' <option value="0">Seleccione un usuario</option>';
    while ($row = mysqli_fetch_array($resul)) {
        $selected = "";
        echo "<option value='" . $row['id_Personas'] . "' " . $selected . ">" . $row['nombre'] . "</option>";
    }
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "area_persona") {
    $persona = $_POST['persona'];
    $rows = array();
    //aqui buscamos en base de datos el area de la persona
    $consulta_usuario = "SELECT a.Nombre,a.Id_Area FROM c_area a INNER JOIN c_personas p on p.idArea=a.Id_Area  WHERE  p.id_Personas = $persona ORDER BY p.Nombre";
    $resul = $catalogo->obtenerLista($consulta_usuario);
    while ($row = mysqli_fetch_array($resul)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "categoria") {
    $eje = $_POST['eje'];
	$periodo = $_POST['periodo'];

    $consulta_usuario = "SELECT cate.idCategoria,cate.descCategoria FROM c_categoriasdeejes cate WHERE cate.idEje = $eje AND cate.anio= $periodo and cate.nivelCategoria = 1 ORDER BY cate.orden";
    $bandera = 0;
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
      if($bandera == 0)
          echo ' <option value="0">Seleccione una categoria</option>';
          $bandera = 1;
        echo "<option value='" . $row['idCategoria'] . "' >" . $row['descCategoria'] . "</option>";
    }
    if($bandera == 0)
      echo ' <option value="0">Sin categoria</option>';
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "SubCategoría") {
    $categoria = $_POST['cat'];

    $consulta_usuario = "SELECT cate.idCategoria,cate.descCategoria FROM c_categoriasdeejes cate WHERE cate.idCategoriaPadre = $categoria  ORDER BY cate.orden";
    $bandera = 0;
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
      if($bandera == 0)
          echo ' <option value="0">Seleccione una subcategoria</option>';
       $bandera = 1;
        echo "<option value='" . $row['idCategoria'] . "' >" . $row['descCategoria'] . "</option>";
    }
    if($bandera == 0)
      echo ' <option value="0">Sin subcategoria</option>';
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "act_cat") {
    $categoria = $_POST['cat'];
    $actmet = $_POST['actmet'];

    $consulta_usuario = "SELECT act.IdActividad,CONCAT(act.Numeracion ,' ',act.Nombre) AS nombre
FROM c_actividad act
JOIN k_actividad_categoria cat ON cat.IdActividad = act.IdActividad
 WHERE cat.IdCategoria = $categoria AND act.IdTipoActividad = $actmet and act.IdNivelActividad = 1
 GROUP BY cat.IdActividad
 ORDER BY act.Orden";//AND act.IdTipoActividad = 1
 $bandera = 0;
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
      if($bandera == 0)
        echo ' <option value="0">Seleccione una Actividad global</option>';
        $bandera = 1;
        echo "<option value='" . $row['IdActividad'] . "' >" . $row['nombre'] . "</option>";
    }
    if($bandera == 0)
      echo ' <option value="0">Sin actividad global</option>';
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "act_subcat") {
    $subcat = $_POST['subcat'];
    $actmet = $_POST['actmet'];

    $consulta_usuario = "SELECT act.IdActividad,CONCAT(act.Numeracion ,' ',act.Nombre) AS nombre
FROM c_actividad act
JOIN k_actividad_categoria cat ON cat.IdActividad = act.IdActividad
 WHERE cat.IdCategoria = $subcat AND act.IdTipoActividad = $actmet and act.IdNivelActividad = 1
 GROUP BY cat.IdActividad
 ORDER BY act.Orden";
 $bandera = 0;
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
      if($bandera == 0)
        echo ' <option value="0">Seleccione una Actividad global</option>';
      $bandera = 1;
        echo "<option value='" . $row['IdActividad'] . "' >" . $row['nombre'] . "</option>";
    }
    if($bandera == 0)
      echo ' <option value="0">Sin actividad global</option>';
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "general") {
    $aGlobal = $_POST['aGlobal'];

    $consulta_usuario = "SELECT act.IdActividad,CONCAT(act.Numeracion ,' ',act.Nombre) AS nombre
FROM c_actividad act
 WHERE act.IdActividadSuperior = $aGlobal
 ORDER BY act.Orden";
 $bandera = 0;
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
      if($bandera == 0)
        echo ' <option value="0">Seleccione una actividad general</option>';
      $bandera = 1;
        echo "<option value='" . $row['IdActividad'] . "' >" . $row['nombre'] . "</option>";
    }
    if($bandera == 0)
      echo ' <option value="0">Sin Actividad general</option>';
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "check") {
    $act = $_POST['act'];
    $cate = $_POST['cate'];


    $consulta_usuario = "SELECT ch.IdCheckList,if(ISNULL(kch.Nombre_alterno),ch.Nombre,kch.Nombre_alterno) as Nombre
FROM c_checkList ch
JOIN k_checklist_actividad kch ON kch.IdCheckList = ch.IdCheckList
 WHERE kch.IdActividad = $act AND (ch.Nivel = 1 OR ch.Nivel = 3) AND kch.IdCategoria = $cate
GROUP BY kch.IdCheckList
 ORDER BY ch.Orden";
 $bandera = 0;
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
        if($bandera == 0)
          echo ' <option value="0">Seleccione un checklist</option>';
        $bandera = 1;
        echo "<option value='" . $row['IdCheckList'] . "' >" . $row['Nombre'] . "</option>";

        $consulta_subcheck = "SELECT ch.IdCheckList,if(ISNULL(kch.Nombre_alterno),ch.Nombre,kch.Nombre_alterno) as Nombre
    FROM c_checkList ch
    JOIN k_checklist_actividad kch ON kch.IdCheckList = ch.IdCheckList AND kch.IdActividad = $act  AND kch.IdCategoria = $cate
     WHERE ch.IdCheckListPadre = ".$row['IdCheckList']." AND ch.Nivel = 2
     GROUP BY kch.IdCheckList
     ORDER BY ch.Orden";
        $resul_s = $catalogo->obtenerLista($consulta_subcheck);

        while ($row_s = mysqli_fetch_array($resul_s)){
          echo "<option value='" . $row_s['IdCheckList'] . "' > -- " . $row_s['Nombre'] . "</option>";
        }




    }
    if($bandera == 0)
      echo ' <option value="0">Sin checklist </option>';
}
if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] == "check_info") { // sacar el responsable de check_act
    $check = $_POST['check'];
    $act = $_POST['act'];
    $cate = $_POST['cate'];
    $rows = array();

    $consulta_usuario = "SELECT ch.IdCheckList,if(ISNULL(kchac.Nombre_alterno),ch.Nombre,kchac.Nombre_alterno) as Nombre, if(ISNULL(kchac.IdEncargado),ch.IdResponsable,kchac.IdEncargado) AS id_Personas ,
if(ISNULL(kchac.IdEncargado),p1.idArea,p.idArea) AS idArea,
if(ISNULL(kchac.IdEncargado),SUBSTRING(ca1.Nombre, 1, 2),SUBSTRING(ca.Nombre, 1, 2)) AS area_rec,
if(ISNULL(kchac.IdEncargado),CONCAT(SUBSTRING(p1.Nombre, 1, 1),' ',p1.Apellido_Paterno),CONCAT(SUBSTRING(p.Nombre, 1, 1),' ',p.Apellido_Paterno)) AS nombrepersona

FROM c_checkList ch


left JOIN k_checklist_actividad kchac ON kchac.IdCheckList = ch.IdCheckList AND kchac.IdActividad = $act  AND kchac.IdCategoria = $cate

left JOIN c_personas p ON p.id_Personas = kchac.IdEncargado
left JOIN c_area ca ON ca.Id_Area = p.idArea
left JOIN c_personas p1 ON p1.id_Personas = ch.IdResponsable
left JOIN c_area ca1 ON ca1.Id_Area = p1.idArea

 WHERE ch.IdCheckList = $check
 ORDER BY ch.Orden ";
    $resul = $catalogo->obtenerLista($consulta_usuario);

    while ($row = mysqli_fetch_array($resul)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
}
