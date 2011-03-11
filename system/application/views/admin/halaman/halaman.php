<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
Pages
</div>

<h2>Pages</h2>
<br />

<div class="toolbar">
<a href="{url insert}">Add New Page</a>
</div>
<br />
<br />

<table class="table-common" width="800px">
<tr>
	<th width="5%">No.</th>
	<th>Image</th>
	<th>Page Title</th>
	<th>Content</th>
	<th width="130px">Action</th>
</tr>
{single record sidebar}
<tr class="{alert}">
	<td align="center">{no}</td>
	<td><img src="{sr_image}" alt="No Image"></td>
	<td>{sr_name}</td>
	<td>{content}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/single record sidebar}
</table>

</div>
</div>
</div>
</body>
</html>