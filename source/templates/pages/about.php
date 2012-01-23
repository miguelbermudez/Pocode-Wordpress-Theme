<?php
/**
 * The template for the about page.
 * Template Name: pcode_about
 * @package PotionCode 
 */

 get_header(); ?>

 <h2 class="blackbox">about</h2>
 
 <div id="content" class="row">
 	<div id="story">
        <section>
            <h1 class="big"><?php echo strip_tags(get('headline'), '<span>'); ?></h1>
        </section>
        <section class="columns">
            <?php echo get('copy'); ?>
        </section>
        <hr class="porule" />
     </div>

     <div id="people">
     	 <h2 class="blackbox">people</h2>
     	<div id="container" class="clearfix">
	     	<?php 
				$pocode_people = get_group('People'); 
				foreach ($pocode_people as $person) {
					$name 	= $person['people_name'][1];
					$blurb	= $person['people_blurb'][1];
					echo '<dl>';
						echo '<dt>'.$name.'</dt>';
						echo '<dd>'.$blurb.'</dd>';
					echo '</dl>';
				}    
			?>	
     	</div> <!-- #container -->
     </div><!-- #people -->

     <div id="contactus">
     	<h2 class="blackbox">contact us</h2>
     		<?php 
     			echo get('contact_copy');
     		 ?>

     </div> <!-- #contactus -->
 </div> <!-- #content -->

 <?php
get_footer(); ?>