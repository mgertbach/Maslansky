<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package mas
 * @since mas 1.0
 */
?><!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta http-equiv="cleartype" content="on">

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="https://use.typekit.net/ybp6yey.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed site">

	<div id="headercontainer">
	<a class="assistive-text skip-link" href="#primary" title="<?php esc_attr_e( 'Skip to main content', 'mas' ); ?>"><?php esc_html_e( 'Skip to main content', 'mas' ); ?></a>

		<header id="masthead" class="site-header row" role="banner">
			<div class="col grid_5_of_12 site-title">
				<h1>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
						<?php
						$headerImg = get_header_image();
						if( !empty( $headerImg ) ) { ?>
							<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
						<?php }
						else {
							echo get_bloginfo( 'name' );
						} ?>
					</a>
				</h1>
			</div> <!-- /.col.grid_5_of_12 -->

			<div class="col grid_7_of_12">
				<!-- <div class="social-media-icons">
					<?php //echo mas_get_social_media(); ?>
				</div> -->
				<button id="megamenu-toggle">
					<svg xmlns="http://www.w3.org/2000/svg" width="64" height="35" viewBox="0 0 64 35">
					  <g id="Group_109" data-name="Group 109" transform="translate(16570 7372)">
					    <line id="Line_1" data-name="Line 1" x2="59" transform="translate(-16567.5 -7369.5)" fill="none" stroke="#e66c24" stroke-linecap="round" stroke-width="5"/>
					    <line id="Line_2" data-name="Line 2" x2="47" transform="translate(-16555.5 -7354.5)" fill="none" stroke="#e66c24" stroke-linecap="round" stroke-width="5"/>
					    <line id="Line_3" data-name="Line 3" x2="35" transform="translate(-16543.5 -7339.5)" fill="none" stroke="#e66c24" stroke-linecap="round" stroke-width="5"/>
					  </g>
					</svg>
				</button>
				<nav id="site-navigation" class="main-navigation megamenu-hide" role="navigation">
					<h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'mas' ); ?></h3>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mas' ); ?>"><?php esc_html_e( 'Skip to content', 'mas' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				</nav> <!-- /.site-navigation.main-navigation -->
			</div> <!-- /.col.grid_7_of_12 -->
		</header> <!-- /#masthead.site-header.row -->

	</div> <!-- /#headercontainer -->

	<div id="maincontentcontainer">
		<?php	do_action( 'mas_before_woocommerce' ); ?>
