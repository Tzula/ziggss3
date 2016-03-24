<link rel="stylesheet" href="/wp-content/themes/pro-blogg/css/owl.carousel.css" type="text/css" />
<script type="text/javascript" src="/wp-content/themes/pro-blogg/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/pro-blogg/js/owl.carousel.js"></script>
<script type="text/javascript">
$(function(){
	$('#owl-demo').owlCarousel({
		items: 1,
		navigation: true,
		navigationText: ["上一个","下一个"],
		autoPlay: true,
		stopOnHover: true,
		afterInit: function(){
			var $t = $('.owl-pagination span');
			$t.each(function(i){
				$(this).before('<img src="img/t' + (i+1) + '.jpg">');
			})
		}
	});
});
</script>

<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
#owl-demo img{border:0 none;}
#owl-demo{position:relative;width:990px;height:389px;padding-bottom:0px;margin:20px auto 10px auto;}
#owl-demo ul{margin:10px -10px 0 0;overflow:hidden;zoom:1;}
#owl-demo li{position:relative;float:left;margin:0px 0px 0 0;overflow:hidden;_display:inline;}
#owl-demo .li1{width:584px;height:389px;margin:0px 10px 0 0;}
#owl-demo .li2{width:396px;height:210px;}
#owl-demo .li3{height:170px;margin-top:10px;margin-bottom:9px;}
#owl-demo .li-3{margin-right:10px;}
#owl-demo .txt{position:absolute;left:0;bottom:-86px;_bottom:-1px;width:100%;padding:6px 0;font-size:12px;color:#fff;background:url(/wp-content/themes/pro-blogg/images/overlay.png);background:rgba(0, 0, 0, .7);transition:bottom 0.3s ease-out 0s;}
#owl-demo h3{padding:0 15px;font-family:"Microsoft Yahei";font-size:18px;font-weight:500;}
#owl-demo .li1 .txt{bottom:0;}
#owl-demo .li1 h3{padding:0 25px;font-size:18px;}
#owl-demo p{margin-top:4px;padding:0 25px 5px;}
#owl-demo a{color:#fff;text-decoration:none;}
#owl-demo li:hover .txt{bottom:0;}
/* 缩略图 */
.owl-pagination{position:absolute;left:0;bottom:0;width:100%;height:0px;text-align:center;}
.owl-page{position:relative;display:inline-block;width:0px;height:0px;margin:0 5px;border-radius:80px;*background-image:url(/wp-content/themes/pro-blogg/images/bg15.png);*display:inline;*zoom:1;vertical-align:middle;overflow:hidden;}
.owl-page img{width:100%;height:100%;border-radius:80px;}
.owl-pagination .active{width:80px;height:80px;}
.owl-pagination span{position:absolute;left:0;top:0;width:45px;height:45px;*background-image:url(/wp-content/themes/pro-blogg/images/ico_clip_s.png);_background-image:none;}
.owl-pagination .active span{width:80px;height:80px;background-image:url(/wp-content/themes/pro-blogg/images/ico_clip.png);_background-image:none;}
/* 左右箭头 */
.owl-buttons div{position:absolute;top:220px;width:50px;height:80px;text-indent:-9999px;background-image:url(/wp-content/themes/pro-blogg/images/arrow.png);transition:background-position 0.2s ease-out 0s;}
.owl-prev{left:-60px;background-position:0 0;}
.owl-next{right:-60px;background-position:right 0;}
.owl-prev:hover{background-position:-53px 0;}
.owl-next:hover{background-position:-122px 0;}
</style>

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
			$sliderImg = array();
			$images = array();
			$i = 0; 
			$j = 0;
			if ( $the_query->have_posts() ) :
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
							$sliderImg[] = array('imgUrl' => $thumbnail[0], 'title' => get_the_title(), 'getTheLink' => get_permalink());;
																			
							break; 
						}
				endwhile;
				wp_reset_postdata();
			endif;
			//var_dump($images);exit;
			/*从此处开始循环输出轮播图片,每三张图片存入一个数组组成一个三维数组*/
			foreach ($sliderImg as $key => $list) {
				switch ($key) {
					case $key < 4 :
						$images[$j][] = $list;
						break;
					case $key == 4 && $key < 8 :
						$j = $j + 1;
						$images[$j][] = $list;
						$j = 0;
						break;
					case $key == 8 && $key < 12 :
						$j = $j + 2;
						$images[$j][] = $list;
						$j = 0;
						break;
					case $key == 12 && $key < 16 :
						$j = $j + 3;
						$images[$j][] = $list;
						$j = 0;
						break;
				}
			}
			echo '<div id="owl-demo" class="owl-carousel">';
			//循环输出轮播图
			foreach ($images as $key => $list) {
				echo '<div class="itme">';
					echo '<ul>';
						echo '<li class="li1">
							  <a href="'.$list[0]['getTheLink'].'"><img src="'.$list[0]['imgUrl'].'" alt="yi Photos lost" style="width:584px;height:389px;"></a>
							  <div class="txt">
								<h3><a href="'.$list[0]['getTheLink'].'">'.$list[0]['title'].'</a></h3>
								<p></p>
							 </div>
						</li>';
						echo '<li class="li2">
							  <a href="'.$list[1]['getTheLink'].'"><img src="'.$list[1]['imgUrl'].'" alt="yi Photos lost"
							  style="width:396px;height:210px;"></a>
							  <div class="txt">
								<h4><a href="'.$list[1]['getTheLink'].'">'.mb_strimwidth($list[1]['title'],0,60,'……').'</a></h4>
								<p></p>
							 </div>
						</li>';
						echo '<li class="li3 li-3" style="width:193px;">
							  <a href="'.$list[2]['getTheLink'].'"><img src="'.$list[2]['imgUrl'].'" alt="yi Photos lost"
							  style="width:193px;height:170px;"></a>
							  <div class="txt">
								<h5><a href="'.$list[2]['getTheLink'].'">'.mb_strimwidth($list[2]['title'],0,40,'……').'</a></h5>
								<p></p>
							 </div>
						</li>';
						echo '<li class="li3" style="width:193px;">
							  <a href="'.$list[3]['getTheLink'].'"><img src="'.$list[3]['imgUrl'].'" alt="yi Photos lost"
							  style="width:193px;height:170px;"></a>
							  <div class="txt">
								<h5><a href="'.$list[3]['getTheLink'].'">'.mb_strimwidth($list[3]['title'],0,40,'……').'</a></h5>
								<p></p>
							 </div>
						</li>';

					echo '</ul>';
				echo '</div>';
			}
		echo '</div>';
		endif;
		?>	

	<?php
	get_homeContent();
	?>
	
<div class="home_footer">
	<?php
	echo get_footer();
	?>
</div>