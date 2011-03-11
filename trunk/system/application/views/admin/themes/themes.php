<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
Themes
</div>

    <h2>Choose Theme</h2>
<br />

<form method="post" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/theme_edit/">
<table class="table-form" style="width:600px">
<tr>
	<th>Previous theme</th>
	<th>:</th>
	<td>
	{current_theme}
	</td>
</tr>
<tr>
	<th>Choose Theme</th>
	<th>:</th>
	<td>
	<select name="app_theme">
		{themes}
		<option value="{app_theme}" {selected}>{app_theme}</option>
		{/themes}
	</select>
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