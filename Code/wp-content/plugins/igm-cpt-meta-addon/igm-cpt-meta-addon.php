<?php

/**
 * Interactive Geo Maps - Post Types & Meta Addon
 *
 * @wordpress-plugin
 * Plugin Name:       Interactive Geo Maps - Post Types & Meta Addon
 * Description:       Interactive Geo Maps Pro Addon. Populate map with data from post types and meta fields. Compatible with Advanced Custom Fields - ACF. Only works with the Pro version of Interactive Geo Maps.
 * Version:           1.0.11
 * Requires PHP:      7.0
 * Author:            Carlos Moreira
 * Author URI:        https://cmoreira.net/
 *
 */
if ( !function_exists( 'igmcptmetaaddon' ) ) {
    // Create a helper function for easy SDK access.
    function igmcptmetaaddon()
    {
        global  $igmcptmetaaddon ;
        
        if ( !isset( $igmcptmetaaddon ) ) {
            // Include Freemius SDK.
            
            if ( file_exists( dirname( dirname( __FILE__ ) ) . '/interactive-geo-maps/vendor/freemius/wordpress-sdk/start.php' ) ) {
                // Try to load SDK from parent plugin folder.
                require_once dirname( dirname( __FILE__ ) ) . '/interactive-geo-maps/vendor/freemius/wordpress-sdk/start.php';
            } else {
                
                if ( file_exists( dirname( dirname( __FILE__ ) ) . '/interactive-geo-maps-premium/vendor/freemius/wordpress-sdk/start.php' ) ) {
                    // Try to load SDK from premium parent plugin folder.
                    require_once dirname( dirname( __FILE__ ) ) . '/interactive-geo-maps-premium/vendor/freemius/wordpress-sdk/start.php';
                } else {
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                }
            
            }
			class igmcptmetaaddonNull {
				public function can_use_premium_code() {
					return true;
				}
                public function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
                    add_filter( $tag, $function_to_add, $priority, $accepted_args );
                }

                public function add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
                    add_action( $tag, $function_to_add, $priority, $accepted_args );
                }
			}
            $igmcptmetaaddon = new igmcptmetaaddonNull();
        }
        
        return $igmcptmetaaddon;
    }

}
function igmcptmetaaddon_is_parent_active_and_loaded()
{
    // Check if the parent's init SDK method exists.
    return function_exists( 'Saltus\\WP\\Plugin\\Saltus\\InteractiveMaps\\igmfreemiusinit' );
}

function igmcptmetaaddon_is_parent_active()
{
    $active_plugins = get_option( 'active_plugins', array() );
    
    if ( is_multisite() ) {
        $network_active_plugins = get_site_option( 'active_sitewide_plugins', array() );
        $active_plugins = array_merge( $active_plugins, array_keys( $network_active_plugins ) );
    }
    
    foreach ( $active_plugins as $basename ) {
        if ( 0 === strpos( $basename, 'interactive-geo-maps/' ) || 0 === strpos( $basename, 'interactive-geo-maps-premium/' ) ) {
            return true;
        }
    }
    return false;
}

function igmcptmetaaddon_init()
{
    
    if ( igmcptmetaaddon_is_parent_active_and_loaded() ) {
        // Init Freemius.
        igmcptmetaaddon();
        // Signal that the add-on's SDK was initiated.
        do_action( 'igmcptmetaaddon_loaded' );
        // Parent is active, add your init code here.
        if ( igmcptmetaaddon()->can_use_premium_code() ) {
            $igm_acf_plugin = new IGM_ACF_ADDON();
        }
    } else {
        // Parent is inactive, add your error handling here.
    }

}


if ( igmcptmetaaddon_is_parent_active_and_loaded() ) {
    // If parent already included, init add-on.
    igmcptmetaaddon_init();
} else {
    
    if ( igmcptmetaaddon_is_parent_active() ) {
        // Init add-on only after the parent is loaded.
        add_action( 'igmfreemiusinit_loaded', 'igmcptmetaaddon_init' );
    } else {
        // Even though the parent is not activated, execute add-on for activation / uninstall hooks.
        igmcptmetaaddon_init();
    }

}

class IGM_ACF_ADDON
{
    /**
     * Construct class - add filters
     */
    function __construct()
    {
        // add pro meta options
        add_filter(
            'igm_model',
            array( $this, 'addon_fields' ),
            20,
            1
        );
        add_filter( 'igm_add_meta', array( $this, 'addon_meta' ), 1 );
    }
    
    /**
     * Populate map meta options with CPT/ACF options in other data sources
     * @array $model - current meta fields
     * return $model - modified meta
     */
    public function addon_fields( $model )
    {
        // REGIONS
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['type']['options']['cpt_acf'] = __( 'Post Types & Meta Fields', 'igm-cpt-meta-addon' );
        // post types
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_post_types'] = [
            'type'       => 'select',
            'default'    => '',
            'options'    => 'post_types',
            'title'      => __( 'Post Types', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Select from which post types to read from', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // use ACF meta fields
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_use_acf'] = [
            'type'       => 'switcher',
            'default'    => false,
            'desc'       => __( 'If your meta fields were created with ACF, enable this option.', 'igm-cpt-meta-addon' ),
            'title'      => __( 'Use ACF', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // use ACF repeater field
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_repeater'] = [
            'type'       => 'switcher',
            'default'    => false,
            'title'      => __( 'Repeater field', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Enable if your data is contained inside an ACF repeater field.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ], [ 'cpt_acf_use_acf', '==', true ] ],
        ];
        // repeater ID
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_repeater_field'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Repeater Field Identifier', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Identifier of the repeater field that contains your data.', 'igm-cpt-meta-addon' ),
            'dependency' => [
            [ 'enabled', '==', true ],
            [ 'type', '==', 'cpt_acf' ],
            [ 'cpt_acf_use_acf', '==', true ],
            [ 'cpt_acf_repeater', '==', true ]
        ],
        ];
        // use only data from current page
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_current'] = [
            'type'       => 'switcher',
            'default'    => false,
            'title'      => __( 'Only from current page', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Enable this option if your plan to add this map to a specific page and only need the data from that page to display. <br>Do not use the <code>post_content</code> placeholder in the fields below, if you have this option enabled. It will cause an error.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // use Relashionship field
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_relashionship'] = [
            'type'       => 'switcher',
            'default'    => false,
            'title'      => __( 'Relationship field', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Enable if your data is contained inside an ACF relashionship field. If enabled, the map will fetch the content from the connected entries.', 'igm-cpt-meta-addon' ),
            'dependency' => [
            [ 'enabled', '==', true ],
            [ 'type', '==', 'cpt_acf' ],
            [ 'cpt_acf_use_acf', '==', true ],
            [ 'cpt_acf_current', '==', true ]
        ],
        ];
        // relashionship ID
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_relashionship_field'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Relashionship Field Identifier', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Identifier of the relashionship field that contains your data. When enabled, the fields below will be fetched from the content of your relashionship data. You can use <code>post_title</code> and <code>permalink</code> placeholders also.', 'igm-cpt-meta-addon' ),
            'dependency' => [
            [ 'enabled', '==', true ],
            [ 'type', '==', 'cpt_acf' ],
            [ 'cpt_acf_use_acf', '==', true ],
            [ 'cpt_acf_current', '==', true ],
            [ 'cpt_acf_relashionship', '==', true ]
        ],
        ];
        // region code
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_id'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Region Code Field (Mandatory)', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Identifier of the field containing the region code or name.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_fields'] = [
            'type'         => 'group',
            'button_title' => __( 'Add New Field', 'igm-cpt-meta-addon' ),
            'title'        => __( 'Other Map Fields', 'igm-cpt-meta-addon' ),
            'desc'         => __( 'Specify other fields from the post type to populate the map entries.', 'igm-cpt-meta-addon' ),
            'fields'       => [
            'parameter' => [
            'type'    => 'select',
            'title'   => __( 'Map to Field', 'igm-cpt-meta-addon' ),
            'desc'    => __( 'Select which field you want to map', 'igm-cpt-meta-addon' ),
            'options' => [
            'tooltipContent' => __( 'Tooltip Content', 'igm-cpt-meta-addon' ),
            'content'        => __( 'Action Content', 'igm-cpt-meta-addon' ),
            'value'          => __( 'Value', 'igm-cpt-meta-addon' ),
            'fill'           => __( 'Fill Colour', 'igm-cpt-meta-addon' ),
            'hover'          => __( 'Hover Colour', 'igm-cpt-meta-addon' ),
            'custom'         => __( ' Field', 'igm-cpt-meta-addon' ),
        ],
        ],
            'field_id'  => [
            'type'  => 'text',
            'title' => __( 'Field Identifier', 'igm-cpt-meta-addon' ),
            'desc'  => __( 'Identifier for the meta field. You can use placeholders like <code>post_content</code>, <code>post_excerpt</code>, <code>permalink</code> and <code>featured_image</code>. <br> You can use dot notation (parameter.field) for all fields except the custom fields.', 'igm-cpt-meta-addon' ),
        ],
        ],
            'dependency'   => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // query params
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_query'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Advanced Query Paramaters', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Use JSON format with WP_Query paramaters you want to add to this query. You can use this for example to filter entries from a specific taxonomy.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // move the content template field to the end.
        $temp_content = $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['action_content_template'];
        unset( $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['action_content_template'] );
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['action_content_template'] = $temp_content;
        $model['meta']['map_info']['sections']['regions']['fields']['regionsDataSource']['fields']['cpt_acf_info'] = [
            'type'       => 'content',
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
            'content'    => __( '<strong>Information</strong><br>- You can use dot notation for the fields identifiers (for example <code>location.lat</code>) to identify an array value;<br>- In the Action Content Template, you can only use placeholders that come from the mapped fields above.;', 'igm-cpt-meta-addon' ),
        ];
        // ROUND MARKERS
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['type']['options']['cpt_acf'] = __( 'Post Types & Meta Fields', 'igm-cpt-meta-addon' );
        // post types
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_post_types'] = [
            'type'       => 'select',
            'default'    => '',
            'options'    => 'post_types',
            'title'      => __( 'Post Types', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Select from which post types to read from', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // use ACF meta fields
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_use_acf'] = [
            'type'       => 'switcher',
            'default'    => false,
            'desc'       => __( 'If your meta fields were created with ACF, enable this option.', 'igm-cpt-meta-addon' ),
            'title'      => __( 'Use ACF', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // use ACF repeater field
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_repeater'] = [
            'type'       => 'switcher',
            'default'    => false,
            'title'      => __( 'Repeater field', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Enable if your data is contained inside an ACF repeater field.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ], [ 'cpt_acf_use_acf', '==', true ] ],
        ];
        // repeater ID
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_repeater_field'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Repeater Field Identifier', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Identifier of the repeater field that contains your data.', 'igm-cpt-meta-addon' ),
            'dependency' => [
            [ 'enabled', '==', true ],
            [ 'type', '==', 'cpt_acf' ],
            [ 'cpt_acf_use_acf', '==', true ],
            [ 'cpt_acf_repeater', '==', true ]
        ],
        ];
        // use only data from current page
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_current'] = [
            'type'       => 'switcher',
            'default'    => false,
            'title'      => __( 'Only from current page', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Enable this option if your plan to add this map to a specific page and only need the data from that page to display. <br>Do not use the <code>post_content</code> placeholder in the fields below, if you have this option enabled. It will cause an error.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // latitude code
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_latitude'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Latitude Field (Mandatory)', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Identifier of the field containing the latitude.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // latitude code
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_longitude'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Longitude Field (Mandatory)', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Identifier of the field containing the longitude.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_fields'] = [
            'type'         => 'group',
            'button_title' => __( 'Add New Field', 'igm-cpt-meta-addon' ),
            'title'        => __( 'Other Map Fields', 'igm-cpt-meta-addon' ),
            'desc'         => __( 'Specify other fields from the post type to populate the map entries.', 'igm-cpt-meta-addon' ),
            'fields'       => [
            'parameter' => [
            'type'    => 'select',
            'title'   => __( 'Map to Field', 'igm-cpt-meta-addon' ),
            'desc'    => __( 'Select which field you want to map', 'igm-cpt-meta-addon' ),
            'options' => [
            'tooltipContent' => __( 'Tooltip Content', 'igm-cpt-meta-addon' ),
            'content'        => __( 'Action Content', 'igm-cpt-meta-addon' ),
            'value'          => __( 'Value', 'igm-cpt-meta-addon' ),
            'fill'           => __( 'Fill Colour', 'igm-cpt-meta-addon' ),
            'hover'          => __( 'Hover Colour', 'igm-cpt-meta-addon' ),
            'custom'         => __( 'Custom Field', 'igm-cpt-meta-addon' ),
        ],
        ],
            'field_id'  => [
            'type'  => 'text',
            'title' => __( 'Field Identifier', 'igm-cpt-meta-addon' ),
            'desc'  => __( 'Identifier for the meta field. You can use placeholders like <code>post_content</code>, <code>post_excerpt</code> or <code>featured_image</code>. <br> You can use dot notation (parameter.field) for all fields except the custom fields.', 'igm-cpt-meta-addon' ),
        ],
        ],
            'dependency'   => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // query params
        $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields']['cpt_acf_query'] = [
            'type'       => 'text',
            'default'    => '',
            'title'      => __( 'Advanced Query Paramaters', 'igm-cpt-meta-addon' ),
            'desc'       => __( 'Use JSON format with WP_Query paramaters you want to add to this query. You can use this for example to filter entries from a specific taxonomy.', 'igm-cpt-meta-addon' ),
            'dependency' => [ [ 'enabled', '==', true ], [ 'type', '==', 'cpt_acf' ] ],
        ];
        // IMAGE MARKERS
        
        if ( isset( $model['meta']['map_info']['sections']['imageMarkers'] ) ) {
            $model['meta']['map_info']['sections']['imageMarkers']['fields']['imageMarkersDataSource']['fields']['type']['options']['cpt_acf'] = __( 'Post Types & Meta Fields', 'igm-cpt-meta-addon' );
            // just copy everything from the markers
            $model['meta']['map_info']['sections']['imageMarkers']['fields']['imageMarkersDataSource']['fields'] = $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields'];
        }
        
        
        if ( isset( $model['meta']['map_info']['sections']['iconMarkers'] ) ) {
            // ICON MARKERS
            $model['meta']['map_info']['sections']['iconMarkers']['fields']['iconMarkersDataSource']['fields']['type']['options']['cpt_acf'] = __( 'Post Types & Meta Fields', 'igm-cpt-meta-addon' );
            // just copy everything from the markers
            $model['meta']['map_info']['sections']['iconMarkers']['fields']['iconMarkersDataSource']['fields'] = $model['meta']['map_info']['sections']['roundMarkers']['fields']['markersDataSource']['fields'];
        }
        
        return $model;
    }
    
    /**
     * Filter map output
     * @param array $meta - meta data from the map
     * @return array modified meta 
     */
    public function addon_meta( $meta )
    {
        $types = [
            'regions',
            'roundMarkers',
            'imageMarkers',
            'iconMarkers'
        ];
        foreach ( $types as $type ) {
            $meta = $this->process_meta( $meta, $type );
        }
        return $meta;
    }
    
    /**
     * Get value from a repeater acf field
     *
     * @param array $repeater full value array
     * @param string $field field we need to get
     * @param array $this_post current post in the query
     * @return misc value for requested field  
     */
    private function get_repeater_value( $rp_entry, $field, $this_post )
    {
        if ( $field == 'post_content' ) {
            //return do_shortcode( $this_post->post_content );
            return $this_post->post_content;
        }
        if ( $field === 'post_title' ) {
            return $this_post->post_title;
        }
        if ( $field === 'post_excerpt' && !$custom_source['cpt_acf_current'] ) {
            return $this_post->post_excerpt;
        }
        if ( $field === 'permalink' ) {
            return get_the_permalink( $this_post->ID );
        }
        if ( property_exists( $this_post, $field ) ) {
            return $this_post->{$field};
        }
        if ( isset( $rp_entry[$field] ) ) {
            return $rp_entry[$field];
        }
        $taxs = get_object_taxonomies( $this_post->post_type );
        
        if ( !empty($taxs) && in_array( $field, $taxs ) ) {
            $terms = get_the_terms( $this_post->ID, $field );
            if ( empty($terms) ) {
                return '';
            }
            $termsString = '';
            foreach ( $terms as $term ) {
                $termsString .= $term->name . ', ';
            }
            return rtrim( $termsString, ', ' );
        }
        
        return '';
    }
    
    /**
     * Get ids of posts for specific relationship value
     *
     * @param [type] $id - parent post id
     * @param [type] $field - name of the field
     * @return void
     */
    private function get_relationship_ids( $id, $field )
    {
        $ids = [];
        // when using ACF
        
        if ( function_exists( 'get_field' ) ) {
            $acf = get_field( $field, $id );
            if ( !is_array( $acf ) ) {
                return $ids;
            }
            foreach ( $acf as $post ) {
                // if it's an ID
                
                if ( is_integer( $post ) ) {
                    array_push( $ids, $post );
                } else {
                    // we assume is a WP_POST obj
                    if ( is_object( $post ) ) {
                        array_push( $ids, $post->ID );
                    }
                }
            
            }
        }
        
        return $ids;
    }
    
    /**
     * get field value
     *
     * @param array $this_post current post being queried
     * @param string $field identifier of the field to get
     * @param array $custom_source options from the map sources 
     * @return void
     */
    private function get_field( $this_post, $field, $custom_source )
    {
        if ( $field == 'post_content' ) {
            //return do_shortcode( $this_post->post_content );
            return $this_post->post_content;
        }
        if ( $field === 'post_title' ) {
            return $this_post->post_title;
        }
        if ( $field === 'post_excerpt' && !$custom_source['cpt_acf_current'] ) {
            return $this_post->post_excerpt;
        }
        if ( $field === 'permalink' ) {
            return get_the_permalink( $this_post->ID );
        }
        if ( $field === 'featured_image' ) {
            return get_the_post_thumbnail_url( $this_post->ID );
        }
        if ( property_exists( $this_post, $field ) ) {
            return $this_post->{$field};
        }
        $taxs = get_object_taxonomies( $this_post->post_type );
        
        if ( !empty($taxs) && in_array( $field, $taxs ) ) {
            $terms = get_the_terms( $this_post->ID, $field );
            if ( empty($terms) ) {
                return '';
            }
            $termsString = '';
            foreach ( $terms as $term ) {
                $termsString .= $term->name . ', ';
            }
            return rtrim( $termsString, ', ' );
        }
        
        $dot_notation = strpos( $field, '.' );
        // if there's dot notation being used
        
        if ( $dot_notation ) {
            $path = $field;
            $fieldarr = explode( '.', $field );
            $field = $fieldarr[0];
            $path = str_replace( $field . '.', '', $path );
        }
        
        // if we are not using ACF
        
        if ( !$custom_source['cpt_acf_use_acf'] ) {
            $acf = get_post_meta( $this_post->ID, $field, true );
        } else {
            // when using ACF
            
            if ( function_exists( 'get_field' ) ) {
                $acf = get_field( $field, $this_post->ID );
                // if it's not a string, check what type of field we're using
                
                if ( !is_string( $acf ) ) {
                    $fieldObj = get_field_object( $field, $this_post );
                    // for a relashionship field type, we get each of the titles
                    
                    if ( $fieldObj && $fieldObj['type'] === 'relationship' ) {
                        $data = [];
                        foreach ( $acf as $post ) {
                            // if it's an ID
                            
                            if ( is_integer( $post ) ) {
                                $entry = get_post( $post );
                                if ( $entry ) {
                                    array_push( $data, $entry->post_title );
                                }
                            } else {
                                // we assume is a WP_POST obj
                                if ( is_object( $post ) ) {
                                    array_push( $data, $post->post_title );
                                }
                            }
                        
                        }
                        $acf = $data;
                    }
                
                }
            
            } else {
                $acf = '';
            }
        
        }
        
        // if we're using dot notation, find proper value
        if ( $dot_notation ) {
            $acf = $this->getArrayValueByDotNotation( $acf, $path );
        }
        return $acf;
    }
    
    /**
     * Get array value with dot notation path
     *
     * @param array $arr
     * @param string $path
     * @param string $separator
     * @return void
     */
    private function getArrayValueByDotNotation( $arr, $path, $separator = '.' )
    {
        $keys = explode( '.', $path );
        foreach ( $keys as $key ) {
            if ( isset( $arr[$key] ) ) {
                $arr = $arr[$key];
            }
        }
        if ( !is_array( $arr ) ) {
            return $arr;
        }
        return false;
    }
    
    /**
     * Processs meta data to read content from post types and meta fields
     *
     * @param array $meta
     * @param string $type
     * @return void
     */
    public function process_meta( $meta, $type )
    {
        $types = [
            'regions'      => 'regionsDataSource',
            'roundMarkers' => 'markersDataSource',
            'imageMarkers' => 'imageMarkersDataSource',
            'iconMarkers'  => 'iconMarkersDataSource',
        ];
        $defaults = [
            'regions'      => 'regionDefaults',
            'roundMarkers' => 'markerDefaults',
            'imageMarkers' => 'imageMarkerDefaults',
            'iconMarkers'  => 'iconMarkerDefaults',
        ];
        $source = $types[$type];
        $custom_source = ( isset( $meta[$source] ) ? $meta[$source] : false );
        
        if ( $custom_source && isset( $custom_source['enabled'] ) && '1' === $custom_source['enabled'] && $custom_source['type'] === 'cpt_acf' ) {
            if ( empty($meta[$type]) ) {
                $meta[$type] = array();
            }
            $post_type = $custom_source['cpt_acf_post_types'];
            $use_acf = $custom_source['cpt_acf_use_acf'];
            $use_repeater = $custom_source['cpt_acf_repeater'];
            $repeater_field = $custom_source['cpt_acf_repeater_field'];
            $current = $custom_source['cpt_acf_current'];
            $use_relashionship = ( isset( $custom_source['cpt_acf_relashionship'] ) ? $custom_source['cpt_acf_relashionship'] : false );
            $relashionship_fld = ( isset( $custom_source['cpt_acf_relashionship_field'] ) ? $custom_source['cpt_acf_relashionship_field'] : '' );
            $json_args = $custom_source['cpt_acf_query'];
            // regions
            $id_field = ( $type === 'regions' ? $custom_source['cpt_acf_id'] : false );
            // other fields
            $fields = ( isset( $custom_source['cpt_acf_fields'] ) ? $custom_source['cpt_acf_fields'] : false );
            // for markers
            $latitude_field = ( isset( $custom_source['cpt_acf_latitude'] ) ? $custom_source['cpt_acf_latitude'] : false );
            $longitude_field = ( isset( $custom_source['cpt_acf_longitude'] ) ? $custom_source['cpt_acf_longitude'] : false );
            // we will query the custom post types and loop through them
            $args = array(
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'post_type'      => $post_type,
            );
            
            if ( $current && !is_admin() ) {
                global  $post ;
                $args['include'] = [ $post->ID ];
                // if we use a relationship field
                
                if ( $use_relashionship && $relashionship_fld !== '' ) {
                    $relationship_data = $this->get_relationship_ids( $post->ID, $relashionship_fld );
                    $args['include'] = $relationship_data;
                    // unset post type
                    $args['post_type'] = 'any';
                }
            
            }
            
            
            if ( '' !== $json_args ) {
                $json_args = json_decode( $json_args, true );
                if ( $json_args ) {
                    $args = array_merge( $args, $json_args );
                }
            }
            
            $posts = get_posts( $args );
            $data = [];
            // loop posts.
            foreach ( $posts as $this_post ) {
                if ( $type === 'regions' && empty($id_field) ) {
                    continue;
                }
                // if there's no latitude or longitude fields, skip
                if ( $type !== 'regions' && (empty($latitude_field) || empty($latitude_field)) ) {
                    continue;
                }
                // we can default the title to the post title, it's harmless
                $title = $this_post->post_title;
                $permalink = get_the_permalink( $this_post->ID );
                $featured_image = get_the_post_thumbnail_url( $this_post->ID );
                // if we use a repeater field, first we get all data and then loop through it
                
                if ( $use_repeater ) {
                    $repeater_data = $this->get_field( $this_post, $repeater_field, $custom_source );
                    if ( !is_array( $repeater_data ) ) {
                        continue;
                    }
                    foreach ( $repeater_data as $key => $rp_entry ) {
                        // prepare fields.
                        $dot_notation = strpos( $id_field, '.' );
                        // if there's dot notation being used
                        
                        if ( $dot_notation ) {
                            $path = $id_field;
                            $fieldarr = explode( '.', $id_field );
                            $field_id = $fieldarr[0];
                            $path = str_replace( $id_field . '.', '', $path );
                            $id = $this->getArrayValueByDotNotation( $rp_entry, $path );
                        } else {
                            $id = ( $type === 'regions' ? $rp_entry[$id_field] : $this_post->ID );
                        }
                        
                        if ( !$id ) {
                            continue;
                        }
                        // in case they are multiple entries, convert to string
                        if ( is_array( $id ) && is_string( $id[0] ) ) {
                            $id = implode( ",", $id );
                        }
                        $entry = array(
                            'id'             => $id,
                            'title'          => $title,
                            'permalink'      => $permalink,
                            'featured_image' => $featured_image,
                        );
                        $entry[$repeater_field] = $repeater_data[$key];
                        // if we're dealing with markers
                        
                        if ( $type !== 'regions' ) {
                            $dot_notation = strpos( $latitude_field, '.' );
                            
                            if ( $dot_notation ) {
                                $path = $latitude_field;
                                $fieldarr = explode( '.', $latitude_field );
                                $field_id = $fieldarr[0];
                                $path = str_replace( $latitude_field . '.', '', $path );
                                $latitude = $this->getArrayValueByDotNotation( $rp_entry, $path );
                            } else {
                                $latitude = $rp_entry[$latitude_field];
                            }
                            
                            $dot_notation = strpos( $longitude_field, '.' );
                            
                            if ( $dot_notation ) {
                                $path = $longitude_field;
                                $fieldarr = explode( '.', $longitude_field );
                                $field_id = $fieldarr[0];
                                $path = str_replace( $longitude_field . '.', '', $path );
                                $longitude = $this->getArrayValueByDotNotation( $rp_entry, $path );
                            } else {
                                $longitude = $rp_entry[$longitude_field];
                            }
                            
                            if ( is_array( $latitude ) ) {
                                $latitude = ( ( isset( $latitude['latitude'] ) ? $latitude['latitude'] : isset( $latitude['lat'] ) ) ? $latitude['lat'] : 0 );
                            }
                            if ( is_array( $longitude ) ) {
                                $longitude = ( ( isset( $longitude['longitude'] ) ? $longitude['longitude'] : isset( $longitude['lng'] ) ) ? $longitude['lng'] : 0 );
                            }
                            if ( empty($latitude) || empty($longitude) ) {
                                continue;
                            }
                            $entry['latitude'] = floatval( $latitude );
                            $entry['longitude'] = floatval( $longitude );
                        }
                        
                        if ( is_array( $fields ) ) {
                            foreach ( $fields as $field ) {
                                
                                if ( $field['parameter'] === 'custom' ) {
                                    $entry[$field['field_id']] = $this->get_repeater_value( $rp_entry, $field['field_id'], $this_post );
                                    continue;
                                }
                                
                                $dot_notation = strpos( $field['field_id'], '.' );
                                // if there's dot notation being used
                                
                                if ( $dot_notation ) {
                                    $path = $field['field_id'];
                                    $fieldarr = explode( '.', $field['field_id'] );
                                    $field_id = $fieldarr[0];
                                    $path = str_replace( $field['field_id'] . '.', '', $path );
                                    $entry[$field['parameter']] = $this->getArrayValueByDotNotation( $rp_entry, $path );
                                } else {
                                    $entry[$field['parameter']] = $this->get_repeater_value( $rp_entry, $field['field_id'], $this_post );
                                }
                            
                            }
                        }
                        
                        if ( isset( $entry['fill'] ) ) {
                            $entry['useDefaults'] = '0';
                            if ( !isset( $entry['hover'] ) ) {
                                $entry['hover'] = $entry['fill'];
                            }
                        }
                        
                        if ( !isset( $entry['fill'] ) ) {
                            $entry['useDefaults'] = '1';
                        }
                        // for now we always inherit the default click action, unless overriden as a custom entry
                        if ( !isset( $entry['action'] ) ) {
                            $entry['action'] = $meta[$defaults[$type]]['action'];
                        }
                        if ( !isset( $entry['tooltipContent'] ) ) {
                            $entry['tooltipContent'] = $this_post->post_title;
                        }
                        array_push( $data, $entry );
                    }
                } else {
                    // prepare fields.
                    $id = ( $type === 'regions' ? $this->get_field( $this_post, $id_field, $custom_source ) : strval( $this_post->ID ) );
                    if ( !$id ) {
                        continue;
                    }
                    // in case they are multiple entries, convert to string
                    if ( is_array( $id ) && is_string( $id[0] ) ) {
                        $id = implode( ",", $id );
                    }
                    // if at this point we don't have a string, skip
                    if ( !is_string( $id ) ) {
                        continue;
                    }
                    $entry = array(
                        'id'             => $id,
                        'title'          => $title,
                        'permalink'      => $permalink,
                        'featured_image' => $featured_image,
                    );
                    // if we're dealing with markers
                    
                    if ( $type !== 'regions' ) {
                        $latitude = $this->get_field( $this_post, $latitude_field, $custom_source );
                        $longitude = $this->get_field( $this_post, $longitude_field, $custom_source );
                        if ( is_array( $latitude ) ) {
                            $latitude = ( ( isset( $latitude['latitude'] ) ? $latitude['latitude'] : isset( $latitude['lat'] ) ) ? $latitude['lat'] : 0 );
                        }
                        if ( is_array( $longitude ) ) {
                            $longitude = ( ( isset( $longitude['longitude'] ) ? $longitude['longitude'] : isset( $longitude['lng'] ) ) ? $longitude['lng'] : 0 );
                        }
                        if ( empty($latitude) || empty($longitude) ) {
                            continue;
                        }
                        $entry['latitude'] = floatval( $latitude );
                        $entry['longitude'] = floatval( $longitude );
                    }
                    
                    if ( is_array( $fields ) ) {
                        foreach ( $fields as $field ) {
                            
                            if ( $field['parameter'] === 'custom' ) {
                                $entry[$field['field_id']] = $this->get_field( $this_post, $field['field_id'], $custom_source );
                                continue;
                            }
                            
                            $entry[$field['parameter']] = $this->get_field( $this_post, $field['field_id'], $custom_source );
                        }
                    }
                    
                    if ( isset( $entry['fill'] ) ) {
                        $entry['useDefaults'] = '0';
                        if ( !isset( $entry['hover'] ) ) {
                            $entry['hover'] = $entry['fill'];
                        }
                    }
                    
                    if ( !isset( $entry['fill'] ) ) {
                        $entry['useDefaults'] = '1';
                    }
                    // for now we always inherit the default click action, unless overriden as a custom entry
                    if ( !isset( $entry['action'] ) ) {
                        $entry['action'] = $meta[$defaults[$type]]['action'];
                    }
                    if ( !isset( $entry['tooltipContent'] ) ) {
                        $entry['tooltipContent'] = $this_post->post_title;
                    }
                    array_push( $data, $entry );
                }
            
            }
            $meta[$type] = $data;
        }
        
        return $meta;
    }

}