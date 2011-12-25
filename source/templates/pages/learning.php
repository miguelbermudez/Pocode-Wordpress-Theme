<?php
/**
 * The template for the Learning page.
 * Template Name: pcode_learning
 * @package PotionCode 
 */

 get_header(); ?>

 <h2 class="blackbox">learning</h2>	

<div id="content" class="row">
	<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$tutorialQuery = new WP_Query(
			array(
				'paged'			=> 	$paged,
				'category_name'	=> 	'tutorials',
				'orderby'		=>	'meta_value',
				'meta_key'		=>	'tutorial_info_date', 
				'order'			=>	'ASC',
				'posts_per_page'=>	-1
				//'posts_per_page'=>	3
			)
		);
		if ( $tutorialQuery->have_posts() ) : while ( $tutorialQuery->have_posts() ) : $tutorialQuery->the_post();	
			global $more; $more = 0;	//enable more tag for 'the_content()'
			
			$permalink     = get_permalink();
			$tutorialTitle = the_title('', '', false);

			//process proj date to a format we want
			$time = strtotime(get('tutorial_info_date'));
			$date = date('m/d/y', $time ); 
			global $more; $more = 0;	//enable more tag for 'the_content()'
			
			echo "<section class=\"tutorial_item\">";
				echo "<div id=\"left\">";
					echo "<a href=\"$permalink\" title=\"$tutorialTitle\">";
						echo get_image('tutorial_info_thumb');
					echo '</a>';
				echo "</div>";
				
				echo "<div id=\"right\">";
					the_title('<h1>', '</h1>');
					wpe_excerpt('wpe_excerptlength_tutorial', 'wpe_excerptmore');
				echo "</div>";
				
				echo "<div id=\"data_status\" class=\"clearfix\">";
						echo "<time class=\"small\">".$date."</time>";
						echo "<p><span class=\"bird_icon ir\">twitter</span></p>";
						echo "<p><span class=\"comment_icon ir\">twitter</span></p>";
					echo "</div>";
				echo "<div class=\"clearfix\"></div>";

			echo "</section>";

		endwhile; else:
			echo "<p>";
				_e('Sorry, no posts matched your criteria.');
			echo "</p>";
		endif;

		//potioncode_pagination($tutorialQuery->max_num_pages);
		wp_reset_postdata();
	?>
</div> <!-- #content -->


<?php 

get_footer(); ?>

