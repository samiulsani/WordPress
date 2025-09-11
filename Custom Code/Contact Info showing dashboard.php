// WordPress Admin Dashboard এ শুধু Support Info Widget দেখানোর কোড
add_action( 'wp_dashboard_setup', function() {
    wp_add_dashboard_widget(
        'support_info_widget', // Widget ID
        __( 'Support Info', 'your-textdomain' ), // Widget Title
        function() {
            echo '<p>Need help? Contact <strong>Samiul Islam</strong></p>';
            echo '<p>Email: <a href="mailto:samiulslm5@gmail.com">samiulslm5@gmail.com</a></p>';
            echo '<p>Whatsapp: <a href="https://wa.link/pdpawy" target="_blank">+8801779461509</a></p>';
        }
    );
});
