<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller
{
	// Accueil de l'utilisateur
	public function index()
	{
		$data_view['title'] = 'Homepage';

		$this->load->view('templates/header', $data_view);
		$this->load->view('homepage');
		$this->load->view('templates/footer');
	}


	
	// Méthode inscription
	public function sign_up()
	{
		$this->load->database();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user');

		if ($this->form_validation->run() === FALSE)
		{
			$data_view['title'] = 'Sign up page';

			$this->load->view('templates/header', $data_view);
			$this->load->view('sign_up');
			$this->load->view('templates/footer');
		}
		else
		{
			$username = $this->input->post('username');
			$last_name = ucfirst(strtolower($this->input->post('last_name')));
			$first_name = ucfirst(strtolower($this->input->post('first_name')));
			$email = $this->input->post('email');
			$confirm_email = $this->input->post('confirm_email');
			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$confirm_password = $this->input->post('confirm_password');
			
			$data = array(
				'pseudo' => $username,
				'nom' => $last_name,
				'prenom' => $first_name,
				'mail' => $email,
				'motdepasse' => $password
			);
			
			if ($this->user->insert_member($data))
			{
				$data_view['title'] = 'Log in page';

				$this->load->view('templates/header', $data_view);
				$this->load->view('log_in', $data);
				$this->load->view('templates/footer');
			}
		}
	}



	// Connexion du membre
	public function log_in()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('user');

		if ($this->form_validation->run())
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$query = $this->user->checking_existence_user($username);

			if ($query->num_rows() > 0)
			{
				$hash = $query->row()->motdepasse;

				if (password_verify($password, $hash))
				{
					$data = array(
						'username' => $this->input->post('username'),
						'currently_logged_in' => 1
					);

					$this->session->set_userdata($data);
					redirect('Utilisateur/profil'); 
				}
                else 
				{
					redirect('Utilisateur/index'); 
				}
			}
            else 
			{
				redirect('Utilisateur/index'); 
			}
		}
		else
		{
			$data['title'] = 'Log in page';

			$this->load->view('templates/header', $data);
			$this->load->view('log_in');
			$this->load->view('templates/footer');
		}
	}



	// Déconnexion du membre
	public function deconnexion()
	{
		$this->load->library('session');		
		$this->session->sess_destroy();
		redirect('Utilisateur/log_in');
	}



	// Profil du membre, accueil
	public function profil()
	{
		$this->load->library('session');

		if ($this->session->userdata('currently_logged_in'))
		{
			$data_view['title'] = 'Member homepage';

			$this->load->view('templates/header', $data_view);
			$this->load->view('accueil_membre');
			$this->load->view('templates/footer');	
		}
		else
		{
			redirect('Utilisateur/log_in');
		}
	}



	// Création du sondage par un membre
	public function creation()
	{
		$this->load->database(); 
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('insertion');
		$this->load->library('session');
		$this->load->helper('string');

		if ($this->form_validation->run())
		{
			$titre = $this->input->post('title');
			$lieu = $this->input->post('place');
			$description = $this->input->post('description');
			
			$cle=$_SESSION['cle'];
			$pseudo = $_SESSION['username'];

			$data = array(
				'cle' => $cle,
				'titre'=> $titre,
				'lieu' => $lieu,
				'description' => $description,
				'pseudo' => $pseudo
			);

			if ($this->insertion->crear_confluencia($data))
			{
				$data_view['title'] = 'Create a survey';

				$this->load->view('templates/header', );
				redirect('Utilisateur/ajout_option', $data);
				$this->load->view('templates/footer');
			}
		}
		else
		{
			$data_view['title'] = 'Create a survey';

			$this->load->view('templates/header', $data_view);
			$this->load->view('creation_sondage');
			$this->load->view('templates/footer');
		}
	}

	// Ajout des dates
	public function ajout_option()
	{
		$this->load->database(); 
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('insertion');
		$this->load->library('session');
		$this->load->helper('string');	

		$cle = $_SESSION['cle'];
		
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('heure', 'Heure', 'required');
				
		if ($this->form_validation->run())
		{
			$date = $this->input->post('date');
			$heure = $this->input->post('heure');

			if ($this->insertion->crear_horas($date, $heure, $cle))
			{
				echo "Valeur non récupérée";
			}
			else
			{
				redirect('Utilisateur/ajout_option');
			}
		}
		else
		{
			$data_view['title'] = 'Choose availability';

			$this->load->view('templates/header', $data_view);
			$this->load->view('organisation_sondage');
			$this->load->view('templates/footer');
		}
	}



	// Méthode qui gère le statut du sondage et affiche les clés
	public function gestion_sondage()
	{
		$this->load->database(); 
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user');
		$this->load->library('session');
		$this->load->library('table');
		
		$data_view['title'] = 'Survey management';

		$username = $_SESSION ['username'];
		$_SESSION['clé']='';

		$data["infos"] = $this->user->poner($username);

		$this->load->view('templates/header', $data_view);
		$this->load->view("gerer_sondage", $data);
		$this->load->view('templates/footer');
	}



	// 
	public function afficher_resultat($key)
	{
		$this->load->library('session');
		$this->load->model('user');
		$this->load->model('insertion');
		$this->load->database(); 

		$data_view['title'] = 'Survey management';
		$data['key'] = $key;
		$data['infos'] = $this->user->mostrar_encuesta($key);

		$data['des'] = $this->insertion->mostrar_datos($key);

		$this->load->view('templates/header', $data_view);
		$this->load->view('resultat_sondage', $data);
		$this->load->view('templates/footer');
	
	}



	// Statut des sondages
	public function statut_sondage($key, $status)
	{
		$this->load->database(); 
		$this->load->model('user');

		$this->user->update_status($key, $status);

		redirect('Utilisateur/gestion_sondage');
	}
}
