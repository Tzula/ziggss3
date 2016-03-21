<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
	</head> 
<body <?php body_class(); ?>>
	<!--<header style="margin-bottom:10px;float:left;">-->
		<div class="head-top" style="width:100%">
		<!--放置网站logo -->
			<div class="web-logo">
				<img src="/wp-content/uploads/2016/03/web-logo.png" width="150px" height="150px"> 
			</div>
			<div class="container">
			<div class="head_right">
				<!-- 将社交链接放置在搜索框上方-->
				<div class="head-socials">
					<ul>
						<?php
							$socials = array('twitter','facebook','google-plus','instagram','pinterest','vimeo','youtube','linkedin');
							for($i=0;$i<count($socials);$i++){
								$url = '';
								$s = $socials[$i];
								$url = dess_setting('dess_'.$s);
								echo ($url != '' ? '<li><a target="_blank" href="'.$url.'"><img src="'.esc_url( get_stylesheet_directory_uri() ).'/images/'.$s.'-icon.png" alt="'.$s.'" /></a></li>':'');
							}
						?>
					</ul>
				</div>
				<!-- 社交链接程序结束-->
				<div class="head_search">
					<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
						<label>
							<span class="screen-reader-text">Search for:</span>
							<input type="text" class="search-field" placeholder="Search" value="<?php echo get_search_query() ?>" name="s" />
							<input type="image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/search-icon.jpg">
						</label>
					</form>
				</div>
			</div>
			
				<div class="head-nav">
					<?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
				</div>
				<!--
				<div class="head-search">
					<?php get_search_form(); ?>
				</div>
				-->
				<div class="clear"></div>
			</div>
		</div>
	<!--</header>-->