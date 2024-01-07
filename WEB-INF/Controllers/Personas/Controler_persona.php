<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/Personas.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Persona();
    $obj->setPais_nac(0);
    $obj->setId_institucionE(0);
    //$obj->setMunicipio(0);
    //$obj->setId_estado(0);
    $obj->setEstatus(0);
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //$obj->setIdEje($parametros['idEje']);

            if (isset($parametros['idEje']) && $parametros['idEje'] != "") {
                $obj->setIdEje($parametros['idEje']);
            } else {
                $obj->setIdEje(0);
            }            
            if (isset($parametros['id_area']) && $parametros['id_area'] != "") {
                $obj->setId_area($parametros['id_area']);
            } else {
                $obj->setId_area(0);
            }
            if (isset($parametros['id_subarea']) && $parametros['id_subarea'] != "") {
                $obj->setId_subarea($parametros['id_subarea']);
            } else {
                $obj->setId_subarea(0);
            }
            if (isset($parametros['id_tipopersona']) && $parametros['id_tipopersona'] != "") {
                $obj->setId_tipopersona($parametros['id_tipopersona']);
            } else {
                $obj->setId_tipopersona(0);
            }
            if (isset($parametros['mes']) && $parametros['mes'] != "") {
                $obj->setMes($parametros['mes']);
            } else {
                $obj->setMes(0);
            }
            if (isset($parametros['id_gradoacademico']) && $parametros['id_gradoacademico'] != "") {
                $obj->setId_gradoacademico($parametros['id_gradoacademico']);
            } else {
                $obj->setId_gradoacademico(0);
            }
            if (isset($parametros['id_institucion']) && $parametros['id_institucion'] != "") {
                $obj->setId_institucion($parametros['id_institucion']);
            } else {
                $obj->setId_institucion(0);
            }
            if (isset($parametros['id_tipotel']) && $parametros['id_tipotel'] != "") {
                $obj->setId_tipotel($parametros['id_tipotel']);
            } else {
                $obj->setId_tipotel(0);
            }
            if (isset($parametros['id_pais']) && $parametros['id_pais'] != "") {
                $obj->setId_pais($parametros['id_pais']);
            } else {
                $obj->setId_pais(0);
            }
            if (isset($parametros['id_estado']) && $parametros['id_estado'] != "") {
                $obj->setId_estado($parametros['id_estado']);
            } else {
                $obj->setId_estado(0);
            }

            $obj->setNombre($parametros['nombre']);
            $obj->setApp($parametros['app']);
            $obj->setApm($parametros['apm']);
            $obj->setSeudonimo($parametros['seudonimo']);    
            $obj->setDia($parametros['dia']);
            $obj->setAnio($parametros['anio']);
            $obj->setCorreo($parametros['correo']);
            $obj->setCorreo_institucional($parametros['correo_institucional']);
            $obj->setNumero($parametros['numero']);
            $obj->setExt($parametros['ext']);
            $obj->setRfc($parametros['rfc']);
            $obj->setCurp($parametros['curp']);
            $obj->setCalle($parametros['calle']);
            $obj->setNum_ext($parametros['num_ext']);
            $obj->setNum_int($parametros['num_int']);
            $obj->setId_ciudad($parametros['id_ciudad']);
            $obj->setCp($parametros['cp']);
            if (isset($parametros['colonia']) && $parametros['colonia'] != "") {
                $obj->setColonia($parametros['colonia']);
            } else {
                $obj->setColonia(0);
            }
            if (isset($parametros['municipio']) && $parametros['municipio'] != "") {
                $obj->setMunicipio($parametros['municipio']);
            } else {
                $obj->setMunicipio(0);
            }
            //TextosAutores
            if (isset($parametros['resenia']) && $parametros['resenia'] != "") {
                $obj->setSemblanza($parametros['resenia']);
            } else {
                $obj->setSemblanza(NULL);
            }
            if (isset($parametros['semblanza']) && $parametros['semblanza'] != "") {
                $obj->setResenia($parametros['semblanza']);
            } else {
                $obj->setResenia(NULL);
            }
            if (isset($parametros['ocupacion']) && $parametros['ocupacion'] != "") {
                $obj->setOcupacion($parametros['ocupacion']);
            } else {
                $obj->setOcupacion(NULL);
            }
            if (isset($parametros['id_institucionA']) && $parametros['id_institucionA'] != "") {
                $obj->setInstitucionA($parametros['id_institucionA']);
            } else {
                $obj->setInstitucionA(NULL);
            }
            //FinTextosAutores

            if($obj->corroborarPersona()){
              

                if ($obj->nuevaPersona()) {
                    if($obj->agregarNumerotelefonico()){
                        //echo 'El número se registro correctamente';
                    } else{
                        //echo 'No se registro el número';
                    }
                    $idPersona = $obj->getId_Personas();
                    $obj->setId_Personas($idPersona);
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
                    echo "Éxito: Persona guardada correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar la Persona.';
                }


            }
            else{
                echo "Error: La Persona ya se encuentra registrada";
             
            }
           
            break;

        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_Personas($_POST['id']);
            
            if (isset($parametros['idEje']) && $parametros['idEje'] != "") {
                $obj->setIdEje($parametros['idEje']);
            } else {
                $obj->setIdEje(0);
            }
            if (isset($parametros['id_area']) && $parametros['id_area'] != "") {
                $obj->setId_area($parametros['id_area']);
            } else {
                $obj->setId_area(0);
            }
            if (isset($parametros['id_subarea']) && $parametros['id_subarea'] != "") {
                $obj->setId_subarea($parametros['id_subarea']);
            } else {
                $obj->setId_subarea(0);
            }
            if (isset($parametros['id_tipopersona']) && $parametros['id_tipopersona'] != "") {
                $obj->setId_tipopersona($parametros['id_tipopersona']);
            } else {
                $obj->setId_tipopersona(0);
            }
            if (isset($parametros['mes']) && $parametros['mes'] != "") {
                $obj->setMes($parametros['mes']);
            } else {
                $obj->setMes(0);
            }
            if (isset($parametros['id_gradoacademico']) && $parametros['id_gradoacademico'] != "") {
                $obj->setId_gradoacademico($parametros['id_gradoacademico']);
            } else {
                $obj->setId_gradoacademico(0);
            }
            if (isset($parametros['id_institucion']) && $parametros['id_institucion'] != "") {
                $obj->setId_institucion($parametros['id_institucion']);
            } else {
                $obj->setId_institucion(0);
            }
            if (isset($parametros['id_tipotel']) && $parametros['id_tipotel'] != "") {
                $obj->setId_tipotel($parametros['id_tipotel']);
            } else {
                $obj->setId_tipotel(0);
            }
            if (isset($parametros['id_pais']) && $parametros['id_pais'] != "") {
                $obj->setId_pais($parametros['id_pais']);
            } else {
                $obj->setId_pais(0);
            }
            if (isset($parametros['id_estado']) && $parametros['id_estado'] != "") {
                $obj->setId_estado($parametros['id_estado']);
            } else {
                $obj->setId_estado(0);
            }
            /*if ($parametros['id_paisN'] != "") {
                $obj->setPais_nac($parametros['id_paisN']);
            } else {
                $obj->setPais_nac(0);
            }*/

            $obj->setNombre($parametros['nombre']);
            $obj->setApp($parametros['app']);
            $obj->setApm($parametros['apm']);
            $obj->setSeudonimo($parametros['seudonimo']);    
            $obj->setDia($parametros['dia']);
            $obj->setAnio($parametros['anio']);
            $obj->setCorreo($parametros['correo']);
            $obj->setCorreo_institucional($parametros['correo_institucional']);
            $obj->setNumero($parametros['numero']);
            $obj->setExt($parametros['ext']);
            $obj->setRfc($parametros['rfc']);
            $obj->setCurp($parametros['curp']);
            $obj->setCalle($parametros['calle']);
            $obj->setNum_ext($parametros['num_ext']);
            $obj->setNum_int($parametros['num_int']);
            $obj->setId_ciudad($parametros['id_ciudad']);
            $obj->setCp($parametros['cp']);

            if (isset($parametros['colonia']) && $parametros['colonia'] != "") {
                $obj->setColonia($parametros['colonia']);
            } else {
                $obj->setColonia(0);
            }
            if (isset($parametros['municipio']) && $parametros['municipio'] != "") {
                $obj->setMunicipio($parametros['municipio']);
            } else {
                $obj->setMunicipio(0);
            }

            //TextosAutores
            if (isset($parametros['resenia']) && $parametros['resenia'] != "") {
                $obj->setSemblanza($parametros['resenia']);
            } else {
                $obj->setSemblanza(NULL);
            }
            if (isset($parametros['semblanza']) && $parametros['semblanza'] != "") {
                $obj->setResenia($parametros['semblanza']);
            } else {
                $obj->setResenia(NULL);
            }
            if (isset($parametros['ocupacion']) && $parametros['ocupacion'] != "") {
                $obj->setOcupacion($parametros['ocupacion']);
            } else {
                $obj->setOcupacion(NULL);
            }
            if (isset($parametros['id_institucionA']) && $parametros['id_institucionA'] != "") {
                $obj->setInstitucionA($parametros['id_institucionA']);
            } else {
                $obj->setInstitucionA(NULL);
            }
            //FinTextosAutores

            /*TELEFONO*/
            if (isset($parametros['id_tipotel']) && $parametros['id_tipotel'] != "") {
                $obj->setId_tipotel($parametros['id_tipotel']);
            } else {
                $obj->setId_tipotel(0);
            }

            $obj->setId_Personas($_POST['id']);
            $obj->setNumero($parametros['numero']);
            $obj->setExt($parametros['ext']);


            if ($obj->editarPersona()) {
                if($obj->editarNumerotelefonico()){
                    //echo 'Se actualizo el número';
                }else{
                    //echo 'No se actualizó el número';
                }
                $idPersona = $obj->getId_Personas();
                $obj->setId_Personas($idPersona);
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
                echo 'Éxito: La Persona ha sido modificada.';
            } else {
                echo 'Error: No se ha podido modificar la Persona.';
            }
            break;

        case 'eliminar':
        //echo "ENTRO";
            $obj->setId_Personas($_POST['id']);
            //echo "ENTRO x2";
            $obj->eliminarRol();
            if ($obj->eliminarPersona()) {
                //echo "estoy aquí";
                if($obj->eliminarNumerotelefonico()){
                    //echo 'El número se borro';
                }else{
                    //echo 'El número no pudo eliminarse';
                }
                echo 'Éxito: Se ha eliminado la Persona.';
            } else {
                echo 'Error: No se ha podido eliminar la Persona.';
            }

            break;
    }
} elseif (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != ""){
	
	$idestado = "";
	$municipio = "";
	$colonia = "";

	$idestado = $_POST['id_estado'];
	$municipio = $_POST['municipio'];
	$colonia = $_POST['colonia'];

    echo "estado " . $idestado;
    echo "municipio " . $municipio;
    echo "colonia " . $colonia;

	if ($idestado != 0){
        //$id3 = "";
        if( $idestado <> 117){
        	$id3="0";
        }else{
        	$id3="1";
        }

        $consulta = "SELECT c_estado.id_Estado, c_estado.Nombre, Activo
        FROM `c_estado` WHERE Activo=$id3 ORDER BY Nombre ASC";
        $Estado="";
        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['id_Estado'] == $Estado) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['id_Estado'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
    } else if($municipio != 0){
    	$consulta = "SELECT id_Municipio, id_Estado, Nombre FROM c_municipio WHERE id_Estado = $municipio and Activo = 1 ORDER BY Nombre ASC";
    	echo "municipio: " . $consulta;
    	$municipio ="";
    	$resultado = $catalogo->obtenerLista($consulta);
    	echo '<option value="">Seleccione una opción</option>';
    	while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['id_Municipio'] == $municipio) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['id_Municipio'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
    } else if($colonia != 0){
    	//$colonia = "";
    	$consulta = "SELECT id_Colonia, id_Municipio, Nombre FROM c_colonia WHERE id_Municipio = $colonia AND Activo = 1 ORDER BY Nombre ASC";
    	echo "COL " . $consulta;
    	$resultado = $catalogo->obtenerLista($consulta);
    	echo '<option value="">Seleccione una opción</option>';
    	while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['id_Colonia'] == $colonia) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['id_Colonia'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
    }

}