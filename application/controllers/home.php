<?php

 class Home extends CI_Controller {

    
    public function index()
    {
        if($this->session->userdata('access'))
        {
            $usuario = $this->session->userdata('usuario');
            $this->load->model('usuario');
            $this->load->view('home_view', 
                               array('usuario' => $this->usuario->get($usuario))
                             );
        }
        else redirect(base_url('/'));
    }

    public function logs()
    {
        if($this->session->userdata('access'))
        {
            $this->load->view('log_view', 
                              array('log' => $this->log->get())
                             );
        }
        else redirect(base_url('/'));        
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */