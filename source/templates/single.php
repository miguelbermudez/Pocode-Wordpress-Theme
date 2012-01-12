<?php
/**
 * The template for displaying all single posts.
 *
 * @package PotionCode 
 */

$post = $wp_query->post;

  if (in_category('tutorials')) {
      include(TEMPLATEPATH.'/single-tutorials.php');
  } //elseif (in_category('2')) {
     // include(TEMPLATEPATH.'/single2.php');
  //} //else {
      //include(TEMPLATEPATH.'/single_default.php');
  //} 
  
 ?>
