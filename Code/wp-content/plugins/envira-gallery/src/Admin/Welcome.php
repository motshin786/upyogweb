<?php
/**
 * Welcome class.
 *
 * @since 1.8.1
 *
 * @package Envira_Gallery
 * @author  Envira Gallery Team
 */

namespace Envira\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Welcome Class
 *
 * @since 1.7.0
 *
 * @package Envira_Gallery
 * @author  Envira Gallery Team <support@enviragallery.com>
 */
class Welcome {

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
	 * @since 1.8.1
	 */
	public function __construct() {

		// Add custom addons submenu.
		add_action( 'admin_menu', [ $this, 'admin_menu' ], 15 );

		// Add custom CSS class to body.
		add_filter( 'admin_body_class', [ $this, 'admin_welcome_css' ], 15 );

		// Add scripts and styles.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_styles' ] );

		// Misc.
		add_action( 'admin_print_scripts', [ $this, 'disable_admin_notices' ] );

		// Global notice.
		add_action( 'admin_notices', [ $this, 'global_notice' ] );
	}

	/**
	 * Add custom CSS to admin body tag.
	 *
	 * @since 1.8.1
	 * @param array $classes CSS Classes.
	 * @return array
	 */
	public function admin_welcome_css( $classes ) {

		if ( ! is_admin() ) {
			return;
		}

		$classes .= ' envira-welcome-enabled ';

		$upgrade_pages = [ 'envira-gallery-upgrade' ];

		if ( isset( $_GET['post_type'] ) && isset( $_GET['page'] ) && 'envira' === sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) && in_array( wp_unslash( $_GET['page'] ), $upgrade_pages, true ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$license = esc_attr( envira_get_license_key_type() );
			if ( ! $license ) {
				$license = 'basic';
			}

			$classes .= ' envira-upgrade-page ';
			$classes .= ' envira-license-' . $license;

		}

		return $classes;
	}

	/**
	 * Register and enqueue addons page specific CSS.
	 *
	 * @since 1.8.1
	 */
	public function enqueue_admin_styles() {

		$welcome_pages = [ 'envira-gallery-get-started', 'envira-gallery-welcome', 'envira-gallery-support', 'envira-gallery-changelog', 'envira-gallery-upgrade' ];

		if ( isset( $_GET['post_type'] ) && isset( $_GET['page'] ) && 'envira' === sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) && in_array( wp_unslash( $_GET['page'] ), $welcome_pages, true ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			wp_register_style( ENVIRA_SLUG . '-welcome-style', plugins_url( 'assets/css/welcome.css', ENVIRA_FILE ), [], ENVIRA_VERSION );
			wp_enqueue_style( ENVIRA_SLUG . '-welcome-style' );

		}
	}

	/**
	 * Making page as clean as possible
	 *
	 * @since 1.8.1
	 */
	public function disable_admin_notices() {

		global $wp_filter;

		$welcome_pages = [ 'envira-gallery-get-started', 'envira-gallery-welcome', 'envira-gallery-support', 'envira-gallery-changelog' ];

		if ( isset( $_GET['post_type'] ) && isset( $_GET['page'] ) && 'envira' === sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) && in_array( wp_unslash( $_GET['page'] ), $welcome_pages, true ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			if ( isset( $wp_filter['user_admin_notices'] ) ) {
				unset( $wp_filter['user_admin_notices'] );
			}
			if ( isset( $wp_filter['admin_notices'] ) ) {
				unset( $wp_filter['admin_notices'] );
			}
			if ( isset( $wp_filter['all_admin_notices'] ) ) {
				unset( $wp_filter['all_admin_notices'] );
			}
		}
	}

	/**
	 * Register the Welcome submenu item for Envira.
	 *
	 * @since 1.8.1
	 */
	public function admin_menu() {

		global $submenu;

		$whitelabel = apply_filters( 'envira_whitelabel', false ) ? '' : __( 'Envira Gallery ', 'envira-gallery' );

		// Register the submenus.
		add_submenu_page(
			'edit.php?post_type=envira',
			$whitelabel . __( 'Overview', 'envira-gallery' ),
			'<span style="color:#FFA500">' . __( 'Overview', 'envira-gallery' ) . '</span>',
			apply_filters( 'envira_gallery_menu_cap', 'manage_options' ),
			ENVIRA_SLUG . '-get-started',
			[ $this, 'help_page' ]
		);

		add_submenu_page(
			'edit.php?post_type=envira',
			$whitelabel . __( 'Welcome', 'envira-gallery' ),
			'<span style="color:#FFA500">' . __( 'Welcome', 'envira-gallery' ) . '</span>',
			apply_filters( 'envira_gallery_menu_cap', 'manage_options' ),
			ENVIRA_SLUG . '-welcome',
			[ $this, 'welcome_page' ]
		);

		add_submenu_page(
			'edit.php?post_type=envira',
			$whitelabel . __( 'Upgrade Envira Gallery', 'envira-gallery' ),
			'<span style="color:#FFA500">' . __( 'Upgrade', 'envira-gallery' ) . '</span>',
			apply_filters( 'envira_gallery_menu_cap', 'manage_options' ),
			ENVIRA_SLUG . '-upgrade',
			[ $this, 'upgrade_page' ],
			999
		);

		/* remove welcome screen from submenu */

		$submenu_remove = [
			'envira-gallery-welcome',
			'envira-gallery-upgrade',
		];

		if ( isset( $submenu['edit.php?post_type=envira'] ) && is_array( $submenu['edit.php?post_type=envira'] ) ) {
			foreach ( $submenu['edit.php?post_type=envira'] as $menu_id => $item ) {
				if ( in_array( $item[2], $submenu_remove, true ) ) {
					unset( $submenu['edit.php?post_type=envira'][ $menu_id ] );

				}
			}
		}
	}

	/**
	 * Output welcome text and badge for What's New and Credits pages.
	 *
	 * @since 1.8.1
	 */
	public static function welcome_text() {

		// Switch welcome text based on whether this is a new installation or not.
		$welcome_text = ( self::is_new_install() )
			? esc_html__( 'Thank you for installing Envira! Envira provides great gallery features for your WordPress site!', 'envira-gallery' )
			/* translators: %s: version */
			: esc_html__( 'Thank you for updating! Envira %s has many recent improvements that you will enjoy.', 'envira-gallery' );

		?>
		<?php /* translators: %s: version */ ?>
		<h1 class="welcome-header"><?php printf( esc_html__( 'Welcome to %1$s Envira Gallery %2$s', 'envira-gallery' ), '<span class="envira-leaf"></span>&nbsp;', esc_html( self::display_version() ) ); ?></h1>

		<div class="about-text">
			<?php
			if ( self::is_new_install() ) {
				echo esc_html( $welcome_text );
			} else {
				printf( esc_html( $welcome_text ), esc_html( self::display_version() ) );
			}
			?>
		</div>

		<?php
	}

	/**
	 * Output tab navigation
	 *
	 * @since 2.2.0
	 *
	 * @param string $tab Tab to highlight as active.
	 */
	public static function tab_navigation( $tab = 'whats_new' ) {

		$license_key = esc_attr( envira_get_license_key_type() );
		if ( ! $license_key ) {
			$license_key = 'basic';
		}
		?>

		<h3 class="nav-tab-wrapper">
			<a class="nav-tab
			<?php
			if ( isset( $_GET['page'] ) && 'envira-gallery-welcome' === sanitize_text_field( wp_unslash( $_GET['page'] ) ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				?>
				nav-tab-active<?php endif; ?>" href="
				<?php
				echo esc_url(
					admin_url(
						add_query_arg(
							[
								'post_type' => 'envira',
								'page'      => 'envira-gallery-welcome',
							],
							'edit.php'
						)
					)
				);
				?>
														">
				<?php esc_html_e( 'What&#8217;s New', 'envira-gallery' ); ?>
			</a>
			<a class="nav-tab
			<?php
			if ( isset( $_GET['page'] ) && 'envira-gallery-get-started' === sanitize_text_field( wp_unslash( $_GET['page'] ) ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				?>
				nav-tab-active<?php endif; ?>" href="
				<?php
				echo esc_url(
					admin_url(
						add_query_arg(
							[
								'post_type' => 'envira',
								'page'      => 'envira-gallery-get-started',
							],
							'edit.php'
						)
					)
				);
				?>
														">
				<?php esc_html_e( 'Get Started', 'envira-gallery' ); ?>
			</a>
			<a class="nav-tab
			<?php
			if ( 'envira-gallery-addons' === sanitize_text_field( wp_unslash( $_GET['page'] ) ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				?>
				nav-tab-active<?php endif; ?>" href="
				<?php
				echo esc_url(
					admin_url(
						add_query_arg(
							[
								'post_type' => 'envira',
								'page'      => 'envira-gallery-addons',
							],
							'edit.php'
						)
					)
				);
				?>
														">
				<?php esc_html_e( 'Addons', 'envira-gallery' ); ?>
			</a>
			<?php
			if ( empty( $license_key ) || 'basic' === $license_key || 'plus' === $license_key ) {
				?>
			<a class="nav-tab
				<?php
				if ( 'envira-gallery-upgrade' === sanitize_text_field( wp_unslash( $_GET['page'] ) ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended
					?>
				nav-tab-active<?php endif; ?>" href="
				<?php
				echo esc_url(
					admin_url(
						add_query_arg(
							[
								'post_type' => 'envira',
								'page'      => 'envira-gallery-upgrade',
							],
							'edit.php'
						)
					)
				);
				?>
														">
				<?php echo esc_html( ucfirst( $license_key ) ); ?> <?php esc_html_e( ' vs Pro', 'envira-gallery' ); ?>
			</a>
			<?php } ?>

		</h3>

		<?php
	}

	/**
	 * Output the sidebar.
	 *
	 * @since 1.8.5
	 */
	public function sidebar() {

		global $wp_version;

		?>

			<div class="envira-welcome-sidebar">

				<?php

				if ( version_compare( PHP_VERSION, '5.6.0', '<' ) ) {

					?>

					<div class="sidebox warning php-warning">

					<h4><?php esc_html_e( 'Please Upgrade Your PHP Version!', 'envira-gallery' ); ?></h4>
					<p><?php echo wp_kses( 'Your hosting provider is using PHP <strong>' . PHP_VERSION . '</strong>, an outdated and unsupported version. Soon Envira Gallery will need a minimum of PHP <strong>5.6</strong>.', wp_kses_allowed_html( 'post' ) ); ?></p>
					<a target="_blank" href="https://enviragallery.com/docs/update-php" class="button button-primary">Learn More</a>

					</div>

				<?php } ?>

				<?php

				if ( ! empty( $wp_version ) && version_compare( $wp_version, '4.8', '<' ) ) {

					?>

				<div class="sidebox warning php-warning">

					<h4><?php esc_html_e( 'Please Upgrade Your WordPress Version!', 'envira-gallery' ); ?></h4>
					<p><?php echo wp_kses( 'You are currently using WordPress <strong>' . $wp_version . '</strong>, an outdated version. Soon Envira Gallery will need a minimum of WordPress <strong>4.8</strong>.', wp_kses_allowed_html( 'post' ) ); ?></p>
					<a target="_blank" href="https://enviragallery.com/docs/update-wordpress" class="button button-primary">Learn More</a>

				</div>

				<?php } ?>

				<?php

				if ( class_exists( 'Envira_Gallery' ) && envira_get_license_key() === false ) {

					?>

				<div class="sidebox">
					<form id="envira-settings-verify-key" method="post" action="<?php echo esc_url( admin_url( 'edit.php?post_type=envira&page=envira-gallery-settings' ) ); ?>">
						<h4><?php esc_html_e( 'Activate License Key', 'envira-gallery' ); ?></h4>
						<p><?php esc_html_e( 'License key to enable automatic updates for Envira.', 'send-system-info' ); ?></p>
						<input type="password" name="envira-license-key" id="envira-settings-key" value="" />
						<?php wp_nonce_field( 'envira-gallery-key-nonce', 'envira-gallery-key-nonce' ); ?>
						<?php submit_button( __( 'Verify Key', 'envira-gallery' ), 'primary', 'envira-gallery-verify-submit', false ); ?>
					</form>
				</div>

					<?php

				}
				?>
				<?php

				$url = 'https://wordpress.org/support/plugin/envira-gallery-lite/reviews/';

				?>
					<div class="sidebox">

							<h4><?php esc_html_e( 'We Need Your Help', 'envira-gallery' ); ?></h4>
							<?php /* translators: %1$s: url, %2$s url */ ?>
							<p><?php printf( wp_kses_post( __( 'Please rate <strong>Envira Gallery</strong> <a href="%1$s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%2$s" target="_blank">WordPress.org</a> to help us spread the word. Thank you from the Envira Gallery team!', 'envira-gallery' ) ), esc_url( $url ), esc_url( $url ) ); ?></p>
							<a target="_blank" href="<?php echo esc_url( $url ); ?>" class="button button-primary">Rate It</a>

					</div>
				<div class="sidebox">
					<form action="https://enviragallery.us3.list-manage.com/subscribe/post?u=beaa9426dbd898ac91af5daca&amp;id=2ee2b5572e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<h4><?php esc_html_e( 'Newsletter Signup', 'send-system-info' ); ?></h4>
						<p><?php esc_html_e( 'Get periodic updates, developer notices, special discounts, and invites to our exclusive beta programs.', 'send-system-info' ); ?></p>
						<div class="form-row"><input type="text" value="" name="FNAME" placeholder="Name" id="mce-FNAME"></div>
						<div class="form-row"><input type="email" placeholder="Email" name="EMAIL" required /></div>

						<input type="submit" class="button button-primary" value="Sign Up" />
					</form>
				</div>
				<div class="sidebox">
					<form action="https://enviragallery.com/account/support/" method="post" target="_blank">
						<h4><?php esc_html_e( 'Get Support', 'send-system-info' ); ?></h4>
						<p><?php esc_html_e( 'New to Envira? Our Knowledge Base has over 20 video tutorials, from installing Envira to working with addons and more.', 'send-system-info' ); ?></p>
						<input type="submit" value="Visit Our Support Center" class="button button-primary" />
					</form>
				</div>
			</div>


		<?php
	}

	/**
	 * Output the about screen.
	 *
	 * @since 1.8.5
	 */
	public function welcome_page() {
		?>

		<div class="envira-welcome-wrap envira-welcome">

				<div class="envira-title">

					<?php self::welcome_text(); ?>

				</div>

				<div class="envira-welcome-main">

					<?php self::tab_navigation( __METHOD__ ); ?>

					<div class="envira-welcome-panel">

						<div class="wraps about-wsrap">

							<?php if ( self::is_new_install() ) : ?>


							<?php endif; ?>

							<div class="envira-recent-section top-section">

								<h3 class="headline-title"><?php esc_html_e( 'Envira Gallery is the most beginner-friendly drag &amp; drop WordPress gallery plugin.', 'envira-gallery-lite' ); ?></h3>

							</div>

							<h3 class="title"><?php esc_html_e( 'Recent Updates To Envira Pro:', 'envira-gallery-lite' ); ?></h3>

							<div class="envira-recent-section last-section">

								<div class="envira-feature">
									<img class="icon" src="https://enviragallery.com/wp-content/uploads/2015/08/drag-drop-icon.png" />
									<h4 class="feature-title"><?php esc_html_e( 'Getting Better And Better!', 'envira-gallery-lite' ); ?></h4>
									<?php /* translators: %1$s: url, %2$s url */ ?>
									<p><?php printf( esc_html__( 'This latest update contains enhancements and improvements - some of which are based on your user feedback! Check out %1$s.', 'envira-gallery-lite' ), '<a target="_blank" href="' . esc_url( $this->default_link( 'https://enviragallery.com/docs/how-to-configure-your-gallery-settings', 'whatsnewtab', 'checkoutourchangelog', '#envira-changelog' ) ) . '">our changelog</a>' ); ?></p>
								</div>

								<div class="envira-feature opposite">
								<img class="icon" src="https://enviragallery.com/wp-content/uploads/2015/10/proofing-icon.png" />
									<h4 class="feature-title">
										<?php esc_html_e( 'Proofing Addon', 'envira-gallery-lite' ); ?>
										<span class="badge new">UPDATED</span>
									</h4>
									<p>
										<?php /* translators: %1$s: url, %2$s url */ ?>
										<?php printf( esc_html__( 'New and improved features and functions make client image proofing even easier for your photography business.', 'envira-gallery-lite' ) ); ?>
										</p>
								</div>

								<div class="envira-feature">
								<img class="icon" src="<?php echo esc_url( plugins_url( 'assets/images/automatic-layout.png', ENVIRA_FILE ) ); ?>" />
									<h4 class="feature-title">
										<?php esc_html_e( 'Gallery Layouts', 'envira-gallery-lite' ); ?>
										<span class="badge new">NEW</span>
									</h4>
									<p>
										<?php /* translators: %1$s: url, %2$s url */ ?>
										<?php printf( esc_html__( 'Envira Gallery has even more gallery layouts to help you create and customize your photo and video galleries.', 'envira-gallery-lite' ) ); ?>
										</p>
								</div>

								<div class="envira-feature opposite">
								<img class="icon" src="https://enviragallery.com/wp-content/uploads/2015/10/gallery-templates-icon.png" />
								<h4 class="feature-title"><?php esc_html_e( 'Lightbox Themes', 'envira-gallery-lite' ); ?> <span class="badge updated">NEW</span> </h4>
								<?php /* translators: %1$s: button */ ?>
								<p><?php printf( esc_html__( 'Four new lightbox themes give you the ability to customize your photo and video galleries even further! %s', 'envira-gallery-lite' ), '<a target="_blank" href="' . esc_url( $this->default_link( 'https://enviragallery.com/make-your-galleries-even-more-attractive-with-new-lightbox-themes', 'whatsnewtab', 'newlightboxthemesreadmore', '' ) ) . '">Read More</a>' ); ?></p>
								</div>

							</div>

							<?php $this->envira_assets(); ?>

						</div>

					</div>

				</div>

				<?php $this->sidebar(); ?>

		</div> <!-- wrap -->

		<?php
	}

	/**
	 * Output the about screen.
	 *
	 * @since 1.8.1
	 */
	public function help_page() {
		?>

		<div class="envira-welcome-wrap envira-help">

			<div class="envira-title">

				<?php self::welcome_text(); ?>

			</div>

			<?php $this->sidebar(); ?>

			<div class="envira-get-started-main">

				<?php self::tab_navigation( __METHOD__ ); ?>

				<div class="envira-get-started-section">

						<div class="envira-admin-get-started-panel">

							<div class="section-text text-left">

								<h2>Creating your first gallery</h2>

								<p>Want to get started creating your first gallery? By following the step by step instructions in this walkthrough, you can easily publish your first gallery on your site.</p>

								<p>To begin, you’ll need to be logged into the WordPress admin area. Once there, click on Envira Gallery in the admin sidebar to go the Add New page.</p>

								<p>This will launch the Envira Gallery Builder.</p>

								<ul class="list-of-links">
									<li><a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/docs/creating-first-envira-gallery', 'gettingstartedtab', 'howtocreateyourfirstgallery', '' ) ); ?>">How to create your first gallery</a></li>
									<li><a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-upload-photos-directly-from-lightroom-to-wordpress/', 'gettingstartedtab', 'createandsynchronizelightroomwithwordpress', '' ) ); ?>">How to create and synchronize your Adobe Lightroom Collections with WordPress</a></li>
									<li><a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-protect-your-website-from-image-theft/', 'gettingstartedtab', 'howtoprotectyourgalleriesfromimagetheft', '' ) ); ?>">How to protect your galleries and images from online theft</a></li>
									<li><a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-create-a-woocommerce-product-image-gallery/', 'gettingstartedtab', 'turnphotosintoproductsandmakemoneyfromphotography', '' ) ); ?>">How to turn your photos into products and make money from your photography</a></li>
									<li><a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-optimize-your-wordpress-galleries-for-seo/', 'gettingstartedtab', 'appearhigheringooglesearchresults', '' ) ); ?>">How to appear higher in Google search results so more people find your work</a></li>
									</li>
								</ul>

							</div>

							<div class="feature-photo-column">
									<img class="feature-photo" src="<?php echo esc_url( plugins_url( 'assets/images/get-started/creating.png', ENVIRA_FILE ) ); ?>" />
							</div>

						</div> <!-- panel -->

						<div class="envira-admin-get-started-panel mini-panel">

							<div class="feature-photo-column photo-left">
								<a href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-create-a-masonry-image-gallery-in-wordpress/', 'gettingstartedtab', 'createamasonrygallerybutton', '' ) ); ?>"><img class="feature-photo" src="<?php echo esc_url( plugins_url( 'assets/images/get-started/how-to-create-a-masonry-image-gallery-in-wordpress.jpg', ENVIRA_FILE ) ); ?>" /></a>
							</div>

							<div class="section-text-column text-left">

								<h2>How to Create a Masonry Image Gallery in WordPress</h2>

								<p>Do you want to create a masonry style gallery in WordPress? Sometimes you need to display full-view thumbnails without cropping the height or width. In this tutorial, we will share with you how to create a masonry image gallery in WordPress.</p>

								<div class="banner-button">
									<a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-create-a-masonry-image-gallery-in-wordpress/', 'gettingstartedtab', 'createamasonrygallerybutton', '' ) ); ?>" class="button button-primary">Read Documentation</a>
								</div>

							</div>

						</div> <!-- panel -->

						<div class="envira-admin-get-started-panel mini-panel">

							<div class="feature-photo-column photo-left">
								<a href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-create-an-image-slider-for-your-wordpress-galleries/', 'gettingstartedtab', 'createimageslidersforyourgalleries', '' ) ); ?>"><img class="feature-photo" src="<?php echo esc_url( plugins_url( 'assets/images/get-started/how-to-create-image-slider-for-your-wordpress-galleries.jpg', ENVIRA_FILE ) ); ?>" /></a>
							</div>

							<div class="section-text-column text-left">

								<h2>How to Create an Image Slider for Your WordPress Galleries</h2>

								<p>Do you want to create an image slider in WordPress? Want to display your photo galleries in a slideshow? In this article, we will show you how to create an image slider for your WordPress galleries.</p>

								<div class="banner-button">
									<a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-create-an-image-slider-for-your-wordpress-galleries/', 'gettingstartedtab', 'createimageslidersforyourgalleries', '' ) ); ?>" class="button button-primary">Read Documentation</a>
								</div>

							</div>

						</div> <!-- panel -->

						<div class="envira-admin-get-started-panel mini-panel">

							<div class="feature-photo-column photo-left">
								<a href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/add-gallery-tags-wordpress/', 'gettingstartedtab', 'addgallerytagsinwordpress', '' ) ); ?>"><img class="feature-photo" src="<?php echo esc_url( plugins_url( 'assets/images/get-started/add-gallery-tags-in-wordpress.jpg', ENVIRA_FILE ) ); ?>" /></a>
							</div>

							<div class="section-text-column text-left">

								<h2>How to Make Your Images Easier for Visitors To Find</h2>

								<p>Do you want to add tags to your images in WordPress galleries? With image tagging, you can give your visitors a way to sort through them easily. In this tutorial, we will share how to add gallery tags in WordPress by using Envira Gallery.</p>

								<div class="banner-button">
									<a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/add-gallery-tags-wordpress/', 'gettingstartedtab', 'addgallerytagsinwordpress', '' ) ); ?>" class="button button-primary">Read Documentation</a>
								</div>

							</div>

						</div> <!-- panel -->

						<div class="envira-admin-get-started-panel mini-panel">

							<div class="feature-photo-column photo-left">
								<a href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-customize-wordpress-for-mobile-galleries/', 'gettingstartedtab', 'customizewordpressgalleriesformobile', '' ) ); ?>"><img class="feature-photo" src="<?php echo esc_url( plugins_url( 'assets/images/get-started/How-to-Customize-WordPress-Galleries-for-Mobile-Devices.png', ENVIRA_FILE ) ); ?>" /></a>
							</div>

							<div class="section-text-column text-left">

								<h2>How to Make Your Galleries Mobile Friendly</h2>

								<p>Do you want to customize your image galleries for mobile? With the rise of mobile internet usage, your photo galleries should be responsive. In this tutorial, we will share how to customize WordPress galleries for mobile devices.</p>

								<div class="banner-button">
									<a target="_blank" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/how-to-customize-wordpress-for-mobile-galleries/', 'gettingstartedtab', 'customizewordpressgalleriesformobile', '' ) ); ?>" class="button button-primary">Read Documentation</a>
								</div>

							</div>

						</div> <!-- panel -->

					<?php $this->envira_assets(); ?>

			</div>

		</div> <!-- wrap -->


		<?php
	}


	/**
	 * Output the about screen.
	 *
	 * @since 1.8.1
	 */
	public function upgrade_page() {

		$upgrade_link = ( empty( envira_get_license_key() ) || false === envira_get_license_key() ) ? 'https://enviragallery.com/pricing/' : 'https://enviragallery.com/pricing/?license_key=' . envira_get_license_key();

		?>

		<div class="envira-welcome-wrap envira-help">

			<div class="envira-title">

				<?php self::welcome_text(); ?>

			</div>

			<?php $this->sidebar(); ?>

			<div class="envira-get-started-main">

				<?php self::tab_navigation( __METHOD__ ); ?>

				<div class="envira-get-started-section">

						<div class="envira-admin-upgrade-panel">

							<div>

								<section id="pricing-table-comparison" class="pricing-table-comparison hide-if-js" style="display: block;">
									<div class="container">
										<ul class="packages">
											<!-- Header -->
											<li class="header row">
												<ul>
													<li class="feature blank">&nbsp;</li>
													<li>
														<span class="most-popular">Most Popular</span>
														<ul>
															<li class="title">Pro</li>
															<li class="cta">
																<a target="_blank" href="<?php echo esc_url( $upgrade_link ); ?>" title="" class="button button-primary">
																Get Started</a>
															</li>
														</ul>
													</li>
													<li class="plus">
														<ul>
															<li class="title">Plus</li>
															<li class="cta">
																<a rel="noopener" target="_blank" href="<?php echo esc_url( $upgrade_link ); ?>" title="" class="button button-primary">
																Get Started</a>
															</li>
														</ul>
													</li>
													<li class="basic">
														<ul>
															<li class="title">Basic</li>
															<li class="cta">
																<a rel="noopener" target="_blank" href="<?php echo esc_url( $upgrade_link ); ?>" title="" class="button button-primary">
																Get Started</a>
															</li>
														</ul>
													</li>
												</ul>
											</li>
											<!-- Overview Features -->
											<li class="row">
												<ul>
													<li class="feature" style="height: 61px;"><span></span>Supported Sites</li>
													<li class="popular" style="height: 61px;"><span></span>
														5 Sites
													</li>
													<li class="plus" style="height: 61px;"><span></span>
														3 Sites
													</li>
													<li class="basic" style="height: 61px;"><span></span>
														1 Sites
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li class="feature" style="height: 61px;"><span></span>Updates</li>
													<li class="popular" style="height: 61px;"><span></span>
														1 Year
													</li>
													<li class="plus" style="height: 61px;"><span></span>
														1 Year
													</li>
													<li class="basic" style="height: 61px;"><span></span>
														1 Year
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li class="feature" style="height: 61px;"><span></span>Unlimited Galleries</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li class="feature" style="height: 61px;"><span></span>Priority Support</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row sub-header">
												Envira Gallery Addons
											</li>
											<li class="row">
												<ul>
													<li id="audio-addon" class="feature" style="height: 61px;"><span></span>
														Audio Addon
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="standalone-addon" class="feature" style="height: 61px;"><span></span>
														Standalone Galleries                                             <a href="#standalone-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="supersize-addon" class="feature" style="height: 61px;"><span></span>
														Supersize Lightbox Images                                             <a href="#supersize-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="nextgen-importer-addon" class="feature" style="height: 61px;"><span></span>
														NextGEN Importer Addon                                           <a href="#nextgen-importer-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="dropbox-importer-addon" class="feature" style="height: 61px;"><span></span>
														Dropbox Importer Addon                                           <a href="#dropbox-importer-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="css-addon" class="feature" style="height: 61px;"><span></span>
														CSS Addon                                         <a href="#css-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="slideshow-addon" class="feature" style="height: 61px;"><span></span>
														Slideshow Addon                                             <a href="#slideshow-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="protection-addon" class="feature" style="height: 61px;"><span></span>
														Protection Addon                                            <a href="#protection-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="printing-addon" class="feature" style="height: 61px;"><span></span>
														Printing Addon                                         <a href="#printing-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes basic" style="height: 61px;"><span></span>
														Yes
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="featured-content-addon" class="feature" style="height: 61px;"><span></span>
														Featured Content Addon                                           <a href="#featured-content-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="gallery-themes-addon" class="feature" style="height: 61px;"><span></span>
														Gallery Themes Addon                                             <a href="#gallery-themes-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="instagram-addon" class="feature" style="height: 61px;"><span></span>
														Instagram Addon                                             <a href="#instagram-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="password-protection-addon" class="feature" style="height: 61px;"><span></span>
														Password Protection Addon                                             <a href="#password-protection-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="pagination-addon" class="feature" style="height: 61px;"><span></span>
														Pagination Addon                                            <a href="#pagination-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="pinterest-addon" class="feature" style="height: 61px;"><span></span>
														Pinterest Addon                                             <a href="#pinterest-addon" title="" pin="" it"="" buttons="" to="" images="" in="" your="" gallery="" lightbox="" views."="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="schedule-addon" class="feature" style="height: 61px;"><span></span>
														Schedule Addon                                         <a href="#schedule-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="tags-addon" class="feature" style="height: 61px;"><span></span>
														Tags Addon                                             <a href="#tags-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="watermarking-addon" class="feature" style="height: 61px;"><span></span>
														Watermarking Addon                                          <a href="#watermarking-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="exif-addon" class="feature" style="height: 61px;"><span></span>
														EXIF Addon                                             <a href="#exif-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="zoom-addon" class="feature" style="height: 61px;"><span></span>
														Zoom Addon                                             <a href="#zoom-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="yes plus" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="defaults-addon" class="feature" style="height: 61px;"><span></span>
														Defaults Addon                                         <a href="#defaults-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="elementor-addon" class="feature" style="height: 61px;"><span></span>
														Elementor Addon                                             <a href="#elementor-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="breadcrumbs-addon" class="feature" style="height: 61px;"><span></span>
														Breadcrumbs Addon                                           <a href="#breadcrumbs-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="downloads-addon" class="feature" style="height: 61px;"><span></span>
														Downloads Addon                                             <a href="#downloads-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="lightroom-addon" class="feature" style="height: 61px;"><span></span>
														Lightroom Addon                                             <a href="#lightroom-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="zip-importer-addon" class="feature" style="height: 61px;"><span></span>
														ZIP Importer Addon                                          <a href="#zip-importer-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="woocommerce-addon" class="feature" style="height: 61px;"><span></span>
														WooCommerce Addon                                           <a href="#woocommerce-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="proofing-addon" class="feature" style="height: 61px;"><span></span>
														Proofing Addon                                         <a href="#proofing-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="social-addon" class="feature" style="height: 61px;"><span></span>
														Social Addon                                           <a href="#social-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="videos-addon" class="feature" style="height: 61px;"><span></span>
														Videos Addon                                           <a href="#videos-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="dynamic-addon" class="feature" style="height: 61px;"><span></span>
														Dynamic Addon                                          <a href="#dynamic-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="albums-addon" class="feature" style="height: 61px;"><span></span>
														Albums Addon                                           <a href="#albums-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="fullscreen-addon" class="feature" style="height: 61px;"><span></span>
														Fullscreen Addon                                            <a href="#fullscreen-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<li class="row">
												<ul>
													<li id="deeplinking-addon" class="feature" style="height: 61px;"><span></span>
														Deeplinking Addon                                           <a href="#deeplinking-addon" title="" class="tooltip">
														?
			</a>
													</li>
													<li class="yes popular" style="height: 61px;"><span></span>
														Yes
													</li>
													<li class="no plus" style="height: 61px;"><span></span>
														No
													</li>
													<li class="no basic" style="height: 61px;"><span></span>
														No
													</li>
												</ul>
											</li>
											<!-- Ready? -->
											<li class="row bottom-cta">
												<ul>
													<li class="feature" style="height: 84px;">
														<strong>Ready to Build Your Gallery?</strong>
													</li>
													<li class="" style="height: 84px;">
													<a target="_blank" href="<?php echo esc_url( $upgrade_link ); ?>" title="" class="button button-primary">
																Get Started</a>
													</li>
													<li class="plus" style="height: 84px;">
													<a target="_blank" href="<?php echo esc_url( $upgrade_link ); ?>" title="" class="button button-primary">
																Get Started</a>
													</li>
													<li class="basic" style="height: 84px;">
													<a target="_blank" href="<?php echo esc_url( $upgrade_link ); ?>" title="" class="button button-primary">
																Get Started</a>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</section>

							</div>

						</div> <!-- panel -->

					<?php $this->envira_assets(); ?>

			</div>

		</div> <!-- wrap -->


		<?php
	}

	/**
	 * Returns a common row for posts from enviragallery.com.
	 *
	 * @since 1.8.5
	 */
	public function envira_posts() {
		?>

			<div class="envira-posts">

				<h3 class="title"><?php esc_html_e( 'Helpful Articles For Beginners:', 'envira-gallery' ); ?></h3>
				<div class="envira-recent envirathree-column">


					<div class="enviracolumn">
						<img class="post-image" src="https://enviragallery.com/wp-content/uploads/2018/10/Image-SEO-for-WordPress.png" />
						<h4 class="title"><?php esc_html_e( 'How to Optimize SEO Images for WordPress', 'envira-gallery' ); ?></h4>
						<?php /* Translators: %s */ ?>
						<p><?php printf( esc_html__( 'Thinking of designing an eCommerce website where you can sell your photos or building a WordPress portfolio where you can show off your photography skills? It’s important to think carefully about your SEO strategy. %s', 'envira-gallery' ), '<a href="https://enviragallery.com/optimize-seo-images-wordpress/" target="_blank">Read More</a>' ); ?></p>
					</div>

					<div class="enviracolumn">
						<img class="post-image" src="https://enviragallery.com/wp-content/uploads/2017/08/move-photography-site-from-flickr-to-wordpress.jpg" />
						<h4 class="title"><?php esc_html_e( 'How to Move Your Photography Site from Flickr to WordPress', 'envira-gallery' ); ?></h4>
						<?php /* Translators: %s */ ?>
						<p><?php printf( esc_html__( 'You may know that your photos aren’t safe at Flickr, and you should upload them to your self hosted site. In this tutorial, we will share how to move your photography site from Flickr to WordPress. %s', 'envira-gallery' ), '<a href="https://enviragallery.com/how-to-move-your-photography-site-from-flickr-to-wordpress/" target="_blank" rel="noopener">Read More</a>' ); ?></p>
					</div>

					<div class="enviracolumn">
						<img class="post-image" src="https://enviragallery.com/wp-content/uploads/2018/09/vidoe-gallery.jpg" />
						<h4 class="title"><?php esc_html_e( 'Announcing New Video Integrations', 'envira-gallery' ); ?></h4>
						<?php /* Translators: %s */ ?>
						<p><?php printf( esc_html__( 'We’re pleased to introduce our expanded video gallery support options for Envira Gallery 1.8.1. More video platform integrations allow you to add more video sources for your galleries. %s', 'envira-gallery' ), '<a href="https://enviragallery.com/announcing-new-video-integrations/" target="_blank" rel="noopener">Read More</a>' ); ?></p>
					</div>


				</div>

			</div>

		<?php
	}


	/**
	 * Returns a common footer
	 *
	 * @since 1.8.5
	 */
	public function envira_assets() {
		?>

		<div class="envira-assets">
			<p>
				<?php esc_html_e( 'Learn more:', 'envira-gallery-lite' ); ?>&nbsp;<a target="_blank" rel="noopener" href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/blog/', 'learnmore', 'blog', '' ) ); ?>"><?php esc_html_e( 'Blog', 'envira-gallery-lite' ); ?></a>
				&bullet; <a href="<?php echo esc_url( $this->default_link( 'https://enviragallery.com/docs/', 'learnmore', 'documentation', '' ) ); ?>"><?php esc_html_e( 'Documentation', 'envira-gallery-lite' ); ?></a>
			</p>

			<div class="icons-container">
				<div class="label"><?php esc_html_e( 'Social:', 'envira-gallery-lite' ); ?></div>

				<ul class="social-icons">
					<li class="facebook">
						<a href="http://facebook.com/enviragallery" title="Facebook" target="_blank" class="facebook" rel="noopener">
							Facebook</a>
					</li>
					<li class="twitter">
						<a href="http://twitter.com/enviragallery" title="Twitter" target="_blank" class="twitter" rel="noopener">
							Twitter</a>
					</li>
					<li class="youtube">
						<a href="http://youtube.com/enviragallery" title="YouTube" target="_blank" class="youtube" rel="noopener">
							YouTube</a>
					</li>
					<li class="pinterest">
						<a href="https://www.pinterest.com/enviragallery/" title="Pinterest" target="_blank" class="pinterest" rel="noopener">
							Pinterest</a>
					</li>
					<li class="instagram">
						<a href="http://instagram.com/enviragallery" title="Instagram" target="_blank" class="instagram" rel="noopener">
							Instagram</a>
					</li>
				</ul>

			</div>

			<p>

				<?php esc_html_e( 'Also by us: ', 'envira-gallery-lite' ); ?>

				<a target="_blank" href="<?php echo esc_url( $this->default_link( 'http://soliloquywp.com', 'alsobyus', 'soliloquyslider', '' ) ); ?>"><?php esc_html_e( 'Soliloquy Slider', 'envira-gallery-lite' ); ?></a>

			</p>

		</div>

		<?php
	}

	/**
	 * Return true/false based on whether a query argument is set.
	 *
	 * @return bool
	 */
	public static function is_new_install() {

		if ( get_transient( '_envira_is_new_install' ) ) {
			delete_transient( '_envira_is_new_install' );
			return true;
		}

		if ( isset( $_GET['is_new_install'] ) && 'true' === strtolower( sanitize_text_field( wp_unslash( $_GET['is_new_install'] ) ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return true;
		} elseif ( isset( $_GET['is_new_install'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return false;
		}
	}

	/**
	 * Return a possibly customized tracked url.
	 *
	 * @since 2.2.0
	 *
	 * @param string  $url URL.
	 * @param string  $medium Medium.
	 * @param string  $button Button.
	 * @param boolean $append Append.
	 *
	 * @return string
	 */
	public static function default_link( $url = false, $medium = 'default', $button = 'default', $append = false ) {

		// Check if there's a constant.
		$shareasale_id = '';
		if ( defined( 'ENVIRA_GALLERY_SHAREASALE_ID' ) ) {
			$shareasale_id = ENVIRA_GALLERY_SHAREASALE_ID;
		}

		// If there's no constant, check if there's an option.
		if ( empty( $shareasale_id ) ) {
			$shareasale_id = get_option( 'envira_gallery_shareasale_id', '' );
		}

		// Whether we have an ID or not, filter the ID.
		$shareasale_id = apply_filters( 'envira_gallery_shareasale_id', $shareasale_id );

		// If at this point we still don't have an ID, we really don't have one!
		// Just return the standard upgrade URL.
		if ( empty( $shareasale_id ) ) {
			if ( false === filter_var( $url, FILTER_VALIDATE_URL ) ) {
				// prevent a possible typo.
				$url = false;
			}
			$url = ( false !== $url ) ? trailingslashit( esc_url( $url ) ) : 'https://enviragallery.com/lite/';
			return $url . '?utm_source=proplugin&utm_medium=' . $medium . '&utm_campaign=' . $button . $append;
		}

		$clean_url = str_replace( wp_parse_url( $url, PHP_URL_SCHEME ) . '://', '', $url );

		// If here, we have a ShareASale ID
		// Return ShareASale URL with redirect.
		return 'http://www.shareasale.com/r.cfm?u=' . $shareasale_id . '&b=566240&m=51693&afftrack=&urllink=' . rawurlencode( $clean_url );
	}

	/**
	 * PHP min version global notice.
	 */
	public function global_notice() {
		$hide_php_notice = apply_filters( 'envira_gallery_hide_php_notice', false );
		if ( $hide_php_notice ) {
			return;
		}

		if ( version_compare( PHP_VERSION, '7.4.0', '<' ) ) {
			$notices = new Notices();
			$notices->display_inline_notice(
				'envira-gallery-php-version-notice',
				wp_kses_post(
					__(
						'Your site is running an <strong>outdated</strong> version of PHP that is no longer supported and may cause issues with <strong>Envira Gallery</strong>',
						'envira-gallery'
					)
				),
				wp_kses_post(
					__(
						'<strong>Please Note:</strong> Support for PHP 7.3 and below will be discontinued soon. <i>After this, if no further action is taken, Envira Gallery functionality will be disabled.</i>',
						'envira-gallery'
					)
				),
				'error',
				'',
				'',
				false
			);
		}
	}

	/**
	 * Return a user-friendly version-number string, for use in translations.
	 *
	 * @since 2.2.0
	 *
	 * @return string
	 */
	public static function display_version() {

		return ENVIRA_VERSION;
	}
}
