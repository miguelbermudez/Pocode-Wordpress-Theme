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

    <!-- WordPress -->
    <script type="text/javascript">
        var disqus_developer = 1; // developer mode is on
    </script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php 
        $homepage = get_page_by_title( 'pocode home' );
        $homepageID = $homepage->ID;
     ?>
     
	<div class="container">
        <header>
            <div id="logo"></div>    
            <?php wp_nav_menu( array( 
                'container'     => false, 
                'menu_class'    => 'nav',
                'theme_location'=> 'primary',
                'walker'        => new MV_Cleaner_Walker_Nav_Menu()) ); 
            ?>
            <!-- </nav> -->
        </header><!--end header-->
        <hr class="porule" />

        <div id="main" role="main">