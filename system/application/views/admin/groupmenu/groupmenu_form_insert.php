<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/menu/">Menu</a> &gt;  
<a href="{base_url}cpm/groupmenu">Group Menu</a> &gt; 
Insert
</div>

    <h2>Tambah Group Menu</h2>
<br />

<form method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/groupmenu_insert/">
<table class="table-form">
<tr>
	<th>Nama Group Menu</th>
	<th>:</th>
	<td>
	<input name="mr_name" type="text" size="60">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<input name="mr_visibile" type="radio" value="1" checked> Tampilkan
	<input name="mr_visibile" type="radio" value="0"> Sembunyikan
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