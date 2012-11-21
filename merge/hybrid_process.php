<?php require_once('../config.php');?>
<section>
<?php
$d1=$_POST['d1'];
$d2=$_POST['d2'];
$v1=$_POST['v1'];
$v2=$_POST['v2'];
$name=$_POST['name'];
$category=$_POST['category'];
$description=$_POST['description'];
	//create random table name
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	$tbname='';
	for( $i = 0; $i < 20; $i++ ) {
		$tbname .= $chars[ rand( 0, $size - 1 ) ];
	}
	
$table=$tbname;
//

//create dataset
$sql = mysql_query("INSERT INTO datasets(`name`, `table`, `description`, `category`, `isHybrid`)VALUES('$name', '$table', '$description', '$category', '1')");
if(!$sql)
{
echo "Dataset could not be created!";
}
//get columns for new table
//get columns for table of dataset 1
$query3 = "SELECT * FROM datasets WHERE id='$d1'";
$sql = mysql_fetch_array(mysql_query($query3));
$tbname1 = $sql['table'];
$result = mysql_query("SHOW COLUMNS FROM $tbname1");
if (!$result) {
    echo 'Could not run query: 1 ' . $query3;
    exit;
}
if (mysql_num_rows($result) > 0) {
	$fields=array();
	$fields[]="`".$v1."` varchar(15)";
    while ($rowa = mysql_fetch_assoc($result)) {
        foreach($rowa as $key=>$value){
			if($key=='Field'&&$value!=$v1&&$value!='id')
			{
			$fields[]="`".$value."` varchar(15)";
			}
		}
    }
	
	}
	
//get columns for table of dataset 2
$query2="SELECT * FROM datasets WHERE id='$d2'";
$sql = mysql_fetch_array(mysql_query($query2));
$tbname2 = $sql['table'];
$result = mysql_query("SHOW COLUMNS FROM $tbname2");
if (!$result) {
    echo 'Could not run query: 2 '.$query2.mysql_error();
    exit;
}
if (mysql_num_rows($result) > 0) {
	
    while ($rowa = mysql_fetch_assoc($result)) {
        foreach($rowa as $key=>$value){
			if($key=='Field'&&$value!=$v2&&$value!='id')
			{
			$fields[]="`".$value."` varchar(15)";
			}
		}
    }
	
}
$columnames = implode(', ', $fields);
$columnames ="id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),".$columnames;
	
	
	$query = "CREATE TABLE ".$table."($columnames);";
	$create_tables= mysql_query($query);

if(!$create_tables){
echo "error creating table";
}
//table created - now the tough part!!



//insert values into created table
$sql3 = mysql_query("SELECT * FROM $tbname1");
	//find columns of first table
			$result = mysql_query("SHOW COLUMNS FROM $tbname1");
			if (!$result) {
				echo 'Could not run query: 3 ' . mysql_error();
				exit;
			}
			if (mysql_num_rows($result) > 0) {
				$fields=array();
				while ($rowa = mysql_fetch_assoc($result)) {
					foreach($rowa as $key=>$value){
						if($key=='Field'&&$value!='id')
						{
						//now we have a column name
						$fields[]=$value;
						}
					}
				}
				
			}
while($row3=mysql_fetch_array($sql3))
{
//initalize array
$insert=array();
	foreach($fields as $value)
	{
	$input="'".$row3[$value]."'";
	$value="`".$value."`";
	$insert = array($value=>$input)+$insert;
	}

		$query ="INSERT INTO $table (".implode(',',array_keys($insert)).") VALUES (".implode(',',array_values($insert)).")";
		//bingo!!! 
		$do = mysql_query($query);
		if(!$do)
		{
		echo "Problem encountered, Value not inserted!";
		}
	
		
}

//moving on! update table by adding values of second dataset
//query formart should be something like : update $table set column=value where $v2=$v1
//Algorithm
//1. loop through each row of $table using $v1
//2. for each $v2=$v1 update row columns from table2 columns that are not id or $v2
$sql = mysql_query("SELECT * FROM $table");
while($row=mysql_fetch_array($sql))
{
	$tvalue = "'".$row[$v1]."'";
		
	$sql2 = mysql_query("SELECT * FROM $tbname2 WHERE $v2=$tvalue");
	
	//get columns of $tbname2 that are not id or $v2
	$result = mysql_query("SHOW COLUMNS FROM $tbname2");
			if (!$result) {
				echo 'Could not run query: 4' . mysql_error();
				exit;
			}
			if (mysql_num_rows($result) > 0) {
				$fields=array();
				while ($rowa = mysql_fetch_assoc($result)) {
					foreach($rowa as $key=>$value){
						if($key=='Field'&&$value!='id'&&$value!=$v2)
						{
						//now we have a column name
						$fields[]=$value;
						}
					}
				}
				
			}
			
	while($row2=mysql_fetch_array($sql2))
	{
	//update 
	//create key value array 
	$query=array();
	foreach($fields as $fvalue)
	{
	$query[]= "`".$fvalue."`='".$row2[$fvalue]."'";
	}
	
			
	//final action
	
	$query2=implode(', ', $query);
	
	//echo "UPDATE `$table` SET $query2 WHERE $v2=$tvalue";
	$do = mysql_query("UPDATE `$table` SET $query2 WHERE $v2=$tvalue");
		
	}
	
	
}
if(!$do)
		{
		echo "Problem encountered, rows not updated!";
		}
		else
		{
		//now that wasn't so tough was it?
		echo "<b>Datasets merged!</b><br>";
		}
//print details and visualize
?>
<?php
$sql=mysql_query("SELECT * FROM datasets ORDER by id Desc");
$row=mysql_fetch_array($sql);

	echo "<h3>".$row['name']."</h3>";
	$table = $row['table'];
	
	$result = mysql_query("SHOW COLUMNS FROM $table");
if (!$result) {
    echo 'Could not run query: 5' . mysql_error();
    exit;
}
if (mysql_num_rows($result) > 0) {
	echo"<div style='font-size:x-small'>Data Fields: ";
	$fields=array();
    while ($rowa = mysql_fetch_assoc($result)) {
        foreach($rowa as $key=>$value){
		if($key=='Field')
		$fields[]=$value;
		}
    }
	echo implode(', ', $fields);
	//description
	
	echo"</div>";
}
echo $row['description'];
echo "<br><a href='".$home."visualize/index.php?dataset=".$row['id']."'>Create visual</a>";

?>
                    
					
                    </section>
					