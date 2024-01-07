<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./CSS/bootstrap.css">
    <link rel="stylesheet" href="./CSS/bootstrap-select.css">
    <link rel="stylesheet" href="./CSS/fontawesome/css/all.css">
    <link rel="stylesheet" href="./CSS/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="./CSS/datatables.css">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/ejes.css">
    <link rel="stylesheet" href="./JS/example.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">

    <link rel="stylesheet" href="./CSS/morris.css">

    <title>Document</title>
</head>

<body>
<div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1">Indicadores</a> / <a style="color:#fefefe;" href="portada_indicadores.php">Portada opiniones</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Opiniones detalle</a></div>
    <div class="container">
        <div class="row">


        <div class="container"  style="padding-top:5%;">
        <div class="row">
        <div class="col-12">
            <div class="form-group">
            <label for="">Selecciona una fecha</label>
        <select class="form-control" name="fechaMetricas" id="fechaMetricas">
        <option>2010</option>
        <option>2011</option>
        <option>2012</option>
        <option>2013</option>
        <option>2014</option>
        <option>2015</option>
        <option>2016</option>
        <option>2017</option>
        <option>2018</option>
        <option>2019</option>
        <option selected>2020</option>
        <option>2021</option>
        </select>

            </div>
        </div>
        <div class="col-8"  style="display: none">
          <div class="form-group">
            <label for="">Selecciona una exposición</label>
                <select class="form-control" name="select_exposiciones" id="select_exposiciones">
                </select>
          </div>
        </div>
        <div class="col-6 border" style="display: none">
        <p class="text-center">
                <div id="idCheck" class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="DivOpinion" id="Todos" value="Todos">
                    <label class="form-check-label" for="inlineRadio1">Todos</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="DivOpinion" id="Atendidas" value="Atendidas">
                    <label class="form-check-label" for="inlineRadio2">Atendidas</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="DivOpinion" id="Pendientes" value="Pendientes" >
                    <label class="form-check-label" for="inlineRadio3">Pendientes</label>
                </div>

        </p>
        </div>
        <div class="col-6 border" style="display: none">
        <p class="text-center">
                <div  id="idCheck" class="form-check form-check-inline">

                    <input class="form-check-input" type="radio" name="TipoOpinion" id="Todos2" value="Todos2">
                    <label class="form-check-label" for="Todos">Todos</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="TipoOpinion" id="Felicitacion" value="Felicitacion">
                    <label class="form-check-label" for="Felicitacion">Felicitación</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="TipoOpinion" id="Solicitud" value="Solicitud" >
                    <label class="form-check-label" for="Solicitud">Solicitud</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="TipoOpinion" id="Queja" value="Queja" >
                    <label class="form-check-label" for="Queja">Queja</label>
                </div>
        </p>
        </div>
        </div-->

            <div class="col-4 border text-center" style=" font-size: 1rem"> Opiniones Recibidas </div>
            <div class="col-8 border text-center" style=" font-size: 1rem">

                        <span class="badge badge-pill bg-dark text-white"> <i class="far fa-envelope"> </i>  <span id="opinionesRecibidas"> </span></span>

            </div>

            <div class="col-4 border text-center" style=" font-size: 1rem"> Opiniones Atendidas </div>
            <div class="col-8 border text-center" style=" font-size: 1rem">
                <span class="badge badge-pill bg-dark text-white"> <i class="fab fa-facebook-messenger"></i> <span id="opinionesAtendidas"></span></span>
            </div>


            <div class="col-4 border text-center"  style=" font-size: 1rem"> Opiniones Pendientes </div>
            <div class="col-8 border text-center"  style=" font-size: 1rem">
                <span class="badge badge-pill bg-dark text-white"> <i class="fas fa-check-double"></i> <span id="opinionesPendientes"></span></span>
            </div>

            <div class="col-4 border text-center"  style=" font-size: 1rem"> Histórico</div>
            <div class="col-8 border text-center"  style=" font-size: 1rem">
                <span class="badge badge-pill bg-dark text-white"> <i class="fas fa-chart-pie"></i> Histórico: (<span id="opinionesHistorico"></span>)  = Recibida: ( <span id="opinionesHistoricoRecibida"></span> ) + Turnada Eje: ( <span id="opinionesHistoricoAtendidaEje"></span>  )</span>
                <span class="badge badge-pill bg-dark text-white"> + Turnada Actividad: (  <span id="opinionesHistoricoTurnadaActividad"></span>  )+ Atendida: (  <span id="opinionesHistoricoAtendida"></span>  )</span>
            </div>

            <div class="col-4 border text-center"  style=" font-size: 1rem">Atendidas vs Pendientes</div>
            <div class="col-8 border"  style=" font-size: 1rem">
                <span id="progressBar"></span>
                <span id="progressBar2"></span>
            </div>
            <div class="col-4 border text-center"  style=" font-size: 1rem"> Tipo de opiniones</div>
            <div class="col-8 border"  style=" font-size: 1rem">
                <span id="progressBar3"></span>
            </div>
            <div class="col-4 border text-center"  style=" font-size: 1rem"> Origen opiniones</div>
            <div class="col-8 border text-center"  style=" font-size: 1rem">
                <span class="badge badge-pill bg-dark text-white"> <i class="fas fa-chart-pie"></i> Total: (<span id="opiniones_total"></span>)  = <i class="fab fa-internet-explorer"></i> ( <span id="opiniones_web"></span>
                 ) + Kiosko: ( <span id="opiniones_kioskos"></span>  ) + <i class="fa fa-book"></i> (  <span id="opiniones_escritas"></span>) + <i class="fab fa-facebook"></i>  (  <span id="opiniones_facebook"></span>
                 ) + <i class="fab fa-twitter"></i> (  <span id="opiniones_twitter"></span> )</span>
                <span class="badge badge-pill bg-dark text-white"> + Ger: (  <span id="opiniones_gerencia"></span>  ) + <i class="far fa-envelope"> </i> (  <span id="opiniones_correo"></span>
                ) + Otros: (  <span id="Opiniones_otros"></span> ) </span>


            </div>
            <div class="col-4 border text-center"  style=" font-size: 1rem"> Exposiciones Temporales</div>
            <div class="col-8 border text-left"  style=" font-size: .9rem">
                <span id="ExposicionesTempoxAnio"></span>
            </div>
        </div>
    </div>



        </div>
    </div>

    <div class="container">
 <div class="row">
 <div class="col-12">
 </br>
 <!--<button class="btn btn-outline-success btn-lg btn-block" id="mostrarGrafica" onclick="newGrf.CrearGraficaEjes(); newGrf.CrearGraficaArea()" > Mostrar Gráfica</button>
 <button class="btn btn-outline-warning btn-lg btn-block" id="RefreshGrafica" onclick="newGrf.RefreshGraficaEjes();newGrf.RefreshGraficaArea();" hidden > Refrescar Gráfica</button>-->
 </div>
 </div></div>

    <!-- Grafica -->

      <!--div id="columnchart_values" class="border m-2"></div-->
      <div class="container" >
       <div class="row">
         <div class="col-12 text-center"  style=" font-size: 1rem"> Opiniones por eje</div>
       </div>
      </div>

     <div class="container" >
    <div class="row">
        <div class="col-12">
        <div id="graph" style="height: 400px; width: 100%;  padding-bottom: 40px;"></div>
        </div>

    </div>
    </br>
    </br>
    </br>
     </div>
     <div class="container" >
      <div class="row">
        <div class="col-12 text-center"  style=" font-size: 1rem"> Opiniones por área</div>
      </div>
     </div>
      <div class="container">
      <div class="row">
          <div class="col-12">
          <div id="graphArea" style="height: 400px; width: 100%;  padding-bottom: 90px;"></div>
          </div>
      </div>
      </div>
      </br>
      </br>
      </br>
      <div class="container" >
       <div class="row">
         <div class="col-12 text-center"  style=" font-size: 1rem"> Opiniones por sub área</div>
       </div>
      </div>
       <div class="container">
       <div class="row">
           <div class="col-12">
           <div id="graph_subArea" style="height: 400px; width: 100%;  padding-bottom: 50px;"></div>
           </div>
       </div>
       </div>
     </br>
     </br>
     </br>
       <div class="container" >
        <div class="row">
          <div class="col-12 text-center"  style=" font-size: 1rem"> Opiniones atendidas por correo</div>
        </div>
       </div>
        <div class="container">
        <div class="row">
            <div class="col-12">
            <div id="graph_incidencias" style="height: 400px; width: 100%;  padding-bottom: 50px;"></div>
            </div>
        </div>
        </div>


    <div class="container">
      <!--div
      id="columnchart_values2" class="border m-2"></div-->
    </div>
    <div class="container" style="display: none">
      <div class="row">
        <div class="col-12">
          </br>
          <button class="btn btn-outline-success btn-lg btn-block" id="mostrarTabla" onclick="" >Mostrar tabla</button>
        </div>
      </div>
    </div>
    <div class="container" >
     <div class="row">
       <div class="col-12 text-center"  style=" font-size: 1rem"> Opiniones turnadas a actividad y pendientes de atender</div>
     </div>
    </div>
    <table class="table table-sm mt-2 table-hover table-bordered text-center" id="tblMetricas" >
        <thead >
           <tr id="eje"></tr>
           <tr id="conteoTotales"></tr>
        </thead>
        <tbody id="bodyMetricas">
        </tbody>
    </table>
    </br>
    <div class="container" >
     <div class="row">
       <div class="col-12 text-center"  style=" font-size: 1rem" id="sin_area"> Opiniones turnadas a actividad sin área : </div>
     </div>
    </div>
  


    <!-- Termina Grafica -->


    <script src="./JS/jquery.js"></script>
    <script src="./JS/popper.js"></script>
    <script src="./JS/bootstrap.js"></script>
    <script src="./JS/bootstrap-notify.js"></script>
    <script src="./JS/bootstrap-select.js"></script>
    <script src="./JS/bootbox.all.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="./JS/morris.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
    <script src="./JS/example.js"></script>

    <script src="./JS/typehead.js"></script>
    <script src="./CSS/fontawesome/js/all.js"></script>
    <script src="./JS/bootstrap-tokenfield.js"></script>
    <script src="./JS/datatables.js"></script>

    <script src="./JS/Reportes.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="./JS/grafica.js"></script>
    <script src="./JS/newGrafica.js"></script>
    <script src="./JS/eje.js"></script>
    <script src="./JS/area.js"></script>



    <!--script src="./JS/helper.js"></!--script>
    <script src="./JS/Instituciones.js"></script-->

    <script>
    </script>
</body>

</html>
