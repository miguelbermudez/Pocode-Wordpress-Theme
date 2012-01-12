<?php 
/**
 * The loop that displays a single tutorial page.
 *
 * @package PotionCode
 */
get_header(); ?>


<div id="content" class="row">
	<article>
		<header>
			<h1><?php 
					$tutTitle = the_title('','',false); 
					echo $tutTitle;
			?></h1>
			<?php echo "<p class=\"credit\">".get('tutorial_info_credit')."</p>"; ?>
		</header>
			
	</article>
</div>