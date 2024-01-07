<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/sankey.js"></script>
	<script src="https://code.highcharts.com/modules/organization.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
 <style>
 
#container {
  /*  min-width: 300px;
    overflow: scroll !important;*/
}
 .highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 2000px;
    margin: 1em auto;
	height: 1000px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

#container h4 {
   text-transform: none;
    font-size: 10.5px;
    font-weight: bold;
}

#container p {
    font-size: 9px;
    line-height: 11px;
}

@media screen and (max-width: 600px) {
    #container h4 {
        font-size: 2.3vw;
        line-height: 3vw;
    }

    #container p {
        font-size: 2.3vw;
        line-height: 3vw;
    }
}
 </style>
</head>
<body>
<figure class="highcharts-figure">
    <div id="container"></div>
   
</figure>


</body>
<script>
$('document').ready(function()
{
 var myChart =	Highcharts.chart('container', {
    chart: {
        height: 1500,
		//width: 3000,
        inverted: true,
		
    },

    title: {
        text: 'Organigrama'
    },

    accessibility: {
        point: {
            descriptionFormatter: function (point) {
                var nodeName = point.toNode.name,
                    nodeId = point.toNode.id,
                    nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                    parentDesc = point.fromNode.id;
                return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
            }
        }
    },

    series: [{
        type: 'organization',
        name: '',
        keys: ['from', 'to'],
        data: [
          
            
			
			
			
			
			
			['Consejo de Administración', ''],
			 
            ['DIRECCION', 'AdminPat'],
            ['DIRECCION', 'Admin'],
			
            ['DIRECCION', 'Técnica'],
			['DIRECCION', 'OficinaProyectos'],
			
			
            ['DIRECCION', 'Difusion'],
			['DIRECCION', 'MediacionEducativa'],
			['DIRECCION', 'VinculacionSocial'],
			['DIRECCION', 'Arquitectura'],
			['DIRECCION', 'ProcuracionFondos'],
			//['', 'ApoyoExterno'],
			
			
			
			['DIRECCION', 'RPI'],
			
			['AdminPat', 'Eventos'],
			//['Eventos', 'Asistente'],
			
			['AdminPat', 'Tienda'],
			['AdminPat', 'Cafetería'],
			
			['Admin', 'Contraloria'],
			['Admin', 'TI'],
			['Admin', 'Operaciones'],
			
			['Operaciones', 'Mantenimiento'],
			['Operaciones', 'Seguridad'],
			['Operaciones', 'Taquilla'],
			
			['Eventos', 'Asistente'],
			['Admin', 'Tesoreria'],
			['Admin', 'RH'],
			
			
			
			
			['Técnica', 'Exposiciones'],
			['Técnica', 'Coleccion'],
			['Técnica', 'Conservacion'],
			['Técnica', 'Curaduria'],
			
			
			['OficinaProyectos', 'SIE'],
			
			['Tienda', 'CoordinacionAdmin'],
			['Cafetería', 'AyudantesCafeteria'],
			
			
			
			
			['Coleccion', 'OperacionAlmacen'],
			['Coleccion', 'DocumentacionRegistro'],
			
			['Curaduria', 'CuradorANH'],
			['Curaduria', 'CuradorSiglo19'],
			['Curaduria', 'CuradorSiglo2021'],
			
			
			['Mantenimiento', 'AuxiliarMantenimiento'],
			['Mantenimiento', 'AuxiliarAdmin'],
			['Mantenimiento', 'TecnicoInfraestructura'],
			['Mantenimiento', 'TecnicoElectrico'],
			
			['Difusion', 'Redes'],
			['Difusion', 'Marketing'],
			['Difusion', 'DiseñoWeb'],
			
			['MediacionEducativa', 'InvestigacionEducativa'],
			['MediacionEducativa', 'ProyectosEducativos'],
			['MediacionEducativa', 'Anfitriones'],
			['MediacionEducativa', 'Publicaciones'],
			
			['VinculacionSocial', 'Voluntariado'],
			['VinculacionSocial', 'ServicioSocial'],
			['VinculacionSocial', 'PracticasProfesionales'],
			['VinculacionSocial', 'ProyectosSociales'],
			['VinculacionSocial', 'RelacionesComunitarias'],
			
			
			
			
			
            /*['CTO', 'Product'],
            ['CTO', 'Web'],
            ['CSO', 'Sales'],
            ['HR', 'Market'],
            ['CSO', 'Market'],
            ['HR', 'Market'],
            ['CTO', 'Market']*/
        ],
        levels: [{
            level: 0,
            color: 'silver',
            dataLabels: {
                color: 'black'
            },
            height: 150
        }, {
            level: 1,
            color: 'silver',
            dataLabels: {
                color: 'black'
            },
            height: 150
        },{
            level: 2,
            color: 'silver',
			dataLabels: {
                color: 'black'
            },
        },{
            level: 3,
            color: 'silver',
			dataLabels: {
                color: 'black'
            },
        }, {
            level: 4,
            color: 'silver',
			dataLabels: {
                color: 'black'
            },
        }, {
            level: 5,
            color: 'silver',
			dataLabels: {
                color: 'black'
            },
        }
		
		
		],
        nodes: [{
            id: 'DIRECCION',
            name: 'Dirección General',
			title: 'Miguel Fernández Félix',
            image: '',
			column: 2
        }, {
            id: 'AdminPat',
            title: 'Tony Regalado',
            name: 'Administración Patrimonial',
           /* color: '#007ad0',*/
            image: ''
        }, {
            id: 'Admin',
            title: 'Angélica Martínez',
            name: 'Administración',
            image: ''
        }, 
		
		
		
		
		{
            id: 'AuxiliarMantenimiento',
            title: '',
            name: 'Auxiliar de Mantenimiento',
            image: '',
			column: 8,
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd',
			offset: '-450%',
        },
		
		{
            id: 'AuxiliarAdmin',
            title: '',
            name: 'Auxiliar Administrativo',
            image: '',
			column: 9,
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd',
			offset: '-400%',
        },
		
		{
            id: 'TecnicoInfraestructura',
            title: '',
            name: 'Técnico en Infraestructura',
            image: '',
			column: 10,
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd',
			offset: '-350%',
        },
		{
            id: 'TecnicoElectrico',
            title: '',
            name: 'Técnico Eléctrico',
            image: '',
			column: 11,
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd',
			offset: '-350%',
        },
		
		
		
		{
            id: 'OperacionAlmacen',
            title: '',
            name: 'Operación Almacén',
            image: '',
			column: 11,
			offset: '-150%',
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd'
        },
		
		{
            id: 'DocumentacionRegistro',
            title: 'Adriana Clemente Mejía',
            name: 'Documentación y Registro',
            image: '',
			column: 12,
			offset: '-250%',
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd'
        },
		
		{
            id: 'CuradorANH',
            title: '',
            name: 'Curador Arte NovoHispano',
            image: '',
			column: 6,
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd',
			offset: '-450%',
			
        },
		
		{
            id: 'CuradorSiglo19',
            title: '',
            name: 'Curador Siglo XIX',
            image: '',
			color:'#800080',
			dataLabels: {
                color: 'white'
            },
			column: 7,
			height: 60,
			width: 80,
			opacity: .7,
			offset: '-400%',
        },
		
		{
            id: 'CuradorSiglo2021',
            title: 'becka Dumcamp',
            name: 'Curador Siglo XX, XXI',
            image: '',
			color:'#800080',
			dataLabels: {
                color: 'white'
            },
			column: 8,
			height: 60,
			width: 80,
			opacity: .7,
			offset: '-250%',
        },
	
		
		
		{
            id: 'Técnica',
            title: 'Khery Cámara',
            name: 'Técnica',
            image: ''
        },
		
		
		{
            id: 'OficinaProyectos',
            title: 'Andrea Villalba',
            name: 'Oficina de Proyectos',
            image: '',
			color:'#800080',
			dataLabels: {
                color: 'white'
            },
        }, 
		
		{
            id: 'Difusion',
            title: 'Krystel Sánchez Riot',
            name: 'Difusión',
            image: '',
			color:'#62c1ef',
			dataLabels: {
                color: 'black'
            },
        },
		
		
		
		
		
		{
            id: 'MediacionEducativa',
            title: 'Roxana Romero',
            name: 'Mediación Educativa',
            image: ''
        },
		
		
		
		{
            id: 'VinculacionSocial',
            title: 'Daniel Goldin',
            name: 'Vinculación Social',
            image: '',
			color:'#800080',
			dataLabels: {
                color: 'white'
            },
        },
		
		{
            id: 'Arquitectura',
            title: 'Karen Aguilar',
            name: 'Arquitectura',
            image: '',
			color:'#800080',
			dataLabels: {
                color: 'white'
            },
			
        },
		{
            id: 'ProcuracionFondos',
            title: 'Tessy Mustri',
            name: 'Procuración de fondos',
            image: '',
			color:'#800080',
			dataLabels: {
                color: 'white'
            },
        },
		
		
		
	
		
		
		{
            id: 'Consejo de Administración',
            title: 'Antonio del Valle, Blanca del Valle',
			
        },

		
		
		
		
		{
            id: 'RPI',
            title: 'Michelle Vargas',
            name: 'Relaciones Públicas e Institucionales',
            image: '',
			color:'#62c1ef',
			dataLabels: {
                color: 'black'
            },
			column: 2
        },
		
		
		
		
		{
            id: 'Eventos',
            title: 'Gaby Gamero',
            name: 'Eventos',
            image: '',
			column: 4,
			offset: '-100%',
			
        },
		{
            id: 'Tienda',
            title: 'Ma. Fernanda Millán',
            name: 'Tienda',
            image: '',
			column: 6,
			offset: '-150%',
        },
		{
            id: 'Cafetería',
            title: 'Héctor Dueñas',
            name: 'Cafetería',
            image: '',
			column: 8,
			offset: '-250%',
        },
		
		
		/*************************************************/
		
		 {
            id: 'Contraloria',
            title: 'Victor (Tony)',
            name: 'Contraloría',
            image: '',
			column: 4,
			offset: '-100%',
			
        }, 
		{
            id: 'TI',
            title: 'Fernando Escamilla',
            name: 'TI',
            image: '',
			column: 5,
			offset: '-50%',
		
        }, 
		
		{
            id: 'Operaciones',
            title: '',
            name: 'Operaciones',
            image: '',
			column: 6,
			offset: '-150%',
			
        },
		
		
		
		{
            id: 'Mantenimiento',
            title: 'Joel Aguilar',
            name: 'Mantenimiento',
            image: '',
			column: 7,
			
			opacity: .7,
			offset: '-300%',
			
        },
		{
            id: 'Seguridad',
            title: '',
            name: 'Seguridad',
            image: '',
			column: 12,
			
			opacity: .7,
			offset: '-250%',
			
        },
		
		{
            id: 'Taquilla',
            title: '',
            name: 'Taquilla',
            image: '',
			column:13,
			
			opacity: .7,
			offset: '-300%',
			
        },
		
		 {
            id: 'Tesoreria',
            title: '',
            name: 'Tesorería',
            image: '',
			column: 14,
			offset: '-300%',
        },
		 {
            id: 'RH',
            title: '',
            name: 'RH',
            image: '',
			column: 15,
			offset: '-300%',
        },
		
		/*****************************************************/
		
		{
            id: 'Conservacion',
            title: '',
            name: 'Conservación',
            image: '',
			column: 4,
			offset: '-100%',
        }, 
		{
            id: 'Curaduria',
            title: 'Alan',
            name: 'Curaduría',
            image: '',
			column: 5,
			offset: '-50%',
        }, 
		{
            id: 'Exposiciones',
            title: 'Xavier de la Riva',
            name: 'Exposiciones',
            image: '',
			column: 9,
			offset: '-100%',
        }, 
		{
            id: 'Coleccion',
            title: '',
            name: 'Colección',
            image: '',
			column: 10,
			offset: '-150%',
        }, 
		
		
		
		
		
		/*******************************************/
		
		{
            id: 'SIE',
            title: 'Misael Ortiz',
            name: 'SIE',
            image: '',
			column: 4,
			offset: '-100%',
			
        }, 
		
		/******************************************/
		
		 {
            id: 'Redes',
            title: 'Sandra Santacruz',
            name: 'Redes',
            image: '',
			color:'#62c1ef',
			dataLabels: {
                color: 'black'
            },
			column: 4,
			offset: '-100%',
			
        },
		{
            id: 'Marketing',
            title: '',
            name: 'Marketing',
            image: '',
			color:'red',
			dataLabels: {
                color: 'white'
            },
			column: 5
			,offset: '50%',
        },
		{
            id: 'DiseñoWeb',
            title: 'Roberto Crail',
            name: 'Diseño Web',
            image: '',
			color:'#62c1ef',
			dataLabels: {
                color: 'black'
            },
			column: 6,
			offset: '50%',
			
        },
		
		/***************************************************/
		
		{
            id: 'InvestigacionEducativa',
            title: 'David Bourget',
            name: 'Investigación Educativa',
            image: '',
			color:'#62c1ef',
			dataLabels: {
                color: 'black'
            },
			column: 4,
			offset: '-100%',
			
        },
		{
            id: 'ProyectosEducativos',
            title: 'Brenda Lorena Islas (Museo Frida Kahlo)',
            name: 'Proyectos Educativos',
            image: '',
			column: 5,
			offset: '50%',
        },
		{
            id: 'Anfitriones',
            title: '',
            name: 'Anfitriones',
            image: '',
			color:'#62c1ef',
			dataLabels: {
                color: 'black'
            },
			column: 6,
			offset: '50%',
        },
		{
            id: 'Publicaciones',
            title: '',
            name: 'Publicaciones',
            image: '',
			color:'red',
			dataLabels: {
                color: 'white'
            },
			column: 7,
			offset: '300%',
        },
		
		
		/******************************************************/
		
		{
            id: 'Voluntariado',
            title: '',
            name: 'Voluntariado',
            image: '',
			column: 6,
			offset: '50%',
        },
		{
            id: 'ServicioSocial',
            title: '',
            name: 'Servicio Social',
            image: '',
			column: 7,
			offset: '300%',
        },
		{
            id: 'PracticasProfesionales',
            title: '',
            name: 'Prácticas Profesionales',
            image: '',
			column: 8,
			offset: '250%',
        },
		
				{
            id: 'ProyectosSociales',
            title: '',
            name: 'Proyectos Sociales',
            image: '',
			color:'red',
			dataLabels: {
                color: 'white'
            },
			column: 4,
			offset: '-100%',
			
        },
		
				{
            id: 'RelacionesComunitarias',
            title: '',
            name: 'Relaciones Comunitarias',
            image: '',
			color:'red',
			dataLabels: {
                color: 'white'
            },
			column: 5,
			offset: '50%',
			
        },
		
		
		/****************************************************/
		/*--------------------------------------------------------------*/
		{
            id: 'Asistente',
            title: 'Selene Ramos',
            name: 'Asistente',
            image: '',
			column: 5,
			offset: '-650%',
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd'
			
        },
		
		{
            id: 'CoordinacionAdmin',
            title: 'María Sotelo, auxiliar administrativo',
            name: 'Coordinación Administrativa',
            image: '',
			column: 7,
			offset: '-500%',
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd'
        },
	
		{
            id: 'AyudantesCafeteria',
            title: 'Judith, Ivonne',
            name: 'Ayudantes de Cafetería',
            image: '',
			column: 9,
			offset: '-400%',
			height: 60,
			width: 80,
			opacity: .7,
			color: '#ccccccbd'
        },
		/*--------------------------------------------------------------*/
		
		/*
		{
            id: 'ApoyoExterno',
            title: 'Rosal Cruz',
            name: 'Apoyo Externo',
            image: '',
			color:'black',
			dataLabels: {
                color: 'white'
            },
			column: 3
        },*/

		/*{
            id: 'Web',
            name: 'Web devs, sys admin'
        }, {
            id: 'Sales',
            name: 'Sales team'
        }, {
            id: 'Market',
            name: 'Marketing team',
            column: 5
        }*/],
        colorByPoint: false,
        color: '#007ad0',
        dataLabels: {
            color: 'white'
        },
        borderColor: 'white',
        nodeWidth: 65
    }],
    tooltip: {
        outside: true
    },
    exporting: {
        allowHTML: true,
        sourceWidth: 1800,
        sourceHeight: 1600
    }

});


});


</script>
</html>