<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/modul/">Module</a> &gt;  
<a href="{base_url}cpm/album">Album</a> &gt; 
Edit
</div>

<h2>Edit Album</h2>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/album_edit/">
<table class="table-form" style="width:800px">
<tr>
	<th>Album Title</th>
	<th>:</th>
	<td>
	<input name="album_id" type="hidden" value="{album_id}">
	<input name="album_title" type="text" size="120" value="{album_title}">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<?php
	if ($album_visible=='1') $checked1 = 'checked';
	else $checked1 = '';
	if ($album_visible=='0') $checked0 = 'checked';
	else $checked0 = '';
	?>
	<input name="album_visible" type="radio" value="1" <?php echo $checked1?>> Show
	<input name="album_visible" type="radio" value="0" <?php echo $checked0?>> Hide
	</td>
</tr>
<tr>
	<th width="100px">Description</th>
	<th>:</th>
	<td>
	<textarea name="album_desc" cols="117" rows="5">{album_desc}</textarea>
	</td>
</tr>
<tr>
	<th>Thumbnail</th>
	<th>:</th>
	<td><img src="{album_thumbnail}"></td>
</tr>

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


<h3>Upload photo:</h3>
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/photo_insert/{album_id}">
<table class="table-form">
<tr>
	<th>Foto</th>
	<th>:</th>
	<td>
	<input name="photo_album_id" type="hidden" value="{album_id}">
	<script language="javascript">
	function Checkfiles()
	{
	var fup = document.getElementById('filename');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "png" || ext == "PNG" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
	{
	return true;
	} 
	else
	{
	fup.value="";
	alert("Only JPG or PNG files allowed!");
	return false;
	}
	}
	</script>
	<input name="photo_image" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)
	<br />
	Make sure GD Library (php_gd2) already installed on your server.
	</td>
</tr>
<tr>
	<th width="100px">Description</th>
	<th>:</th>
	<td>
	<input name="photo_desc" type="text" size="80" >
	</td>
</tr>

	</td>
</tr>

<tr>
	<td colspan="3">
	<input type="submit" value="Upload">
	<input type="reset" value="Reset">
	</td>
</tr>
</table>
</form>


<?php if (!empty($photo)) { ?>
<h3>Photo List:</h3>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/photo_process/{album_id}">
<table class="table-form" style="margin-bottom:10px;width:650px">
<tr>
<td>
With selected: <input name="process_update" type="submit" value="Update"> <input name="process_delete" type="submit" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus semua foto yang dipilih?')"><br />
</td>
</tr>
</table>
<table class="table-common" width="650px">
<tr>
	<th>Check</th>
	<th>Photo</th>
	<th>Description</th>
	<th width="250px">Action</th>
</tr>
{photo}
<tr class="{alert}">
	<td align="center">
	<a id="{photo_id}"></a>
	<input name="photo_id[]" type="hidden"  value="{photo_id}">
	<input name="check_id[]" type="checkbox"  value="{photo_id}">
	</td>
	<td><img src="{photo_image}"></td>
	<td>
	<textarea name="photo_desc[]" cols="40" rows="3">{photo_desc}</textarea>
	</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/photo}
</table>
<br />
<table class="table-form" style="margin-bottom:5px;width:650px">
<tr>
<td>
With selected: <input name="process_update" type="submit" value="Update"> <input name="process_delete" type="submit" value="Delete" onClick="return confirm('Are you sure you want to delete all selected photos?')"><br />
</td>
</tr>
</table>
</form>
<?php } ?>
<a id="new"></a>

</div>
</div>
</div>
</body>
</html>