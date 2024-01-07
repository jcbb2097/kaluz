<!DOCTYPE html>
<html lang="es">
<head>
    <title>Actividades</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>

<style>
@import 'https://code.highcharts.com/css/highcharts.css';

#container {
	height: 400px;
	max-width: 800px;
	min-width: 320px;
	margin: 0 auto;
}
.highcharts-pie-series .highcharts-point {
	stroke: #EDE;
	stroke-width: 2px;
}
.highcharts-pie-series .highcharts-data-label-connector {
	stroke: silver;
	stroke-dasharray: 2, 2;
	stroke-width: 2px;
}
</style>
</head>
<body>

<?php

/* VIENE de JSP
  String idUsuario = request.getParameter("idUsuario");  
    
  Connection cna = CrearConexion();
  ResultSet rsa = null;
  ResultSet rsa2 = null;
  
  String nomEje = "";
  String ordenEje = "";
  int idProyarea = 0;
  String cadenaTabla = "";
  String sqlGlobalE = "";
  String sqlGeneralE = "";
  String sqlParticularE = "";
  String sqlSubE = "";
  String sqlRevision = "";
  String sqlRevisionVerde = "";
  int iGlobal = 0;
  int iGeneral = 0;
  int iParticular = 0;
  int iSub = 0;
  int iRevision = 0;
  int totalTodo = 0;
  double porcentaje =0;
  
  int totalGlobalE = 0;
  int totalGeneralE = 0;
  int totalParticularE = 0;
  int totalSubE = 0;
  int totalRevision = 0;
  int totalRevisionVerde = 0;
  
  int totH = 0;
  
  
  String sqlEjes = "Select id_proyarea as id_proyecto,descripcion,orden from Com_proyarea where prioridad not in (1,61,81) and estado=1 and orden<>999 order by orden";
  
  
  rsa = EjecutarQuery(sqlEjes,cna);
  while(rsa.next())
  {
    idProyarea = rsa.getInt("id_proyecto");
    nomEje = rsa.getString("descripcion");
    ordenEje = rsa.getString("orden");
    
    sqlRevisionVerde = "select count(*) as total from com_revisionactividad where estatus in (1) and idproyarea ="+idProyarea;
    
    rsa2 = EjecutarQuery(sqlRevisionVerde,cna);
    while(rsa2.next())
    {
        totalRevisionVerde = rsa2.getInt("total");    
       // cadenaTabla += "<tr><td>"+ordenEje+". "+nomEje+"</td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraAct("+idProyarea+")'>"+totalGlobalE+"<a></td><td></td><td></td><td></td><td></td></tr>";
        
    }    
    
    sqlRevision = "select count(*) as total from com_revisionactividad where estatus in (1,2) and idproyarea ="+idProyarea;
    
    rsa2 = EjecutarQuery(sqlRevision,cna);
    while(rsa2.next())
    {
        totalRevision = rsa2.getInt("total");    
       // cadenaTabla += "<tr><td>"+ordenEje+". "+nomEje+"</td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraAct("+idProyarea+")'>"+totalGlobalE+"<a></td><td></td><td></td><td></td><td></td></tr>";
        
    }
    iRevision = iRevision + totalRevision;
    
    sqlGlobalE = "select count(*) as total from com_actividadglobal g, com_proyarea p  where p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and g.anio = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999   and p.id_proyarea = "+idProyarea;
 
    rsa2 = EjecutarQuery(sqlGlobalE,cna);
    while(rsa2.next())
    {
        totalGlobalE = rsa2.getInt("total");    
       // cadenaTabla += "<tr><td>"+ordenEje+". "+nomEje+"</td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraAct("+idProyarea+")'>"+totalGlobalE+"<a></td><td></td><td></td><td></td><td></td></tr>";
        
    }
    iGlobal = iGlobal + totalGlobalE;
   
    sqlGeneralE = "select count(*) as total from com_actividadgeneral g, com_proyarea p, com_auxglobal_gral aux  where aux.id_actividadgeneral = g.id_actividadgeneral and p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and g.anio = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999   and p.id_proyarea = "+idProyarea;
    
    rsa2 = EjecutarQuery(sqlGeneralE,cna);
    while(rsa2.next())
    {
        totalGeneralE = rsa2.getInt("total");    
       // cadenaTabla += "<tr><td>"+ordenEje+". "+nomEje+"</td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraAct("+idProyarea+")'>"+totalGlobalE+"<a></td><td style='text-align:center'>"+totalGeneralE+"</td><tdstyle='text-align:center'></td><tdstyle='text-align:center'></td><td style='text-align:center'></td></tr>";
        
    }
    iGeneral = iGeneral + totalGeneralE;
    
    sqlParticularE = "select count(*) as total from com_actividadparticular g, com_proyarea p, com_actividadgeneral gral, com_auxglobal_gral aux  where aux.id_actividadgeneral = g.id_actividadgeneral and g.id_actividadgeneral = gral.id_actividadgeneral and p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and to_char(g.fecha,'yyyy') = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999   and p.id_proyarea = " +idProyarea;
    
    rsa2 = EjecutarQuery(sqlParticularE,cna);
    while(rsa2.next())
    {
        totalParticularE = rsa2.getInt("total");    
        //cadenaTabla += "<tr><td>"+ordenEje+". "+nomEje+"</td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraAct("+idProyarea+")'>"+totalGlobalE+"<a></td><td style='text-align:center'>"+totalGeneralE+"</td><td style='text-align:center'>"+totalParticularE+"</td><td style='text-align:center'></td><td style='text-align:center'></td></tr>";
        
    }
    iParticular = iParticular + totalParticularE;
    
    sqlSubE = "select count(*) as total from com_subactividad g, com_proyarea p, com_actividadparticular par  where g.id_actividadparticular = par.id_actividadparticular and g.id_actividadgeneral = par.id_actividadgeneral and p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and to_char(g.fecha,'yyyy') = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999   and p.id_proyarea = " +idProyarea;
    
    rsa2 = EjecutarQuery(sqlSubE,cna);
    while(rsa2.next())
    {
        totalSubE = rsa2.getInt("total");    
        
    }
    iSub = iSub + totalSubE;
    
    totH = totalGlobalE + totalGeneralE + totalParticularE + totalSubE;
    
   // porcentaje = ((double)totalRevision / totH)*100;
    porcentaje = ((double)totalRevisionVerde / totalGlobalE)*100;
    
    DecimalFormat df = new DecimalFormat("#.##");      
    porcentaje = Double.valueOf(df.format(porcentaje));  
    //out.println(porcentaje);
    cadenaTabla += "<tr><td>"+ordenEje+". "+nomEje+"</td><td>"+totalRevision+" &nbsp;&nbsp;<meter min='0' max='100' low='1' high='1' optimum='100' value='"+porcentaje+"'></meter> "+porcentaje+"% ("+totalRevisionVerde+")</td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo("+idProyarea+",1,"+totalGlobalE+")'>"+totalGlobalE+"</a></td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo("+idProyarea+",2,"+totalGeneralE+")'>"+totalGeneralE+"</a></td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo("+idProyarea+",3,"+totalParticularE+")'>"+totalParticularE+"</a></td><td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo("+idProyarea+",4,"+totalSubE+")'>"+totalSubE+"</a></td><td style='text-align:center'><b>"+totH+"</b></td></tr>";
        
  }
  
  totalTodo = iGlobal + iGeneral + iParticular + iSub;
  
  
  
  
  
  int totalGlobal = 0;
  int id_proyarea = 0;
  String eje = "";
  String cadena = "";
  String sqlGlobal = "select count(*) as total, p.id_proyarea, p.descripcion ,p.orden from com_actividadglobal g, com_proyarea p where p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and g.anio = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999   group by p.id_proyarea ,p.descripcion , p.orden order by p.orden asc";
  
  rsa = EjecutarQuery(sqlGlobal,cna);
  while(rsa.next())
  {
    totalGlobal = rsa.getInt("total");
    id_proyarea = rsa.getInt("id_proyarea");
    eje = rsa.getString("descripcion");
    
    cadena += "['"+id_proyarea+"','"+eje+"',"+totalGlobal+"],";
  }
  
  //out.println(cadena);
  String sqlTotGlobal = "select count(*) as total from com_actividadglobal g, com_proyarea p where p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and g.anio = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999",
         sqlTotGeneral = "select count(*) as total from com_actividadgeneral g, com_proyarea p where p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and g.anio = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999  ",
         sqlTotParticular = "select count(*) as total from com_actividadparticular g, com_proyarea p where p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and to_char(g.fecha,'yyyy') = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999 ",
         sqlTotSub = "select count(*) as total from com_subactividad g, com_proyarea p where p.id_proyarea = g.id_proyarea and g.tipoactividad = 1 and to_char(g.fecha,'yyyy') = 2019 and p.prioridad not in (1,61,81) and p.estado = 1 and p.orden<>999 ";
  
  int totGlobal = 0;
  int totGeneral = 0;
  int totParticular = 0;
  int totSub = 0;
  String cadena2 = "";
  
  rsa = EjecutarQuery(sqlTotGlobal,cna);
  while(rsa.next())
  {
    totGlobal = rsa.getInt("total");
  }
  rsa = EjecutarQuery(sqlTotGeneral,cna);
  while(rsa.next())
  {
    totGeneral = rsa.getInt("total");
  }
  rsa = EjecutarQuery(sqlTotParticular,cna);
  while(rsa.next())
  {
    totParticular = rsa.getInt("total");
  }
  rsa = EjecutarQuery(sqlTotSub,cna);
  while(rsa.next())
  {
    totSub = rsa.getInt("total");
  }
  
  cadena2 = "['1','Globales',"+totGlobal+"],['2','Generales',"+totGeneral+"],['3','Particulares',"+totParticular+"],['4','SubActividades',"+totSub+"]";
  
  rsa.close();
  rsa2.close();
  CerrarConexion(cna);
  
  */


$TotGlo=0;
$TotGen=0;
$TotPar=0;
$TotSub=0;
$TotTodo=0;
$TotFinal=0;
$Anio=2020;
$cadenaTabla="";
$idEje=0;

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
$catalogo = new Catalogo();

$sqlTodasLasActiv="
SELECT a.IdEje, CONCAT (a.IdEje,'. ', e.Nombre) AS nombreEje, 
( SELECT COUNT(*) FROM c_actividad ag WHERE ag.IdNivelActividad=1 AND ag.IdEje=a.IdEje AND ag.Anio=".$Anio.") AS TotGlo, 
( SELECT COUNT(*) FROM c_actividad ag WHERE ag.IdNivelActividad=2 AND ag.IdEje=a.IdEje AND ag.Anio=".$Anio.") AS TotGen, 
( SELECT COUNT(*) FROM c_actividad ag WHERE ag.IdNivelActividad=3 AND ag.IdEje=a.IdEje AND ag.Anio=".$Anio.") AS TotPar, 
( SELECT COUNT(*) FROM c_actividad ag WHERE ag.IdNivelActividad=4 AND ag.IdEje=a.IdEje AND ag.Anio=".$Anio.") AS TotSub, 
COUNT(*) AS TotEje 
FROM c_actividad a JOIN c_eje e ON a.IdEje=e.idEje
WHERE a.Anio=".$Anio." AND a.ideje<100 GROUP BY a.IdEje
"; /*cbc.20201109. Solo hay 11 ejes por eso se filtra para ideje<100 algunas activ se marcaron con eje mayor a 100 para no borrarlos*/

$resultActiv = $catalogo->obtenerLista($sqlTodasLasActiv);
while ($rowAc = mysqli_fetch_array($resultActiv)) {
	$idEje=$rowAc['IdEje'];
	$TotTodo=$rowAc['TotEje'];
	$cadenaTabla = $cadenaTabla."<tr><td>".$rowAc['nombreEje']."</td>
	<td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo(".$idEje.",1,".$rowAc['TotGlo'].")'>".$rowAc['TotGlo']."</a></td>
	<td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo(".$idEje.",2,".$rowAc['TotGen'].")'>".$rowAc['TotGen']."</a></td>
	<td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo(".$idEje.",3,".$rowAc['TotPar'].")'>".$rowAc['TotPar']."</a></td>
	<td style='text-align:center'><a style='cursor:pointer' onclick='muestraGlo(".$idEje.",4,".$rowAc['TotSub'].")'>".$rowAc['TotSub']."</a></td>
	<td style='text-align:center'><b>".$TotTodo."</b></td></tr>";
	$TotGlo=$TotGlo+$rowAc['TotGlo'];
	$TotGen=$TotGen+$rowAc['TotGen'];
	$TotPar=$TotPar+$rowAc['TotPar'];
	$TotSub=$TotSub+$rowAc['TotSub'];
	$TotFinal=$TotFinal+$TotTodo;
}

$cadena2 = "['1','Globales',".$TotGlo."],['2','Generales',".$TotGen."],['3','Particulares',".$TotPar."],['4','SubActividades',".$TotSub."]";

?>

<div class="fluid-container">
    
    <div class="row">
        <h3 style="text-align:center">Actividades <?php echo $Anio;?></h3><br>
    </div>
	
    <div class="row">
        <div class="col-md-12">
            
            <div class="table-responsive">
                <table id="table11" class="table table-bordered table-condensed">
                    <thead style="font-size:11px">
                        <tr>
                            <th>Eje</th>
                            <th style="text-align:center">Actividad Global:     <?php echo $TotGlo; ?></th>
                            <th style="text-align:center">Actividad General:    <?php echo $TotGen; ?></th>
                            <th style="text-align:center">Actividad Particular: <?php echo $TotPar; ?></th>
                            <th style="text-align:center">Sub-Actividad:        <?php echo $TotSub; ?></th>
                            <th style="text-align:center">Total: <?php echo $TotFinal; ?></th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 11px">
                        <?php echo $cadenaTabla; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
	
    <div class="row">
        <div class="col-md-12">
            <div id="div-container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="div-container2"></div>
        </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="myModal" role="dialog">
    <div style ="width:90%" class="modal-dialog modal-lg">
    <!-- Modal content-->
	<div class="modal-content">
            <div class="modal-header">
		<button onclick="cerrarMod()" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="tituloModal"></h4>
            </div>
            <div id="container-10">
                                                    
                                                    
							
            </div>
            <div class="modal-footer">
		<button onclick="cerrarMod()" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
	</div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="myModalGlobal" role="dialog">
    <div style ="width:90%" class="modal-dialog modal-lg">
    <!-- Modal content-->
	<div class="modal-content">
            <div class="modal-header">
		<button onclick="cerrarMod()" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="tituloModalGlobal"></h4>
            </div>
            <div id="container-100">
                                                    
                                                    
							
            </div>
            <div class="modal-footer">
		<button onclick="cerrarMod()" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
	</div>
    </div>
</div>



</body>

<script>

var chart;

chart = Highcharts.chart('div-container', {

    chart: {
        styledMode: true,
    
		//events: { load: requestData }
    },

    title: {
        text: 'Actividades'
    },
	subtitle: {
        text: ''
    },
	legend: {
        labelFormat: '{name} <span style="opacity: 0.4">{y}</span>'
    },

    xAxis: {
        categories: []
    },
    
    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                       // location.href = 'https://en.wikipedia.org/wiki/' +
					   //alert(this.options.id);
					   var id = this.options.id;
                                            
					   if(id === '1')
					   {
                                                $.post("nivelUno.php",{tipoActividad:1}, function( data ) 
                                                {
                                                    $( "#container-10" ).html( data );
                                                    $('#myModal').modal('show');
                                                    $("#tituloModal").html("<b>Actividades Globales</b>");
                                                });
					   }
                                           if(id === '2')
					   {
                                                $.post("nivelUno.php",{tipoActividad:2}, function( data ) 
                                                {
                                                    $( "#container-10" ).html( data );
                                                    $('#myModal').modal('show');
                                                    $("#tituloModal").html("<b>Actividades Generales</b>");
                                                });
                                            }
                                            if(id === '3')
					   {
                                                $.post("nivelUno.php",{tipoActividad:3}, function( data ) 
                                                {
                                                    $( "#container-10" ).html( data );
                                                    $('#myModal').modal('show');
                                                    $("#tituloModal").html("<b>Actividades Particulares</b>");
                                                });
                                            }
                                            if(id === '4')
					   {
                                                $.post("nivelUno.php",{tipoActividad:4}, function( data ) 
                                                {
                                                    $( "#container-10" ).html( data );
                                                    $('#myModal').modal('show');
                                                    $("#tituloModal").html("<b>Sub-Actividades</b>");
                                                });
                                            }
                    }
                }
            }
        }
    },

    series: [{
        type: 'pie',
        name:'Actividades',
        allowPointSelect: true,
        keys: ['id','name', 'y','z', 'selected', 'sliced'],
			
        data: [<?php echo $cadena2; ?>],
        showInLegend: true,
    },
	],
});

var ultimaFila = null;
var colorOriginal;
$(Inicializar);

function Inicializar() 
{
    $('#table11 tr').click(function () 
    {
        if (ultimaFila != null)
        {
            ultimaFila.css('color', colorOriginal)
        }
        colorOriginal = $(this).css('color');
        $(this).css('color', 'blue');
        ultimaFila = $(this);
    });
}
        
        
function muestraGlo(idProyarea,tipoActividad,numero)
{
    $.post("nivelDosTabla.php",{tipoActividad:tipoActividad,idProyarea:idProyarea,numero:numero,idUsuario:1}, function( data ) 
    {
        $( "#container-100" ).html( data );
        $('#myModalGlobal').modal('show');
	
    });
    
	
    var it = tipoActividad;
    
    if(it == "1")
    {
        $("#tituloModalGlobal").html("<b>Actividades Globales</b>");
    }
    if(it == "2")
    {
        $("#tituloModalGlobal").html("<b>Actividades Generales</b>");
    }
    if(it == "3")
    {
        $("#tituloModalGlobal").html("<b>Actividades Particulares</b>");
    }
    if(it == "4")
    {
        $("#tituloModalGlobal").html("<b>Sub-Actividades</b>");
    }
}
</script>

</html>
