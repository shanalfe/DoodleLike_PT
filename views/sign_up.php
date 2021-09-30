<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
	echo form_open('Utilisateur/sign_up');

		echo form_fieldset('Sign up');

			// Username
			echo form_label('Username:', 'username');
			echo form_input('username', set_value('username'), array('id' => 'username'));
			echo form_error('username');

			// First name
			echo form_label('First name:', 'first_name');
			echo form_input('first_name', set_value('first_name'), array('id' => 'first_name'));
			echo form_error('first_name');

			// Last name
			echo form_label('Last name:', 'last_name');
			echo form_input('last_name', set_value('last_name'), array('id' => 'last_name'));
			echo form_error('last_name');

			// Email
			echo form_label('Email:', 'email');
			echo form_input('email', set_value('email'), array('id' => 'email'));
			echo form_error('email');

			// Email verification
			echo form_label('Confirm email:', 'confirm_email');
			echo form_input('confirm_email', '', array('id' => 'confirm_email'));
			echo form_error('confirm_email');

			// Password
			echo form_label('Password:', 'password');
			echo form_password('password', set_value('password'), array('id' => 'password'));
			echo form_error('password');

			// Password verification
			echo form_label('Confirm password:', 'confirm_password');
			echo form_password('confirm_password', '', array('id' => 'confirm_password'));
			echo form_error('confirm_password');

			echo '<br>';

			// Submit button
			echo form_submit('submit_button', 'Submit');

			// Reset button
			echo form_reset('reset_button', 'Reset');

		echo form_fieldset_close();

	echo form_close();

	echo anchor('Utilisateur/log_in', '<input type="button" value="Log in"/>');
	echo anchor('Utilisateur/index', '<input type="button" value="Back"/>');
?>
