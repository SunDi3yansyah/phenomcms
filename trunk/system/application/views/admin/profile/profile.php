<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/setting/">Settings</a> &gt;  
Profile
</div>

<h2>Profile</h2>
<br />

<h3>Please edit your site profile:</h3>
<form method="post" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/profile_edit/">
      <table class="table-form" style="width:800px">
        <tr> 
          <th>Nama Situs</th>
          <th>:</th>
          <td> <input name="app_title" type="text" size="100" value="<?php echo $app_title ?>"> 
          </td>
        </tr>
        <tr> 
          <th>Slogan</th>
          <th>:</th>
          <td> <input name="app_slogan" type="text" size="100" value="{app_slogan}"> 
          </td>
        </tr>
        <tr> 
          <th>Author</th>
          <th>:</th>
          <td> <input name="app_author" type="text" size="100" value="{app_author}"> 
          </td>
        </tr>
        <tr> 
          <th>Email</th>
          <th>:</th>
          <td> <input name="app_email" type="text" size="100" value="{app_email}"> 
          </td>
        </tr>
        <tr> 
          <th>Footer</th>
          <th>:</th>
          <td>
		  <textarea  name="app_footer" cols="96" rows="3"><?php echo htmlspecialchars($app_footer); ?></textarea> 
          </td>
        </tr>
        <tr> 
          <th>Use Login Form</th>
          <th>:</th>
          <td>
		  <input name='app_use_loginform' type="radio" value="1" {app_use_loginform0}> Yes
		  <input name='app_use_loginform' type="radio" value="0" {app_use_loginform1}> No
          </td>
        </tr>
        <tr> 
          <th>Use the Tags Cloud</th>
          <th>:</th>
          <td>
		  <input name='app_use_tagscloud' type="radio" value="1" {app_use_tagscloud0}> Yes
		  <input name='app_use_tagscloud' type="radio" value="0" {app_use_tagscloud1}> No
          </td>
        </tr>
        <tr> 
          <th>Use Polls</th>
          <th>:</th>
          <td>
		  <input name='app_use_polling' type="radio" value="1" {app_use_polling0}> Yes
		  <input name='app_use_polling' type="radio" value="0" {app_use_polling1}> No
          </td>
        </tr>
        <tr> 
          <th>Terima Buku Tamu</th>
          <th>:</th>
          <td>
		  <input name='app_gb_approval' type="radio" value="1" {app_gb_approval1}> Through Approval
		  <input name='app_gb_approval' type="radio" value="0" {app_gb_approval0}> Without Approval
          </td>
        </tr>
        <tr> 
          <th>Terima Komentar</th>
          <th>:</th>
          <td>
		  <input name='app_comment_approval' type="radio" value="1" {app_comment_approval1}>Through Approval
		  <input name='app_comment_approval' type="radio" value="0" {app_comment_approval0}> Without Approval
          </td>
        </tr>
        <tr> 
          <td colspan="3"> <input type="submit" value="Save"> 
            <input name="reset" type="reset" value="Reset"> </td>
        </tr>
      </table>
    </form>



</div>
</div>
</div>
</body>
</html>