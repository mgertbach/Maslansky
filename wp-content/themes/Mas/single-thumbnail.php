<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mas
 * @since mas 1.0
 */

get_header(); ?>
	<div id="primary" class="site-content row" role="main">
		<div id="post-back-nav" class="row">
			<div class="col grid_5_of_12">
				<a class="type_sm color-l1 mas-graphik-light" href="http://localhost:8888/maslansky/what-we-think/">
					<img src="../../../../wp-content/themes/Mas/images/m+p_arrow_left_grey.svg"/>
					<span>Back to What We Think</span>
				</a>
			</div>
			<div class="col grid_7_of_12 post-share">
				<label id="share_label" class="col mas-graphik-light color-dark type_xs">Share</label>
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'container_class' => 'menu-social-links-menu-container col link-color-dark' ) ); ?>
			</div>
		</div>
		<!-- <div id="post-content" class="row"> -->
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			// 	// If comments are open or we have at least one comment, load up the comment template
			// 	// if ( comments_open() || '0' != get_comments_number() ) {
			// 	// 	comments_template( '', true );
			// 	// }
			// 	//mas_content_nav( 'nav-below' );
			endwhile;
			?>
		<!-- </div> -->
			<div class="col grid_8_of_12">
				<?php //while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'content', get_post_format() ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					// if ( comments_open() || '0' != get_comments_number() ) {
					// 	comments_template( '', true );
					// }
					?>

					<?php //mas_content_nav( 'nav-below' ); ?>

				<?php //endwhile; // end of the loop. ?>

			</div> <!-- /.col.grid_8_of_12 -->
			<?php //get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
