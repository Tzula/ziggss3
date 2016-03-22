<?php
get_header();
?>
<div class="index_content" style="margin:0 auto;">
	<div class="archive_title">
		<h2><?php echo single_cat_title( '', false ); ?></h2>
	</div><!--//archive_title-->
	<div class="index_content_posts">
		
	    <?php
			$args = array_merge( $wp_query->query, array( 'posts_per_page' => 15 ) );
					$query = new WP_Query($args);
			if ($query->have_posts()) 
			{
				while($query->have_posts())
				{
					$query->the_post();
					echo '<div class="index_content_posts_grid_post">';
					$type = get_post_meta($post->ID,'page_featured_type',true);
					$categories = get_the_category($post->ID);
					//将object的对象转化成数组get_obhect_vars();
					$categories = get_object_vars($categories[0]);

					//获取文章的浏览次数
					$rows = $wpdb->get_results( "SELECT meta_value FROM yy_postmeta WHERE meta_key = 'views' AND post_id = $post->ID" );
					$views = get_object_vars($rows[0]);
					switch ($type) {
						case 'youtube':
							echo '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
							break;
						case 'vimeo':
							echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=03b3fc" width="500" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
							break;
						default:
							
						echo '<div class="index_post_hr"><hr/></div>';
						echo '<div class="index_grid_post_img" >
								 <a href="'.get_permalink().'"><img src="'.catch_that_image().'" style="border-top:2px;color:#00B7EE;width:320px;height:220px;" ></a>';
						echo '</div>';
						echo '<div class="imgmessage clearfix" ><a href="./category/'.strtolower($categories['name']).'">'.$categories['name'].'</a></div>';
						echo '<div class="index_grid_post_bottom">';
							echo '<div class="index_grid_post_title" ><a href="'.get_permalink().'">'.mb_strimwidth(get_the_title(),0,60,'……').'</a></div>';
							echo '<div class="index_grid_post_views" ><img src="/wp-content/uploads/2016/03/hits.png" width="20px";height="20px"; style="float:left;">';
							echo '<span class="index_views">';  echo $views['meta_value'];
							echo '</span></div>';
						echo '</div>';
						break;

					}//switch结束
					echo '<div class="grid_home_posts"></div>';
					echo '</div>';	//class="index_content_posts_grid_post“结束				
				} //while 结束

				//此处为加载更多部分内容 “more”
				echo '<div class="load_more_content">';
				echo '<div class="load_more_text">';
					ob_start();
					next_posts_link('LOAD MORE',$query->max_num_pages);
					$buffer = ob_get_contents();
					ob_end_clean();
					if(!empty($buffer))
						echo $buffer;
				echo'</div></div>';	
				
			    $max_pages = $query->max_num_pages;
				wp_reset_postdata();

			} //if ($query->have_posts())结束
		?>
		
		<span id="max-pages" style="display:none"><?php echo $max_pages ?></span>
		<!--</div>-->
	</div>
	<div class="index_clear"></div>
</div>
<?php
get_footer();
?>