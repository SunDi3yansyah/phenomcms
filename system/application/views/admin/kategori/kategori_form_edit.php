<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/posting/">Posting</a> &gt;  
<a href="{base_url}cpm/kategori">Kategori</a> &gt; 
Edit
</div>

<h2>Edit Kategori</h2>
<br />

<form method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/category_edit/">
<table class="table-form" style="width:800px">
<tr>
	<th width="200px">Nama Kategori</th>
	<th>:</th>
	<td>
	<input name="mr_id" type="hidden" value="{multiple record id}">
	<input name="mr_name" type="text" size="60" value="{multiple record name}">
	<input name="mr_records" type="hidden" value="{multiple record jum}">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<?php
	if ($multiple_record_visible=='1') $checked1 = 'checked';
	else $checked1 = '';
	if ($multiple_record_visible=='0') $checked0 = 'checked';
	else $checked0 = '';
	?>
	<input name="mr_visibile" type="radio" value="1" <?php echo $checked1?>> Tampilkan
	<input name="mr_visibile" type="radio" value="0" <?php echo $checked0?>> Sembunyikan
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