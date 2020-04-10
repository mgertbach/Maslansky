<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mas
 * @since mas 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row post-content" role="main">
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
		<?php if ( is_single() ) { ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- display header & post info sidebar if it is a single post page -->
					<div class="col grid_5_of_12" id="post-sidebar">
						<div class="row">
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php mas_posted_on();?>
								<div id="blog-post_author">
									<img id="blog-post_author-img" src="http://localhost:8888/maslansky/wp-content/uploads/2020/03/mp_Team-2.jpg"/>
									<p id="blog-post_author-name" class="blog-post_author-text color-brand mas-graphik-light type_sm font-lighter">Lee Carter</p>
									<p id="blog-post_author-info" class="blog-post_author-text color-l1 mas-graphik-light type_sm font-lighter">President<br>Maslansky+Partners</p>
								</div>
							</header> <!-- /.entry-header -->
						</div>
					</div>
					<!-- display post content in main page section -->
					<div class="col grid_7_of_12" id="post-content">
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
