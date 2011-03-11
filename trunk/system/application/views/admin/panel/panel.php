<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
Widget
</div>

<h2>Widget</h2>
<br />

<!--
<div class="toolbar">
<a href="{url insert}">Tambah Widget Baru</a>
</div>
-->

<br />
<br />

<table class="table-common">
<tr>
	<th width="5%">No.</th>
	<th>Name Widget</th>
	<th>Label Widget</th>
	<th width="100px">Aksi</th>
</tr>
{panel_list}
<tr class="{alert}">
	<td align="center">{no}</td>
	<td>{panel_name}</td>
	<td>{panel_label}</td>
	<td class="table-common-links" nowrap="nowrap">{url action}</td>
</tr>
{/panel_list}
</table>

</div>
</div>
</div>
</body>
</html>