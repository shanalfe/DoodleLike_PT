<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	
	public function __construct(){
		$this->load->database();
	}

	// Création du tableau de données pour un membre 
	public function crear_datos ($member){
	
		$data = array(
			'pseudo'=> $member['pseudo'],
			'nom'=>$member['nom'],
			'prenom'=>$member['prenom'],
			'mail'=>$member['mail'],
			'motdepasse'=>$member['motdepasse']	
		);
	}


	// Insère les données du membre dans la base de données
	public function insert_member($data){
		return $this->db->insert('membre', $data);
	}


	// Permet la connexion du membre sur son compte
	public function conectar() {		
		$this->db->where('pseudo', $this->input->post('username'));
		$this->db->where('motdepasse', $this->input->post('password'));
		$query = $this->db->get('membre');

		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	} 

	// Afficher les clés des sondages au membre
	public function poner($username)
{
	$this->db->select("cle");
	$this->db->select("statut_reunion");
	$this->db->from("reunion");
	$this->db->where('pseudo', $username);
	$result = $this->db->get()->result();
	
	return $result; 
}


	
	// Affiche le nombre de dispo pour une clé en particulier
	public function mostrar_encuesta ($cle)
	{
		$sql = "SELECT idHoraire, count(*) as total FROM dispo WHERE statut = 0 AND cle = '$cle' GROUP BY idHoraire ORDER BY total DESC;";

		return $this->db->query($sql)->result();
	}



	// Update status
	public function update_status($key, $status)
	{
		$data = array(
			'statut_reunion' => $status 
		);

		$this->db->where('cle', $key);
		$this->db->update('reunion', $data);
	}



    // Vérification de l'existence du compte
    public function checking_existence_user($username)
    {
        return $this->db->select('motdepasse')->from('membre')->where('pseudo', $username)->get();
    }
}
