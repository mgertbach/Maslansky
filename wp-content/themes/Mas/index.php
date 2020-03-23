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
					<div class="row">
						<p class="col grid_5_of_12 mas-graphik-light color-brand">Our take on the most, and least, effective communication</p>
					</div>
					<div class="row">
						<img src="images/m+p_arrow_down.svg" />
					</div>
				</div>
				<div class="col grid_2_of_12">
					<!-- <svg xmlns="http://www.w3.org/2000/svg" width="239" height="181" viewBox="0 0 239 181">
					  <g id="Group_321" data-name="Group 321" transform="translate(-1441 -745)">
					    <g id="Group_282" data-name="Group 282" transform="translate(-48 -39)">
					      <rect id="Rectangle_246" data-name="Rectangle 246" width="239" height="93" rx="46.5" transform="translate(1489 838)" fill="#e4e4e5"/>
					      <path id="Polygon_6" data-name="Polygon 6" d="M26,0,52,49H0Z" transform="translate(1652 965) rotate(180)" fill="#e4e4e5"/>
					      <text id="_" data-name="…" transform="translate(1571 784)" fill="#bebec1" font-size="110" font-family="Helvetica" letter-spacing="-0.01em"><tspan x="0" y="85">…</tspan></text>
					    </g>
					  </g>
					</svg> -->
				</div>
			</div>
		</div>

		<div class="col grid_8_of_12">

			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); // Include the Post-Format-specific template for the content ?>
				<?php endwhile; ?>

				<?php mas_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>

			<?php endif; // end have_posts() check ?>

		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
