<?php
/**
 * The template for the Download page.
 * Template Name: pcode_download
 * @package PotionCode 
 */

 get_header(); ?>
 
<h2 class="blackbox">download</h2>	

<div id="content" class="row">
	
	<section>
		<?php 
			$page = get_page_by_title('Download');
			$content = $post->post_content;
			echo "<p>";
				echo $content;
			echo "</p>";
		?>
		<hr class="porule" />
	</section>


	<!-- <section id="downloads"> -->
		<?php 
			// $downloads = get_group('package');
			// foreach ($downloads as $dl) {
			// 	$title = $dl['package_title'][1];
			// 	$url = $dl['package_url'][1];
			// 	$filename = $dl['package_filename'][1];
			// 	$bigarrow = '<span class="bigarrow ir">&rarr;</span>';

			// 	echo "<div class=\"download_link\">";
			// 		echo "<h1>".$title."</h1>";
			// 		echo "<a href=\"".$url."\">".$bigarrow.' '.$filename."</a>";
			// 	echo "</div>";
			// }
		 ?>
	<section id="downloads">
		<?php
			$downloadsQuery = new WP_Query(
            array(
                'category_name' =>  'downloads',
                'orderby'       =>  'meta_value',
                'posts_per_page'=>  -1
                //'posts_per_page'=>    3
            )
        	);
	        $projCounter = 1;
	        if ( $downloadsQuery->have_posts() ) : while ( $downloadsQuery->have_posts() ) : $downloadsQuery->the_post(); 
	        	echo '<section class="release">';
		        	echo "<h1>";
						$dw_title = the_title('','',false); 
						$time = strtotime(get('downloads_date'));
						$date = date('m/d/y', $time ); 
						echo "<time class=\"small\">".$date."</time>";
						echo $dw_title;
					echo "</h1>";
					
					echo "<div class=\"entry\">";
						remove_filter ('the_content', 'wpautop');
						the_content();  
					echo "</div>";

					echo "<div class=\"download_link\">";
						$dw_mac_url = get('downloads_mac_url');
						$dw_win_url = get('downloads_win_url');

						$dw_mac_filename = get('downloads_mac_title');
						$dw_win_filename = get('downloads_win_title');

						$bigarrow = '<span class="bigarrow ir">&rarr;</span>';
						
						if ( strlen($dw_mac_url) > 0 )
							echo "<a href=\"".$dw_mac_url."\">".$bigarrow.' '.$dw_mac_filename."</a>";
						
						if ( strlen($dw_win_url) > 0 )
							echo "<a href=\"".$dw_win_url."\">".$bigarrow.' '.$dw_win_filename."</a>";
					echo "</div>";
				echo '</section>';
				
			 endwhile; else:
	            echo "<p>";
	                _e('Sorry, no posts matched your criteria.');
	            echo "</p>";
	        endif;

	        //potioncode_pagination($tutorialQuery->max_num_pages);
	        wp_reset_postdata();
    	?>
	</section><!-- /downloads -->

</div> <!-- #content -->

 <?php
get_footer(); ?>