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
Polling
</div>

<h2>Polling</h2>
<br />

<div class="toolbar">
<a href="{url insert}">Tambah Polling Baru</a>
</div>
<br />
<br />

{page_nav}
<br />
<table class="table-common" width="800px">
<tr>
	<th>No.</th>
	<th>Tanggal</th>
	<th>Topik Polling</th>
	<th width="200px">Aksi</th>
</tr>
{multiple record last posted list index}
<tr class="{alert}">
	<td align="center">{no}</td>
	<td>{polling_date}</td>
	<td>{polling_topic}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/multiple record last posted list index}
</table>
<br />
{page_nav}


</div>
</div>
</div>
</body>
</html>