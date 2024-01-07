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
<div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=1">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Portada activos fijos</a></div>
    <div class="container">
        <div class="row">
          <div class="container"  style="padding-top:5%;">
            <div class="row">
              <!-- <div class="col-4" >
                <div class="form-group" >
                    <label for="">Filtrar Año</label>
                    <select class="form-control" name="filtro_fecha" id="filtro_fecha">
                    <option  value="todos" selected>Todos los años</option>
                    </select>
                    <span class="glyphicon glyphicon-menu-right flecha" aria-hidden="true"></span>
                </div>
             </div> -->
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
          <!-- <div class="row">
            <div class="col-4"  >
              <div class="form-group">
                <label for="">Selecciona una exposición</label>
                    <select class="form-control" name="select_exposiciones" id="select_exposiciones">

                    </select>

              </div>
            </div>
         </div> -->
        </div>
      </div>
  </div>


  <div id="menu" style="margin-top:50px;">
      <div class="container-fluid" style="margin-bottom: 5%">
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas" >
                <a href="../../apps/ActivoFijo/Vista.php">
                <i class="fas fa-tasks fa-10x"></i></a>
                    <p class="cantidades" >Total de activos<span id="total_activo_fijo" ></span></p>
                    <span id="activo_fijo_total" style=" font-size: .7rem"></span>
              </div>
              <div class="col-sm-3 cajas" >
                <a href="../../apps/ActivoFijo/Vista.php">
                <i class="fas fa-bars fa-10x"></i></a>
                    <p class="cantidades" >Activos por eje  <span id="eje_activo_fijo" ></span> </p>
                    <span id="activo_fijo_eje" style=" font-size: .7rem"></span>
              </div>
                  <div class="col-sm-3 cajas" >
                    <a href="../../apps/ActivoFijo/Vista.php">
                    <i class="fas fa-layer-group fa-10x"></i></a>
                    <p class="cantidades" >Activos por área <span id="origen_activo_fijo" ></span></p>
                    <span id="activo_fijo_origen" style=" font-size: .7rem"></span>
              </div>
          </div>
        </br>
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas">


              </div>
              <div class="col-sm-3 cajas" >

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

    <script src="./portada_act_fijo.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</body>
</html>
