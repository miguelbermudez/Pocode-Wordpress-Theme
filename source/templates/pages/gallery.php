<?php
/**
 * The template for the gallery page.
 * Template Name: pcode_gallery
 * @package PotionCode 
 */

 get_header(); ?>

 <h2 class="blackbox">gallery</h2>  


<div id="content" class="row">
    <?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
        $projectQuery = new WP_Query(
            array(
                'paged'         =>  $paged,
                'category_name' =>  'projects',
                'orderby'       =>  'meta_value',
                'meta_key'      =>  'project_info_date', 
                'order'         =>  'ASC',
                'posts_per_page'=>  -1
                //'posts_per_page'=>    3
            )
        );
        $projCounter = 1;
        if ( $projectQuery->have_posts() ) : while ( $projectQuery->have_posts() ) : $projectQuery->the_post(); 
            global $more; $more = 0;    //enable more tag for 'the_content()'
            
            $permalink    = get_permalink();
            $projectTitle = the_title('', '', false);

            //process proj date to a format we want
            $time = strtotime(get('project_info_date'));
            $date = date('m/d/y', $time ); 
            global $more; $more = 0;    //enable more tag for 'the_content()'
            
            if ($projCounter % 3 == 0) {
                echo "<section class=\"project_item last\">";   
            } else {
                echo "<section class=\"project_item\">";    
            }
                echo "<div id=\"top\">";
                    echo "<a href=\"$permalink\" title=\"$projectTitle\">";
                        echo get_image('project_info_gallery_thumb');
                    echo '</a>';
                echo "</div>";
                
                echo "<div id=\"bottom\">";
                    echo "<a href=\"$permalink\" title=\"$projectTitle\">";
                        the_title('<h1>', '</h1>');
                    echo "</a>";
                    echo "<p class=\"credit\">".get('project_info_credit')."</p>";
                    wpe_excerpt('wpe_excerptlength_gallery', 'wpe_excerptmore');
                echo "</div>";
                echo "<div id=\"data_status\" class=\"clearfix\">";
                        echo "<time class=\"small\">".$date."</time>";
                        echo "<p><span class=\"bird_icon ir\">twitter</span></p>";
                        echo "<p><span class=\"comment_icon ir\">twitter</span></p>";
                    echo "</div>";

            echo "</section>";
            $projCounter++;

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