<?php
function PieChart($id)
{
	echo "<tr><td>Label</td>";
		//Label
	$sql=mysql_query("SELECT * FROM datasets WHERE id='".$id."'");
	$row=mysql_fetch_array($sql);
		$table = $row['table'];
		
		$result = mysql_query("SHOW COLUMNS FROM $table");
		$result2 = mysql_query("SHOW COLUMNS FROM $table");
	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}
	if (mysql_num_rows($result) > 0) {
		
		$fields=array();
		echo "<td><select name='label1'>";
		while ($rowa = mysql_fetch_assoc($result)) {
			foreach($rowa as $key=>$value){
			if($key=='Field')
			echo"<option value='$value'>$value</option>";
			}
		}
		echo "</select></td></tr>";
		
		
		
	}
	//values
	echo "<tr><td>Values</td>";
	if (mysql_num_rows($result2) > 0) {
		
		$fields=array();
		echo "<td><select name='label2'>";
		while ($rowa = mysql_fetch_assoc($result2)) {
			foreach($rowa as $key=>$value){
			if($key=='Field')
			echo"<option value='$value'>$value</option>";
			}
		}
		echo "</select></td></tr>";
		
		
		
	}
}
function LineChart($id)
{ 
 echo "<tr><td>x-axis</td>";
$sql=mysql_query("SELECT * FROM datasets WHERE id='".$id."'");
	$row=mysql_fetch_array($sql);
		$table = $row['table'];
		
		$result = mysql_query("SHOW COLUMNS FROM $table");
		$result2 = mysql_query("SHOW COLUMNS FROM $table");
		
	//show x-axis
	if (!$result) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}
	if (mysql_num_rows($result) > 0) {
		
		$fields=array();
		echo "<td><select name='label1'>";
		while ($rowa = mysql_fetch_assoc($result)) {
			foreach($rowa as $key=>$value){
			if($key=='Field')
			echo"<option value='$value'>$value</option>";
			}
		}
		echo "</select></td></tr>";		
		
	}
	//show other things to plot
	echo "<tr><td></td><td><b>Chart Parameters</b></td></tr>";
	if (!$result2) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}
	if (mysql_num_rows($result2) > 0) {
		
		$fields=array();
		
		while ($rowa = mysql_fetch_assoc($result2)) {
			foreach($rowa as $key=>$value){
			if($key=='Field'&&$value!='id')
			{
			echo "<tr><td><input type='checkbox' name='label[]' value='".$value."'></td><td>";
			echo"$value";
			echo "</td></tr>";
			}
			}
		}
				
		
	}
}
?>