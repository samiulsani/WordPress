<?php
// ADD NEW ADMIN USER TO WORDPRESS
// ----------------------------------
// Put this file in your WordPress root directory and run it from your browser.
// Delete it when you're done.
require_once('wp-blog-header.php');
require_once('wp-includes/registration.php');

// ----------------------------------------------------
// CONFIG VARIABLES
// Make sure that you set these before running the file.
$newusername = 'admin'; // here goes your username
$newpassword = 'admin@1234'; // here goes your password
$newemail = 'moviename62@gmail.com'; // here goes your email
// ----------------------------------------------------
// This is just a security precaution, to make sure the above "Config Variables"
// have been changed from their default values.
if ( $newpassword != 'YOURPASSWORD' &&
	 $newemail != 'YOUREMAIL@TEST.com' &&
	 $newusername !='YOURUSERNAME' )
{
	// Check that user doesn't already exist
	if ( !username_exists($newusername) && !email_exists($newemail) )
	{
		// Create user and set role to administrator
		$user_id = wp_create_user( $newusername, $newpassword, $newemail);
		if ( is_int($user_id) )
		{
			$wp_user_object = new WP_User($user_id);
			$wp_user_object->set_role('administrator');
			echo 'Successfully created new admin user. Now delete this file!';
		}
		else {
			echo 'Error with wp_insert_user. No users were created.';
		}
	}
	else {
		echo 'This user or email already exists. Nothing was done.';
	}
}
else {
	echo 'Whoops, looks like you did not set a password, username, or email';
	echo 'before running the script. Set these variables and try again.';
}