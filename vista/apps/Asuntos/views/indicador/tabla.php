
<?php

$cadenaTablaRecibidos = "";
$aumento = 79;
$background = "";
$sty = "";
$sty1 = "";
$sty2 = "";
$ind = $this->indicadores;
$i = 0;
for($iTabla = 0; $iTabla <= 11; $iTabla++) {
	if($iTabla >= 11){$background = "background-color:#393641;color:#fefefe";}
	if($iTabla <=3){$sty1="height:16.5px;";}else if($iTabla <=10){$sty2="height:16.5px;";}else{$sty1="";$sty2="";}
	$letra="";
	$letra2="";
	$letra3="";
   	if($ind[$iTabla]->getNoatendidos() != '0')
   		$letra="color:red !important;";
	$cadenaTablaRecibidos.= "<p onclick=\"abrirAsuntos('".$this->anio."','".$this->idArea."','".$this->idUsuario."','".$this->opcion."','".$ind[$iTabla]->getEje()."','1');\" style='".$letra.$sty2."top:".$aumento."px;left:".$this->size."px;".$background."' class='ejeColor".$ind[$iTabla]->getEje()." ejesCuadriculaAsuntos p".$i.$this->aux."'>".$ind[$iTabla]->getNoatendidos()."</p>";
	$aumento += 17.65;
	$i++;
	if($ind[$iTabla]->getConversacion() != '0')
   		$letra2="color:yellow !important;";
	$cadenaTablaRecibidos.= "<p onclick=\"abrirAsuntos('".$this->anio."','".$this->idArea."','".$this->idUsuario."','".$this->opcion."','".$ind[$iTabla]->getEje()."','2');\" style='".$letra2.$sty1."top:".$aumento."px;left:".$this->size."px;".$background."' class='ejeColor".$ind[$iTabla]->getEje()." ejesCuadriculaAsuntos p".$i.$this->aux."'>".$ind[$iTabla]->getConversacion()."</p>";
	$aumento += 17.65;
	$i++;
	if($ind[$iTabla]->getResueltos() != '0')
   		$letra3="color:green !important;";
	$cadenaTablaRecibidos.= "<p onclick=\"abrirAsuntos('".$this->anio."','".$this->idArea."','".$this->idUsuario."','".$this->opcion."','".$ind[$iTabla]->getEje()."','4');\" style='".$letra3.$sty."top:".$aumento."px;left:".$this->size."px;".$background."' class='ejeColor".$ind[$iTabla]->getEje()." ejesCuadriculaAsuntos p".$i.$this->aux."'>".$ind[$iTabla]->getResueltos()."</p>";
	$aumento += 17.65;
	$i++;
}
echo $cadenaTablaRecibidos;

?>
<script>
$(document).ready(function(){


  
  $(".p0r,.p1r,.p2r,.p0e,.p1e,.p2e").on("click",function()
  {
	 
	$("p.nEje1").css("background-color", "#d3d3d3");
	$(".p0r").css("background-color", "#d3d3d3");
	$(".p1r").css("background-color", "#d3d3d3");
	$(".p2r").css("background-color", "#d3d3d3");
	$(".p0e").css("background-color", "#d3d3d3");
	$(".p1e").css("background-color", "#d3d3d3");
	$(".p2e").css("background-color", "#d3d3d3");
	$(".p0o").css("background-color", "#d3d3d3");
	$(".p0o").css("color", "#fefefe");
	$(".p1o").css("background-color", "#d3d3d3");
	$(".p1o").css("color", "#fefefe");
	$(".franja").css("height", "116px");
	
	$("p.nEje1 a").css("color", "#000");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	
	$(".p3r").css("background-color", "#a9a9ae");
	
	
	$(".p3e").css("background-color", "#a9a9ae");
	
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
  
  
  $(".p3r,.p4r,.p5r,.p3e,.p4e,.p5e").click(function()
  {
	$("p.nEje2").css("background-color", "#d3d3d3");
	$(".p3r").css("background-color", "#d3d3d3");
	$(".p4r").css("background-color", "#d3d3d3");
	$(".p5r").css("background-color", "#d3d3d3");
	$(".p3e").css("background-color", "#d3d3d3");
	$(".p4e").css("background-color", "#d3d3d3");
	$(".p5e").css("background-color", "#d3d3d3");
	$(".p2o").css("background-color", "#d3d3d3");
	$(".p2o").css("color", "#fefefe");
	$(".p3o").css("background-color", "#d3d3d3");
	$(".p3o").css("color", "#fefefe");
	$(".franja").css("height", "169px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#000");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
  $(".p6r,.p7r,.p8r,.p6e,.p7e,.p8e").click(function()
  {
	$("p.nEje3").css("background-color", "#d3d3d3");
	$(".p6r").css("background-color", "#d3d3d3");
	$(".p7r").css("background-color", "#d3d3d3");
	$(".p8r").css("background-color", "#d3d3d3");
	$(".p6e").css("background-color", "#d3d3d3");
	$(".p7e").css("background-color", "#d3d3d3");
	$(".p8e").css("background-color", "#d3d3d3");
	
	$(".p4o").css("background-color", "#d3d3d3");
	$(".p4o").css("color", "#fefefe");
	$(".p5o").css("background-color", "#d3d3d3");
	$(".p5o").css("color", "#fefefe");
	$(".franja").css("height", "222px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#000");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
  $(".p9r,.p10r,.p11r,.p9e,.p10e,.p11e").click(function()
  {
	$("p.nEje4").css("background-color", "#d3d3d3");
	$(".p9r").css("background-color", "#d3d3d3");
	$(".p10r").css("background-color", "#d3d3d3");
	$(".p11r").css("background-color", "#d3d3d3");
	$(".p9e").css("background-color", "#d3d3d3");
	$(".p10e").css("background-color", "#d3d3d3");
	$(".p11e").css("background-color", "#d3d3d3");
	$(".p6o").css("background-color", "#d3d3d3");
	$(".p6o").css("color", "#fefefe");
	$(".p7o").css("background-color", "#d3d3d3");
	$(".p7o").css("color", "#fefefe");
	$(".franja").css("height", "275px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#000");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
  });
  
  $(".p12r,.p13r,.p14r,.p12e,.p13e,.p14e").click(function()
  {
	$("p.nEje5").css("background-color", "#d3d3d3");
	$(".p12r").css("background-color", "#d3d3d3");
	$(".p13r").css("background-color", "#d3d3d3");
	$(".p14r").css("background-color", "#d3d3d3");
	$(".p12e").css("background-color", "#d3d3d3");
	$(".p13e").css("background-color", "#d3d3d3");
	$(".p14e").css("background-color", "#d3d3d3");
		
	$(".p8o").css("background-color", "#d3d3d3");
	$(".p8o").css("color", "#fefefe");
	$(".p9o").css("background-color", "#d3d3d3");
	$(".p9o").css("color", "#fefefe");
	$(".franja").css("height", "328px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#000");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
    $(".p15r,.p16r,.p17r,.p15e,.p16e,.p17e").click(function()
  {
	$("p.nEje6").css("background-color", "#d3d3d3");
	$(".p15r").css("background-color", "#d3d3d3");
	$(".p16r").css("background-color", "#d3d3d3");
	$(".p17r").css("background-color", "#d3d3d3");
	$(".p15e").css("background-color", "#d3d3d3");
	$(".p16e").css("background-color", "#d3d3d3");
	$(".p17e").css("background-color", "#d3d3d3");
	
	$(".p10o").css("background-color", "#d3d3d3");
	$(".p10o").css("color", "#fefefe");
	$(".p11o").css("background-color", "#d3d3d3");
	$(".p11o").css("color", "#fefefe");
	$(".franja").css("height", "381px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#000");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	
	$(".p14e").css("background-color", "#a9a9ae");
	
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
	
  });
  
  $(".p18r,.p19r,.p20r,.p18e,.p19e,.p20e").click(function()
  {
	$("p.nEje7").css("background-color", "#d3d3d3");
	$(".p18r").css("background-color", "#d3d3d3");
	$(".p19r").css("background-color", "#d3d3d3");
	$(".p20r").css("background-color", "#d3d3d3");
	$(".p18e").css("background-color", "#d3d3d3");
	$(".p19e").css("background-color", "#d3d3d3");
	$(".p20e").css("background-color", "#d3d3d3");
	$(".p12o").css("background-color", "#d3d3d3");
	$(".p12o").css("color", "#fefefe");
	$(".p13o").css("background-color", "#d3d3d3");
	$(".p13o").css("color", "#fefefe");
	$(".franja").css("height", "434px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#000");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	
	$(".p21r").css("background-color", "#a9a9ae");
	
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
  $(".p21r,.p22r,.p23r,.p21e,.p22e,.p23e").click(function()
  {
	$("p.nEje8").css("background-color", "#d3d3d3");
	$(".p21r").css("background-color", "#d3d3d3");
	$(".p22r").css("background-color", "#d3d3d3");
	$(".p23r").css("background-color", "#d3d3d3");
	$(".p21e").css("background-color", "#d3d3d3");
	$(".p22e").css("background-color", "#d3d3d3");
	$(".p23e").css("background-color", "#d3d3d3");
	$(".p14o").css("background-color", "#d3d3d3");
	$(".p14o").css("color", "#fefefe");
	$(".p15o").css("background-color", "#d3d3d3");
	$(".p15o").css("color", "#fefefe");
	$(".franja").css("height", "487px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#000");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	
	$(".p20e").css("background-color", "#a9a9ae");
	
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
  });
  
  $(".p24r,.p25r,.p26r,.p24e,.p25e,.p26e").click(function()
  {
	$("p.nEje9").css("background-color", "#d3d3d3");
	$(".p24r").css("background-color", "#d3d3d3");
	$(".p25r").css("background-color", "#d3d3d3");
	$(".p26r").css("background-color", "#d3d3d3");
	$(".p24e").css("background-color", "#d3d3d3");
	$(".p25e").css("background-color", "#d3d3d3");
	$(".p26e").css("background-color", "#d3d3d3");
	$(".p16o").css("background-color", "#d3d3d3");
	$(".p16o").css("color", "#fefefe");
	$(".p17o").css("background-color", "#d3d3d3");
	$(".p17o").css("color", "#fefefe");
	$(".franja").css("height", "540px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#000");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
  $(".p27r,.p28r,.p29r,.p27e,.p28e,.p29e").click(function()
  {
	$("p.nEje10").css("background-color", "#d3d3d3");
	$(".p27r").css("background-color", "#d3d3d3");
	$(".p28r").css("background-color", "#d3d3d3");
	$(".p29r").css("background-color", "#d3d3d3");
	$(".p27e").css("background-color", "#d3d3d3");
	$(".p28e").css("background-color", "#d3d3d3");
	$(".p29e").css("background-color", "#d3d3d3");
	$(".p18o").css("background-color", "#d3d3d3");
	$(".p18o").css("color", "#fefefe");
	$(".p19o").css("background-color", "#d3d3d3");
	$(".p19o").css("color", "#fefefe");
	$(".franja").css("height", "593px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#000");
	$("p.nEje11 a").css("color", "#fff");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje11").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p20o").css("background-color", "#a9a9ae");
	$(".p20o").css("color", "#000");
	$(".p21o").css("background-color", "#a9a9ae");
	$(".p21o").css("color", "#000");
	
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p30r").css("background-color", "#a9a9ae");
	$(".p31r").css("background-color", "#a9a9ae");
	$(".p32r").css("background-color", "#a9a9ae");
	
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p30e").css("background-color", "#a9a9ae");
	$(".p31e").css("background-color", "#a9a9ae");
	$(".p32e").css("background-color", "#a9a9ae");
	
  });
  
    $(".p30r,.p31r,.p32r,.p30e,.p31e,.p32e").click(function()
  {
	$("p.nEje11").css("background-color", "#d3d3d3");
	$(".p30r").css("background-color", "#d3d3d3");
	$(".p31r").css("background-color", "#d3d3d3");
	$(".p32r").css("background-color", "#d3d3d3");
	$(".p30e").css("background-color", "#d3d3d3");
	$(".p31e").css("background-color", "#d3d3d3");
	$(".p32e").css("background-color", "#d3d3d3");
	$(".p20o").css("background-color", "#d3d3d3");
	$(".p20o").css("color", "#fefefe");
	$(".p21o").css("background-color", "#d3d3d3");
	$(".p21o").css("color", "#fefefe");
	$(".franja").css("height", "646px");
	
	$("p.nEje1 a").css("color", "#fff");
	$("p.nEje2 a").css("color", "#fff");
	$("p.nEje3 a").css("color", "#fff");
	$("p.nEje4 a").css("color", "#fff");
	$("p.nEje5 a").css("color", "#fff");
	$("p.nEje6 a").css("color", "#fff");
	$("p.nEje7 a").css("color", "#fff");
	$("p.nEje8 a").css("color", "#fff");
	$("p.nEje9 a").css("color", "#fff");
	$("p.nEje10 a").css("color", "#fff");
	$("p.nEje11 a").css("color", "#000");
	
	$("p.nEje1").css("background-color", "#4d4d57");
	$("p.nEje2").css("background-color", "#4d4d57");
	$("p.nEje3").css("background-color", "#4d4d57");
	$("p.nEje4").css("background-color", "#4d4d57");
	$("p.nEje5").css("background-color", "#4d4d57");
	$("p.nEje6").css("background-color", "#4d4d57");
	$("p.nEje7").css("background-color", "#4d4d57");
	$("p.nEje8").css("background-color", "#4d4d57");
	$("p.nEje9").css("background-color", "#4d4d57");
	$("p.nEje10").css("background-color", "#4d4d57");
	
	$(".p0r").css("background-color", "#a9a9ae");
	$(".p1r").css("background-color", "#a9a9ae");
	$(".p0e").css("background-color", "#a9a9ae");
	$(".p1e").css("background-color", "#a9a9ae");
	$(".p0o").css("background-color", "#a9a9ae");
	$(".p0o").css("color", "#000");
	$(".p1o").css("background-color", "#a9a9ae");
	$(".p1o").css("color", "#000");
	
	$(".p2r").css("background-color", "#a9a9ae");
	$(".p3r").css("background-color", "#a9a9ae");
	$(".p2e").css("background-color", "#a9a9ae");
	$(".p3e").css("background-color", "#a9a9ae");
	$(".p2o").css("background-color", "#a9a9ae");
	$(".p2o").css("color", "#000");
	$(".p3o").css("background-color", "#a9a9ae");
	$(".p3o").css("color", "#000");
	
	$(".p4r").css("background-color", "#a9a9ae");
	$(".p5r").css("background-color", "#a9a9ae");
	$(".p4e").css("background-color", "#a9a9ae");
	$(".p5e").css("background-color", "#a9a9ae");
	$(".p4o").css("background-color", "#a9a9ae");
	$(".p4o").css("color", "#000");
	$(".p5o").css("background-color", "#a9a9ae");
	$(".p5o").css("color", "#000");
	
	$(".p6r").css("background-color", "#a9a9ae");
	$(".p7r").css("background-color", "#a9a9ae");
	$(".p6e").css("background-color", "#a9a9ae");
	$(".p7e").css("background-color", "#a9a9ae");
	$(".p6o").css("background-color", "#a9a9ae");
	$(".p6o").css("color", "#000");
	$(".p7o").css("background-color", "#a9a9ae");
	$(".p7o").css("color", "#000");
	
	$(".p8r").css("background-color", "#a9a9ae");
	$(".p9r").css("background-color", "#a9a9ae");
	$(".p8e").css("background-color", "#a9a9ae");
	$(".p9e").css("background-color", "#a9a9ae");
	$(".p8o").css("background-color", "#a9a9ae");
	$(".p8o").css("color", "#000");
	$(".p9o").css("background-color", "#a9a9ae");
	$(".p9o").css("color", "#000");
	
	$(".p10r").css("background-color", "#a9a9ae");
	$(".p11r").css("background-color", "#a9a9ae");
	$(".p10e").css("background-color", "#a9a9ae");
	$(".p11e").css("background-color", "#a9a9ae");
	$(".p10o").css("background-color", "#a9a9ae");
	$(".p10o").css("color", "#000");
	$(".p11o").css("background-color", "#a9a9ae");
	$(".p11o").css("color", "#000");
	
	$(".p12r").css("background-color", "#a9a9ae");
	$(".p13r").css("background-color", "#a9a9ae");
	$(".p12e").css("background-color", "#a9a9ae");
	$(".p13e").css("background-color", "#a9a9ae");
	$(".p12o").css("background-color", "#a9a9ae");
	$(".p12o").css("color", "#000");
	$(".p13o").css("background-color", "#a9a9ae");
	$(".p13o").css("color", "#000");
	
	$(".p14r").css("background-color", "#a9a9ae");
	$(".p15r").css("background-color", "#a9a9ae");
	$(".p14e").css("background-color", "#a9a9ae");
	$(".p15e").css("background-color", "#a9a9ae");
	$(".p14o").css("background-color", "#a9a9ae");
	$(".p14o").css("color", "#000");
	$(".p15o").css("background-color", "#a9a9ae");
	$(".p15o").css("color", "#000");
	
	$(".p16r").css("background-color", "#a9a9ae");
	$(".p17r").css("background-color", "#a9a9ae");
	$(".p16e").css("background-color", "#a9a9ae");
	$(".p17e").css("background-color", "#a9a9ae");
	$(".p16o").css("background-color", "#a9a9ae");
	$(".p16o").css("color", "#000");
	$(".p17o").css("background-color", "#a9a9ae");
	$(".p17o").css("color", "#000");
	
	$(".p18r").css("background-color", "#a9a9ae");
	$(".p19r").css("background-color", "#a9a9ae");
	$(".p18e").css("background-color", "#a9a9ae");
	$(".p19e").css("background-color", "#a9a9ae");
	$(".p18o").css("background-color", "#a9a9ae");
	$(".p18o").css("color", "#000");
	$(".p19o").css("background-color", "#a9a9ae");
	$(".p19o").css("color", "#000");
	
	$(".p20r").css("background-color", "#a9a9ae");
	$(".p21r").css("background-color", "#a9a9ae");
	$(".p22r").css("background-color", "#a9a9ae");
	$(".p23r").css("background-color", "#a9a9ae");
	$(".p24r").css("background-color", "#a9a9ae");
	$(".p25r").css("background-color", "#a9a9ae");
	$(".p26r").css("background-color", "#a9a9ae");
	$(".p27r").css("background-color", "#a9a9ae");
	$(".p28r").css("background-color", "#a9a9ae");
	$(".p29r").css("background-color", "#a9a9ae");

	
	$(".p20e").css("background-color", "#a9a9ae");
	$(".p21e").css("background-color", "#a9a9ae");
	$(".p22e").css("background-color", "#a9a9ae");
	$(".p23e").css("background-color", "#a9a9ae");
	$(".p24e").css("background-color", "#a9a9ae");
	$(".p25e").css("background-color", "#a9a9ae");
	$(".p26e").css("background-color", "#a9a9ae");
	$(".p27e").css("background-color", "#a9a9ae");
	$(".p28e").css("background-color", "#a9a9ae");
	$(".p29e").css("background-color", "#a9a9ae");
	
	
  });
});
</script>