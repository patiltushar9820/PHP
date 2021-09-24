<!DOCTYPE html>
<html>
<head>
<title>Graph Date Vs Close </title>
</head>
<body bgcolor="lightgreen">
<?Php
use GoDigital\DataBaseOpr;

require_once 'DataBaseOpr.php';
$db = new DataBaseOpr();
$conn = $db->getConnection();
//query for retrive date and close value from database
if($stmt = $conn->query("SELECT Date1,Close FROM bse_bom500325")){

 // echo "No of records : ".$stmt->num_rows."<br>";
$php_data_array = Array(); // create PHP array
 
while ($row = $stmt->fetch_row()) {
  // echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
   $php_data_array[] = $row; // Adding to array
   }


}else{
echo $connection->error;
}

//echo json_encode($php_data_array); 
// Transfor PHP array to JavaScript two dimensional array for plotting a graph
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
?>
<?php
//Uses thise ready script for graph plotting
?>
<div id="curve_chart"></div>
<br><br>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  //Plot Graph With 
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Close');
		
        for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0],parseInt(my_2d[i][1])]);
    //Define Graph Size(Window)
       var options = {
          title: 'Date Vs Close Graph',
        curveType: 'function',
		width: 1500,
        height: 500,
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
       }
	
</script>
</body></html>







