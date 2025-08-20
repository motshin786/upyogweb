<?php if ('layout_one' == $settings['layout_type']) : ?>
	<?php if (!is_user_logged_in()) :
	?>
		<div class="login-page__single">
			<?php if (!empty($settings['title'])) : ?>
				<h3 class="login-page__title"><?php echo esc_html($settings['title']); ?></h3>
			<?php endif; ?>
			<form class="login-page__form" id="treck-login">
				<div class="login-result text-center"></div>
				<?php wp_nonce_field('treck-login-nonce', 'security'); ?>
				<div class="login-page__form-input-box">
					<input type="text" name="username" placeholder="<?php echo esc_attr($settings['user_name_placeholder']); ?>">
				</div>
				<div class="login-page__form-input-box">
					<input type="password" name="password" placeholder="<?php echo esc_attr($settings['password_placeholder']); ?>">
				</div>
				<div class="checked-box">
					<input type="checkbox" name="remember" id="remember" checked="">
					<label for="remember"><span></span><?php echo esc_html($settings['remember_me_text']); ?></label>
				</div>
				<div class="login-page__form-btn-box">
					<button type="submit" class="thm-btn login-page__form-btn"><?php echo esc_html($settings['login_btn_text']); ?></button>
					<div class="login-page__form-forgot-password">
						<a <?php echo esc_attr(!empty($settings['forget_url']['is_external']) ? 'target=_blank' : ' '); ?> href="<?php echo esc_url($settings['forget_url']['url']); ?>"><?php echo esc_html($settings['forget_text']); ?></a>
					</div>
				</div>
			</form>
		</div>
	<?php else :
	?>
		<div class="alert alert-success"> <?php esc_html_e('You are logged in ', 'treck-login'); ?> </div>
		<div class="alert alert-danger"><a href="<?php echo wp_logout_url(home_url('/')); ?>"><?php echo esc_html_e('Log Out ?', 'insur-login'); ?></a></div>
	<?php endif;
	?>
<?php endif; ?>