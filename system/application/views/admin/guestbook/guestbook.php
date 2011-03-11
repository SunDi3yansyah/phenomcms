<style type="text/css">

#link{  
	padding:5px;  
	font-family:Arial, Helvetica, sans-serif;  
	font-size:11px;  
	color:#000000;  
	font-weight:bold;  
}  

#link a{  
	padding:4px 7px 4px 7px;  
	margin:0px 5px 0px 5px;  
	border:1px solid #BBBBBB;  
	background:#FFFFFF;  
	color:#000000;  
	text-decoration:none;  
}  

#link a:hover{  
	border:1px solid #000000;  
	background:#BBBBBB;  
	color:#FFFFFF;  
	text-decoration:none;  
}  
</style>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;
<a href="{base_url}cpm/directory/modul/">Modul</a> &gt;  
Guest Book
</div>

<h2>Guest Book</h2>
<br />

<?php if (!empty($guestbook_list)) { ?>
{page_nav}
<br />
<form method="post" action="{guestbook_selected_process}">
<input type="hidden" name="page" value="<?php echo $this->uri->segment(3) ?>">
<table class="table-common" width="700px">
<tr>
	<th></th>
	<th>Tanggal</th>
	      <th>Nama Tamu</th>
	      <th>Pesan</th>
	<th width="50px">Aksi</th>
</tr>
{guestbook_list}
<tr class="{alert}">
	<td align="center"><input name="confirm[]" type="checkbox" value="{id}"></td>
	<td>{date}</td>
	<td align="center">{avatar}<br />{name}<br />{email_guestbook}</td>
    <td>{message}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/guestbook_list}
</table>
<br />
{page_nav}
<br />
<table class="table-form">
<tr>
<td>
With selected: <input name="process_confirm" type="submit" value="Update Konfirmasi"> <input name="process_delete" type="submit" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus semua data yang dipilih?')"><br />
</td>
</tr>
</table>
</form>
<?php } 
else {
?>
Tidak ada komentar.
<?php } ?>


</div>
</div>
</div>
</body>
</html>