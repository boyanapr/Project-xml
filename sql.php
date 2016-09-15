<?php
$con=mysql_connect("localhost","root","1234567") or die("Failed to connect with database!!!!");
mysql_select_db("measurements",$con);
$sth = mysql_query("SELECT * FROM meas");
$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(
  array('label' => 'location', 'type' => 'string'),
    array('label' => 'temperature', 'type' => 'number'),
array('label' => 'humidity', 'type' => 'number')
);

$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will be used to slice the LineChart 
    $temp[] = array('v' => (string) $r['location']); 

    // Values of each slice
    $temp[] = array('v' => (int) $r['temperature']); 
	$temp[] = array('v' => (int) $r['humidity']);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
//echo $jsonTable;

?>
<html>
  <head>
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
           title: 'My Results',
          is3D: 'true',
          width: 800,
          height: 600
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>

  <body>
    <!--this is the div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>