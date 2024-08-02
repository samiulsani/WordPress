/** This code checked automatic virtual and downloadable in woocommerce product section **/


add_action( 'woocommerce_product_options_general_product_data', 'hiding_and_set_product_settings' );
function hiding_and_set_product_settings(){

    ## ==> Set HERE your targeted user role:
    $targeted_user_roles = array( 'administrator', 'shop_manager' );


    // Getting the current user object
    $user = wp_get_current_user();
    // getting the roles of current user
    $user_roles = $user->roles;

    if ( array_intersect( $targeted_user_roles, $user_roles ) ){

        ## CSS RULES ## (change the opacity to 0 after testing)
        // HERE Goes OUR CSS To hide 'virtual' and 'downloadable' checkboxes
        ?>
        <style>
            label[for="_virtual"], label[for="_downloadable"]{ opacity: 0.2; /* opacity: 0; */ }
        </style>
        <?php

        ## JQUERY SCRIPT ##
        // Here we set as selected the 'virtual' and 'downloadable' checkboxes
        ?>

        <script>
            (function($){
                $('input[name=_virtual]').prop('checked', true);
                $('input[name=_downloadable]').prop('checked', true);
            })(jQuery);
        </script>

        <?php
    }
}
