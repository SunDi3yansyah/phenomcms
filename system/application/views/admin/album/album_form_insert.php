<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/modul/">Modul</a> &gt;  
<a href="{base_url}cpm/album">Album</a> &gt; 
Insert
</div>

<h2>Insert Album</h2>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/album_insert/">
<table class="table-form" style="width:800px">
<tr>
	<th>Judul Album</th>
	<th>:</th>
	<td>
	<input name="album_title" type="text" size="120" value="">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<input name="album_visible" type="radio" value="1" checked> Tampilkan
	<input name="album_visible" type="radio" value="0"> Sembunyikan
	</td>
</tr>
<tr>
	<th width="100px">Deskripsi</th>
	<th>:</th>
	<td>
	<textarea name="album_desc" cols="117" rows="5"></textarea>
	</td>
</tr>

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