<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of model_user - database search 
 *
 * @author Gabriel
 */
class model_utilisateur extends CI_Model  {
     function __construct() {
        parent::__construct();
        
        //$this->load->helper('url');
    }
    
    function login($email,$password) {
        $this->db->select('ID','NOM','LOGIN','EMAIL');
        $this->db->from('users');
        $this->db->where('EMAIL',$email);
        $this->db->where('PASSWORD',$password);
        $this->db->where('status','1');
        $this->db->limit(1);
        $query= $this->db->get();
        
        if($query->num_rows()==1){
            return $query->result();
        }else{
            return false;
        }
    }
}
