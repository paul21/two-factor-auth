<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('application/libraries/whatsapi/whatsprot.class.php');
require_once('application/libraries/whatsapi/protocol.class.php');


class Login extends CI_Controller {

	var $ip;
	var $view_options = array('captcha' => FALSE);
	var $interval = 120;    /* En segundos */
	var $max_attemps = 2;   /* Intentos-1 permitidos antes de mostrar captcha */

    function __construct()
    {
        parent::__construct();
        $this->ip = $this->input->ip_address();
    }

	public function index()
	{
		if($this->session->userdata('access'))
		{
			redirect(base_url('index.php/home/'));
		}
		else
		{
			/* Si la IP excede X numero de intentos muestra captcha*/

			if($this->log->attemps($this->ip, $this->interval) > $this->max_attemps)
			{
				$this->view_options['captcha'] = TRUE;
			}
			$this->load->view('login_stepone_view', $this->view_options);
		}
	}

	public function stepone()
	{
		/* Validación de formularios */
		
		$this->form_validation->set_rules('user', 'username', 'required|trim|max_length[80]|xss_clean');
		$this->form_validation->set_rules('pass', 'password', 'required|trim|max_length[80]|xss_clean');

		/* Si la IP excede X numero de intentos en el intervalo definido, también valida captcha */

		if($this->log->attemps($this->ip, $this->interval) > $this->max_attemps)
		{
			$this->form_validation->set_rules('recaptcha_response_field', 'captcha', 'required|callback_captcha');
			$this->view_options['captcha'] = TRUE;
		}

		if($this->form_validation->run() == TRUE)
		{
			/* Validación de usuario */

			$user = $this->input->post('user');
			$pass = hash('sha512', $this->input->post('pass'));

			$this->load->model('usuario');

			$result = $this->usuario->validar($user, $pass);

			if($result)
			{
				foreach($result as $row);

				/* Preparación de los datos de sesión y generación del código a enviar */

				$datos['usuario']  =  $row->IdUsuario;
				$datos['telefono'] =  $row->Telefono;
				$datos['intentos'] =  0;
				$datos['codigo']   =  $this->generar();

				/* Inciar la sesión */

				$this->session->set_userdata($datos);

				/* Envío del código al teléfono */

				$mensaje = '«'.date('H:i:s').' Intento de login desde '.$this->ip.'»'."\n\nCódigo: ".$this->session->userdata('codigo');
				$result['message'] = $this->enviar($datos['telefono'], $mensaje);

				/* Cargar la vista para ingresar el código */
				
				$this->load->view('login_steptwo_view', $result);
			}
			else
			{
				/* Logueo el intento fallido */

				$this->log->add(array('IpAddress' => $this->ip,
					                  'Timestamp' => date('Y-m-d G:i:s')));

				$this->view_options['message'] = 'Usuario o contraseña incorrecta';
				$this->load->view('login_stepone_view', $this->view_options);
			}
		}
	
		/* Falló la validación de formularios */

		else 
		{
			$this->load->view('login_stepone_view',  $this->view_options);
		}
	}

	public function steptwo()
	{
		if($this->session->userdata('usuario'))
		{
			/* Incrementar el numero de intentos y actualizar la variable de sesión */
		
			$intentos = $this->session->userdata('intentos');
			$intentos++;
			$this->session->set_userdata('intentos', $intentos);

			/* Si se superan los 3 intentos, destruir la sesión y volver al paso 1 */

			if($intentos > 3)
			{
				$this->log->add(array('IPAddress' => $this->ip,
				                      'Timestamp' => date('Y-m-d G:i:s'), 
				                      'Status'    => 1));

				$this->session->sess_destroy();

				$this->load->view('login_stepone_view', 
				                  array('message' => 'Código expirado'));
				return;
			}

			/* Validación del formulario de código */				

			$this->form_validation->set_rules('code', 'code', 'required|trim|exact_length[6]|xss_clean');

			if($this->form_validation->run() == TRUE)
			{
				/* Chequear correspondencia del código y redirigir al home */

				if($this->input->post('code') == $this->session->userdata('codigo'))
				{
					$this->log->add(array('IPAddress' => $this->ip,
					                      'Timestamp' => date('Y-m-d G:i:s'), 
					                      'Status'    => 2));

					$this->session->set_userdata('access', TRUE);
					redirect(base_url('index.php/home'));
				}
				else 
				{
					$this->load->view('login_steptwo_view', 
						              array('message' => '¡Código incorrecto!'));
				}
			}

			/* Falló la validación de formularios */

			else $this->load->view('login_steptwo_view');
		}

		/* Sesión expirada o inexistente */

		else redirect(base_url('/'));
	}

	public function captcha()
	{
		require_once('application/libraries/recaptcha/recaptchalib.php');
		require_once('application/config/captcha.php');
  		
  		$resp = recaptcha_check_answer ($privatekey,
		                                $this->input->ip_address(),
		                                $this->input->post('recaptcha_challenge_field'),
		                                $this->input->post('recaptcha_response_field'));
		
		if (!$resp->is_valid) 
		{
			$this->log->add(array('IPAddress' => $this->ip,
				                  'Timestamp' => date('Y-m-d G:i:s')));
			$this->form_validation->set_message('captcha', 'El texto no coincide con el captcha');
    		return FALSE;
 	    } 
 	    else 
 	    {
 	    	return TRUE;
 	    }
 	}

	private function generar()
	{
		require_once('application/libraries/hotp/hotp.php');
		require_once('application/config/hotp.php');

		$result = HOTP::generateByTime($secret_key, $window);
		$code = $result->toHotp(6);

		return $code;
	}

	private function enviar($telefono, $mensaje)
	{
		require_once('application/config/whatsapp.php');

		try
		{
			$w = new WhatsProt($username, $identity, $nickname, $debug);
			$w->connect();
			$w->loginWithPassword($password);
			$w->sendMessage($telefono, $mensaje);
		}
		catch(exception $e)
		{
			return 'Error en la conexión a WhatsApp';
		}
	}

	public function out()
	{
		$this->session->sess_destroy();
		$this->view_options['message'] = 'Se ha desconectado';
		$this->load->view('login_stepone_view', $this->view_options);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
