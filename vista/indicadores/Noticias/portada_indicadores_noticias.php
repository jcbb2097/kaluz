<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>  
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php   
}
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

$catalogo = new Catalogo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                      <a href="./Home.php"><img class="img-i" src="../../apps/Noticias/img/lugar_noticia.jpg" ></a>
                    <p class="cantidades" >Lugar de noticia <span id="Lugar_noticias" ></span></p>
                    <span id="totalNoticias" style=" font-size: .7rem"></span>
                    <?php
                    $consulta = "SELECT count( * ) AS total, idLugarNoticia,
                    CASE
                    WHEN idLugarNoticia = 1 THEN
                          'Local' 
                          WHEN idLugarNoticia = 2 THEN
                          'Nacional' 
                          WHEN idLugarNoticia = 3 THEN
                          'Internacional' ELSE 'sin información' 
                        END AS Lugar 
                      FROM
                        c_noticia 
                      WHERE
                        FechaPublicacion >= '2020/01/01' 
                      GROUP BY
                        Lugar;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['Lugar']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
              </div>
              <div class="col-sm-3 cajas" >
                      <a href="../../apps/Noticias/Vista.php?Eje=1"><img class="img-i" src="../../apps/Noticias/img/genero_noticia.jpg" ></a>
                    <p class="cantidades" >Genero <span id="Genero_noticias" ></span> </p>
                    <span id="opiniones_tipo" style=" font-size: .7rem"></span>
                    <?php
                    $consulta = "SELECT
                        count( * ) AS total,
                        idGenero,
                    CASE
                            WHEN idGenero = 1 THEN
                            'Entrevista' 
                            WHEN idGenero = 2 THEN
                            'Crónica'
                            WHEN idGenero = 3 THEN
                            'Nota'
                            WHEN idGenero = 4 THEN
                            'Articulo'
                            WHEN idGenero = 5 THEN
                            'Especial'
                            WHEN idGenero = 6 THEN
                            'Reportaje' ELSE 'Sin información' 
                        END AS Genero 
                    FROM
                        c_noticia WHERE FechaPublicacion>='2020/01/01'
                    GROUP BY
                        Genero;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['Genero']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
              </div>
              <div class="col-sm-3 cajas">
                <a href="./Home.php"><img class="img-i" src="../../apps/Noticias/img/tipo_noticia.jpg" ></a>
                <p class="cantidades" >Tipo de noticia <span id="Tipo_noticia" ></span></p>
                <span id="opiniones_tipo" style=" font-size: .7rem"></span>
                <?php
                  $consulta = "SELECT
                    count( * ) AS total,
                    idTipo,
                  CASE
                      
                      WHEN idTipo = 1 THEN
                      'Interna' 
                      WHEN idTipo = 2 THEN
                      'Externa-Nacional' 
                      WHEN idTipo = 3 THEN
                      'Externa-Internacional' ELSE 'sin información' 
                    END AS TipoN 
                  FROM
                    c_noticia 
                  WHERE
                    FechaPublicacion >= '2020/01/01' 
                  GROUP BY
                    TipoN;";
                  $resultado = $catalogo->obtenerLista($consulta);
                  while ($row = mysqli_fetch_array($resultado)) {
                  ?>
                  <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['TipoN']. ': ' .$row['total']; ?></span><br>
                  <?php
                  }
                  ?>
              </div>
          </div>
        </br>
          <div class="row justify-content-center">
              <div class="col-sm-3 cajas">
                <a href="./Home.php"><img class="img-i" src="../../apps/Noticias/img/tipo_medio_noticia.jpg" ></a>
                <p class="cantidades" >Tipo de medio <span id="Tipo_medio" ></span></p>
                <span id="opiniones_anio" style=" font-size: .7rem"></span>
                <?php
                    $consulta = "SELECT COUNT(n.idTipoMedio) AS total, n.idTipoMedio, tm.Nombre AS TipoMedio
FROM c_noticia n, c_tipoMedio tm
WHERE n.idTipoMedio=tm.idTipoMedio
GROUP BY TipoMedio ORDER BY total DESC, TipoMedio;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['TipoMedio']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
              </div>
               <div class="col-sm-3 cajas" >
                <a href="./Home.php"><img class="img-i" src="../../apps/Noticias/img/soporte_noticia.jpg" ></a>
                <p class="cantidades" >Soporte de Noticia <span id="Soporte_noticia" ></span></p>
                <span id="opiniones_tipo" style=" font-size: .7rem"></span>
                <?php
                    $consulta = "SELECT
                      count( * ) AS total,
                      idSoporte,
                    CASE
                        
                        WHEN idSoporte = 1 THEN
                        'Impreso' 
                        WHEN idSoporte = 2 THEN
                        'Digital' 
                        WHEN idSoporte = 3 THEN
                        'Otro' ELSE 'Sin información' 
                      END AS Soporte 
                    FROM
                      c_noticia 
                    WHERE
                      FechaPublicacion >= '2020/01/01' 
                    GROUP BY
                      Soporte;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['Soporte']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
              </div>
              <div class="col-sm-3 cajas" >
                <a href="./Grafica_por_usuario.php"><img class="img-i" src="../../apps/Noticias/img/calificacion_noticia.jpg" ></a>
                <p class="cantidades" >Calificación <span id="Calif_noticia" ></span></p>
                <span id="opiniones_usuarios" style=" font-size: .7rem"></span>
                <?php
                    $consulta = "SELECT
                      count( * ) AS total,
                      idCalificacion,
                    CASE
                        
                        WHEN idCalificacion = 1 THEN
                        'Positiva' 
                        WHEN idCalificacion = 2 THEN
                        'Informativa' ELSE 'Sin Calificación' 
                      END AS Calif 
                    FROM
                      c_noticia 

                    GROUP BY
                      Calif;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['Calif']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
              </div>
          </div>
         <div class="row justify-content-center">
              <div class="col-sm-3 cajas" >
                      <a href="./Home.php"><img class="img-i" src="../../apps/Noticias/img/etapa_noticia.jpg" ></a>
                    <p class="cantidades" >Etapa <span id="Etapa_noticia" ></span></p>
                    <span id="opiniones_origen" style=" font-size: .7rem"></span>
                    <?php
                    $consulta = "SELECT COUNT(n.idEtapa) AS total, n.idEtapa, e.Nombre AS Etapa
                    FROM c_noticia n, c_etapa e
                    WHERE n.idEtapa=e.idEtapa
                    GROUP BY Etapa ORDER BY total DESC, Etapa;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['Etapa']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
              </div>             
              <div class="col-sm-3 cajas" >
                <a href="./Home.php"><img class="img-i" src="../../apps/Noticias/img/medio_noticia.jpg" ></a>
                <p class="cantidades" >Medio <span id="Medio_noticia" ></span></p>
                <span id="opiniones_eje" style=" font-size: .7rem"></span>
                <?php
                    $consulta = "SELECT COUNT(n.idMedio) AS total, n.idMedio, m.Nombre AS Medio
                    FROM c_noticia n, c_medio m
                    WHERE n.idMedio=m.idMedio
                    GROUP BY Medio ORDER BY total DESC, Medio;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                    <span id="totalNoticias" style=" font-size: .7rem"><?php echo $row['Medio']. ': ' .$row['total']; ?></span><br>
                    <?php
                    }
                    ?>
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