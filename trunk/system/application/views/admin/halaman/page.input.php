	<?php 
	include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
	$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
	$oFCKeditor = new FCKeditor('FCKeditor1') ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $single_record_content ;
	$oFCKeditor->Create() ;
	?>
	Insert Image:
	<input name="src_thumbnail" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)

