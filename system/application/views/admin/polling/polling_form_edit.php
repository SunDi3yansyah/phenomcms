<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/modul/">Modul</a> &gt;  
<a href="{base_url}cpm/polling">Polling</a> &gt; 
Edit
</div>

<h2>Edit Polling</h2>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/polling_edit/">
<table class="table-form" style="width:800px">
<tr>
	<th>Topik Polling</th>
	<th>:</th>
	<td>
	<input name="polling_id" type="hidden" value="{polling_id}">
	<input name="polling_topic" type="text" size="120" value="{polling_topic}">
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


<h3>Tambah Pilihan:</h3>
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/polling_pil_insert/{polling_id}">
<table class="table-form">
<tr>
	<th width="100px">Pilihan</th>
	<th>:</th>
	<td>
	<input name="polling_pil_polling_id" type="hidden" value="{polling_id}">
	<input name="polling_pil_name" type="text" size="80" >
	</td>
</tr>
<tr>
	<th width="100px">Hits</th>
	<th>:</th>
	<td>
	<input name="polling_pil_hits" type="text" size="2" value="0">
	</td>
</tr>

	</td>
</tr>

<tr>
	<td colspan="3">
	<input type="submit" value="Insert">
	<input type="reset" value="Reset">
	</td>
</tr>
</table>
</form>


<?php if (!empty($pil)) { ?>
<h3>Daftar Pilihan:</h3>
<br />
<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/polling_pil_process/{polling_id}">
<table class="table-form" style="margin-bottom:10px;width:650px">
<tr>
<td>
With selected: <input name="process_update" type="submit" value="Update"> <input name="process_delete" type="submit" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus semua foto yang dipilih?')"><br />
</td>
</tr>
</table>
<table class="table-common" width="650px">
<tr>
	<th>Check</th>
	<th>Pilihan</th>
	<th>Hits</th>
	<th width="100px">Aksi</th>
</tr>
{pil}
<tr class="{alert}">
	<td align="center">
	<a id="{polling_pil_id}"></a>
	<input name="polling_pil_id[]" type="hidden"  value="{polling_pil_id}">
	<input name="check_id[]" type="checkbox"  value="{polling_pil_id}">
	</td>
	<td>{polling_pil_name}</td>
	<td>
	<input name="polling_pil_hits[]" type="text" size="4" value="{polling_pil_hits}">
	</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/pil}
</table>
<br />
<table class="table-form" style="margin-bottom:5px;width:650px">
<tr>
<td>
With selected: <input name="process_update" type="submit" value="Update"> <input name="process_delete" type="submit" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus semua foto yang dipilih?')"><br />
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