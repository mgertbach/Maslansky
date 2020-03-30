<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package mas
 * @since mas 1.0
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( is_single() ) { ?>
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
		<?php } else if ( has_excerpt() && !is_single() ) {
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
		<span class='blog-post_author type_sm'>By
		<?php	if ( function_exists( 'coauthors_posts_links' ) ) {
					coauthors_posts_links();
			} else {
					the_author_posts_link();
			} ?>
		</span>
		<span class="post-excerpt mas-graphik-light font-lighter color-l2"><?php	the_excerpt(); ?></span>
			<p><a class="more-link" href="<?php the_permalink(); ?>"><?php echo wp_kses( __( 'Read More', 'mas' ), array( 'span' => array(
				'class' => array() ) ) ) ?>
			</a></p>
		<?php }

		 ?>


		</article> <!-- /#post -->
