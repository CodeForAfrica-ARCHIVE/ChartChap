<?php
for ($i=1; $i<=5000000; $i++)
{
}
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];
$country = $_POST['country'];
$csvfile = 'upload_csv/data/'.$_POST['csv'];
?>
<?php require_once('config.php');?>
<?php
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
  		$extension = getExtension($csvfile);
 		$extension = strtolower($extension);
		

 if ($extension != "csv")
 		{
			//print error message
				echo '<div align="center">Only .csv files allowed!</div>';
				$errors=1;
 		}
		else
		{
		$errors=0;
		}
	

if($errors==0)
{

/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 1;
/********************************/
/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 1;
$outputfile = "output.sql";
/********************************/


if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
}

$file = fopen($csvfile,"r");

if(!$file) {
	echo "Error opening data file.\n";
	exit;
}

$size = filesize($csvfile);

if(!$size) {
	echo "File is empty.\n";
	exit;
}



$csvcontent = fread($file,$size);

fclose($file);





$lines = 0;
$queries = "";
$linearray = array();

//create table, columns
$columnnames = array();
$row = 1;
if (($handle = fopen($csvfile, "r")) !== FALSE) {
  $data = fgetcsv($handle, 1000, ","); 
        $num = count($data);
        
        for ($c=0; $c < $num; $c++) {
            $columnnames[]= "`".trim($data[$c])."` varchar(15)";
        }
    
    fclose($handle);
}
	$columnames = implode(", ", $columnnames);
	$columnames ="id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),".$columnames;
	
	//create random table name
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	$tbname='';
	for( $i = 0; $i < 20; $i++ ) {
		$tbname .= $chars[ rand( 0, $size - 1 ) ];
	}
	
	$query = "CREATE TABLE `".$tbname."`($columnames);";
	$create_tables= mysql_query($query) or die(mysql_error());

if(!$create_tables){
echo "error creating table";
}
else
{
// end creating table

foreach(explode($lineseparator,$csvcontent) as $line) {

	$lines++;
    $skipped=0;
	if($lines>1){
	$line = trim($line," \t");
	
	$line = str_replace("\r","",$line);
	
	/************************************
	This line escapes the special character. remove it if entries are already escaped in the csv file
	************************************/
	$line = str_replace("'","\'",$line);
	/*************************************/
	
	$linearray = explode($fieldseparator,$line);
	
	$linearray = preg_replace( "#[^a-zA-Z0-9,.]#", "", $linearray);
	$linemysql = implode("','",$linearray);
	
	
	if($addauto){
		$query = "insert into $tbname values('','$linemysql');";
		}
	else
	{
		$query = "insert into $tbname values('$linemysql');";}
	
	$queries .= $query . "\n";

	$insert = mysql_query($query);
	
	if(!$insert){ $skipped++;}
	
}
}

echo '<h3>Success!</h3>';
//echo $skipped." rows skipped.<br>";
$name=$_POST['name'];
$table=$tbname;
$description=$_POST['description'];
$category=$_POST['category'];

mysql_query("INSERT INTO datasets(`name`, `table`, `description`, `category`, `country`)VALUES('$name', '$table', '$description', '$category', '$country')");




echo "Found a total of $lines records in this csv file.\n";


$sql=mysql_query("SELECT * FROM datasets ORDER BY id Desc");
$row=mysql_fetch_array($sql);

	echo "<br><b>".$row['name']."</b><br>";
	$table = $row['table'];
	
	$result = mysql_query("SHOW COLUMNS FROM $table");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
if (mysql_num_rows($result) > 0) {
	echo"<div style='font-size:x-small'>Columns: ";
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
echo "<br><a href='visualize/index.php?dataset=".$row['id']."'>Create visual</a>";


echo mysql_error($con);
mysql_close($con);
}
}
?>
</section>
