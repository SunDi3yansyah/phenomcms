<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;
<a href="{base_url}cpm/directory/user/">User Management</a> &gt;  
Daftar User
</div>

<h2>Daftar User</h2>
<br />

<div class="toolbar">
<a href="{url insert}">Tambah User Baru</a>
</div>
<br />
<br />

<?php if (!empty($user_list)) { ?>
<table class="table-common">
<tr>
	<th width="5%">No.</th>
	<th>Username</th>
	<th>Nama</th>
	<th>Email</th>
	<th width="100px">Aksi</th>
</tr>
{user_list}
<tr>
	<td align="center">{no}</td>
	<td>{userName}</td>
	<td>{userCompleteName}</td>
	<td>{userEmail}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/user_list}
</table>
<?php 
} 
else {
?>

<?php } ?>

</div>
</div>
</div>
</body>
</html>