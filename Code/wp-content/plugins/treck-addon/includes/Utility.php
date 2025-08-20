<?php

namespace Layerdrops\Treck;

class Utility
{
    public function __construct()
    {
        $this->register_image_size();
        add_filter('wpcf7_autop_or_not', '__return_false');

        add_action('wp_ajax_nopriv_signup_paragon', array($this, 'frontend_login_and_registration'));
        add_action('wp_ajax_signup_paragon', array($this, 'frontend_login_and_registration'));
    }
    public function register_image_size()
    {
        add_image_size('treck_blog_370X270', 370, 270, true); //in use
        add_image_size('treck_blog_370X462', 370, 462, true); //in use
        add_image_size('treck_brand_logo_112X24', 112, 42, true); //in use

    }

    public function frontend_login_and_registration()
    {

        if ($_POST['param'] == "register") {
            $output['status']                       =   1;
            $output['message']     =  __('User name or email already exit', 'treck-addon');
            $nonce         =   isset($_POST['security']) ? $_POST['security'] : '';
            if (!wp_verify_nonce($nonce, 'treck-register-nonce')) {
                wp_send_json($output);
            }

            $email                               =   sanitize_email($_POST['singupEmail']);
            $singupPassword                      =   sanitize_text_field($_POST['singupPassword']);
            $term                                =   sanitize_text_field($_POST['term']);


            if (email_exists($email)) {
                wp_send_json($output);
            }

            if (empty($singupPassword)) {
                $output['message']     =  __('Please fill up all field', 'treck-addon');
                wp_send_json($output);
            }

            if (empty($term)) {
                $output['message']     =  __('Please read term and condition and check it', 'treck-addon');
                wp_send_json($output);
            }
            // wp_create_user(), wp_insert_user()
            $user_id                                =   wp_insert_user([
                //'first_name'                        =>  $fname,
                'user_email'                        =>  $email,
                'user_login'                        =>  $email,
                'user_pass'                        =>  $singupPassword,
            ]);


            $user                                   =   get_user_by('id', $user_id);
            wp_set_current_user($user_id, $user->user_login);
            wp_set_auth_cookie($user_id, false);
            do_action('wp_login', $user->user_login, $user);

            $output['status']                       =   2;
            $output['message']                      = __('Registration Successful', 'treck-addon');
            wp_send_json($output);
            die();
        } //end register method
        elseif ($_POST['param'] == "login") {

            $output['status']                       =   1;
            $nonce         =   isset($_POST['security']) ? $_POST['security'] : '';
            if (!wp_verify_nonce($nonce, 'treck-login-nonce')) {
                wp_send_json($output);
            }
            $data['user_login']         = sanitize_user($_REQUEST['username']);
            $data['user_password']      = sanitize_text_field($_REQUEST['password']);
            $data['remember']      = sanitize_text_field($_REQUEST['remember']);
            $remember = (isset($data['remember']) ? 'true' : false);
            $user_login                 = wp_signon($data, $remember);

            // Check the results of our login and provide the needed feedback
            if (is_wp_error($user_login)) {
                wp_send_json(array(
                    'status' => 1,
                    'message'  => $user_login->get_error_message(),
                ));
            } else {
                wp_send_json(array(
                    'status' => 2,
                    'message'  => __('Logged In Successfully', 'treck-addon')
                ));
            }
        } //end login method


        echo wp_send_json($output);

        die(0);
    }
}
