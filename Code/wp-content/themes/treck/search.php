<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package treck
 */

get_header('inner');
?>
<style>
	.footer-wrapper {
    display: none;
}
.elementor-icon{display: flex !important;}
</style>
<!--Blog Sidebar Start-->
<section class="blog-sidebar">
	<div class="container">
		<div class="row">
			<?php $treck_content_class = (is_active_sidebar('sidebar-1')) ? "col-xl-12 col-lg-12" : "col-xl-12 col-lg-12" ?>
			<div class="<?php echo esc_attr($treck_content_class); ?>">
				<div class="blog-sidebar__left">
					<div id="primary" class="site-main">

						<?php
						if (have_posts()) :
							while (have_posts()) :
								the_post();
     							get_template_part('template-parts/content', 'index');
							endwhile;

						?>
							<?php if (paginate_links()) : ?>
								<div class="row">
									<div class="col-lg-12">
										<div class="blog-pagination">
											<?php treck_pagination(); ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php

						else :

							get_template_part('template-parts/content', 'none');

						endif;
						?>

					</div><!-- #main -->
				</div>
			</div>
		
		</div>
	</div>
</section>
<!--Blog Sidebar End-->

<?php
get_footer();
