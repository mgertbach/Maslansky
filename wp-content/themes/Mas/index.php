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
		<div id="blog-page-header" class="page-header row">
			<div id="page-header_header" class="row">
				<h1 class="color-brand tk-acumin-pro-wide">INSIGHTS FROM</h1>
				<h1 class="color-brand tk-acumin-pro-wide">THE TEAM</h1>
			</div>
			<div id="page-header_callout" class="row">
				<div class="col grid_10_of_12">
					<p class="mas-graphik-light color-brand">Our take on the most, and least,<br> effective communication</p>
					<img src="../wp-content/themes/Mas/images/m+p_arrow_down.svg" />
				</div>
				<div class="col grid_2_of_12">
					<img src="../wp-content/themes/Mas/images/speech_bubble.svg" />
				</div>
			</div>
		</div>
		<div id="blog-page_nav" class="page-nav row">
			<div id="blog-page_nav-title" class="page-nav_title col grid_3_of_12">
				<h6 class="mas-graphik-light color-l1 type_sm">M+P Content Feed</h6>
			</div>
			<div id="blog-page_nav-categories" class="page-nav_categories col grid_9_of_12">
				<?php
					// Get the current queried object
					$term    = get_queried_object();
					$term_id = ( isset( $term->term_id ) ) ? (int) $term->term_id : 0;

					$categories = get_categories( array(
					    'taxonomy'   => 'category', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
					    'orderby'    => 'name',
					    'parent'     => 0,
					    'hide_empty' => 0, // change to 1 to hide categores not having a single post
					) );
				?>

				<ul id="blog-page_nav_categories_links">
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
		<div id="blog-post-list" class="post-list">
			<?php
			if ( have_posts() ) :
				// Start the Loop
				while ( have_posts() ) : the_post();
					echo "<div class='col grid_4_of_12 post_preview-wrapper'>";
					get_template_part( 'content', get_post_format() ); // Include the Post-Format-specific template for the content
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
