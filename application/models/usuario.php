<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Usuario extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function registrar($data)
    {
        $query = $this->db->insert('Usuario', $data);

        if($query == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }  
    }

    function validar($user, $pass)
    {
        $this->db->select('IdUsuario, Nombre, Telefono');
        $this->db->from('Usuario');
        $this->db->where('User', $user);
        $this->db->where('Pass', $pass);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }  
    }

    function get($id)
    {
        $this->db->select('IdUsuario, Nombre, User, Telefono');
        $this->db->from('Usuario');
        $this->db->where('IdUsuario', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    function check_username($user)
    {
        $this->db->select('IdUsuario, Nombre, Telefono');
        $this->db->from('Usuario');
        $this->db->where('User', $user);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    function listar()
    {
        $this->db->select('IdUsuario, Nombre, Telefono');
        $this->db->from('Usuario');

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }  
    }

}
