<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo $app_title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="generator" content="PhenomCMS {app_version}" />
<meta http-equiv="author" content="{app_author}" />
<meta http-equiv="keywords" content="{app_keywords}" />
<link rel="stylesheet" href="{theme_url}/styles/layout.css" type="text/css" />
<link rel='stylesheet' id='wpcirrus-cloudStyle-css'  href='{theme_url}/scripts/cloud/cloud.css?ver=0.5.3' type='text/css' media='all' />

<script type='text/javascript' src='{theme_url}/scripts/cloud/cirrus.js?ver=0.5.3'></script>
<script type="text/javascript" src="{theme_url}/scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="{theme_url}/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{theme_url}/scripts/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="{theme_url}/scripts/jquery.hslides.1.0.js"></script>
<script type="text/javascript" src="{theme_url}/scripts/jquery.hslides.setup.js"></script>
</head>
<body id="top">
<div id="header">
  <div class="wrapper">
    <div class="fl_left">
      <h1><a href="{base_url}"><?php echo $app_sitename ?></a></h1>
      <p><?php echo $app_slogan ?></p>
    </div>
    <div class="fl_right"> <a href="#"><img src="{theme_url}/images/demo/468x60.gif" alt="" /></a> </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div id="topbar">
  <div class="wrapper">
    <div id="topnav">
      <ul>
        <li class="<?php echo $home_current ?>"><a href="{base_url}">Home</a></li>
		<?php 
		if (!empty($page_list)) { 
			foreach($page_list as $row=>$value) {
		?>
			<li class="<?php echo $value['page_current'] ?>"><a href="<?php echo $value['page_link'] ?>" target="<?php echo $value['page_target'] ?>"><?php echo $value['page_title'] ?></a></li>
		<?php } } ?>
      </ul>
    </div>
    <div id="search">
      <form action="{search_url}" method="post">
        <fieldset>
        <legend>Search</legend>
        <input name="{search_input_name}" type="text" value="Keywords&hellip;"  onfocus="this.value=(this.value=='Keywords&hellip;')? '' : this.value ;" />
        <input type="submit" name="search" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div id="container">
  <div class="wrapper">
    <div id="content">
      <h1>{page_title}</h1>
	  <?php if (!empty($page_content)) { ?>
	  <?php if (!empty($page_image)) { ?>
	  <img class="figure" src="<?php echo $page_image; ?>">
	  <?php } ?>
      <p><?php echo $page_content; ?></p>
	  <?php } ?>
    </div>

    <div id="column">

	  <?php 
	  if (!empty($menu)) {
	  foreach($menu as $row_parent=>$value_parent) {
	  ?>
      <div class="subnav">
        <h2><?php echo $value_parent['menu_name'] ?></h2>
        <ul>
			<?php foreach ($value_parent['menu_data'] as $row_child=>$value_child) { ?>
			<li><a href="<?php echo $value_child['menu_link'] ?>" target="<?php echo $value_child['menu_target'] ?>"><?php echo $value_child['menu_title'] ?></a></li>
		  	<?php } ?>
        </ul>
      </div>
	  <?php } } ?>

	  <?php if (!empty($category_list)) { ?>
	  <div class="subnav">
	  	<h2>Category</h2>
		<ul>
			<?php foreach($category_list as $row=>$value) { ?>
			<li><a href="<?php echo $value['category_url'] ?>"><?php echo $value['category_name'] ?></a></li>
			<?php } ?>
		</ul>
	  </div>
	  <?php } ?>
	  


  	  <?php if ($app_use_tagscloud == '1') { ?>
      <div class="subnav">
        <h2>Tags Cloud</h2>
			<script type="text/javascript">
			var wpcirrusRadius =80;
			var wpcirrusRefreshrate = 0;
			var wpcirrusFontColor;
			var wpcirrusBackgroundColor;
			</script>
        <ul>
          <li> 
			<div style="overflow:hidden;height: 150px; width: 250px;display:block;"  id="cirrusCloudWidget" onmousemove="calcRotationOffset(event.clientX, event.clientY, this);" onmouseout="resetRotationOffset();">
			<?php foreach ($tags as $row=>$value) { ?>
				<a href='<?php echo $value['tag_url'] ?>' style='font-size: <?php echo rand(10,16) ?>px;'><?php echo $value['tag_name'] ?></a>
			<?php 
				} 
			?>
			</div>
          </li>
        </ul>
      </div>
	  <?php } ?>

	  <?php if ($app_use_polling == '1') { ?>
	  <?php if (!empty($polling_topic)) { ?>
      <div class="subnav">
        <h2>Polling</h2>
        <ul>
          <li> 
		  <div id="respond">
			<form method="post" action="{polling_url}">
			<p>{polling_topic}</p>
			{polling_selection}
			<p><input style="border:0;" type="radio" name="pil" value="{id}" {checked} {polling_disabled}> <label>{name}</label></p>
			{/polling_selection}
			<p><input name="submit" type="submit" value="Vote" {polling_disabled}> <input name="submit" type="submit" value="Result"></p>
			</form>
			</div>
          </li>
        </ul>
      </div>
	  <?php } ?>
	  <?php } ?>


	  <?php if ($app_use_loginform == '1') { ?>
      <div class="subnav">
        <h2>Login</h2>
        <ul>
          <li> 
		  	<div id="respond">
			<form action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/login/" method="post">
			<p>
			<input name="user" type="text" class="textbox" size="20" />
			<label>(Username)</label>
			</p>
			<p>
			<input name="pass" type="password" class="textbox" size="20" />
	   	 	<label>(Password)</label>
			</p>
			<input type="submit" value="Sign In"">
			</p>
		    </form>
			</div>
          </li>
        </ul>
      </div>
	  <?php } ?>

    </div>
    <br class="clear" />
  </div>

</div>


<div id="homecontent">
  <div class="wrapper">
    <ul>
      <li>
	  	<?php if ($widget1_visible == '1') { ?>
        <?php if (!empty($widget1_title)) { ?><h2 class="title"><?php echo $widget1_title ?></h2><?php } ?>
	    <p><?php echo $widget1_content ?></p>
		<?php } ?>
      </li>
      <li class="last">
	  	<?php if ($widget2_visible == '1') { ?>
        <?php if (!empty($widget2_title)) { ?><h2 class="title"><?php echo $widget2_title ?></h2><?php } ?>
	    <p><?php echo $widget2_content ?></p>
		<?php } ?>
      </li>
    </ul>
    <br class="clear" />
  </div>
</div>

<div id="footer">
  <div class="wrapper">
    <div class="footbox">
      <h2>Page</h2>
	  	<?php if (!empty($page_list)) { ?>
      <ul>
	  	<?php foreach($page_list as $row=>$value) { ?>
        <li><a href="<?php echo $value['page_link'] ?>" target="<?php echo $value['page_target'] ?>"><?php echo $value['page_title'] ?></a></li>
		<?php } ?>
      </ul>
	  <?php } ?>
    </div>
    <div class="footbox">
      <h2>Category</h2>
	  <?php if (!empty($category_list)) { ?>
      <ul>
	  	<?php foreach($category_list as $row=>$value) { ?>
        <li><a href="<?php echo $value['category_url'] ?>"><?php echo $value['category_name'] ?></a></li>
		<?php } ?>
      </ul>
	  <?php } ?>
    </div>
    <div class="footbox">
      <h2>Recent Posts</h2>
	  <?php if (!empty($recent_posts)) { ?>
      <ul>
	  	<?php foreach ($recent_posts as $row=>$value) { ?>
        <li><a href="<?php echo $value['posting_url']; ?>"><?php echo $value['posting_title']; ?></a></li>
	  	<?php } ?>
      </ul>
	  <?php } ?>
    </div>
    <div class="footbox">
      <h2>Recent Comments</h2>
	  <?php if (!empty($recent_comments)) { ?>
      <ul>
	  	<?php
		$i=0; 
		foreach ($recent_comments as $row=>$value) 
		{ 
		?>
        <li>
		<?php echo $value['name'] ?>, <?php echo $value['comment_url'] ?>
		<div style="clear:both;"></div>
		</li>
	  	<?php 
		$i = $i + 1;
		if ($i>5) break;
		} 
		?>
      </ul>
	  <?php } ?>
    </div>
    <br class="clear" />
  </div>
</div>



<div id="copyright">
  <div class="wrapper">
    <p class="fl_left"><?php echo $app_footer ?> | Design by OS Templates</p>
    <p class="fl_right"><img src="<?php echo $feed_img ?>" style="border:none;" align="absmiddle"> <a href="{feed_url}">RSS Feed</a></p>
    <br class="clear" />
  </div>
</div>
</body>
</html>
