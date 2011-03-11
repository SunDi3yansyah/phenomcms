<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/menu/">Menu</a> &gt;  
<a href="{base_url}cpm/groupmenu">Group Menu</a> &gt; 
Edit
</div>

<h2>Edit Group Menu</h2>
<br />

<form method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/groupmenu_edit/">
<table class="table-form">
<tr>
	<th>Nama Group Menu</th>
	<th>:</th>
	<td>
	<input name="mr_id" type="hidden" value="{multiple record id}">
	<input name="mr_name" type="text" size="60" value="{multiple record name}">
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