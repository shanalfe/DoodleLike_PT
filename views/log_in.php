<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
	echo form_open('Utilisateur/log_in');

		echo form_fieldset('Log in');

			// Username
			echo form_label('Username:', 'username');
			echo form_input('username', set_value('username'), array('id' => 'username'));
			echo form_error('username');

			// Password
			echo form_label('Password:', 'password');
			echo form_password('password', '', array('id' => 'password'));
			echo form_error('password');

			echo '<br>';

			// Submit button
			echo form_submit('submit_button', 'Submit');

			// Reset button
			echo form_reset('reset_button', 'Reset');

		echo form_fieldset_close();

	echo form_close();
?>

<br>

<?php echo anchor('Utilisateur/sign_up', '<input type="button" value="Sign up"/>'); ?>
<?php echo anchor('Utilisateur/index', '<input type="button" value="Back"/>'); ?>
