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
	</section>

	<section id="downloads">
		<?php 
			$downloads = get_group('package');
			foreach ($downloads as $dl) {
				$title = $dl['package_title'][1];
				$url = $dl['package_url'][1];
				$filename = $dl['package_filename'][1];
				$bigarrow = '<span class="bigarrow ir">&rarr;</span>';

				echo "<div class=\"download_link\">";
					echo "<h1>".$title."</h1>";
					echo "<a href=\"".$url."\">".$bigarrow.' '.$filename."</a>";
				echo "</div>";
			}
		 ?>
	</section>

</div> <!-- #content -->

 <?php
get_footer(); ?>