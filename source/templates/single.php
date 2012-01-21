<?php
/**
 * The template for displaying all single posts.
 *
 * @package PotionCode 
 */

$post = $wp_query->post;

  if (in_category('tutorials')) {
      include(TEMPLATEPATH.'/single-tutorials.php');
  } elseif (in_category('projects')) {
     include(TEMPLATEPATH.'/single-projects.php');
  } //else {
      //include(TEMPLATEPATH.'/single_default.php');
  //} 
  
 ?>
