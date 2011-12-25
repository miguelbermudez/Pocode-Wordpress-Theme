<?php


add_action( 'wp_enqueue_scripts', 'pocode_theme_enqueue_scripts' );
include_once("includes/theme-enqueue.php");

function show_posts_nav() {
   global $wp_query;
   return ($wp_query->max_num_pages > 1);
}

if ( ! function_exists( 'pocode_theme_enqueue_scripts' ) ) :

/**
* Add theme styles and scripts here
*/
function pocode_theme_enqueue_scripts() {

	if ( ! is_admin() ) {
		wp_enqueue_style(
			'pocode_theme-style',
			get_bloginfo( 'stylesheet_url' )
		);
	}

}
endif; // pocode_theme_enqueue_scripts

add_action( 'after_setup_theme', 'pocode_theme_setup' );

if ( ! function_exists( 'pocode_theme_setup' ) ) :


################################################################################
// Add theme support
################################################################################
/**
* Set up your theme here
*/

function pocode_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'nav-menus' );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation' ),
	) );
}

endif; // pocode_theme_setup


################################################################################
// Pagination
################################################################################

function potioncode_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
            echo '<div id="pagNumContainer" class="clearfix">'; 
                 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
                 if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
                    
                 for ($i=1; $i <= $pages; $i++)
                 {
                     if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                     {
                        echo ($paged == $i) ? "<span class='current'>".$i."</span>" : "<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
                        //echo "<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
                     }
                 }
        
                 if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
                 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
            echo '</div>';
         echo "</div>\n";
     }
}


################################################################################
// Custom walker
// for use in getting a cleaner wp_nav menu
// http://www.mattvarone.com/wordpress/cleaner-output-for-wp_nav_menu
################################################################################

class MV_Cleaner_Walker_Nav_Menu extends Walker {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $class_names = "";
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

        
        if ($class_names)
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
        $id = apply_filters( 'nav_menu_item_id', '', $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $menuTitle = strtolower($item->title);
        $output .= $indent . "<li id=\"$menuTitle\"" . $id  . $class_names .'>';
        
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		// new addition for active class on the a tag
		// http://wordpress.org/support/topic/customised-menu-walker
        if(in_array('current-menu-item', $classes)) {
            $attributes .= ' class="active"';
        }
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
    function end_el(&$output, $item, $depth) {
        $output .= "</li>\n";
    }
}

//http://www.mattvarone.com/wordpress/cleaner-output-for-wp_nav_menu/
function mv_custom_menu_classes($c)
{
    $c[] = 'navbtn';
    return $c;
}
add_filter('nav_menu_css_class','mv_custom_menu_classes');



################################################################################
// Actions + Filters
################################################################################

// Remove links to the extra feeds (e.g. category feeds)
remove_action( 'wp_head', 'feed_links_extra', 3 );
// Remove links to the general feeds (e.g. posts and comments)
remove_action( 'wp_head', 'feed_links', 2 );
// Remove link to the RSD service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );
// Remove link to the Windows Live Writer manifest file
remove_action( 'wp_head', 'wlwmanifest_link' );
// Remove index link
remove_action( 'wp_head', 'index_rel_link' );
// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Display relational links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
// Remove XHTML generator showing WP version
remove_action( 'wp_head', 'wp_generator' );

function custom_excerpt($text) {
	return str_replace('[...]', ' <a href="'. get_permalink($post->ID) . '" class="more">' . 'More&nbsp;&raquo;' . '</a>', $text);
}
add_filter('the_excerpt', 'custom_excerpt');

// Allow HTML in descriptions
$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
foreach ( $filters as $filter ) {
	remove_filter($filter, 'wp_filter_kses');
}

// Add search bar to nav menu 
// http://www.wprecipes.com/how-to-automatically-add-a-search-field-to-your-navigation-menu
add_filter('wp_nav_menu_items','add_search_box', 10, 2);
function add_search_box($items, $args) {
 
        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();
 
        $items .= '<li>' . $searchform . '</li>';
 
    return $items;
}


################################################################################
// Custom Multiple Excerpts
// http://wpengineer.com/1909/manage-multiple-excerpt-lengths/
################################################################################

// 30 word excerpts for gallery posts
function wpe_excerptlength_gallery($length) {
    return 30;
}

// 70 word excerpts for tutorial posts
function wpe_excerptlength_tutorial($length) {
    return 70;
}

function wpe_excerptmore($more) {
    return '<a class="read_more" href="' . get_permalink($post->ID) . '">✚</a>';
}

function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

function new_excerpt_more($more) {
    global $post;
    return '<a href="'. get_permalink($post->ID) . '">Read the Rest...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');