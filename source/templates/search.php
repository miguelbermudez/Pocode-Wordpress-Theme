<?php
/**
 * The template for the search page.
 * Template Name: pcode_search
 * @package PotionCode 
 */

 get_header(); ?>

 <h2 class="blackbox">search results</h2>  

 <div id="content" class="row">

	<h3><?php printf( __( "Search results for '%s'", "pocode_theme" ), get_search_query() ); ?></h3>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php //get_template_part( 'loop' ); ?>
			<?php  
				global $more; $more = 0;    //enable more tag for 'the_content()'
	            
	            $permalink    = get_permalink();
	            $pTitle = the_title('', '', false);

	            echo "<section class=\"search_item\">";    
	            	echo "<header>";
	            		echo "<a href=\"$permalink\" title=\"$pTitle\">";
	            			echo "<h1>".$pTitle."</h1>";
	            		echo "</a>";
	            	echo "</header>";
	            	echo "<p>".wpe_excerpt('wpe_excerptlength_tutorial', 'wpe_excerptmore')."</p>";            
	            echo "</section>";  
	            echo "<hr class=\"porule\" />";


			?>
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>

	<?php else : ?>
		<div>
			<p><?php printf( __( 'Sorry, your search for "%s" did not turn up any results. Please try again.', 'pocode_theme' ), get_search_query());?></p>
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>

</div> <!-- #content -->

<?php 
get_footer(); ?>