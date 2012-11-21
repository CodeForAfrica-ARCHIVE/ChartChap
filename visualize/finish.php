<?php
require_once('../config.php');
require_once('../header.php');
?>
<div class="well">
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="#">Choose visualization type</a>
			</div>
		</div>
		
		<div class="info-widget">
			<div class="row-fluid">
<?php
$title = $_POST['title'];
$type= $_POST['type'];
$label1 = $_POST['label1'];
$dataset = $_POST['dataset'];
if($type=='PieChart')
{
	$label2 = $_POST['label2'];
}
else
{
	$label = implode(',', $_POST['label']);
	$label2 = $label;
}
$sql = mysql_query("INSERT INTO charts( `type`, `title`, `label1`, `label2`, `dataset`)VALUES('$type', '$title', '$label1', '$label2', '$dataset')");
if($sql)
{
	echo "Chart created! ";
	
	$sql = mysql_query("SELECT * FROM charts ORDER BY id Desc");
	$row =mysql_fetch_array($sql);
	
	//header('Location:'.$home.'chart.php?id='.$row['id']);
	echo '<div align="center"><a href="'.$home.'chart.php?id='.$row['id'].'" class="btn btn-primary">View Chart</a></div>';
	
}
?>
</div>
			<div class="line-divider"></div>
			
		</div>
 </div>        
<?php

require_once('../footer.php');
?>