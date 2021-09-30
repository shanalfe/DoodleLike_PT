<?php
	// echo print_r($this->session->all_userdata()); 
	$nameI = $_SESSION['nameI'];
	$key = $_SESSION['key'];
?>


<h2>Welcome <?php echo $nameI; ?> !!!</h2>
<p>You answer the survey: <b><?php echo $key; ?></b></p>

<h4>Survey information:</h4>

<?php
	if((sizeof($infos)) > 0)
	{
		foreach($infos as $info)
		{
			echo '<b>Title: </b>' . $info->titre . '<br>';
			echo '<b>Place: </b>' . $info->lieu . '<br>';
			echo '<b>Description: </b>' . $info->description;
		}
	}

	$sql2 = ("SELECT idInvite FROM invite WHERE nomInvite = '$nameI';"  );
	//Récupération des données de la requete !! 
	$idI = $this->db->query($sql2) ->row() -> idInvite
?>

<h4>Response options:</h4>

<table>
	<thead>
		<tr>
			<th>Date</th>
			<th>Schedule</th>
			<th>Status</th>
		</tr>
	</thead>

	<tbody>
		<?php
			$n = -1;
			$stack =  array();

			foreach($dispos as $info)
			{
				$n++;

				$sql = "SELECT idHoraire FROM horaire NATURAL JOIN crenaux WHERE date ='$info->date' AND heure = '$info->heure' AND cle ='$key'";
				$idH = $this->db->query($sql) ->row() -> idHoraire;

				array_push($stack,"$idH");
				
				echo '<tr>';
					echo '<td><b>Slot n°' . $n . '</b> : '. strftime("%A %d %B %G", strtotime($info->date)) . '</td>';
					echo '<td>' . $info->heure . '</td>';
					echo '<td>'. form_open('') .form_checkbox('dispo[]', ''.$n, false).' </td></tr>';
			}

			if ( isset ($_POST['dispo'])){			
				foreach ($_POST['dispo'] as $val){
					//echo $val. '<br>';
					//Récupération des valeurs
					$value = $stack[$val];
					$sql4 = "INSERT INTO dispo (statut, idHoraire, cle, idInvite) VALUES (0, '$value', '$key', '$idI');";
					$this->db->query($sql4);
				}			
				redirect ('Invite/deconnexion');
			}

		?>
	
	</tbody>
</table>

<br>


<?php 
	//print_r($stack);
	echo form_submit('submit_button', 'Save') . form_close();
	echo anchor('Invite/deconnexion', '<input type="button" value="Logout"/>'); 
?>

<script>
	function changeStatus(key)
	{
		window.location.href = "<?php echo site_url('/Utilisateur/statut_sondage/');?>" + key.value + "/" + status;
	}
</script>
