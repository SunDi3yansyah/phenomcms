<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="generator" content="PhenomCMS {app_version}" />
<meta http-equiv="author" content="{app_author}" />
<meta http-equiv="keywords" content="{app_keywords}" />

<link rel="stylesheet" href="{theme_url}/images/CitrusIsland.css" type="text/css" />
<link rel='stylesheet' id='wpcirrus-cloudStyle-css'  href='{theme_url}/jquery/cloud/cloud.css?ver=0.5.3' type='text/css' media='all' />

<script type='text/javascript' src='{theme_url}/jquery/cloud/cirrus.js?ver=0.5.3'></script>

<style type="text/css">
#preview_bg{
    width: 462px;
    height: 315px;
    clear: both;
}
/*
scroll styles here
*/
.item { width:462px; height:280px; padding: 0px 5px 5px 0px;}
.item img {float:left;}
.item h1 {
	font-size: 10pt;	
	color: #75A54B;
	margin-top:0px;
	background-color: #f2f2f2;
}

.scrollable {position:relative; overflow:hidden; width: 462px; height: 280px;border: 1px solid #f2f2f2;margin: 5px 0px 5px 0px;} 
.scrollable .items { width:20000em; position:absolute;}
.scrollable .items div { float:left;} 
.scrollable .items .item { overflow:hidden;}
.scrollable .items .item p { line-height:16px;padding:10px 10px 10px 10px;}
.scrollable .items .item a { line-height:16px;padding:10px;}
.navi { width:auto; height:20px; float:right; margin:0px 0 20px;} 
.navi a { width:23px; cursor:pointer; height:24px; float:left; margin:0 0 20px 1px; background:url({theme_url}/images/prev_but.png) no-repeat scroll right top; display:block; font-size:1px;} 
.navi a:hover, .navi a.active { background-position:left top; margin:0 0 20px 1px;  background:url({theme_url}/images/prev_but_hov.png) no-repeat scroll right top}
</style>

<title><?php echo $app_title ?></title>
	
</head>

<body>
<div id="wrap"><!-- wrap starts here -->
		
	
  <div id="header"> 
    <form method="post" class="search" action="{search_url}">
      <p> 
        <input name="{search_input_name}" class="textbox" type="text" />
        <input name="search" class="button" value="Search" type="submit" />
      </p>
    </form>
    <h1 id="logo"><?php echo $app_sitename ?></h1>
    <h2 id="slogan"><?php echo $app_slogan ?></h2>
  </div>
		
	<div id="menu">
		<ul>
			<li id="<?php echo $home_current ?>"><a href="{base_url}">Home</a></li>
			<?php 
			if (!empty($page_list)) { 
			foreach($page_list as $row=>$value) {
			?>
			<li id="<?php echo $value['page_current'] ?>"><a href="<?php echo $value['page_link'] ?>" target="<?php echo $value['page_target'] ?>"><?php echo $value['page_title'] ?></a></li>
			<?php } } ?>
		</ul>		
	</div>					
	
	<div id="sidebar">	
	
		<?php 
		if (!empty($menu)) {
		foreach($menu as $row_parent=>$value_parent) {
		?>
		<h1><?php echo $value_parent['menu_name'] ?></h1>
		<table class="news">
		<tr>
		<td>
		<ul class="sidemenu">
		<?php foreach ($value_parent['menu_data'] as $row_child=>$value_child) { ?>
			<li><a href="<?php echo $value_child['menu_link'] ?>" target="<?php echo $value_child['menu_target'] ?>"><?php echo $value_child['menu_title'] ?></a></li>
		<?php } ?>
		</ul>
		</td>
		</tr>
		</table>
		<?php } } ?>


		<?php if (!empty($category_list)) { ?>
		<h1>Category</h1>
		<table class="news">
		<tr>
		<td>
		<ul class="sidemenu">
			<?php foreach($category_list as $row=>$value) { ?>
			<li><a href="<?php echo $value['category_url'] ?>"><?php echo $value['category_name'] ?></a></li>
			<?php } ?>
		</ul>
		</td>
		</tr>
		</table>
		<?php } ?>


		<?php if (!empty($recent_comments)) { ?>
		<h1>Recent Comments</h1>
		<table class="news">
		<tr>
		<td>
		<ul class="sidemenu">
			<?php foreach($recent_comments as $row=>$value) { ?>
			<li><?php echo $value['name'] ?>, <?php echo $value['comment_url'] ?></li>
			<?php } ?>
		</ul>
		</td>
		</tr>
		</table>
		<?php } ?>


		<?php if ($app_use_polling == '1') { ?>
		<?php if (!empty($polling_topic)) { ?>
		<h1>Polling</h1>
		<form method="post" action="{polling_url}">
		<p>{polling_topic}</p>
		{polling_selection}
		<p><input type="radio" name="pil" value="{id}" {checked} {polling_disabled}> {name}</p>
		{/polling_selection}
		<p><input name="submit" type="submit" value="Vote" {polling_disabled}> <input name="submit" type="submit" value="Result"></p>
		</form>
		<?php } ?>
		<?php } ?>

		<?php if (!empty($widget1_title) & $widget1_visible == '1') { ?>
		<h1><?php echo $widget1_title ?></h1>
		<table class="news">
		<tr>
		<td>
		<?php echo $widget1_content ?>
		</td>
		</tr>
		</table>
		<?php } ?>


		<?php if ($app_use_loginform == '1') { ?>
		<h1>Login</h1>
		<form action="<?php echo config_item('base_url').config_item('index_page') ?>/cpm/login/" method="post">
		<p>
		<label>Username:</label>
		<input name="user" type="text" class="textbox" size="20" />
    	<label>Password:</label>
		<input name="pass" type="password" class="textbox" size="20" />
		<br />
		<br />
		<input type="submit" value="Sign In" class="button">
		</p>
	    </form>
		<?php } ?>

				
	</div>
		
	<div id="main">
			
		<h1>Tagged: {all_posts_by_tag_name}</h1>
		<br />
		{all_posts_by_tag_page_nav}

	<?php foreach ($all_posts_by_tag as $row=>$value) { ?>
    <table class="news">
      <tr> 
        <td> <h3><a href="<?php echo $value['posting_url']; ?>"><?php echo $value['posting_title']; ?></a></h3>
          <?php if (!empty($value['posting_thumbnail'])) { ?>
          <div style="padding:8px 10px 0 6px;float:left;"> <img src="<?php echo $value['posting_thumbnail']; ?>"> 
          </div>
          <?php } ?>
          <p><?php echo $value['posting_little_content']; ?></p>
          <div style="clear:both"></div>
          <p class="post-footer align-right"> <a href="<?php echo $value['posting_url']; ?>" class="readmore">Read 
            more</a> <a href="<?php echo $value['posting_url']; ?>" class="comments">Comments 
            (<?php echo $value['posting_comment_count']; ?>)</a> <span class="date"><?php echo $value['posting_date']; ?></span>	
          </p></td>
      </tr>
    </table>
	<?php 
	}
	?>

		{all_posts_by_tag_page_nav}

  </div>	
	
	<div id="rightbar">
	
		<?php 
		if (!empty($posting)) {
		foreach($posting as $row_parent=>$value_parent) {
		?>
		<h1><?php echo $value_parent['posting_category'] ?></h1>
		<table class="news">
		<tr>
		<td>
		<ul class="sidemenu">
		<?php foreach ($value_parent['posting_data'] as $row_child=>$value_child) { ?>
			<li>
			<small><?php echo $value_child['posting_date'] ?></small><br />
			<a href="<?php echo $value_child['posting_url'] ?>"><?php echo $value_child['posting_title'] ?></a>
			</li>
		<?php } ?>
		</ul>
		</td>
		</tr>
		</table>
		<?php } } ?>

		<?php if ($app_use_tagscloud == '1') { ?>
		<?php if (!empty($tags)) { ?>
		<h1>Tags Cloud</h1>
		<table class="news">
		<tr>
			<td>
			<script type="text/javascript">
			var wpcirrusRadius =80;
			var wpcirrusRefreshrate = 0;
			var wpcirrusFontColor;
			var wpcirrusBackgroundColor;
			</script>
			<div style="overflow:hidden;height: 150px; width: 100%;display:block;"  id="cirrusCloudWidget" onmousemove="calcRotationOffset(event.clientX, event.clientY, this);" onmouseout="resetRotationOffset();">
			<?php foreach ($tags as $row=>$value) { ?>
				<a href='<?php echo $value['tag_url'] ?>' style='font-size: <?php echo rand(10,16) ?>px;'><?php echo $value['tag_name'] ?></a>
			<?php 
				} 
			?>
			</div>
		</td>
		</tr>
		</table>
		<?php } ?>
		<?php } ?>


		<?php if (!empty($widget2_title) & $widget2_visible == '1') { ?>
		<h1><?php echo $widget2_title ?></h1>
		<table class="news">
		<tr>
		<td>
		<?php echo $widget2_content ?>
		</td>
		</tr>
		</table>
		<?php } ?>



						
			
	</div>		
	
</div><!-- wrap ends here -->	
	
<!-- footer starts here -->	
	<div id="footer">
		<div id="footer-content">
		
		<div id="footer-left"><?php echo $app_footer ?> | Design by CitrusIsland</div>

		<div id="footer-right">
   		<img src="<?php echo $feed_img ?>" style="border:none;" align="absmiddle"> <a href="{feed_url}">RSS Feed</a>
		</div>
		
		</div>	
	</div>
<!-- footer ends here -->	
	
</body>
</html>
