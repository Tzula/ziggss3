<?php wp_homeContent(); ?>
<div class="content" style="margin-left:auto;margin-right:auto;">
	<div class="container">
		<div class="post_content">
			<div class="home_posts">
			
				<?php
					$args2 = array(
					'post_type' => 'post',
					'posts_per_page' => 29,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					);
					$query = new WP_Query( $args2 );
					if ( $query->have_posts() ) :
						$index = 0;
						while ( $query->have_posts() ) 
						{

							$query->the_post();
							echo '<div class="grid_post">';
							$type = get_post_meta($post->ID,'page_featured_type',true);
				 			switch ($type) {
				 				case 'youtube':
				 					echo '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
				 					break;
				 				case 'vimeo':
				 					echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=03b3fc" width="500" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				 					break;
				 				default:
									if ($index == 2) {
										//用于解决第三块放置广告位
										echo '<div class="hr"><hr/></div>';
										echo '<div class="home_ad_site">AD Site';
										echo '<script async		src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
										<!-- orzzzz indexpage 300250 -->
										<ins class="adsbygoogle"
											 style="display:inline-block;width:300px;height:250px"
											 data-ad-client="ca-pub-3742939967040468"
											 data-ad-slot="8884939235"></ins>
										<script>
										(adsbygoogle = window.adsbygoogle || []).push({});
										</script>';
										echo '</div>';
										//广告位结束
										echo '<div class="hr"><hr/></div>';
										echo '<div class="grid_post_img" >
													<a href="'.get_permalink().'"><img src="'.catch_that_image().'" style="border-top:2px;color:#00B7EE;"></a>
												</div>';
										echo '<div class="grid_post_title"><h5><a href="'.get_permalink().'">'.mb_strimwidth(get_the_title(),0,60,'……').'</a></h5></div>';
										echo '<div class="grid_post_views"><img src="./wp-content/themes/pro-blogg/images/icon-hits.png" width="20px";height="20px";>';
										echo '<span class="views">'; if(function_exists('the_views')) { echo the_views(); }
										echo '</span></div>';


									} else {
										echo '<div class="hr"><hr/></div>';
										echo '<div class="grid_post_img" >
													<a href="'.get_permalink().'"><img src="'.catch_that_image().'" style="border-top:2px;color:#00B7EE;"></a>
												</div>';
										echo '<div class="grid_post_title"><h5><a href="'.get_permalink().'">'.mb_strimwidth(get_the_title(),0,60,'……').'</a></h5></div>';
										echo '<div class="grid_post_views"><img src="./wp-content/themes/pro-blogg/images/icon-hits.png" width="20px";height="20px";>';
										echo '<span class="views">'; if(function_exists('the_views')) { echo the_views(); }
										echo '</span></div>';
									}
									
									$index += 1;

									break;
							}
							echo '<div class="grid_home_posts"></div></div>';
						}//}endwhile;
				?>
		</div>
		<?php
			echo '<div class="load_more_content"><div class="load_more_text">';
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
		<div class="clear"></div>
	</div>
	</div>