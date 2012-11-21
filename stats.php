<?php
function stats()
{
$datasets = mysql_num_rows(mysql_query("SELECT * FROM datasets"));
$visuals = mysql_num_rows(mysql_query("SELECT * FROM charts"));

	print "Datasets: <span class='text1'>$datasets</span> \r";
	print "<br />";
	print "Visualizations: <span class='text1'>$visuals</span>";
}
?>