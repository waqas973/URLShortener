    <?php 
    include "Components/dbConnection.php"; 


    $id = $_SESSION['singleView'];
   
    
    ?>
<script>
   
   <?php 
      
        $sql = "select browser_name, sum(clicks) as visit from detection where short_urls_id=:short_urls_id group by browser_name ";
        $stmt = $conn->prepare($sql);
        $params = array(
          "short_urls_id"=>$id
      ) ;
      $stmt->execute($params);
      ?>
 
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(pie);

      function pie() {
        var data = google.visualization.arrayToDataTable([
          ['Browser', 'Clicks'],
          <?php 
        while(  $result = $stmt->fetch(PDO::FETCH_ASSOC)){
             echo "['".$result['browser_name']."',".$result['visit']."],";
        }
        ?>
        ]);

        var options = {
          title: 'Top Browser',
          fontSize:18,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
  
      <?php 
  
  $sql = "select device_type, sum(clicks) as visit from detection where short_urls_id=:short_urls_id group by device_type ";
  $stmt = $conn->prepare($sql);
  $params = array(
    "short_urls_id"=>$id
) ;
$stmt->execute($params);

?>
      
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(system);

      function system() {
        var data = google.visualization.arrayToDataTable([
          ['System', 'visitors'],
          <?php 
        while(  $result = $stmt->fetch(PDO::FETCH_ASSOC)){
             echo "['".$result['device_type']."',".$result['visit']."],";
        }
        ?>
      
        ]);

        var options = {
          title: 'Top PLatform',
          fontSize:18,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('system'));
        chart.draw(data, options);
      }
      <?php 
  
  $sql = "select OS_type,sum(clicks) as visit from detection where short_urls_id=:short_urls_id group by OS_type ";
  $stmt = $conn->prepare($sql);
  $params = array(
    "short_urls_id"=>$id
) ;
$stmt->execute($params);

?>
         
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(OSSystem);

      function OSSystem() {
        var data = google.visualization.arrayToDataTable([
          ['System', 'Visitors'],
          <?php 
        while(  $result = $stmt->fetch(PDO::FETCH_ASSOC)){
             echo "['".$result['OS_type']."',".$result['visit']."],";
        }
        ?>
      
        ]);

        var options = {
          title: 'Top OS System',
          fontSize:18,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('OSSystem'));
        chart.draw(data, options);
      }
  

     <?php 
  
  $sql = "select country,sum(clicks) as visit from detection where short_urls_id=:short_urls_id group by country ";
  $stmt = $conn->prepare($sql);
  $params = array(
    "short_urls_id"=>$id
) ;
$stmt->execute($params);

?>
    
      google.charts.load('current', {
        'packages':['geochart'],
      
        'mapsApiKey': 'AIzaSyCDdfvfBe7Slmpnmqf5LGTXky5osoxtyZY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Visitors'],
          <?php 
        while(  $result = $stmt->fetch(PDO::FETCH_ASSOC)){
             echo "['".$result['country']."',".$result['visit']."],";
        }
        ?>
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }

      </script>
