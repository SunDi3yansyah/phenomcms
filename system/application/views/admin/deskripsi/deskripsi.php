<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  Deskripsi Blog
</div>

<h2>Deskripsi Blog</h2>
<br />

<h3>Silahkan edit deskripsi blog Anda:</h3>
<form method="post" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/desc_edit/">
<table class="table-form">
<tr>
	<th>Deskripsi Blog</th>
	<th>:</th>
	<td>
	<input name="desc_description" type="text" size="60" value="{description}">
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