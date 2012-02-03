<?php
/**
 * The template for the home page.
 * Template Name: pcode_home
 * @package PotionCode 
 */

get_header(); ?>


<div id="slides">
    <div class="slides_container">
    <?php 
        $ProjQueryForSlideshow = new WP_Query(
            array(
                'category_name' =>  'projects',
                'orderby'       =>  'rand',
                'cat'           => -6,
                'numberposts'   => 10,
            )
        );

         if ( $ProjQueryForSlideshow->have_posts() ) : 
         while ( $ProjQueryForSlideshow->have_posts() ) : $ProjQueryForSlideshow->the_post();  
            $permalink = get_permalink();
            $projTitle = the_title('', '', false);
            if (strlen($projTitle) > 3) {
                echo '<div class="slides">';
                    echo '<a href="'.$permalink.'" title="'.$projTitle.'">';
                       echo get_image('project_info_feature_image');
                    echo '</a>';
                    echo '<div id="titlebox">';
                        echo '<p class="credit">'.strtolower(get('project_info_credit')).'</p>';
                        echo '<p class="title">'.strtolower($projTitle).'</p>';
                    echo '</div> <!-- #titlebox -->';
                echo '</div>';
            }
                        
        endwhile; else:
            
        endif;  
        wp_reset_postdata();      
     ?>
    </div>
</div> <!-- #slides -->

<div id="content" class="row">
    <div id="story">
        <section>
            <h1 class="big"><?php echo strip_tags(get('what_is_text'), '<span>'); ?></h1>
        </section>
        <section class="columns">
            <?php echo get('copy'); ?>
        </section>
        
     </div>

     <div id="sidebar">
        <section id="start">
            <h1 class="blackbox">start coding now</h1>
            <?php echo get('start_coding_now_copy'); ?>
            <p id="download_section" class="bigbold"><a href="/web/pocode/wordpress/download/"><span class="bigarrow ir">&rarr;</span>download</a></p>
            <hr class="porule" />
        </section>
        <section id="feature-tutorial">
            <h1 class="blackbox">featured tutorials</h1>
                <?php 
                    $numOfTutsToGet = get('num_of_tutorials ');
                    $tutsQuery = new WP_Query(
                        array(
                            'category_name' =>  'tutorials',
                            'orderby'       =>  'meta_value',
                            'meta_key'      =>  'tutorial_info_date',
                            'order'         =>  'ASC',
                            'posts_per_page'=>  3
                        )
                    );
                    if ( $tutsQuery->have_posts() ) : while ( $tutsQuery->have_posts() ) : $tutsQuery->the_post();  
                        global $more; $more = 0;    //enable more tag for 'the_content()'
                        $permalink     = get_permalink();
                        $tutorialTitle = the_title('', '', false);
                        
                        echo "<section>";
                            echo "<a class=\"feature-title\" href=\"$permalink\" title=\"$tutorialTitle\">";
                                the_title('<h1>', '</h1>');
                            echo "</a>";
                            wpe_excerpt('wpe_excerptlength_feat_tutorial');
                        echo "</section>";
                    endwhile; else:
                        echo "<p>";
                            _e('Sorry, no posts matched your criteria.');
                        echo "</p>";
                    endif;     
                ?>

            <!-- <hr class="porule" /> -->
        </section>
        <hr class="porule" />
    </div> <!-- #sidebar -->
</div> <!-- #content -->

<div class="clearfix"></div>

<?php 

get_footer(); ?>