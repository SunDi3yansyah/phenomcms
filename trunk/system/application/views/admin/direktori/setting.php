  <div id="subcontent-wide">
    <div class="subcontent-element">
			<div class="subcontent-navigation">
				<a href="<?php echo config_item('base_url').config_item('index_page').'/cpm/' ?>">Home</a>
				> Pengaturan
			</div>
			
			
			<?php
			if (is_dir('./install')) {
			?>
	      	<div class="petunjuk-area">
		    	<h3>Harap segera menghapus folder install dari server Anda.</h3>
   		   	</div>
			<?php } ?>


			<br />
			<h2>Menu Utama</h2>
			<div class="listview_common">
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/setting/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/setting.gif') ?>" alt="">
			Pengaturan
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/menu/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/menu.png') ?>" alt="">
			Menu
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/posting/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/posting.png') ?>" alt="">
			Posting
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/modul/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/modul.gif') ?>" alt="">
			Modul
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/directory/user/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/user.gif') ?>" alt="">
			<font style="font-size:11px;">User Management</font>
			</a>
			</div>

			
			<div style="clear:both">&nbsp;</div>
			
			<h2>Pengaturan</h2>
			<div class="listview_common">
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/profile/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/profile.png') ?>" alt="">
			Profile
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/themes/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/themes.png') ?>" alt="">
			Themes
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/halaman/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/page.png') ?>" alt="">
			Halaman
			</a>
			<a href="<?php echo reduce_double_slashes(config_item('base_url').config_item('index_page').'/cpm/panel/') ?>">
			<img src="<?php echo reduce_double_slashes(config_item('base_url').'/files/admin/images/widget.png') ?>" alt="">
			Widget
			</a>
			</div>


			
   </div>
 </div>
 </div>
</body></html>