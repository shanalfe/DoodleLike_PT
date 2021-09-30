<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends CI_Controller
{
	public function index() 
	{
		$this->load->helper('form');
		
		$data_view['title'] = 'Guest identification';
		
		$this->load->view('templates/header', $data_view);
		$this->load->view('salon');
		$this->load->view('templates/footer');
	}



	// Inscription de l'invité
	public function identification()
	{
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('insertion');
		$this->load->library('session');
		$this->load->helper('security');  

		if ($this->form_validation->run())
		{
			$nameI = $this->input->post('nameI');
			$key = $this->input->post('key');

			if ($this->insertion->verification_cle($key))
			{
				echo "Clé existance";

				if ($this->insertion->verification_cle($key))
				{
					if ($this->insertion->crear_invitado($nameI, $key))
					{
						echo "Erreur d'envoi des données";	
					}
					else
					{
						$data = array(  
							'nameI' => $this->input->post('nameI'),
							'key' => $this->input->post('key'),
							'currently_logged_in' => 1  
						);    
						
                        $this->insertion->recuperacion_de_identificadores($nameI);

						$this->session->set_userdata($data);  
						redirect('Invite/reponse_sondage');  
					}
					return TRUE;
				}
				else
				{  
					$this->form_validation->set_message('validation', 'Incorrect username/password.');  
					return FALSE;  
				}  
			}
			else
			{
				echo "cle non existante";
				redirect('Utilisateur/index');
			}
		}
		else
		{
			$data_view['title'] = 'Guest identification';

			$this->load->view('templates/header', $data_view);
			$this->load->view('salon');
			$this->load->view('templates/footer');;
		}
	}


	// Accueil invité
	public function reponse_sondage()
	{
		$this->load->database(); 
		$this->load->helper('form');
		$this->load->model('insertion');
		$this->load->library('session');
		$this->load->library('table');
		
		$key = $_SESSION['key'];
		$data_view['title'] = 'Guest availability';
        $data['infos']=$this->insertion->mostrar_datos($key);
		$data['dispos']=$this->insertion->horas($key);

		$this->load->view('templates/header', $data_view);
		$this->load->view('reponse_invite', $data);
		$this->load->view('templates/footer');
	}


	// Déconnexion de l'invité
	public function deconnexion()
	{
		$this->load->library('session');		  
		$this->session->sess_destroy();  
		redirect('Utilisateur/index');  
	}


    // Statut des sondages
	public function statut_disponibilité($key)
	{
		$this->load->database(); 
		$this->load->model('insertion');

		$this->user->update_disponibilite($key);

		redirect('Invite/reponse_sondage');
	}


	public function donner_dispo () {
		$this->load->database(); 
		$this->load->helper('form');
		$this->load->model('insertion');
		$this->load->library('session');
		$this->load->library('table');

		$key = $_SESSION['key'];
		$nameI = $_SESSION ['nameI'];
		

		if ( isset ($_POST['dispo'])){
			
			foreach ($_POST['dispo'] as $val){

				echo $val. '<br>';
				//$this->insertion->update_disponibilite($nameI, $key);
			}			
		}

	}


}
