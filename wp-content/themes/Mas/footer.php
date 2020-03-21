<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package mas
 * @since mas 1.0
 */
?>

		<?php	do_action( 'mas_after_woocommerce' ); ?>
	</div> <!-- /#maincontentcontainer -->

	<div id="footercontainer">
		<div class="site-footer row footer_signup">
			<div class="footer-row row">
				<div class="footer-col col grid_4_of_12">
					<h3>For insights on how the right language strategy can help, sign up here.</h3>
				</div>
				<div class="footer-col col grid_6_of_12 signup">
					<input class="signup-input col grid_9_of_12" type="text" placeholder="Email Address" />
					<button class="signup-btn col grid_3_of_12 wp-block-button__link has-background brand-btn">Sign Up</button>
				</div>
			</div>
		</div>
		<div class="site-footer row footer_copyright">
			<p class="has-medium-font-size mas-graphik-medium">
				<?php echo date("Y") ?> maslansky + partners</p>
		</div>

		<footer class="site-footer row" role="contentinfo">
			<div id="footer-left" class="col grid_7_of_12">
				<div class="footer-row row grid_8_of_12">
					<div class="footer-col col grid_6_of_12">
						<?php
							if(is_active_sidebar('sidebar-footer1')){
								dynamic_sidebar('sidebar-footer1');
							}
						?>
					</div>
					<div class="footer-col col grid_6_of_12">
						<?php
							if(is_active_sidebar('sidebar-footer2')){
								dynamic_sidebar('sidebar-footer2');
							}
						?>
					</div>
				</div>
				<div class="footer-row row grid_8_of_12">
					<div class="footer-col col grid_6_of_12">
						<?php
							if(is_active_sidebar('sidebar-footer1b')){
								dynamic_sidebar('sidebar-footer1b');
							}
						?>
						<script>
							if (document.querySelector("#footercontainer .site-footer .menu-social-links-menu-container")) {
								var links = document.querySelectorAll("#footercontainer .site-footer .menu-social-links-menu-container a");
								for (var l = 0; l < links.length; l++) {
									var addClass = links[l].getAttribute("title").split(" ");
									for (var c = 0; c < addClass.length; c++) {
										links[l].classList.add(addClass[c]);
									}
								}
							}
						</script>
					</div>
					<div class="footer-col col grid_6_of_12">
						<?php
							if(is_active_sidebar('sidebar-footer2b')){
								dynamic_sidebar('sidebar-footer2b');
							}
						?>
					</div>
				</div>
			</div>
			<div id="footer-right" class="col grid_5_of_12">
				<div class="footer-row row grid_12_of_12">
					<div class="footer-col col grid_6_of_12">
						<?php
							if(is_active_sidebar('sidebar-footer3')){
								dynamic_sidebar('sidebar-footer3');
							}
						?>
					</div>
					<div class="footer-col col grid_6_of_12">
						<?php
							if(is_active_sidebar('sidebar-footer4')){
								dynamic_sidebar('sidebar-footer4');
							}
						?>
					</div>
				</div>
			</div>
			<?php
			// Count how many footer sidebars are active so we can work out how many containers we need
			// $footerSidebars = 0;
			// for ( $x=1; $x<=6; $x++ ) {
			// 	if ( is_active_sidebar( 'sidebar-footer' . $x ) ) {
			// 		$footerSidebars++;
			// 	}
			// }

			// If there's one or more one active sidebars, create a row and add them
			// if ( $footerSidebars > 0 ) { ?>
				<?php
				// Work out the container class name based on the number of active footer sidebars
				// $containerClass = "footer_col grid_" . 12 / $footerSidebars . "_of_12";

				// Display the active footer sidebars
				// for ( $x=1; $x<=4; $x++ ) {
				// 	if ( is_active_sidebar( 'sidebar-footer'. $x ) ) { ?>
						<!-- <div class="col <?php //echo $containerClass?>">
							<div class="widget-area" role="complementary"> -->
								<?php // dynamic_sidebar( 'sidebar-footer'. $x ); ?>
							<!-- </div>
						</div> --> <!-- /.col.<?php //echo $containerClass?> -->
					<?php //}
				//} ?>

			<?php //} ?>

		</footer> <!-- /.site-footer.row -->

	</div> <!-- /.footercontainer -->

</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
</body>

</html>
