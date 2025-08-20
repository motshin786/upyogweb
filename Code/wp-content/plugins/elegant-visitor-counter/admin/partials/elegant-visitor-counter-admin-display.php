<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wordpress.org/plugins/elegant-visitor-counter/
 * @since      3.1.1
 *
 * @package    elegant_visitor_counter
 * @subpackage elegant_visitor_counter/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="courses-container">
  <div class="course">
    <div class="course-preview">
      <h2 class="plugin-title">Elegant Visitor Counter</h2>
    </div>
    <div class="course-info">
      <div class="progress-container">
        <div class="progress"></div>
        <span class="progress-text">

        </span>
      </div>
      <h6>Settings</h6>
      <form method="POST" action="options.php">
        <?php
        settings_fields('evc_settings');
        do_settings_sections('evc_settings');
        submit_button();
        ?>
      </form>
      <!-- Separate form for the truncate button -->
      <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>" onsubmit="return confirm('Delete?');">
        <input type="hidden" name="action" value="truncate_evc_log">
        <?php wp_nonce_field('truncate_evc_log'); ?>
        <button type="submit" name="submit" class="button">Delete EVC Log</button>
      </form>
      <small>If you have some spare time, please <a href="https://wordpress.org/support/plugin/elegant-visitor-counter/reviews">Rate</a> this plugin. Thank You.</small>
    </div>
  </div>
</div>

<div class="courses-container">
  <?php
  $post_types = get_post_types(array('public' => true), 'names');

  foreach ($post_types as $post_type) {
    $args = array(
      'post_type' => $post_type,
      'meta_key' => '_epvc_post_views',
      'meta_compare' => 'EXISTS',
      'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    // Check if there are posts with the given meta key
    if ($query->have_posts()) {
  ?>
      <div class="course">
        <div class="course-preview">
          <h5>Post Type</h5>
          <h2 class="plugin-title"><?php echo ucfirst($post_type); ?></h2>
        </div>
        <div class="course-info">
          <div class="progress-container">
            <div class="progress"></div>
            <span class="progress-text"></span>
          </div>
          <h6>Settings</h6>
          <form method="post" action="">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Views</th>
                  <th>Delete?</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                while ($query->have_posts()) {
                  $query->the_post();
                  // Your loop content here
                  // For example, you can display the post title and meta value
                  $post_title = get_the_title();
                  $post_views = get_post_meta(get_the_ID(), '_epvc_post_views', true);
                  $meta = ('' !== $post_views) ? explode(',', $post_views) : array();
                ?>
                  <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $post_title; ?></td>
                    <td><?php echo count($meta); ?></td>
                    <td>
                      <input type="checkbox" name="posts_to_delete[]" value="<?php echo get_the_ID(); ?>">
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <button type="submit" class="button" name="delete_meta_button" onclick="return confirm('Delete?');">Delete Selected Meta</button>
          </form>
          <?php
          if (isset($_POST['delete_meta_button']) && isset($_POST['posts_to_delete'])) {
            $posts_to_delete = $_POST['posts_to_delete'];
            foreach ($posts_to_delete as $post_id) {
              delete_post_meta($post_id, '_epvc_post_views');
            }
            echo '<p>Selected meta deleted successfully.</p>';
            // Refresh the page to reflect the changes
            echo '<script>location.reload();</script>';
          }
          ?>
        </div>
      </div>
  <?php
      wp_reset_postdata(); // Restore the global post data after the custom loop
    } else {
      // No posts found for this post type
      // You can choose to display a message or omit this section entirely
    }
  }
  ?>
</div>