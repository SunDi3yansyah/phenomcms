<div id="subcontent-wide">
<div class="subcontent-element">

<div class="subcontent-navigation">
<a href="{base_url}cpm">Home</a> &gt;  
<a href="{base_url}cpm/directory/user/">User Management</a> &gt;  
Password
</div>

<h2>Password</h2>
<br />

<h3>Silahkan edit password Anda:</h3>
<form method="post" action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/password_edit/">
      <table class="table-form">
        <tr> 
          <th>New Password</th>
          <th>:</th>
          <td> <input name="userPassword1" type="password" size="30" value=""> 
          </td>
        </tr>
        <tr> 
          <th>Confirm New Password</th>
          <th>:</th>
          <td> <input name="userPassword2" type="password" size="30" value=""> 
          </td>
        </tr>
        <tr> 
          <td colspan="3"> <input type="submit" value="Simpan"> 
            <input name="reset" type="reset" value="Reset"> </td>
        </tr>
      </table>
    </form>



</div>
</div>
</div>
</body>
</html>