<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/menu/">Menu</a> &gt;  
<a href="{base_url}cpm/groupmenu">Group Menu</a> &gt; 
Insert
</div>

    <h2>Add Group Menu</h2>
<br />

<form method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/groupmenu_insert/">
<table class="table-form">
<tr>
	<th>Group Menu Name</th>
	<th>:</th>
	<td>
	<input name="mr_name" type="text" size="60">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<input name="mr_visibile" type="radio" value="1" checked> Show
	<input name="mr_visibile" type="radio" value="0"> Hide
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