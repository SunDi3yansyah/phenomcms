<script type="text/javascript">
  var http = false;

  if(navigator.appName == "Microsoft Internet Explorer") {
    http = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
     http = new XMLHttpRequest();
  }

  function menu(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_input/"+id, true);
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
Insert
</div>

<h2>Insert Item Menu</h2>
<br />

<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/menu_insert/">
<table class="table-form" style="width:1000px">
<tr>
	<th>Group Menu</th>
	<th>:</th>
	<td>
		<select name="mrc_mr_id">
			{multiple record category}
			<option value="{mr_id}">{mr_name}</option>
			{/multiple record category}
		</select>
	</td>
</tr>
<tr>
	<th>Nama Menu</th>
	<th>:</th>
	<td>
	<input name="mrc_title" type="text" size="120">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<input name="mrc_visibile" type="radio" value="1" checked> Tampilkan
	<input name="mrc_visibile" type="radio" value="0"> Sembunyikan
	<input name="mrc_comment_status" type="hidden" value="0">
	</td>
</tr>
<tr>
	<th width="100px">Link Type</th>
	<th>:</th>
	<td>
	<input name="mrc_type" type="radio" value="menu" onChange="javascript:menu(0)" checked> Menu
	<input name="mrc_type" type="radio" value="module" onChange="javascript:module(0)"> Module
	<input name="mrc_type" type="radio" value="uri" onChange="javascript:uri(0)"> URI
	<input name="mrc_type" type="radio" value="url" onChange="javascript:url(0)"> URL
	</td>
</tr>
<tr>
	<th colspan="2"></th>
	<td>
	<div id="type">
	<?php 
		include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
		$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
		$oFCKeditor = new FCKeditor('FCKeditor1') ;
		$oFCKeditor->BasePath	= $sBasePath ;
		$oFCKeditor->Create() ;
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
	Insert Image:
	<input name="mrc_thumbnail" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)
	<input type="hidden" name="mrc_current_thumbnail" value="{multiple_record_mrc_thumbnail}">
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