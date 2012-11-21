<?php
require_once('functions.php');
require_once('../config.php');
$id=$_POST['dataset'];
$type=$_POST['type'];
?>
<section>
		
<form action='<?php echo $home?>visualize/finish.php' method='POST'>
<input type='hidden' value='<?php echo $type?>' name='type'>
<input type='hidden' value='<?php echo $id?>' name='dataset'>
<table width='100%'>
<tr>
<td>Title</td><td><input type='text' name='title'></td>
</tr>
<?php
if($type=='PieChart')
{
PieChart($id);
}
else
{
LineChart($id);
}
?>
<tr>
<td></td><td><input type='submit' value='Next' class='btn btn-primary'></td>
</form>
</table>
</section>
					