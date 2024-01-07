<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/PVP.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['contenido']) && $_POST['contenido'] != "") {
    $Ideje= $_POST['eje'];
    $nivel= $_POST['nivel'];
    $where=" WHERE kaa.IdEje = $Ideje";
    $numeracion = $_POST['numeracion'];
     if(isset($_POST['numeracion']) && $numeracion =! 0){
        //echo $_POST['numeracion'];
        $where.= " and act.Numeracion like'%".$_POST['numeracion']."%'";
    }
         $consulta = "SELECT eje.nombre, kaa.IdEje, kaa.IdActividad, nam.IdNivel, act.Nombre as act_n, act.Numeracion
                FROM
                k_aplicacionesActividades AS kaa
                INNER JOIN c_eje AS eje ON kaa.IdEje = eje.idEje 
                INNER JOIN c_actividad as act ON kaa.IdActividad= act.IdActividad
                INNER JOIN c_nivelActividadMeta as nam ON nam.IdNivel = act.IdNivelActividad $where and nam.IdNivel = $nivel order by IdNivel ";
    $resultConsulta = $catalogo->obtenerLista($consulta);
 
    while ($row = mysqli_fetch_array($resultConsulta)) {
        //$nivel2 = $nivel+1;
        $IdActividad= $row['IdActividad']; 
        $num_act= $row['act_n'];
        $numero_nivel= $row['IdNivel'];
        $numero_nivel2= $numero_nivel+1;
        $numero =$row['Numeracion'];
         //cambiarContenido('#ContenidosMenuGeneral','alta_definirContenidos2.php?accion=a&id_act=<?php echo $IdActividadecho''); 
        echo "<div data-toggle=\"tooltip\" title=\" ".$num_act." \" data-placement=\"bottom\" class=\"menuact col-md-1 col-sm-1 col-xs-1 mov bac plan\" id=\"planPub\" onclick=\"cambiarColorMenuActividades('planPub','lvl2','lvl2'); submenus('#ContenidosMenu','".$Ideje."', '".$numero_nivel2."','".$IdActividad."','".$numero."');\">";
        echo  '<input type="hidden" name="id_act'.$nivel.'" id="id_act'.$nivel.'" value="'.$IdActividad.'">';
        echo'  <p style="margin-left: -10px;" class="pnum">'.$numero.'</p>';
        echo " <p style='margin-left: -10px;' class='ptit mova' >".$num_act."</p>";
        echo ' <input type="hidden" id="num_eracion'.$nivel.'" name="num_eracion'.$nivel.'" value="'.$numero.'">';
        echo '  </div>';
         $nivel++;
       
    }
}
elseif (isset($_POST['contenidos']) && $_POST['contenidos'] != "") {
        $contador= $_POST['actividad']-1;
        $Ideje= $_POST['eje'];
        $nivel= $_POST['nivel'];
        $inicio = 1;
        $numeracion = 0;
        $numero=0;
        while($contador > $inicio ){
           
            $where=" WHERE kaa.IdEje = $Ideje";
                //echo $numeracion;
             if($numeracion == 0){
                $numeracion=$Ideje;
                //echo $_POST['numeracion'];
                $where.= " and act.Numeracion like'%".$numeracion."%'";
            }else{
                 $where.= " and act.Numeracion like'%".$numeracion."%'";
            }

              $consulta = "SELECT eje.nombre, kaa.IdEje, kaa.IdActividad, nam.IdNivel, act.Nombre as act_n, act.Numeracion
                        FROM
                        k_aplicacionesActividades AS kaa
                        INNER JOIN c_eje AS eje ON kaa.IdEje = eje.idEje 
                        INNER JOIN c_actividad as act ON kaa.IdActividad= act.IdActividad
                        INNER JOIN c_nivelActividadMeta as nam ON nam.IdNivel = act.IdNivelActividad $where and nam.IdNivel = $nivel order by IdNivel ";
                      // echo $consulta."<br>";
            $resultConsulta = $catalogo->obtenerLista($consulta);
         echo ' <div id="lvl'.$nivel.'" class="row dmenuact" style="margin-top:5px;border-bottom: 0px;">';
            while ($row = mysqli_fetch_array($resultConsulta)) {
                //$nivel2 = $nivel+1;
                $IdActividad= $row['IdActividad']; 
                $num_act= $row['act_n'];
                $numero_nivel= $row['IdNivel'];
                $numero_nivel2= $numero_nivel+1;
                 $numero =$row['Numeracion'];
                 //cambiarContenido('#ContenidosMenuGeneral','alta_definirContenidos2.php?accion=a&id_act=<?php echo $IdActividadecho''); 
                echo "<div data-toggle=\"tooltip\" title=\" ".$num_act." \" data-placement=\"bottom\" class=\"menuact col-md-1 col-sm-1 col-xs-1 mov bac plan\" id=\"planPub\" onclick=\"cambiarColorMenuActividades('planPub','lvl2','lvl2'); submenus('#ContenidosMenu','".$Ideje."', '".$numero_nivel2."','".$IdActividad."','".$numero."');\">";
                echo  '<input type="hidden" name="id_act'.$nivel.'" id="id_act'.$nivel.'" value="'.$IdActividad.'">';
                echo'  <p style="margin-left: -10px;" class="pnum">'.$numero.'</p>';
                echo " <p style='margin-left: -10px;' class='ptit mova' >".$num_act."</p>";
                echo ' <input type="hidden" id="num_eracion'.$nivel.'" name="num_eracion'.$nivel.'" value="'.$numero.'">';
                echo '  </div>';
                
               $numeracion=$numero;
            }
            echo '</div>';
             $nivel++;
            $inicio++;
        }
}
?>