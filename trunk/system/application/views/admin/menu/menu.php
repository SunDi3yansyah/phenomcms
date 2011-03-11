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
<a href="{base_url}cpm/directory/menu/">Menu</a> &gt;  
Item
</div>

<h2>Item Menu</h2>
<br />

<div class="toolbar">
<a href="{url insert}">Add a New Menu Item</a>
</div>
<br />
<br />

{page_nav}
<br />
<table class="table-common" width="800px">
<tr>
	<th>No.</th>
	<th>Image</th>
	<th>Menu</th>
	<th>Group</th>
	<th>Content</th>
	<th width="130px">Aksi</th>
</tr>
{multiple record last posted list index}
<tr  class="{alert}">
	<td align="center">{no}</td>
	<td><img src="{mrc_image}" alt="No Image"></td>
	<td>{mrc_title}</td>
	<td>{mr_name}</td>
    <td>{mrc_content}</td>
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