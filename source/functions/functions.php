<?php


add_action( 'wp_enqueue_scripts', 'pocode_theme_enqueue_scripts' );

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
    $c[] = 'navbtn ir';
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
