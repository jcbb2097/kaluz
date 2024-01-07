<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/Institucion2.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Institucion2();
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setNombre($parametros['institucion']);
            // $obj->setLogo($parametros['Logo']);
            /* $obj->foto */
            //$rutaimg = "resources/images/institucion/logo/";
            $rutaimg = "resources/aplicaciones/imagenes/Institucion/logo/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    //echo '2';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg . "(1)" . $archivo;
                } else {

                   // echo '3';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg . $archivo;
                }
               // echo '4';
                $obj->setFoto($nameimg);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setFoto("");
            }

        if (isset($parametros['Pais']) && $parametros['Pais'] != "") {
                $obj->setId_pais($parametros['Pais']);
            } else {
                $obj->setId_pais(0);
            }
            if (isset($parametros['Sector']) && $parametros['Sector'] != "") {
                $obj->setId_sector($parametros['Sector']);
            } else {
                $obj->setId_sector(0);
            }
           if (isset($parametros['Giro']) && $parametros['Giro'] != "") {
                $obj->setId_giro($parametros['Giro']);
            } else {
                $obj->setId_giro(0);
            }
            if (isset($parametros['SubGiro']) && $parametros['SubGiro'] != "") {
                $obj->setId_subgiro($parametros['SubGiro']);
            } else {
                $obj->setId_subgiro(0);
            }
           if(isset($parametros['Sector']) && $parametros['Sector']==2){
              $obj->setId_dependencia("NULL");
           }elseif ($parametros['Sector']==1 && $parametros['Dependencia']!="") {
                  $obj->setId_dependencia($parametros['Dependencia']);  
               
            }else{
                  $obj->setId_dependencia("NULL");
             
           }

            
            $obj->setCalle($parametros['Calle']);

            $obj->setNumeroe($parametros['NumeroE']);

            $obj->setNumeroi($parametros['Numeroi']);

            $obj->setColonia($parametros['Colonia']);

            if(isset($parametros['Estado']) && $parametros['Estado'] != "") {
                $obj->setId_estado($parametros['Estado']);
            } else {
                $obj->setId_estado(0);
            } 
            $obj->setId_ciudad($parametros['Ciudad']);

           if (isset($parametros['alcaldia']) && $parametros['alcaldia'] != "") {
                $obj->setId_Municipio($parametros['alcaldia']);
            } else {
                $obj->setId_Municipio(0);
            } 
          if (isset($parametros['codigopostal']) && $parametros['codigopostal'] != "") {
                $obj->setCodigopostal($parametros['codigopostal']);
            } else {
                $obj->setCodigopostal("NULL");
            } 
       
            
            $obj->setLatitud($parametros['Latitud']);
            $obj->setLongitud($parametros['Longitud']);
            $obj->setCorreo($parametros['Mail']);
            $obj->setTelefono($parametros['Telefono']);
            $obj->setExtension($parametros['Extension']);
            if (isset($parametros['DF']) && $parametros['DF'] != "") {
                $obj->setDocumentofiscal($parametros['DF']);
            } else {
                $obj->setDocumentofiscal("Null");
            } 
            // $obj->setPdfcedulafiscal($parametros['Cedula']);
            //$rutapdf = "resources/images/institucion/pdf/";
            $rutapdf = "resources/aplicaciones/imagenes/Institucion/pdf/";
            if (isset($_FILES[1])) {
                if (file_exists("../../../" . $rutapdf . $_FILES[1]['name'])) {
                    $namepdf = $rutapdf . "(1)" . $_FILES[1]['name'];
                } else {
                    $namepdf = $rutapdf . $_FILES[1]['name'];
                }
                $obj->setPdfcedulafiscal($namepdf);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $namepdf);
            } else {
                $obj->setPdfcedulafiscal("");
            }


            $obj->setRfc($parametros['RFC']);
            $obj->setFacebook($parametros['Facebook']);
            $obj->setInstagram($parametros['Instagram']);
            $obj->setTwitter($parametros['Twitter']);
             
            $obj->setPaginaweb($parametros['Web']);
        
         
        
            
        
            $obj->setUsuarioCreacion("SIE");
            $obj->setUsuarioUltimaModificacion("SIE");
            $obj->setPantalla('altaInstitucion.php');
            if ($obj->nuevaInstitucion()) {
                $idInstitucion = $obj->getId_institucion();
                ///echo "INST: ".$idInstitucion;
                $obj->setId_institucion($idInstitucion);
                if(isset($parametros['rol'])){
                    $rol = $parametros['rol'];
                    for ($i=0; $i<count($rol); $i++){
                    //echo "<br> rol " . $i . ": " . $rol[$i];
                    $obj->setRol($rol[$i]);
                    if($obj->agregarRol()){
                      continue;
                    }
                  }
                }
                echo "Institución guardada correctamente";
            } else {
                echo 'Error al guardar';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_institucion($_POST['id']);
            $obj->setNombre($parametros['institucion']);
            //$rutaimg = "resources/images/institucion/logo/";
            $rutaimg = "resources/aplicaciones/imagenes/Institucion/logo/";

            if (isset($_FILES[0])) {
               // echo '1';
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                   // echo '2';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg . "(1)" . $archivo;
                } else {

                   // echo '3';
                    $archivo = $_FILES[0]['name'];
                    $explode = explode('.', $archivo);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg . $archivo;
                }
                //echo '4';
                echo $obj->setFoto($nameimg);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
               // echo '5';
                $obj->setFoto(0);
            }

             if (isset($parametros['Pais']) && $parametros['Pais'] != "") {
                $obj->setId_pais($parametros['Pais']);
            } else {
                $obj->setId_pais(0);
            }
            
            if (isset($parametros['Sector']) && $parametros['Sector'] != "") {
                $obj->setId_sector($parametros['Sector']);
            } else {
                $obj->setId_sector(0);
            }
           if (isset($parametros['Giro']) && $parametros['Giro'] != "") {
                $obj->setId_giro($parametros['Giro']);
            } else {
                $obj->setId_giro(0);
            }
            if (isset($parametros['SubGiro']) && $parametros['SubGiro'] != "") {
                $obj->setId_subgiro($parametros['SubGiro']);
            } else {
                $obj->setId_subgiro(0);
            }
           if(isset($parametros['Sector']) && $parametros['Sector']==2){
              $obj->setId_dependencia("NULL");
           }elseif ($parametros['Sector']==1 && $parametros['Dependencia']!="") {
                  $obj->setId_dependencia($parametros['Dependencia']);  
               
            }else{
                  $obj->setId_dependencia("NULL");
             
           }
            $obj->setCalle($parametros['Calle']);
            $obj->setNumeroe($parametros['NumeroE']);
            $obj->setNumeroi($parametros['Numeroi']);
            $obj->setColonia($parametros['Colonia']);
           if (isset($parametros['Estado']) && $parametros['Estado'] != "") {
                $obj->setId_estado($parametros['Estado']);
            } else {
                $obj->setId_estado(0);
            } 
           $obj->setId_ciudad($parametros['Ciudad']);

           if (isset($parametros['alcaldia']) && $parametros['alcaldia'] != "") {
                $obj->setId_Municipio($parametros['alcaldia']);
            } else {
                $obj->setId_Municipio(0);
            } 
          if (isset($parametros['codigopostal']) && $parametros['codigopostal'] != "") {
                $obj->setCodigopostal($parametros['codigopostal']);
            } else {
                $obj->setCodigopostal("NULL");
            } 
       
            $obj->setLatitud($parametros['Latitud']);
            $obj->setLongitud($parametros['Longitud']);
            $obj->setCorreo($parametros['Mail']);
            $obj->setTelefono($parametros['Telefono']);
            $obj->setExtension($parametros['Extension']);
            if (isset($parametros['DF']) && $parametros['DF'] != "") {
                $obj->setDocumentofiscal($parametros['DF']);
            } else {
                $obj->setDocumentofiscal("Null");
            } 
            //$rutapdf = "resources/images/institucion/pdf/";
            $rutapdf = "resources/aplicaciones/imagenes/Institucion/pdf/";
            if (isset($_FILES[1])) {
                if (file_exists("../../../" . $rutapdf . $_FILES[1]['name'])) {
                    $namepdf = $rutapdf . "(1)" . $_FILES[1]['name'];
                } else {
                    $namepdf = $rutapdf . $_FILES[1]['name'];
                }
                $obj->setPdfcedulafiscal($namepdf);

                move_uploaded_file($_FILES[1]['tmp_name'], "../../../" . $namepdf);
            } else {
                $obj->setPdfcedulafiscal(0);
            }

            $obj->setRfc($parametros['RFC']);
            $obj->setFacebook($parametros['Facebook']);
            $obj->setInstagram($parametros['Instagram']);
            $obj->setTwitter($parametros['Twitter']);
            $obj->setPaginaweb($parametros['Web']);
            $obj->setUsuarioUltimaModificacion("SIE");
            if ($obj->editarinstitucion()) {
                $idInstitucion = $obj->getId_institucion();
                $obj->setId_institucion($idInstitucion);
                $obj->eliminarRol();
                if(isset($parametros['rol'])){
                    $rol = $parametros['rol'];
                    for ($i=0; $i<count($rol); $i++){
                    //echo "<br> rol " . $i . ": " . $rol[$i];
                    $obj->setRol($rol[$i]);
                    if($obj->agregarRol()){
                      continue;
                    }
                  }
                }
                echo 'Éxito: La Institución ha sido modificada';
            } else {
                echo 'Error: No se ha podido modificar la Institución';
            }
            break;
        case 'eliminar':
            $obj->setId_institucion($_POST['id']);
            $obj->eliminarRol();
            if ($obj->eliminarInstitucion()) {
                echo 'Éxito: Se ha eliminado la Institución';
            } else {
                echo 'Error: No se ha podido eliminar la Institución';
            }


            break;
    }
} else if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {


    $idsubgiro = $_POST['idgiro'];
    $idsector = $_POST['idsector'];
    $idPersonal = $_POST['id'];
    $idciudad = $_POST['idCiudad'];
    $idEstado = $_POST['idEstado'];
    $idAlcaldia = $_POST['idalcaldia'];


    if ($idsector != 0) {
        $consulta = "SELECT Id_giro,Id_sector,nombre FROM `c_giro` WHERE Id_sector=$idsector;
";
        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['Id_giro'] == $Actividad) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['Id_giro'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
        }
    } elseif ($idsubgiro != 0) {
        $consulta = "SELECT
k_subgiro.Id_subgiro,
k_subgiro.Id_giro,
c_subgiro.nombre
FROM
k_subgiro
INNER JOIN c_subgiro ON k_subgiro.Id_subgiro2 = c_subgiro.Id_subgiro
WHERE Id_giro=$idsubgiro;
";
        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['Id_subgiro'] == $Actividad) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['Id_subgiro'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
        }
    } elseif ($idPersonal != 0) {
        $id = "";
        if ($idPersonal == 117) {
            $id = "WHERE Id_docf<2";
        } else {
               $id = "WHERE Id_docf=2";
        }
        $consulta = "SELECT
Id_docf,
nombre
FROM
c_documentofiscal
$id
";


   $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['Id_docf'] == $Actividad) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['Id_docf'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
            
        }
    } elseif ($idciudad != 0) {
        $consulta = " SELECT id_ciudad,Id_pais,nombre FROM c_ciudad WHERE Id_pais=$idciudad
";
       $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['id_ciudad'] == $Actividad) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['id_ciudad'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
        }
    } else if ($idEstado != 0){
        $id3 = "";

        if( $idEstado <> 117){

            $id3="0";
        }else{

             $id3="1";
        }

        $consulta = "SELECT
c_estado.id_Estado,
c_estado.Nombre,
Activo
FROM `c_estado` WHERE Activo=$id3
"
;
$Estado="";
        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['id_Estado'] == $Estado) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['id_Estado'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }


    }else{

    
$alcaldia="";
$consulta ="SELECT
c_municipio.id_Municipio,
c_municipio.id_Estado,
c_municipio.Nombre,
c_municipio.id_Estatus,
c_municipio.Activo
FROM `c_municipio` WHERE id_Estado=$idAlcaldia  " ;
        $resultado = $catalogo->obtenerLista($consulta);
         echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['id_Municipio'] == $alcaldia) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['id_Municipio'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
        
}
}