/*let matriz2=[];
let matriz=[];
let matrizEje=[];
let ejes=['Estrategias de seguridad','Plan estratégico','Infraestructura','Gestion administrativa','Autogestión de recursos','Exposición permanente','Exposiciones temporales','Bellas artes para','Difución e imagen','Publicaciones','Estrategia digital'];
let area=['Electrónicos','Servicios al público','Coordinación Operativa','Limpieza','Pintura','Iluminacion','Administrador','Dirección','Jefa de Oficina','Relaciones Públicas','Proyectos Especiales','Sistemas','Fotografia','Subdirección Técnica','Indicadores','Exhibición','Registro','Mediación','Difusión','Museografía','Arquitectura','Diseño','Editorial','Investigación','Administración','Presupuesto','Recursos Humanos','Recursos Financieros','Recursos Materiales','Jurídico','Seguridad','Custodios','Amigos del MPBA','INBAL'];

let areaEjeGrafica=['Electrónicos','Servicios al público','Coordinación Operativa','Limpieza','Pintura','Iluminacion','Administrador','Dirección','Jefa de Oficina','Relaciones Públicas','Proyectos Especiales','Sistemas','Fotografia','Subdirección Técnica','Indicadores','Exhibición','Registro','Mediación','Difusión','Museografía','Arquitectura','Diseño','Editorial','Investigación','Administración','Presupuesto','Recursos Humanos','Recursos Financieros','Recursos Materiales','Jurídico','Seguridad','Custodios','Amigos del MPBA','INBAL',{ role: 'annotation' }];

//let areaEjeGrafica=['Dirección','Jefa de Oficina','Relaciones Públicas','Proyectos Especiales','Sistemas','Fotografia','Subdirección Técnica','Indicadores','Exhibición','Registro','Mediación','Difusión','Museografía','Arquitectura','Diseño','Editorial','Investigación','Administración','Presupuesto','Recursos Humanos','Recursos Financieros','Recursos Materiales','Jurídico','Seguridad','Custodios','Amigos del MPBA','INBAL',{ role: 'annotation' } ];
let gfr=['Estrategias de seguridad','Plan estratégico','Infraestructura','Gestion administrativa','Autogestión de recursos','Exposición permanente','Exposiciones temporales','Bellas artes para','Difución e imagen','Publicaciones','Estrategia digital',{ role: 'annotation' } ]



let grafica={

    ObtenerMetricas:(fmetricas)=>{

    $("#opinionesAtendidas").html("");
        $.post("./Conexiones/SelectAllMetricas.php",{
            fmetricas:fmetricas
        },
       
        function (data, status) {
            if (status == "success") {
                let obj = JSON.parse(data);
                let countobj = Object.keys(obj).length;
                let promise= new Promise((resolve,reject)=>{
                if (countobj > 0) 
                {             
                     $.each(obj, function (i, item) {
                        let row=[];
                        row.push(area[i]);
                        $.each(item, function (j, item2) {
                           row.push(parseInt(item2));
                        });
                       
                        matriz.push(row);        
                    });
                    
                   
                    resolve();      
                }
                else
                {
                    reject();
                }
            });

            promise.then(()=>{


            });
            }
        });
    },
    ObtenerMetricasEjes:(fmetricas)=>{

        $("#opinionesAtendidas").html("");
            $.post("./Conexiones/SelectAllMetricas.php",
            {fmetricas:fmetricas},
            function (data, status) {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    let countobj = Object.keys(obj).length;
                    let promise= new Promise((resolve,reject)=>{
                    if (countobj > 0) 
                    {             
                         $.each(obj, function (i, item) {
                            let row=[];
                           
                            $.each(item, function (j, item2) {
                               row.push(parseInt(item2));
                            });
                           
                            matriz2.push(row);        
                        });
                        
                       
                        resolve();      
                    }
                    else
                    {
                        reject();
                    }
                });
    
                promise.then(()=>{
    
    
                });
    
                }
            });
        },
    mostrarGrafica:()=>{

        matriz.unshift(gfr);
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(
               matriz
                
        );
            var view = new google.visualization.DataView(data);
            var options = {
            title: 'Total de acuerdos recibidos',
            subtitle: 'Ejes',
            width: 1500,
            height: 600,
            
            bar: { groupWidth: '50%' },
            isStacked: true,
            chartArea:{left:'10%',top:'10%',width:'100%',height:'100%',right:'10%',bottom:'10%'}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }

    },
    mostrarGrafica2:()=>{
       
        matrizEje.unshift(areaEjeGrafica);
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(
                matrizEje
                
        );
            var view = new google.visualization.DataView(data);
            var options = {
            title: 'Ejes',
            subtitle: 'Total de acuerdos recibidos',
            width: 1500,
            height: 600,
            
            bar: { groupWidth: '40%' },
            isStacked: true,
            chartArea:{left:'5%',top:'5%',width:'100%',height:'100%',right:'5%',bottom:'10%'}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
            chart.draw(view, options);
        }

    } ,
    AgrupaEjes(){

            let posicion=0;
            matriz2=matriz2.map((col, i) => matriz2.map(row => row[i]));
            $.each(ejes, function(i,item){
                let row=[];    
                matriz2[posicion].unshift(item)      
                matrizEje.push(matriz2[posicion]);
                posicion+=1;
            });

    }
      ,transpose:(matrix)=> {
        return Object.keys(matrix[0])
            .map(colNumber => matrix.map(rowNumber => rowNumber[colNumber]));
    }
    
}
$(document).ready(function () 
{
let fmetricas=$("#fechaMetricas").val();

grafica.ObtenerMetricas(fmetricas);

grafica.ObtenerMetricasEjes(fmetricas);

$("#fechaMetricas").change(function(){
    fmetricas=$("#fechaMetricas").val();
    grafica.ObtenerMetricas(fmetricas);
    grafica.ObtenerMetricasEjes(fmetricas);
    grafica.mostrarGrafica2();
    grafica.mostrarGrafica();
    reportes.ExposicionesTemporales(fmetricas);

});

           
});*/