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
	<script src="https://kit.fontawesome.com/3f4a1105a8.js" crossorigin="anonymous"></script>

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
				<button id="megamenu-toggle" onclick="document.getElementById('site-navigation').classList.toggle('megamenu-hide'); document.querySelector('body').classList.toggle('megamenu-freeze');">
					<svg xmlns="http://www.w3.org/2000/svg" width="64" height="35" viewBox="0 0 64 35">
					  <g id="Group_109" data-name="Group 109" transform="translate(16570 7372)">
					    <line id="Line_1" data-name="Line 1" x2="59" transform="translate(-16567.5 -7369.5)" fill="none" stroke="#e66c24" stroke-linecap="round" stroke-width="5"/>
					    <line id="Line_2" data-name="Line 2" x2="47" transform="translate(-16555.5 -7354.5)" fill="none" stroke="#e66c24" stroke-linecap="round" stroke-width="5"/>
					    <line id="Line_3" data-name="Line 3" x2="35" transform="translate(-16543.5 -7339.5)" fill="none" stroke="#e66c24" stroke-linecap="round" stroke-width="5"/>
					  </g>
					</svg>
				</button>
				<nav id="site-navigation" class="main-navigation megamenu-hide" role="navigation">
					<div id="nav-header" class="row">
						<div class="nav-logo col grid_5_of_12">
							<svg xmlns="http://www.w3.org/2000/svg" width="181.362" height="86.206" viewBox="0 0 181.362 86.206">
							  <g id="Group_358" data-name="Group 358" transform="translate(-183.095 -53.85)">
							    <path id="Path_582" data-name="Path 582" d="M266.921,92.3H272l.335,4.357c1.118-3.185,3.3-4.8,5.754-4.8,3.688,0,5.7,2.682,5.7,6.7v20.557h-5.866V99.338c0-1.62-.949-2.682-2.289-2.682-1.788,0-2.849,2.291-2.849,3.686v18.77h-5.866V92.3Z" transform="translate(26.848 12.172)" fill="#fff"/>
							    <path id="Path_583" data-name="Path 583" d="M254.157,93.906h3.3V89.214l5.643-1.508v6.2h4.9v4.8h-4.9v14.839c.013,5.741,1.267,5.661,2.716,6.892h-6.056c-1.027-.438-2.581-1.875-2.581-6.892V98.711h-3.017v-4.8Z" transform="translate(22.76 10.844)" fill="#fff"/>
							    <path id="Path_584" data-name="Path 584" d="M209.462,88.642H203.6V68.755c0-1.452-.726-2.458-2.012-2.458-1.675,0-2.346,2.291-2.346,3.743v18.6h-5.921v-20c0-1.452-.726-2.457-1.9-2.457-1.732,0-2.458,2.234-2.458,3.686v18.77H183.1V61.827h5.084l.5,4.246c.949-3.128,2.792-4.692,5.251-4.692s4.078,1.732,4.8,4.469c1-3.129,2.9-4.469,5.362-4.469,3.408,0,5.363,2.569,5.363,6.76v20.5Z" transform="translate(0 2.412)" fill="#fff"/>
							    <path id="Path_585" data-name="Path 585" d="M241.976,91.054h-5.866V53.85h5.866v37.2Z" transform="translate(16.98)" fill="#fff"/>
							    <path id="Path_586" data-name="Path 586" d="M242.973,92.283h4.972l.391,4.58c1.062-4.022,3.464-5.474,6.76-4.8v6.089c-4.169-1.234-6.257.951-6.257,3.352v17.6h-5.866V92.283Z" transform="translate(19.178 12.188)" fill="#fff"/>
							    <path id="Path_587" data-name="Path 587" d="M276.422,88.642h-5.866V68.867c0-1.62-.949-2.682-2.291-2.682-1.788,0-2.849,2.289-2.849,3.686v18.77h-5.865V61.827h5.083l.335,4.358c1.117-3.185,3.3-4.8,5.754-4.8,3.686,0,5.7,2.681,5.7,6.7V88.642Z" transform="translate(24.488 2.412)" fill="#fff"/>
							    <path id="Path_588" data-name="Path 588" d="M281.016,68.364c0,1.732,1.174,2.792,4.022,4.469,3.52,1.9,6.257,4.134,6.257,8.658,0,3.911-2.569,7.6-7.932,7.6-5.251,0-8.157-3.183-8.157-7.82V79.984h5.1l-.073,1.452c0,2.178,1.117,3.072,2.9,3.072s2.792-.783,2.792-2.514c0-2.4-1.731-3.352-5.083-5.418-3.185-1.732-5.308-3.966-5.308-7.709,0-4.637,3.3-7.486,7.821-7.486,4.972,0,7.709,3.128,7.709,7.6v1.006h-4.86V68.643c0-1.563-.894-2.514-2.737-2.514-1.62,0-2.458.783-2.458,2.235Z" transform="translate(29.501 2.412)" fill="#fff"/>
							    <path id="Path_589" data-name="Path 589" d="M301.589,75.636l5.754,15.418h-5.809l-3.688-10.837-2.122,4.134v6.7H289.8V53.85h5.922V76.586l5.306-12.4h5.754l-5.2,11.452Z" transform="translate(34.177)" fill="#fff"/>
							    <path id="Path_590" data-name="Path 590" d="M310.578,92.059v6.089c-4.637-.669-6.257.951-6.257,3.352v17.6h-5.865V92.283h4.971l.392,4.58c1.06-4.022,3.463-5.474,6.759-4.8Z" transform="translate(36.948 12.188)" fill="#fff"/>
							    <path id="Path_591" data-name="Path 591" d="M307.259,97.558h-3V93h2.549c2.123,0,2.571-.726,3.017-2.626l.448-2.291-6.257-26.367h5.7l2.514,13.24.837,5.2.783-5.2,2.457-13.24h5.531l-6.48,27.653c-1.229,5.083-2.569,8.186-8.1,8.186Z" transform="translate(38.73 2.52)" fill="#fff"/>
							    <path id="Path_592" data-name="Path 592" d="M290.957,91.852c4.917,0,7.989,3.463,7.989,8.491v5.921h-10.5v5.754c0,1.677.894,2.794,2.569,2.794,1.844,0,2.626-1.117,2.626-2.794v-2.625h5.308v1.731c0,5.084-3.072,8.435-7.989,8.435-4.86,0-8.212-3.408-8.212-8.491V100.343c0-5.028,3.352-8.491,8.212-8.491Zm-2.514,11.62h5.083V99.45c0-1.732-.894-2.849-2.514-2.849s-2.569,1.117-2.569,2.849v4.022Z" transform="translate(31.916 12.172)" fill="#fff"/>
							    <path id="Path_593" data-name="Path 593" d="M261.166,89.088h-1.4a4.068,4.068,0,0,1-4.357-3.408,6.544,6.544,0,0,1-5.977,3.408c-3.52,0-6.089-2.514-6.089-6.871v-.782c0-5.418,4.525-7.486,10.781-9.051V68.532a2.079,2.079,0,0,0-2.291-2.346c-1.62,0-2.178.837-2.178,2.457V70.6H244.3V68.922c0-4.3,2.458-7.541,7.821-7.541s7.709,3.463,7.709,8.155V83.5c0,.894.673,1.341,1.624,1.4l-.284,4.189Zm-7.038-7.206V76.073c-3.52.782-5.2,2.123-5.2,4.58v1.509a2.222,2.222,0,0,0,2.234,2.514,2.842,2.842,0,0,0,2.961-2.794Z" transform="translate(19.297 2.412)" fill="#fff"/>
							    <path id="Path_594" data-name="Path 594" d="M221.806,91.852a5.875,5.875,0,0,0-5.587,3.52l-.335-3.072h-4.525v35.584h5.866V116.935a6.025,6.025,0,0,0,5.2,2.625c3.128,0,5.642-3.072,5.642-6.926V99.226C228.062,94.924,225.828,91.852,221.806,91.852Zm.5,19.664c0,2.066-.949,3.183-2.514,3.183s-2.569-1.228-2.569-3.016V99.617c0-1.954,1.174-3.016,2.569-3.016,1.565,0,2.514,1.062,2.514,3.183Z" transform="translate(9.052 12.172)" fill="#fff"/>
							    <path id="Path_595" data-name="Path 595" d="M231.819,68.364c0,1.732,1.172,2.792,4.022,4.469,3.52,1.9,6.257,4.134,6.257,8.658,0,3.911-2.569,7.6-7.932,7.6-5.251,0-8.157-3.183-8.157-7.82V79.984h5.127l-.1,1.452c0,2.178,1.118,3.072,2.906,3.072s2.792-.783,2.792-2.514c0-2.4-1.731-3.352-5.083-5.418-3.185-1.732-5.308-3.966-5.308-7.709,0-4.637,3.3-7.486,7.821-7.486,4.972,0,7.709,3.128,7.709,7.6v1.006h-4.86V68.643c0-1.563-.894-2.514-2.737-2.514-1.62,0-2.458.783-2.458,2.235Zm-8.268,20.724h-1.4a4.068,4.068,0,0,1-4.357-3.408,6.544,6.544,0,0,1-5.977,3.408c-3.52,0-6.089-2.514-6.089-6.871v-.782c0-5.418,4.525-7.486,10.781-9.051V68.532a2.079,2.079,0,0,0-2.291-2.346c-1.62,0-2.178.837-2.178,2.457V70.6h-5.363V68.922c0-4.3,2.458-7.541,7.821-7.541s7.709,3.463,7.709,8.155V83.5c0,.894.675,1.341,1.625,1.4l-.285,4.189Zm-7.038-7.206V76.073c-3.52.782-5.2,2.123-5.2,4.58v1.509a2.222,2.222,0,0,0,2.234,2.514,2.842,2.842,0,0,0,2.961-2.794Z" transform="translate(7.25 2.412)" fill="#fff"/>
							    <path id="Path_596" data-name="Path 596" d="M226.557,111.907c0-5.418,4.525-7.486,10.781-9.051V99a2.079,2.079,0,0,0-2.291-2.346c-1.62,0-2.178.838-2.178,2.458v1.955h-5.363V99.393c0-4.3,2.458-7.541,7.821-7.541s7.709,3.463,7.709,8.157v13.965c0,.894.672,1.341,1.621,1.4l-.281,4.189h-1.4a4.068,4.068,0,0,1-4.357-3.408,6.544,6.544,0,0,1-5.977,3.408c-3.52,0-6.089-2.514-6.089-6.871v-.782Zm5.586-.783v1.509a2.222,2.222,0,0,0,2.234,2.514,2.842,2.842,0,0,0,2.961-2.794v-5.809c-3.52.782-5.2,2.123-5.2,4.58Z" transform="translate(13.92 12.172)" fill="#fff"/>
							    <line id="Line_10" data-name="Line 10" y2="23.584" transform="translate(196.558 106.238)" fill="#f15d12" stroke="#fff" stroke-linecap="round" stroke-width="3.003"/>
							    <line id="Line_11" data-name="Line 11" x1="23.584" transform="translate(184.909 117.842)" fill="#f15d12" stroke="#fff" stroke-linecap="round" stroke-width="3.003"/>
							    <path id="Path_597" data-name="Path 597" d="M314.086,98.95c0,1.732,1.174,2.794,4.022,4.469,3.52,1.9,6.257,4.134,6.257,8.658,0,3.911-2.569,7.6-7.932,7.6-5.251,0-8.157-3.185-8.157-7.821V110.57h5.1l-.073,1.452c0,2.178,1.117,3.072,2.9,3.072s2.792-.782,2.792-2.514c0-2.4-1.731-3.352-5.083-5.418-3.185-1.732-5.308-3.966-5.308-7.709,0-4.637,3.3-7.486,7.821-7.486,4.972,0,7.709,3.129,7.709,7.6v1h-4.86V99.23c0-1.565-.894-2.514-2.737-2.514-1.62,0-2.458.782-2.458,2.234Z" transform="translate(40.093 12.208)" fill="#fff"/>
							  </g>
							</svg>
						</div>
						<div class="nav-icon col grid_7_of_12">
							<button onclick="document.getElementById('site-navigation').classList.toggle('megamenu-hide'); document.querySelector('body').classList.toggle('megamenu-freeze');">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="38.008" height="38.008" viewBox="0 0 38.008 38.008">
							  <defs>
							    <clipPath id="clip-path">
							      <rect id="Rectangle_16" data-name="Rectangle 16" width="49.503" height="4.248" transform="translate(1212 36.001)" fill="#fff" stroke="#fff" stroke-width="8"/>
							    </clipPath>
							    <clipPath id="clip-path-2">
							      <rect id="Rectangle_15" data-name="Rectangle 15" width="1440" height="211" fill="#fff" stroke="#fff" stroke-width="8"/>
							    </clipPath>
							    <clipPath id="clip-path-3">
							      <rect id="Rectangle_14" data-name="Rectangle 14" width="51" height="6" transform="translate(1211 35)" fill="#fff" stroke="#fff" stroke-width="8"/>
							    </clipPath>
							    <clipPath id="clip-path-4">
							      <path id="Path_4" data-name="Path 4" d="M1261.5,38.124A2.155,2.155,0,0,0,1259.325,36h-45.147a2.126,2.126,0,1,0,0,4.25h45.147a2.154,2.154,0,0,0,2.178-2.125" fill="#fff" stroke="#fff" stroke-width="8" clip-rule="evenodd"/>
							    </clipPath>
							    <clipPath id="clip-path-5">
							      <rect id="Rectangle_13" data-name="Rectangle 13" width="50" height="5" transform="translate(1212 36)" fill="#fff" stroke="#fff" stroke-width="8"/>
							    </clipPath>
							  </defs>
							  <g id="Group_105" data-name="Group 105" transform="translate(-6119.747 -854.12)">
							    <g id="Group_103" data-name="Group 103" transform="translate(6353.268 -700.101) rotate(45)">
							      <g id="Group_47" data-name="Group 47" transform="translate(-276 1225.999)">
							        <g id="Group_33" data-name="Group 33">
							          <g id="Group_32" data-name="Group 32" clip-path="url(#clip-path)">
							            <g id="Group_31" data-name="Group 31">
							              <g id="Group_30" data-name="Group 30" clip-path="url(#clip-path-2)">
							                <g id="Group_29" data-name="Group 29" style="isolation: isolate">
							                  <g id="Group_28" data-name="Group 28">
							                    <g id="Group_27" data-name="Group 27" clip-path="url(#clip-path-3)">
							                      <g id="Group_26" data-name="Group 26">
							                        <g id="Group_25" data-name="Group 25" clip-path="url(#clip-path-4)">
							                          <g id="Group_24" data-name="Group 24">
							                            <g id="Group_23" data-name="Group 23" clip-path="url(#clip-path-5)">
							                              <rect id="Rectangle_12" data-name="Rectangle 12" width="59.503" height="14.25" transform="translate(1207 30.999)" fill="#fff" stroke="#fff" stroke-width="8"/>
							                            </g>
							                          </g>
							                        </g>
							                      </g>
							                    </g>
							                  </g>
							                </g>
							              </g>
							            </g>
							          </g>
							        </g>
							      </g>
							    </g>
							    <g id="Group_104" data-name="Group 104" transform="translate(7711.976 1087.641) rotate(135)">
							      <g id="Group_47-2" data-name="Group 47" transform="translate(-276 1225.999)">
							        <g id="Group_33-2" data-name="Group 33">
							          <g id="Group_32-2" data-name="Group 32" clip-path="url(#clip-path)">
							            <g id="Group_31-2" data-name="Group 31">
							              <g id="Group_30-2" data-name="Group 30" clip-path="url(#clip-path-2)">
							                <g id="Group_29-2" data-name="Group 29" style="isolation: isolate">
							                  <g id="Group_28-2" data-name="Group 28">
							                    <g id="Group_27-2" data-name="Group 27" clip-path="url(#clip-path-3)">
							                      <g id="Group_26-2" data-name="Group 26">
							                        <g id="Group_25-2" data-name="Group 25" clip-path="url(#clip-path-4)">
							                          <g id="Group_24-2" data-name="Group 24">
							                            <g id="Group_23-2" data-name="Group 23" clip-path="url(#clip-path-5)">
							                              <rect id="Rectangle_12-2" data-name="Rectangle 12" width="59.503" height="14.25" transform="translate(1207 30.999)" fill="#fff" stroke="#fff" stroke-width="8"/>
							                            </g>
							                          </g>
							                        </g>
							                      </g>
							                    </g>
							                  </g>
							                </g>
							              </g>
							            </g>
							          </g>
							        </g>
							      </g>
							    </g>
							  </g>
								</svg>
							</button>
						</div>
					</div>
					<div id="nav-menu" class="row">
						<h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'mas' ); ?></h3>
						<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mas' ); ?>"><?php esc_html_e( 'Skip to content', 'mas' ); ?></a></div>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					</div>
				</nav> <!-- /.site-navigation.main-navigation -->
			</div> <!-- /.col.grid_7_of_12 -->
		</header> <!-- /#masthead.site-header.row -->

	</div> <!-- /#headercontainer -->

	<div id="maincontentcontainer">
		<?php	do_action( 'mas_before_woocommerce' ); ?>
