<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
	<title><?php wp_title(); ?></title>
	<!-- Basic Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- WordPress -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/includes/fonts/fonts.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="container">
    <header>
        <div id="logo">
            pocode logo
        </div>
        <nav>
            <ul class="nav">
                <li id="about" class="navbtn"><a href="#about">about</a></li>
                <li id="gallery" class="navbtn"><a href="#gallery">gallery</a></li>
                <li id="learning" class="navbtn"><a href="#learning">learning</a></li>
                <li id="reference" class="navbtn"><a href="#reference">reference</a></li>
                <li id="forum" class="navbtn"><a href="#forum">forum</a></li>
                <form id="search" action="" class="pull-right">
                    <input type="text" placeholder="Search">
                    <button type="submit"> <img src="images/searchicon.png" title="search"></img></button>
                </form>
            </ul>
        </nav>
    </header><!--end header-->

     <div id="main" role="main">