<?php

/**
 * treck functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package treck
 */

if (!defined('TRECK_VERSION')) {
    // Replace the version number of the theme on each release.
    define('TRECK_VERSION', '1.2');
}

if (!function_exists('treck_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function treck_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on treck, use a find and replace
		 * to change 'treck' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('treck', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        // Set post thumbnail size.
        set_post_thumbnail_size(770, 428, true);

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'treck'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );


        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'treck_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function treck_content_width()
{
    $GLOBALS['content_width'] = apply_filters('treck_content_width', 640);
}
add_action('after_setup_theme', 'treck_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function treck_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'treck'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'treck'),
            'before_widget' => '<section id="%1$s" class="sidebar__single widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<div class="title"><h2>',
            'after_title'   => '</h2></div>',
        )
    );

    if (class_exists('WooCommerce')) {
        register_sidebar(
            array(
                'name'          => esc_html__('Shop Sidebar', 'treck'),
                'id'            => 'shop',
                'description'   => esc_html__('Add widgets here.', 'treck'),
                'before_widget' => '<section id="%1$s" class="shop-category product__sidebar-single widget sidebar__single %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3 class="product__sidebar-title">',
                'after_title'   => '</h3>',
            )
        );
    }
}
add_action('widgets_init', 'treck_widgets_init');

// google font process

function treck_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'treck')) {
        $font_url = add_query_arg('family', urlencode('Plus Jakarta Sans:200,200i,300,300i400,400i,500,500i,600,600i,700,700i,800,800i&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
    }

    return esc_url_raw($font_url);
}


/**
 * Enqueue scripts and styles.
 */
function treck_scripts()
{
    wp_enqueue_style('treck-fonts', treck_fonts_url(), array(), null);
    wp_enqueue_style('flaticons', get_template_directory_uri() . '/assets/vendors/flaticons/css/flaticon.css', array(), '1.1');
    wp_enqueue_style('treck-icons', get_template_directory_uri() . '/assets/vendors/treck-icons/style.css', array(), '1.1');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/css/bootstrap.min.css', array(), '5.0.0');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/vendors/fontawesome/css/all.min.css', array(), '5.15.1');
    wp_enqueue_style('treck-style', get_stylesheet_uri(), array(), time());
    wp_style_add_data('treck-style', 'rtl', 'replace');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/js/bootstrap.min.js', array('jquery'), '5.0.0', true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/vendors/isotope/isotope.js', array('jquery'), '2.1.1', true);
    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/assets/vendors/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), '4.1.4', true);
    wp_enqueue_script('treck-theme', get_template_directory_uri() . '/assets/js/treck-theme.js', array('jquery'), time(), true);



    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    $treck_get_dark_mode_status = get_theme_mod('treck_dark_mode', false);

    if (is_page()) {
        $treck_get_dark_mode_status = get_post_meta(get_the_ID(), 'treck_enable_dark_mode', true);
    }
    $treck_dynamic_dark_mode_status = isset($_GET['dark_mode']) ? $_GET['dark_mode'] : $treck_get_dark_mode_status;
    if ('on' == $treck_dynamic_dark_mode_status) {
        wp_enqueue_style('treck-dark-mode', get_template_directory_uri() . '/assets/css/modes/treck-dark.css', array(), time());
    }

    $treck_get_rtl_mode_status = get_theme_mod('treck_rtl_mode', false);

    if (is_page()) {
        $treck_rtl_mode_status = get_post_meta(get_the_ID(), 'treck_enable_rtl_mode', true);

        $treck_get_rtl_mode_status = empty($treck_rtl_mode_status) ? $treck_get_rtl_mode_status : $treck_rtl_mode_status;
    }

    $treck_dynamic_rtl_mode_status = isset($_GET['rtl_mode']) ? $_GET['rtl_mode'] : $treck_get_rtl_mode_status;
    if ('yes' == $treck_dynamic_rtl_mode_status || true == is_rtl()) {
        wp_enqueue_style('treck-custom-rtl', get_template_directory_uri() . '/assets/css/treck-rtl.css', array(), time());
    }
}
add_action('wp_enqueue_scripts', 'treck_scripts');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Implement the customizer feature.
 */
if (class_exists('Layerdrops\Treck\Customizer')) {
    require get_template_directory() . '/inc/theme-customizer-styles.php';
}

/**
 * TGMPA Activation.
 */
require get_template_directory() . '/inc/plugins.php';



/*
* one click deomon import
*/
if (class_exists('OCDI_Plugin')) {
    require get_template_directory() . '/inc/demo-import.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}




function news_init()
{
	// set up product labels
	$labels = array(
	'name' => 'News',
	'singular_name' => 'News',
	'add_new' => 'Add New News',
	'add_new_item' => 'Add New News',
	'edit_item' => 'Edit News',
	'new_item' => 'New News',
	'all_items' => 'All News',
	'view_item' => 'View News',
	'search_items' => 'Search News',
	'not_found' =>  'No News Found',
	'not_found_in_trash' => 'No News found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'News',
	);

	// register post type
	$args = array(
	'labels' => $labels,
	'public' => true,
	'has_archive' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array('slug' => 'news'),
	'query_var' => true,
	'menu_icon' => 'dashicons-calendar-alt',
	'supports' => array(
	'title',
	'editor',
	'excerpt',
	'trackbacks',
	'custom-fields',
	'comments',
	'revisions',
	'thumbnail',
	'author',
	'page-attributes'
	)
	);
	register_post_type( 'news', $args );

	// register taxonomy
	register_taxonomy('news_category', 'news', array('hierarchical' => true, 'label' => 'News Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'news-category' )));
}
add_action( 'init', 'news_init' );


function events_init()
{
	// set up product labels
	$labels = array(
	'name' => 'Events',
	'singular_name' => 'Events',
	'add_new' => 'Add New Events',
	'add_new_item' => 'Add New Events',
	'edit_item' => 'Edit Events',
	'new_item' => 'New Events',
	'all_items' => 'All Events',
	'view_item' => 'View Events',
	'search_items' => 'Search Events',
	'not_found' =>  'No Events Found',
	'not_found_in_trash' => 'No Events found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Events',
	);

	// register post type
	$args = array(
	'labels' => $labels,
	'public' => true,
	'has_archive' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array('slug' => 'events'),
	'query_var' => true,
	'menu_icon' => 'dashicons-calendar-alt',
	'supports' => array(
	'title',
	'editor',
	'excerpt',
	'trackbacks',
	'custom-fields',
	'comments',
	'revisions',
	'thumbnail',
	'author',
	'page-attributes'
	)
	);
	register_post_type( 'events', $args );
	

	// register taxonomy
	register_taxonomy('events_category', 'events', array('hierarchical' => true, 'label' => 'Events Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'events-category' )));
}
add_action( 'init', 'events_init' );

function wpc_elementor_shortcode_new($atts)
{ 
$args = array(
'post_type' => 'news',
'posts_per_page' =>'5'
);
$the_query = new WP_Query( $args );
?>
<div class="view-content">
<div class="item-list">
<ul>
<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : 	$the_query->the_post(); ?>
<marquee behavior="scroll" direction="up" scrollamount="2"	onmouseover="this.stop();" 	onmouseout="this.start();" id="marquee1">
<li class="views-row views-row-1 views-row-odd views-row-first">
<a href="#" class="ext-link-ajax"><?php echo the_title(); ?></a></li>
<?php endwhile; wp_reset_postdata();endif; ?>	
</marquee>
</ul></div> </div>
<div class="view-footer">
<div class="more-link">
<a title="Play"   onClick="document.getElementById('marquee1').start();" style="cursor: pointer;">Play</a>
<a title="Pause"  onClick="document.getElementById('marquee1').stop();" style="cursor: pointer;">Pause</a>
<a title="More news" href="#">More News..</a></div> </div>
<?php }
add_shortcode( 'my_elementor_php_output_news', 'wpc_elementor_shortcode_new');




function wpc_elementor_shortcode_new1($atts)
{ 
$args = array(
'post_type' => 'events',
'posts_per_page' =>'5'
);
$the_query = new WP_Query( $args );
?>
<div class="view-content">
<div class="item-list">
<ul>
<marquee behavior="scroll" direction="up" scrollamount="2"	onmouseover="this.stop();" 	onmouseout="this.start();" id="marquee2">
<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : 	$the_query->the_post(); ?>			
<li class="views-row views-row-1 views-row-odd views-row-first">
<a href="#" class="ext-link-ajax"><?php echo the_title(); ?></a></li>
<?php endwhile; wp_reset_postdata();endif; ?>	

</marquee>
</ul></div> </div>
<div class="view-footer">
<div class="more-link">
<a title="Play"  onClick="document.getElementById('marquee2').start();" style="cursor: pointer;">Play</a>
<a title="Pause" onClick="document.getElementById('marquee2').stop();" style="cursor: pointer;">Pause</a>
<a title="More news" href="#">More Events..</a></div> </div>
<?php
}
add_shortcode( 'my_elementor_php_output_events', 'wpc_elementor_shortcode_new1');


function wpc_elementor_shortcode_citizen($citizen) {  

$curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://upyog-test.niua.org/user/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'username=NDSS1&password=upyogTest%40123&userType=EMPLOYEE&tenantId=pg&scope=read&grant_type=password',
  CURLOPT_HTTPHEADER => array(
    'authority: upyog-test.niua.org',
    'accept: application/json, text/plain, */*',
    'accept-language: en-US,en;q=0.9',
    'authorization: Basic ZWdvdi11c2VyLWNsaWVudDo=',
    'content-type: application/x-www-form-urlencoded',
    'cookie: _ga=GA1.2.1809014196.1686211325; _ga_QH3SHT9MTG=GS1.1.1686211325.1.0.1686211328.0.0.0; _ga_EJDFKF9L1X=GS1.1.1686211325.1.0.1686211328.0.0.0',
    'origin: https://upyog-test.niua.org',
    'referer: https://upyog-test.niua.org/digit-ui/employee/user/login',
    'sec-ch-ua: "Google Chrome";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$responsedata = json_decode($response);
$token = $responsedata->access_token;
//echo "<br/>";
/**
* 
* @var *****start citizen data fetch************************
* 
*/
$data = '{
    "aggregationRequestDto": {
        "visualizationType": "METRIC",
        "visualizationCode": "nurtTotalCitzens",
        "aggregationFactors": null,
        "queryType": "",
        "filters": {},
        "moduleLevel": "",
        "requestDate": {
            "startDate": 1680287400000,
            "endDate": 1701714599999,
            "interval": "month",
            "title": "home"
        }
    },
    "headers": {
        "tenantId": "pg"
    },
    "RequestInfo": {
        "apiId": "Rainmaker",
        "authToken": "'.$token.'",
        "msgId": "1701682996596|en_IN",
        "plainAccessRequest": {}
    }
}';

$curlHandler = curl_init();
curl_setopt_array($curlHandler, array(
  CURLOPT_URL => 'https://upyog-test.niua.org/dashboard-analytics/dashboard/getChartV2',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  curl_setopt($curlHandler, CURLOPT_POSTFIELDS,($data)),
  CURLOPT_HTTPHEADER => array(
    'authority: upyog-test.niua.org',
    'accept: application/json, text/plain, */*',
    'accept-language: en-US,en;q=0.9',
    'authorization: Basic ZWdvdi11c2VyLWNsaWVudDo=',
    'content-type: application/json;charset=UTF-8',
    'cookie: __ga=GA1.2.1809014196.1686211325; _ga_QH3SHT9MTG=GS1.1.1686211325.1.0.1686211328.0.0.0; _ga_EJDFKF9L1X=GS1.1.1686211325.1.0.1686211328.0.0.0',
    'origin: https://upyog-test.niua.org',
    'referer: https://upyog-test.niua.org/digit-ui/employee/dss/landing/NURT_DASHBOARD',
    'sec-ch-ua: "Google Chrome";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36'
  ),
));
$responseheader = curl_exec($curlHandler);
curl_close($curlHandler);
$val = json_decode($responseheader);
$headerValue = $val->responseData->data[0]->headerValue;

$startvalues  = $headerValue-10;
//echo $headerValue;
//echo "<br/>";
$startvalue = preg_replace("/[^0-9]/", "", $startvalues);;


/**
* 
* @var *****end citizen data fetch************************
* 
* @var *****state data fetch************************
* 
*/
$data2 = '{
    "aggregationRequestDto": {
        "visualizationType": "METRIC",
        "visualizationCode": "nurtLiveStates",
        "queryType": "",
        "filters": {},
        "moduleLevel": "",
        "aggregationFactors": null,
        "requestDate": {
            "startDate": 1680287400000,
            "endDate": 1701852058,
            "interval": "month",
            "title": "home"
        }
    },
    "headers": {
        "tenantId": "pg"
    },
    "RequestInfo": {
        "apiId": "Rainmaker",
        "authToken": "'.$token.'",
        "msgId": "1701682996595|en_IN",
        "plainAccessRequest": {}
    }
}';

$curlHandlerstate = curl_init();
curl_setopt_array($curlHandlerstate, array(
  CURLOPT_URL => 'https://upyog-test.niua.org/dashboard-analytics/dashboard/getChartV2',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  curl_setopt($curlHandlerstate, CURLOPT_POSTFIELDS,($data2)),
  CURLOPT_HTTPHEADER => array(
    'authority: upyog-test.niua.org',
    'accept: application/json, text/plain, */*',
    'accept-language: en-US,en;q=0.9',
    'authorization: Basic ZWdvdi11c2VyLWNsaWVudDo=',
    'content-type: application/json;charset=UTF-8',
    'cookie: __ga=GA1.2.1809014196.1686211325; _ga_QH3SHT9MTG=GS1.1.1686211325.1.0.1686211328.0.0.0; _ga_EJDFKF9L1X=GS1.1.1686211325.1.0.1686211328.0.0.0',
    'origin: https://upyog-test.niua.org',
    'referer: https://upyog-test.niua.org/digit-ui/employee/dss/landing/NURT_DASHBOARD',
    'sec-ch-ua: "Google Chrome";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36'
  ),
));
$responseheaderstate = curl_exec($curlHandlerstate);
curl_close($curlHandlerstate);
$valstate = json_decode($responseheaderstate);

$headerValuestate = $valstate->responseData->data[0]->headerValue;
//echo "<br/>";
//echo $headerValuestate;
/**
* 
* @var *****end state data fetch************************
* 
*/


?>








<style>
.counter-one__content p {
  font-weight: 500;
  color: var(--treck-white);
  margin-top: 5px;
  font-size: 17px;
}	
</style>

<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<section class="counter-one">
<div class="container">
<div class="row">
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="fas fa-handshake"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box">
<p class="counter-wrapper"><span class="fb" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus"></span>
</div>
<p class=""><font style="font-size:100%" my="my">Empanelled </font><br><font style="font-size:100%" my="my">Partners</font></p>     </div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="   icon-life-insurance"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="bike" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus"></span>
</div>
<p class=" "><font style="font-size:100%" my="my">MoU Signed with States/UTS</font></p></div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="   icon-group"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="code" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus"></span>
</div>
<p class="  "><font style="font-size:100%" my="my">Citizens</font><br>&nbsp;</p></div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="  fas fa-network-wired"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="coffee" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus"></span>
</div>
<p class="   "><font style="font-size:100%" my="my">Modules</font><br>&nbsp;</p></div>
</div>
</div>



</div>
</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
<script src="<?php bloginfo('template_url');?>/counter/animationCounter.js" charset="utf-8"></script>
<script type="text/javascript">
$('#counter-block').ready(function(){
$('.fb').animationCounter({
start: 0,
step: 1,
end: 55,
delay: 100
});
$('.bike').animationCounter({
start: 0,
step: 1,
end: '<?php echo $headerValuestate ;?>',
delay: 100,
txt: ''
});
$('.code').animationCounter({
start: 2652667,
end: '<?php echo $headerValue ;?>',
step: 1,
delay: 100
});
$('.coffee').animationCounter({
start:0,
end: 10,
step: 1,
delay: 100,
txt: ''
});
});
</script>



<?php }  
add_shortcode( 'my_elementor_php_output_citizen', 'wpc_elementor_shortcode_citizen');
