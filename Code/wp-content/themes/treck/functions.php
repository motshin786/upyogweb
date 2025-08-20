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
$args=array('post_type' =>'news','orderby' => 'date',  'order' => 'DESC', 'paged' =>'10', 'posts_per_page' => '-1','post_status'=>'publish');
query_posts( $args );
?>
<div class="view-content" style="padding: 0;">
<div class="item-list">
<ul style="margin: 0; padding: 0;">
<marquee behavior="scroll" direction="up" scrollamount="2"	onmouseover="this.stop();" 	onmouseout="this.start();" id="marquee1">
<?php while ( have_posts() ) : the_post(); 
//$documents_url= get_post_meta($post->ID,'external_link',true);
$documents_url= get_field('external_link',get_the_ID());
print_r($documents_url);
?>
<li class="views-row views-row-1 views-row-odd views-row-first">
<a href="<?php echo $documents_url['url']; ?>" target="_blank" class="ext-link-ajax"  style="color: #FFF;"><?php echo the_title(); ?></a></li>
<?php endwhile;?>	
</marquee>
</ul></div> </div>
<div class="view-footer">
<div class="more-link">
<a title="Play"   onClick="document.getElementById('marquee1').start();" style="cursor: pointer;">Play</a>
<a title="Pause"  onClick="document.getElementById('marquee1').stop();" style="cursor: pointer;">Pause</a>
<a title="More news" href="<?php echo site_url();?>/news/">More News..</a></div> </div>
<?php }
add_shortcode( 'my_elementor_php_output_news', 'wpc_elementor_shortcode_new');




function wpc_elementor_shortcode_new1($atts)
{
$args_events=array('post_type' =>'events','orderby' => 'date',  'order' => 'DESC', 'paged' =>'10', 'posts_per_page' => '-1','post_status'=>'publish');
query_posts( $args_events );
?>
<div class="view-content" style="padding: 0;">
<div class="item-list">
<ul style="margin: 0; padding: 0;">
<marquee behavior="scroll" direction="up" scrollamount="2"	onmouseover="this.stop();" 	onmouseout="this.start();" id="marquee2">
<?php while ( have_posts() ) : the_post(); ?>	
<li class="views-row views-row-1 views-row-odd views-row-first">
<a href="<?php echo site_url();?>/upcoming-events/" class="ext-link-ajax" style="color: #FFF;"><?php echo the_title(); ?></a></li>
<?php endwhile; ?>	

</marquee>
</ul></div> </div>
<div class="view-footer">
<div class="more-link">
<a title="Play"  onClick="document.getElementById('marquee2').start();" style="cursor: pointer;">Play</a>
<a title="Pause" onClick="document.getElementById('marquee2').stop();" style="cursor: pointer;">Pause</a>
<a title="More news" href="<?php echo site_url();?>/upcoming-events/">More Events..</a></div> </div>
<?php
}
add_shortcode( 'my_elementor_php_output_events', 'wpc_elementor_shortcode_new1');


function wpc_elementor_shortcode_citizen($citizen) {  
$curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://upyog.niua.org/user/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'username=NDNIUA&password=Niua@dashb0ard&userType=EMPLOYEE&tenantId=pg&scope=read&grant_type=password',
  CURLOPT_HTTPHEADER => array(
    'authority: upyog.niua.org',
    'accept: application/json, text/plain, */*',
    'accept-language: en-US,en;q=0.9',
    'authorization: Basic ZWdvdi11c2VyLWNsaWVudDo=',
    'content-type: application/x-www-form-urlencoded',
    'cookie: _ga=GA1.2.1809014196.1686211325; _ga_QH3SHT9MTG=GS1.1.1686211325.1.0.1686211328.0.0.0; _ga_EJDFKF9L1X=GS1.1.1686211325.1.0.1686211328.0.0.0',
    'origin: https://upyog .niua.org',
    'referer: https://upyog.niua.org/digit-ui/employee/user/login',
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
$currentEpochTimestamp = time();
$currentDateTime = date('Y-m-d H:i:s', $currentEpochTimestamp);

// Output the result
//echo "Current Unix Timestamp: $currentEpochTimestamp\n";
//echo "<br/>";
//echo "Current Date and Time: $currentDateTime";

$data = '{
    "aggregationRequestDto": {
        "visualizationType": "METRIC",
        "visualizationCode": "nurtTotalCitzens",
         "queryType": "",
        "filters": {},
        "moduleLevel": "",
        "aggregationFactors": null,
        "requestDate": {
            "startDate": 1680287400000,
            "endDate": "'.$currentEpochTimestamp.'",
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
  CURLOPT_URL => 'https://upyog.niua.org/dashboard-analytics/dashboard/getChartV2',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  curl_setopt($curlHandler, CURLOPT_POSTFIELDS,($data)),
  CURLOPT_HTTPHEADER => array(
    'authority: upyog.niua.org',
    'accept: application/json, text/plain, */*',
    'accept-language: en-US,en;q=0.9',
    'authorization: Basic ZWdvdi11c2VyLWNsaWVudDo=',
    'content-type: application/json;charset=UTF-8',
    'cookie: __ga=GA1.2.1809014196.1686211325; _ga_QH3SHT9MTG=GS1.1.1686211325.1.0.1686211328.0.0.0; _ga_EJDFKF9L1X=GS1.1.1686211325.1.0.1686211328.0.0.0',
    'origin: https://upyog.niua.org',
    'referer: https://upyog.niua.org/digit-ui/employee/dss/landing/NURT_DASHBOARD',
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
        "visualizationCode": "nurtOnboardedStates",
        "queryType": "",
        "filters": {},
        "moduleLevel": "",
        "aggregationFactors": null,
        "requestDate": {
            "startDate": 1680287400000,
             "endDate": "'.$currentEpochTimestamp.'",
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
  CURLOPT_URL => 'https://upyog.niua.org/dashboard-analytics/dashboard/getChartV2',
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
.counter-one{padding:0px;}.counter-one__content p {font-weight: 500;color: var(--treck-white);margin-top: 5px;font-size: 17px;}.col-xl-3 {flex: 0 0 auto;width: 20%;}.counter-one__single {position: relative;display: flex;align-items: center;padding: 10px 0 10px;margin-bottom: 30px;border-right: 1px solid #fffefe;z-index: 1;width: 200px;height: 150px;}.counter-one__content p{margin-left: -15px;}.counter-one__icon span {position: relative;display: inline-block;font-size: 50px;color: var(--treck-white);-webkit-transition: all 500ms linear;transition: all 500ms linear;-webkit-transition-delay: 0.1s;transition-delay: 0.1s;}
@media only screen and (max-width:479px) 
{
.row.ctrs {width: 100%;}
.col-xl-3 {flex: 0 0 auto;width: 100%;}		
.counter-one__single{width: 100%;}
}
@media only screen and (max-width:320px) {
.row.ctrs {width: 100%;}
.col-xl-3 {flex: 0 0 auto;width: 100%;}	
.counter-one__single{width: 100%;}
}	
</style>

<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<section class="counter-one">
<div class="container ctr">
<div class="row ctrs">
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="   icon-group"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="code" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus" style="font-size: 25px;"><?php echo $headerValue ;?></span>
</div>
<p class=""><font style="font-size:100%" my="my">Citizens</font><br>&nbsp;</p></div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="   icon-life-insurance"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="bike" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus"><?php echo $headerValuestate ;?></span>
</div>
<p class=" "><font style="font-size:100%" my="my">MoU Signed with States/UTS</font></p></div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="fas fa-handshake"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box">
<p class="counter-wrapper"><span class="fb" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus">70</span>
</div>
<p class=""><font style="font-size:100%" my="my">Empanelled </font><br><font style="font-size:100%" my="my">Partners</font></p>     </div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="  fas fa-network-wired"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="coffee" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus">16</span>
</div>
<p class="   "><font style="font-size:100%" my="my">Modules</font><br>&nbsp;</p></div>
</div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6">
<div class="counter-one__single">
<div class="counter-one__icon icon-svg-large">
<span aria-hidden="true" class="fas fa-certificate"></span></div>
<div class="counter-one__content">
<div class="counter-one__count-box count-box counted">
<p class="counter-wrapper"><span class="coffee" style="font-weight: bold; font-size: 30px;"></span></p>
<span class="counter-two__plus">3280 </span>
</div>
<p class=""	><font style="font-size:100%" my="my">ULBs/<br/>Engaged</font><br>&nbsp;</p></div>
</div>
</div>
</div>
</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
<!--<script src="<?php bloginfo('template_url');?>/counter/animationCounter.js" charset="utf-8"></script>-->
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
start: 2995430,
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



function resource_init()
{
	// set up product labels
	$labels = array(
	'name' => 'Resource Documents',
	'singular_name' => 'Resource Documents',
	'add_new' => 'Add New Resource Documents',
	'add_new_item' => 'Add New Resource Documents',
	'edit_item' => 'Edit Resource Documents',
	'new_item' => 'New Resource Documents',
	'all_items' => 'All Resource Documents',
	'view_item' => 'View Resource Documents',
	'search_items' => 'Search Resource Documents',
	'not_found' =>  'No Resource Documents Found',
	'not_found_in_trash' => 'No Resource Documents found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Resource Documents',
	);

	// register post type
	$args = array(
	'labels' => $labels,
	'public' => true,
	'has_archive' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array('slug' => 'resource'),
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
	register_post_type( 'resource', $args );
	

	// register taxonomy
	register_taxonomy('resource_category', 'resource', array('hierarchical' => true, 'label' => 'Resource Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'resource-category' )));
}
add_action( 'init', 'resource_init' );

function gallery_init()
{
	// set up Standard labels
	$labels = array(
	'name' => 'Gallery',
	'singular_name' => 'Gallery',
	'add_new' => 'Add New Gallery',
	'add_new_item' => 'Add New Gallery',
	'edit_item' => 'Edit Gallery',
	'new_item' => 'New Gallery',
	'all_items' => 'All Gallery',
	'view_item' => 'View Gallery',
	'search_items' => 'Search Gallery',
	'not_found' =>  'No Gallery Found',
	'not_found_in_trash' => 'No Gallery found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Gallery',
	);

	// register post type
	$args = array(
	'labels' => $labels,
	'public' => true,
	'has_archive' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array('slug' => 'galleries'),
	'query_var' => true,
	'menu_icon' => 'dashicons-format-gallery',
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
	register_post_type( 'galleries', $args );
	// register taxonomy
	register_taxonomy('project_gallery_category', 'gallery', array('hierarchical' => true, 'label' => 'Gallery Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'project-gallery-category' )));
}
add_action( 'init', 'gallery_init' );


function wpc_elementor_shortcode_Project_gallery($atts)
{ ?>
<style>
.mklight ul {width: 100%; display: contents;padding: 0; margin: 0;position: relative;list-style-type: none;}
.mklight ul li {margin: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #574B73; width: 18%;float: left;}
.example-image.new {width: 100%;height: 150px;}
.mkcaptions {color: #fff;padding: 5px;margin: 0px 0px 0 0px;line-height: 30px;}
.lb-data .lb-details {width: 100% !important;float: left;text-align: left;line-height: 1.1em;}
.lb-data .lb-caption {font-size: 20px !important;font-weight: 700;line-height: 1em;}
.lb-caption p {font-size: 20px !important;font-weight: 700;line-height: 1em;}
</style>
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/gallerynew/css/lightbox.min.css">
 
<section>
<div class="mklight">
<ul>
<?php 
$args = array( 'post_type' => 'galleries', 'posts_per_page' =>-1 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
?>
<li> <a class="example-image-link" href="<?php echo $feat_image ; ?>" data-lightbox="example-set" data-title="<?php echo the_content() ;?>."><img class="example-image new" src="<?php echo $feat_image ; ?>" alt="<?php echo the_title(); ?>"/><p class="mkcaptions"><?php echo the_title(); ;?></p></a></li>  
<?php  endwhile; wp_reset_query(); ?>
</ul>
</div>
</section>
<script src="<?php bloginfo('template_url');?>/gallerynew/js/lightbox-plus-jquery.min.js"></script>
<?php }
add_shortcode( 'my_elementor_php_output_project_gallery', 'wpc_elementor_shortcode_Project_gallery');

function resources_init()
{
	// set up Standard labels
	$labels = array(
	'name' => 'Resources',
	'singular_name' => 'Resources',
	'add_new' => 'Add New Resources',
	'add_new_item' => 'Add New Resources',
	'edit_item' => 'Edit Resources',
	'new_item' => 'New Resources',
	'all_items' => 'All Resources',
	'view_item' => 'View Resources',
	'search_items' => 'Search Resources',
	'not_found' =>  'No Resources Found',
	'not_found_in_trash' => 'No Resources found in Trash',
	'parent_item_colon' => '',
	'menu_name' => 'Resources',
	);

	// register post type
	$args = array(
	'labels' => $labels,
	'public' => true,
	'has_archive' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array('slug' => 'resources'),
	'query_var' => true,
	'menu_icon' => 'dashicons-admin-generic',
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
	register_post_type( 'resources', $args );
	// register taxonomy
	register_taxonomy('resources_category', 'resources', array('hierarchical' => true, 'label' => 'Resources Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'resources-category' )));
}
add_action( 'init', 'resources_init' );


function wpc_elementor_shortcode_Program_documents($atts)
{ ?>
<div class="container">
  <div class="row">
   <input type="text" id="filter" onkeyup="filterList()" placeholder="Search for Program Documents Title.." title="Type in a Program Documents">
   <ul id="item-list"> 
 <style>
.image {
display: block;
width: 100%;
padding: 10px !important;
height: 230px !important;
}

.overlay {
position: absolute; 
bottom: 0; 
background: rgb(0, 0, 0);
background: rgba(0, 0, 0, 0.5); /* Black see-through */
color: #f1f1f1; 
width: 100%;
transition: .5s ease;
opacity:0;
color: white;
font-size: 20px;
padding: 20px;
text-align: center;
}

.container:hover .overlay {
opacity: 1;
}

#filter {
background-image: url('https://upyog.niua.in/homepage/wp-content/uploads/2024/01/searchicon.png');
background-position: 10px 12px;
background-repeat: no-repeat;
width: 100%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#item-list {
width: 100%;
float: left;
display: contents;
margin: 0;
padding: 0;
}

#item-list li {
width: 25%;
display: contents;
position: relative;
float: left;
max-width: 25%;

}	
  </style> 
   



<?php
$args = array(
'post_type' => 'resources',
'posts_per_page' => -1,
'tax_query' => array(
array(
'taxonomy' => 'resources_category', // Replace with the actual taxonomy name
'field'    => 'slug',
'terms'    => 'program-documents', // Replace with the actual category slug
),
),
);
$custom_query = new WP_Query($args);
if ($custom_query->have_posts()) :
while ($custom_query->have_posts()) : $custom_query->the_post();
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$external_link=get_field('external_link',$post->ID, );	
$iframe = get_field('video_url',$post->ID);
// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . ' class="image"></iframe>', $iframe);



?>

 <li>
   <div class="col-sm-3" style="margin: 0;padding: 10px 15px 10px 15px;">
     <div class="col-sm-12 main">
     <div class="left">
     <?php if($feat_image!="") { ?>
     <div class="image"><a href="<?php echo $external_link;?>" target="_blank"><img src="<?php echo $feat_image ;?>" class="image"></a></div>
     <?php } else { ?>
     <div class="image"><a href="<?php echo $external_link ;?>" target="_blank"><?php echo $iframe ;?></a></div>	
     <?php }  ?>
     <div class="titleimg"><h5><a href="<?php echo $external_link ;?>" target="_blank"><?php echo the_title();?></a></h5></div>	
     
     </div>
 

    </div>
    </div>
   </li>
<script>
    function filterList() {
        // Get input value and convert to lowercase for case-insensitive filtering
        var filter = document.getElementById('filter').value.toLowerCase();
        
        // Get the list items
        var items = document.getElementById('item-list').getElementsByTagName('li');
        
        // Loop through each item and hide/show based on the filter
        for (var i = 0; i < items.length; i++) {
            var text = items[i].innerText.toLowerCase();
            if (text.indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
</script>
<?php endwhile; wp_reset_postdata(); ?>
  <?php endif; ?>
     </ul> 
  </div>
</div>

<?php }
add_shortcode('my_elementor_php_output_Program_documents', 'wpc_elementor_shortcode_Program_documents');

function wpc_elementor_shortcode_best_practices($atts)
{ ?>
<div class="container">
  <div class="row">
   <input type="text" id="filter1" onkeyup="filterList1()" placeholder="Search for Best Practices Title.." title="Type in a Best Practices">
   <ul id="item-list1"> 
 <style>
.image {
display: block;
width: 100%;
padding: 10px !important;
height: 230px !important;
}

.overlay {
position: absolute; 
bottom: 0; 
background: rgb(0, 0, 0);
background: rgba(0, 0, 0, 0.5); /* Black see-through */
color: #f1f1f1; 
width: 100%;
transition: .5s ease;
opacity:0;
color: white;
font-size: 20px;
padding: 20px;
text-align: center;
}

.container:hover .overlay {
opacity: 1;
}

#filter1 {
background-image: url('https://upyog.niua.in/homepage/wp-content/uploads/2024/01/searchicon.png');
background-position: 10px 12px;
background-repeat: no-repeat;
width: 100%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#item-list1 {
width: 100%;
float: left;
display: contents;
margin: 0;
padding: 0;
}

#item-list1 li {
width: 25%;
display: contents;
position: relative;
float: left;
max-width: 25%;

}	
  </style> 
   



<?php
$args = array(
'post_type' => 'resources',
'posts_per_page' => -1,
'tax_query' => array(
array(
'taxonomy' => 'resources_category', // Replace with the actual taxonomy name
'field'    => 'slug',
'terms'    => 'best-practices', // Replace with the actual category slug
),
),
);
$custom_query = new WP_Query($args);
if ($custom_query->have_posts()) :
while ($custom_query->have_posts()) : $custom_query->the_post();
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$external_link=get_field('external_link',$post->ID, );	
$iframe = get_field('video_url',$post->ID);
// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . ' class="image"></iframe>', $iframe);



?>

 <li>
   <div class="col-sm-3" style="margin: 0;padding: 10px 15px 10px 15px;">
     <div class="col-sm-12 main">
     <div class="left">
     <?php if($feat_image!="") { ?>
     <div class="image"><a href="<?php echo $external_link;?>" target="_blank"><img src="<?php echo $feat_image ;?>" class="image"></a></div>
     <?php } else { ?>
     <div class="image"><a href="<?php echo $external_link ;?>" target="_blank"><?php echo $iframe ;?></a></div>	
     <?php }  ?>
     <div class="titleimg"><h5><a href="<?php echo $external_link ;?>" target="_blank"><?php echo the_title();?></a></h5></div>	
     
     </div>
 

    </div>
    </div>
   </li>
<script>
    function filterList1() {
        // Get input value and convert to lowercase for case-insensitive filtering
        var filter = document.getElementById('filter1').value.toLowerCase();
        
        // Get the list items
        var items = document.getElementById('item-list1').getElementsByTagName('li');
        
        // Loop through each item and hide/show based on the filter
        for (var i = 0; i < items.length; i++) {
            var text = items[i].innerText.toLowerCase();
            if (text.indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
</script>
<?php endwhile; wp_reset_postdata(); ?>
  <?php endif; ?>
     </ul> 
  </div>
</div>
<?php }
add_shortcode('my_elementor_php_output_best_practices', 'wpc_elementor_shortcode_best_practices');

function wpc_elementor_shortcode_toolkits($atts)
{ ?>
<div class="container">
  <div class="row">
   <input type="text" id="filter2" onkeyup="filterList2()" placeholder="Search for Toolkits Title.." title="Type in a Best Practices">
   <ul id="item-list2"> 
 <style>
.image {
display: block;
width: 100%;
padding: 10px !important;
height: 230px !important;
}

.overlay {
position: absolute; 
bottom: 0; 
background: rgb(0, 0, 0);
background: rgba(0, 0, 0, 0.5); /* Black see-through */
color: #f1f1f1; 
width: 100%;
transition: .5s ease;
opacity:0;
color: white;
font-size: 20px;
padding: 20px;
text-align: center;
}

.container:hover .overlay {
opacity: 1;
}

#filter2 {
background-image: url('https://upyog.niua.in/homepage/wp-content/uploads/2024/01/searchicon.png');
background-position: 10px 12px;
background-repeat: no-repeat;
width: 100%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#item-list2 {
width: 100%;
float: left;
display: contents;
margin: 0;
padding: 0;
}

#item-list2 li {
width: 25%;
display: contents;
position: relative;
float: left;
max-width: 25%;

}	
  </style> 
   



<?php
$args = array(
'post_type' => 'resources',
'posts_per_page' => -1,
'tax_query' => array(
array(
'taxonomy' => 'resources_category', // Replace with the actual taxonomy name
'field'    => 'slug',
'terms'    => 'toolkits', // Replace with the actual category slug
),
),
);
$custom_query = new WP_Query($args);
if ($custom_query->have_posts()) :
while ($custom_query->have_posts()) : $custom_query->the_post();
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$external_link=get_field('external_link',$post->ID, );	
$iframe = get_field('video_url',$post->ID);
// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . ' class="image"></iframe>', $iframe);



?>

 <li>
   <div class="col-sm-3" style="margin: 0;padding: 10px 15px 10px 15px;">
     <div class="col-sm-12 main">
     <div class="left">
     <?php if($feat_image!="") { ?>
     <div class="image"><a href="<?php echo $external_link;?>" target="_blank"><img src="<?php echo $feat_image ;?>" class="image"></a></div>
     <?php } else { ?>
     <div class="image"><a href="<?php echo $external_link ;?>" target="_blank"><?php echo $iframe ;?></a></div>	
     <?php }  ?>
     <div class="titleimg"><h5><a href="<?php echo $external_link ;?>" target="_blank"><?php echo the_title();?></a></h5></div>	
     
     </div>
 

    </div>
    </div>
   </li>
<script>
    function filterList2() {
        // Get input value and convert to lowercase for case-insensitive filtering
        var filter = document.getElementById('filter2').value.toLowerCase();
        
        // Get the list items
        var items = document.getElementById('item-list2').getElementsByTagName('li');
        
        // Loop through each item and hide/show based on the filter
        for (var i = 0; i < items.length; i++) {
            var text = items[i].innerText.toLowerCase();
            if (text.indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
</script>
<?php endwhile; wp_reset_postdata(); ?>
  <?php endif; ?>
     </ul> 
  </div>
</div>
<?php }
add_shortcode('my_elementor_php_output_toolkits', 'wpc_elementor_shortcode_toolkits');

function wpc_elementor_shortcode_consultation_papers($atts)
{ ?>
<div class="container">
  <div class="row">
   <input type="text" id="filter3" onkeyup="filterList3()" placeholder="Search for Consultation Papers Title.." title="Type in a Consultation Papers">
   <ul id="item-list"> 
 <style>
.image {
display: block;
width: 100%;
padding: 10px !important;
height: 230px !important;
}

.overlay {
position: absolute; 
bottom: 0; 
background: rgb(0, 0, 0);
background: rgba(0, 0, 0, 0.5); /* Black see-through */
color: #f1f1f1; 
width: 100%;
transition: .5s ease;
opacity:0;
color: white;
font-size: 20px;
padding: 20px;
text-align: center;
}

.container:hover .overlay {
opacity: 1;
}

#filter3 {
background-image: url('https://upyog.niua.in/homepage/wp-content/uploads/2024/01/searchicon.png');
background-position: 10px 12px;
background-repeat: no-repeat;
width: 100%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#item-list3 {
width: 100%;
float: left;
display: contents;
margin: 0;
padding: 0;
}

#item-list3 li {
width: 25%;
display: contents;
position: relative;
float: left;
max-width: 25%;

}	
  </style> 
   



<?php
$args = array(
'post_type' => 'resources',
'posts_per_page' => -1,
'tax_query' => array(
array(
'taxonomy' => 'resources_category', // Replace with the actual taxonomy name
'field'    => 'slug',
'terms'    => 'consultation-papers', // Replace with the actual category slug
),
),
);
$custom_query = new WP_Query($args);
if ($custom_query->have_posts()) :
while ($custom_query->have_posts()) : $custom_query->the_post();
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$external_link=get_field('external_link',$post->ID, );	
$iframe = get_field('video_url',$post->ID);
// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . ' class="image"></iframe>', $iframe);



?>

 <li>
   <div class="col-sm-3" style="margin: 0;padding: 10px 15px 10px 15px;">
     <div class="col-sm-12 main">
     <div class="left">
     <?php if($feat_image!="") { ?>
     <div class="image"><a href="<?php echo $external_link;?>" target="_blank"><img src="<?php echo $feat_image ;?>" class="image"></a></div>
     <?php } else { ?>
     <div class="image"><a href="<?php echo $external_link ;?>" target="_blank"><?php echo $iframe ;?></a></div>	
     <?php }  ?>
     <div class="titleimg"><h5><a href="<?php echo $external_link ;?>" target="_blank"><?php echo the_title();?></a></h5></div>	
     
     </div>
 

    </div>
    </div>
   </li>
<script>
    function filterList3() {
        // Get input value and convert to lowercase for case-insensitive filtering
        var filter = document.getElementById('filter3').value.toLowerCase();
        
        // Get the list items
        var items = document.getElementById('item-list3').getElementsByTagName('li');
        
        // Loop through each item and hide/show based on the filter
        for (var i = 0; i < items.length; i++) {
            var text = items[i].innerText.toLowerCase();
            if (text.indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
</script>
<?php endwhile; wp_reset_postdata(); ?>
  <?php endif; ?>
     </ul> 
  </div>
</div>
<?php }
add_shortcode('my_elementor_php_output_consultation_papers', 'wpc_elementor_shortcode_consultation_papers');


function wpc_elementor_shortcode_standards($atts)
{ ?>
<div class="container">
  <div class="row">
   <input type="text" id="filter4" onkeyup="filterList4()" placeholder="Search for Standards Title.." title="Type in a Standards">
   <ul id="item-list4"> 
 <style>
.image {
display: block;
width: 100%;
padding: 10px !important;
height: 230px !important;
}

.overlay {
position: absolute; 
bottom: 0; 
background: rgb(0, 0, 0);
background: rgba(0, 0, 0, 0.5); /* Black see-through */
color: #f1f1f1; 
width: 100%;
transition: .5s ease;
opacity:0;
color: white;
font-size: 20px;
padding: 20px;
text-align: center;
}

.container:hover .overlay {
opacity: 1;
}

#filter4 {
background-image: url('https://upyog.niua.in/homepage/wp-content/uploads/2024/01/searchicon.png');
background-position: 10px 12px;
background-repeat: no-repeat;
width: 100%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#item-list4 {
width: 100%;
float: left;
display: contents;
margin: 0;
padding: 0;
}

#item-list4 li {
width: 25%;
display: contents;
position: relative;
float: left;
max-width: 25%;

}	
  </style> 
   



<?php
$args = array(
'post_type' => 'resources',
'posts_per_page' => -1,
'tax_query' => array(
array(
'taxonomy' => 'resources_category', // Replace with the actual taxonomy name
'field'    => 'slug',
'terms'    => 'standards', // Replace with the actual category slug
),
),
);
$custom_query = new WP_Query($args);
if ($custom_query->have_posts()) :
while ($custom_query->have_posts()) : $custom_query->the_post();
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$external_link=get_field('external_link',$post->ID, );	
$iframe = get_field('video_url',$post->ID);
// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . ' class="image"></iframe>', $iframe);



?>

 <li>
   <div class="col-sm-3" style="margin: 0;padding: 10px 15px 10px 15px;">
     <div class="col-sm-12 main">
     <div class="left">
     <?php if($feat_image!="") { ?>
     <div class="image"><a href="<?php echo $external_link;?>" target="_blank"><img src="<?php echo $feat_image ;?>" class="image"></a></div>
     <?php } else { ?>
     <div class="image"><a href="<?php echo $external_link ;?>" target="_blank"><?php echo $iframe ;?></a></div>	
     <?php }  ?>
     <div class="titleimg"><h5><a href="<?php echo $external_link ;?>" target="_blank"><?php echo the_title();?></a></h5></div>	
     
     </div>
 

    </div>
    </div>
   </li>
<script>
    function filterList4() {
        // Get input value and convert to lowercase for case-insensitive filtering
        var filter = document.getElementById('filter4').value.toLowerCase();
        
        // Get the list items
        var items = document.getElementById('item-list4').getElementsByTagName('li');
        
        // Loop through each item and hide/show based on the filter
        for (var i = 0; i < items.length; i++) {
            var text = items[i].innerText.toLowerCase();
            if (text.indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
</script>
<?php endwhile; wp_reset_postdata(); ?>
  <?php endif; ?>
     </ul> 
  </div>
</div>
<?php }
add_shortcode('my_elementor_php_output_standards', 'wpc_elementor_shortcode_standards');


function wpc_elementor_shortcode_search($atts)
{ ?>
<style>

.search-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
  background-color: #f9f9f9;
}

.search-box {
    display: flex;
    width: 100%;
    max-width: 800px;
    border: 1px solid #ddd;
    border-radius: 0px;
    overflow: hidden;
    background-color: #fff;
    margin: -40px 40px 40px 40px;
    height: 50px;
}

.search-input {
  flex: 1;
  padding: 12px 16px;
  border: none;
  outline: none;
  font-size: 16px;
  color: #333;
}

.search-input::placeholder {
  color: #aaa;
  font-style: italic;
}

.search-button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 0 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
background-color: transparent;
background-image: linear-gradient(180deg, #574B73 0%, #A43737 100%);

}

.search-button:hover {
background-color: transparent;
background-image: linear-gradient(180deg, #A43737  0%, #574B73 100%);
}

.search-button i {
  pointer-events: none;
}

</style>
<div class="search-wrapper">
  <form action="<?php echo home_url(); ?>" id="search-form" method="get">
    <div class="search-box">
      <input type="text" name="s" id="s" class="search-input" placeholder="Search for anything upyog...">
      <button type="submit" class="search-button">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
    </div>
  </form>
</div>


<?php }
add_shortcode('my_elementor_php_output_search', 'wpc_elementor_shortcode_search');


function wpc_elementor_shortcode_togglebutton($atts)
{ ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        margin-top: -43px;
    }
    .topmenu {
        display: flex;
        gap: 0.5rem;
        position: relative;
    }

    .topmenu-item {
        position: relative; /* Ensures submenu aligns below each main item */
    }

    .topmenu a {
        color: #fff;
        background-color: #574B73;
        text-decoration: none;
        padding: 0.5rem 1rem;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .topmenu a:hover {
        background-color: #A43737;
    }

    /* Icon Spacing */
    .icon {
        margin-right: 0.5rem; /* space between icon and text */
    }

    .arrow-icon {
        margin-left: 0.3rem; /* space between text and arrow */
        cursor: pointer;
    }

    /* Submenu */
    .topsubmenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #444;
        min-width: 200px;
        flex-direction: column;
        border-radius: 5px;
        margin-top: 0.1rem;
        z-index: 1;
    }

    .topsubmenu a {
        padding: 0.5rem 1rem;
        color: #fff;
        text-decoration: none;
        border-top: 1px solid #555;
    }

    .topsubmenu a:hover {
        background-color: #A43737;
    }

    /* Toggle Button */
    .toggle {
        display: none;
    }

    .toggle-label {
        display: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #fff;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .topmenu {
            display: none;
            flex-direction: column;
            width: 100%;
            position: absolute;
            top: 60px;
            left: 0;
            background-color: #A43737;
        }

        .topmenu a {
            padding: 1rem;
            border-top: 1px solid #fff;
            width: 100%;
        }

        .topsubmenu {
            position: static;
            display: none;
            flex-direction: column;
            background-color: #555;
        }

        .topmenu-item:focus-within .topsubmenu {
            display: flex;
        }

        .toggle:checked + .toggle-label + .topmenu {
            display: flex;
        }

        .toggle-label {
            display: block;
        }
    }
</style>

<header class="top-bar">
    <!-- Toggle Checkbox -->
    <input type="checkbox" id="toggle" class="toggle">
    
    <!-- Toggle Label (Hamburger Icon) -->
    <label for="toggle" class="toggle-label">&#9776;</label>

    <!-- Menu Items -->
    <nav class="topmenu">
        <div class="topmenu-item">
            <a href="javascript:void(0);" onclick="toggleSubmenu('register-submenu')">
                <i class="fa fa-user-plus icon"></i> Register
                <i class="fa fa-caret-down arrow-icon"></i>
            </a>
            <!-- Submenu Items -->
            <div class="topsubmenu" id="register-submenu">
                <a href="https://upyog.niua.org/upyog-ui/employee/user/login" target="_blank">Citizen Registration</a>
                <a href="https://upyog.niua.org/upyog-ui/employee/user/login" target="_blank">Employee Registration</a>
            </div>
        </div>
        <div class="topmenu-item">
            <a href="javascript:void(0);" onclick="toggleSubmenu('login-submenu')">
                <i class="fa fa-sign-in-alt icon"></i> Login
                <i class="fa fa-caret-down arrow-icon"></i>
            </a>
            <!-- Submenu Items -->
            <div class="topsubmenu" id="login-submenu">
                <a href="https://upyog.niua.org/upyog-ui/citizen/select-language" target="_blank">Citizen Login</a>
                <a href="https://upyog.niua.org/upyog-ui/employee/user/login" target="_blank">Employee Login</a>
                  
            </div>
        </div>
        <div class="topmenu-item">
            <a href="https://upyog-helpdesk.niua.org/" target="_blank">
                <i class="fa fa-user-circle icon"></i> Helpdesk
            </a>
        </div>
    </nav>
</header>

<script>
    function toggleSubmenu(submenuId) {
        // Get all submenus
        const submenus = document.querySelectorAll('.topsubmenu');
        submenus.forEach((submenu) => {
            // Hide all submenus except the one we are toggling
            if (submenu.id !== submenuId) {
                submenu.style.display = 'none';
            }
        });

        // Get the clicked submenu
        const submenu = document.getElementById(submenuId);
        // Toggle the display of the clicked submenu
        submenu.style.display = submenu.style.display === 'flex' ? 'none' : 'flex';
    }
</script>


<?php }
add_shortcode('my_elementor_php_output_togglebutton', 'wpc_elementor_shortcode_togglebutton');






function add_chatbot_js() {
    ?>
    <style>
        /* Chat button styling */
        #chat-button {
            position: fixed;
            bottom: 20px;
            right: 75px;
            width: 60px;
            height: 60px;
            background-color: #574B73;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1;
        }

        #chat-button svg {
            width: 30px;
            height: 30px;
            fill: white;
        }

        /* Chatbox styling */
        #chatbox {
            position: fixed;
            bottom: 20px;
            right: 75px;
            width: 300px;
            max-height: 400px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            font-family: Arial, sans-serif;
            z-index: 9999;
        }

        #chatbox-header {
            background-color: #574B73;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #chatbox-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.4;
        }

        .user-message {
            background-color: #e1f5fe;
            align-self: flex-end;
            color: #574B73;
        }

        .ai-message {
            background-color: #e8f5e9;
            align-self: flex-start;
            color: #1b5e20;
        }

        /* Typing indicator styling */
        .typing-indicator {
            display: flex;
            gap: 4px;
            align-self: flex-start;
        }

        .typing-indicator div {
            width: 6px;
            height: 6px;
            background-color: #1b5e20;
            border-radius: 50%;
            animation: typing 1.5s infinite;
        }

        .typing-indicator div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator div:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 80%, 100% {
                transform: scale(0);
            }
            40% {
                transform: scale(1);
            }
        }

        #chatbox-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        #chatbox-input input {
            flex: 1;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #chatbox-input button {
            background-color: #574B73;
            color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            margin-left: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #chatbox-input button:hover {
            background-color: #004085;
        }

        #chatbox-input button svg {
            width: 20px;
            height: 20px;
            fill: white;
        }
    </style>

    <!-- Chat button -->
    <div id="chat-button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"></path>
        </svg>
    </div>

    <!-- Chatbox -->
    <div id="chatbox">
        <div id="chatbox-header">
            Connect With Us
            <button id="close-chat" style="float: right; background: none; border: none; color: white; font-size: 16px; cursor: pointer;">&times;</button>
        </div>
        <div id="chatbox-messages">
            <div class="ai-message message">Welcome to UPYOG, I am an AI Chatbot. How may I be of assistance?</div>
        </div>
        <div id="chatbox-input">
            <input type="text" id="chat-input" placeholder="Type your message...">
            <button id="send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 22l21-10L3 2v8l15 2-15 2v8z"/>
                </svg>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const chatButton = document.getElementById('chat-button');
        const chatBox = document.getElementById('chatbox');
        const closeChat = document.getElementById('close-chat');
        const chatInput = document.getElementById('chat-input');
        const chatMessages = document.getElementById('chatbox-messages');
        const sendBtn = document.getElementById('send-btn');

        chatButton.addEventListener('click', () => {
            chatBox.style.display = 'flex';
            chatButton.style.display = 'none';
        });

        closeChat.addEventListener('click', () => {
            chatBox.style.display = 'none';
            chatButton.style.display = 'flex';
        });

        sendBtn.addEventListener('click', sendMessage);

        chatInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && chatInput.value.trim()) {
                sendMessage();
            }
        }); 
        function sendMessage() {
            const userMessage = chatInput.value.trim();
            if (userMessage) {
                const userMessageElement = document.createElement('div');
                userMessageElement.classList.add('message', 'user-message');
                userMessageElement.textContent = userMessage;
                chatMessages.appendChild(userMessageElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                chatInput.value = '';

                const typingIndicator = document.createElement('div');
                typingIndicator.classList.add('typing-indicator');
                typingIndicator.innerHTML = '<div></div><div></div><div></div>';
                chatMessages.appendChild(typingIndicator);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                setTimeout(() => {
                    $.ajax({
                        url: 'https://upyogchatbot.niua.in:8000/chatbot',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({ "user_input": userMessage }),
                        success: function(response) {
                            typingIndicator.remove();
                            const botMessageElement = document.createElement('div');
                            botMessageElement.classList.add('message', 'ai-message');
                            botMessageElement.textContent = response.response;
                            chatMessages.appendChild(botMessageElement);
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        },
                        error: function() {
                            typingIndicator.remove();
                            const botMessageElement = document.createElement('div');
                            botMessageElement.classList.add('message', 'ai-message');
                            botMessageElement.textContent = 'Sorry, there was an error.';
                            chatMessages.appendChild(botMessageElement);
                        }
                    });
                }, 2000);
            }
        }
    </script>
    <?php
}
add_action('wp_footer', 'add_chatbot_js');





// Hook to add the main admin menu and submenus
add_action('admin_menu', function () {
    // Add main menu item
    add_menu_page(
        'Custom Hit Counter',      
        'Custom Hit Counter',      
        'manage_options',          
        'custom-hit-counter',      
        '',                        
        'dashicons-chart-bar',     
        2                          
    );

    // Add submenu for CSV Export
    add_submenu_page(
        'custom-hit-counter',      
        'CSV Export',              
        'CSV Export',              
        'manage_options',          
        'custom-hit-counter-csv',  
        'export_hit_counter_csv'   
    );

    // Add submenu for Excel Export
    add_submenu_page(
        'custom-hit-counter',      
        'Excel Export',            
        'Excel Export',            
        'manage_options',          
        'custom-hit-counter-excel', 
        'export_hit_counter_excel' 
    );
});

// Function to handle CSV Export
function export_hit_counter_csv() {
  // Check permissions
  if (!current_user_can('manage_options')) {
      wp_die('You do not have sufficient permissions to access this page.');
  }

  // Ensure no unnecessary output
  if (ob_get_level()) {
      ob_end_clean();
  }

  global $wpdb;
  $table_name = $wpdb->prefix . "hit_counter"; // Your table name
  $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

  // Start HTML table for display
  echo '<table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-bottom:20px;">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>IP Address</th>';
  echo '<th>Last Visit</th>';
  echo '<th>Daily Count</th>';
  echo '<th>Weekly Count</th>';
  echo '<th>Monthly Count</th>';
  echo '<th>Yearly Count</th>';
  echo '<th>Total Count</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  // Display table data
  if (!empty($results)) {
      foreach ($results as $row) {
          echo '<tr>';
          echo '<td>' . esc_html($row['id']) . '</td>';
          echo '<td>' . esc_html($row['ip_address']) . '</td>';
          echo '<td>' . esc_html($row['last_visit']) . '</td>';
          echo '<td>' . esc_html($row['daily_count']) . '</td>';
          echo '<td>' . esc_html($row['weekly_count']) . '</td>';
          echo '<td>' . esc_html($row['monthly_count']) . '</td>';
          echo '<td>' . esc_html($row['yearly_count']) . '</td>';
          echo '<td>' . esc_html($row['total_count']) . '</td>';
          echo '</tr>';
      }
  } else {
      echo '<tr><td colspan="8">No records found</td></tr>';
  }

  echo '</tbody>';
  echo '</table>';

  // Set CSV headers for download
  header("Content-Type: text/csv");
  header("Content-Disposition: attachment; filename=hit_counter_export.csv");
  header("Pragma: no-cache");
  header("Expires: 0");

  // Open PHP output stream for CSV export
  $output = fopen('php://output', 'w');

  // Add CSV column headers
  fputcsv($output, ["ID", "IP Address", "Last Visit", "Daily Count", "Weekly Count", "Monthly Count", "Yearly Count", "Total Count"]);

  // Add data rows to CSV
  if (!empty($results)) {
      foreach ($results as $row) {
          fputcsv($output, [
              $row['id'], $row['ip_address'], $row['last_visit'], $row['daily_count'],
              $row['weekly_count'], $row['monthly_count'], $row['yearly_count'], $row['total_count']
          ]);
      }
  } else {
      fputcsv($output, ["No records found"]);
  }

  fclose($output);
  exit;
}



// Function to handle Excel Export
function export_hit_counter_excel() {
    // Check permissions
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    // Ensure no unnecessary output
    if (ob_get_level()) {
        ob_end_clean();
    }

    global $wpdb;
    $table_name = $wpdb->prefix . "hit_counter"; // Your table name
    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    // Set Excel headers
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=hit_counter_export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Start Excel table
    echo '<table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Last Visit</th>
                <th>Daily Count</th>
                <th>Weekly Count</th>
                <th>Monthly Count</th>
                <th>Yearly Count</th>
                <th>Total Count</th>
            </tr>
        </thead>
        <tbody>';

    // Add data rows
    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['ip_address']}</td>
                <td>{$row['last_visit']}</td>
                <td>{$row['daily_count']}</td>
                <td>{$row['weekly_count']}</td>
                <td>{$row['monthly_count']}</td>
                <td>{$row['yearly_count']}</td>
                <td>{$row['total_count']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found</td></tr>";
    }

    // End Excel table
    echo '</tbody>
    </table>';
    exit;
}