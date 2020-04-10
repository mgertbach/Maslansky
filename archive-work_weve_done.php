<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mas
 * @since mas 1.0
 */

get_header(); ?>
	<div id="primary" class="site-content row" role="main">
		<div id="casestudy-page-header" class="page-header row">
			<h1 id="casestudy-page-header_title" class="tk-acumin-pro-wide"><span class="line1">Work We've</span><br><span class="line2">Done</span></h1>
			<div id="casestudy-page-header_slider" class="header_slider">
				<div id="casestudy-page-header_slider-1" class="active header_slider-slide casestudy-page-header_slider-slide" data-slide="1" style="z-index: 3;">
					<p class="casestudy-slider_text">Drive enrollment in crowded space: Speaking the language of customers to make a product stand out</p>
					<div class="img-wpr">
						<img src="../wp-content/themes/Mas/images/m+p_Work_Hero-1.png" />
					</div>
				</div>
				<div id="casestudy-page-header_slider-2" class="header_slider-slide casestudy-page-header_slider-slide" data-slide="2" style="z-index: 2;">
					<p class="casestudy-slider_text">Getting satisfied customers to switch: From better coverage for affluent customers to we look for ways to say yes</p>
					<div class="img-wpr">
						<img src="../wp-content/themes/Mas/images/m+p_Work_Hero-2.png" />
					</div>
				</div>
				<div id="casestudy-page-header_slider-3" class="header_slider-slide casestudy-page-header_slider-slide" data-slide="3" style="z-index: 1;">
					<p class="casestudy-slider_text">The World’s Most Experienced Driver</p>
					<div class="img-wpr">
						<img src="../wp-content/themes/Mas/images/m+p_Work_Hero-3.png" />
					</div>
				</div>
			</div>
			<div id="page-header_callout" class="casestudy row">
				<div class="row">
					<img class="down-arrow" src="../wp-content/themes/Mas/images/m+p_arrow_down.svg" />
				</div>
				<div id="slide-indicator-container" class="row">
					<span id="slide-indicator_3" class="slide-indicator"></span>
					<span id="slide-indicator_2" class="slide-indicator"></span>
					<span id="slide-indicator_1" class="slide-indicator active"></span>
				</div>
			</div>
		</div>
		<div id="casestudy-page_nav" class="page-nav row">
			<div id="casestudy-page_nav-title" class="page-nav_title col grid_3_of_12">
				<h6 class="mas-graphik-light color-l1 type_sm">Our Work</h6>
			</div>
			<div id="casestudy-page_nav-categories" class="page-nav_categories col grid_9_of_12">
				<?php
					// Get the current queried object
					$term    = get_queried_object();
					$term_id = ( isset( $term->term_id ) ) ? (int) $term->term_id : 0;

					$categories = get_categories( array(
					    'taxonomy'   => 'case_study_categories', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
					    'orderby'    => 'name',
					    'parent'     => 0,
					    'hide_empty' => 0, // change to 1 to hide categores not having a single post
					) );
				?>

				<ul id="casestudy-page_nav_categories_links">
					<li class='active_cat'><a href='#'>All</a></li>
			    <?php
				    foreach ( $categories as $category ) {
			        $cat_ID        = (int) $category->term_id;
			        $category_name = $category->name;

			        // When viewing a particular category, give it an [active] class
			        $cat_class = ( $cat_ID == $term_id ) ? 'active' : 'not-active';

			        // create link for all categories EXCEPT "uncategorized"
			        if ( strtolower( $category_name ) != 'uncategorized' ) {
									echo '<li><a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a></li>';
			        }
				    }
			    ?>
				</ul>
			</div>
		</div>
		<div id="casestudy-post-list" class="post-list">
			<?php
			if ( have_posts() ) :
				// Start the Loop
				while ( have_posts() ) : the_post();
					echo "<div class='col grid_4_of_12 post_preview-wrapper'>";
							// get_template_part( 'single-work_weve_done', get_post_format() ); // Include the Post-Format-specific template for the content
			?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if ( has_excerpt() && !is_single() ) {
						if (has_post_thumbnail()) {
							//display feature image
							the_post_thumbnail();
						} else {
							//create default tile / cat display
						?>
						<div class='blog-post_default'>
							<p class='blog-post_cat mas-graphik-light color-l3'>
								<?php foreach((get_the_category()) as $category) {
								    echo $category->cat_name . ' ';
								} ?>
							</p>
							<h6 class="blog-post_title tk-acumin-pro-extra-condensed color-l4"><?php the_title(); ?></h6>
						</div>
					<?php } ?>
					<h6 class="post-title mas-graphik-light font-lighter color-l1 type_md"><?php the_title(); ?></h6>
					<span class="post-excerpt mas-graphik-light font-lighter color-l2"><?php	the_excerpt(); ?></span>
						<p><a class="more-link" href="<?php the_permalink(); ?>"><?php echo wp_kses( __( 'Read More', 'mas' ), array( 'span' => array(
							'class' => array() ) ) ) ?>
						</a></p>
					<?php } ?>
					</article> <!-- /#post -->
			<?php
					echo "</div>";
				endwhile;
				mas_content_nav( 'nav-below' );
			else :
				get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found
			endif; // end have_posts() check

			?>
		</div>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
