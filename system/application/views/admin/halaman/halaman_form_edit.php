<script type="text/javascript">
  var http = false;

  if(navigator.appName == "Microsoft Internet Explorer") {
    http = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
     http = new XMLHttpRequest();
  }

  function page(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/page_edit/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }

  function url(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/page_url_input/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }

  function uri(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/page_uri_input/"+id, true);
    http.onreadystatechange=function() {
      if(http.readyState == 4) {
        document.getElementById('type').innerHTML = http.responseText;
      }
    }
    http.send(null);
  }

  function module(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/page_module_input/"+id, true);
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
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
<a href="{base_url}cpm/halaman">Pages</a> &gt; 
Edit
</div>

<h2>Edit Pages</h2>
<br />

<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/halaman_edit/">
<table class="table-form" style="width:1000px">
<tr>
	<th>Page Title</th>
	<th>:</th>
	<td>
	<input name="sr_id" type="hidden" value="{single record id}">
	<input name="sr_name" type="text" size="60" value="{single record title}">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<?php
	if ($single_record_visible=='1') $checked1 = 'checked';
	else $checked1 = '';
	if ($single_record_visible=='0') $checked0 = 'checked';
	else $checked0 = '';
	?>
	<input name="sr_visible" type="radio" value="1" <?php echo $checked1?>> Show
	<input name="sr_visible" type="radio" value="0" <?php echo $checked0?>> Hide
	</td>
</tr>

<tr>
	<th width="100px">Link Type</th>
	<th>:</th>
	<td>
	<input name="sr_type" type="radio" value="page" onChange="javascript:page({single record id})" <?php if ($single_record_type == 'page') echo 'checked'; else echo '' ?>> Page
	<input name="sr_type" type="radio" value="module" onChange="javascript:module({single record id})" <?php if ($single_record_type == 'module') echo 'checked'; else echo '' ?>> Module
	<input name="sr_type" type="radio" value="uri" onChange="javascript:uri({single record id})" <?php if ($single_record_type == 'uri') echo 'checked'; else echo '' ?>> URI
	<input name="sr_type" type="radio" value="url" onChange="javascript:url({single record id})" <?php if ($single_record_type == 'url') echo 'checked'; else echo '' ?>> URL
	</td>
</tr>

<tr>
	<th colspan="2"></th>
	<td>
	<div id="type">
	<?php 
	if ($single_record_type == 'page') 
	{
		include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
		$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
		$oFCKeditor = new FCKeditor('FCKeditor1') ;
		$oFCKeditor->BasePath	= $sBasePath ;
		$oFCKeditor->Value		= $single_record_content ;
		$oFCKeditor->Create() ;
	}
	if ($single_record_type == 'url') 
	{
	?>
		<input name="page_url" type="text" size="40" value="<?php echo $single_record_url ?>">
		Target: 
		<select name="page_target">
		<option value="_self" <?php if ($single_record_target == '_self') echo 'selected'; else echo '' ?>>Current Window</option>
		<option value="_blank" <?php if ($single_record_target == '_blank') echo 'selected'; else echo '' ?>>New Window</option>
		</select>	
	<?php
	}

	if ($single_record_type == 'uri') 
	{
	?>
		<input name="page_uri" type="text" size="40" value="<?php echo $single_record_uri ?>">
	<?php
	}

	if ($single_record_type == 'module') 
	{
	?>
		<select name="page_module">
		<option value="services" <?php if ($single_record_module == 'services') echo 'selected'; else echo '' ?>>Services</option>	
		<option value="gallery" <?php if ($single_record_module == 'gallery') echo 'selected'; else echo '' ?>>Gallery</option>
		<option value="guestbook" <?php if ($single_record_module == 'guestbook') echo 'selected'; else echo '' ?>>Guest Book</option>
		<option value="polling" <?php if ($single_record_module == 'polling') echo 'selected'; else echo '' ?>>Polls</option>
		</select>
	<?php
	}
	?>

	<?php 
	if ($single_record_type == 'page') 
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
	<a id="image"></a>
	<?php if (trim($src_image)!='') { ?>
	<img src="{src_thumbnail}"> <br />
	<a href="<?php echo config_item('base_url') ?>/cpm/halaman_delete_image/{single record id}" onClick="return confirm('Are you sure you want to delete this image?')">
	Delete Image
	</a>
	<br />
	<br />
	<?php } ?>
	Update Image:
	<input name="src_thumbnail" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)
	<input type="hidden" name="src_current_thumbnail" value="{single_record_mrc_thumbnail}">
	<?php 
	}
	?>
	</div>

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