<?php
/**
 * Settings class.
 *
 * @since 1.7.0
 *
 * @package Envira_Gallery
 * @author  Envira Gallery Team <support@enviragallery.com>
 */

namespace Envira\Admin;

use Envira\Utils\Browser;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Settings class.
 *
 * @since 1.7.0
 *
 * @package Envira_Gallery
 * @author  Envira Gallery Team <support@enviragallery.com>
 */
class Settings {

	/**
	 * Holds the submenu pagehook.
	 *
	 * @since 1.7.0
	 *
	 * @var string
	 */
	public $hook;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.7.0
	 */
	public function __construct() {

		// Add custom settings submenu.
		add_action( 'admin_menu', [ &$this, 'admin_menu' ], 11 );

		// Add callbacks for settings tabs.
		add_action( 'envira_gallery_tab_settings_general', [ $this, 'settings_general_tab' ] );
		add_action( 'envira_gallery_tab_settings_standalone', [ $this, 'settings_standalone_tab' ] );
		add_action( 'envira_gallery_tab_settings_debug', [ $this, 'settings_debug_tab' ] );

		// Add the settings menu item to the Plugins table.
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( dirname( __DIR__ ) ) . 'envira-gallery.php' ), [ $this, 'settings_link' ] );

		// Add items for debug.
		add_action( 'envira_gallery_debug_screen_output', [ $this, 'debug_screen_output' ] );
		add_action( 'wp_ajax_download_system_info', [ $this, 'debug_download_info' ] );

		add_action( 'admin_footer', [ $this, 'add_settings_js' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'add_scripts' ] );
	}

	/**
	 * Adds scripts for Envira settings menus.
	 *
	 * @param string $hook_suffix The hook suffix.
	 * @since 1.7.0
	 */
	public function add_scripts( $hook_suffix ) {

		if ( strtolower( $hook_suffix ) !== 'envira_page_envira-gallery-settings' ) {
			return;
		}

		wp_enqueue_script( 'wp-color-picker' );
	}

	/**
	 * Register the Settings submenu item for Envira.
	 *
	 * @since 1.7.0
	 */
	public function admin_menu() {

		$label = apply_filters( 'envira_whitelabel_name', 'Envira' );
		// Register the submenu.
		$this->hook = add_submenu_page(
			'edit.php?post_type=envira',
			$label . __( ' Gallery Settings', 'envira-gallery' ),
			__( 'Settings', 'envira-gallery' ),
			apply_filters( 'envira_gallery_menu_cap', 'manage_options' ),
			ENVIRA_SLUG . '-settings',
			[ &$this, 'settings_page' ]
		);

		// If successful, load admin assets only on that page and check for addons refresh.
		if ( ! $this->hook ) {
			return;
		}

		// Add all of our settings hooks.
		add_action( 'load-' . $this->hook, [ $this, 'update_image_settings' ] );
		add_action( 'load-' . $this->hook, [ $this, 'standalone_settings_save' ] );
		add_action( 'load-' . $this->hook, [ $this, 'enqueue_admin_settings_styles' ] );

		// Add admin Scripts and Styles.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	/**
	 * Saves images Settings:
	 * - Add New Images
	 * - Delete Images on Gallery Deletion
	 *
	 * @since 1.7.0
	 *
	 * @return null Return early if not fixing the broken migration
	 */
	public function update_image_settings() {

		// Check if user pressed the 'Update' button and nonce is valid.
		if ( ! isset( $_POST['envira-gallery-settings-submit'] ) ) {
			return;
		}
		if ( isset( $_POST['envira-gallery-settings-nonce'] ) && ! wp_verify_nonce( sanitize_key( $_POST['envira-gallery-settings-nonce'] ), 'envira-gallery-settings-nonce' ) ) {
			return;
		}

		$media_position = isset( $_POST['envira_media_position'] ) ? sanitize_text_field( wp_unslash( $_POST['envira_media_position'] ) ) : '';
		$image_delete   = isset( $_POST['envira_image_delete'] ) ? sanitize_text_field( wp_unslash( $_POST['envira_image_delete'] ) ) : '';
		$media_delete   = isset( $_POST['envira_media_delete'] ) ? sanitize_text_field( wp_unslash( $_POST['envira_media_delete'] ) ) : '';
		$beta_enabled   = isset( $_POST['envira_beta_enabled'] ) ? intval( $_POST['envira_beta_enabled'] ) : 0;
		$loader_color   = isset( $_POST['envira_gallery_loader_color'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_POST['envira_gallery_loader_color'] ) ) ) : '#000000';
		$validated      = false;

		// Validate Loader Color.
		if ( preg_match( '/^#[a-f0-9]{6}$/i', $loader_color ) ) {
			// hex color is valid.
			$validated = true;
		} elseif ( preg_match( '/^[a-f0-9]{6}$/i', $loader_color ) ) {
			// hex color is valid.
			$loader_color = '#' . $loader_color;
			$validated    = true;
		} else {
			$loader_color = '#000000';
		}

		// Update settings.
		envira_update_setting( 'media_position', $media_position );
		envira_update_setting( 'image_delete', $image_delete );
		envira_update_setting( 'media_delete', $media_delete );
		envira_update_setting( 'loader_color', $loader_color );
		envira_update_setting( 'beta_enabled', $beta_enabled );

		// Clear plugin update cache.
		wp_clean_plugins_cache( true );

		// Output an admin notice so the user knows what happened.
		add_action( 'envira_gallery_settings_general_tab_notice', [ $this, 'updated_settings' ] );
	}

	/**
	 * Stand Alone Setting function.
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 * @return void
	 */
	public function standalone_settings_save() {
		// Check nonce is valid.
		if ( ! isset( $_POST['envira-standalone-nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['envira-standalone-nonce'] ), 'envira-standalone-nonce' ) ) {
			add_action( 'envira_gallery_settings_standalone_tab_notice', [ $this, 'standalone_settings_nonce_notice' ] );
			return;
		}

		envira_update_setting( 'standalone_enabled', empty( $_POST['envira-standalone-enable'] ) ? 0 : 1 );

		// Get reserved slugs.
		$slugs = envira_standalone_get_reserved_post_type_slugs();

		// Determine which slug(s) to check - include albums if the Albums addon is enabled.
		$slugs_to_check = [
			'gallery',
		];
		if ( isset( $_POST['envira-albums-slug'] ) ) {
			$slugs_to_check[] = 'albums';
		}

		// Go through each slug.
		foreach ( $slugs_to_check as $slug ) {

			// Check slug is valid.
			if ( empty( $_POST[ 'envira-' . $slug . '-slug' ] ) ) {
				add_action( 'envira_gallery_settings_standalone_tab_notice', 'envira_standalone_settings_slug_notice' );
				return;
			}
			if ( ! preg_match( '/^[a-zA-Z0-9_\-]+$/', sanitize_text_field( wp_unslash( $_POST[ 'envira-' . $slug . '-slug' ] ) ) ) ) {
				add_action( 'envira_gallery_settings_standalone_tab_notice', [ $this, 'standalone_settings_slug_notice' ] );
				return;
			}
			if ( 'albums' !== $slug && isset( $_POST['envira-albums-slug'] ) && ( strtolower( sanitize_text_field( wp_unslash( $_POST['envira-albums-slug'] ) ) ) === strtolower( sanitize_text_field( wp_unslash( $_POST[ 'envira-' . $slug . '-slug' ] ) ) ) ) ) {
				add_action( 'envira_gallery_settings_standalone_tab_notice', [ $this, 'standalone_settings_unique_slugs' ] );
				return;
			}

			// Check slug is not reserved.
			if ( ! is_array( $slugs ) ) {
				add_action( 'envira_gallery_settings_standalone_tab_notice', [ $this, 'standalone_settings_slug_notice' ] );
				return;
			}

			if ( in_array( wp_unslash( $_POST[ 'envira-' . $slug . '-slug' ] ), $slugs, true ) ) {
				add_action( 'envira_gallery_settings_standalone_tab_notice', [ $this, 'standalone_settings_slug_notice' ] );
				return;
			}

			// If we reach this point, the slugs are good to use.
			update_option( 'envira-' . $slug . '-slug', sanitize_text_field( wp_unslash( $_POST[ 'envira-' . $slug . '-slug' ] ) ) );

		}

		// Set envira-standalone-flushed = false, so on the next page load, rewrite
		// rules are flushed to prevent 404s.
		update_option( 'envira-standalone-flushed', false );

		// Output success notice.
		add_action( 'envira_gallery_settings_standalone_tab_notice', [ $this, 'standalone_settings_saved_notice' ] );
	}

	/**
	 * Outputs a message to tell the user that the nonce field is invalid
	 *
	 * @since 1.5.7.3
	 */
	public function standalone_settings_nonce_notice() {

		?>
		<div class="notice error below-h2">
			<p><?php esc_html_e( 'The nonce field is invalid.', 'envira-standalone' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Outputs a message to tell the user that the slug has been saved
	 *
	 * @since 1.5.7.3
	 */
	public function standalone_settings_saved_notice() {

		?>
		<div class="notice updated below-h2">
			<p><?php esc_html_e( 'Slug updated successfully!', 'envira-standalone' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Outputs a message to tell the user that the slugs must be unique
	 *
	 * @since 1.5.7.3
	 */
	public function standalone_settings_unique_slugs() {

		?>
		<div class="notice error below-h2">
			<p><?php echo ( esc_html__( 'The gallery slug and album link must be unique.', 'envira-standalone' ) ); ?></p>
		</div>
		<?php
	}

	/**
	 * Outputs a message to tell the user that the slug is missing, contains invalid characters or is already taken
	 *
	 * @since 1.5.7.3
	 */
	public function standalone_settings_slug_notice() {

		?>
		<div class="notice error below-h2">
			<p><?php esc_html_e( 'The slug is either missing, contains invalid characters or used by a Post Type. Please enter a different slug.', 'envira-standalone' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Outputs a WordPress style notification to tell the user settings were saved
	 *
	 * @since 1.7.0
	 */
	public function updated_settings() {

		?>
		<div class="notice updated below-h2">
			<p><strong><?php esc_html_e( 'Settings saved successfully.', 'envira-gallery' ); ?></strong></p>
		</div>
		<?php
	}


	/**
	 * Register and enqueue settings page specific CSS.
	 *
	 * @since 1.7.0
	 */
	public function enqueue_admin_settings_styles() {

		wp_register_style( ENVIRA_SLUG . '-settings-style', plugins_url( 'assets/css/settings.css', ENVIRA_FILE ), [], ENVIRA_VERSION );
		wp_enqueue_style( ENVIRA_SLUG . '-settings-style' );

		// Run a hook to load in custom styles.
		do_action( 'envira_gallery_settings_styles' );
	}


	/**
	 * Register and enqueue settings page specific CSS.
	 *
	 * @since 1.7.0
	 */
	public function enqueue_admin_styles() {

		// Run a hook to load in custom styles.
		do_action( 'envira_gallery_admin_styles' );
	}

	/**
	 * Register and enqueue settings page specific JS.
	 *
	 * @since 1.7.0
	 */
	public function enqueue_admin_scripts() {

		// Tabs.
		wp_register_script( ENVIRA_SLUG . '-tabs-script', plugins_url( 'assets/js/tabs.js', ENVIRA_FILE ), [ 'jquery' ], ENVIRA_VERSION, true );
		wp_enqueue_script( ENVIRA_SLUG . '-tabs-script' );

		// Settings.
		wp_register_script( ENVIRA_SLUG . '-settings-script', plugins_url( 'assets/js/settings.js', ENVIRA_FILE ), [ 'jquery', 'jquery-ui-tabs' ], ENVIRA_VERSION, true );
		wp_enqueue_script( ENVIRA_SLUG . '-settings-script' );
		wp_localize_script(
			ENVIRA_SLUG . '-settings-script',
			'envira_gallery_settings',
			[
				'active'           => __( 'Status: Active', 'envira-gallery' ),
				'activate'         => __( 'Activate', 'envira-gallery' ),
				'activate_nonce'   => wp_create_nonce( 'envira-gallery-activate' ),
				'activating'       => __( 'Activating...', 'envira-gallery' ),
				'ajax'             => admin_url( 'admin-ajax.php' ),
				'deactivate'       => __( 'Deactivate', 'envira-gallery' ),
				'deactivate_nonce' => wp_create_nonce( 'envira-gallery-deactivate' ),
				'deactivating'     => __( 'Deactivating...', 'envira-gallery' ),
				'inactive'         => __( 'Status: Inactive', 'envira-gallery' ),
				'install'          => __( 'Install', 'envira-gallery' ),
				'install_nonce'    => wp_create_nonce( 'envira-gallery-install' ),
				'installing'       => __( 'Installing...', 'envira-gallery' ),
				'proceed'          => __( 'Proceed', 'envira-gallery' ),
			]
		);

		// Run a hook to load in custom scripts.
		do_action( 'envira_gallery_settings_scripts' );
	}

	/**
	 * Callback to output the Envira settings page.
	 *
	 * @since 1.7.0
	 */
	public function settings_page() {

		do_action( 'envira_head' );

		?>

		<!-- Tabs -->
		<h2 id="envira-tabs-nav" class="envira-tabs-nav" data-container="#envira-gallery-settings" data-update-hashbang="1">
			<?php
			$i = 0;
			foreach ( (array) $this->get_envira_settings_tab_nav() as $id => $title ) {
				$class = ( 0 === $i ? 'envira-active' : '' );
				?>
				<a class="nav-tab <?php echo esc_html( $class ); ?>" href="#envira-tab-<?php echo esc_attr( $id ); ?>" title="<?php echo esc_attr( $title ); ?>">
					<?php echo wp_kses( $title, [ 'span' => [ 'class' => [] ] ] ); ?>
				</a>
				<?php
				++$i;
			}
			?>
		</h2>

		<!-- Tab Panels -->
		<div id="envira-gallery-settings" class="wrap">
			<h1 class="envira-hideme"></h1>
			<div class="envira-gallery envira-clear">
				<div id="envira-tabs" class="envira-clear" data-navigation="#envira-tabs-nav">
					<?php
					$i = 0;
					foreach ( (array) $this->get_envira_settings_tab_nav() as $id => $title ) {
						$class = ( 0 === $i ? 'envira-active' : '' );
						?>
						<div id="envira-tab-<?php echo esc_attr( $id ); ?>" class="envira-tab envira-clear <?php echo esc_attr( $class ); ?>">
							<?php do_action( 'envira_gallery_tab_settings_' . $id ); ?>
						</div>
						<?php
						++$i;
					}
					?>
				</div>
			</div>
		</div>

		<?php
	}

	/**
	 * Callback for getting all of the settings tabs for Envira.
	 *
	 * @since 1.7.0
	 *
	 * @return array Array of tab information.
	 */
	public function get_envira_settings_tab_nav() {

		$tabs = [
			'general'    => __( 'General', 'envira-gallery' ), // This tab is required. DO NOT REMOVE VIA FILTERING.
			'standalone' => __( 'Standalone', 'envira-gallery' ),

		];
		$tabs = apply_filters( 'envira_gallery_settings_tab_nav', $tabs );

		// Make sure debug is always last
		// $tabs['debug'] = __( 'System Info', 'envira-gallery' );.
		return $tabs;
	}

	/**
	 * Callback for displaying the UI for general settings tab.
	 *
	 * @since 1.7.0
	 */
	public function settings_general_tab() {

		// Get settings.
		$media_position = envira_get_setting( 'media_position' );
		$image_delete   = envira_get_setting( 'image_delete' );
		$media_delete   = envira_get_setting( 'media_delete' );
		$loader_color   = ( ! empty( envira_get_setting( 'loader_color' ) ) ) ? envira_get_setting( 'loader_color' ) : '#000000';
		$beta_enabled   = envira_get_setting( 'beta_enabled' );
		$type           = envira_get_license_key_type();

		?>
		<div id="envira-settings-general">
			<?php
			// Output any notices now.
			do_action( 'envira_gallery_settings_general_tab_notice' );
			?>

			<table class="form-table">
				<tbody>
					<tr id="envira-image-gallery-settings-title" class="title">
							<th scope="row" colspan="2">
								<label for="envira-image-delete"><?php esc_html_e( 'License', 'envira-gallery' ); ?></label>
								<h6><?php esc_html_e( 'Your license key provides access to updates and addons.', 'envira-gallery' ); ?></h6>
							</th>
					</tr>
					<tr id="envira-settings-key-box">
						<th scope="row">
							<label for="envira-settings-key"><?php echo esc_html( apply_filters( 'envira_whitelabel_name', 'Envira' ) ); ?><?php esc_html_e( ' License Key', 'envira-gallery' ); ?></label>
						</th>
						<td>
							<form id="envira-settings-verify-key" method="post">
								<input type="password" name="envira-license-key" id="envira-settings-key" value="<?php echo esc_attr( envira_get_license_key() ? envira_get_license_key() : '' ); ?>" />
								<?php wp_nonce_field( 'envira-gallery-key-nonce', 'envira-gallery-key-nonce' ); ?>
								<?php submit_button( __( 'Verify Key', 'envira-gallery' ), 'primary', 'envira-gallery-verify-submit', false ); ?>
								<?php submit_button( __( 'Deactivate Key', 'envira-gallery' ), 'secondary', 'envira-gallery-deactivate-submit', false ); ?>
								<?php if ( empty( $type ) ) { ?>
								<p class="description"><?php esc_html_e( 'License Key to Activate ', 'envira-gallery' ); ?><?php echo esc_html( apply_filters( 'envira_whitelabel_name', 'Envira' ) ); ?></p>
								<?php } else { ?>
								<p class="licence-type"><span class="envira-license-type"><?php esc_html_e( 'Your license key type for this site is ', 'envira-gallery' ); ?><strong><?php echo esc_attr( envira_get_license_key_type() ); ?>.</strong></p>
								<form id="envira-settings-key-type" method="post">
									<?php /* translators: %s: license key */ ?>
									<input type="hidden" name="envira-license-key" value="<?php echo esc_html( envira_get_license_key() ); ?>" />
									<?php wp_nonce_field( 'envira-gallery-key-nonce', 'envira-gallery-key-nonce' ); ?>
									<p class="description"><?php esc_html_e( 'If your license has been upgraded or the type is incorrect, ', 'envira-gallery' ); ?>
										<?php submit_button( __( 'refresh key', 'envira-gallery' ), 'button-nostyle', 'envira-gallery-refresh-submit', false ); ?>.
									</p>
								</form>
								<?php } ?>
							</form>
						</td>
					</tr>

				</tbody>
			</table>

			<!-- <hr /> -->

			<!-- Settings Form -->
			<form id="envira-media-delete" method="post">
				<table class="form-table">
					<tbody>

						<!-- Title -->
						<tr id="envira-image-gallery-settings-title" class="title">
							<th scope="row" colspan="2">
								<label for="envira-image-delete"><?php esc_html_e( 'Gallery', 'envira-gallery' ); ?></label>
							</th>
						</tr>

						<!-- Media Position -->
						<tr id="envira-media-position-box">
							<th scope="row">
								<label for="envira-media-position"><?php esc_html_e( 'Add New Images', 'envira-gallery' ); ?></label>
							</th>
							<td>
								<select id="envira-media-position" name="envira_media_position">
									<?php foreach ( (array) envira_get_media_positions() as $i => $data ) : ?>
										<option value="<?php echo esc_attr( $data['value'] ); ?>"<?php selected( $data['value'], $media_position ); ?>><?php echo esc_html( $data['name'] ); ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description"><?php esc_html_e( 'When adding media to a Gallery, choose whether to add this media before or after any existing images.', 'envira-gallery' ); ?></p>
							</td>
						</tr>


						<!-- Delete Media -->
						<tr id="envira-image-delete-box">
							<th scope="row">
								<label for="envira-image-delete"><?php esc_html_e( 'Delete Image on Gallery Image Deletion', 'envira-gallery' ); ?></label>
							</th>
							<td>
								<select id="envira-image-delete" name="envira_image_delete">
									<?php foreach ( (array) envira_get_media_delete_options() as $i => $data ) : ?>
										<option value="<?php echo esc_attr( $data['value'] ); ?>"<?php selected( $data['value'], $image_delete ); ?>><?php echo esc_html( $data['name'] ); ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description"><?php esc_html_e( 'When deleting an Image from a Gallery, choose whether to delete all media associated with that image. Note: If image(s) in the Media Library are attached to other Posts, they will not be deleted.', 'envira-gallery' ); ?></p>
							</td>
						</tr>

						<tr id="envira-media-delete-box">
							<th scope="row">
								<label for="envira-media-delete"><?php esc_html_e( 'Delete Images on Gallery Deletion', 'envira-gallery' ); ?></label>
							</th>
							<td>
								<select id="envira-media-delete" name="envira_media_delete">
									<?php foreach ( (array) envira_get_media_delete_options() as $i => $data ) : ?>
										<option value="<?php echo esc_html( $data['value'] ); ?>"<?php selected( $data['value'], $media_delete ); ?>><?php echo esc_html( $data['name'] ); ?></option>
									<?php endforeach; ?>
								</select>
								<p class="description"><?php esc_html_e( 'When deleting a Gallery, choose whether to delete all media associated with the gallery. Note: If image(s) in the Media Library are attached to other Posts, they will not be deleted.', 'envira-gallery' ); ?></p>
							</td>
						</tr>

						<tr id="envira-media-loader-color-box">
							<th scope="row">
								<label for="envira-media-loader-color"><?php esc_html_e( 'Customize Loading Graphic Color', 'envira-gallery' ); ?></label>
							</th>
							<td>
								<input type="text" name="envira_gallery_loader_color" id="envira-gallery-loader-color"  value="<?php echo esc_attr( $loader_color ); ?>" class="envira-loader-color-field" data-default-color="#000000" />
								<p class="description"><?php esc_html_e( 'By default the loader showing an Envira gallery loading on a page is black (#000000). You can override this by entering a hexcolor here.', 'envira-gallery' ); ?></p>
							</td>
						</tr>

						<!-- Beta -->
						<?php $can_beta = get_option( 'envira_can_beta', false ); if ( ! empty( $can_beta ) ) : ?>
						<tr id="envira-enable-beta-box">
							<th scope="row">
								<label for="envira-enable-beta"><?php esc_html_e( 'Enable Envira Gallery Beta', 'envira-gallery' ); ?></label>
							</th>
							<td>
								<input name="envira_beta_enabled" label="envira-enable-beta" type="checkbox" value="1" <?php checked( true, $beta_enabled ); ?> ><label><?php esc_html_e( 'Enable Beta', 'envira-gallery' ); ?></label>
								<p class="description"><?php esc_html_e( 'Recommended not to use on live websites as it may cause possible issues.', 'envira-gallery' ); ?></p>
							</td>
						</tr>
						<?php endif; ?>

						<?php do_action( 'envira_gallery_settings_general_box' ); ?>
					</tbody>
				</table>

				<?php wp_nonce_field( 'envira-gallery-settings-nonce', 'envira-gallery-settings-nonce' ); ?>
				<?php submit_button( __( 'Save Settings', 'envira-gallery' ), 'primary', 'envira-gallery-settings-submit', false ); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Callback for displaying the UI for standalone settings tab.
	 *
	 * @since 1.7.0
	 */
	public function settings_standalone_tab() {

		// Get slugs.
		$enabled = envira_get_setting( 'standalone_enabled' );
		$slug    = envira_standalone_get_the_slug( 'gallery' );
		if ( is_plugin_active( 'envira-albums/envira-albums.php' ) ) {
			$album_slug = envira_standalone_get_the_slug( 'albums' );
		}

		?>
		<div id="envira-settings-standalone">
			<?php
			// Output notices.
			do_action( 'envira_gallery_settings_standalone_tab_notice' );
			?>

			<table class="form-table">
				<tbody>
					<form action="edit.php?post_type=envira&page=envira-gallery-settings#!envira-tab-standalone" method="post">
						<tr id="envira-settings-standalone-enable">
							<th scope="row">
								<label for="envira-standalone-enable"><?php esc_html_e( 'Enable Standalone', 'envira-standalone' ); ?></label>
							</th>
							<td>
								<p class="description">
									<label for="envira-standalone-enable">
										<input type="checkbox" name="envira-standalone-enable" id="envira-standalone-enable" value="1" <?php checked( true, $enabled ); ?> />
										<?php wp_nonce_field( 'envira-standalone-nonce', 'envira-standalone-nonce' ); ?>
										<?php esc_html_e( 'The standalone option allows you to access galleries created through the ', 'envira-standalone' ); ?><?php esc_html( apply_filters( 'envira_whitelabel_name', 'Envira' ) ); ?><?php esc_html_e( ' post type with unique URLs. Now your galleries can have dedicated gallery pages!', 'envira-gallery' ); ?>
									</label>
								</p>
							</td>
						</tr>

						<tr id="envira-settings-slug-box-gallery">
							<th scope="row">
								<label for="envira-gallery-slug"><?php esc_html_e( 'Gallery Slug ', 'envira-standalone' ); ?></label>
							</th>
							<td>
								<input type="text" name="envira-gallery-slug" id="envira-gallery-slug" value="<?php echo esc_attr( $slug ); ?>" />
								<p class="description">
									<?php
									printf(
										// translators: %s: Envira white label.
										esc_html__(
											'The slug to prefix to all %s Galleries.',
											'envira-standalone'
										),
										esc_html( apply_filters( 'envira_whitelabel_name', 'Envira' ) )
									);
									?>
								</p>
								<?php esc_html_e( 'Example: ', 'envira-standalone' ); ?>
								<?php echo bloginfo( 'url' ) . '/' . esc_html( $slug ) . '/'; ?><?php esc_html_e( 'example-gallery', 'envira-standalone' ); ?>.
								</p>
							</td>
						</tr>

						<?php if ( is_plugin_active( 'envira-albums/envira-albums.php' ) ) { ?>

						<tr id="envira-settings-slug-box-albums">
							<th scope="row">
								<label for="envira-albums-slug"><?php esc_html_e( 'Album Slug ', 'envira-standalone' ); ?></label>
							</th>
							<td>
								<input type="text" name="envira-albums-slug" id="envira-albums-slug" value="<?php echo esc_attr( $album_slug ); ?>" />
								<p class="description">
								<?php
								echo esc_html( 'The slug to prefix to all ' . apply_filters( 'envira_whitelabel_name', 'Envira' ) . ' Albums.' );
								?>
								<?php esc_html_e( 'Example: ', 'envira-standalone' ); ?>
								<?php echo bloginfo( 'url' ) . '/' . esc_html( $album_slug ) . '/'; ?><?php esc_html_e( 'example-album', 'envira-standalone' ); ?>.
								</p>
							</td>
						</tr>

						<?php } ?>

						<tr>
							<th scope="row"><?php submit_button( __( 'Save', 'envira-gallery' ), 'primary', 'envira-gallery-verify-submit', false ); ?></th>
							<td>&nbsp;</td>
						</tr>
					</form>
				</tbody>
			</table>
		</div>
		<?php
	}

	/**
	 * Callback for displaying the UI for debug tab.
	 *
	 * @since 1.5.7.3
	 */
	public function settings_debug_tab() {

		// Get slugs.
		$enabled = envira_get_setting( 'standalone_enabled' );
		?>
		<div id="envira-settings-debug">
			<?php
			// Output notices.
			do_action( 'envira_gallery_settings_standalone_tab_notice' );
			?>

			<?php do_action( 'envira_gallery_debug_screen_output' ); ?>

		</div>
		<?php
	}

	/**
	 * Retrieve the plugin basename from the plugin slug.
	 *
	 * @since 1.7.0
	 *
	 * @param string $slug The plugin slug.
	 * @return string         The plugin basename if found, else the plugin slug.
	 */
	public function get_plugin_basename_from_slug( $slug ) {

		$keys = array_keys( get_plugins() );

		foreach ( $keys as $key ) {
			if ( preg_match( '|^' . $slug . '|', $key ) ) {
				return $key;
			}
		}

		return $slug;
	}

	/**
	 * Add Settings page to plugin action links in the Plugins table.
	 *
	 * @since 1.7.0
	 *
	 * @param array $links  Default plugin action links.
	 * @return array $links Amended plugin action links.
	 */
	public function settings_link( $links ) {

		$settings_link = sprintf(
			'<a href="%s">%s</a>',
			esc_url(
				add_query_arg(
					[
						'post_type' => 'envira',
						'page'      => 'envira-gallery-settings',
					],
					admin_url( 'edit.php' )
				)
			),
			__( 'Settings', 'envira-gallery' )
		);
		array_unshift( $links, $settings_link );

		return $links;
	}

	/**
	 * Debug Screen function.
	 *
	 * @access public
	 * @return void
	 */
	public function debug_screen_output() {

		$browser = new \Envira\Utils\Browser();

		$theme_data = wp_get_theme();
		$theme      = $theme_data->Name . ' ' . $theme_data->Version; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

		// Try to identify the hosting provider.
		$host = false;

		if ( defined( 'WPE_APIKEY' ) ) {
			$host = 'WP Engine';
		} elseif ( defined( 'PAGELYBIN' ) ) {
			$host = 'Pagely';
		}

		$request['cmd'] = '_notify-validate';

		$params = [
			'sslverify' => false,
			'timeout'   => 60,
			'body'      => $request,
		];

		$response = wp_remote_post( 'https://www.paypal.com/cgi-bin/webscr', $params );

		if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
			$wp_remote_post = 'wp_remote_post() works' . "\n";
		} else {
			$wp_remote_post = 'wp_remote_post() does not work' . "\n";
		}

		?>

		<div class="wrap">
				<div id="templateside">
					<p class="instructions"><?php esc_html_e( 'The information provided on this screen is intended to be shared with Envira Gallery when opening a new support ticket.', 'send-system-info' ); ?></p>
					<p class="instructions"><?php esc_html_e( 'This information can be downloaded as a text file, then uploaded to the support ticket.', 'send-system-info' ); ?></p>
					<p class="instructions"><a target="_blank" href="https://enviragallery.com/docs/"><?php esc_html_e( 'See our documentation', 'envira-gallery' ); ?></a><?php esc_html_e( 'for more details.', 'send-system-info' ); ?></p>
				</div>
				<div id="template">
					<?php // Form used to download .txt file. ?>
					<form action="<?php echo esc_url( self_admin_url( 'admin-ajax.php' ) ); ?>" method="post" enctype="multipart/form-data" >
						<input type="hidden" name="action" value="download_system_info" />
						<?php wp_nonce_field( 'download-system-info', 'envira-sys-info' ); ?>
						<div>

						<?php

							envira_load_admin_partial(
								'settings-debug-output',
								[
									'instance'  => $this,
									'browser'   => $browser,
									'theme'     => $theme,
									'host'      => $host,
									'wp_remote' => $wp_remote_post,

								]
							);
						?>

						</div>
						<p class="submit">
							<input type="submit" class="button button-primary" value="<?php esc_html_e( 'Download System Info as Text File', 'send-system-info' ); ?>" />
						</p>
					</form>
				</div>
		</div>

		<?php
	}

	/**
	 * Generate Text file download
	 *
	 * @since 1.7.0
	 *
	 * @return void
	 */
	public function debug_download_info() {
		if ( ! isset( $_POST['envira-sys-info'] ) || ! wp_verify_nonce( sanitize_key( $_POST['envira-sys-info'] ), 'download-system-info' ) ) {
			return;
		}

		if ( empty( $_POST['send-system-info-textarea'] ) ) {
			return;
		}

		header( 'Content-type: text/plain' );

		// Text file name marked with Unix timestamp.
		header( 'Content-Disposition: attachment; filename=system_info_' . time() . '.txt' );

		// phpcs:ignore -- Intentionally not escaped and not sanitized.
		echo $_POST['send-system-info-textarea'];
		die();
	}

	/**
	 * Outputs a WordPress style notification to tell the user how many galleries were
	 * fixed after running the migration fixer
	 *
	 * @since 1.7.0
	 */
	/**
	 * Outputs a WordPress style notification to tell the user how many galleries were
	 * fixed after running the migration fixer
	 *
	 * @since 1.7.0
	 */
	public function fixed_migration() {

		global $fixed_galleries;

		?>
		<div class="notice updated below-h2">
			<p><strong><?php echo esc_html( $fixed_galleries ) . esc_html__( ' galleries(s) fixed successfully.', 'envira-gallery' ); ?></strong></p>
		</div>
		<?php
	}

	/**
	 * Outputs JS needed for some Envira admin screens.
	 *
	 * @since 1.7.0
	 */
	public function add_settings_js() {
		global $current_screen;
		if ( 'envira_page_envira-gallery-settings' !== $current_screen->id ) {
			return;
		}
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.envira-loader-color-field').wpColorPicker();
		});
		</script>
		<?php
	}
}
