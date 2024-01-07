

function cambiarColorcatalogo(page){

	 //console.log(page);
	pagina = page;
  //alert(pagina[0]);
	//console.log(pagina[0]);
	$("#cagentes").removeClass("sel2");
	$("#ctipos").removeClass("sel2");
	$("#cestatusd").removeClass("sel2");
	$("#cestatusex").removeClass("sel2");
	$("#cmetapd").removeClass("sel2");
	$("#cubicacion").removeClass("sel2");
	if(pagina === 1){
			$("#cagentes").addClass("sel2");
		}
    if(pagina === 2){
     	$("#ctipos").addClass("sel2");
    }
		if(pagina === 3){
		//console.log('entra general');	
		  $("#cestatusd").addClass("sel2");
		}
		if(pagina === 4){
		  //console.log('entra historica');	
		  $("#cestatusex").addClass("sel2");
		}
    if(pagina === 5){
      //console.log('entra historica'); 
      $("#cmetapd").addClass("sel2");
    }
    if(pagina === 6){
      //console.log('entra historica'); 
      $("#cubicacion").addClass("sel2");
    }

	
}