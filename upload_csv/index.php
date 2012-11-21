<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HTML5</title>
	<style>
	#filedrag
{
	
	font-weight: bold;
	text-align: center;
	padding: 1em 0;
	margin: 1em 0;
width:100%;
	border: 2px dashed #555;
	border-radius: 7px;
	cursor: default;
}

#filedrag.hover
{

	border-color: #f00;
	border-style: solid;
	box-shadow: inset 0 3px 4px #888;
}
	body {
		font-family: Verdana;
	}
	#box {
		width:100%;
		padding-bottom: 10px;
		float: left;
	}
	#box p {
		font-size: 10px;
		padding: 5px;
		margin: 0px;
	}
	#drop {
		width: 100%;

	}
	#status {
		
		height: 25px;
		font-size: 3em;
		color: #000;
		padding: 5px;
	}
	#list {
		width: 210px;
		font-size: 10px;
		
	}
	.addedIMG {
		width: 50px;
		height: 50px;
	}
	</style>
	<script src="<?php echo $home?>upload_csv/html5uploader.js"></script>
	
	<script type="text/javascript">
	function showUpload(){
	
	}
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
function ajaxrequest(php_file, tagID, stuff, loading) {
  var request =  get_XmlHttp();		// call the function for the XMLHttpRequest instance
  document.getElementById("loading").style.display = 'block';
  document.getElementById("stuff").style.display = 'none';
   document.getElementById("list").style.display='none';
  // create pairs index=value with data that must be sent to server
	var  the_data = 'name='+document.getElementById('name').value+'&description='+document.getElementById('description').value+'&category='+document.getElementById('category').value+'&country='+document.getElementById('country').value+'&csv='+document.getElementById('csv').value;
  //var  the_data = 'bla='+document.getElementById('dtb').value+'&test='+document.getElementById('dta').value;
  request.open("POST", php_file, true);			// set the request

  // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);		// calls the send() method with datas as parameter

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById(tagID).innerHTML = request.responseText;
	  document.getElementById(stuff).style.display='none';
	  document.getElementById(loading).style.display='none';
	 
    }
  }
}
--></script>
</head>

<body onload="new uploader('drop', 'status', '<?php echo $home?>upload_csv/uploader.php', 'list');">
	
	<div id="box">
		
		<div id ='filedrag'>
		
		<div id="drop">Drag the csv file and drop here:
			<br>
			<div id="status"></div>
		</div>
		</div>
		<div align='center'><div id="list"></div></div>
		
		<div id='stuff' style='width:100%;'>

		<div style='float:left;width:30%'>
		<input id='name' type='text' name='name' placeholder='Dataset name' style='width:90%'><br>
		<select id='category' name='category'  style='width:96%'>
		<?php
		$cats = mysql_query("SELECT * FROM categories");
		while($cat = mysql_fetch_array($cats))
		{
			echo '<option value="'.$cat['name'].'">'.$cat['name'].'</option>';
		}
		?>
		</select>
		<select id='country' name='country'  style='width:96%'>
		<?php
		$countries = mysql_query("SELECT * FROM country");
		while($country = mysql_fetch_array($countries))
		{
			if($country['printable_name']=='Kenya')
			{
            echo '<option value="'.$country['printable_name'].'" selected="selected">'.$country['printable_name'].'</option>';
		
			}
			else
			{
			echo '<option value="'.$country['printable_name'].'">'.$country['printable_name'].'</option>';
			}
		}
		?>
		</select>
		</div>
		<div style='float:right;width:70%'>
		<textarea id='description'  name='description' placeholder='Description'  style='width:98%;' rows='5'></textarea>
		</div>
		<input type='submit' name='submit' value='add dataset' class='btn btn-primary' onclick="ajaxrequest('addcsv.php', 'context', 'stuff', 'loading')">
		
		</div>
		<script type="text/javascript">document.getElementById("stuff").style.display = 'none';</script>
		
		
	</div>
	<div id="loading" align='center'>
<img src='upload_csv/loader.gif'>
</div>
<script type="text/javascript">document.getElementById("loading").style.display = 'none';</script>
		<div id="context"></div>
	
</body>
</html>