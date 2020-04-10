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
		<div id="team-page-header" class="page-header row">
			<h1 id="team-page-header_title"><span class="line1">Our</span><br><span class="line2">Team</span></h1>
			<p id="team-page-header_info" class="type_md mas-graphik-light">In a world where nuance is everything, we’ve purposefully built a team with diversity of perspective and experience.<br><br><span>But we all share the same belief in the power of language.</span></p>
		</div>
		<div id="team-post-list" class="post-list">
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
					<h1 class="post-title mas-graphik-light font-lighter color-l1 type_md"><?php the_title(); ?></h1>
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
