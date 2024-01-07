<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/Personas.class.php");
include_once("../../Classes/Institucion2.class.php");
$catalogo = new Catalogo();
$Personas= new Persona();
$Institucion= new Institucion2();


if(isset($_POST['acciones']) && $_POST['acciones']=="nuevo"){
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
     $texto=$_POST['IdTexto2'];
    $Personas->setTexto($texto);
    $idPersonas=$parametros['autor'];
    $Personas->setId_Personas($idPersonas);

   if($Personas->nuevaRel_Persona()){
        echo "Registro exitoso";
    }else{
        echo "Error: Fallo el registro";
    }
}elseif(isset($_POST['acciones']) && $_POST['acciones']=="Editar"){
     $idPersonas=$_POST['id_Personas'];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $Personas->setId_Personas($idPersonas);
    $Personas->setEstatus(0);
    $Personas->setPais_nac(0);
    $Personas->setId_institucionE(0);
    if (isset($parametros['idEje']) && $parametros['idEje'] != "") {
        $Personas->setIdEje($parametros['idEje']);
    } else {
        $Personas->setIdEje(0);
    }            
    if (isset($parametros['id_area']) && $parametros['id_area'] != "") {
        $Personas->setId_area($parametros['id_area']);
    } else {
        $Personas->setId_area(16);
    }
    if (isset($parametros['id_subarea']) && $parametros['id_subarea'] != "") {
        $Personas->setId_subarea($parametros['id_subarea']);
    } else {
        $Personas->setId_subarea(0);
    }
    if (isset($parametros['id_tipopersona']) && $parametros['id_tipopersona'] != "") {
        $Personas->setId_tipopersona($parametros['id_tipopersona']);
    } else {
        $Personas->setId_tipopersona(0);
    }
    if (isset($parametros['mes']) && $parametros['mes'] != "") {
        $Personas->setMes($parametros['mes']);
    } else {
        $Personas->setMes(0);
    }
    if (isset($parametros['id_gradoacademico']) && $parametros['id_gradoacademico'] != "") {
        $Personas->setId_gradoacademico($parametros['id_gradoacademico']);
    } else {
        $Personas->setId_gradoacademico(0);
    }
    if (isset($parametros['id_institucion']) && $parametros['id_institucion'] != "") {
        $Personas->setId_institucion($parametros['id_institucion']);
    } else {
        $Personas->setId_institucion(0);
    }
    if (isset($parametros['id_tipotel']) && $parametros['id_tipotel'] != "") {
        $Personas->setId_tipotel($parametros['id_tipotel']);
    } else {
        $Personas->setId_tipotel(0);
    }
    if (isset($parametros['id_pais']) && $parametros['id_pais'] != "") {
        $Personas->setId_pais($parametros['id_pais']);
    } else {
        $Personas->setId_pais(0);
    }
    if (isset($parametros['id_estado']) && $parametros['id_estado'] != "") {
        $Personas->setId_estado($parametros['id_estado']);
    } else {
        $Personas->setId_estado(0);
    }if (isset($parametros['colonia']) && $parametros['colonia'] != "") {
        $Personas->setColonia($parametros['colonia']);
    } else {
        $Personas->setColonia(0);
    }
    if (isset($parametros['municipio']) && $parametros['municipio'] != "") {
        $Personas->setMunicipio($parametros['municipio']);
    } else {
        $Personas->setMunicipio(0);
    }
    //TextosAutores
    if (isset($parametros['resenia']) && $parametros['resenia'] != "") {
        $Personas->setSemblanza($parametros['resenia']);
    } else {
        $Personas->setSemblanza(NULL);
    }
    if (isset($parametros['semblanza']) && $parametros['semblanza'] != "") {
        $Personas->setResenia($parametros['semblanza']);
    } else {
        $Personas->setResenia(NULL);
    }
    if (isset($parametros['ocupacion']) && $parametros['ocupacion'] != "") {
        $Personas->setOcupacion($parametros['ocupacion']);
    } else {
        $Personas->setOcupacion(NULL);
    }
    if (isset($parametros['id_institucionA']) && $parametros['id_institucionA'] != "") {
        $Personas->setInstitucionA($parametros['id_institucionA']);
    } else {
        $Personas->setInstitucionA(NULL);
    }
    $Nombre= $parametros['Nombre']; 
    $Apellido=$parametros['Apellido']; 
    $ApellidoM=$parametros['ApellidoM']; 
    $Correo=$parametros['Correo_autor']; 
    $CURP=$parametros['CURP']; 
    $Institucion=$parametros['Institucion']; 
    $Pais=$parametros['Pais']; 
    $RFC=$parametros['RFC']; 
    $Resena=$parametros['Resena']; 
    $Regimen=$parametros['Regimen']; 
    $Telefono=$parametros['Telefono']; 

    $Personas->setNombre($Nombre);
    $Personas->setApp($Apellido);
    $Personas->setApm($ApellidoM);
    $Personas->setCorreo($Correo);
    $Personas->setCurp($CURP);
    $Personas->setInstitucionA($Institucion);
    $Personas->setpais_nac($Pais);
    $Personas->setRfc($RFC);
    $Personas->setResenia($Resena);
    $Personas->setIdRegimenFiscal($Regimen);
    $Personas->setTelefono($Telefono);
    if($Personas->editarPersona2()){
        echo "Edición exitosa";
    }else{
        echo "Error: Fallo Edición";
    }
}elseif(isset($_POST['acciones']) && $_POST['acciones']=="Eliminar"){
    $idPersonas=$_POST['id_Personas'];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $texto=$_POST['IdTexto2'];
    $Personas->setTexto($texto);
    $Personas->setId_Personas($idPersonas);
    if($Personas->DeleteRel_Persona()){
        echo "Eliminación exitosa";
    }

}elseif(isset($_POST['Buscar']) && $_POST['Buscar']=="Buscar"){
    $idPersonas=$_POST['id_Personas'];
    if($idPersonas!=""){
    $Personas->setId_Personas($idPersonas);
    $Personas->getPersona();
    echo $Personas->getNombre()."/*". $Personas->getApp()."/*".$Personas->getApm()."/*".
    $Personas->getCorreo()."/*".$Personas->getCurp()."/*".$Personas->getInstitucionA()."/*".
    $Personas->getRfc()."/*".$Personas->getPais_nac()."/*".$Personas->getResenia()."/*".
    $Personas->getIdRegimenFiscal()."/*".$Personas->getTelefono();
    }
}
elseif(isset($_POST['Buscar_datos']) && $_POST['Buscar_datos']=="Buscar_datos"){
    $idPersonas=$_POST['id_Personas'];
    if($idPersonas!=""){
    $Personas->setId_Personas($idPersonas);
    $Personas->getPersona();
    echo $Personas->getNombre()."/*". $Personas->getApp()."/*".$Personas->getApm()."/*".
    $Personas->getCorreo()."/*".$Personas->getCurp()."/*".$Personas->getInstitucionA()."/*".
    $Personas->getRfc()."/*".$Personas->getPais_nac()."/*".$Personas->getResenia()."/*".
    $Personas->getIdRegimenFiscal()."/*".$Personas->getTelefono();
    }
}elseif(isset($_POST['acciones']) && $_POST['acciones']=="nuevo_datos"){
    $idPersonas=$_POST['id_Personas'];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $Personas->setId_Personas($idPersonas);
    $Correo=$parametros['c_c'];
    $Regimen=$parametros['r_r'];
    $Telefono=$parametros['t_t'];
    $Personas->setCorreo($Correo);
    $Personas->setIdRegimenFiscal($Regimen);
    $Personas->setTelefono($Telefono);
    if($Personas->editarPersona3()){
        echo "Edición exitosa";
    }else{
        echo "Error: Fallo Edición";
    }
//echo "si se pudo";
}
elseif(isset($_POST['Buscar_datos2']) && $_POST['Buscar_datos2']=="Buscar_datos2"){
    $idPersonas=$_POST['id_Personas'];
    if($idPersonas!=""){
    $Institucion->setId_institucion($idPersonas);
    $Institucion->getInstitucion();
    echo $Institucion->getCorreo()."/*". $Institucion->getDocumentofiscal()."/*".$Institucion->getTelefono();
    }
}elseif(isset($_POST['acciones']) && $_POST['acciones']=="nuevo_datos2"){
    $idPersonas=$_POST['id_Personas'];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $Institucion->setId_institucion($idPersonas);
    $Correo=$parametros['c_c'];
    $Regimen=$parametros['r_r'];
    $Telefono=$parametros['t_t'];
    $Institucion->setCorreo($Correo);
    $Institucion->setDocumentofiscal($Regimen);
    $Institucion->setTelefono($Telefono);
    if($Institucion->editarinstitucion2()){
        echo "Edición exitosa";
    }else{
        echo "Error: Fallo Edición";
    }
}
?>