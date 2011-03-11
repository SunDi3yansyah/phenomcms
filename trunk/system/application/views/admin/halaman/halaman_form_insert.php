<script type="text/javascript">
  var http = false;

  if(navigator.appName == "Microsoft Internet Explorer") {
    http = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
     http = new XMLHttpRequest();
  }

  function page(id) {
    http.open("GET", "<?php echo config_item('base_url').config_item('index_page') ?>/cpm/page_input/"+id, true);
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
<a href="{base_url}cpm/halaman">Page Title</a> &gt; 
Insert
</div>

<h2>Add New Page</h2>
<br />

<form enctype="multipart/form-data" method="post" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/halaman_insert">
<table class="table-form" style="width:1000px">
<tr>
	<th>Page Title</th>
	<th>:</th>
	<td>
	<input name="sr_name" type="text" size="60">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<input name="sr_visible" type="radio" value="1" checked> Tampilkan
	<input name="sr_visible" type="radio" value="0"> Hide
	</td>
</tr>
<tr>
	<th width="100px">Link Type</th>
	<th>:</th>
	<td>
	<input name="sr_type" type="radio" value="page" onChange="javascript:page(0)" checked> Page
	<input name="sr_type" type="radio" value="module" onChange="javascript:module(0)"> Module
	<input name="sr_type" type="radio" value="uri" onChange="javascript:uri(0)"> URI
	<input name="sr_type" type="radio" value="url" onChange="javascript:url(0)"> URL
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
	alert("Only JPG or PNG files allowed!");
	return false;
	}
	}
	</script>
	Insert Image:
	<input name="src_thumbnail" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)
	</div>
	</td>
</tr>

<tr>
	<td colspan="3">
	<input type="submit" value="Tambahkan">
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