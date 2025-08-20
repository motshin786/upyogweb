<?php if ('layout_one' == $settings['layout_type']) : ?>
	<?php if (!is_user_logged_in()) :
	?>
		<div class="login-page__single">
			<?php if (!empty($settings['title'])) : ?>
				<h3 class="login-page__title"><?php echo esc_html($settings['title']); ?></h3>
			<?php endif; ?>
			<form class="login-page__form" id="treck-registration">
				<div class="registration-result text-center"></div>
				<?php wp_nonce_field('treck-register-nonce', 'security'); ?>
				<div class="login-page__form-input-box">
					<input type="email" placeholder="<?php echo esc_attr($settings['email_placeholder']); ?>" name="singupEmail">
				</div>
				<div class="login-page__form-input-box">
					<input type="password" placeholder="<?php echo esc_attr($settings['password_placeholder']); ?>" name="singupPassword">
				</div>
				<div class="checked-box">
					<input type="checkbox" name="term" id="term" checked="">
					<label for="term"><span></span><?php echo wp_kses($settings['privacy_text'], 'treck_allowed_tags'); ?></label>
				</div>
				<div class="login-page__form-btn-box">
					<button type="submit" class="thm-btn login-page__form-btn"><?php echo esc_html($settings['register_btn_text']); ?></button>
				</div>
			</form>
		</div>
	<?php else :
	?>
		<div class="alert alert-success"> <?php esc_html_e('You are logged in ', 'treck-login'); ?> </div>
		<div class="alert alert-danger"><a href="<?php echo wp_logout_url(home_url('/')); ?>"><?php echo esc_html_e('Log Out ?', 'treck-login'); ?></a></div>
	<?php endif;
	?>
<?php endif; ?>