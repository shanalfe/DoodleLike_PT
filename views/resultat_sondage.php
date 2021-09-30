<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    // echo print_r($this->session->all_userdata());
?>


<?php
    echo '<h1>Résultat du sondage ' . $key . '</h1>';
?>


<h3>Les informations du sondage : </h3>
<?php
    if((sizeof($des))>0){
	    foreach($des as $info){?>
            <p><b>Title </b>: <?php echo $info->titre;?></p>
           <p><b>Place </b>: <?php echo $info->lieu;?></p>
           <p><b>Description </b>: <?php echo $info->description;
        }
    }
       
?></p>

<br>


<?php     
    // Affichage des résultats du sondageS
    foreach ($infos as $info) {

        $idHoraire = $info->idHoraire;
        $sq = "SELECT date, heure from horaire where idHoraire = $idHoraire;";

        echo '<table>';
        echo '<tr><td> <b>Date</b> : ';
     
        echo strftime("%A %d %B %G", strtotime( $this->db->query($sq)->row()-> date));
        echo '</td><td><b>Heure</b> : ';
        echo $this->db->query($sq)->row()-> heure;
        echo '</td><td>';

        echo '<b>Nombre total de disponibilités</b> : ';       
        $total = $info->total;
        echo $total;

        echo '</td></tr></table><br>';
    }

    echo '<br>';
    echo anchor('Utilisateur/gestion_sondage', '<input type="button" value="Back"/>');
?>
