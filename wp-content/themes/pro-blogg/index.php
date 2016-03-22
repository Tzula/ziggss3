<script type="text/javascript" src="/wp-content/themes/pro-blogg/js/jquery-1.11.2.min.js" ></script>
<?php
get_header();
?>
	<?php 
		if (dess_setting('dess_show_slider') == 1) :
			
			$args = array(
				'post_type' => 'post',
				'meta_key' => 'show_in_slider',
				'meta_value' => 'yes',
				'posts_per_page' => -1,
				'ignore_sticky_posts' => true
				);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
				echo '<div class="home_slider" style="margin:0 auto;"><ul class="slides">';
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$type = get_post_meta($post->ID,'page_featured_type',true);
					switch ($type) {
						case 'youtube':
							echo '<li><iframe width="560" height="315" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?wmode=transparent" frameborder="0" allowfullscreen></iframe></li>';
							break;
						case 'vimeo':
							echo '<li><iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=03b3fc" width="500" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>';
							break;
						default:
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							echo '<li><a class="home_slide_bg" href="'.get_permalink().'">'.$thumbnail[0].'</a><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
							break;
					}
					
				endwhile;
				echo '</ul></div>';
				wp_reset_postdata();
			endif;
		endif;
		?>	
	

<?php
get_homeContent();
get_footer();
?>