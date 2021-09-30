<?php 
    // echo print_r($this->session->all_userdata()); 
    $_SESSION ['cle'] = random_string('alnum', 6);
    $cle = $_SESSION['cle'];
?>

<h2>Créer mon sondage</h2>
<h3>Etape 1 :</h3>

<p>Clé de mon sondage : <b><?php echo $cle; ?></b><p>
<p>La clé sera à donner aux personnes qui participeront au sondage. Gardez-là précieusement !</p>
<p>Commencez par entrer le titre, et le lieu. La description est optionnelle. Pour passer à la seconde étape, cliquez sur le bouton <i>Create survey </i>.</p>

<?php
    echo form_open('Utilisateur/creation');

        echo form_fieldset('Create survey');

            // Title
            echo form_label('Title:', 'title');
            echo form_input('title', set_value('title'), array('id'=> 'title'));
            echo form_error('title');

            // Place
            echo form_label('Place:', 'place');
            echo form_input('place', set_value('place'), array('id'=> 'place'));
            echo form_error('place');

            // Description
            echo form_label('Description:', 'description');
            echo form_input('description', set_value('description'), array('id'=> 'description'));
            echo form_error('description');

            echo '<br>';

            // Submit button
            echo form_submit('submit_button', 'Create survey');

            // Reset button
            echo form_reset('reset_button', 'Reset');

        echo form_fieldset_close();

    echo form_close();
?>

<?php echo anchor('Utilisateur/profil', '<input type="button" value="Back"/>'); ?>
