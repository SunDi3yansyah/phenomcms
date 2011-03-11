<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>Login | PhenomCMS</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="{base_url}/files/admin/css/common.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_common.css" rel="stylesheet" type="text/css" title="Default">
<link href="{base_url}/files/admin/css/phenom_login.css" rel="stylesheet" type="text/css" title="Default">
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
	</div>

	<!--Navigation-->
	<div id="navigation" align="left">
		<div class="breadcrumb">
		<ul>
			<li class="home"><a href="#"><strong>Login</strong></a> </li>
		</ul>
		</div>

   </div>


<!--Contents -->
<div id="content">

  <div id="subcontent-wide-install">

    <div class="subcontent-element">

	<div class="login">
	
		<div class="loginBgBottom">
		
			<div class="loginBgTop">
			
				<h2>LOGIN</h2>

				
				<div class="loginBg">
				
					<form action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/login" method="post">
					<label class="txtFld">Username:</label><input class="txtFld" name="user" type="text" />
					
					<label class="txtFld">Password:</label><input class="txtFld" name="pass" type="password" />
					
					<p class="clear">&nbsp;</p>
					
					<div class="submit">
					
						<input name="submit" type="submit" value="Login" />
					
					</div>
					
					</form>					
				
				</div>
			
			</div>
		
		</div>
		
	
	</div>




			



   </div>
 </div>
 </div>
</body></html>