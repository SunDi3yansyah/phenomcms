<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/user/">User Management</a> &gt;  
<a href="{base_url}cpm/user/">Daftar User</a> &gt;  
Insert
</div>

<h2>Insert User</h2>
<br />

<form method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/user_insert/">
<table class="table-form">
<tr>
	<th>Nama Lengkap</th>
	<th>:</th>
	<td>
	<input name="user_id" type="hidden" value="{user_id}">
	<input name="userCompleteName" type="text" size="40">
	</td>
</tr>
<tr>
	<th>Email</th>
	<th>:</th>
	<td>
	<input name="userEmail" type="text" size="40">
	</td>
</tr>
<tr>
	<th>Username</th>
	<th>:</th>
	<td>
	<input name="userName" type="text" size="40">
	</td>
</tr>
<tr>
	<th>Password</th>
	<th>:</th>
	<td>
	<input name="userPassword" type="password" size="40">
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