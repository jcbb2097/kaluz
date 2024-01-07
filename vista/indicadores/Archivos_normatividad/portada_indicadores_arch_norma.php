<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../CSS/bootstrap.css">
    <link rel="stylesheet" href="../CSS/bootstrap-select.css">
    <link rel="stylesheet" href="../CSS/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="../CSS/datatables.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/ejes.css">
    <link rel="stylesheet" href="../JS/example.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
    <link rel="stylesheet" href="../CSS/img_recuadro.css">
    <script src="https://kit.fontawesome.com/b91b8c51b4.js" crossorigin="anonymous"></script>



    <title>Portada indicadores</title>
</head>

<body>
<div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Portada de archivos de normatividad</a></div>
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
                <a href="../../apps/ArchivosNormatividad/Vista2.php">
                <i class="fas fa-tasks fa-10x"></i></a>
                    <p class="cantidades" >Total de archivos<span id="total_arch_norma" ></span></p>
                    <span id="arch_norma_total" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                <a href="../../apps/ArchivosNormatividad/Vista2.php">
                <i class="fas fa-bars fa-10x"></i></a>
                    <p class="cantidades" >Archivos por eje  <span id="eje_arch_norma" ></span> </p>
                    <span id="arch_norma_eje" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                    <a href="../../apps/ArchivosNormatividad/Vista2.php">
                    <i class="far fa-calendar-alt fa-10x"></i></a>
                    <p class="cantidades" >Archivos por año <span id="anio_arch_norma" ></span></p>
                    <span id="arch_norma_anio" style=" font-size: .7rem"></span>
              </div>
          </div>
        </br>
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas">
                <a href="../../apps/ArchivosNormatividad/Vista2.php">
                <i class="fas fa-palette fa-10x"></i></a>
                <p class="cantidades" >Archivos por exposición <span id="expo_arch_norma" ></span></p>
                <span id="arch_norma_expo" style=" font-size: .7rem"></span>

              </div>
              <div class="col-sm-3 cajas" >
                <a href="../../apps/ArchivosNormatividad/Vista2.php">
                <i class="fas fa-layer-group fa-10x"></i></a>
                <p class="cantidades" >Archivos por área <span id="origen_arch_norma" ></span></p>
                <span id="arch_norma_origen" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >


              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas" >

              </div>
              <div class="col-sm-3 cajas" >


              </div>
              <div class="col-sm-3 cajas" >


              </div>
          </div>
      </div>
  </div>

    <script src="../JS/jquery.js"></script>
    <script src="../JS/popper.js"></script>
    <script src="../JS/bootstrap.js"></script>
    <script src="../JS/bootstrap-notify.js"></script>
    <script src="../JS/bootstrap-select.js"></script>
    <script src="../JS/bootbox.all.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
    <script src="../JS/typehead.js"></script>
    <script src="../JS/bootstrap-tokenfield.js"></script>
    <script src="../JS/datatables.js"></script>

    <script src="./portada_arch_norma.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</body>
</html>
