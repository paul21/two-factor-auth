<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrar extends CI_Controller {

	public function index()
	{
		$this->load->view('registrar_view');
	}

	public function go()
	{
		/* Validacion de formularios */

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required|min_length[4]|max_length[80]|xss_clean');
		$this->form_validation->set_rules('user', 'user name', 'trim|required|trim|alpha_numeric|min_length[4]|max_length[80]|xss_clean');
		$this->form_validation->set_rules('pass', 'password', 'trim|required|matches[passconf]|min_length[8]|max_length[80]|xss_clean');
		$this->form_validation->set_rules('passconf', 'password confirmation', 'trim|required');
		$this->form_validation->set_rules('phone', 'phone number', 'trim|required|is_natural|min_length[8]|max_length[80]');

		if($this->form_validation->run() == TRUE)
		{
			$data['Nombre']   =  $this->input->post('name');
			$data['User']     =  $this->input->post('user');
			$data['Pass']     =  hash('sha512', $this->input->post('pass'));
			$data['Telefono'] =  $this->input->post('phone');

			$this->load->model('usuario');

			/* Chequear existencia previa del nombre usuario */

			if($this->usuario->check_username($data['User']))
			{
				$this->load->view('registrar_view', 
					              array('message' => 'Nombre de usuario existente'));
			}

			/* Intentar la registracion y cargar la vista correspondiente */

			else
			{
				$query = $this->usuario->registrar($data);

				if($query)
				{ 
					$this->load->view('login_stepone_view', 
						               array('message' => '¡Se ha registrado correctamente!'));
				}
				else
				{			
					$this->load->view('registrar_view', 
						              array('message' => 'Se ha producido un error'));
				}
			}

		}

		/* Fallo la validacion de formularios */

		else $this->load->view('registrar_view');
	}
}

/* End of file registrar.php */
/* Location: ./application/controllers/registrar.php */