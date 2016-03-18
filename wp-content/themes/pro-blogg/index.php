<?php
get_header();
?>
	
	<?php 
	dess_setting('dess_show_slider') = 1; echo 2222;exit;
		if (dess_setting('dess_show_slider') == 1) :
			
			$args = array(
				'post_type' => 'post',
				'meta_key' => 'show_in_slider',
				'meta_value' => 'yes',
				'posts_per_page' => -1,
				'ignore_sticky_posts' => true
				);
			$the_query = new WP_Query( $args );  

			$rows = $wpdb->get_results( "SELECT meta_value FROM yy_postmeta WHERE meta_key = 'show_in_slider' AND post_id = $post->ID" );
			var_dump($rows);exit;


	 		if ( $the_query->have_posts() ) :
				echo '<section>';
	 			echo '<div class="home_slider top-banner flexslider"><ul class="slides">';
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
							echo '<li><a style="background-image: url('.$thumbnail[0].')" class="home_slide_bg" href="'.get_permalink().'"></a><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		 					break;
		 			}
		 			
	 			endwhile;
	 			echo '</ul></div>';
				echo '</section>';
	 			wp_reset_postdata();
	 		endif;
 		endif;

 	?>
 	

<?php
get_homeContent();
get_footer();
?>