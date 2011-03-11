<script type="text/javascript">
  var http = false;

  if(navigator.appName == "Microsoft Internet Explorer") {
    http = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
     http = new XMLHttpRequest();
  }

  function menu(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_link_edit/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }

  function url(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_url_input/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }

  function uri(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_uri_input/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }

  function module(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_module_input/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }
</script>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/menu/">Menu</a> &gt;  
<a href="{base_url}cpm/menu">Item</a> &gt; 
Edit
</div>

<h2>Edit Item Menu</h2>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_edit/">
<table class="table-form" style="width:1000px">
<tr>
	<th width="100px">Group Menu</th>
	<th>:</th>
	<td>
		<select name="mrc_mr_id">
			{multiple record category}
			<option value="{mr_id}" {selected}>{mr_name}</option>
			{/multiple record category}
		</select>
	</td>
</tr>
<tr>
	<th>Nama Menu</th>
	<th>:</th>
	<td>
	<input name="mrc_id" type="hidden" value="{multiple record mrc_id}">
	<input name="mrc_title" type="text" size="120" value="{multiple record mrc_title}">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<?php
	if ($multiple_record_mrc_visible=='1') $checked1 = 'checked';
	else $checked1 = '';
	if ($multiple_record_mrc_visible=='0') $checked0 = 'checked';
	else $checked0 = '';
	?>
	<input name="mrc_visibile" type="radio" value="1" <?php echo $checked1?>> Tampilkan
	<input name="mrc_visibile" type="radio" value="0" <?php echo $checked0?>> Sembunyikan
	<input name="mrc_comment_status" type="hidden" value="0">
	</td>
</tr>
<tr>
	<th width="100px">Link Type</th>
	<th>:</th>
	<td>
	<input name="mrc_type" type="radio" value="menu" onChange="javascript:menu({multiple record mrc_id})" <?php if ($multiple_record_type == 'menu') echo 'checked'; else echo '' ?>> Menu
	<input name="mrc_type" type="radio" value="module" onChange="javascript:module({multiple record mrc_id})" <?php if ($multiple_record_type == 'module') echo 'checked'; else echo '' ?>> Module
	<input name="mrc_type" type="radio" value="uri" onChange="javascript:uri({multiple record mrc_id})" <?php if ($multiple_record_type == 'uri') echo 'checked'; else echo '' ?>> URI
	<input name="mrc_type" type="radio" value="url" onChange="javascript:url({multiple record mrc_id})" <?php if ($multiple_record_type == 'url') echo 'checked'; else echo '' ?>> URL
	</td>
</tr>
<tr>
	<th colspan="2"></th>
	<td>
	<div id="type">
	<?php 
	if ($multiple_record_type == 'menu') 
	{
		include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
		$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
		$oFCKeditor = new FCKeditor('FCKeditor1') ;
		$oFCKeditor->BasePath	= $sBasePath ;
		$oFCKeditor->Value		= $multiple_record_content ;
		$oFCKeditor->Create() ;
	}
	if ($multiple_record_type == 'url') 
	{
	?>
		<input name="posting_url" type="text" size="40" value="<?php echo $multiple_record_url ?>">
		Target: 
		<select name="posting_target">
		<option value="_self" <?php if ($multiple_record_target == '_self') echo 'selected'; else echo '' ?>>Current Window</option>
		<option value="_blank" <?php if ($multiple_record_target == '_blank') echo 'selected'; else echo '' ?>>New Window</option>
		</select>	
	<?php
	}

	if ($multiple_record_type == 'uri') 
	{
	?>
		<input name="posting_uri" type="text" size="40" value="<?php echo $multiple_record_uri ?>">
	<?php
	}

	if ($multiple_record_type == 'module') 
	{
	?>
		<select name="posting_module">
		<option value="gallery" <?php if ($multiple_record_module == 'gallery') echo 'selected'; else echo '' ?>>Gallery</option>
		<option value="guestbook" <?php if ($multiple_record_module == 'guestbook') echo 'selected'; else echo '' ?>>Guest Book</option>
		<option value="polling" <?php if ($multiple_record_module == 'polling') echo 'selected'; else echo '' ?>>Polling</option>
		</select>
	<?php
	}
	?>


	<?php 
	if ($multiple_record_type == 'menu') 
	{
	?>
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
	alert("Hanya file JPG atau PNG yang diperbolehkan!");
	return false;
	}
	}
	</script>
	<br />
	<br />
	<a id="image"></a>
	<?php if (trim($mrc_image)!='') { ?>
	<img src="{mrc_thumbnail}"> <br />
	<a href="<?php echo config_item('base_url') ?>/cpm/menu_delete_image/{multiple record mrc_id}" onClick="return confirm('Apakah Anda yakin akan menghapus image ini?')">
	Hapus Image
	</a>
	<br />
	<br />
	<?php } ?>
	Update Image:
	<input name="mrc_thumbnail" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)
	<input type="hidden" name="mrc_current_thumbnail" value="{multiple_record_mrc_thumbnail}">
	<?php } ?>

	</div>
	</td>
</tr>
<tr>
	<td colspan="3">
	<input type="submit" value="Simpan">
	<input type="reset" value="Reset">
	</td>
</tr>
</table>
</form>

<!--
<script type="text/javascript">
function insert_smiley(smiley)
{
	document.phenomcms.src_content.value += " " + smiley;
}
</script>

{smiley_table}
-->


</div>
</div>
</div>
</body>
</html>