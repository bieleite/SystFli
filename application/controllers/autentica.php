<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of autentica
 *
 * @author Gabriel
 */
class autentica extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('model_user',TRUE);
        $this->load->helper('url');
    }
    
    function index()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_message('required','Champ %s obligatoire');
        $this->form_validation->set_rules('email','Utilisateur','trim|required');
        $this->form_validation->set_rules('password','Mot de pass','trim|required|callback_check_database');
        
    
   
        if($this->form_validation->run()==FALSE){
            $this->load->view('view_login');
            
        }else {
            redirect('home/dashboard','refresh');

        }
    }
    
    function check_database($password)
    {
        $login= $this->input->post('email');
        $result= $this->model_user->login($login,$password);
        $userid='';
        $usernom='';
        
        if($result)
        {
            foreach ($result as $line){
                $data['userid']= $line->id;
                $data['usernom']= $line->nom;
            }
        }else{
            $this->form_validation->set_message('check_database','Autentication Error');
        }
        
    }
}
