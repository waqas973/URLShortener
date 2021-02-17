
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Url with Sid 1', 'Url with Sid 2'],
        ['Jan',  1000,      400],
        ['Feb',  1170,      460],
        ['March',  660,       1120],
        ['May',  1030,      540]
      ]);

      var options = {
        title: 'Last Two url Compare',
        curveType: 'function',
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }


    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(pie);

      function pie() {
        var data = google.visualization.arrayToDataTable([
          ['Browser', 'Clicks'],
          ['Chrome',     11],
          ['FireFox',      2],
          ['Safari',  2],
          ['uc Browser', 2],
          ['Microscoft Edge',    7]
        ]);

        var options = {
          title: 'Top Browser',
          fontSize:18,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
  

      
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(system);

      function system() {
        var data = google.visualization.arrayToDataTable([
          ['System', 'Clicks'],
          ['PC', 5],
          ['Mobile',     11],
          ['Tablet',      5],
      
        ]);

        var options = {
          title: 'Top PLatform',
          fontSize:18,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('system'));
        chart.draw(data, options);
      }
  
         
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(OSSystem);

      function OSSystem() {
        var data = google.visualization.arrayToDataTable([
          ['System', 'Clicks'],
          ['Window', 5],
          ['Andriod',     11],
          ['IOS',      5],
      
        ]);

        var options = {
          title: 'Top OS System',
          fontSize:18,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('OSSystem'));
        chart.draw(data, options);
      }
  


    
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyCDdfvfBe7Slmpnmqf5LGTXky5osoxtyZY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['Pakistan', 200],
          ['India', 300],
          ['China', 400],
          ['Canada', 500],
          ['France', 600],
          ['RU', 700]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }

   


