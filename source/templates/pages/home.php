<?php
/**
 * The template for the home page.
 * Template Name: pcode_home
 * @package PotionCode 
 */

get_header(); ?>


<div id="slides">
    <!-- <img src="http://placehold.it/952x534" alt="" /> -->
    <?php echo get_image('feature_image'); ?>
    <div id="titlebox">
        <p class="credit"> <?php echo strtolower(get('feature_credit'));?></p>
        <p class="title"> <?php echo strtolower(get('feature_title'));?></p>
        <p class="descr"> <?php echo strip_tags(get('feature_excerpt'));?></p>
    </div> <!-- #titlebox -->
</div> <!-- #slides -->

<div id="content" class="row">
    <div id="story">
        <section>
            <h1 class="big"><?php echo strip_tags(get('what_is_text'), '<span>'); ?></h1>
        </section>
        <section class="columns">
            <?php echo get('copy'); ?>
        </section>
        <hr class="porule" />
     </div>

     <div id="sidebar">
        <section id="start">
            <h1 class="blackbox">start coding now</h1>
            <?php echo get('start_coding_now_copy'); ?>
            <p id="download" class="bigbold"><span class="bigarrow ir">&rarr;</span>download</p>
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