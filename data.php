<?php
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
