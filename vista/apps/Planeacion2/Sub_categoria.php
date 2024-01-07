<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('Classes/Planeacion.class.php');
include_once('Classes/Check.class.php');
$catalogo = new Catalogo();
$cate = new Planeacion();
$ch = new Check();
$nombre = "";
$entregables = 0;
$actividades_global = 0;
$actividades_general = 0;
$avance = 0;
$Id_Categoria = $_POST["Id_Categoria"];
$id_usuario = $_POST['Id_usuario'];
$Id_persona = "";
$Perfil = $_POST['Perfil'];
$AC_ME = $_POST["ACME"];
$Periodo = $_POST["Periodo"];
$Nombreeje = '"' . $_POST["Nombreeje"] . '"';
$ano = $_POST["ano"];
$checkeck = $_POST["check"];
$filtro = $_POST["filtro"];
$ac = $_POST["Id_actividad"];
$persona = "";
$area = "";
if (isset($_POST['persona']) && $_POST['persona'] != "") {
    $persona = $_POST["persona"];
}
if (isset($_POST['area']) && $_POST['area'] != "") {
    $area = $_POST["area"];
}
$where_ver = "";
if ($checkeck == '0' && $_POST['vista'] == 'subcategoria') {
    $where_ver = "AND cea.Visible=1";
} elseif ($checkeck == '0' && $_POST['vista'] != 'subcategoria') {
    $where_ver = "AND ca.Activo=1";
}
if($checkeck == 1){
  $visibilidad_acts = 0;//si trae check en 1 es para que se vean todas y por lo tanto no se pone el where de activo en el query
}else{
  $visibilidad_acts = 1;//si si trae 0 en check es normal y no salen los que estan ocultos
}

$check = 0;

$consulta_persona = "SELECT u.IdPersona,p.Nombre FROM c_usuario u INNER JOIN c_personas p on p.id_Personas=u.IdPersona WHERE u.IdUsuario=$id_usuario";
$resul_p = $catalogo->obtenerLista($consulta_persona);
while ($row3 = mysqli_fetch_array($resul_p)) {
    $Id_persona = $row3['IdPersona'];
}



if (isset($_POST['vista']) && $_POST['vista'] != "") {
    switch ($_POST['vista']) {
        case 'subcategoria':
            $query_lista = "SELECT
            ce.idCategoria,if(isnull(cea.Nombre_alterno),ce.descCategoria,cea.Nombre_alterno) descCategoria,cea.Visible
            FROM
            c_categoriasdeejes ce
            INNER JOIN k_categoriasdeejes_anios cea on cea.idCategoria=ce.idCategoria
            INNER JOIN c_periodo p on p.Periodo=cea.Anio
            WHERE ce.idCategoriaPadre=$Id_Categoria $where_ver AND p.Id_Periodo=$Periodo AND cea.ACME=$AC_ME
            ORDER BY ce.orden";
            //echo$query_lista;
            $resul_Ac = $catalogo->obtenerLista($query_lista);
            while ($row = mysqli_fetch_array($resul_Ac)) {
                $stylo = '23px';
                $nombre = $row['descCategoria'];
                if ($row['Visible'] == 1) {
                    $color = "rgb(77,232,254)";
                    $onclick2 = "onclick='De_ativate_subcate(" . $row['idCategoria'] . ",2," . $Perfil . "," . $Periodo . "," . $ano . "," . $AC_ME . ")'";
                } else {
                    $color = "grey;";
                    $onclick2 = "onclick='De_ativate_subcate(" . $row['idCategoria'] . ",1," . $Perfil . "," . $Periodo . "," . $ano . "," . $AC_ME . ")'";
                }
                $actividades_global = $cate->Actividades_planeacion($row['idCategoria'], $AC_ME, 1, $Periodo,$visibilidad_acts);
                $actividades_general = $cate->Actividades_planeacion($row['idCategoria'], $AC_ME, 2, $Periodo,$visibilidad_acts);
                $entregables = $cate->Entregables_categoria_planeacion($row['idCategoria'], $AC_ME, $Periodo, $ano, $persona, $area);
                $avance = $entregables[2];
                if ($avance >= 1 && $avance <= 25) {
                    $colorac = "-in";
                } elseif ($avance >= 26 && $avance <= 99) {
                    $colorac = "-pr";
                } elseif ($avance == 100) {
                    $colorac = "-fn";
                }
                $onclickNew = "onclick='alta_check(" . $Id_Categoria . "," . $row['idCategoria'] . ",0,0);'";


?>
                <tr id='row_<?php echo $row['idCategoria']; ?>' onclick='Muestra_Sub_categoria(<?php echo $row["idCategoria"]; ?>,<?php echo $AC_ME; ?>,<?php echo $Periodo; ?>,<?php echo $Nombreeje ?>,<?php echo $ano ?>,"actividad_global",0,<?php echo $filtro ?>,<?php echo $persona ?>);ocultar_mostrar2(<?php echo $row["idCategoria"]; ?>);' data-id="<?php echo $Id_Categoria; ?>" class="hija <?php echo $Id_Categoria; ?>" style='background-color:  <?php echo $color; ?>;'>
                    <?php if ($actividades_global > 0) { ?>
                        <td class="publicacion"><span style="width: <?php echo $stylo; ?>;"></span><span><?php echo strtoupper($nombre); ?></span> </span> <span class="toggle-icon"><i id="left_<?php echo $row['idCategoria']; ?>" class="fas fa-chevron-left" style="margin-top: 2px;"></i><i id="down_<?php echo $row['idCategoria']; ?>" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                    <?php } else { ?>
                        <td class="publicacion"><span style="width: <?php echo $stylo; ?>;"></span><span><?php echo strtoupper($nombre); ?></span> </span> <span class="toggle-icon"><i id="" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                    <?php  } ?>
                    <td class="vobo"><?php echo $actividades_global; ?></td>
                    <td class="vobo"><?php echo $actividades_general; ?></td>
                    <td class="vobo"><?php echo $entregables[1]; ?> / <?php echo $entregables[0]; ?></td>
                    <td class="avance">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px;top: 5px;">
                            <div class="progress" style="width: 100px;">
                                <div class="progress-bar progress-bar<?php echo$colorac?> progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avance ?>%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 32px;">
                            <div>
                                <p><?php echo round($avance, 1); ?>%</p>
                            </div>
                        </div>
                    </td>
                    <td class="opciones">
                        <?php if ($row['Visible'] == 1) { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php   } else { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye-slash"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php   } ?>
                        <!--          <figure class="jsx-3352531170 medium" style="margin-right: 12px;" <?php echo $onclickNew ?>><i class="fas fa-plus-circle"></i></figure>
 -->
                    </td>
                </tr>
            <?php $avance = 0;
            }

            break;
        case 'actividad_global':
            $query_lista = "SELECT
            a.IdActividad,
	CONCAT( ca.Numeracion, if(isnull(ca.Nombre_alterno),a.Nombre,ca.Nombre_alterno)) actividad,
	ce.idCategoria,
	ce.idCategoriaPadre,
	a.IdActividadSuperior,
	a.IdResponsable,ca.Activo as Visible
        FROM
            c_actividad a
            INNER JOIN k_actividad_categoria ca ON ca.IdActividad = a.IdActividad
            INNER JOIN c_categoriasdeejes ce ON ce.idCategoria = ca.idCategoria
        WHERE
            ca.IdPeriodo = $Periodo $where_ver
            AND a.IdNivelActividad = 1 AND a.IdTipoActividad = $AC_ME
            AND ca.idCategoria IN ($Id_Categoria)
            ORDER BY ca.Orden";
            //echo $query_lista;
            $resul_Ac = $catalogo->obtenerLista($query_lista);
            $subcategoria = 0;
            $avance = 0;
            while ($row = mysqli_fetch_array($resul_Ac)) {
                if ($row['idCategoriaPadre'] > 0) {
                    $Id_cate = $row['idCategoriaPadre'];
                    $subcategoria = $row['idCategoria'];
                    $categoria = $row['idCategoriaPadre'];
                } else {
                    $categoria = $row['idCategoria'];
                    $Id_cate = $row['idCategoria'];
                }
                $nombre = $row['actividad'];
                $id_responsable = $row['IdResponsable'];
                $stylo = '33px';
                $General = $cate->actividad_general_planeacion($row['IdActividad'], $AC_ME, $ano);
                $entregables = $cate->Entregables_actividad_planeacion($row['idCategoria'], $AC_ME, $Periodo, $ano, $row['IdActividad'], $persona, $area);
                $check = $ch->get_checks($row['IdActividad'], $Periodo, $row['idCategoria']);
                $avance = $entregables[2];
                if ($avance >= 1 && $avance <= 25) {
                    $colorac = "-in";
                } elseif ($avance >= 26 && $avance <= 99) {
                    $colorac = "-pr";
                } elseif ($avance == 100) {
                    $colorac = "-fn";
                }
                if($Id_persona == ''){
                  $Id_persona = 0;
                }
                if ($row['Visible'] == 1) {
                    $color = "rgb(148,241,254)";
                    $onclick2 = "onclick='actividad(2," . $row['IdActividad'] . ",$AC_ME,$id_responsable,$Id_persona,$Perfil,$Periodo,$ano," . $row['idCategoria'] . ")'";
                } else {
                    $color = "grey;";
                    $onclick2 = "onclick='actividad(1," . $row['IdActividad'] . ",$AC_ME,$id_responsable,$Id_persona,$Perfil,$Periodo,$ano," . $row['idCategoria'] . ")'";
                }
                $onclick = "onclick='plan(" . $row['IdActividad'] . "," . $categoria . "," . $subcategoria . "," . $AC_ME . "," . $Periodo . "," . $Nombreeje . "," . $ano . ",0," . $checkeck . "," . $filtro . ");'";
                $onclickNew = "onclick='alta_check(" . $categoria . "," . $subcategoria . "," . $row['IdActividad'] . ",0);'";

            ?>
                <tr id='row_<?php echo $row['IdActividad']; ?>_<?php echo $row["idCategoria"]; ?>' onclick='Muestra_Sub_categoria2(<?php echo $row["IdActividad"]; ?>,<?php echo $AC_ME; ?>,<?php echo $Periodo; ?>,<?php echo $Nombreeje ?>,<?php echo $ano ?>,"actividad_general",<?php echo $row["idCategoria"]; ?>,<?php echo $filtro ?>,<?php echo $persona ?>);ocultar_mostrar2(<?php echo $row["IdActividad"]; ?>);' data-id="<?php echo $Id_Categoria; ?>" data-cate="<?php echo $categoria; ?>" data-subcate="<?php echo $subcategoria; ?>" class="hija <?php echo $Id_Categoria; ?>" style='background-color:  <?php echo $color; ?>;'>
                    <?php if ($General > 0) { ?>
                        <td class="publicacion"><span style="width: <?php echo $stylo; ?>;"></span><span><?php echo $nombre; ?></span> </span> <span class="toggle-icon"><i id="left_<?php echo $row['IdActividad']; ?>" class="fas fa-chevron-left" style="margin-top: 2px;"></i><i id="down_<?php echo $row['IdActividad']; ?>" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                    <?php } else { ?>
                        <td class="publicacion"><span style="width: <?php echo $stylo; ?>;"></span><span><?php echo $nombre; ?></span> </span> <span class="toggle-icon"><i id="" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                    <?php  } ?>
                    <td class="vobo">1</td>
                    <td class="vobo"><?php echo $General ?></td>
                    <td class="vobo"> <?php echo $entregables[1] ?> / <?php echo  $entregables[0] ?></td>
                    <td class="avance">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px;top: 5px;">
                            <div class="progress" style="width: 100px;">
                                <div class="progress-bar progress-bar<?php echo$colorac?> progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avance ?>%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 32px;">
                            <div>
                                <p><?php echo round($avance, 1); ?>%</p>
                            </div>
                        </div>
                    </td>
                    <td class="opciones">
                        <?php if ($check != 0) { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 12px;" <?php echo $onclick; ?>><i class="far fa-edit"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php  } else { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 12px;" <?php echo $onclickNew ?>><i class="fas fa-plus-circle"></i></figure>
                        <?php } ?>
                        <?php if ($row['Visible'] == 1) { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php   } else { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye-slash"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php   } ?>
                    </td>
                </tr>
            <?php
                $avance = 0;
            }
            break;
        case 'actividad_general':
            $query_lista = "SELECT
            	a.IdActividad,
	CONCAT( ca.Numeracion, a.Nombre ) actividad,
	ce.idCategoria,
	ce.idCategoriaPadre,
	ca.Activo as Visible,
	a.IdActividadSuperior,
	a.IdResponsable
        FROM
            c_actividad a
            INNER JOIN k_actividad_categoria ca ON ca.IdActividad = a.IdActividad
            INNER JOIN c_categoriasdeejes ce ON ce.idCategoria = ca.idCategoria
        WHERE
            ca.IdPeriodo = $Periodo $where_ver
            AND a.IdNivelActividad = 2 AND a.IdTipoActividad = $AC_ME AND a.IdActividadSuperior=$Id_Categoria
            AND ca.idCategoria IN ($ac)
            ORDER BY ca.Orden";
            //echo$query_lista;
            $resul_Ac = $catalogo->obtenerLista($query_lista);
            $avance = 0;
            $subcategoria = 0;
            while ($row = mysqli_fetch_array($resul_Ac)) {
                $nombre = $row['actividad'];
                $id_responsable = $row['IdResponsable'];
                $actividad_superior = $row['IdActividadSuperior'];

                $entregables = $cate->Entregables_actividad_planeacion($row['idCategoria'], $AC_ME, $Periodo, $ano, $row['IdActividad'], $persona, $area);
                $check = $ch->get_checks($row['IdActividad'], $Periodo, $row['idCategoria']);
                $avance = $entregables[2];
                if ($avance >= 1 && $avance <= 25) {
                    $colorac = "-in";
                } elseif ($avance >= 26 && $avance <= 99) {
                    $colorac = "-pr";
                } elseif ($avance == 100) {
                    $colorac = "-fn";
                }
                $onclick_general = "";
                if ($row['Visible'] == 1) {
                    $color = "rgb(214,249,254)";
                    $onclick2 = "onclick='actividad(2," . $row['IdActividad'] . ",$AC_ME,$id_responsable,$Id_persona,$Perfil,$Periodo,$ano," . $row['idCategoria'] . ")'";
                } else {
                    $color = "grey;";
                    $onclick2 = "onclick='actividad(1," . $row['IdActividad'] . ",$AC_ME,$id_responsable,$Id_persona,$Perfil,$Periodo,$ano," . $row['idCategoria'] . ")'";
                }
                if ($row['idCategoriaPadre'] > 0) {
                    $subcategoria = $row['idCategoria'];
                    $categoria = $row['idCategoriaPadre'];
                } else {
                    $categoria = $row['idCategoria'];
                }
                $onclick = "onclick='plan(" . $row['IdActividad'] . "," . $categoria . "," . $subcategoria . "," . $AC_ME . "," . $Periodo . "," . $Nombreeje . "," . $ano . ",$actividad_superior," . $checkeck . "," . $filtro . ");'";
                $onclickNew = "onclick='alta_check(" . $categoria . "," . $subcategoria . "," . $row['IdActividad'] . "," . $actividad_superior . ");'";
                $stylo = '43px';


            ?>
                <tr id='row_<?php echo $row['IdActividad']; ?>_<?php echo $row["idCategoria"]; ?>' data-id="<?php echo $Id_Categoria; ?>" data-cate="<?php echo $categoria; ?>" data-subcate="<?php echo $subcategoria; ?>" class="hija <?php echo $Id_Categoria; ?>" style='background-color:  <?php echo $color; ?>;'>
                    <td class="publicacion"><span style="width: <?php echo $stylo; ?>;"></span><span><?php echo $nombre; ?></span> </span> <span class="toggle-icon"><i id="" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                    <td class="vobo"> </td>
                    <td class="vobo">1</td>
                    <td class="vobo"> <?php echo $entregables[1] ?> / <?php echo  $entregables[0] ?></td>
                    <td class="avance">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px;top: 5px;">
                            <div class="progress" style="width: 100px;">
                                <div class="progress-bar progress-bar<?php echo$colorac?> progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avance ?>%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 32px;">
                            <div>
                                <p><?php echo round($avance, 1); ?>%</p>
                            </div>
                        </div>
                    </td>
                    <td class="opciones">
                        <?php if ($check > 0) { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 12px;" <?php echo $onclick; ?>><i class="far fa-edit"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php  } else { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 12px;" <?php echo $onclickNew ?>><i class="fas fa-plus-circle"></i></figure>
                        <?php } ?>
                        <?php if ($row['Visible'] == 1) { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php   } else { ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye-slash"></i><span class="jsx-3352531170 caption"></span></figure>
                        <?php   } ?>
                    </td>
                </tr>
<?php
                $avance = 0;
            }
            break;
    }
}
