<?php 
include("sql_historico.php"); 
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>Registro Historico De TRM</title>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <style type="text/css">${demo.css}</style>
    <script >


     </script>
  </head>

  <body>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <script language="JavaScript">
      $(document).ready(function() {  
 $.getScript('http://especiales.elheraldo.co/cambio_del_dolar/js.js', function () {
      Highcharts.setOptions({
              lang: {
              months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
              weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
              shortMonths:[ "Ene" , "Feb" , "Mar" , "Abr" , "May" , "Jun" , "Jul" , "Ago" , "Sep" , "Oct" , "Nov" , "Dic"]
            },
            colors: ['#50B432']

      });

  Highcharts.dateFormat({
            shortMonths:[ "Ene" , "Feb" , "Mar" , "Abr" , "May" , "Jun" , "Jul" , "Ago" , "Sep" , "Oct" , "Nov" , "Dic"]
      });

        var credits = {
            enabled: false
        };
        var chart = {
            
            zoomType: 'x'
         }; 

         var title = {
             text: 'Cambio del Dólar a través del tiempo'   
         };

         var subtitle = {
            text: 'Haga clic y arrastre hasta el área deseada para hacer  zoom'
         };

         var xAxis = {
            type: 'datetime',
            /*dateTimeLabelFormats: { // don't display the dummy year
               month: '%e. %b',
               year: '%b'
            },*/
            title: {
               text: 'Periodos'
            }
         };

         var yAxis = {
          floor: 0,
            gridLineDashStyle: 'longdash',
            title: {
               text: 'Valores Registrados'
            },
            labels: {
                format: '{value} '
            },
            min: 0
         };

         var legend= {
             enabled: false
         };

         var tooltip = {          
            valueDecimals: 2,
            valuePrefix: '$',
            color: "#333333",
            valueSuffix: ' Pesos'
         };
        var navigation= {
            buttonOptions: {
                align: 'center',
                enabled:false
            }
        }
         var plotOptions= {
           
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
          };

      var series= [{
       
      type: 'area',
      color: '#1D1B1B',
      name: 'Registro desde 1991-2015',
        // Define the data points. All series have a dummy year
        // of 1970/71 in order to be compared on the same x axis. Note
        // that in JavaScript, months start at 0 for January, 1 for February etc.
     data: [<?php echo join($data, '') ?>]
     // data: datos
    
    }
      ]; 

         var json = {};
         json.chart = chart;
         json.title = title;
         json.subtitle = subtitle;
         json.tooltip = tooltip;
         json.xAxis = xAxis;
         json.yAxis = yAxis;  
         json.series = series;
         json.plotOptions = plotOptions;
         json.legend= legend;
         json.credits=credits;
         json.navigation=navigation;
         $('#container').highcharts(json);
});        
});
    </script>
    <script src="js/highcharts.js"></script>
    <script src="js/modules/exporting.js"></script>
    
  </body>
</html>