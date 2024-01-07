<?php 
class InvitadoModel extends Model {

	public	function __construct() {
		parent::__construct();
	}

	function getInvitados($datos) {
		try {
			$invitados = [];
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('SELECT ca.idArea, a.Nombre, ca.orden, ca.estatus, ca.fechaSalida from k_conversacionArea ca inner join c_area a on ca.idArea = a.Id_Area WHERE ca.idConversacion = :idConv order by orden');
			if($consulta -> execute([
			':idConv' => $datos['idConversacion']
			])) {
				while($row = $consulta->fetch()) {
					$inv = new Invitado();
					$inv -> setIdArea($row['idArea']);
					$inv -> setArea($row['Nombre']);
					$inv -> setOrden($row['orden']);
					$inv -> setEstatus($row['estatus']);
					$inv -> setFechaSalida($row['fechaSalida']);
					array_push($invitados,$inv);
				}
				return $invitados;
			} else {
				echo 'Error al cargar invitados ';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function guardarNuevosInvitados($idConversacion, $invitados,$invitadosR) {
		try {
			$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
			$fecha = $date->format('Y-m-d H:i');
			$base = $this -> db -> connect();
			$i = 0;
			$consulta = $base -> prepare('SELECT MAX(cA.orden) AS orden FROM k_conversacionArea cA WHERE cA.idConversacion = :idConversacion');
			if($consulta -> execute([
			':idConversacion' => $idConversacion
			])) {
				while($row = $consulta->fetch()) {
					$i = $row['orden'];
				}
			} else {
				echo 'Error al cargar invitados ';
			}
			if($i > 0){
				$i++;
				if(isset($invitados)) {
					foreach ($invitados as $inv) {
						/*echo $idConversacion.', '.$inv.', '.$i;*/
						
						$consulta2 = $base -> prepare('insert into k_conversacionArea (idConversacion,idArea,orden,estatus,fechaAlta) values (:idConv,:idArea,:orden,1,:fecha)');
						if($consulta2 -> execute([
						':idConv' => $idConversacion, 
						':idArea' => $inv,
						':orden' => $i,
						':fecha' => $fecha
						])) {
							$i += 1 ;
						} else {
							echo 'Error al guardar al conversador participante: '.$i;
						}
					}
				}
				if(isset($invitadosR)) {
					foreach ($invitadosR as $inv) {
						/*echo $idConversacion.', '.$inv.', '.$i;*/
						
						$consulta2 = $base -> prepare('UPDATE k_conversacionArea set estatus = 1 WHERE idConversacion = :idConv and idArea = :idArea');
						if($consulta2 -> execute([
						':idConv' => $idConversacion, 
						':idArea' => $inv
						])) {

						} else {
							echo 'Error al guardar al restaurar participante';
						}
					}
				}
			}
			
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>