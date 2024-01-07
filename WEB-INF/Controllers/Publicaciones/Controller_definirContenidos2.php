<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/ArchivoCompartido.class.php");
include_once("../../Classes/ActividadArchivo.class.php");
include_once("../../Classes/EntregableEspecifico.class.php");
session_start();

$catalogo = new Catalogo();
$objAC = new ArchivoCompartido();
$objAA = new actividades();
$EE = new EntregableEspecifico();
if (isset($_POST['form'])) {
	$parametros = "";
	$user="";
	$wheretext="";
	$conta2=1;
	parse_str($_POST['form'], $parametros);
	if(isset($parametros['contenido']) && $parametros['contenido']!=""){
		$IdLibro= $parametros['IdLibro'];
		$dato_actualizado=0;
	
		$usuario=$_SESSION['user_session'];
		$Ideje= $parametros['Ideje'];
		$IdActividad= $parametros['IdActividad'];
		$IdActividad_inicial=$parametros['IdActividad'];
		$n_actividad= $parametros['n_actividad'];
		$idtext="";
		if(isset( $parametros['IdTexto']) && $parametros['IdTexto']!=""){
			$idtext= $parametros['IdTexto'];
			$wheretext= "AND IdTexto=".$parametros['IdTexto'];
			$where_idtext="IdTexto=".$parametros['IdTexto'];
			$where_idtext2="WHERE c_textosLibro.IdTexto=".$parametros['IdTexto'];
		}else{
			$where_idtext="";
			$where_idtext2="";
		}
		$conta=0;
		$images=0;
		$archivo="";
		$no_relacion = "";
		$IdArchPreliminar="";
		$resultado= json_decode($parametros['datos']);
		$consulta = "SELECT Usuario FROM c_usuario WHERE IdUsuario=".$usuario;
		$resultConsulta = $catalogo->obtenerLista($consulta);
		while ($row = mysqli_fetch_array($resultConsulta)) {
			$user= $row['Usuario'];
		}
		foreach ($resultado as $key => $val) {
			$dato_actualizado=0;
			$id_c=$val->campo; 
			if(isset($parametros[$id_c])){
				$valor = $parametros[$id_c];
			}else{
				$valor="";
			 	$parametros[$val->campo]="";
			}
			$anio= 2020;//date('Y');
			$consulta_an= "SELECT Id_Periodo from c_periodo WHERE Periodo =".$anio;
			$resultanio = $catalogo->obtenerLista($consulta_an);
			while ($row_a = mysqli_fetch_array($resultanio)) {
				$anio=$row_a['Id_Periodo'];
			}	
			if($val->habilitado=="si"){
				if($val->tabla!="c_textosLibro" ){
					$wheretext="";
				}
				$selecciona_documento = "SELECT $val->campo  FROM $val->tabla WHERE IdLibro=$IdLibro $wheretext ;";//echo "<br>";
				$resultdocumento = $catalogo->obtenerLista($selecciona_documento);
				if(mysqli_num_rows($resultdocumento)!=0){
					while ($row_mento = mysqli_fetch_array($resultdocumento)) {
						$IdArchPreliminar=$row_mento[$val->campo];
						//echo $IdArchPreliminar."<br>";
					}	
					if($IdArchPreliminar!="" && $IdArchPreliminar!=0){
						$no_relacion = "si";
					}else{
						$no_relacion = "";
					}
				}else{
					$IdArchPreliminar="";
					$no_relacion = "";
				}
				
			}else{
				if($val->tabla!="c_textosLibro" ){
					$wheretext="";
				}
				if(isset($val->Relacion) && $val->Relacion!=""){
					$relacion= $val->Relacion;
				}else{
					$relacion="	INNER JOIN c_textosLibro on c_textosLibro.IdTexto = $val->tabla.IdTexto";
				}
				 $selecciona_documento = "SELECT $val->tabla.$val->campo FROM $val->tabla $relacion $where_idtext2";
				//echo "<br>";echo "<br>";
				$resultdocumento = $catalogo->obtenerLista($selecciona_documento);
				if(mysqli_num_rows($resultdocumento)!=0){
					while ($row_mento = mysqli_fetch_array($resultdocumento)) {
						$IdArchPreliminar=$row_mento[$val->campo];
					}	
					if($IdArchPreliminar!="" && $IdArchPreliminar!=0){
						$no_relacion = "si";
					}else{
						$no_relacion = "";
					}
				}else{
					$no_relacion = "";
				}
			}				

			//echo $_FILES[0]['name'];;
			$rutaPDF ='sie/resources/aplicaciones/imagenes/ArchivosCompartidos/';
			if($parametros['Entregable'.$conta]==1){
				
				//echo $selecciona_documento;
				//echo "estoy aqui".$conta;
				$namesoloimagen="";
				  $tipo= $parametros[$val->campo.'e'];
				if (isset($_FILES[$images]) && !empty($_FILES[$images])) {
				//	echo $selecciona_documento;echo "<br>";echo $IdArchPreliminar;echo "<br>";
                    $agregoArchivo = true;
					//echo "asd";
                    if (file_exists("../../../" . $rutaPDF . $_FILES[$images]['name'])) {
					//	echo "1";
                        $archivo = $_FILES[$images]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
                        $explode = explode('.',  $resultado);
                        $extension = array_pop($explode);
                        $nombre = $_FILES[$images]['name'];
                        $nameimg = 'resources/aplicaciones/imagenes/ArchivosCompartidos/' . "(1)" . $resultado;
                        $namesoloimagen= "(1)".$archivo;
                   } else {
					//echo "2";
                        $archivo = $_FILES[$images]['name'];
                        $resultado = str_replace(" ", "_",$archivo);
						
                        $explode = explode('.', $resultado);
                        $extension = array_pop($explode);
                        $nombre = $_FILES[$images]['name'];
                         $nameimg = 'resources/aplicaciones/imagenes/ArchivosCompartidos/' .  $resultado;
                        $namesoloimagen= $resultado;
                    }
                    $objAC->setPdfcedulafiscal($namesoloimagen);
                    move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
                } else {
					
                    $agregoArchivo = false;
                    $objAC->setPdfcedulafiscal("");
                }
				$objAC->setId_usuario($usuario);
				$rutaPDF='../../../resources/aplicaciones/imagenes/ArchivosCompartidos/';
				$objAC->setRuta($rutaPDF);
				//$pdf=0;
				//$objAC->setPdfcedulafiscal($namesoloimagen);
				$objAC->setDescripcion('Entregable de publicaciones: '.$n_actividad);
				$objAC->setPantalla('AppPublicaciones');
				$objAC->setAnio($anio);
				$objAC->setId_tipo($tipo);
				$objAC->setId_area('16');
				$objAC->setUsuarioCreacion($user);
				$objAC->setUsuarioUltimaModificacion($user);
				$objAC->setId_destino('NULL');
				$objAC->setId_destino2('NULL');
				
				$agregoArchivo=true;
				if($agregoArchivo){
					$objAC->setId_documento($IdArchPreliminar);
					
					if($no_relacion=="si"){
						//echo $namesoloimagen."asd";
						
							if($objAC->editaracuerdo()){
							}else{
							}
						
					}else{
						//echo $namesoloimagen."asd2";
						if($namesoloimagen!=""){
							if($objAC->nuevoAcuerdo()){
								$IdArchPreliminar = $objAC->getId_documento();
								}else{
							}
						}
					}
				}
				$objAA->setId_archivo($IdArchPreliminar);
				$objAA->setId_proyecto($Ideje);
				
				if($Ideje==7){
					$consulta_expo= "SELECT IdActividad, IdExposicion FROM c_libro WHERE IdLibro=$IdLibro;";
					$resultConsulta_expo = $catalogo->obtenerLista($consulta_expo);
					while ($row = mysqli_fetch_array($resultConsulta_expo)) {
						$IdActividad_e= $row['IdActividad'];
						$IdExposicion_e= $row['IdExposicion'];
					}
					$objAA->setId_exposicion($IdExposicion_e);
				}
				$contador_act=4;
				$array_act=array();
				while($IdActividad_e != $IdActividad){
					$consulta_actividades= "SELECT IdActividadSuperior FROM c_actividad where IdActividad=".$IdActividad;
					$resultConsulta_Act = $catalogo->obtenerLista($consulta_actividades);
					while ($row_act = mysqli_fetch_array($resultConsulta_Act)) {
						array_push($array_act, $IdActividad);
						$IdActividad= $row_act['IdActividadSuperior'];
						
					}
					$contador_act--;
				}
				array_push($array_act, $IdActividad);
				$total_datos= count($array_act)-1;
				$con_array=1;
				//asort($array_act);
				//print_r($array_act);
				while( 0 <=$total_datos){
					$total_datoss=$total_datos+1;
					$contador_act= "setId_actividad".$con_array;
					$objAA->$contador_act($array_act[$total_datos]);
					$total_datos--;
					$con_array++;
				}
				$objAA->setId_tipo(1);
				if($no_relacion=="si"){
					if($objAA->editaracuerdoac()){
					}else{	
					}
				}else{
					if($objAA->acuerdoac()){
						//$IdArchPreliminar = $objAC->getId_documento();
						}else{
					}
				}
				//Esto es para el entregable especifico
				$avance=0;
				if($tipo==9){ //preliminar
					$avance=33;
				}elseif($tipo==14){// en proceso
					$avance=66;
				}else{
					$avance=100;// Final
				}
				$consulta_entreglables= "SELECT ce.IdEntregable, ce.Descripcion	FROM
					c_entregable AS ce 
					WHERE idActividad = '$IdActividad_inicial';";//echo "<br>";
					$resultentre = $catalogo->obtenerLista($consulta_entreglables);
					while ($row = mysqli_fetch_array($resultentre)) {
						$IdEntregable= $row['IdEntregable'];
						$Descripcion= $row['Descripcion'];
					}

				$EE->setIdEntregable($IdEntregable);
				$EE->setDescripcion($Descripcion);
				$EE->setIdExp($IdExposicion_e);
				$EE->setAvance($avance);
				$EE->setIdArchFinal($IdArchPreliminar);
				$EE->setIdLibro($IdLibro);

				if($EE->new_entregable()){
						//$IdArchPreliminar = $objAC->getId_documento();
				}else{
				}
				//Aqui terminamos entregable especifico
				 $valor= $IdArchPreliminar;
				

				if(isset($val->Relacion) && $val->Relacion!=""){
					$relacion= $val->Relacion;
				}else{
					
					if($val->tabla=="c_libro" || $idtext==""){
						$relacion="	INNER JOIN c_textosLibro on c_textosLibro.IdLibro = $val->tabla.IdLibro";
					}else{
						$relacion="	INNER JOIN c_textosLibro on c_textosLibro.IdTexto = $val->tabla.IdTexto";
					}
				}
				if(isset($idtext) && $idtext!=""){
					$datos_texto="and c_textosLibro.IdTexto=$idtext";
				}else{
					$datos_texto="";
				}
				$NombreIDEntidad=$val->NombreIDEntidad;
				$NombreIDEntidad2=$val->NombreIDEntidad;
				//echo $relacion;
				if($val->tabla!="c_textosLibro"){
					if($val->tabla=="c_libro"){
						$dato_registro="SELECT * FROM $val->tabla 		
						WHERE c_libro.IdLibro=$IdLibro  ";
					}else{
				 		$dato_registro="SELECT * FROM $val->tabla $relacion			
						WHERE c_textosLibro.IdLibro=$IdLibro $datos_texto ";
					}
				}else{
					$dato_registro="SELECT * FROM $val->tabla
									
									WHERE c_textosLibro.IdLibro=$IdLibro $datos_texto ";
				}
				//echo $dato_registro;
									///*INNER JOIN c_textosLibro on c_textosLibro.$NombreIDEntidad2= $val->tabla.$NombreIDEntidad */
				$ejecuta_dato= $catalogo->obtenerLista($dato_registro);
				if(!isset( $parametros['IdTexto']) && $IdLibro!=""){
					if($valor!=""){
						if(mysqli_num_rows($ejecuta_dato)==0){
							$inserta="INSERT INTO  $val->tabla (IdLibro,".$val->campo." ) VALUES('".$IdLibro."',$valor)";
							$resultConsulta = $catalogo->obtenerLista($inserta);

						}else{
							$actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' 
												WHERE IdLibro=$IdLibro;";
							$resultConsulta = $catalogo->obtenerLista($actualizacion1);
						}
					}
				}else{
					if($valor!=""){
						if(mysqli_num_rows($ejecuta_dato)==0){
							$inserta="INSERT INTO  $val->tabla (IdTexto,".$val->campo." ) VALUES('".$idtext."',$valor)";
							$resultConsulta = $catalogo->obtenerLista($inserta);

						}else{
							$actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' 
												WHERE c_textosLibro.$where_idtext;";
							$resultConsulta = $catalogo->obtenerLista($actualizacion1);
						}
					}
				}
				$images++;
			}elseif(isset($parametros['Chlist'.$conta]) && $parametros['Chlist'.$conta]==1){
			
				 $ruta ='siedatos/evidencia/';
				//secho $conta;echo "<br>";
				if (isset($parametros['Chlist'.$conta]) /*&& $parametros['Chlist'.$conta]==1*/) {
				/*	echo "  prueba2   ".$conta." ".$images."<br>";
					if (isset($_FILES[$images])) {
						echo $_FILES[$images]['name']." ".$conta." ".$images."<br>";
					}*/
				}
				if (isset($_FILES[$images]) && !empty($_FILES[$images]) ) {
					$abd="";
					//echo $_FILES[$images]['name'];
						if (file_exists("../../../" . $ruta . $_FILES[$images]['name'])) {
							//echo "2";
							$archivo = $_FILES[$images]['name'];
							$resultado = str_replace(" ", "_",$archivo);
							$explode = explode('.',  $resultado);
							$extension = array_pop($explode);
							$nombre = $_FILES[$images]['name'];
							$nameimg = 'siedatos/evidencia/' . $images . $archivo;
							$namesoloimagen= "$images".$archivo;
							$archivo="$images".$archivo;
							$abd=$images . $archivo;
						//echo $nameimg."asd";
						move_uploaded_file($_FILES[$images]["tmp_name"], $nameimg  );
					   } else {
						//echo "1	";
							$archivo = $_FILES[$images]['name'];
							$resultado = str_replace(" ", "_",$archivo);
							$explode = explode('.', $resultado);
							$extension = array_pop($explode);
							$nombre = $_FILES[$images]['name'];
							$nameimg = 'siedatos/evidencia/'. $images .  $resultado;
							$namesoloimagen= $resultado;
							$abd=$images . $resultado;
						//	echo $nameimg;
						move_uploaded_file($_FILES[$images]["tmp_name"],'../../../../'. $nameimg  );
						}
						
							//$file_name = $_FILES[$conta]['name']; "../../../" .
							
			
						//move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
			
					$IdEntregable="";
					$IdEntregable_especific="";
					$valor_CL="";
					$consulta_entreglables= "SELECT ce.IdEntregable, cee.IdEntregEspecifico	FROM
					c_entregable AS ce INNER JOIN c_entregableEspecifico AS cee ON cee.IdEntregable = ce.IdEntregable 
					WHERE idActividad = '$IdActividad_inicial';";//echo "<br>";
					$resultentre = $catalogo->obtenerLista($consulta_entreglables);
					while ($row = mysqli_fetch_array($resultentre)) {
						$IdEntregable= $row['IdEntregable'];
						$IdEntregable_especific= $row['IdEntregEspecifico'];
					}
					if(isset($parametros[$val->campo.$conta.$conta.$conta])){
						 $valor=1;
					}else{
						 $val->campo.$conta.$conta.$conta;
						
					}
					if($idtext==""){
						$idtext="NULL";
					}
					$valor_CL=$parametros['VC'.$conta];
					if($idtext=="" || $idtext=="NULL"){
						$valor_id_texto= "";
						$idtext=0;
					}else{
						$valor_id_texto= " and IdTexto='$idtext'";
					}
					 $k_entrtregables = "SELECT * FROM k_entregableEspecifCheckList eech JOIN
										c_entregableEspecifico ee ON ee.IdEntregEspecifico=eech.IdEntregEspecif 
										WHERE ee.IdEntregable=$IdEntregable and IdChecklist = $valor_CL and eech.IdLibro =$IdLibro $valor_id_texto;";
					$resutl_k = $catalogo->obtenerLista($k_entrtregables);
					if($abd!=""){
						if(mysqli_num_rows($resutl_k)==0){
							$insert= "INSERT INTO k_entregableEspecifCheckList (IdEntregEspecif, IdCheckList, Valor, FechaValor, UsrValor, IdEntregable, IdLibro, evidencia, IdTexto) 
									VALUES ('$IdEntregable_especific',$valor_CL,1,NOW(),'103','$IdEntregable','$IdLibro', '$abd',$idtext);";
							$catalogo->obtenerLista($insert);
						}else{
							$actualiza_check= "UPDATE k_entregableEspecifCheckList SET evidencia='$abd', /*IdCheckList=$valor_CL,*/ IdEntregable='$IdEntregable', 
												Valor=1, IdTexto='$idtext'  WHERE IdLibro=$IdLibro and IdCheckList=$valor_CL $valor_id_texto;";
							$catalogo->obtenerLista($actualiza_check);
						}
					}
					
				} else {

					//echo $images."aasd";

					if (isset($_FILES[$images])) {
						//echo $images."aasd";
				   }
					//echo $_FILES[$conta]['name']."<br>";
				}
				$images++;
				$dato_actualizado=1;
			}elseif($dato_actualizado==0){
				
				if($val->tabla!="c_textosLibro"){
					if(isset($val->Relacion) && $val->Relacion!=""){
						$relacion= $val->Relacion;
					}else{
						
						if($val->tabla=="c_libro" || $idtext=="" || $idtext=="NULL"){
							$relacion="	INNER JOIN c_textosLibro on c_textosLibro.IdLibro = $val->tabla.IdLibro";
						}else{
							$relacion="	INNER JOIN c_textosLibro on c_textosLibro.IdTexto = $val->tabla.IdTexto";
						}
					}
					if(isset($idtext) && ($idtext!="" && $idtext!="NULL")){
						$datos_texto="and c_textosLibro.IdTexto=$idtext";
					}else{
						$datos_texto="";
					}
					
					if (isset($_FILES[$images]) && !empty($_FILES[$images]) && (!isset($parametros['Chlist'.$conta]) || $parametros['Chlist'.$conta]==0)) {	
						  $ruta=$val->RutaGuarda;	
						 $_FILES[$images]['name'];
						if (file_exists("../../../../" . $ruta . $_FILES[$images]['name'])) {
							//echo "2";
							/*$cadena=$_FILES[$images]['name'];
							$cadena =str_replace(' ', '', $cadena);*/
							$archivo = $_FILES[$images]['name'];
							$resultado = str_replace(" ", "_",$archivo);
							$explode = explode('.',  $resultado);
							$extension = array_pop($explode);
							$nameimg = $ruta."/". $images . $archivo;
							$namesoloimagen= "$images".$archivo;
							$archivo="$images".$archivo;
							$abd=$images . $archivo;
							//move_uploaded_file($_FILES[$images]['tmp_name'], "../../../../" . $nameimg);
        
						}else{
							//echo "1	";
							$archivo = $_FILES[$images]['name'];
							$resultado = str_replace(" ", "_",$archivo);
							$explode = explode('.', $resultado);
							$extension = array_pop($explode);
							$nameimg = $ruta."/". $resultado;
							$namesoloimagen= $resultado;
							$abd=$images . $resultado;
							//echo "1	";
						}
						move_uploaded_file($_FILES[$images]['tmp_name'], "../../../../" . $nameimg);
						$valor=$resultado;
					}else{
						if(isset($parametros[$id_c])){
							$valor = $parametros[$id_c];
						}else{
							$valor="";
							$parametros[$val->campo]="";
						}
						
					}
					if($valor=="on")
					{
						$valor=1;
					}
					//echo "<br>".$valor."".$images."<br>";
					$NombreIDEntidad=$val->NombreIDEntidad;
					$NombreIDEntidad2=$val->NombreIDEntidad;
					
					$cadena_de_texto = "SELECT * FROM $val->tabla $relacion";
					$cadena_buscada   = 'c_textosLibro';
					if($val->tabla!="c_libro"){
						$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
						if ($posicion_coincidencia === false) {
							$dato_registro="SELECT * FROM $val->tabla $relacion
											WHERE c_libro.IdLibro=$IdLibro $datos_texto ";
						}else{
							$dato_registro="SELECT * FROM $val->tabla $relacion
											WHERE c_textosLibro.IdLibro=$IdLibro $datos_texto ";
						}
					}else{
						$dato_registro="SELECT * FROM $val->tabla
											WHERE IdLibro=$IdLibro ";
					}
					 // echo $dato_registro;
										/*INNER JOIN c_textosLibro on c_textosLibro.$NombreIDEntidad2= $val->tabla.$NombreIDEntidad */
					/*echo $val->tabla.$valor; */
					//echo "<br>";echo "<br>";
					$ejecuta_dato= $catalogo->obtenerLista($dato_registro);
					if(!isset( $parametros['IdTexto']) && $IdLibro!=""){
						if($valor!="" ){
							if(mysqli_num_rows($ejecuta_dato)==0){
								echo $inserta="INSERT INTO  $val->tabla(IdLibro ,".$val->campo.") VALUES('".$IdLibro."','".$valor."')";
								//echo "<br>";echo "<br>";
								$resultConsulta = $catalogo->obtenerLista($inserta);
							}else{
								  $actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' 
													WHERE IdLibro=$IdLibro;";
							//echo "<br>";echo "<br>";				
								$resultConsulta = $catalogo->obtenerLista($actualizacion1);
							}
						}
					}else{
						if($valor!="" ){
							if(mysqli_num_rows($ejecuta_dato)==0){
								  $inserta="INSERT INTO  $val->tabla (".$val->campo.") VALUES('".$valor."')";
								//echo "<br>";echo "<br>";
								$resultConsulta = $catalogo->obtenerLista($inserta);
								//echo $resultConsulta."asd ";
								if($resultConsulta!=1){
									$inserta="INSERT INTO  $val->tabla (".$val->campo.",IdTexto) VALUES('".$valor."', '".$idtext."')";
									$resultConsulta = $catalogo->obtenerLista($inserta);

								}

							}else{
								  $actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' 
													WHERE IdTexto=$idtext;";
								//echo "<br>";echo "<br>";
							$resultConsulta = $catalogo->obtenerLista($actualizacion1);
							//echo $resultConsulta."asdasd ";

							}
						}
					}	
					$valor="";
				}else{
						$relacion= $val->Relacion;
		
					if(isset($idtext) && ($idtext!="" && $idtext!="NULL")){
						$datos_texto="and c_textosLibro.IdTexto=$idtext";
					}else{
						$datos_texto="";
					}
					
					if (isset($_FILES[$images]) && !empty($_FILES[$images]) && (isset($parametros['Chlist'.$conta]) && $parametros['Chlist'.$conta]==0)) {	
						  $ruta=$val->RutaGuarda;	
						 $_FILES[$images]['name'];
						if (file_exists("../../../../" . $ruta . $_FILES[$images]['name'])) {
							//echo "2";
							/*$cadena=$_FILES[$images]['name'];
							$cadena =str_replace(' ', '', $cadena);*/
							$archivo = $_FILES[$images]['name'];
							$resultado = str_replace(" ", "_",$archivo);
							$explode = explode('.',  $resultado);
							$extension = array_pop($explode);
							$nameimg = $ruta."/". $images . $archivo;
							$namesoloimagen= "$images".$archivo;
							$archivo="$images".$archivo;
							$abd=$images . $archivo;
							//move_uploaded_file($_FILES[$images]['tmp_name'], "../../../../" . $nameimg);
        
						}else{
							//echo "1	";
							$archivo = $_FILES[$images]['name'];
							$resultado = str_replace(" ", "_",$archivo);
							$explode = explode('.', $resultado);
							$extension = array_pop($explode);
							$nameimg = $ruta."/". $resultado;
							$namesoloimagen= $resultado;
							$abd=$images . $resultado;
							//echo "1	";
						}
						move_uploaded_file($_FILES[$images]['tmp_name'], "../../../../" . $nameimg);
						$valor=$resultado;
					}else{
						if(isset($parametros[$id_c])){
							$valor = $parametros[$id_c];
						}else{
							$valor="";
							$parametros[$val->campo]="";
						}
					}
					if($valor=="On")
					{
						$valor=1;
					}
					$NombreIDEntidad=$val->NombreIDEntidad;
					$NombreIDEntidad2=$val->NombreIDEntidad;
					  $dato_registro="SELECT * FROM $val->tabla $relacion
										WHERE c_textosLibro.IdLibro=$IdLibro $datos_texto ";
										/*INNER JOIN c_textosLibro on c_textosLibro.$NombreIDEntidad2= $val->tabla.$NombreIDEntidad */
					
					// $valor; 
					// "<br>";echo "<br>";
					$ejecuta_dato= $catalogo->obtenerLista($dato_registro);
					if(!isset( $parametros['IdTexto']) && $IdLibro!=""){
						if($valor!="" ){
							if(mysqli_num_rows($ejecuta_dato)==0){
								 $inserta="INSERT INTO  $val->tabla(IdLibro ,".$val->campo.") VALUES('".$IdLibro."','".$valor."')";
								//echo "<br>";echo "<br>";
								$resultConsulta = $catalogo->obtenerLista($inserta);
							}else{
								  $actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' 
													WHERE IdLibro=$IdLibro;";
							//echo "<br>";echo "<br>";				
								$resultConsulta = $catalogo->obtenerLista($actualizacion1);
							}
						}
					}else{
						if($valor!=""){
							if(mysqli_num_rows($ejecuta_dato)==0){
								 $inserta="INSERT INTO  $val->tabla (".$val->campo.") VALUES('".$valor."')";
								//echo "<br>";echo "<br>";
								$resultConsulta = $catalogo->obtenerLista($inserta);

							}else{
								 $actualizacion1= "UPDATE $val->tabla SET $val->campo='$valor' 
													WHERE IdTexto=$idtext;";
								//echo "<br>";echo "<br>";
							$resultConsulta = $catalogo->obtenerLista($actualizacion1);
							}
						}
					}$valor="";
				}//echo "<br>";echo "<br>";
				$NombreIDEntidad="";
				$NombreIDEntidad2="";
				$dato_actualizado=0;
			}
			/*if (isset($_FILES[$conta])) {
				//echo $conta;echo " prueba  ".$images."<br>";
				echo $_FILES[$conta]['name']." ".$conta." ".$images."<br>";
			}*/
			if (isset($parametros['Chlist'.$conta]) && $parametros['Chlist'.$conta] ==0 /*&& $parametros['Chlist'.$conta]==1*/) {

				
				$images++;
				
			}
			$conta++;
			//echo $conta."<br>";
		}

		echo "Actualización Correcta";
	}
}


?>