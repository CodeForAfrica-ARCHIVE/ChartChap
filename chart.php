<?php require_once('header.php');
require_once('config.php');?>
                        
<?php
$id = $_GET['id'];

$sql = mysql_query("SELECT * FROM charts WHERE id='$id'");
$row =mysql_fetch_array($sql);

$type=$row['type'];
$title=$row['title'];
$label1=$row['label1'];
$label2=$row['label2'];

$dataset=$row['dataset'];

$sql3 = mysql_query("SELECT * FROM datasets WHERE id='$dataset'");
$row3 =mysql_fetch_array($sql3);


$table=$row3['table'];


require_once('data.php');
?>
 <div class="well">
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="#"><?php echo $title?></a>
			</div>
		</div>
		
		<div class="info-widget">
			<div class="row-fluid">
			
                    <section>
      <script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/rgbcolor.js"></script> 
    <script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/canvg.js"></script>
    <script>
      function getImgData(chartContainer) {
        var chartArea = chartContainer.getElementsByTagName('iframe')[0].
          contentDocument.getElementById('chartArea');
        var svg = chartArea.innerHTML;
        var doc = chartContainer.ownerDocument;
        var canvas = doc.createElement('canvas');
        canvas.setAttribute('width', chartArea.offsetWidth);
        canvas.setAttribute('height', chartArea.offsetHeight);
        
        
        canvas.setAttribute(
            'style',
            'position: absolute; ' +
            'top: ' + (-chartArea.offsetHeight * 2) + 'px;' +
            'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
        doc.body.appendChild(canvas);
        canvg(canvas, svg);
        var imgData = canvas.toDataURL("image/png");
        canvas.parentNode.removeChild(canvas);
        return imgData;
      }
      
      function saveAsImg(chartContainer) {
        var imgData = getImgData(chartContainer);
        
        // Replacing the mime-type will force the browser to trigger a download
        // rather than displaying the image in the browser window.
        window.location = imgData.replace("image/png", "image/octet-stream");
      }
      
      function toImg(chartContainer, imgContainer) { 
        var doc = chartContainer.ownerDocument;
        var img = doc.createElement('img');
        img.src = getImgData(chartContainer);
        
        while (imgContainer.firstChild) {
          imgContainer.removeChild(imgContainer.firstChild);
        }
        imgContainer.appendChild(img);
      }
    </script>
	
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php echo $data;?>
        ]);

        var options = {
          
		  <?php
if(isset($_POST['generate']))
{
$title=$_POST['title'];
$height=$_POST['height'];
$width=$_POST['width'];
$backgroundColor=$_POST['backgroundColor'];
$backgroundColorstroke=$_POST['backgroundColorstroke'];
$backgroundColorstrokeWidth=$_POST['backgroundColorstrokeWidth'];
$fill=$_POST['fill'];
$fontSize=$_POST['fontSize'];
$fontName=$_POST['fontName'];
$is3D=$_POST['is3D'];
echo "title:'".$title."',\nheight:'".$height."',\nwidth:'".$width."',\nbackgroundColor:'".$backgroundColor."',\nbackgroundColor:{stroke: '".$backgroundColorstroke."', strokeWidth: ".$backgroundColorstrokeWidth.", fill: '".$fill."'},\nfontName:'".$fontName."',\nfontSize:'".$fontSize."',\nis3D:".$is3D;
}
else
{
echo "title: '".$title."'";
}
?>
        };

        var chart = new google.visualization.<?php echo $type;?>(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

  <?php
if(isset($_POST['generate']))
{
echo "<h3>Copy paste the code below</h3>";
$title=$_POST['title'];
$height=$_POST['height'];
$width=$_POST['width'];
$backgroundColor=$_POST['backgroundColor'];
$backgroundColorstroke=str_replace('#', '', $_POST['backgroundColorstroke']);
$backgroundColorstrokeWidth=$_POST['backgroundColorstrokeWidth'];
$fill=str_replace('#', '', $_POST['fill']);
$fontSize=$_POST['fontSize'];
$fontName=$_POST['fontName'];
$is3D=$_POST['is3D'];
?>
<textarea rows='4' style='width:100%'>
	<iframe src='<?php echo $home?>embedd.php?id=<?php echo $id."&backgroundColor=".$backgroundColor."&title=".$title."&width=".$width."&height=".$height."&fill=".$fill."&backgroundColorstroke=".$backgroundColorstroke."&backgroundColorstrokeWidth=".$backgroundColorstrokeWidth."&fontSize=".$fontSize."&fontName=".$fontName."&is3D=".$is3D?>' width='<?php echo $width;?>' scrolling='no' border='0' height='<?php echo $height;?>'></iframe>
	</textarea>
	<h3>Preview</h3>
<?php
}
?>
   <div id="chart_div" style="width: 100%;height:500px;"></div>
   <br>
   <style type='text/css'>
   .button-link {
  font-size:0.8em;
    padding: 5px 10px;
    background: #4479BA;
    color: #FFF;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -webkit-transition-duration: 0.2s;
    -moz-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;
}
.button-link:hover {
    background: #356094;
    border: solid 1px #2A4E77;
    text-decoration: none;
}
.button-link:active {
    -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
    box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
    background: #2E5481;
    border: solid 1px #203E5F;
}
   </style><div align='center'>
   <button onclick="saveAsImg(document.getElementById('chart_div'));" class='button-link'>Download Chart as Image</button></div>
<h3>Generate Embedd Code</h3>
<form action='' method='POST'>
<table width='100%'>
<tr>
<td>Title</td><td><input type="text" name='title' value='<?php echo $title;?>'></td>
</tr>
<tr>
<td>Height</td><td><input type="text" name='height' value='300'></td>
</tr>
<tr>
<td>Width</td><td><input type="text" name='width' value='600'></td>
</tr>
<tr>
<td>Background color</td><td><input type="text" name='backgroundColor' value='white'></td>
</tr>
<tr>
<td>Chart border color</td><td><input type="text" name='backgroundColorstroke' value='#666'></td>
</tr>
<tr>
<td>Border width</td><td><input type="text" name='backgroundColorstrokeWidth' value='5'></td>
</tr>
<tr>
<td>Fill color</td><td><input type="text" name='fill' value='#5A5A5A'></td>
</tr>
<tr>
<td>Font size</td><td><input type="text" name='fontSize' value='12'></td>
</tr>
<tr>
<td>Font name</td><td><input type="text" name='fontName' value='Arial'></td>
</tr>
<tr>
<td>3D chart</td><td><select name='is3D'>
<option value='false'>False</option>
<option value='true'>True</option>
</select>
</td>
</tr>
<tr><td></td>
<td><input type='submit' value='Generate' name='generate' class='btn btn-primary'></td>
</tr>
</table>
</form>


</section>
</div>
			<div class="line-divider"></div>
			
		</div>
 </div>        
                  <?php require_once('footer.php');?>
                   