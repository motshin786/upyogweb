<?php if ('layout_one' == $settings['layout_type']) : ?>
	<!--Blog One Start-->
	<section class="blog-one">
		<div class="container">

			<div class="section-title text-center">
				<div class="section-title__tagline-box">
					<?php
					if (!empty($settings['sec_sub_title'])) :
						$this->add_inline_editing_attributes('sec_sub_title', 'none');
						treck_elementor_rendered_content($this, 'sec_sub_title', 'section-title__tagline', $settings['section_sub_title_tag_layout_one']);
					endif;
					?>
					<div class="section-title__border-box"></div>
				</div>
				<?php
				if (!empty($settings['sec_title'])) :
					$this->add_inline_editing_attributes('sec_title', 'none');
					treck_elementor_rendered_content($this, 'sec_title', 'section-title__title', $settings['section_title_tag_layout_one']);
				endif;
				?>
			</div>

			<div class="row">
				<?php
				$blog_post_one_query_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if (!empty($settings['select_category'])) :
					$blog_post_one_query_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'ignore_sticky_posts' => true,
						'orderby' => 'date',
						'order'   => $settings['query_order'],
						'posts_per_page' => $settings['post_count']['size'],
						'paged'          => $blog_post_one_query_paged,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => $settings['select_category']
							)
						)
					);
				else :
					$blog_post_one_query_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'ignore_sticky_posts' => true,
						'orderby' => 'date',
						'paged'          => $blog_post_one_query_paged,
						'order'   => $settings['query_order'],
						'posts_per_page' => $settings['post_count']['size']
					);

				endif;
				$blog_post_one_query = new \WP_Query($blog_post_one_query_args);
				$i = 1;

				while ($blog_post_one_query->have_posts()) :
					$blog_post_one_query->the_post();

					$category = get_the_category();
					$comments_number = get_comments_number();
					$tag_name = get_the_tags();

				?>
					<!--Blog One Single Start-->
					<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>00ms">
						<div class="blog-one__single">
							<div class="blog-one__img-box">
								<?php if (has_post_thumbnail()) : ?>
									<div class="blog-one__img">
										<?php the_post_thumbnail('treck_blog_370X270'); ?>
										<a href="<?php the_permalink(); ?>">
											<span class="blog-one__plus"></span>
										</a>
									</div>
								<?php endif; ?>
								<div class="blog-one__date">
									<p><?php the_time('d'); ?> <span><?php the_time('M'); ?></span></p>
								</div>
							</div>
							<div class="blog-one__content">
								<div class="blog-one__tag-and-user">
									<?php if (has_tag()) : ?>
										<div class="blog-one__tag">
											<p><?php echo esc_html($tag_name[0]->name); ?></p>
										</div>
									<?php endif; ?>
									<div class="blog-one__user">
										<div class="img">
											<?php echo get_avatar(get_the_author_meta('ID'), 29); ?>
										</div>
										<div class="text">
											<p><?php esc_html_e('by', 'treck-addon'); ?> <?php the_author(); ?></p>
										</div>
									</div>
								</div>
								<h3 class="blog-one__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="blog-one__comment-and-arrow">
									<div class="blog-one__comment">
										<p><?php treck_comment_count(); ?></p>
									</div>
									<div class="blog-one__arrow">
										<a href="<?php the_permalink(); ?>"><i class="icon-up-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Blog One Single End-->
				<?php $i++;
				endwhile; ?>
				<?php if ('yes' == $settings['pagination_status']) : ?>
					<div class="col-lg-12">
						<div class="blog-pagination portfolio-page__btn-box justify-content-center text-center">
							<?php treck_custom_query_pagination($blog_post_one_query_paged, $blog_post_one_query->max_num_pages); ?>
						</div><!-- /.blog-post-pagination -->
					</div><!-- /.col-lg-12 -->
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<!--Blog One End-->
<?php endif; ?>