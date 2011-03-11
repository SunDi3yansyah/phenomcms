<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>Control Panel | PhenomCMS</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="generator" content="PhenomCMS Version 1.0.1" />
<meta http-equiv="author" content="PhenomCMS Team" />

<link href="{base_url}/files/admin/css/common.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_common.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_content.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_elements.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_forms.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_sidebar.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_table.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/submitbox.css" rel="stylesheet" type="text/css" title="Default">
	

</head>

<body>
<a name="top"></a>
	<!--Header-->
	<div id="header">
		<div id="header-image">
		</div>
		<div id="header-filler">
		<strong>Version 1.0.1</strong>
		</div>
	</div>

	<!--Navigation-->
	<div id="navigation" align="left">
		<div class="breadcrumb">
		<ul>
			<li class="home"><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/") ?>"><strong>Home</strong></a></li>
			<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')) ?>" target="_blank"><strong>Lihat Website</strong></a></li>
			<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/logout") ?>"><strong>Logout</strong></a></li>
		</ul>
		</div>
   </div>

	<!--Contents -->
	<div id="content">

		<!--Sidebar-->
  	<div id="sidebar">
			<div id="sidebarContents">

				<!--Menu Aktif-->
				
				<!--Menu Utama-->

 <div class='section-active'>	
  <h3>Settings</h3>
	<ul class='level-2'>
	    <li><a href='<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/profile/") ?>'>Profile</a></li>
 	    <li><a href='<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/themes/") ?>'>Themes</a></li>
 	    <li><a href='<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/halaman/") ?>'>Pages</a></li>
 	    <li><a href='<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/panel/") ?>'>Widget</a></li>
	</ul>
 </div>

  <h3>Menu</h3>
	<ul>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/groupmenu/") ?>">Group Menu</a></li>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/menu/") ?>">Item Menu</a></li>
	</ul>

  <h3>Posts</h3>
	<ul>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/kategori/") ?>">Post Categories</a></li>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/posting/") ?>">Posts</a></li>
	</ul>

  <h3>Module</h3>
	<ul>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/album/") ?>">Photo Galery</a></li>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/guestbook/") ?>">Guest Book</a></li>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/polling/") ?>">Polls</a></li>
	</ul>


<?php  
if ($this->session->userdata('username')=='admin') {
?>
 <div class='section-active'>	
  <h3>User Management</h3>
	<ul>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/user/") ?>">User Management</a></li>
		<li><a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page')."/cpm/password/") ?>">Setting Password</a></li>
	</ul>
 </div>
<?php 
}
?>

            <small>Copyright &copy; 2010<br /> Powered by PhenomCMS 1.0.1</small>
				<br><br>
			</div>
		</div>

