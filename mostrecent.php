<?php
function mostrecent($id)
{
$sql = mysql_query("SELECT * FROM charts WHERE id='$id'");
$row =mysql_fetch_array($sql);

$type=$row['type'];
$title=$row['title'];
$label1=$row['label1'];
$label2=$row['label2'];

$dataset=$row['dataset'];

$sql3 = mysql_query("SELECT * FROM datasets WHERE id='$dataset'");
$row3 =mysql_fetch_array($sql3);


$table=$row3['table'];


$data = array();
//piechart
if($type=='PieChart')
{
	
	$data[]= "['$label1', '$label2']";
	
	$sql2 = mysql_query("SELECT * FROM $table");

	while($row2=mysql_fetch_array($sql2))
	{
		$data[]="['".$row2[$label1]."', ".$row2[$label2]."]";
	}
}

//linechart
else //if($type=='LineChart')
{
	$label3 = $label2;
	$total = substr_count($label2, ',');
	$label2 = explode(',', $label2);
	$total = $total+1;
	$labels=array();
	for($i=0;$i<$total;$i++)
	{
	$labels[]="'".$label2[$i]."'";
	}
	$labels=implode(', ', $labels);
	
	
	$data[]= "['$label1', $labels]";
	
	$sql2 = mysql_query("SELECT * FROM $table");
$total = substr_count($label3, ',');
		$label3 = explode(',', $label3);
		$total = $total+1;
		
	while($row2=mysql_fetch_array($sql2))
	{
		$rowf=array();
		for($i=0;$i<$total;$i++)
		{
		$rowf[]=$row2[$label3[$i]];
		}
		$rowf=implode(', ', $rowf);
		
		$data[]="['".$row2[$label1]."', $rowf]";
	}
}

$data =implode(', ', $data);
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php echo $data;?>
        ]);

        var options = {
         <?php
echo "title:'".$title."'";

?>
        };

        var chart = new google.visualization.<?php echo $type;?>(document.getElementById('chart_div<?php echo $id?>'));
        chart.draw(data, options);
      }
    </script>

<div id="chart_div<?php echo $id?>" style="width: 100%; height: 300px;"></div>
<?php
}
?>

                   