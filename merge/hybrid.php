<?php require_once('../config.php');?>
   <script type="text/javascript">



--></script>                    
                    <section>
<?php
$d1=$_POST['d1'];
$d2=$_POST['d2'];
?>

<?php
//find out which columns to recommend


?>

<div id="context2"></div>
<div id='formstuff2'>
Name:<br>
<input type="text" name="name" style='width:100%' id='name'>
<br>
Category:<br>
<select style='width:100%' name='category' id='category'>
<option>Select Category</option>
<option value='health'>Health</option>
<option value='education'>Education</option>
<option value='water'>Water</option>
<option value='counties'>Counties</option>
</select>
<br>
Description:<br>
<textarea name='description' rows='7' style='width:100%' id='description'>
</textarea><br>
<b>Choose correspoding fields</b>
<br>
<?php
$sql=mysql_query("SELECT * FROM datasets WHERE isHybrid='0' AND id='$d1'");
while($row=mysql_fetch_array($sql))
{
	echo $row['name']."<br>";
	$table = $row['table'];
	
	$result = mysql_query("SHOW COLUMNS FROM $table");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
if (mysql_num_rows($result) > 0) {
	echo"<select name='v1' style='width:100%' id='v1'>";
	
    while ($rowa = mysql_fetch_assoc($result)) {
        foreach($rowa as $key=>$value){
		if($key=='Field')
		echo "<option>".$value."</option>";
		}
    }
	
	
	echo"</select>";
}
}
//Dataset 2

$sql=mysql_query("SELECT * FROM datasets WHERE id='$d2'");
while($row=mysql_fetch_array($sql))
{
	echo $row['name'];
	$table = $row['table'];
	
	$result = mysql_query("SHOW COLUMNS FROM $table");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
if (mysql_num_rows($result) > 0) {
	echo"<select name='v2' style='width:100%' id='v2'>";
	
    while ($rowa = mysql_fetch_assoc($result)) {
        foreach($rowa as $key=>$value){
		if($key=='Field')
		echo "<option>".$value."</option>";
		}
    }
	
	
	echo"</select>";
}
}
?>

<input type='hidden' value='<?php echo $d1?>' name='d1' id='d1'>
<input type='hidden' value='<?php echo $d2?>' name='d2' id='d2'>
<input type='submit' value='Create hybrid' class='btn btn-primary' onclick="ajaxrequest2('<?php echo $home?>/merge/hybrid_process.php')">
</div>
</section>