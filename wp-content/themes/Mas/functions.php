<?php
/**
 * Mas functions and definitions
 *
 * @package Mas
 * @since Mas 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Mas 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 790; /* Default the embedded content width to 790px */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Mas 1.0
 *
 * @return void
 */
if ( ! function_exists( 'mas_setup' ) ) {
	function mas_setup() {
		global $content_width;

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on mas, use a find and replace
		 * to change 'mas' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'mas', trailingslashit( get_template_directory() ) . 'languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Create an extra image size for the Post featured image
		add_image_size( 'post_feature_full_width', 792, 300, true );

		// This theme uses wp_nav_menu() in one location
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'mas' ),
				'secondary' => esc_html__( 'Secondary Menu', 'mas' ),
				'social' => esc_html__( 'Social Menu', 'mas' )
			) );

		// This theme supports a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Add theme support for HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Enable support for Custom Backgrounds
		add_theme_support( 'custom-background', array(
				// Background color default
				'default-color' => 'fff'
			) );

		// Enable support for Custom Headers (or in our case, a custom logo)
		add_theme_support( 'custom-header', array(
				// Header image default
				'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
				// Header text display default
				'header-text' => false,
				// Header text color default
				'default-text-color' => '000',
				// Flexible width
				'flex-width' => true,
				// Header image width (in pixels)
				'width' => 300,
				// Flexible height
				'flex-height' => true,
				// Header image height (in pixels)
				'height' => 80
			) );

		//enable support for custom logos
		add_theme_support('custom-logo');
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for WooCommerce & WooCommerce product galleries
		add_theme_support( 'woocommerce', array(
			'product_grid' => array(
				'default_rows' => 3,
				'default_columns' => 4,
			),
		) );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Enable support for Theme Options.
		// Rather than reinvent the wheel, we're using the Options Framework by Devin Price, so huge props to him!
		// http://wptheming.com/options-framework-theme/
		if ( !function_exists( 'optionsframework_init' ) ) {
			define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'inc/' );
			require_once trailingslashit( dirname( __FILE__ ) ) . 'inc/options-framework.php';

			// Loads options.php from child or parent theme
			$optionsfile = locate_template( 'options.php' );
			load_template( $optionsfile );
		}

		// If WooCommerce is running, check if we should be displaying the Breadcrumbs
		if( mas_is_woocommerce_active() && !of_get_option( 'woocommerce_breadcrumbs', '1' ) ) {
			add_action( 'init', 'mas_remove_woocommerce_breadcrumbs' );
		}
	}
}
add_action( 'after_setup_theme', 'mas_setup' );


/**
 * Enable backwards compatability for title-tag support
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function mas_slug_render_title() { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }
	add_action( 'wp_head', 'mas_slug_render_title' );
}


/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of PT Sans and Arvo by default is localized. For languages that use characters not supported by the fonts, the fonts can be disabled.
 *
 * @since mas 1.2.5
 *
 * @return string Font stylesheet or empty string if disabled.
 */
if ( ! function_exists( 'mas_fonts_url' ) ) {
	function mas_fonts_url() {
		$fonts_url = '';
		$subsets = 'latin';

		/* translators: If there are characters in your language that are not supported by PT Sans, translate this to 'off'.
		 * Do not translate into your own language.
		 */
		$pt_sans = _x( 'on', 'PT Sans font: on or off', 'mas' );

		/* translators: To add an additional PT Sans character subset specific to your language, translate this to 'greek', 'cyrillic' or 'vietnamese'.
		 * Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'PT Sans font: add new subset (cyrillic)', 'mas' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic';

		/* translators: If there are characters in your language that are not supported by Arvo, translate this to 'off'.
		 * Do not translate into your own language.
		 */
		$arvo = _x( 'on', 'Arvo font: on or off', 'mas' );

		if ( 'off' !== $pt_sans || 'off' !== $arvo ) {
			$font_families = array();

			if ( 'off' !== $pt_sans )
				$font_families[] = 'PT+Sans:400,400italic,700,700italic';

			if ( 'off' !== $arvo )
				$font_families[] = 'Arvo:400';

			$protocol = is_ssl() ? 'https' : 'http';
			$query_args = array(
				'family' => implode( '|', $font_families ),
				'subset' => $subsets,
			);
			$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
		}

		return $fonts_url;
	}
}

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @since mas 1.2.5
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function mas_mce_css( $mce_css ) {
	$fonts_url = mas_fonts_url();

	if ( empty( $fonts_url ) ) {
		return $mce_css;
	}

	if ( !empty( $mce_css ) ) {
		$mce_css .= ',';
	}

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'mas_mce_css' );


/**
 * Register widgetized areas
 *
 * @since mas 1.0
 *
 * @return void
 */
if ( ! function_exists( 'mas_widgets_init' ) ) {
	function mas_widgets_init() {
		register_sidebar( array(
				'name' => esc_html__( 'Main Sidebar', 'mas' ),
				'id' => 'sidebar-main',
				'description' => esc_html__( 'Appears in the sidebar on posts and pages except the optional Front Page template, which has its own widgets', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Blog Sidebar', 'mas' ),
				'id' => 'sidebar-blog',
				'description' => esc_html__( 'Appears in the sidebar on the blog and archive pages only', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Single Post Sidebar', 'mas' ),
				'id' => 'sidebar-single',
				'description' => esc_html__( 'Appears in the sidebar on single posts only', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Page Sidebar', 'mas' ),
				'id' => 'sidebar-page',
				'description' => esc_html__( 'Appears in the sidebar on pages only', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		// register_sidebar( array(
		// 		'name' => esc_html__( 'First Front Page Banner Widget', 'mas' ),
		// 		'id' => 'frontpage-banner1',
		// 		'description' => esc_html__( 'Appears in the banner area on the Front Page', 'mas' ),
		// 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		// 		'after_widget' => '</div>',
		// 		'before_title' => '<h1 class="widget-title">',
		// 		'after_title' => '</h1>'
		// 	) );
		//
		// register_sidebar( array(
		// 		'name' => esc_html__( 'Second Front Page Banner Widget', 'mas' ),
		// 		'id' => 'frontpage-banner2',
		// 		'description' => esc_html__( 'Appears in the banner area on the Front Page', 'mas' ),
		// 		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		// 		'after_widget' => '</div>',
		// 		'before_title' => '<h1 class="widget-title">',
		// 		'after_title' => '</h1>'
		// 	) );

		register_sidebar( array(
				'name' => esc_html__( 'First Front Page Widget Area', 'mas' ),
				'id' => 'sidebar-homepage1',
				'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Second Front Page Widget Area', 'mas' ),
				'id' => 'sidebar-homepage2',
				'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Third Front Page Widget Area', 'mas' ),
				'id' => 'sidebar-homepage3',
				'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Fourth Front Page Widget Area', 'mas' ),
				'id' => 'sidebar-homepage4',
				'description' => esc_html__( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'First Footer Widget Area', 'mas' ),
				'id' => 'sidebar-footer1',
				'description' => esc_html__( 'Appears in the footer sidebar', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Firstb Footer Widget Area', 'mas' ),
				'id' => 'sidebar-footer1b',
				'description' => esc_html__( 'Appears in the footer sidebar', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Second Footer Widget Area', 'mas' ),
				'id' => 'sidebar-footer2',
				'description' => esc_html__( 'Appears in the footer sidebar', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Secondb Footer Widget Area', 'mas' ),
				'id' => 'sidebar-footer2b',
				'description' => esc_html__( 'Appears in the footer sidebar', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Third Footer Widget Area', 'mas' ),
				'id' => 'sidebar-footer3',
				'description' => esc_html__( 'Appears in the footer sidebar', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );

		register_sidebar( array(
				'name' => esc_html__( 'Fourth Footer Widget Area', 'mas' ),
				'id' => 'sidebar-footer4',
				'description' => esc_html__( 'Appears in the footer sidebar', 'mas' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>'
			) );
	}
}
add_action( 'widgets_init', 'mas_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since mas 1.0
 *
 * @return void
 */
if ( ! function_exists( 'mas_scripts_styles' ) ) {
	function mas_scripts_styles() {

		/**
		 * Register and enqueue our stylesheets
		 */

		// Start off with a clean base by using normalise. If you prefer to use a reset stylesheet or something else, simply replace this
		wp_register_style( 'normalize', trailingslashit( get_template_directory_uri() ) . 'css/normalize.css' , array(), '4.1.1', 'all' );
		wp_enqueue_style( 'normalize' );

		// Register and enqueue our icon font
		// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
		wp_register_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' , array( 'normalize' ), '4.6.3', 'all' );
		wp_enqueue_style( 'fontawesome' );

		// Our styles for setting up the grid.
		// If you prefer to use a different grid system, simply replace this and perform a find/replace in the php for the relevant styles. I'm nice like that!
		wp_register_style( 'gridsystem', trailingslashit( get_template_directory_uri() ) . 'css/grid.css' , array( 'fontawesome' ), '1.0.0', 'all' );
		wp_enqueue_style( 'gridsystem' );

		// Font styles.
		wp_register_style( 'fonts', trailingslashit( get_template_directory_uri() ) . 'css/fonts.css');
		wp_enqueue_style( 'fonts' );

		// typography & sizing styles.
		wp_register_style( 'type', trailingslashit( get_template_directory_uri() ) . 'css/type.css');
		wp_enqueue_style( 'type' );

		// page layout styles.
		wp_register_style( 'layout', trailingslashit( get_template_directory_uri() ) . 'css/layout.css');
		wp_enqueue_style( 'layout' );

		// mega-menu styles.
		wp_register_style( 'mega-menu', trailingslashit( get_template_directory_uri() ) . 'css/mega-menu.css');
		wp_enqueue_style( 'mega-menu' );

		/*
		 * Load our Google Fonts.
		 *
		 * To disable in a child theme, use wp_dequeue_style()
		 * function mytheme_dequeue_fonts() {
		 *     wp_dequeue_style( 'mas-fonts' );
		 * }
		 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
		 */
		$fonts_url = mas_fonts_url();
		if ( !empty( $fonts_url ) ) {
			wp_enqueue_style( 'mas-fonts', esc_url_raw( $fonts_url ), array(), null );
		}

		// If using a child theme, auto-load the parent theme style.
		// Props to Justin Tadlock for this recommendation - http://justintadlock.com/archives/2014/11/03/loading-parent-styles-for-child-themes
		if ( is_child_theme() ) {
			wp_enqueue_style( 'parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
		}

		// Enqueue the default WordPress stylesheet
		wp_enqueue_style( 'style', get_stylesheet_uri() );


		/**
		 * Register and enqueue our scripts
		 */

		// Load Modernizr at the top of the document, which enables HTML5 elements and feature detects
		wp_register_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'js/modernizr-min.js', array(), '3.5.0', false );
		wp_enqueue_script( 'modernizr' );

		// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Load jQuery Validation as well as the initialiser to provide client side comment form validation
		// You can change the validation error messages below
		if ( is_singular() && comments_open() ) {
			wp_register_script( 'validate', trailingslashit( get_template_directory_uri() ) . 'js/jquery.validate.min.js', array( 'jquery' ), '1.17.0', true );
			wp_register_script( 'commentvalidate', trailingslashit( get_template_directory_uri() ) . 'js/comment-form-validation.js', array( 'jquery', 'validate' ), '1.17.0', true );

			wp_enqueue_script( 'commentvalidate' );
			wp_localize_script( 'commentvalidate', 'comments_object', array(
				'req' => get_option( 'require_name_email' ),
				'author'  => esc_html__( 'Please enter your name', 'mas' ),
				'email'  => esc_html__( 'Please enter a valid email address', 'mas' ),
				'comment' => esc_html__( 'Please add a comment', 'mas' ) )
			);
		}

		wp_enqueue_script( 'header-slider', get_template_directory_uri() . '/js/header-slider.js', array ( 'jquery' ), 1.1, true);


		// Include this script to envoke a button toggle for the main navigation menu on small screens
		//wp_register_script( 'small-menu', trailingslashit( get_template_directory_uri() ) . 'js/small-menu.js', array( 'jquery' ), '20130130', true );
		//wp_enqueue_script( 'small-menu' );

	}
}
add_action( 'wp_enqueue_scripts', 'mas_scripts_styles' );

/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since mas 1.0
 *
 * @param string html ID
 * @return void
 */
if ( ! function_exists( 'mas_content_nav' ) ) {
	function mas_content_nav( $nav_id ) {
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() ) {
			$nav_class = 'site-navigation post-navigation nav-single';
		}
		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'mas' ); ?></h3>

			<?php if ( is_single() ) { // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-angle-left" aria-hidden="true"></i>', 'Previous post link', 'mas' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<i class="fa fa-angle-right" aria-hidden="true"></i>', 'Next post link', 'mas' ) . '</span>' ); ?>

			<?php }
			elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>

				<?php echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => wp_kses( __( '<i class="fa fa-angle-left" aria-hidden="true"></i> Previous', 'mas' ), array( 'i' => array(
						'class' => array(), 'aria-hidden' => array() ) ) ),
					'next_text' => wp_kses( __( 'Next <i class="fa fa-angle-right" aria-hidden="true"></i>', 'mas' ), array( 'i' => array(
						'class' => array(), 'aria-hidden' => array() ) ) )
				) ); ?>

			<?php } ?>

		</nav><!-- #<?php echo $nav_id; ?> -->
		<?php
	}
}


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own mas_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * (Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot)
 *
 * @since mas 1.0
 *
 * @param array Comment
 * @param array Arguments
 * @param integer Comment depth
 * @return void
 */
if ( ! function_exists( 'mas_comment' ) ) {
	function mas_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'mas' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'mas' ), '<span class="edit-link">', '</span>' ); ?></p>
				</article> <!-- #comment-##.pingback -->
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'mas' ) . '</span>' : '' );
						printf( '<a href="%1$s" title="Posted %2$s"><time itemprop="datePublished" datetime="%3$s">%4$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							sprintf( esc_html__( '%1$s @ %2$s', 'mas' ), esc_html( get_comment_date() ), esc_attr( get_comment_time() ) ),
							get_comment_time( 'c' ),
							/* Translators: 1: date, 2: time */
							sprintf( esc_html__( '%1$s at %2$s', 'mas' ), get_comment_date(), get_comment_time() )
						);
						?>
					</header> <!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) { ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'mas' ); ?></p>
					<?php } ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'mas' ), '<p class="edit-link">', '</p>' ); ?>
					</section> <!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses( __( 'Reply <span>&darr;</span>', 'mas' ), array( 'span' => array() ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article> <!-- #comment-## -->
			<?php
			break;
		} // end comment_type check
	}
}


/**
 * Update the Comments form so that the 'required' span is contained within the form label.
 *
 * @since mas 1.0
 *
 * @param string Comment form fields html
 * @return string The updated comment form fields html
 */
if ( ! function_exists( 'mas_comment_form_default_fields' ) ) {
	function mas_comment_form_default_fields( $fields ) {

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : "" );

		$fields[ 'author' ] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'mas' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields[ 'email' ] =  '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'mas' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields[ 'url' ] =  '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'mas' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

		return $fields;

	}
}
add_action( 'comment_form_default_fields', 'mas_comment_form_default_fields' );


/**
 * Update the Comments form to add a 'required' span to the Comment textarea within the form label, because it's pointless
 * submitting a comment that doesn't actually have any text in the comment field!
 *
 * @since mas 1.0
 *
 * @param string Comment form textarea html
 * @return string The updated comment form textarea html
 */
if ( ! function_exists( 'mas_comment_form_field_comment' ) ) {
	function mas_comment_form_field_comment( $field ) {
		if ( !mas_is_woocommerce_active() || ( mas_is_woocommerce_active() && !is_product() ) ) {
			$field = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'mas' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
		}
		return $field;

	}
}
add_action( 'comment_form_field_comment', 'mas_comment_form_field_comment' );


/**
 * Prints HTML with meta information for current post: author and date
 *
 * @since mas 1.0
 *
 * @return void
 */
if ( ! function_exists( 'mas_posted_on' ) ) {
	function mas_posted_on() {
		$post_icon = '';
		// switch ( get_post_format() ) {
		// 	case 'aside':
		// 		$post_icon = 'fa-file-o';
		// 		break;
		// 	case 'audio':
		// 		$post_icon = 'fa-volume-up';
		// 		break;
		// 	case 'chat':
		// 		$post_icon = 'fa-comment';
		// 		break;
		// 	case 'gallery':
		// 		$post_icon = 'fa-camera';
		// 		break;
		// 	case 'image':
		// 		$post_icon = 'fa-picture-o';
		// 		break;
		// 	case 'link':
		// 		$post_icon = 'fa-link';
		// 		break;
		// 	case 'quote':
		// 		$post_icon = 'fa-quote-left';
		// 		break;
		// 	case 'status':
		// 		$post_icon = 'fa-user';
		// 		break;
		// 	case 'video':
		// 		$post_icon = 'fa-video-camera';
		// 		break;
		// 	default:
		// 		$post_icon = 'fa-calendar';
		// 		break;
		// }

		// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
		// $date = sprintf( '<i class="fa %1$s" aria-hidden="true"></i> <a href="%2$s" title="Posted %3$s" rel="bookmark"><time class="entry-date" datetime="%4$s" itemprop="datePublished">%5$s</time></a>',
		// 	$post_icon,
		// 	esc_url( get_permalink() ),
		// 	sprintf( esc_html__( '%1$s @ %2$s', 'mas' ), esc_html( get_the_date() ), esc_attr( get_the_time() ) ),
		// 	esc_attr( get_the_date( 'c' ) ),
		// 	esc_html( get_the_date() )
		// );
		// $date =

		echo "<div id='post_date'><span class='type_xs color_l3 mas-graphik-light font-lighter'>".esc_html( get_the_date() )."</span></div>";

		// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
		// $author = sprintf( '<i class="fa fa-pencil" aria-hidden="true"></i> <address class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></address>',
		// 	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		// 	esc_attr( sprintf( esc_html__( 'View all posts by %s', 'mas' ), get_the_author() ) ),
		// 	get_the_author()
		// );

		// Return the Categories as a list
		// $categories_list = get_the_category_list( esc_html__( ' ', 'mas' ) );

		// Translators: 1: Permalink 2: Title 3: No. of Comments
		// $comments = sprintf( '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> <a href="%1$s" title="%2$s">%3$s</a></span>',
		// 	esc_url( get_comments_link() ),
		// 	esc_attr( esc_html__( 'Comment on ' , 'mas' ) . the_title_attribute( 'echo=0' ) ),
		// 	( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'mas' ), get_comments_number() ) : esc_html__( 'No Comments', 'mas' ) )
		// );

		// Translators: 1: Date 2: Author 3: Categories 4: Comments
		// echo $date;
		// printf( wp_kses( __( '<div class="header-meta">%1$s%2$s<span class="post-categories">%3$s</span>%4$s</div>', 'mas' ), array(
		// 	'div' => array (
		// 		'class' => array() ),
		// 	'span' => array(
		// 		'class' => array() ) ) ),
		// 	$date
		// 	// $author,
		// 	// $categories_list,
		// 	// ( is_search() ? '' : $comments )
		// );
	}
}


/**
 * Prints HTML with meta information for current post: categories, tags, permalink
 *
 * @since mas 1.0
 *
 * @return void
 */
if ( ! function_exists( 'mas_entry_meta' ) ) {
	function mas_entry_meta() {
		// Return the Tags as a list
		$tag_list = "";
		if ( get_the_tag_list() ) {
			$tag_list = get_the_tag_list( '<span class="post-tags">', esc_html__( ' ', 'mas' ), '</span>' );
		}

		// Translators: 1 is tag
		if ( $tag_list ) {
			printf( wp_kses( __( '<i class="fa fa-tag" aria-hidden="true"></i> %1$s', 'mas' ), array( 'i' => array( 'class' => array() ) ) ), $tag_list );
		}
	}
}


/**
 * Adjusts content_width value for full-width templates and attachments
 *
 * @since mas 1.0
 *
 * @return void
 */
if ( ! function_exists( 'mas_content_width' ) ) {
	function mas_content_width() {
		if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() ) {
			global $content_width;
			$content_width = 1200;
		}
	}
}
add_action( 'template_redirect', 'mas_content_width' );


/**
 * Change the "read more..." link so it links to the top of the page rather than part way down
 *
 * @since mas 1.0
 *
 * @param string The 'Read more' link
 * @return string The link to the post url without the more tag appended on the end
 */
function mas_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'mas_remove_more_jump_link' );


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since mas 1.0
 *
 * @return string The 'Continue reading' link
 */
if ( ! function_exists( 'mas_continue_reading_link' ) ) {
	function mas_continue_reading_link() {
		return '&hellip;<p><a class="more-link" href="'. esc_url( get_permalink() ) . '" title="' . esc_html__( 'Continue reading', 'mas' ) . ' &lsquo;' . get_the_title() . '&rsquo;">' . wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mas' ), array( 'span' => array(
				'class' => array() ) ) ) . '</a></p>';
	}
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with the mas_continue_reading_link().
 *
 * @since mas 1.0
 *
 * @param string Auto generated excerpt
 * @return string The filtered excerpt
 */
if ( ! function_exists( 'mas_auto_excerpt_more' ) ) {
	function mas_auto_excerpt_more( $more ) {
		return mas_continue_reading_link();
	}
}
add_filter( 'excerpt_more', 'mas_auto_excerpt_more' );


/**
 * Extend the user contact methods to include Twitter, Facebook and Google+
 *
 * @since mas 1.0
 *
 * @param array List of user contact methods
 * @return array The filtered list of updated user contact methods
 */
if ( ! function_exists( 'mas_new_contactmethods' ) ) {
	function mas_new_contactmethods( $contactmethods ) {
		// Add Twitter
		$contactmethods['twitter'] = 'Twitter';

		//add Facebook
		$contactmethods['facebook'] = 'Facebook';

		//add Google Plus
		$contactmethods['googleplus'] = 'Google+';

		return $contactmethods;
	}
}
add_filter( 'user_contactmethods', 'mas_new_contactmethods', 10, 1 );


/**
 * Add Filter to allow Shortcodes to work in the Sidebar
 *
 * @since mas 1.0
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Theme Options
 *
 * @since mas 1.0
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'mas_get_social_media' ) ) {
	function mas_get_social_media() {
		$output = '';
		$icons = array(
			array( 'url' => of_get_option( 'social_twitter', '' ), 'icon' => 'fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'mas' ) ),
			array( 'url' => of_get_option( 'social_facebook', '' ), 'icon' => 'fa-facebook', 'title' => esc_html__( 'Friend me on Facebook', 'mas' ) ),
			array( 'url' => of_get_option( 'social_googleplus', '' ), 'icon' => 'fa-google-plus', 'title' => esc_html__( 'Connect with me on Google+', 'mas' ) ),
			array( 'url' => of_get_option( 'social_linkedin', '' ), 'icon' => 'fa-linkedin', 'title' => esc_html__( 'Connect with me on LinkedIn', 'mas' ) ),
			array( 'url' => of_get_option( 'social_slideshare', '' ), 'icon' => 'fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'mas' ) ),
			array( 'url' => of_get_option( 'social_slack', '' ), 'icon' => 'fa-slack', 'title' => esc_html__( 'Join me on Slack', 'mas' ) ),
			array( 'url' => of_get_option( 'social_dribbble', '' ), 'icon' => 'fa-dribbble', 'title' => esc_html__( 'Follow me on Dribbble', 'mas' ) ),
			array( 'url' => of_get_option( 'social_tumblr', '' ), 'icon' => 'fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'mas' ) ),
			array( 'url' => of_get_option( 'social_reddit', '' ), 'icon' => 'fa-reddit', 'title' => esc_html__( 'Join me on Reddit', 'mas' ) ),
			array( 'url' => of_get_option( 'social_twitch', '' ), 'icon' => 'fa-twitch', 'title' => esc_html__( 'Follow me on Twitch', 'mas' ) ),
			array( 'url' => of_get_option( 'social_github', '' ), 'icon' => 'fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'mas' ) ),
			array( 'url' => of_get_option( 'social_bitbucket', '' ), 'icon' => 'fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'mas' ) ),
			array( 'url' => of_get_option( 'social_stackoverflow', '' ), 'icon' => 'fa-stack-overflow', 'title' => esc_html__( 'Join me on Stack Overflow', 'mas' ) ),
			array( 'url' => of_get_option( 'social_codepen', '' ), 'icon' => 'fa-codepen', 'title' => esc_html__( 'Follow me on CodePen', 'mas' ) ),
			array( 'url' => of_get_option( 'social_foursquare', '' ), 'icon' => 'fa-foursquare', 'title' => esc_html__( 'Follow me on Foursquare', 'mas' ) ),
			array( 'url' => of_get_option( 'social_youtube', '' ), 'icon' => 'fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'mas' ) ),
			array( 'url' => of_get_option( 'social_vimeo', '' ), 'icon' => 'fa-vimeo', 'title' => esc_html__( 'Follow me on Vimeo', 'mas' ) ),
			array( 'url' => of_get_option( 'social_instagram', '' ), 'icon' => 'fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'mas' ) ),
			array( 'url' => of_get_option( 'social_vine', '' ), 'icon' => 'fa-vine', 'title' => esc_html__( 'Follow me on Vine', 'mas' ) ),
			array( 'url' => of_get_option( 'social_snapchat', '' ), 'icon' => 'fa-snapchat', 'title' => esc_html__( 'Add me on Snapchat', 'mas' ) ),
			array( 'url' => of_get_option( 'social_flickr', '' ), 'icon' => 'fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'mas' ) ),
			array( 'url' => of_get_option( 'social_pinterest', '' ), 'icon' => 'fa-pinterest', 'title' => esc_html__( 'Follow me on Pinterest', 'mas' ) ),
			array( 'url' => of_get_option( 'social_rss', '' ), 'icon' => 'fa-rss', 'title' => esc_html__( 'Subscribe to my RSS Feed', 'mas' ) )
		);

		foreach ( $icons as $key ) {
			$value = $key['url'];
			if ( !empty( $value ) ) {
				$output .= sprintf( '<li><a href="%1$s" title="%2$s"%3$s><span class="fa-stack fa-lg"><i class="fa fa-square fa-stack-2x"></i><i class="fa %4$s fa-stack-1x fa-inverse"></i></span><span class="assistive-text">%2$s</span></a></li>',
					esc_url( $value ),
					$key['title'],
					( !of_get_option( 'social_newtab', '0' ) ? '' : ' target="_blank"' ),
					$key['icon']
				);
			}
		}

		if ( !empty( $output ) ) {
			$output = '<ul>' . $output . '</ul>';
		}

		return $output;
	}
}


/**
 * Return a string containing the footer credits & link
 *
 * @since mas 1.0
 *
 * @return string Footer credits & link
 */
if ( ! function_exists( 'mas_get_credits' ) ) {
	function mas_get_credits() {
		$output = '';
		$output = sprintf( '%1$s <a href="%2$s" title="%3$s">%4$s</a>',
			esc_html__( 'Proudly powered by', 'mas' ),
			esc_url( esc_html__( 'http://wordpress.org/', 'mas' ) ),
			esc_attr( esc_html__( 'Semantic Personal Publishing Platform', 'mas' ) ),
			esc_html__( 'WordPress', 'mas' )
		);

		return $output;
	}
}


/**
 * Outputs the selected Theme Options inline into the <head>
 *
 * @since mas 1.0
 *
 * @return void
 */
function mas_theme_options_styles() {
	$output = '';
	$imagepath =  trailingslashit( get_template_directory_uri() ) . 'images/';
	$background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	// $background = of_get_option( 'banner_background', $background_defaults );
	// if ( $background ) {
	// 	$bkgrnd_color = apply_filters( 'of_sanitize_color', $background['color'] );
	// 	$output .= "#bannercontainer { ";
	// 	$output .= "background: " . $bkgrnd_color . " url('" . esc_url( $background['image'] ) . "') " . $background['repeat'] . " " . $background['attachment'] . " " . $background['position'] . ";";
	// 	$output .= " }";
	// }

	$footerColour = apply_filters( 'of_sanitize_color', of_get_option( 'footer_color', '#222222' ) );
	if ( !empty( $footerColour ) ) {
		$output .= "\n#footercontainer { ";
		$output .= "background-color: " . $footerColour . ";";
		$output .= " }";
	}

	if ( of_get_option( 'footer_position', 'center' ) ) {
		$output .= "\n.smallprint { ";
		$output .= "text-align: " . sanitize_text_field( of_get_option( 'footer_position', 'center' ) ) . ";";
		$output .= " }";
	}

	if ( $output != '' ) {
		$output = "\n<style>\n" . $output . "\n</style>\n";
		echo $output;
	}
}
add_action( 'wp_head', 'mas_theme_options_styles' );


/**
 * Recreate the default filters on the_content
 * This will make it much easier to output the Theme Options Editor content with proper/expected formatting.
 * We don't include an add_filter for 'prepend_attachment' as it causes an image to appear in the content, on attachment pages.
 * Also, since the Theme Options editor doesn't allow you to add images anyway, no big deal.
 *
 * @since mas 1.0
 */
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars'  );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'do_shortcode' );

/**
 * Unhook the WooCommerce Wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Outputs the opening container div for WooCommerce
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_before_woocommerce_wrapper' ) ) {
	function mas_before_woocommerce_wrapper() {
		echo '<div id="primary" class="site-content row" role="main">';
	}
}


/**
 * Outputs the closing container div for WooCommerce
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_after_woocommerce_wrapper' ) ) {
	function mas_after_woocommerce_wrapper() {
		echo '</div> <!-- /#primary.site-content.row -->';
	}
}


/**
 * Check if WooCommerce is active
 *
 * @since mas 1.3
 *
 * @return void
 */
function mas_is_woocommerce_active() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}
	else {
		return false;
	}
}


/**
 * Check if WooCommerce is active and a WooCommerce template is in use and output the containing div
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_setup_woocommerce_wrappers' ) ) {
	function mas_setup_woocommerce_wrappers() {
		if ( mas_is_woocommerce_active() && is_woocommerce() ) {
				add_action( 'mas_before_woocommerce', 'mas_before_woocommerce_wrapper', 10, 0 );
				add_action( 'mas_after_woocommerce', 'mas_after_woocommerce_wrapper', 10, 0 );
		}
	}
	add_action( 'template_redirect', 'mas_setup_woocommerce_wrappers', 9 );
}


/**
 * Outputs the opening wrapper for the WooCommerce content
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_woocommerce_before_main_content' ) ) {
	function mas_woocommerce_before_main_content() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product_taxonomy() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			echo '<div class="col grid_12_of_12">';
		}
		else {
			echo '<div class="col grid_8_of_12">';
		}
	}
	add_action( 'woocommerce_before_main_content', 'mas_woocommerce_before_main_content', 10 );
}


/**
 * Outputs the closing wrapper for the WooCommerce content
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_woocommerce_after_main_content' ) ) {
	function mas_woocommerce_after_main_content() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_main_content', 'mas_woocommerce_after_main_content', 10 );
}


/**
 * Remove the sidebar from the WooCommerce templates
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_remove_woocommerce_sidebar' ) ) {
	function mas_remove_woocommerce_sidebar() {
		if( ( is_shop() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product_taxonomy() && !of_get_option( 'woocommerce_shopsidebar', '1' ) ) || ( is_product() && !of_get_option( 'woocommerce_productsidebar', '1' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
	add_action( 'woocommerce_before_main_content', 'mas_remove_woocommerce_sidebar' );
}


/**
 * Remove the breadcrumbs from the WooCommerce pages
 *
 * @since mas 1.3
 *
 * @return void
 */
if ( ! function_exists( 'mas_remove_woocommerce_breadcrumbs' ) ) {
	function mas_remove_woocommerce_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}


/**
 * Set the number of products to display on the WooCommerce shop page
 *
 * @since mas 1.3.1
 *
 * @return void
 */
if ( ! function_exists( 'mas_set_number_woocommerce_products' ) ) {
	function mas_set_number_woocommerce_products( $numprods ) {
		return sanitize_text_field( of_get_option( 'shop_products', '12' ) );
	}
}
if ( mas_is_woocommerce_active() && !mas_woocommerce_version_check( '3.3' ) ) {
	// Only use the loop_shop_per_page filter if WooCommerce is active and it's less than v3.3.
	// WooCommerce v3.3 now has it's own Customizer option for changing the number of products on display
	add_filter( 'loop_shop_per_page', 'mas_set_number_woocommerce_products', 20 );
}

/**
 * Check the version of WooCommerce that is current activated
 *
 * @since mas 1.4
 *
 * @return boolean
 */
function mas_woocommerce_version_check( $version = '3.3' ) {
	global $woocommerce;

	if ( mas_is_woocommerce_active() ) {
		if ( version_compare( $woocommerce->version, $version, ">=" ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Filter the WooCommerce pagination so that it matches the theme pagination
 *
 * @since mas 1.3.5
 *
 * @return array Pagination arguments
 */
if ( ! function_exists( 'mas_woocommerce_pagination_args' ) ) {
	function mas_woocommerce_pagination_args( $paginationargs ) {
		$paginationargs[ 'prev_text'] = wp_kses( __( '<i class="fa fa-angle-left"></i> Previous', 'mas' ), array( 'i' => array(
			'class' => array() ) ) );
		$paginationargs[ 'next_text'] = wp_kses( __( 'Next <i class="fa fa-angle-right"></i>', 'mas' ), array( 'i' => array(
			'class' => array() ) ) );
		return $paginationargs;
	}
}
add_filter( 'woocommerce_pagination_args', 'mas_woocommerce_pagination_args', 10 );


// /*
// * Creating a function to create our CPT
// */
//
// function custom_post_type() {
//
// // Set UI labels for Custom Post Type
//     $labels = array(
//         'name'                => _x( 'Case Studies', 'Post Type General Name', 'mas' ),
//         'singular_name'       => _x( 'Case Study', 'Post Type Singular Name', 'mas' ),
//         'menu_name'           => __( 'Case Studies', 'mas' ),
//         // 'parent_item_colon'   => __( 'Parent Movie', 'mas' ),
//         'all_items'           => __( 'All Case Studies', 'mas' ),
//         'view_item'           => __( 'View Case Study', 'mas' ),
//         'add_new_item'        => __( 'Add New Case Study', 'mas' ),
//         'add_new'             => __( 'Add New', 'mas' ),
//         'edit_item'           => __( 'Edit Case Study', 'mas' ),
//         'update_item'         => __( 'Update Case Study', 'mas' ),
//         'search_items'        => __( 'Search Case Study', 'mas' ),
//         'not_found'           => __( 'Not Found', 'mas' ),
//         'not_found_in_trash'  => __( 'Not found in Trash', 'mas' ),
//     );
//
// // Set other options for Custom Post Type
//
//     $args = array(
//         'label'               => __( 'Case Studies', 'mas' ),
//         'description'         => __( 'Case Study', 'mas' ),
//         'labels'              => $labels,
//         // Features this CPT supports in Post Editor
//         'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
//         // You can associate this CPT with a taxonomy or custom taxonomy.
//         // 'taxonomies'          => array( 'genres' ),
//         /* A hierarchical CPT is like Pages and can have
//         * Parent and child items. A non-hierarchical CPT
//         * is like Posts.
//         */
//         'hierarchical'        => false,
//         'public'              => true,
//         'show_ui'             => true,
//         'show_in_menu'        => true,
//         'show_in_nav_menus'   => true,
//         'show_in_admin_bar'   => true,
//         'menu_position'       => 5,
//         'can_export'          => true,
//         'has_archive'         => true,
//         'exclude_from_search' => false,
//         'publicly_queryable'  => true,
//         'capability_type'     => 'post',
//         'show_in_rest' => true,
//
//     );
//
//     // Registering your Custom Post Type
//     register_post_type( 'work_weve_done', $args );
//
// }
//
// /* Hook into the 'init' action so that the function
// * Containing our post type registration is not
// * unnecessarily executed.
// */
//
// add_action( 'init', 'custom_post_type', 0 );
