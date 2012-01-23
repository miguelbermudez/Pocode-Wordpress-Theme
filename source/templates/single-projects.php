<?php 
/**
 * The loop that displays a single projects page.
 *
 * @package PotionCode
 */
get_header(); ?>


<div id="content" class="row">
	<article>
		<header class="clearfix">
			<h1><?php 
					$projTitle = the_title('','',false); 
					echo "<span>".get('project_info_credit')."</span>";
					echo $projTitle;
			?></h1>

			<div id="data_status" class="clearfix">
				<?php 
					$time = strtotime(get('project_info_date'));
					$date = date('m/d/y', $time ); 

					echo "<time class=\"small\">".$date."</time>";
					/*
					echo "<p>";
						echo "<span class=\"bird_icon ir\">twitter</span>";
					echo "</p>";
					echo "<p>";
						echo "<span class=\"comment_num\">".$post->comment_count."</span>";
						echo "<p><span class=\"comment_icon ir\">twitter</span></p>";
					echo "</p>";
					*/
				 ?>
			</div>
		</header>
		 
		 <hr class="porule" />

		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="entry">
				<?php //remove_filter ('the_content', 'wpautop'); ?>
				<?php the_content();  ?>
			</div> <!-- #entry -->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<?php comments_template( '', true ); ?>
		<?php 
			endif; 
			wp_reset_postdata();
		?>
	</article>
</div> <!-- #content -->

<?php
get_footer(); ?>