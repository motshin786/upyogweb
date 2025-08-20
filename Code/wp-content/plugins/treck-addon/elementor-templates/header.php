<?php if ('layout_one' === $settings['layout_type']) : ?>

	<header class="main-header">
		<nav class="main-menu">
			<div class="main-menu__wrapper">
				<div class="main-menu__wrapper-inner">
					<div class="main-menu__logo logo-retina">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<img width="<?php echo esc_attr($settings['logo_dimension']['width']); ?>" height="<?php echo esc_attr($settings['logo_dimension']['height']); ?>" src="<?php echo esc_url($settings['light_logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
						</a>
					</div>
					<?php if ('yes' == $settings['search_enable']) : ?>
						<div class="main-menu__search-box">
							<a href="#" class="main-menu__search search-toggler icon-magnifying-glass"><span><?php esc_html_e('Search...', 'treck-addon'); ?></span></a>
						</div>
					<?php endif; ?>
					<div class="main-menu__wrapper-inner-content">
						<?php if ('yes' == $settings['search_news_ticker']) : ?>
							<div class="main-menu__update-box">
								<div class="main-menu__update-box-inner">
									<div class="main-menu__update-box-left">
										<div class="main-menu__update-icon-box">
											<div class="main-menu__update-icon icon-svg">
												<?php \Elementor\Icons_Manager::render_icon($settings['news_ticker_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'span'); ?>
											</div>
											<div class="main-menu__update-icon-text">
												<p><?php echo esc_html($settings['news_ticker_title']); ?></p>
											</div>
										</div>
										<div class="main-menu__update-carousel-box">
											<div class="main-menu__update-carousel thm-owl__carousel owl-theme owl-carousel" data-owl-options='{
                                                "items": 1,
                                                "margin": 30,
                                                "smartSpeed": 700,
                                                "loop":true,
                                                "autoplay": false,
                                                "nav":true,
                                                "dots":false,
                                                "navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"],
                                                "responsive":{
                                                    "0":{
                                                        "items":1
                                                    },
                                                    "768":{
                                                        "items":1
                                                    },
                                                    "992":{
                                                        "items": 1
                                                    }
                                                }
                                            }'>
												<?php foreach ($settings['news_ticker'] as $index => $item) : ?>
													<div class="item">
														<div class="main-menu__update-single">
															<p class="main-menu__update-text"><?php echo wp_kses($item['title'], 'treck_allowed_tags'); ?></p>
														</div>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
									<div class="main-menu__update-box-right">
										<div class="main-menu__social-box">
											<?php if (!empty($settings['news_ticker_social_title'])) : ?>
												<h4 class="main-menu__social-title"><?php echo esc_html($settings['news_ticker_social_title']); ?></h4>
											<?php endif; ?>
											<div class="main-menu__social">
												<?php foreach ($settings['news_social_icons'] as $social_icon) : ?>
													<a <?php echo esc_attr(!empty($social_icon['social_url']['is_external']) ? 'target=_blank' : ' '); ?> href="<?php echo esc_url($social_icon['social_url']['url']); ?>">
														<?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
													</a>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="main-menu__top">
							<div class="main-menu__top-inner">
								<div class="main-menu__top-left">
									<ul class="list-unstyled main-menu__contact-list ml-0">
										<?php foreach ($settings['topbar_infos'] as $index => $item) : ?>
											<li>
												<div class="icon icon-svg">
													<?php \Elementor\Icons_Manager::render_icon($item['topbar_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
												</div>
												<div class="text">
													<p><?php echo wp_kses($item['topbar_info_text'], 'treck_allowed_tags'); ?></p>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="main-menu__top-right">
									<ul class="list-unstyled main-menu__top-menu ml-0">
										<?php foreach ($settings['topbar_nav'] as $index => $item) : ?>
											<li>
												<?php
												if (!empty($item['name'])) :
													treck_basic_rendered_content($this, $item,  'name', '', 'a', 'button_url', '');
												endif;
												?>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="main-menu__bottom">
							<div class="main-menu__bottom-inner">
								<div class="main-menu__main-menu-box">
									<a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
									<?php
									wp_nav_menu(
										array(
											'menu' => $settings['nav_menu'],
											'menu_class' => 'main-menu__list',
											'walker'         => class_exists('\Layerdrops\Treck\Megamenu\Walker_Nav_Menu') ? new \Layerdrops\Treck\Megamenu\Walker_Nav_Menu : '',
										)
									);
									?>
								</div>
								<div class="main-menu__right">
									<div class="main-menu__call">
										<div class="main-menu__call-icon">
											<?php treck_elementor_rendered_image($settings, 'call_icon_image'); ?>
										</div>
										<div class="main-menu__call-content">
											<?php if (!empty($settings['call_text'])) : ?>
												<p class="main-menu__call-sub-title"><?php echo esc_html($settings['call_text']); ?></p>
											<?php endif; ?>
											<?php if (!empty($settings['call_number'])) : ?>
												<h5 class="main-menu__call-number">
													<a href="<?php echo esc_url($settings['call_url']); ?>"><?php echo wp_kses($settings['call_number'], 'treck_allowed_tags'); ?></a>
												</h5>
											<?php endif; ?>
										</div>
									</div>

									<div class="main-menu__btn-box">
										<?php
										if (!empty($settings['button_label'])) :
											treck_basic_rendered_content($this, $settings,  'button_label', 'thm-btn main-menu__btn', 'a', 'button_url');
										endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<?php if (get_theme_mod('header_sticky_menu') == 'yes' && !is_admin_bar_showing()) : ?>
		<div class="stricky-header stricked-menu main-menu">
			<div class="sticky-header__content"></div><!-- /.sticky-header__content -->
		</div><!-- /.stricky-header -->
	<?php endif; ?>

<?php endif; ?>

<?php if ('layout_two' === $settings['layout_type']) : ?>

	<header class="main-header-two">
		<div class="main-header-two__top">
			<div class="main-header-two__top-inner">
				<div class="main-header-two__top-left">
					<ul class="list-unstyled main-header-two__contact-list ml-0">
						<?php foreach ($settings['topbar_infos'] as $index => $item) : ?>
							<li>
								<div class="icon icon-svg">
									<?php \Elementor\Icons_Manager::render_icon($item['topbar_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
								</div>
								<div class="text">
									<p><?php echo wp_kses($item['topbar_info_text'], 'treck_allowed_tags'); ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="main-header-two__top-right">
					<ul class="list-unstyled main-header-two__top-menu ml-0">
						<?php foreach ($settings['topbar_nav'] as $index => $item) : ?>
							<li><?php
								if (!empty($item['name'])) :
									treck_basic_rendered_content($this, $item,  'name', '', 'a', 'button_url', '');
								endif;
								?>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="main-header-two__social-box">
						<div class="main-header-two__social-shape">
							<?php treck_elementor_rendered_image($settings, 'social_bg_shape'); ?>
						</div>
						<?php if (!empty($settings['social_title'])) : ?>
							<h4 class="main-header-two__social-title"><?php echo esc_html($settings['social_title']); ?></h4>
						<?php endif; ?>
						<div class="main-header-two__social">
							<?php foreach ($settings['social_icons'] as $social_icon) : ?>
								<a <?php echo esc_attr(!empty($social_icon['social_url']['is_external']) ? 'target=_blank' : ' '); ?> href="<?php echo esc_url($social_icon['social_url']['url']); ?>">
									<?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-menu main-menu-two">
			<div class="main-menu-two__wrapper">
				<div class="main-menu-two__wrapper-inner">
					<div class="main-menu-two__left">
						<div class="main-menu-two__logo logo-retina">
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img width="<?php echo esc_attr($settings['logo_dimension']['width']); ?>" height="<?php echo esc_attr($settings['logo_dimension']['height']); ?>" src="<?php echo esc_url($settings['light_logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
							</a>
						</div>
						<div class="main-menu-two__main-menu-box">
							<a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
							<?php
							wp_nav_menu(
								array(
									'menu' => $settings['nav_menu'],
									'menu_class' => 'main-menu__list',
									'walker'         => class_exists('\Layerdrops\Treck\Megamenu\Walker_Nav_Menu') ? new \Layerdrops\Treck\Megamenu\Walker_Nav_Menu : '',
								)
							);
							?>
						</div>
					</div>
					<div class="main-menu-two__right">
						<div class="main-menu-two__btn-box">
							<?php
							if (!empty($settings['button_label'])) :
								treck_basic_rendered_content($this, $settings,  'button_label', 'thm-btn main-menu-two__btn', 'a', 'button_url');
							endif;
							?>
						</div>
						<div class="main-menu-two__call">
							<div class="main-menu-two__call-icon">
								<?php treck_elementor_rendered_image($settings, 'call_icon_image'); ?>
							</div>
							<div class="main-menu-two__call-content">
								<?php if (!empty($settings['call_text'])) : ?>
									<p class="main-menu-two__call-sub-title"><?php echo wp_kses($settings['call_text'], 'treck_allowed_tags'); ?></p>
								<?php endif; ?>

								<h5 class="main-menu-two__call-number">
									<a href="<?php echo esc_url($settings['call_url']); ?>"><?php echo wp_kses($settings['call_number'], 'treck_allowed_tags'); ?></a>
								</h5>

							</div>
						</div>
						<div class="main-menu-two__search-cart-box">
							<?php if ('yes' == $settings['search_enable']) : ?>
								<div class="main-menu-two__search-box">
									<a href="#" class="main-menu-two__search search-toggler icon-magnifying-glass"></a>
								</div>
							<?php endif; ?>
							<?php if ('yes' == $settings['cart_enable'] && class_exists('WooCommerce')) : ?>
								<div class="main-menu-two__cart-box">
									<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="main-menu-two__cart icon-shopping-cart"></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<?php if (get_theme_mod('header_sticky_menu') == 'yes' && !is_admin_bar_showing()) : ?>
		<div class="stricky-header stricked-menu main-menu main-menu-two">
			<div class="sticky-header__content"></div><!-- /.sticky-header__content -->
		</div><!-- /.stricky-header -->
	<?php endif; ?>
<?php endif; ?>

<?php if ('layout_three' === $settings['layout_type']) : ?>

	<header class="main-header-three">
		<nav class="main-menu main-menu-three">
			<div class="main-menu-three__wrapper">
				<div class="main-menu-three__wrapper-inner">
					<div class="main-menu-three__logo logo-retina">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<img width="<?php echo esc_attr($settings['logo_dimension']['width']); ?>" height="<?php echo esc_attr($settings['logo_dimension']['height']); ?>" src="<?php echo esc_url($settings['light_logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
						</a>
					</div>
					<div class="main-menu-three__top">
						<div class="main-menu-three__top-inner">
							<div class="main-menu-three__top-left">
								<ul class="list-unstyled main-menu-three__contact-list ml-0">
									<?php foreach ($settings['topbar_infos'] as $index => $item) : ?>
										<li>
											<div class="icon icon-svg">
												<?php \Elementor\Icons_Manager::render_icon($item['topbar_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
											</div>
											<div class="text">
												<p><?php echo wp_kses($item['topbar_info_text'], 'treck_allowed_tags'); ?></p>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="main-menu-three__top-right">
								<div class="main-menu-three__social">
									<?php foreach ($settings['social_icons'] as $social_icon) : ?>
										<a <?php echo esc_attr(!empty($social_icon['social_url']['is_external']) ? 'target=_blank' : ' '); ?> href="<?php echo esc_url($social_icon['social_url']['url']); ?>">
											<?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true', 'class' => ' '], 'i'); ?>
										</a>
									<?php endforeach; ?>
								</div>
								<ul class="list-unstyled main-menu-three__top-menu ml-0">
									<?php foreach ($settings['topbar_nav'] as $index => $item) : ?>
										<li>
											<?php
											if (!empty($item['name'])) :
												treck_basic_rendered_content($this, $item,  'name', '', 'a', 'button_url', '');
											endif;
											?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="main-menu-three__bottom">
						<div class="main-menu-three__bottom-inner">
							<div class="main-menu-three__main-menu-box">
								<a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
								<?php
								wp_nav_menu(
									array(
										'menu' => $settings['nav_menu'],
										'menu_class' => 'main-menu__list',
										'walker'         => class_exists('\Layerdrops\Treck\Megamenu\Walker_Nav_Menu') ? new \Layerdrops\Treck\Megamenu\Walker_Nav_Menu : '',
									)
								);
								?>
							</div>
							<div class="main-menu-three__right">
								<div class="main-menu-three__call">
									<div class="main-menu-three__call-icon">
										<?php treck_elementor_rendered_image($settings, 'call_icon_image'); ?>
									</div>
									<div class="main-menu-three__call-content">
										<?php if (!empty($settings['call_text'])) : ?>
											<p class="main-menu-three__call-sub-title"><?php echo esc_html($settings['call_text']); ?></p>
										<?php endif; ?>

										<h5 class="main-menu-three__call-number">
											<a href="<?php echo esc_url($settings['call_url']); ?>"><?php echo wp_kses($settings['call_number'], 'treck_allowed_tags'); ?></a>
										</h5>
									</div>
								</div>
								<div class="main-menu-three__search-cart-box">
									<?php if ('yes' == $settings['search_enable']) : ?>
										<div class="main-menu-three__search-box">
											<a href="#" class="main-menu-three__search search-toggler icon-magnifying-glass"></a>
										</div>
									<?php endif; ?>
									<?php if ('yes' == $settings['cart_enable'] && class_exists('WooCommerce')) : ?>
										<div class="main-menu-three__cart-box">
											<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="main-menu-three__cart icon-shopping-cart"></a>
										</div>
									<?php endif; ?>
								</div>
								<div class="main-menu-three__btn">
									<?php
									if (!empty($settings['button_label'])) :
										treck_basic_rendered_content($this, $settings,  'button_label', '', 'a', 'button_url');
									endif;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<?php if (get_theme_mod('header_sticky_menu') == 'yes' && !is_admin_bar_showing()) : ?>
		<div class="stricky-header stricked-menu main-menu main-menu-three">
			<div class="sticky-header__content"></div><!-- /.sticky-header__content -->
		</div><!-- /.stricky-header -->
	<?php endif; ?>



<?php endif; ?>

<div class="mobile-nav__wrapper">
	<div class="mobile-nav__overlay mobile-nav__toggler"></div>
	<!-- /.mobile-nav__overlay -->
	<div class="mobile-nav__content">
		<span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

		<div class="logo-box">
			<a href="<?php echo esc_url(home_url('/')); ?>" aria-label="logo image">
				<img width="<?php echo esc_attr($settings['logo_dimension']['width']); ?>" height="<?php echo esc_attr($settings['logo_dimension']['height']); ?>" src="<?php echo esc_attr($settings['mobile_menu_logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
			</a>
		</div>
		<!-- /.logo-box -->
		<div class="mobile-nav__container"></div>
		<!-- /.mobile-nav__container -->
		<ul class="mobile-nav__contact list-unstyled ml-0">
			<?php if ($settings['mobile_email']) : ?>
				<li>
					<i class="fa fa-envelope"></i>
					<a href="mailto:<?php echo esc_attr($settings['mobile_email']); ?>"><?php echo esc_html($settings['mobile_email']); ?></a>
				</li>
			<?php endif; ?>
			<?php if ($settings['mobile_phone']) : ?>
				<li>
					<i class="fa fa-phone-alt"></i>
					<a href="tel:<?php echo esc_url(str_replace(' ', '-', $settings['mobile_phone'])); ?>">
						<?php echo esc_html($settings['mobile_phone']); ?>
					</a>
				</li>
			<?php endif; ?>
		</ul><!-- /.mobile-nav__contact -->
		<div class="mobile-nav__top">
			<div class="mobile-nav__social">
				<?php foreach ($settings['mobile_menu_social_icons'] as $social_icon) : ?>
					<a href="<?php echo esc_url($social_icon['social_url']['url']); ?>" class="fab <?php echo esc_attr($social_icon['social_icon']); ?>"></a>
				<?php endforeach; ?>
			</div><!-- /.mobile-nav__social -->
		</div><!-- /.mobile-nav__top -->

	</div>
	<!-- /.mobile-nav__content -->
</div>


<div class="search-popup">
	<div class="search-popup__overlay search-toggler"></div>
	<!-- /.search-popup__overlay -->
	<div class="search-popup__content">
		<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
			<label for="search" class="sr-only"><?php echo esc_html__("search here", 'treck-addon'); ?></label><!-- /.sr-only -->
			<input type="search" name="s" id="search" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo esc_attr__('Search Here...', 'treck-addon') ?>" />
			<button type="submit" aria-label="search submit" class="thm-btn">
				<i class="icon-magnifying-glass"></i>
			</button>
		</form>
	</div>
	<!-- /.search-popup__content -->
</div>


<?php $treck_back_to_top_status = get_theme_mod('scroll_to_top', 'no'); ?>
<?php if ('yes' === $treck_back_to_top_status) : ?>
	<span data-target="html" class="scroll-to-target scroll-to-top"><i class="fa <?php echo esc_attr(get_theme_mod('scroll_to_top_icon', 'fa-angle-up')); ?>"></i></span>

<?php endif; ?>