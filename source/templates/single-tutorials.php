<?php 
/**
 * The loop that displays a single tutorial page.
 *
 * @package PotionCode
 */
get_header(); ?>

<div id="content" class="row">
	<h1>
		<?php 
			$tutTitle = the_title('','',false); 
			echo $tutTitle;
		?>
	</h1>
	
	<?php  echo "<p>by ".get('tutorial_info_credit')."</p>"; ?>	
</div>