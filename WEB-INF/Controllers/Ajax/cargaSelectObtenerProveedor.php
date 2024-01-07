<?php 

include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if ( isset($_POST['IdProveedor']) && $_POST['IdProveedor'] != "") {
	$datosProveedor= array('correo'=>'','rfc'=>'','regFiscal'=>'','telefono'=>'');
	$consulta = "SELECT ci.Id_institucion,ci.Nombre,ci.Telefono,ci.Correo,ci.Rfc,cdf.nombre as docFiscal FROM `c_institucion` AS ci
	INNER JOIN c_documentofiscal AS cdf ON cdf.Id_docf = ci.Id_DocFi
	WHERE ci.Id_institucion = ".$_POST['IdProveedor'].";";

	//echo $consulta;
	$resultado = $catalogo->obtenerLista($consulta);
	
	while ($row = mysqli_fetch_array($resultado)) {	
		$datosProveedor['correo'] = $row['Correo'];
		$datosProveedor['rfc'] = $row['Rfc'];
		$datosProveedor['regFiscal']  = $row['docFiscal'];
		$datosProveedor['telefono'] = $row['Telefono'];
		//$datosProveedor = array('correo'=>$row['Correo'],'rfc'=>$row['Rfc'],'regFiscal'=>$row['docFiscal'],'telefono'=>$row['Telefono']);
		/*array_push($datosProveedor, array('correo'=>$row['Correo'],'rfc'=>$row['Rfc'],'regFiscal'=>$row['docFiscal'],'telefono'=>$row['Telefono']));*/
	}
	echo json_encode($datosProveedor);
}

?>
