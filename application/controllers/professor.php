<?php
class Professor extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('professor_model');
        $this->load->helper('url_helper');
        $this->load->library(array('form_validation', 'session'));
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[255]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|max_length[50]');
        $this->form_validation->set_rules('dataNascimento', 'Data de Nascimento', 'required|max_length[10]');//ARRUMAR VALIDAÇÃO
        $this->form_validation->set_rules('sexo', 'Sexo', 'validaSexo');
        $this->form_validation->set_rules('cor', 'Cor', 'required|max_length[100]');//ARRUMAR COR NO BANCO DE DADOS PARA ENUMERADO
        $this->form_validation->set_rules('escolaridade', 'Escolaridade', 'required|max_length[20]');//ARRUMAR NO BANCO DE DADOS PARA ENUMERADO
        //$this->form_validation->set_rules('endereco_id', 'Endereco ID', 'required|max_length[11]');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
    
    public function index()
    {
        $this->load->view('professor_view');
    }
    
    public function cadastrar()
    {
        
    }
    
    public function validaSexo($sexo)
    {
        if ($sexo == 'M' || $sexo == 'F' || $sexo == 'I'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}