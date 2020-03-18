<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'mas'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// If using image radio buttons, define a directory path
	$imagepath =  trailingslashit( get_template_directory_uri() ) . 'images/';

	// Background Defaults
	$background_defaults = array(
		'color' => '#222222',
		'image' => $imagepath . 'dark-noise.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' );

	// Editor settings
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// Footer Position settings
	$footer_position_settings = array(
		'left' => esc_html__( 'Left aligned', 'mas' ),
		'center' => esc_html__( 'Center aligned', 'mas' ),
		'right' => esc_html__( 'Right aligned', 'mas' )
	);

	// Number of shop products
	$shop_products_settings = array(
		'4' => esc_html__( '4 Products', 'mas' ),
		'8' => esc_html__( '8 Products', 'mas' ),
		'12' => esc_html__( '12 Products', 'mas' ),
		'16' => esc_html__( '16 Products', 'mas' ),
		'20' => esc_html__( '20 Products', 'mas' ),
		'24' => esc_html__( '24 Products', 'mas' ),
		'28' => esc_html__( '28 Products', 'mas' )
	);

	$options = array();

	$options[] = array(
		'name' => esc_html__( 'Basic Settings', 'mas' ),
		'type' => 'heading' );

	$options[] = array(
		'name' => esc_html__( 'Background', 'mas' ),
		'desc' => sprintf( wp_kses( __( 'If you&rsquo;d like to replace or remove the default background image, use the <a href="%1$s" title="Custom background">Appearance &gt; Background</a> menu option.', 'mas' ), array(
			'a' => array(
				'href' => array(),
				'title' => array() )
			) ), admin_url( 'customize.php?autofocus[control]=background_image' ) ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__( 'Logo', 'mas' ),
		'desc' => sprintf( wp_kses( __( 'If you&rsquo;d like to replace or remove the default logo, use the <a href="%1$s" title="Custom header">Appearance &gt; Header</a> menu option.', 'mas' ), array(
			'a' => array(
				'href' => array(),
				'title' => array() )
			) ), admin_url( 'customize.php?autofocus[control]=header_image' ) ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__( 'Social Media Settings', 'mas' ),
		'desc' => esc_html__( 'Enter the URLs for your Social Media platforms. You can also optionally specify whether you want these links opened in a new browser tab/window.', 'mas' ),
		'type' => 'info' );

	$options[] = array(
		'name' => esc_html__('Open links in new Window/Tab', 'mas'),
		'desc' => esc_html__('Open the social media links in a new browser tab/window', 'mas'),
		'id' => 'social_newtab',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => esc_html__( 'Twitter', 'mas' ),
		'desc' => esc_html__( 'Enter your Twitter URL.', 'mas' ),
		'id' => 'social_twitter',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Facebook', 'mas' ),
		'desc' => esc_html__( 'Enter your Facebook URL.', 'mas' ),
		'id' => 'social_facebook',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Google+', 'mas' ),
		'desc' => esc_html__( 'Enter your Google+ URL.', 'mas' ),
		'id' => 'social_googleplus',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'LinkedIn', 'mas' ),
		'desc' => esc_html__( 'Enter your LinkedIn URL.', 'mas' ),
		'id' => 'social_linkedin',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'SlideShare', 'mas' ),
		'desc' => esc_html__( 'Enter your SlideShare URL.', 'mas' ),
		'id' => 'social_slideshare',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Slack', 'mas' ),
		'desc' => esc_html__( 'Enter your Slack URL.', 'mas' ),
		'id' => 'social_slack',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Dribbble', 'mas' ),
		'desc' => esc_html__( 'Enter your Dribbble URL.', 'mas' ),
		'id' => 'social_dribbble',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Tumblr', 'mas' ),
		'desc' => esc_html__( 'Enter your Tumblr URL.', 'mas' ),
		'id' => 'social_tumblr',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Reddit', 'mas' ),
		'desc' => esc_html__( 'Enter your Reddit URL.', 'mas' ),
		'id' => 'social_reddit',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Twitch', 'mas' ),
		'desc' => esc_html__( 'Enter your Twitch URL.', 'mas' ),
		'id' => 'social_twitch',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'GitHub', 'mas' ),
		'desc' => esc_html__( 'Enter your GitHub URL.', 'mas' ),
		'id' => 'social_github',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Bitbucket', 'mas' ),
		'desc' => esc_html__( 'Enter your Bitbucket URL.', 'mas' ),
		'id' => 'social_bitbucket',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Stack Overflow', 'mas' ),
		'desc' => esc_html__( 'Enter your Stack Overflow URL.', 'mas' ),
		'id' => 'social_stackoverflow',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'CodePen', 'mas' ),
		'desc' => esc_html__( 'Enter your CodePen URL.', 'mas' ),
		'id' => 'social_codepen',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Foursquare', 'mas' ),
		'desc' => esc_html__( 'Enter your Foursquare URL.', 'mas' ),
		'id' => 'social_foursquare',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'YouTube', 'mas' ),
		'desc' => esc_html__( 'Enter your YouTube URL.', 'mas' ),
		'id' => 'social_youtube',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Vimeo', 'mas' ),
		'desc' => esc_html__( 'Enter your Vimeo URL.', 'mas' ),
		'id' => 'social_vimeo',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Instagram', 'mas' ),
		'desc' => esc_html__( 'Enter your Instagram URL.', 'mas' ),
		'id' => 'social_instagram',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Vine', 'mas' ),
		'desc' => esc_html__( 'Enter your Vine URL.', 'mas' ),
		'id' => 'social_vine',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Snapchat', 'mas' ),
		'desc' => esc_html__( 'Enter your Snapchat URL.', 'mas' ),
		'id' => 'social_snapchat',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Flickr', 'mas' ),
		'desc' => esc_html__( 'Enter your Flickr URL.', 'mas' ),
		'id' => 'social_flickr',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Pinterest', 'mas' ),
		'desc' => esc_html__( 'Enter your Pinterest URL.', 'mas' ),
		'id' => 'social_pinterest',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'RSS', 'mas' ),
		'desc' => esc_html__( 'Enter your RSS Feed URL.', 'mas' ),
		'id' => 'social_rss',
		'std' => '',
		'type' => 'text' );

	$options[] = array(
		'name' => esc_html__( 'Advanced settings', 'mas' ),
		'type' => 'heading' );

	$options[] = array(
		'name' =>  esc_html__( 'Banner Background', 'mas' ),
		'desc' => esc_html__( 'Select an image and background color for the homepage banner.', 'mas' ),
		'id' => 'banner_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => esc_html__( 'Footer Background Color', 'mas' ),
		'desc' => esc_html__( 'Select the background color for the footer.', 'mas' ),
		'id' => 'footer_color',
		'std' => '#222222',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_html__( 'Footer Content', 'mas' ),
		'desc' => esc_html__( 'Enter the text you&lsquo;d like to display in the footer. This content will be displayed just below the footer widgets. It&lsquo;s ideal for displaying your copyright message or credits.', 'mas' ),
		'id' => 'footer_content',
		'std' => mas_get_credits(),
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$options[] = array(
		'name' => esc_html__( 'Footer Content Position', 'mas' ),
		'desc' => esc_html__( 'Select what position you would like the footer content aligned to.', 'mas' ),
		'id' => 'footer_position',
		'std' => 'center',
		'type' => 'select',
		'class' => 'mini',
		'options' => $footer_position_settings );

	if( mas_is_woocommerce_active() ) {
		$options[] = array(
		'name' => esc_html__( 'WooCommerce settings', 'mas' ),
		'type' => 'heading' );

		$options[] = array(
			'name' => esc_html__('Shop sidebar', 'mas'),
			'desc' => esc_html__('Display the sidebar on the WooCommerce Shop page', 'mas'),
			'id' => 'woocommerce_shopsidebar',
			'std' => '1',
			'type' => 'checkbox');

		$options[] = array(
			'name' => esc_html__('Products sidebar', 'mas'),
			'desc' => esc_html__('Display the sidebar on the WooCommerce Single Product page', 'mas'),
			'id' => 'woocommerce_productsidebar',
			'std' => '1',
			'type' => 'checkbox');

		$options[] = array(
			'name' => esc_html__( 'Cart, Checkout & My Account sidebars', 'mas' ),
			'desc' => esc_html__( 'The &lsquo;Cart&rsquo;, &lsquo;Checkout&rsquo; and &lsquo;My Account&rsquo; pages are displayed using shortcodes. To remove the sidebar from these Pages, simply edit each Page and change the Template (in the Page Attributes Panel) to the &lsquo;Full-width Page Template&rsquo;.', 'mas' ),
			'type' => 'info' );

		$options[] = array(
			'name' => esc_html__('Shop Breadcrumbs', 'mas'),
			'desc' => esc_html__('Display the breadcrumbs on the WooCommerce pages', 'mas'),
			'id' => 'woocommerce_breadcrumbs',
			'std' => '1',
			'type' => 'checkbox');

		if ( !mas_woocommerce_version_check( '3.3' ) ) {
			$options[] = array(
				'name' => esc_html__( 'Shop Products', 'mas' ),
				'desc' => esc_html__( 'Select the number of products to display on the shop page.', 'mas' ),
				'id' => 'shop_products',
				'std' => '12',
				'type' => 'select',
				'class' => 'mini',
				'options' => $shop_products_settings );
		}

	}

	return $options;
}
