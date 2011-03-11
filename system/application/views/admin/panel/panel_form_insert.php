<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
<a href="{base_url}cpm/panel">Widget</a> &gt; 
</div>

<h2>Add a New Widget</h2>
<br />

<form method="post" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/panel_insert">
<table class="table-form" style="width:800px">
<tr>
	<th>Name Widget</th>
	<th>:</th>
	<td>
	<input name="panel_name" type="text" size="125">
	</td>
</tr>
<tr>
	<th>Label Widget</th>
	<th>:</th>
	<td>
	<input name="panel_label" type="text" size="125">
	</td>
</tr>
<tr>
	<td colspan="3">
<?php 
$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Create() ;
?>
	</td>
</tr>
<tr>
	<td colspan="3">
	<input type="submit" value="Add">
	<input type="reset" value="Reset">
	</td>
</tr>
</table>
</form>

</div>
</div>
</div>
</body>
</html>