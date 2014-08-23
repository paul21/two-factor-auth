<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Log extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function add($log)
    {
        $query = $this->db->insert('Log', $log);
        
        if($query == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }  
    }

    function attemps($ip, $seconds)
    {
        $this->db->select('IPAddress, Timestamp, Status');
        $this->db->from('Log');
        $this->db->where('IPAddress', $ip);
        $this->db->where('Status', 0);
        $this->db->where('Timestamp BETWEEN FROM_UNIXTIME('.(time()-$seconds).') AND FROM_UNIXTIME('.time().')');

        $query = $this->db->get();

        return $query->num_rows();
    }

    function get()
    {
        $this->db->select('Timestamp, IPAddress, Status');
        $this->db->from('Log');

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            echo FALSE;
        }  
    }
}

/* End of file log.php */
/* Location: ./application/models/log.php */