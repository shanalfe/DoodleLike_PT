<?php
	// echo print_r($this->session->all_userdata());  
	$username = $_SESSION['username'];
?>

<h2>Welcome <?php echo $username; ?> !!!</h2>

<?php echo anchor('Utilisateur/creation', '<input type="button" value="Create my survey"/>'); ?>
<?php echo anchor('Utilisateur/gestion_sondage', '<input type="button" value="Manage my survey"/>'); ?>
<?php echo anchor('Utilisateur/deconnexion', '<input type="button" value="Log out"/>'); ?>
