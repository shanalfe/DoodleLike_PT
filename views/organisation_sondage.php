<?php    
    // echo print_r($this->session->all_userdata());
    $cle = $_SESSION['cle'];
?>

<h2>Fixer mes dates</h2>
<h3>Etape 2 :</h3>
<p>Clé de mon sondage : <b><?php echo $cle;?></b><p>
<p>Vous pouvez choisir autant de créneaux que vous le souhaitez.</p>
<p><u>Comment valider un créneau ?</u></p>
<p>Cliquez sur le bouton <b><i>Validate my schedule</b></i>.</p>
<p><u>Comment valider mon sondage ?</u></p>
<p><b>Dès le dernier créneau <u>validé</u></b>, cliquez sur le bouton <b><i>Validate my survey</b></i> pour pouvoir sauvegarder ce dernier.</p>

<?=validation_errors()?>

<?=form_open('Utilisateur/ajout_option')?>

    <input type="date" id="date" name="date" value="<?=set_value('date')?>" min='<?=date('Y-m-d')?>'>

    <input type="time" id="heure" name="heure" value="<?=set_value('heure')?>" min="00:00" max="23:59" required>

    <button type="submit" id="envoyer" name="envoyer">Validate my schedule</button>
   
<?php echo form_close(); ?>
<?php echo anchor('Utilisateur/profil', '<input type="button" value="Validate my survey"/>'); ?>
