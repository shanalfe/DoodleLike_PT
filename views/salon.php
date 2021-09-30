<?php
	echo form_open('Invite/identification');

		echo form_fieldset('Identification');

			// Name
			echo form_label('Name:', 'nameI');
			echo form_input('nameI', set_value('nameI'), array('id' => 'nameI'));
			echo form_error('nameI');

			// Key
			echo form_label('Survey key:', 'key');
			echo form_input('key', '', array('id' => 'key'));
			echo form_error('key');

			echo '<br>';

			// Submit button
			echo form_submit('submit_button', 'Submit');

			// Reset button
			echo form_reset('reset_button', 'Reset');

		echo form_fieldset_close();

	echo form_close();
?>

<br>

<?php echo anchor('Utilisateur/index', '<input type="button" value="Back"/>'); ?>
