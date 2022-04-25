<!--Model insertion
Il permet l'insertion dans la base de données du sondage
-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insertion extends CI_Model {
	
	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}



	// Création du tableau de données pour un membre 
	public function crear_datos ($meet){		
		$data = array(
			'cle'=>$meet ['cle'],
			'titre'=> $meet['titre'],
			'lieu'=>$meet['lieu'],
			'description'=>$meet['description'],
			'pseudo'=>$meet['pseudo']
		);
	}



	// Insérer dans la base de données 
	public function crear_confluencia ($data){
		return $this->db->insert('reunion', $data);
	}



	// Insertion des heures et dates
	public function crear_horas($date, $heure, $cle){		
		$query = "INSERT INTO horaire (date, heure) VALUES ('$date', '$heure');";
		$this->db->query($query);
		$idH=$this->db->insert_id();		
		$sql = ("INSERT INTO crenaux (cle, idHoraire) values ('$cle', '$idH');");
		$this->db->query($sql);
	}



	//Invité : insertion de son nom
	public function crear_invitado ($nameI, $key){		
		//Insertion dans la table invité
		$query = "INSERT INTO invite (nomInvite) VALUES ('$nameI');";
		$this->db->query($query);

		//Récupération de l'id de l'invité
		$sql2 = ("SELECT idInvite FROM invite WHERE nomInvite = '$nameI';"  );
		//Récupération des données de la requete !! 
		$idI = $this->db->query($sql2) ->row() -> idInvite;


		//Insertion des données dans invitation
		$sql1 = "INSERT INTO invitation (idInvite, cle) VALUES ('$idI', '$key');";
		$this->db->query($sql1);

	}




	// Vérification de la clé
	public function verification_cle ($key){	
		//Vérifier que la clé
		$this->db->where('cle', $this->input->post('key')); 
		$query = $this->db->get('reunion'); 	
		//Vérification accès au sondage
		$sql = "SELECT statut_reunion FROM reunion WHERE cle = '$key';";
		$statut_reunion = $this->db->query($sql) ->row() -> statut_reunion;

		if ( ($query->num_rows() == 1) && $statut_reunion == 0) {  
		  return true;  
		} else {  
			return false;  
		}	
	}



	// Afficher les données principales de la réunion
	public function mostrar_datos ($key){
		$this->db->select("titre");
		$this->db->select("lieu");
		$this->db->select("description");
		$this->db->from("reunion");
		$this->db->where('cle',$key);
		$result = $this->db->get()->result();

		return $result;        
	}



	// Afficher les différentes propositions
	public function horas($key)
	{
		$this->db->select('date');
		$this->db->select('heure');
		$this->db->from('horaire');
		$this->db->join('crenaux', 'crenaux.idHoraire = horaire.idHoraire');
		$this->db->where('cle', $key);
		$this->db->order_by('date ASC, heure ASC');
		$res = $this->db->get()->result();

		return $res; 		
	}



	public function recuperacion_de_identificadores($nameI)
	{
		$this->db->select('idInvite');
		$this->db->from('invite');
		$this->db->where('nomInvite', $nameI);

		return $this->db->get()->result();
	}



	// Insert disponibilité
	public function update_disponibilite($key, $nameI) {
	
		$sql1 = ("SELECT idHoraire FROM crenaux WHERE cle = '$key';");
		$idH =  $this->db->query($sql1) ->row() -> idHoraire;
	
		$sql2 = ("SELECT idInvite FROM invite WHERE nomInvite = '$nameI';");
		//Récupération des données de la requete !! 
		$idI = $this->db->query($sql2) ->row() -> idInvite;
	}


}
