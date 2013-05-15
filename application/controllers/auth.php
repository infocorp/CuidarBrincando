<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        // Carrega Helpers, Libraries e Auth_Model
        $this->load->library(array(
            'session',
            'form_validation',
        ));
        $this->load->helper('url');
        $this->load->model('auth_model');
    }

    public function login()
    {
        try {
            $this->form_validation->set_rules('username', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Senha', 'trim|required|xss_clean');
            $this->form_validation->set_message('required', 'O campo %s não pode estar vazio');
            $this->form_validation->set_message('valid_email', 'Por favor, insira um email válido');

            if (false === $this->form_validation->run()) {
                $this->load->view('header');
                $this->load->view('login_view');
                $this->load->view('footer');
                return;
            }

            // Carrega biblioteca user
            $this->load->library('user');
            // Seta email e senha na classe User para ser passada como argumento no model
            $this->user
                ->setEmail($this->input->post('username'))
                ->setPassword($this->input->post('password'));

            if ($this->auth_model->verificaLogin($this->user)) {
                // Autenticar e Autorizar usuário
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('login_feedback', $e->getMessage());
            redirect('/');
        }
    }
}