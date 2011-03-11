  <div id="subcontent-wide">
    <div class="subcontent-element">
			<div class="subcontent-navigation">
				Home
			</div>
			
			
			<?php
			if (is_dir('./install')) {
			?>
	      	<div class="petunjuk-area">
		    	<h3>Please immediately remove the install folder from your server.</h3>
   		   	</div>
			<?php } ?>


			<br />
			<h2>Main Menu</h2>
			<div class="listview_common">
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/setting/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/setting.gif') ?>" alt="">
			Settings
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/menu/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/menu.png') ?>" alt="">
			Menu
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/posting/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/posting.png') ?>" alt="">
			Posts
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/modul/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/modul.gif') ?>" alt="">
			Module
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/user/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/user.gif') ?>" alt="">
			<font style="font-size:11px;">User Management</font>
			</a>
			</div>


			
   </div>
 </div>
 </div>
</body></html>