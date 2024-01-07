<?php

    define('DB_HOST','162.253.124.160'); 
    define('DB_USER','sie2020produsr'); 
    define('DB_PASS','siiee2020$pr0D.y9'); 
    define('DB_NAME','SIE2020produ'); 
    define('DB_CHARSET','utf8'); 

	$idInsumo = $_POST["idInsumo"];
	$numeroActividad = $_POST["numeroActividad"];
	$nombreActividad = $_POST["nombreActividad"];
	$nombreEntregable = $_POST["nombreEntregable"];
	$nombreEje = $_POST["nombreEje"];
	
	/*$idInsumo = 17;
	$numeroActividad = "7.2.2.2";
	$nombreActividad = "ejemplo";
	$nombreEntregable = "hshshy";
	$nombreEje = "expos";*/
	/*
	echo $idInsumo."<br>";
	echo $numeroActividad."<br>";
	echo $nombreActividad."<br>";
	echo $nombreEntregable."<br>";
	echo $nombreEje."<br>";*/
	
	//idInsumo,numeroActividad,nombreActividad,nombreEje
	
	
	
	
class ConexionPDO extends PDO
{
	public function __construct()
	{
		try
		{
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			$this->query("SET NAMES 'utf8'");
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}


	$conexion = new ConexionPDO();

	$consulta = $conexion -> prepare("SELECT i.IdInsumo, e.IdEntregable, e.Nombre, a.Id_Area as idArea, a.Nombre as area, p.Nombre AS nombreP, p.Apellido_Paterno AS apellido, ej.orden AS o0, ej.orden as orden, act4.Orden AS o4, act3.Orden AS o3, act2.Orden AS o2, act1.Orden AS o1, ej.idEje, act4.IdActividad AS id4,act4.Nombre AS n4, act3.IdActividad AS id3,act3.Nombre AS n3, act2.IdActividad AS id2,act2.Nombre AS n2, act1.IdActividad AS id1, act1.Nombre AS n1 
	FROM k_entregableinsumo i INNER JOIN c_entregable e ON i.IdEntregable = e.IdEntregable LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable   
	WHERE i.IdInsumo =  ".$idInsumo);

	$consulta -> execute();
	$cadena = "";
	$cadena2 = "";
	$cadenaEjes = "";
	$i = 2;
	
	$cadenaEjes2 = "";
	

	if($consulta -> rowCount() >0)
	{
		while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
		{
			extract ($row);
			$cadena.= "{id:".(int)$i.",label: '".$area."',title: 'Entregable:".$Nombre."',x:10, y:-30},";
			$cadena2.= "{from:1,to:".(int)$i.",arrows:'to'},";
			
			$cadenaEjes.= "{id:92,label: 'eje 2','color':'#ff9800'},";
			
			$cadenaEjes2.= "{from: ".$i.", to: 9".$orden.", arrows:'to', dashes:true},";
			
			
			$i++;
		}
			
		   /* echo $cadena;
			echo $cadena2;*/
	}
	
	
	$consulta = $conexion -> prepare("SELECT count(*) as total ,   ej.idEje as idEje, ej.Nombre, ej.orden
	FROM k_entregableinsumo i INNER JOIN c_entregable e ON i.IdEntregable = e.IdEntregable LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable   
	WHERE i.IdInsumo =  ".$idInsumo." group by ej.idEje");

	$consulta -> execute();
	$cadenaEjes = "";
	

	if($consulta -> rowCount() >0)
	{
		while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
		{
			extract ($row);		
			$cadenaEjes.= "{id:9".$orden.",label: '".$orden.". ".$Nombre."','color':'#f1d173'},";
			
		}
			
	}
	
	
	/*$consulta = $conexion -> prepare("select * from c_eje where idEje =".$idEje);

	$consulta -> execute();
	$nombreEje = "";

	if($consulta -> rowCount() >0)
	{
		while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
		{
			extract ($row);
			$nombreEje = $orden.". ".$Nombre;
		}
			
		   // echo $cadena;
	}*/
	
	$consulta = $conexion -> prepare("SELECT count(distinct a.Id_Area) as total 
	FROM k_entregableinsumo i INNER JOIN c_entregable e ON i.IdEntregable = e.IdEntregable LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable   
	WHERE i.IdInsumo = ".$idInsumo);

	$consulta -> execute();
	$totalAreas = 0;

	if($consulta -> rowCount() >0)
	{
		while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
		{
			extract ($row);
			$totalAreas = $total;
		}
			
		   // echo $cadena;
	}
	
	$consulta = $conexion -> prepare("SELECT count(distinct ej.idEje) as total 
	FROM k_entregableinsumo i INNER JOIN c_entregable e ON i.IdEntregable = e.IdEntregable LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable   
	WHERE i.IdInsumo = ".$idInsumo);

	$consulta -> execute();
	$totalEjes = 0;

	if($consulta -> rowCount() >0)
	{
		while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
		{
			extract ($row);
			$totalEjes = $total;
		}
			
		   // echo $cadena;
	}
	
	$conexion = null;


?>

<!doctype html>
<html>
<head>
  <title>Network | Basic usage</title>

  <script type="text/javascript" src="vis.js"></script>
  <link href="vis-network.min.css" rel="stylesheet" type="text/css" />

  <style type="text/css">
    #mynetwork {
      width: 620px;
      height: 520px;
      border: 1px solid lightgray;
    }
	.dates{
		/*border: 1px solid lightgrey;*/
    position: absolute;
    left: 639px;
    top: 50px;
    width: 194px;
    font-size: 12px;
    font-family: 'Muli-SemiBold';
	text-align: center;
	}
  </style>
</head>
<body>
<p style="font-size: 12px; font-family: 'Muli-Bold';">Áreas y Ejes que participan en la actividad <?php echo $numeroActividad." ".$nombreActividad ;?><p>

<div class="dates">
	<p style="background-color: #97c2fc; border: 1px solid #0954a5;box-shadow: 0 0 3px;">Áreas participando : <?php echo $totalAreas;?></p>
	<br>
	<p style="background-color: #f1d173;border: 1px solid #ffc107;box-shadow: 0 0 3px;">Ejes participando : <?php echo $totalEjes;?></p>
</div>
<div id="mynetwork"></div>

<script type="text/javascript">
  // create an array with nodes
  var nodes = new vis.DataSet([
    {id: 1, label: '<?php echo $numeroActividad;?>',title: 'Eje: <?php echo $nombreEje;?> <br> Actividad: <?php echo $nombreActividad; ?> <br> Entregable: <?php echo $nombreEntregable;?>',"color":"#e9e7e6",x:10, y:-30, fixed:true},
   
	
    /*{id: 1, label: 'Actividad 0',x:10, y:-30},
	{id: 3, label: 'Actividad 1',x:10, y:-30},
	{id: 4, label: 'Actividad 2',x:10, y:-30},
	{id: 5, label: 'Actividad 3',x:10, y:-30},
	{id: 6, label: 'Actividad 4',x:10, y:-30},*/
	<?php echo $cadena;?>
	<?php echo $cadenaEjes;?>
   
  ]);

  // create an array with edges
  var edges = new vis.DataSet([
  
  <?php echo $cadena2;?>
  <?php echo $cadenaEjes2;?>
  // {from: 1, to: 3, arrows:'to', dashes:true},
    /*{from: 1, to: 2, arrows:'to'},
	{from: 1, to: 3, arrows:'to'},
	{from: 1, to: 4, arrows:'to'},
	{from: 1, to: 5, arrows:'to'},
	{from: 1, to: 6, arrows:'to'},
	{from: 1, to: 7, arrows:'to'},
	{from: 1, to: 8, arrows:'to'},
	{from: 1, to: 9, arrows:'to'},
	{from: 1, to: 10, arrows:'to'},
	{from: 1, to: 11, arrows:'to'},*/
    /*{from: 1, to: 2, arrows:'to, from'},
    {from: 2, to: 4, arrows:'to, middle'},
    {from: 2, to: 5, arrows:'to, middle, from'},
    {from: 5, to: 6, arrows:{to:{scaleFactor:2}}},
    {from: 6, to: 7, arrows:{middle:{scaleFactor:0.5},from:true}}*/
	
	/*{from: 2, to: 98, arrows:'to', dashes:true},
	{from: 3, to: 97, arrows:'to', dashes:true},
	{from: 4, to: 97, arrows:'to', dashes:true},
	{from: 5, to: 97, arrows:'to', dashes:true},
	{from: 6, to: 97, arrows:'to', dashes:true},
	{from: 7, to: 98, arrows:'to', dashes:true},
	{from: 8, to: 911, arrows:'to', dashes:true},
	{from: 9, to: 92, arrows:'to', dashes:true},
	{from: 10, to: 99, arrows:'to', dashes:true},
	{from: 11, to: 97, arrows:'to', dashes:true},*/
	
  ]);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes,
    edges: edges
  };
  var options = {
	  edges: {
      arrows: {
        to: {
          scaleFactor: 1
        }
      }
    }
  };
  var network = new vis.Network(container, data, options);
  
  

  
</script>


</body>
</html>
