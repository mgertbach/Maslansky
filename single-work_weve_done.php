<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mas
 * @since mas 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row post-content" role="main">
		<!-- <div id="post-content" class="row"> -->
		<?php if ( is_single() ) { ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- display post content in main page section -->
					<div class="row" id="post-content">
						<div class="row">
						<div class="entry-content">
							<?php
								the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mas' ), array( 'span' => array(
									'class' => array() ) ) )
									);
							?>
						</div>
							<div class="row post-share">
								<label id="share_label" class="col mas-graphik-light color-dark type_xs">Share</label>
								<?php wp_nav_menu( array( 'theme_location' => 'social', 'container_class' => 'menu-social-links-menu-container col link-color-dark' ) ); ?>
							</div>
							<footer class="entry-meta">
								<?php
								edit_post_link( esc_html__( 'Edit', 'mas' ) . ' <i class="fa fa-angle-right" aria-hidden="true"></i>', '<div class="edit-link">', '</div>' );
								?>
							</footer> <!-- /.entry-meta -->
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		<?php } ?>
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
