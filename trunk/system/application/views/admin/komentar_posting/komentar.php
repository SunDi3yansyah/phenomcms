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
<a href="{base_url}cpm/directory/posting/">Posting</a> &gt;  
<a href="{base_url}cpm/posting/">Item</a> &gt;  
Komentar
</div>

<h2>Komentar</h2>

<?php if (!empty($komentar_category_posting)) { ?>
<br />
<table class="table-form" style="width:700px">
<tr>
	<th width="100px">Kategori Posting</th>
	<th>:</th>
	<td>{komentar_category_posting}</td>
</tr>
<tr>
	<th>Judul Posting</th>
	<th>:</th>
	<td>{komentar_posting_title}</td>
</tr>
</table>
<?php } ?>

<?php if (!empty($comment_posting)) { ?>
<h3>Daftar Komentar:</h3>
<br />
{page_nav}
<br />
<form method="post" action="{komentar_posting_selected_process}">
<input type="hidden" name="page" value="<?php echo $this->uri->segment(4) ?>">
<input type="hidden" name="posting_id" value="{comment_posting_id}">
<table class="table-common" width="700px">
<tr>
	<th></th>
	<th>Tanggal</th>
	<th>Pengirim</th>
	<th>Komentar</th>
	<th width="50px">Aksi</th>
</tr>
{comment_posting}
<tr class="{alert}">
	<td align="center"><input name="confirm[]" type="checkbox" value="{id}"></td>
	<td>{date}</td>
	<td align="center">{avatar}<br />{name}<br />{email_commentator}</td>
    <td>{comment}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/comment_posting}
</table>
<br />
{page_nav}
<br />
<table class="table-form">
<tr>
<td>
With selected: <input name="process_confirm" type="submit" value="Update Konfirmasi"> <input name="process_delete" type="submit" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus semua komentar yang dipilih?')"><br />
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