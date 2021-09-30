<?php
	// echo print_r($this->session->all_userdata());
	$_SESSION['clé']='';
	// print_r ($infos);
	// print_r(array_keys($infos));
?>
<h2>Gestion de mes sondages</h2>

<p><u>Comment voir mes statistiques ? </u></p>
<p>Un sondage peut être <i>ouvert</i> ou bien <i>fermé</i>.</p>
<p>Pour chacune de vos clés de vos sondages, vous pouvez voir les statistiques correspondantes en cliquant sur <i>Look</i>.
<p><u>Comment gérer les statuts de mes sondages ? </u></p>
<p><u>ATTENTION</u> : Vérifiez le statut de votre sondage ! Si le sondage est fermé, alors vos participants ne pourront pas y répondre !!! Par défaut, le sondage est <b>ouvert</b>. Pour le fermer, il suffit de décocher la case correspondante à sa clé.</p>

<h3>Mes réunions</h3>

<table>
	<thead>
		<tr>
			<th>Key</th>
			<th>Status</th>
			<th>Setting</th>
		</tr>
	</thead>

	<tbody>
		<?php
			echo form_open('Utilisateur/afficher_resultat');

			if((sizeof($infos)) > 0)
			{
				foreach($infos as $info)
				{
					$key = $info->cle;
					$status = $info->statut_reunion;

					$status = ($status == '0' ? 1 : 0);

					$data = array(
						'name'          => 'open/close',
						'id'            => $key,
						'value'         => $key,
						'checked'       => $status,
						'onchange'      => 'changeStatus(' . $key . ', ' . $status . ')'
					);

					echo '<tr>';
						echo '<td>' . $key . '</td>';
						echo '<td>' . form_checkbox($data) . '</td>';
						echo '<td>' . anchor('Utilisateur/afficher_resultat/' . $key, 'Look') . '</td>';
					echo '</tr>';
				}
			}
			else
			{
				echo '<tr>';
					echo '<td colspan="3">Data Not Found</td>';
				echo '</tr>';
			}

			echo form_close();
		?>
	</tbody>
</table>

<?php echo anchor('Utilisateur/profil', '<input type="button" value="Back"/>');?>

<script>
	function changeStatus(key, status)
	{
		window.location.href = "<?php echo site_url('/Utilisateur/statut_sondage/');?>" + key.value + "/" + status;
	}
</script>
