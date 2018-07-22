<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of model_user - database search 
 *
 * @author Gabriel
 */
class model_user extends CI_Model  {
    function login($email,$password) {
        $this->db->select('id','nom');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
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
