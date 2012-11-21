<?php 
require_once('../config.php');
require_once('../header.php');
?>
<script type="text/javascript">
<!--
// create the XMLHttpRequest object, according browser
function get_XmlHttp() {
  // create the variable that will contain the instance of the XMLHttpRequest object (initially with null value)
  var xmlHttp = null;

  if(window.XMLHttpRequest) {		// for Forefox, IE7+, Opera, Safari, ...
    xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {	// for Internet Explorer 5 or 6
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  return xmlHttp;
}

// sends data to a php file, via POST, and displays the received answer
function ajaxrequest(php_file) {
  var request =  get_XmlHttp();		// call the function for the XMLHttpRequest instance
  document.getElementById("loading").style.display = 'block';
  document.getElementById("formstuff").style.display = 'none';
  // create pairs index=value with data that must be sent to server
  var  the_data = 'd1='+document.getElementById('d1').value+'&d2='+document.getElementById('d2').value;

  request.open("POST", php_file, true);			// set the request

  // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);		// calls the send() method with datas as parameter

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById("context").innerHTML = request.responseText;
	  document.getElementById("formstuff").style.display='none';
	  document.getElementById("loading").style.display='none';
    }
  }
}
// sends data to a php file, via POST, and displays the received answer
function ajaxrequest2(php_file) {
  var request =  get_XmlHttp();		// call the function for the XMLHttpRequest instance
  document.getElementById("loading").style.display = 'block';
  document.getElementById("formstuff2").style.display = 'none';
  // create pairs index=value with data that must be sent to server
  var  the_data = 'd1='+document.getElementById('d1').value+'&d2='+document.getElementById('d2').value+'&name='+document.getElementById('name').value+'&description='+document.getElementById('description').value+'&category='+document.getElementById('category').value+'&v1='+document.getElementById('v1').value+'&v2='+document.getElementById('v2').value;

  request.open("POST", php_file, true);			// set the request

  // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);		// calls the send() method with datas as parameter

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById("context2").innerHTML = request.responseText;
	  document.getElementById("formstuff2").style.display='none';
	  document.getElementById("loading").style.display='none';
    }
  }
}
document.getElementById("loading2").style.display = 'none';
--></script>
 <div class="well">
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="#">Merge Datasets</a>
			</div>
		</div>
		
		<div class="info-widget">
			<div class="row-fluid">
			<div id="loading" align='center'>
<img src='<?php echo $home?>images/loader.gif'>
</div>
<script type="text/javascript">document.getElementById("loading").style.display = 'none';</script>
<div id="context"></div>
<div id='formstuff' >

	<?php

//first dataset
$sql=mysql_query("SELECT * FROM datasets");
echo "Dataset 1: <select style='width:100%' name='d1' id='d1'>";
while($row=mysql_fetch_array($sql))
{
	echo "<option value='".$row['id']."'>".$row['name']."</option>";

}
echo "</select>";

//second dataset
$sql=mysql_query("SELECT * FROM datasets ORDER BY id Desc");
echo "Dataset 2: <select style='width:100%' name='d2' id='d2'>";
while($row=mysql_fetch_array($sql))
{
	echo "<option value='".$row['id']."'>".$row['name']."</option>";

}
?>
</select><input type='submit' value='proceed' class='btn btn-primary' onclick="ajaxrequest('<?php echo $home?>/merge/hybrid.php')">

</div></div>
			<div class="line-divider"></div>
			
		</div>
 </div> 
 
<?php
require_once('../footer.php');
?>