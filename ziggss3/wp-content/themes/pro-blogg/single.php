<?php
 get_header();
?>
<div class="single">
<div class="single_content">  
	<div class="single_container">
		<div class="single_post_content">
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="post_box" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_nav">
					<span class="prev_post">
						<?php  previous_post_link('%link', '') ?>
					</span>
					<span class="next_post">
						<?php  next_post_link('%link', '') ?>
					</span>
				</div>
				<div class="clear"></div>
				<h1><?php the_title(); ?></h1>
				<hr>
				<!--博客详情部分添加300*250广告位 -->
				<div class="single_srticle_ad_site">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- orzzzz content 300250 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:300px;height:250px"
							 data-ad-client="ca-pub-3742939967040468"
							 data-ad-slot="2803209634"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
				<?php the_content(); ?>
					<?php
					wp_link_pages(array(
						'before' => '<div class="link_pages">'.__('Pages', 'pro-blogg'),
						'after' => '</div>',
						'link_before' => '<span>',
						'link_after' => '</span>'
					)); 
				?>
				<?php the_tags( '<div class="post_tags">Tags: ', ', ', '</div>' ); ?> 
				
			</article>
				[<a id="single_comments" href="#">查看评论</a>]
			
				<!-- 评论弹框的隐藏显示js交互-->
				<script type="text/javascript" src="./wp-content/themes/pro-blogg/js/jquery-1.11.2.min.js" ></script>

				<script>
					$("#single_comments").click(function(){
						alert(3333);
						var $str = $("#single_comments_list").attr("as"); 
						alert($str);
						alert(5555);
					});
				
				</script>

				<div id="single_comments_list" style="display:none" as="23232">
					<div class="clear"><hr></div>
					<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
								<div class="home_blog_box">
									<div class="comments_cont">
									<?php
										// If comments are open or we have at least one comment, load up the comment template
										comments_template( '', true );
									?>
									</div>
								</div>
					<?php endif;
			endwhile;
			?>
			</div>
		</div>
		<hr>
		<div class="guess_you_like">
			May be you like ~ ~ ~
		</div>
		<div class="include_homeContent" >
				
				<div class="single_one_title"><strong><span><em>More Trending News</em></span></strong></div>
				<div class="single_content" style="margin-left:auto;margin-right:auto;">
					<div class="single_container">
						<div class="single_post_content">
							<div class="single_home_posts">
							
								<?php
									$args2 = array(
									'post_type' => 'post',
									'posts_per_page' => 6,
									'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
									);
									$query = new WP_Query( $args2 );
									if ( $query->have_posts() ) :
										while ( $query->have_posts() ) : $query->the_post();
											echo '<div class="single_grid_post">';
											$type = get_post_meta($post->ID,'page_featured_type',true);
											switch ($type) {
												case 'youtube':
													echo '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
													break;
												case 'vimeo':
													echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=03b3fc" width="500" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
													break;
												default:
													//echo '<div class="single_hr"><hr/></div>';
													echo '<div class="single_grid_post_img" >
																<a href="'.get_permalink().'"><img src="'.catch_that_image().'" class="single_grid_post_img"></a>
															</div>';
												echo '<div class="single_grid_post_bottom">';
													echo '<div class="single_grid_post_title"><a href="'.get_permalink().'" style="font-color:#000000">'.get_the_title().'</a></div>';
													//echo '<div class="single_grid_post_views">													<img src="./wp-content/themes/pro-blogg/images/icon-hits.png" width="15px";height="15px";>';
													//echo '<span class="single_views">'; if(function_exists('the_views')) { echo the_views(); }
													//echo '</span></div>';
												echo '</div>';


													break;
											}
											echo '<div class="single_grid_home_posts">
														<p>'.dess_get_excerpt(120).'</p>
													</div>
												</div>
												';
										endwhile;
								?>
						</div>
						<?php
							echo '<div class="single_load_more_content"><div class="single_load_more_text">';
									ob_start();
										next_posts_link('LOAD MORE',$query->max_num_pages);
										$buffer = ob_get_contents();
									ob_end_clean();
									if(!empty($buffer)) echo $buffer;
								echo'</div></div>';					
							$max_pages = $query->max_num_pages;
								wp_reset_postdata();
							endif;
						?>
						<span id="max-pages" style="display:none"><?php echo $max_pages ?></span>
						</div>
						<?php //get_sidebar(); ?>
						<div class="single_clear"></div>
					</div>
					</div>
			
		</div>
    </div>
</div>
<div class="single_sidebar">
		<!--边栏广告位-->
		<div class="single_sidebar_ad_site">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- orzzzz content 300*600 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:600px"
				 data-ad-client="ca-pub-3742939967040468"
				 data-ad-slot="7373010037"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>
		<div class="single_sidebar_one_title"><strong><span><em><h2>What's Hot</h2></em></span></strong></div>
		<ul class="asidepost-list">  
		<?php if (function_exists('get_most_viewed')): ?>   
		<?php get_timespan_most_viewed('post',10,7, true); ?>   
		<?php endif; ?>  
		</ul>
</div>
</div>
<?php
get_footer();
?>

