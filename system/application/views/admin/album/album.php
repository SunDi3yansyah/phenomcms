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
<a href="{base_url}cpm/directory/modul/">Module</a> &gt;  
Album
</div>

<h2>Album</h2>
<br />

<div class="toolbar">
<a href="{url insert}">Add New Album</a>
</div>
<br />

<?php if (!empty($album)) { ?>
{page_nav}
<br />
<table class="table-common" width="800px">
<tr>
	<th>No.</th>
	<th>Date</th>
	<th>Thumbnail</th>
	<th>Album Title</th>
	<th>Description</th>
	<th width="100px">Action</th>
</tr>
{album}
<tr class="{alert}">
	<td align="center">{no}</td>
	<td align="center">{album_date}</td>
	<td><img src="{album_thumbnail}"></td>
	<td>{album_title}</td>
	<td>{album_desc}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/album}
</table>
<br />
{page_nav}
<?php } ?>

</div>
</div>
</div>
</body>
</html>