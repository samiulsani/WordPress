// Too many login attempts lockout (with IP tracking)
add_action('wp_login_failed', function($username) {
    $ip        = $_SERVER['REMOTE_ADDR']; // Track per IP for better security
    $key       = 'login_attempts_' . md5($username . $ip);
    $attempts  = (int) get_transient($key);
    $max_attempts = 3;

    $attempts++;

    if ($attempts >= $max_attempts) {
        set_transient($key, $attempts, 15 * 60); // ১৫ মিনিটের জন্য লক
        wp_die('আপনি অনেকবার ভুল ইউজারনেম বা পাসওয়ার্ড ব্যবহার করেছেন। অনুগ্রহ করে ১৫ মিনিট পরে আবার চেষ্টা করুন।');
    }

    set_transient($key, $attempts, 15 * 60);

    $remaining = $max_attempts - $attempts;
    wp_die('ভুল ইউজারনেম বা পাসওয়ার্ড। আপনার আরও ' . $remaining . ' বার চেষ্টা করার সুযোগ আছে।');
});

// Reset counter after successful login
add_action('wp_login', function($user_login) {
    $ip  = $_SERVER['REMOTE_ADDR'];
    $key = 'login_attempts_' . md5($user_login . $ip);
    delete_transient($key);
}, 10, 1);






//Too many login attempts lockout(without IP tracking)
add_action('wp_login_failed', function($username){
    $key='login_attempts_'.$username;
    $attempts=(int)get_transient($key);
    $max_attempts=3;
    $remaining=$max_attempts-($attempts+1);

    if($attempts >= $max_attempts){
        wp_die('Too many login attempts. Please try again in 15 minutes.');
    }

    set_transient($key, $attempts+1, 15*60);
    wp_die('Invalid username or password. You have '.$remaining.' attempts left.');
});

add_action('wp_login', function($user_login){
    delete_transient('login_attempts_'.$user_login);
}, 10, 1);
