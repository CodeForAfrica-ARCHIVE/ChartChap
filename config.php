<?php
$home = 'http://localhost/chartchap2/';

$databasehost = "localhost";
$databasename = "importcsv";
$databaseusername ="root";
$databasepassword = "";
$fieldseparator = ",";
$lineseparator = "\n";

$con = mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
mysql_select_db($databasename) or die(mysql_error());

?>