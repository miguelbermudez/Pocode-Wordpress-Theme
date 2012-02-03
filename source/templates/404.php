<?php
/**
 * The template for the 404 page.
 * Template Name: pcode_404
 * @package PotionCode 
 */

get_header(); ?>

<div id="content" class="row">

	<h1 class="page-title blackbox">
		<?php _e( '404: Page Not Found', 'pocode_theme' ); ?>
	</h1>
	<div>
		<p><?php _e( 'We are terribly sorry, but the URL you typed no longer exists. It might have been moved or deleted.'); ?></p>
	</div>
 </div> <!-- #content -->

 <?php
get_footer(); ?>