<?php 
include("./files/admin/jscripts/fckeditor/fckeditor.php") ;
?>

<link type="text/css" href="{base_url}/files/admin/jscripts/datepicker/css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="{base_url}/files/admin/jscripts/datepicker/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="{base_url}/files/admin/jscripts/datepicker/js/jquery-ui-1.8.6.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){
				// Datepicker
				$('#datepicker').datepicker({
					inline: false
				});
			});
		</script>


<link href="{base_url}/files/admin/jscripts/jtagged/demo.css" rel="stylesheet" type="text/css" />
<!--
<script type="text/javascript" src="{base_url}/files/admin/jscripts/jtagged/jquery.min.js"></script>
-->
<script type="text/javascript" src="{base_url}/files/admin/jscripts/jtagged/jquery.timers.js"></script>
<script type="text/javascript" src="{base_url}/files/admin/jscripts/jtagged/jquery.tag.editor.js"></script>
<link rel=stylesheet href="{base_url}/files/admin/jscripts/jtagged/jquery.tagInput.css" type="text/css">
<script type="text/javascript" src="{base_url}/files/admin/jscripts/jtagged/jquery.tagInput.js"></script>
<script type="text/javascript">
  var tags=[
  		<?php for($i=0;$i<=count($tag)-1;$i++) { ?>
        {tag:"<?php echo $tag[$i]['name'] ?>"},
		<?php } ?>
      ]

  $(function(){
    $("#Tags").tagInput({
      tags:tags,
      //jsonUrl:"tags.json",
      sortBy:"frequency",
      tagSeparator:",",
      autoFilter:true,
      autoStart:false,
      //suggestedTagsPlaceHolder:$("#suggested"),
      boldify:true

    })
  })

        $(document).ready(function() {
            $("#Tags").tagEditor(
            {
                confirmRemoval: true,
                confirmRemovalText: 'Remove tag?',
                completeOnBlur: true
            });
            $("#getTagsButton").click(function() {
                alert($("#Tags").tagEditorGetTags());
            });
            $("#resetTagsButton").click(function() {
                $("#Tags").tagEditorResetTags();
            });
        });
</script>

<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/posting/">services</a> &gt;  
<a href="{base_url}cpm/posting/">Item</a> &gt;  
Insert
</div>

<h2>Insert services</h2>
<br />

<form enctype="multipart/form-data" method="post" name="phenomcms" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/services_insert/">
<table class="table-form" style="width:800px">
<tr>
	<th>Category</th>
	<th>:</th>
	<td>
		<select name="mrc_mr_id">
			<option value="1">Software</option>
			<option value="2">Hardware</option>
		</select>
	</td>
</tr>
<tr>
	<th width="100px">Date</th>
	<th>:</th>
	<td>
	<input name="mrc_date" type="text" id="datepicker" value="<?php echo date("Y-m-d H:i:s"); ?>">
	</td>
</tr>
<tr>
	<th>Title</th>
	<th>:</th>
	<td>
	<input name="mrc_title" type="text" size="120">
	</td>
</tr>
<tr>
	<th>SEO Keyords</th>
	<th>:</th>
	<td>
	<input name="mrc_seo" type="text" size="120">
	</td>
</tr>
<tr>
	<th width="100px">Status</th>
	<th>:</th>
	<td>
	<input name="mrc_visibile" type="radio" value="1" checked> Show
	<input name="mrc_visibile" type="radio" value="0"> Hide
	</td>
</tr>
<tr>
	<th width="100px">Action comment</th>
	<th>:</th>
	<td>
	<input name="mrc_comment_status" type="radio" value="1" checked> Active
	<input name="mrc_comment_status" type="radio" value="0"> Non Active
	</td>
</tr>
<tr>
	<td colspan="3">
<?php 
$sBasePath = config_item('base_path')."files/admin/jscripts/fckeditor/";
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Create() ;
?>
	</td>
</tr>
<tr>
	<th>Insert Thumbnail</th>
	<th>:</th>
	<td>
	<script language="javascript">
	function Checkfiles()
	{
	var fup = document.getElementById('filename');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "png" || ext == "PNG" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG")
	{
	return true;
	} 
	else
	{
	fup.value="";
	alert("Hanya file JPG atau PNG yang diperbolehkan!");
	return false;
	}
	}
	</script>
	<input name="mrc_thumbnail" type="file" id="filename" onchange="return Checkfiles()"> (jpg/png)
	<input type="hidden" name="mrc_current_thumbnail" value="{multiple_record_mrc_thumbnail}">
	<br />
	<font style="color:red;">Warning: </font> <br />
	To use a thumbnail, make sure the GD Library (php_gd2) already teristall on your serve.
	</td>
</tr>
<tr>
	<td colspan="3">
	<input type="submit" value="Save">
	<input type="reset" value="Reset">
	</td>
</tr>
</table>
</form>

</div>
</div>
</div>
</body>
</html>