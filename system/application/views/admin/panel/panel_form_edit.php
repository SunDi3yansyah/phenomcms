<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
<a href="{base_url}cpm/panel">Widget</a> &gt; 
Edit
</div>

<h2>Edit Widget</h2>
<br />

<form method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/panel_edit/">
<table class="table-form" style="width:800px">
<tr>
	<th>Name Widget</th>
	<th>:</th>
	<td>
	<input name="panel_id" type="hidden" value="{panel_id}">
	<input name="panel_name" type="text" size="125" value="{panel_name}">
	</td>
</tr>
<tr>
	<th>Label Widget</th>
	<th>:</th>
	<td>
	<input name="panel_label" type="text" size="125" value="{panel_label}">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<?php
	if ($panel_visible=='1') $checked1 = 'checked';
	else $checked1 = '';
	if ($panel_visible=='0') $checked0 = 'checked';
	else $checked0 = '';
	?>
	<input name="panel_visible" type="radio" value="1" <?php echo $checked1?>> Show
	<input name="panel_visible" type="radio" value="0" <?php echo $checked0?>> Hide
	</td>
</tr>
<tr>
	<td colspan="3">
<?php 
$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $panel_content ;
$oFCKeditor->Create() ;
?>
	</td>
</tr>
<tr>
	<td colspan="3">
	<input type="submit" value="Save">
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