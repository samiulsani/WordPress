How to create new WordPress admin user account via FTP or cPanel?
( https://wpsimplehacks.com/how-to-create-new-wordpress-admin-user-account-via-ftp-or-cpanel/ )
( https://www.youtube.com/watch?v=bUCKR6nUiSs )
Option 1: add new user by creating a new file
Log in to your FTP
Create a new file in your computer (or server) and name it adduser.php
Paste this code here below inside the file
Change the username, password and email inside the file
Save the file
Go to your site and add /adduser-php to the URL. For example https://yoursite.com/adduser.php
If everything is configured correctly then you’ll see the “Successfully created new admin user. Now delete this file” notification
Now go back to the FTP and delete the adduser.php file
Log in to your site by using these new credentials
Here is the code for the adduser.php file


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
$newusername = 'username'; // here goes your username
$newpassword = 'password'; // here goes your password
$newemail = 'email@email.com'; // here goes your email
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



Option 2: add new user by modifying a functions.php file
Log in to your FTP
Go to the wp-content >> themes >> your theme and open functions.php.file
Paste this code shown below inside the functions-php file
Change the username, password and email inside the file
Save the file
Go to your site and log in with the new credentials
Now go back to the FTP and delete the code inside the functions.php file
// Add admin user. Don’t forget to delete this file
function add_admin_account(){
$user = 'anotheruser'; // here goes your username
$pass = 'anotherpassword'; // here goes your password
$email = 'email1@email.com'; // here goes your email
if ( !username_exists( $user )  && !email_exists( $email ) ) {
$user_id = wp_create_user( $user, $pass, $email );
$user = new WP_User( $user_id );
$user->set_role( 'administrator' );
} }
add_action('init','add_admin_account');


