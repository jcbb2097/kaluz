<?php
	include_once __DIR__."/../../../source/controller/DashboardController.php";
	
	
$act = new DashboardController();
$asuntosSR = $act -> mostrarAsuntosSinResolver();
$totalAsuntosSR = $asuntosSR ->getTotal();

$asuntosSRA = $act -> mostrarAsuntosSinResolverAnio();

$cadena = "";
$totalNLanio = 0;
$totalECanio = 0;
foreach($asuntosSRA as $asra)
{
	$asuntosNLAnio = $act -> mostrarAsuntosSinResolverNLAnio($asra->getAnio());
	$totalNLanio = $asuntosNLAnio -> getTotal();
	
	$asuntosECAnio = $act -> mostrarAsuntosSinResolverECAnio($asra->getAnio());
	$totalECanio = $asuntosECAnio -> getTotal();
	
	$cadena .= "<a style='cursor:pointer;' onclick='mostrarGraficaAnio(0,".$asra->getAnio().",\"Asuntos sin resolver del año ".$asra->getAnio()." por área\")'>".$asra->getAnio()." - ".$asra->getTotal()."</a> <br><small>No leidos ".$totalNLanio."<br>En conversación ".$totalECanio."</small> <hr> ";
}

$act2 = new DashboardController();
$problematicasSR = $act2 -> mostrarProblematicasSinResolver();
$totalProblematicasSR = $problematicasSR ->getTotal();

$asuntosSRAPro = $act -> mostrarProblematicasSinResolverAnio();
$cadenaProblematicas = "";
$totalNLanioPro = 0;
$totalECanioPro = 0;
foreach($asuntosSRAPro as $asrapro)
{
	$asuntosNLAnioPro = $act2 -> mostrarProblematicasSinResolverNLAnio($asrapro->getAnio());
	$totalNLanioPro = $asuntosNLAnioPro -> getTotal();
	
	$asuntosECAnioPro = $act2 -> mostrarProblematicasSinResolverECAnio($asrapro->getAnio());
	$totalECanioPro = $asuntosECAnioPro -> getTotal();
	
	$cadenaProblematicas .= "".$asrapro->getAnio()." - ".$asrapro->getTotal()." <br><small>No leidos ".$totalNLanioPro."<br>En conversación ".$totalECanioPro."</small> <hr> ";
}

/*solicitud*/
$act3 = new DashboardController();
$solicitudSR = $act3 -> mostrarSolicitudSinResolver();
$totalSolicitudSR = $solicitudSR ->getTotal();

$asuntosSRASol = $act -> mostrarSolicitudSinResolverAnio();
$cadenaSolicitud = "";
$totalNLanioSol = 0;
$totalECanioSol = 0;
foreach($asuntosSRASol as $asrasol)
{
	$asuntosNLAnioSol = $act3 -> mostrarSolicitudSinResolverNLAnio($asrasol->getAnio());
	$totalNLanioSol = $asuntosNLAnioSol -> getTotal();
	
	$asuntosECAnioSol = $act3 -> mostrarSolicitudSinResolverECAnio($asrasol->getAnio());
	$totalECanioSol = $asuntosECAnioSol -> getTotal();
	
	$cadenaSolicitud .= "".$asrasol->getAnio()." - ".$asrasol->getTotal()." <br><small>No leidos ".$totalNLanioSol."<br>En conversación ".$totalECanioSol."</small> <hr> ";
}

/*conocimiento*/
$act4 = new DashboardController();
$conocimientoSR = $act4 -> mostrarConocimientoSinResolver();
$totalConocimientoSR = $conocimientoSR ->getTotal();

$asuntosSRACon = $act -> mostrarConocimientoSinResolverAnio();
$cadenaConocimiento = "";
$totalNLanioCon = 0;
$totalECanioCon = 0;
foreach($asuntosSRACon as $asracon)
{
	$asuntosNLAnioCon = $act4 -> mostrarConocimientoSinResolverNLAnio($asracon->getAnio());
	$totalNLanioCon = $asuntosNLAnioCon -> getTotal();
	
	$asuntosECAnioCon = $act4 -> mostrarConocimientoSinResolverECAnio($asracon->getAnio());
	$totalECanioCon = $asuntosECAnioCon -> getTotal();
	
	$cadenaConocimiento .= "".$asracon->getAnio()." - ".$asracon->getTotal()." <br><small>No leidos ".$totalNLanioCon."<br>En conversación ".$totalECanioCon."</small> <hr> ";
}

/*sugerencia*/
$act5 = new DashboardController();
$sugerenciaSR = $act5 -> mostrarSugerenciaSinResolver();
$totalSugerenciaSR = $sugerenciaSR ->getTotal();

$asuntosSRASug = $act -> mostrarSugerenciaSinResolverAnio();
$cadenaSugerencia = "";
$totalNLanioSug = 0;
$totalECanioSug = 0;
foreach($asuntosSRASug as $asrasug)
{
	$asuntosNLAnioSug = $act5 -> mostrarSugerenciaSinResolverNLAnio($asrasug->getAnio());
	$totalNLanioSug = $asuntosNLAnioSug -> getTotal();
	
	$asuntosECAnioSug = $act5 -> mostrarSugerenciaSinResolverECAnio($asrasug->getAnio());
	$totalECanioSug = $asuntosECAnioSug -> getTotal();
	
	$cadenaSugerencia .= "".$asrasug->getAnio()." - ".$asrasug->getTotal()." <br><small>No leidos ".$totalNLanioSug."<br>En conversación ".$totalECanioSug."</small> <hr> ";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->

	<!-- Theme style importante-->
	<link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
	<link rel="stylesheet" type="text/css" href="../../../resources/css/scroll.css"/>
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	
	
	<style>
	body{
		font-family:'Muli-Regular';
		    font-size: 13px;
	}
	.well2{
	min-height: 20px;
	font-family: 'Muli-SemiBold';
	font-size: 11px;
	padding: 8px;
	margin-bottom: 20px;
	background-color: #5a274f;
	border: 1px solid #5a274f;
	border-radius: 0px;
	color: #fefefe;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
}
	
.wr{
	background-color: #4d4d57;
    border: 1px solid #4d4d57;
    margin-top: -20px;
    height: 31px;
}

	</style>
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="well2 ">
	
</div>


	<div class="wrapper">
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-3 col-sm-3 col-md-3">
						<div class="info-box">
							<span style='width: 5px;' class="info-box-icon bg-info elevation-1"><!--<i style="font-size:15px" class="fas fa-comment-dots"></i>--></span>
							<div class="info-box-content">
								<span onclick="mostrarGrafica(1,'Asuntos sin resolver por área')" style="cursor:pointer;" class="info-box-text">Asuntos sin resolver <b><?php echo $totalAsuntosSR; ?></b></span>
								<span class="info-box-number">
									<?php echo $cadena; ?>
								</span>
							</div>
						</div>
					</div>
          
					<div class="col-2 col-sm-2 col-md-2">
						<div style="border: 1px solid red;width: 150px;" class="info-box mb-3">
							<span style='width: 5px;' class="info-box-icon bg-danger elevation-1"> <i style="font-size:15px" class=""></i> </span>
							<div class="info-box-content">
								<span class="info-box-text">Problemáticas <b><?php echo $totalProblematicasSR; ?></b></span>
								<span class="info-box-number">
									<?php echo $cadenaProblematicas; ?>
								</span>
							</div>
						</div>
					</div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-2 col-sm-2 col-md-2">
            <div style="width: 150px;left:10px;" class="info-box mb-3">
              <span style='width: 5px;' class="info-box-icon bg-secondary elevation-1"><!--<i  style="font-size:15px" class="fas fa-comment-dots"></i>--></span>

              <div class="info-box-content">
                <span class="info-box-text">Solicitud <b><?php echo $totalSolicitudSR; ?></b></span>
                <span class="info-box-number">
					<?php echo $cadenaSolicitud; ?>
				</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-2 col-sm-2 col-md-2">
            <div style="width: 150px;left:20px;" class="info-box mb-3">
              <span style='width: 5px;' class="info-box-icon bg-secondary elevation-1"><!--<i style="font-size:15px" class="fas fa-comment-dots"></i>--></span>

              <div class="info-box-content">
                <span class="info-box-text">Conocimiento <b><?php echo $totalConocimientoSR; ?></b></span>
                <span class="info-box-number">
					<?php echo $cadenaConocimiento; ?>
				</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		  
		  <div class="col-2 col-sm-2 col-md-2">
            <div style="width: 150px;left:30px;" class="info-box mb-3">
              <span style='width: 5px;' class="info-box-icon bg-secondary elevation-1"><!--<i style="font-size:15px" class="fas fa-comment-dots"></i>--></span>

              <div class="info-box-content">
                <span class="info-box-text">Sugerencia <b><?php echo $totalSugerenciaSR; ?></b></span>
                <span class="info-box-number">
					<?php echo $cadenaSugerencia; ?>
				</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		  
          <!-- /.col -->
        </div>
        <!-- /.row -->





        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title tituloGrafica" style="font-family: 'Muli-SemiBold';font-size: 12px;">Asuntos sin resolver por área</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 divGrafica" >
                    
                    
                  </div>
                 <!--
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      Add Products to Cart
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                   

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                   
                    <div class="progress-group">
                      <span class="progress-text">Visit Premium Page</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    
                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                   
                  </div>
				  -->
                 
                </div>
              
              </div>
              <!--
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div>
                   
                  </div>
                 
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div>
                   
                  </div>
                  
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>
                   
                  </div>
                  
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    
                  </div>
                </div>
               
              </div>
              -->
            </div>
            
          </div>
         
        </div>
       
<!--
        
        <div class="row">
         
          <div class="col-md-8">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">US-Visitors Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-1 flex-fill" style="overflow: hidden">
                    
                    <div id="world-map-markers" style="height: 325px; overflow: hidden">
                      <div class="map"></div>
                    </div>
                  </div>
                  <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">
                    <div class="description-block mb-4">
                      <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                      <h5 class="description-header">8390</h5>
                      <span class="description-text">Visits</span>
                    </div>
                    
                    <div class="description-block mb-4">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">30%</h5>
                      <span class="description-text">Referrals</span>
                    </div>
                    
                    <div class="description-block">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">70%</h5>
                      <span class="description-text">Organic</span>
                    </div>
                   
                  </div>
                </div>
              </div>
             
            </div>
            
            <div class="row">
              <div class="col-md-6">
               
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>

                    <div class="card-tools">
                      <span title="3 New Messages" class="badge badge-warning">3</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                 
                  <div class="card-body">
                 
                    <div class="direct-chat-messages">
                     
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left">Alexander Pierce</span>
                          <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                        </div>
                       
                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                       
                        <div class="direct-chat-text">
                          Is this template really for free? That's unbelievable!
                        </div>
                      
                      </div>
                     
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">Sarah Bullock</span>
                          <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                        </div>
                       
                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                        
                        <div class="direct-chat-text">
                          You better believe it!
                        </div>
                       
                      </div>
                     
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left">Alexander Pierce</span>
                          <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                        </div>
                        
                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                       
                        <div class="direct-chat-text">
                          Working with AdminLTE on a great new app! Wanna join?
                        </div>
                       
                      </div>
                     
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">Sarah Bullock</span>
                          <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                        </div>
                        
                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                        
                        <div class="direct-chat-text">
                          I would love to.
                        </div>
                       
                      </div>
                     

                    </div>
                   
                    
                    <div class="direct-chat-contacts">
                      <ul class="contacts-list">
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Count Dracula
                                <small class="contacts-list-date float-right">2/28/2015</small>
                              </span>
                              <span class="contacts-list-msg">How have you been? I was...</span>
                            </div>
                           
                          </a>
                        </li>
                        
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Sarah Doe
                                <small class="contacts-list-date float-right">2/23/2015</small>
                              </span>
                              <span class="contacts-list-msg">I will be waiting for...</span>
                            </div>
                           
                          </a>
                        </li>
                      
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nadia Jolie
                                <small class="contacts-list-date float-right">2/20/2015</small>
                              </span>
                              <span class="contacts-list-msg">I'll call you back at...</span>
                            </div>
                           
                          </a>
                        </li>
                       
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nora S. Vans
                                <small class="contacts-list-date float-right">2/10/2015</small>
                              </span>
                              <span class="contacts-list-msg">Where is your new...</span>
                            </div>
                            
                          </a>
                        </li>
                      
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                John K.
                                <small class="contacts-list-date float-right">1/27/2015</small>
                              </span>
                              <span class="contacts-list-msg">Can I take a look at...</span>
                            </div>
                           
                          </a>
                        </li>
                        
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Kenneth M.
                                <small class="contacts-list-date float-right">1/4/2015</small>
                              </span>
                              <span class="contacts-list-msg">Never mind I found...</span>
                            </div>
                           
                          </a>
                        </li>
                      
                      </ul>
                    
                    </div>
                   
                  </div>
                  
                  <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                          <button type="button" class="btn btn-warning">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  
                </div>
               
              </div>
              

              <div class="col-md-6">
                
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Members</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">8 New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                 
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      <li>
                        <img src="dist/img/user1-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Alexander Pierce</a>
                        <span class="users-list-date">Today</span>
                      </li>
                      <li>
                        <img src="dist/img/user8-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Norman</a>
                        <span class="users-list-date">Yesterday</span>
                      </li>
                      <li>
                        <img src="dist/img/user7-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Jane</a>
                        <span class="users-list-date">12 Jan</span>
                      </li>
                      <li>
                        <img src="dist/img/user6-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">John</a>
                        <span class="users-list-date">12 Jan</span>
                      </li>
                      <li>
                        <img src="dist/img/user2-160x160.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Alexander</a>
                        <span class="users-list-date">13 Jan</span>
                      </li>
                      <li>
                        <img src="dist/img/user5-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Sarah</a>
                        <span class="users-list-date">14 Jan</span>
                      </li>
                      <li>
                        <img src="dist/img/user4-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Nora</a>
                        <span class="users-list-date">15 Jan</span>
                      </li>
                      <li>
                        <img src="dist/img/user3-128x128.jpg" alt="User Image">
                        <a class="users-list-name" href="#">Nadia</a>
                        <span class="users-list-date">15 Jan</span>
                      </li>
                    </ul>
                   
                  </div>
                  
                  <div class="card-footer text-center">
                    <a href="javascript:">View All Users</a>
                  </div>
                
                </div>
               
              </div>
              
            </div>
            

            
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>Popularity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-info">Processing</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
               
              </div>
              
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              
            </div>
           
          </div>
          

          <div class="col-md-4">
            
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inventory</span>
                <span class="info-box-number">5,200</span>
              </div>
             
            </div>
           
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mentions</span>
                <span class="info-box-number">92,050</span>
              </div>
              
            </div>
           
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Downloads</span>
                <span class="info-box-number">114,381</span>
              </div>
             
            </div>
            
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Direct Messages</span>
                <span class="info-box-number">163,921</span>
              </div>
              
            </div>
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Browser Usage</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                   
                  </div>
                  
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                 
                </div>
                
              </div>
              
              <div class="card-footer bg-light p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      United States of America
                      <span class="float-right text-danger">
                        <i class="fas fa-arrow-down text-sm"></i>
                        12%</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      India
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> 4%
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      China
                      <span class="float-right text-warning">
                        <i class="fas fa-arrow-left text-sm"></i> 0%
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
              
            </div>
            

           
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
             
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Samsung TV
                        <span class="badge badge-warning float-right">$1800</span></a>
                      <span class="product-description">
                        Samsung 32" 1080p 60Hz LED Smart HDTV.
                      </span>
                    </div>
                  </li>
                  
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Bicycle
                        <span class="badge badge-info float-right">$700</span></a>
                      <span class="product-description">
                        26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                      </span>
                    </div>
                  </li>
                  
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">
                        Xbox One <span class="badge badge-danger float-right">
                        $350
                      </span>
                      </a>
                      <span class="product-description">
                        Xbox One Console Bundle with Halo Master Chief Collection.
                      </span>
                    </div>
                  </li>
                 
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">PlayStation 4
                        <span class="badge badge-success float-right">$399</span></a>
                      <span class="product-description">
                        PlayStation 4 500GB Console (PS4)
                      </span>
                    </div>
                  </li>
                  
                </ul>
              </div>
             
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Products</a>
              </div>
             
            </div>
            
          </div>
          
        </div>
      --> 
      </div>
	  <!--/. container-fluid -->
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!--<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<!--<script src="AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>-->
<!--script src="AdminLTE/plugins/raphael/raphael.min.js"></script>-->
<!--<script src="AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>-->
<!-- ChartJS -->
<!--<script src="AdminLTE/plugins/chart.js/Chart.min.js"></script>-->

<!-- AdminLTE for demo purposes -->
<!--<script src="AdminLTE/dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="AdminLTE/dist/js/pages/dashboard2.js"></script>-->
<script>
$('document').ready(function()
{ 

	$.post("grafico.php",{grafica:1,anio:0,tipo:0}, function(data)
	{
		$(".divGrafica").html('');
		$(".divGrafica").html(data);
	});
});

function mostrarGrafica(tipo,titulo)
{
	var titulo = titulo;
	$(".tituloGrafica").html('');
	$(".tituloGrafica").html(titulo);
	
	$.post("grafico.php",{grafica:1,anio:0,tipo:0}, function(data)
	{
		$(".divGrafica").html('');
		$(".divGrafica").html(data);
	});
	
}

function mostrarGraficaAnio(tipo,anio,titulo)
{
	var tipo = tipo;
	var anio = anio;
	var titulo = titulo;
	$(".tituloGrafica").html('');
	$(".tituloGrafica").html(titulo);
	
	$.post("grafico.php",{grafica:2,anio:anio,tipo:tipo}, function(data)
	{
		$(".divGrafica").html('');
		$(".divGrafica").html(data);
	});
	
}
</script>
</body>
</html>
