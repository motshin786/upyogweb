<?php
/*
Plugin Name: CHC Hit Counter
Description: Custom hit counter to track unique IPs once every 24 hours and show animated total hits.
Version: 1.0
Author: Your Name
*/

// Create table on plugin activation
function chc_create_hit_counter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hit_counter';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        ip_address VARCHAR(45) NOT NULL,
        last_visit DATETIME NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY ip_address (ip_address)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'chc_create_hit_counter_table');

// Track IP once every 24 hours
function chc_track_visitor() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hit_counter';
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $current_time = current_time('mysql');

    $existing = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE ip_address = %s", $ip_address
    ));

    if ($existing) {
        $last_visit = strtotime($existing->last_visit);
        $now = strtotime($current_time);

        if (($now - $last_visit) >= 86400) { // 24 hours
            $wpdb->update(
                $table_name,
                array('last_visit' => $current_time),
                array('ip_address' => $ip_address)
            );
        }
    } else {
        $wpdb->insert(
            $table_name,
            array(
                'ip_address' => $ip_address,
                'last_visit' => $current_time
            )
        );
    }
}
add_action('init', 'chc_track_visitor');

// Get total visitor count
function chc_get_visitor_count() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hit_counter';
    return $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
}

// Shortcode to show animated counter
function chc_display_total_count_animated() {
    $count = chc_get_visitor_count();
    ob_start();
    ?>
     <style>
    .counter-container {
    display: flex
;
    justify-content: center;
    align-items: center;
    margin: 20px 0 0 -100px;
}
        #total-visitors-counter {
    display: inline-block;
    font-size: 1.5em;
    font-family: 'Courier New', Courier, monospace;
    color: #fff;
    background: #574B73;
    padding: 5px 10px;
    border-radius: 5px;
    text-align: center;
    letter-spacing: 0.1em;
    font-weight: bold;
}
    </style>

    <div class='counter-container'>
        <div id="total-visitors-counter" data-start="6000" data-end="<?php echo esc_attr($count); ?>">0</div>
        
     </div>

   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const counter = document.querySelector('.chc-animated-counter');
            if (!counter) return;

            const end = parseInt(counter.getAttribute('data-end'), 10);
            let start = parseInt(counter.getAttribute('data-start'), 10);

            const duration = 3000; // Slower animation (3 seconds)
            const stepTime = Math.max(Math.floor(duration / (end - start || 1)), 10);

            const timer = setInterval(() => {
                counter.textContent = ++start;
                if (start >= end) {
                    clearInterval(timer);
                }
            }, stepTime);
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('chc_total_count_animated', 'chc_display_total_count_animated');
