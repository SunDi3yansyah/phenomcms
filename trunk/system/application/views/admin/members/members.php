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
<a href="{base_url}cpm/directory/services/">Members</a> &gt;  
Item
</div>

<h2>Members</h2>
<br />

<form method="post">
<table class="table-form" style="width:500px">
<tr>
	<td>Keywords</td>
	<td>:</td>
	<td>
	<input name="post_search" type="text" size="40">
	<input name="post_search_submit" type="submit" value="Search">
	</td>
</tr>
</table>
</form>

<div class="toolbar">
<a href="{url insert}">Add members</a>
</div>
<br />
<br />

{page_nav}
<br />

<?php
if (trim($this->session->userdata('post_search_key'))!='') {
?>
Search results "<?php echo $this->session->userdata('post_search_key') ?>" : <br /><br />
<?php } ?>

<table class="table-common" width="1000px">
<tr>
	<th>No.</th>
	<th>Image</th>
	<th>Full name</th>
	<th width="150px">Email</th>
	<th>Title job</th>
	<th>Company</th>
	<th>Profile</th>
	<th width="200px">Action</th>
</tr>
{multiple record last posted list index}
<tr class="{alert}">
	<td align="center">{no}</td>
	<td><img src="{mrc_image}"></td>
	<td>{mrc_fullname}</td>
	<td>{mrc_email}</td>
	<td>{mrc_title}</td>
	<td>{mrc_company}</td>
    <td>{mrc_profile}</td>
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