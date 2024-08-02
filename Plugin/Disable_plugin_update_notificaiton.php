How to disable any plugin Update notification Like Elementor Pro:
// Remove update notifications

function remove_update_notifications( $value ) {


    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'lifterlms/lifterlms.php' ] );
    }


    return $value;
}
add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );


Goto Plugin Editor > select plugin to edit > copy  plugin folder/plugin name.php > Edit the code unset > goto theme editor > function.php > pastle code
