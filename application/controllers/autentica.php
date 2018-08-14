<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autentica extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_utilisateur', '', TRUE);
        $this->load->helper('url');
        $this->load->helper('security');
    }

function index() {
        $this->load->library('form_validation');

        $this->form_validation->set_message('required', 'campo %s obrigatório');
        $this->form_validation->set_rules('login', 'Usuário', 'trim|required');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|callback_database');

        if ($this->form_validation->run() == FALSE) {
            //FALHA DE VALIDAÇÃO.  Redirecionando para pagina de login
            redirect('login', 'refresh');
            //$this->load->view('view_login');
        } else {
            //VALIDAÇÃO OK. Acesso a área privada
//            $login = $this->input->post('login');
//            $sess_array = array();
//            $sess_array = array(
//            'usuariologin' => $login
//            );
            
            $login = $this->input->post('login');
            $senha = $this->input->post('password');
            
            //$this->load_model('model_usuario');
            
            $this->load->model ( 'model_utilisateur' );
                        
        
        
            $resultadoUsuario = $this->model_utilisateur->login($login,$senha);
            
            foreach ($resultadoUsuario as $usuario){
                $config_array = array(
                  'nomeUsuario' => $usuario->NOM,
                  'loginUsuario' => $usuario->LOGIN,
                  'emailUsario' => $usuario->EMAIL,
                  'datacadastro' => $usuario->DATE_CAD
                );
            }
            
          // var_dump($resultadoUsuario);
         //  var_dump($config_array);
        //  die;
            
            $this->session->set_userdata('logged_in', $config_array);
            redirect('home/dashboard', 'refresh');
        }
    }
    function check_database($password)
    {
        $login= $this->input->post('email');
        $this->load->model('model_user',TRUE);
        var_dump($login);
        var_dump($password);
        $result= $this->model_user->login($email,$password);
        $userid='';
        $usernom='';
        
        if($result)
        {
            foreach ($result as $line){
                $data['userid']= $line->ID;
                $data['usernom']= $line->NOM;
            }
        }else{
            $this->form_validation->set_message('check_database','Autentication Error');
        }
        
    }
}
