<!DOCTYPE html>
<html lang="en">
<head>
    <!--  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/bootstrap.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/bootstrap-select.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/fontawesome/css/all.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/datatables.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/index.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/ejes.css">
    <link rel="stylesheet" href="../MetricasOpiniones/JS/example.css"> 
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
    <link rel="stylesheet" href="../MetricasOpiniones/CSS/img_recuadro.css">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/bootstrap.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/bootstrap-select.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/fontawesome/css/all.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/datatables.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/index.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/ejes.css">
    <link rel="stylesheet" href="./JS/example.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
    <link rel="stylesheet" href="../../apps/MetricasOpiniones/CSS/img_recuadro.css">
    <title>Portada indicadores</title>
</head>

<body>
<div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Portada Noticias</a></div>
<div class="container">
        <div class="row">
          <div class="container"  style="padding-top:5%;">
            <div class="row">
              <div class="col-4" >
                <div class="form-group" >
                    <label for="">Filtrar Año</label>
                    <select class="form-control" name="filtro_fecha" id="filtro_fecha">
                    <option  value="todos" selected>Todos los años</option>
                    </select>
                    <span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span>
                </div>
             </div>
             <div class="col-4">
               <div class="form-group">
                 <label for="">Filtrar Eje</label>
                 <select class="form-control" name="filtro_eje" id="filtro_eje">
                 <option value="todos" selected >Todos los ejes</option>
                 </select>
               </div>
            </div>
            <div class="col-4" >
              <div class="form-group">
                <label for="">Filtrar Área</label>
                <select class="form-control" name="filtro_area" id="filtro_area">
                <option value="todos" selected>Todas las áreas</option>
                </select>

              </div>
           </div>
          </div>
          <div class="row">
            <div class="col-4"  >
              <div class="form-group">
                <label for="">Selecciona una exposición</label>
                    <select class="form-control" name="select_exposiciones" id="select_exposiciones">                      
                    </select>

              </div>
            </div>
         </div>
        </div>
      </div>
  </div>

<div id="menu" style="margin-top:50px;">
      <div class="container-fluid" style="margin-bottom: 5%">
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas" >
                      <a href="./Home.php"><img class="img-i" src="./img/total opiniones 1-01.png" ></a>
                    <p class="cantidades" >Lugar de noticia <span id="total_opiniones" ></span></p>
                    <span id="opiniones_totales" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                      <a href="./Home.php"><img class="img-i" src="./img/por tipo-01.png" ></a>
                    <p class="cantidades" >Genero <span id="tipo_opiniones" ></span> </p>
                    <span id="opiniones_tipo" style=" font-size: .7rem"></span>
              </div>
                  <div class="col-sm-3 cajas" >
                      <a href="./Home.php"><img class="img-i" src="./img/origen-01.png" ></a>
                    <p class="cantidades" >Etapa <span id="origen_opiniones" ></span></p>
                    <span id="opiniones_origen" style=" font-size: .7rem"></span>
              </div>
          </div>
        </br>
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas">
                <a href="./Home.php"><img class="img-i" src="./img/por año-01.png" ></a>
                <p class="cantidades" >Tipo de medio <span id="total_anio" ></span></p>
                <span id="opiniones_anio" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                <a href="./Home.php"><img class="img-i" src="./img/POR EJE-01.png" ></a>
                <p class="cantidades" >Medio <span id="total_eje" ></span></p>
                <span id="opiniones_eje" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                <a href="./Grafica_por_usuario.php"><img class="img-i" src="./img/total opiniones 1-01.png" ></a>
                <p class="cantidades" >Calificación <span id="total_usuarios" ></span></p>
                <span id="opiniones_usuarios" style=" font-size: .7rem"></span>

              </div>
          </div>
         <div class="row justify-content-center">
         	<div class="col-sm-3 cajas">
                <a href="./Home.php"><img class="img-i" src="./img/por año-01.png" ></a>
                <p class="cantidades" >Tipo de noticia <span id="tipo_opiniones" ></span></p>
                <span id="opiniones_tipo" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                <a href="./Home.php"><img class="img-i" src="./img/POR EJE-01.png" ></a>
                <p class="cantidades" >Soporte de Noticia <span id="tipo_opiniones" ></span></p>
                <span id="opiniones_tipo" style=" font-size: .7rem"></span>
              </div>
              <!-- <div class="col-sm-3 cajas" >
                <a href="./Grafica_por_usuario.php"><img class="img-i" src="./img/total opiniones 1-01.png" ></a>
                <p class="cantidades" >Calificación <span id="total_usuarios" ></span></p>
                <span id="opiniones_usuarios" style=" font-size: .7rem"></span>

              </div> -->
          </div>
      </div>
  </div>


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

    <script src="./JS/portada.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</body>
</html>