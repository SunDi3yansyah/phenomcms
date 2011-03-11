<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta name="robots" content="index,follow" />
  <meta http-equiv="generator" content="PhenomCMS {app_version}" />
  <meta http-equiv="author" content="{app_author}" />
  <meta http-equiv="keywords" content="{app_keywords}" />
  
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="{theme_url}/css/layout4_setup.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="{theme_url}/css/layout4_text.css" />
  <link rel='stylesheet' id='wpcirrus-cloudStyle-css'  href='{theme_url}/jscripts/cloud/cloud.css?ver=0.5.3' type='text/css' media='all' />
  
  <!-- Fix Smile Image Position -->
  <style type="text/css">
  	.comments img { float: left; margin: 0px !important; margin-right: 5px !important; }
	.comments { font-family: "Trebuchet MS", Arial; font-size: 9pt; }
	.cmt-img img { float: none !important; }
  </style>
  
  <!-- jQuery -->
  <script type="text/javascript" src="{theme_url}/jscripts/jquery-1.4.3.min.js"></script>
  <script type='text/javascript' src='{theme_url}/jscripts/cloud/cirrus.js?ver=0.5.3'></script>
  
  <title><?php echo $app_title ?></title>
</head>

<!-- Global IE fix to avoid layout crash when single word size wider than column width -->
<!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->

<body>
  <!-- Main Page Container -->
  <div class="page-container">

   <!-- For alternative headers START PASTE here -->

    <!-- A. HEADER -->      
    <div class="header">
      
      <!-- A.1 HEADER TOP -->
      <div class="header-top">
        
        <!-- Sitelogo and sitename -->
        <a class="sitelogo" href="<?php echo base_url();?>"></a>
        <div class="sitename">
          <h1><a href="<?php echo base_url();?>"><?php echo $app_sitename ?></a></h1>
          <h2><?php echo $app_slogan ?></h2>
        </div>	             
      </div>
      
      <!-- A.2 HEADER MIDDLE -->
      <div class="header-middle">    
   		
        <!-- Site message -->
		<!--
        <div class="sitemessage">
          <h1>EASY &bull; FLEXIBLE &bull; ROBUST</h1>
          <h2>The third generation Multiflex is<br /> here, now with cooler design<br /> features and easier code.</h2>
          <h3><a href="#">&rsaquo;&rsaquo;&nbsp;More details</a></h3>
        </div>  
		-->   
      </div>
      
      <div class="header-bottom">
      
        <div class="nav2">
          <ul><li><a href="{base_url}">Home</a></li></ul>
		  <?php 
			if (!empty($page_list)) { 
			foreach($page_list as $row=>$value) {
			?>
			<ul><li><a href="<?php echo $value['page_link'] ?>" target="<?php echo $value['page_target'] ?>"><?php echo $value['page_title'] ?></a></li></ul>
			<?php } } ?>        
        </div>
	  </div>

      <!-- A.4 HEADER BREADCRUMBS -->

      <!-- Breadcrumbs -->
      <div class="header-breadcrumbs">

        <!-- Search form -->                  
        <div class="searchform">
          <form action="{search_url}" method="post" class="form">
            <fieldset>
              <input name="{search_input_name}" class="field" />
              <input type="submit" value="GO!" name="button" class="button" />
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <div class="main">
 
      <div class="main-navigation">
			<div class="round-border-topright"></div>
			<?php
				if (!empty($menu)) {
			?>
			<!-- Sidebar Menu -->
			<?php
				$i = 0;
				foreach($menu as $row_parent=>$value_parent) {
					if($i == 0) {
			?>
				<h1 class="first"><?php echo $value_parent['menu_name'] ?></h1>
			<?php } else { ?>
				<h1><?php echo $value_parent['menu_name'] ?></h1>
			<?php } ?>
			<dl class="nav3-grid">
				<?php foreach ($value_parent['menu_data'] as $row_child=>$value_child) { ?>
			  <dt><a href="<?php echo $value_child['menu_link'] ?>" target="<?php echo $value_child['menu_target'] ?>"><?php echo $value_child['menu_title'] ?></a></dt>
				<?php } ?>
			</dl>    
		<?php } } ?>              
		
			<?php if (!empty($category_list)) { ?>
			<!-- Category -->
			<h1>Category</h1>
			<dl class="nav3-grid">
				<?php foreach ($category_list as $row=>$value) { ?>
			  <dt><a href="<?php echo $value['category_url'] ?>"><?php echo $value['category_name'] ?></a></dt>
				<?php } ?>
			</dl>  
			<?php } ?>
			
			<?php if (!empty($recent_comments)) { ?>
			<!-- Recent Comments -->
			<h1>Recent Comments</h1>
			<dl class="nav3-grid">
				<?php foreach ($recent_comments as $row=>$value) { ?>
			  <dt><?php echo $value['comment_url'] ?><div style="margin-left: 20px;">Oleh : <strong><?php echo $value['name'] ?></strong></div></dt>
				<?php } ?>
			</dl>  
			<?php } ?>
			
			<?php if (!empty($adv1_title)) { ?>
			<!-- Advertisement -->
			<h1><?php echo $adv1_title ?></h1>
			<p><?php echo $adv1_content ?></p>
			<?php } ?>
      </div>
 
      <!-- B.2 MAIN CONTENT -->
      <div class="main-content">
        
        <!-- Guest Book -->
        <h1 class="pagetitle">{posting_title}</h1>
		
		<?php if ($posting_category_type != 'menu') { ?>
			<div class="column1-unit">
				<small><?php echo $posting_date; ?>, dibaca <?php echo $posting_hits; ?> kali</small>
				<span style="font-size: 8pt;">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style" style="float:right">
					<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4ce69fa2094037e9" class="addthis_button_compact">Share</a>
					<span class="addthis_separator">|</span>
					<a class="addthis_button_preferred_1"></a>
					<a class="addthis_button_preferred_2"></a>
					<a class="addthis_button_preferred_3"></a>
					<a class="addthis_button_preferred_4"></a>
					<a class="addthis_button_preferred_5"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4ce69fa2094037e9"></script>
					<!-- AddThis Button END -->
				</span>
			</div>
		<?php } ?>
			<div class="column1-unit">
				<p>
					<?php if (!empty($posting_image)) { ?>
					<img src="<?php echo $posting_image; ?>">
					<?php } ?>
					{posting_content}
					<hr class="clear-contentunit" />
					<br />
				</p>
			</div>
			<?php if (!empty($posting_tags)) { ?>
				<div class="column1-unit">
					<p class="detail">
					<h2>Tags</h2>
					<img src="{theme_url}/img/tags.gif" style="border: 0px; float: left; margin-right: 3px;"><?php echo $posting_tags ?></p>
					<hr class="clear-contentunit" />
				</div>
			<?php } ?>
		<?php
			if ($posting_category_type != 'menu') {
			if (!empty($comment_message))  { 
		?>
			<h2 style="color: #ff0000;">{comment_message}</h2>
		<?php }
			if (!empty($post_comments)) {
		 ?>
		 	<h2>Komentar:</h2>
			{comments_page_nav}
			
			{post_comments}
			{id}
			<p>
			<div class="comments" style="overflow: hidden; border: 1px solid #cccccc; background: #dddddd; margin: 3px; padding: 5px;">
			{avatar}
			{date}  <br />
			{name}: <br />
			<div class="cmt-img">{content}</div>  <br />
			</div>
			</p>
			{/post_comments}
			{comments_page_nav}
			<?php } ?>
			
			<?php
			if ($posting_comment_status == '1') {
			?>
			<div class="contactform">
			<h2>Send Your Comment:</h2>
			<form name="phenomcms" method="post" action="{posting_comment_url}">
				<p><label for="comment_name" class="left">Your Name<span style="color: #ff0000;">*</span> :</label>
				<input type="text" name="comment_name" id="comment_name" class="field" /></p>
				<p><label for="comment_email" class="left">Your Email :</label>
				<input type="text" name="comment_email" id="comment_email" class="field" /></p>
				<p><label for="comment_url" class="left">Website :</label>
				<input type="text" name="comment_url" id="comment_url" class="field" /></p>
				<p><label for="comment_content" class="left">Message<span style="color: #ff0000;">*</span> :</label>
				<textarea name="comment_content" id="comment_content" cols="5" rows="5"></textarea></p>
				{smiley_table}
				<p><img src="{verification}" style="float: none;"></p>
				<p><label for="verification_code" class="left">Anti-SPAM<span style="color: #ff0000;">*</span> :</label>
				<input type="text" name="verification_code" id="verification_code" class="field" style="width: 100px;" /></p>
				<p><input type="submit" name="submit" id="submit" class="button" value="Send Comment" style="display: block; float: left;" /><input type="reset" name="reset" id="reset" class="button" value="Reset" style="float: left; display: block;" /></p>
				<input name="comment_posting_id" value="{posting_id}" type="hidden" />
			</form>
			</div>
			<script type="text/javascript">
			function insert_smiley(smiley)
			{
				document.phenomcms.comment_content.value += " " + smiley;
			}
			</script>
			<?php } else { ?>
			<blockquote>
			<p>Forum komentar untuk artikel ini telah ditutup.</p>
			</blockquote>
			<?php } ?>
			<?php } ?>	
      </div>
                
      <!-- B.3 SUBCONTENT -->
      <div class="main-subcontent">

		 <?php if ($app_use_loginform == '1') { ?>
        <!-- LOGIN -->
        <div class="subcontent-unit-border">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1>Login</h1>
          <p>
			<div class="loginform">
			<form action="{base_url}/cpm/login/" method="post" class="form" style="padding-left: 15px; margin-top: -15px;">
					<strong style="font-size: 8pt;">Username:</strong><br />
				  <input type="text" name="user" class="field" style="width: 100px;" /><br />
				  <strong style="font-size: 8pt;">Password:</strong><br />
				  <input type="password" name="pass" class="field" style="width: 100px;" /><br />
				  <input type="submit" value="SIGN IN" name="button" class="button" style="width: 70px;" />
			</form>
			</div>
			</p>
        </div>
		<?php } ?>
		
		<?php 
			if (!empty($posting)) {
			foreach($posting as $row_parent=>$value_parent) { 
		?>
		<!-- News -->
        <div class="subcontent-unit-border-orange">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1 class="orange"><?php echo $value_parent['posting_category'] ?></h1>
          <ul>
		  	<?php foreach ($value_parent['posting_data'] as $row_child=>$value_child) { ?>
		  	<li><small><?php echo $value_child['posting_date'] ?></small><br /><a href="<?php echo $value_child['posting_url'] ?>"><?php echo $value_child['posting_title'] ?></a></li>
			<?php } ?>
		  </ul>
        </div>
		<?php } } ?>
		
		<?php if ($app_use_polling == '1') { ?>
		<?php if (!empty($polling_topic)) { ?>
        <!-- Polling -->
        <div class="subcontent-unit-border-green">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1 class="green">Polling</h1>
		  <div class="loginform">
          <p>
		  <form method="post" action="{polling_url}">
		  	<p>{polling_topic}</p>
			{polling_selection}
			<p><input type="radio" name="pil" value="{id}" {checked} {polling_disabled}> {name}</p>
			{/polling_selection}
			<p><input name="submit" type="submit" value="Vote" {polling_disabled} class="button" style="float: left; margin-right: 5px;"><input name="submit" type="submit" value="Result" class="button"></p>
		  </form>
		  </p>
		  </div>
        </div>
		<?php } } ?>
		
		<?php if ($app_use_tagscloud == '1') { ?>
		<?php if (!empty($tags)) { ?>
		<!-- Tags Cloud -->
		<div class="subcontent-unit-border-blue">
          <div class="round-border-topleft"></div><div class="round-border-topright"></div>
          <h1 class="blue">Tags Cloud</h1>
		  <script type="text/javascript">
			var wpcirrusRadius =80;
			var wpcirrusRefreshrate = 0;
			var wpcirrusFontColor;
			var wpcirrusBackgroundColor;
			</script>
			<div style="overflow:hidden;height: 200px; width: 100%;display:block;"  id="cirrusCloudWidget" onmousemove="calcRotationOffset(event.clientX, event.clientY, this);" onmouseout="resetRotationOffset();">
			<?php foreach ($tags as $row=>$value) { ?>
			<a href='<?php echo $value['tag_url'] ?>' style='font-size: <?php echo rand(10,16) ?>px;'><?php echo $value['tag_name'] ?></a>
			<?php } ?>
			</div>
		</div>
		<?php } } ?>
		
		<!-- Advertisement 2 -->
		<?php if (!empty($adv2_title)) { ?>
			<div class="subcontent-unit-border-green">
				 <div class="round-border-topleft"></div><div class="round-border-topright"></div>
				 <h1 class="green"><?php echo $adv2_title ?></h1>
				 <p><?php echo $adv2_content ?></p>
			</div>
		<?php } ?>
		
      </div>
    </div>
      
    <!-- C. FOOTER AREA -->      

    <div class="footer">
      <p>
	  <?php echo $app_footer ?>
	  |
	  Design By Multiflex37
	  |
	  <img src="<?php echo $feed_img ?>" style="border:none;" align="absmiddle"> <a href="{feed_url}">RSS Feed</a>
	  </p>
    </div>      
  </div> 
  
</body>
</html>



