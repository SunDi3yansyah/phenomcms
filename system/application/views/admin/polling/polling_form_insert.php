<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/modul/">Modul</a> &gt;  
<a href="{base_url}cpm/polling">Polling</a> &gt; 
Insert
</div>

<h2>Insert Polling</h2>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/polling_insert/">
<table class="table-form" style="width:800px">
<tr>
	<th>Topik Polling</th>
	<th>:</th>
	<td>
	<input name="polling_topic" type="text" size="120" value="">
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

</div>
</div>
</div>
</body>
</html>