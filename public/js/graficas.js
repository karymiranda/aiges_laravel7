/*function cambiar_fecha_grafica(){

    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    cargar_grafica_barras(anio_sel,mes_sel);
    cargar_grafica_lineas(anio_sel,mes_sel);
}


 function cargar_grafica_barras(anio,mes){

var options={
	 chart: {
	 	    renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'MATRICULAS POR GRADO'
        },
        subtitle: {
            text: 'Source: aiges.edu'
        },
        xAxis: {
            categories: [],
             title: {
                text: 'GRADOS'//leyenda del eje x
           
            
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'ALUMNOS MATRICULADOS'//leyenda del eje y
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'registros',
            data: []

        }]
}

$("#div_grafica_barras").html( $("#cargador_empresa").html() );

var url = "grafica_registros/"+anio+"/"+mes+"";


$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
	for(i=1;i<=totaldias;i++){
	
	options.series[0].data.push( registrosdia[i] );
	options.xAxis.categories.push(i);


	}

 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})


}



function cargar_grafica_lineas(anio,mes){

var options={
     chart: {
            renderTo: 'div_grafica_lineas',
           
        },
          title: {
            text: 'Numero de Registros en el Mes',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: aiges.edu',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'REGISTROS POR DIA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' registros'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'registros',
            data: []
        }]
}

$("#div_grafica_lineas").html( $("#cargador_empresa").html() );
var url = "grafica_registros/"+anio+"/"+mes+"";
$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
    for(i=1;i<=totaldias;i++){
    
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);


    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})


}




function cargar_grafica_pie(){

var options={
     // Build the chart
     
            chart: {
                renderTo: 'div_grafica_pie',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafica publicaciones'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: []
            }]
     
}

$("#div_grafica_pie").html( $("#cargador_empresa").html() );

var url = "";


$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var tipos=datos.tipos;
var totattipos=datos.totaltipos;
var numeropublicaciones=datos.numerodepubli;

    for(i=0;i<=totattipos-1;i++){  
    var idTP=parseInt(tipos[i].id);
    var objeto= {name: tipos[i].titulo, y:numeropublicaciones[idTP] };     
    options.series[0].data.push( objeto );  
    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})
}
*/

////////////////////////ONLOAD FUNCTIONS//////////////////////////////////////

function cambiar_anio_grafica(){

    var anio_sel=$("#anio_sel").val();
   cargar_graficamatriculas(anio_sel);
   cargar_graficamatriculasanio(anio_sel);
}


function cargar_graficamatriculas(anio){
    var options = {
        chart: 
        {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'MATRICULAS POR GRADO'
        },
        subtitle: {
            text: 'Source: aiges.edu'
        },
        xAxis: {
            categories: [],
                title: {
                text: 'GRADOS'//leyenda del eje x
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'ALUMNOS MATRICULADOS'//leyenda del eje y
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels:{enabled:false}
            }
        },
        series: [
            {
                name: 'Niños',
                data: []
            },
            {
                name: 'Niñas',
                data: []   
            }
            ,
            {
                name: 'Nuevo ingreso',
                data: []   
            },
            {
                name: 'Antiguo ingreso',
                data: []   
            }
        ]
    }

    $("#div_grafica_barras").html( $("#cargador_empresa").html() );
    var url = "graficadebarras_historialmatricula/"+anio+"";

    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        for (var i = 0; i <= datos.length - 1; i++) {
            options.xAxis.categories.push(datos[i].grado);
            options.series[0].data.push( datos[i].masculino );
            options.series[1].data.push( datos[i].femenino );
            options.series[2].data.push( datos[i].nuevoingreso );
            options.series[3].data.push( datos[i].antiguoingreso );
        }
        chart = new Highcharts.Chart(options);
    })
    console.log(options)
}



function cargar_graficamatriculasanio(anio){

var options={
     chart: {
            renderTo: 'div_grafica_lineas',
             type: 'column'
           
        },
          title: {
            text: 'HISTORIAL QUINQUENAL MATRICULAS',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: aiges.edu',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'MATRICULAS POR AÑO ACADEMICO'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' registros'
        },
         plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels:{enabled:true}
            }
        },
       /* legend: {//al comentar esto coloca la leyenda default, en el eje horizontal
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },*/
        series: [{
            name: 'Niños',
            data: []

        },
        {
         name: 'Niñas',
            data: []   
        }
        ]
}

$("#div_grafica_lineas").html( $("#cargador_empresa").html() );
var url = "graficadelineasmatriculaanual/"+anio+"";

$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);

for (var i = 0; i <= datos.length - 1; i++) {
    options.xAxis.categories.push(datos[i].año);
    options.series[0].data.push( datos[i].niños);
    options.series[1].data.push( datos[i].niñas);
}
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})


}


function cargar_grafica_pie(){
var options={
     // Build the chart
     
            chart: {
                renderTo: 'div_grafica_pie',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Población Estudiantil'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        //format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                         format: '<b>{point.name}</b>: {point.y}'                           
                    },
                    showInLegend: true
                }
            },
        series: [{
            colorByPoint: true,
            data: [
            ]
        }
        ]

     
}

$("#div_grafica_pie").html( $("#cargador_empresa").html() );

var url = "graficadepastel_estudiantesactivos";
$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
console.log(datos)
var objeto= {name: 'niños', y:datos[0] };
options.series[0].data.push( objeto );
var objeto= {name: 'niñas', y:datos[1] };
options.series[0].data.push( objeto );
 
//options.series[1].data.push( datos[1] ); 
/*
var tipos=datos.tipos;
var totattipos=datos.totaltipos;
var numeropublicaciones=datos.numerodepubli;

    for(i=0;i<=totattipos-1;i++){  
    var idTP=parseInt(tipos[i].id);
    var objeto= {name: tipos[i].titulo, y:numeropublicaciones[idTP] };     
    options.series[0].data.push( objeto );  
    }*/
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})








}