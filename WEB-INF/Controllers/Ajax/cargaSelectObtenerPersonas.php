<?php

include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if ( isset($_POST['IdPersona']) && $_POST['IdPersona'] != "") {
    $datosPersona = array('fechaNacimiento'=>'','correo'=>'','rfc'=>'','regFiscal'=>'','semblanza'=>'','telcelular'=>'','telcasa'=>'','teloficina'=>'');
	$IdPersona = $_POST['IdPersona'];
	$consulta = "SELECT
	cp.Semblanza,
	CONCAT(
		cp.Anio_nacimiento,
		'-',
		cp.Mes_nacimiento,
		'-',
		cp.Dia_nacimiento
	) fechaNacimiento,
	cp.Correo,
	cp.RFC,
	cp.IdRegimenFiscal,
  	cdf.nombre AS regFiscal
	FROM
	`c_personas` AS cp
	LEFT JOIN c_documentofiscal AS cdf ON cdf.Id_docf = cp.IdRegimenFiscal
	WHERE id_Personas = ".$IdPersona;
	$resultado = $catalogo->obtenerLista($consulta);

	//echo "$consulta";
	while ($row = mysqli_fetch_array($resultado)) {
		
		$datosPersona['fechaNacimiento'] = $row['fechaNacimiento'];
		$datosPersona['correo'] = $row['Correo'];
		$datosPersona['rfc'] = $row['RFC'];
		$datosPersona['regFiscal'] = $row['regFiscal'];
		$datosPersona['semblanza']= $row['Semblanza'];
     
    }

    $consultaTelefonos = "SELECT id_TipoTelefono,CONCAT(Numero_Telefonico,' Ext. ',Ext) AS Telefono FROM `c_telefonoContacto` WHERE id_Personas =".$IdPersona. " AND Activo = 1 ORDER BY id_TipoTelefono;";
    //echo "$consultaTelefonos";
    $resultado = $catalogo->obtenerLista($consultaTelefonos);

	
	while ($row = mysqli_fetch_array($resultado)) {	
		if($row['id_TipoTelefono'] == '1'){
			$datosPersona['telcelular'] = $row['Telefono'];
		}
		if($row['id_TipoTelefono'] == '2'){
			$datosPersona['telcasa'] = $row['Telefono'];
		}
		if($row['id_TipoTelefono'] == '3'){
			$datosPersona['teloficina'] = $row['Telefono'];
		}   
    }
    echo json_encode($datosPersona);
}
if(isset($_POST['IdPersona']) && $_POST['IdPersona'] != "" && isset($_POST['select']) && $_POST['select'] == "institucion" ){
	$consulta = "SELECT cpe.id_persona,cpe.id_institucion,ci.Nombre FROM `c_personaInstitucion` AS cpe
	INNER JOIN c_personas AS cp ON cp.id_Personas = cpe.id_persona
	INNER JOIN  c_institucion AS ci ON ci.Id_institucion = cpe.id_institucion WHERE cpe.id_persona=".$_POST['IdPersona'].";";

	//echo "$consulta";
    $result = $catalogo->obtenerLista($consulta);
    echo '<option value="">Selecciona una opción</option>';
    while ($row1 = mysqli_fetch_array($result)) {
        /*$s = '';
        if($row1['IdInstitucion'] == $_POST['editar']){
            $s = 'selected = "selected"';
        }*/
        echo '<option value="'.$row1['id_institucion'].'" '.$s.'>'.$row1['Nombre'].'</option>';
    }
    /*}else{
        echo '<option value="">Selecciona una opción</option>';
    }*/
}